<?php
/**
* @file
* @brief    sigplus Image Gallery Plus image search plug-in
* @author   Levente Hunyadi
* @version  $__VERSION__$
* @remarks  Copyright (C) 2009-2011 Levente Hunyadi
* @remarks  Licensed under GNU/GPLv3, see http://www.gnu.org/licenses/gpl-3.0.html
* @see      http://hunyadi.info.hu/projects/sigplus
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.plugin.plugin');
jimport('joomla.html.parameter');

/**
* Triggered when the sigplus content plug-in is unavailable or there is a version mismatch.
*/
class SIGPlusSearchDependencyException extends Exception {
	/**
	* Creates a new exception instance.
	* @param {string} $key Error message language key.
	*/
    public function __construct() {
		$key = 'SIGPLUS_EXCEPTION_EXTENSION';
		$message = '['.$key.'] '.JText::_($key);  // get localized message text
		parent::__construct($message);
    }
}

/**
 * sigplus image search plug-in.
 */
class plgSearchSIGPlus extends JPlugin {
	private $limit = 50;
	private $core;

	public function __construct( &$subject, $config ) {
		parent::__construct( $subject, $config );
		$this->limit = (int) $this->params->get('search_limit');
		if ($this->limit < 1) {
			$this->limit = 50;
		}
	}

	/**
	* Metadata search method.
	* The SQL must return the following fields that are used in a common display
	* routine: href, title, section, created, text, browsernav
	* @param {string} $text Target search string
	* @param {string} $phrase Matching option [exact|any|all]
	* @param {string} $ordering Ordering option [newest|oldest|popular|alpha|category]
	* @param {mixed} $areas An array if the search it to be restricted to areas, null if search all
	*/
	public function onContentSearch($text, $phrase = '', $ordering = '', $areas = null) {
		// load language file for internationalized labels and error messages
		$lang = JFactory::getLanguage();
		$lang->load('plg_search_sigplus', JPATH_ADMINISTRATOR);

		// skip if not searching inside image metadata
		if (is_array($areas)) {
			if (!array_intersect($areas, array_keys(self::onContentSearchAreas()))) {
				return array();
			}
		}

		if (!isset($this->core)) {
			// load sigplus content plug-in
			if (!JPluginHelper::importPlugin('content', 'sigplus')) {
				throw new SIGPlusSearchDependencyException();
			}

			// load sigplus content plug-in parameters
			$plugin = JPluginHelper::getPlugin('content', 'sigplus');
			$params = new JParameter($plugin->params);

			// create configuration parameter objects
			$configuration = new SIGPlusConfigurationParameters();
			$configuration->service = new SIGPlusServiceParameters();
			$configuration->service->setParameters($params);
			$configuration->gallery = new SIGPlusGalleryParameters();
			$configuration->gallery->setParameters($params);

			if (SIGPLUS_LOGGING || $configuration->service->debug_server) {
				SIGPlusLogging::setService(new SIGPlusHTMLLogging());
			} else {
				SIGPlusLogging::setService(new SIGPlusNoLogging());
			}

			$this->core = new SIGPlusCore($configuration);
		}

		$db = JFactory::getDbo();

		// build SQL WHERE clause
		switch ($phrase) {
			case 'all':
			case 'any':
				$text = preg_replace('#\s+#', ' ', trim($text));  // collapse multiple spaces
				$words = explode(' ', $text);
				break;
			case 'exact':
			default:
				$words = array($text);
		}
		$wherewords = array();
		foreach ($words as $word) {
			// images whose metadata contain the given word
			$wherewords[] =
				'i.'.$db->quoteName('imageid').' IN ('.PHP_EOL.
					'SELECT wi.'.$db->quoteName('imageid').PHP_EOL.
					'FROM '.$db->quoteName('#__sigplus_image').' AS wi'.PHP_EOL.
						'LEFT JOIN '.$db->quoteName('#__sigplus_data').' AS wd'.PHP_EOL.
						'ON wi.'.$db->quoteName('imageid').' = wd.'.$db->quoteName('imageid').PHP_EOL.
					'WHERE'.PHP_EOL.
						'wi.'.$db->quoteName('filename').' LIKE '.$db->quote('%'.$db->getEscaped($word, true).'%', false).' OR '.
						'wi.'.$db->quoteName('title').' LIKE '.$db->quote('%'.$db->getEscaped($word, true).'%', false).' OR '.
						'wi.'.$db->quoteName('summary').' LIKE '.$db->quote('%'.$db->getEscaped($word, true).'%', false).' OR '.
						'wd.'.$db->quoteName('textvalue').' LIKE '.$db->quote('%'.$db->getEscaped($word, true).'%', false).PHP_EOL.
				')';
		}
		switch ($phrase) {
			case 'any':  // images at least one of whose metadata fields contain one of the words
				$implodephrase = 'OR';
				break;
			case 'all':  // images whose metadata fields contain all of the words
			case 'exact':
			default:
				$implodephrase = 'AND';
		}
		$where = '('.implode(PHP_EOL.$implodephrase.PHP_EOL, $wherewords).')';

		// build SQL ORDER BY clause
		$orderby = '';
		switch ($ordering) {
			case 'oldest':
				$orderby = 'filetime ASC';
				break;
			case 'newest':
				$orderby = 'filetime DESC';
				break;
			case 'category':
				$orderby = 'folderurl';
				break;
			case 'alpha':
			case 'popular':  // ignored
			default:
				$orderby = 'filename';
				break;
		}

		// build database query
		$query =
			'SELECT'.PHP_EOL.
				$db->quoteName('fileurl').' AS url,'.PHP_EOL.
				$db->quoteName('filename').','.PHP_EOL.
				$db->quoteName('filetime').','.PHP_EOL.
				$db->quoteName('width').','.PHP_EOL.
				$db->quoteName('height').','.PHP_EOL.
				'IFNULL(i.'.$db->quoteName('title').','.PHP_EOL.
					'('.PHP_EOL.
						'SELECT c.'.$db->quoteName('title').PHP_EOL.
						'FROM '.$db->quoteName('#__sigplus_foldercaption').' AS c'.PHP_EOL.
						'WHERE'.PHP_EOL.
							'i.'.$db->quoteName('filename').' LIKE c.'.$db->quoteName('pattern').' AND '.PHP_EOL.
							'i.'.$db->quoteName('folderid').' = c.'.$db->quoteName('folderid').PHP_EOL.
						'ORDER BY c.'.$db->quoteName('priority').' LIMIT 1'.PHP_EOL.
					')'.PHP_EOL.
				') AS '.$db->quoteName('title').','.PHP_EOL.
				'IFNULL(i.'.$db->quoteName('summary').','.PHP_EOL.
					'('.PHP_EOL.
						'SELECT c.'.$db->quoteName('summary').PHP_EOL.
						'FROM '.$db->quoteName('#__sigplus_foldercaption').' AS c'.PHP_EOL.
						'WHERE'.PHP_EOL.
							'i.'.$db->quoteName('filename').' LIKE c.'.$db->quoteName('pattern').' AND '.PHP_EOL.
							'i.'.$db->quoteName('folderid').' = c.'.$db->quoteName('folderid').PHP_EOL.
						'ORDER BY c.'.$db->quoteName('priority').' LIMIT 1'.PHP_EOL.
					')'.PHP_EOL.
				') AS '.$db->quoteName('summary').','.PHP_EOL.
				$db->quoteName('preview_fileurl').','.PHP_EOL.
				$db->quoteName('preview_width').','.PHP_EOL.
				$db->quoteName('preview_height').PHP_EOL.
			'FROM '.$db->quoteName('#__sigplus_image').' AS i'.PHP_EOL.
				'INNER JOIN '.$db->quoteName('#__sigplus_folder').' AS f'.PHP_EOL.
				'ON i.'.$db->quoteName('folderid').' = f.'.$db->quoteName('folderid').PHP_EOL.
				'INNER JOIN '.$db->quoteName('#__sigplus_imageview').' AS v'.PHP_EOL.
				'ON i.'.$db->quoteName('imageid').' = v.'.$db->quoteName('imageid').PHP_EOL.
			'WHERE '.$where.PHP_EOL.
			'ORDER BY '.$orderby;
		$db->setQuery($query, 0, $this->limit);
		$rows = $db->loadAssocList();

		$show_thumbnails = (bool) $this->params->get('search_thumbnail');
		$show_lightbox = (bool) $this->params->get('search_lightbox');

		// fetch database results
		$results = array();
		if ($rows) {
			if ($show_thumbnails || $show_lightbox) {
				$instance = SIGPlusEngineServices::instance();

				if ($show_thumbnails) {
					// import script services to add thumbnail images to image description text
					$instance->addScript('/media/sigplus/js/search.js');
				}

				if ($show_lightbox) {
					// include lightbox script only if there are image results
					$this->core->addLightboxScripts('.search-results > .result-title > a');
				}
			}

			foreach ($rows as $row) {
				if ($row['title']) {
					$title = $row['title'];
				} else {
					$title = $row['filename'];
				}

				$results[] = (object) array(
					'href'        => $this->core->makeURL($row['url']),
					// standard Joomla search code strips HTML tags from search result text
					'text'        => '('.$row['width'].'x'.$row['height'].') '.htmlspecialchars($row['summary']),
					'title'       => html_entity_decode(strip_tags($title), ENT_QUOTES),
					'section'     => JText::_('SIGPLUS_IMAGES'),
					'created'     => $row['filetime'],
					'browsernav'  => '1'
				);

				if ($show_thumbnails) {
					// add thumbnail image to image description text
					// <img src="preview_fileurl" width="preview_width" height="preview_height" />
					$json_params = array();
					$json_params[] = json_encode($this->core->makeURL($row['url']));
					$json_params[] = json_encode($this->core->makeURL($row['preview_fileurl']));
					$json_params[] = (int) $row['preview_width'];
					$json_params[] = (int) $row['preview_height'];
					$instance->addOnReadyScript('__sigplusSearch('.join(',', $json_params).');');
				}
			}
		}

		return $results;
	}

	/**
	 * @return {array} An array of search areas.
	 */
	public function onContentSearchAreas() {
		static $areas;
		if (!isset($areas)) {
			$areas = array(
				'sigplus' => JText::_('SIGPLUS_IMAGES')
			);
		}
		return $areas;
	}
}