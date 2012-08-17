<?php
/**
* @file
* @brief    sigplus Image Gallery Plus settings export/import control
* @author   Levente Hunyadi
* @version  $__VERSION__$
* @remarks  Copyright (C) 2009-2012 Levente Hunyadi
* @remarks  Licensed under GNU/GPLv3, see http://www.gnu.org/licenses/gpl-3.0.html
* @see      http://hunyadi.info.hu/projects/sigplus
*/

/*
* sigplus Image Gallery Plus plug-in for Joomla
* Copyright 2009-2012 Levente Hunyadi
*
* sigplus is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* sigplus is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

jimport('joomla.form.formfield');

/**
* Renders a control for exporting and importing configuration settings.
* This class implements a user-defined control in the administration backend.
*/
class JFormFieldExporter extends JFormField {
	protected $type = 'Exporter';

	public function getInput() {
		$html = '';

		$scriptpath = JPATH_ROOT.DS.'plugins'.DS.'content'.DS.'sigplus'.DS.'fields';
		if (file_exists($scriptpath.DS.'js'.DS.'exporter.min.js') || file_exists($scriptpath.DS.'js'.DS.'exporter.js')) {
			// get identifiers
			$class = ( $this->element->getAttribute('class') ? $this->element->getAttribute('class') : 'inputbox' );
			$ctrlid = str_replace(array('][','[',']'), array('_','_',''), $this->name);
			$exportctrlid = $ctrlid.'-export';
			$importctrlid = $ctrlid.'-import';

			// generate HTML output
			$html .=
				'<button type="button" id="'.$exportctrlid.'">'.JText::_('SIGPLUS_SETTINGS_EXPORT').'</button>'.
				'<button type="button" id="'.$importctrlid.'">'.JText::_('SIGPLUS_SETTINGS_IMPORT').'</button>'.
				'<br /><textarea class="'.$class.'" id="'.$ctrlid.'" rows="10" cols="40"></textarea>';

			// add script declaration to header
			JHTML::_('behavior.framework', false);  // include MooTools Core
			$document = JFactory::getDocument();
			if (file_exists($scriptpath.DS.'js'.DS.'exporter.min.js') && filemtime($scriptpath.DS.'js'.DS.'exporter.min.js') >= filemtime($scriptpath.DS.'js'.DS.'exporter.js')) {
				$document->addScript(JURI::root(true).'/plugins/content/sigplus/fields/js/exporter.min.js');
			} else {
				$document->addScript(JURI::root(true).'/plugins/content/sigplus/fields/js/exporter.js');
			}
			$document->addScriptDeclaration('window.addEvent("domready", function () { new SettingsExporter(document.id("'.$ctrlid.'"), document.id("'.$exportctrlid.'"), document.id("'.$importctrlid.'")); });');
		}

		// add control to page
		return $html;
	}
}