<?php
/**
* @file
* @brief    sigplus Image Gallery Plus base exceptions
* @author   Levente Hunyadi
* @version  $__VERSION__$
* @remarks  Copyright (C) 2009-2011 Levente Hunyadi
* @remarks  Licensed under GNU/GPLv3, see http://www.gnu.org/licenses/gpl-3.0.html
* @see      http://hunyadi.info.hu/projects/sigplus
*/

/*
* sigplus Image Gallery Plus plug-in for Joomla
* Copyright 2009-2011 Levente Hunyadi
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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* Triggered when an error occurs while generating a gallery.
* This is a base class for other exception types.
*/
class SIGPlusException extends Exception {
	/**
	* Creates a new exception instance.
	* @param {string} $key Error message language key.
	*/
	public function __construct($key) {
		$message = '['.$key.'] '.JText::_($key);  // get localized message text
		$search = array();
		$replace = array();
		foreach (get_object_vars($this) as $property => $value) {
			$search[] = '{$'.$property.'}';  // replace placeholders in message text
			$text = (string) $this->$property;
			if (preg_match('/^[A-Z][0-9A-Z_]*$/', $text)) {  // could be a language key
				$text = JText::_($text);
			}
			$replace[] = htmlspecialchars($text);
		}
		$message = str_replace($search, $replace, $message);
		parent::__construct($message);
	}
}

class SIGPlusInvalidValueException extends SIGPlusException {
	protected $value;
	
	public function __construct($key, $value) {
		$this->value = $value;
		parent::__construct($key);
	}
}

/**
* Triggered in connection with a local file system resource such as an invalid file or folder.
* This is a base class for other exception types.
*/
class SIGPlusFileSystemException extends SIGPlusException {
	protected $file;

	public function __construct($key, $file) {
		$this->file = str_replace(array(JPATH_ROOT,DS), array('<em>'.JText::_('SIGPLUS_ROOT').'</em>','/'), $file);
		parent::__construct($key);
	}
}

/**
* Triggered when the extension is not able to guess what the base URL prefix for image folders is.
*/
class SIGPlusBaseURLException extends SIGPlusException {
	public function __construct() {
		parent::__construct('SIGPLUS_EXCEPTION_BASEURL');
	}
}

/**
* Triggered when a URL contains invalid characters.
*/
class SIGPlusURLEncodingException extends SIGPlusException {
	protected $url;

	public function __construct($url) {
		$this->url = $url;
		parent::__construct('SIGPLUS_EXCEPTION_URLENCODING');
	}
}

/**
* Triggered when a text file is not encoded with UTF-8.
*/
class SIGPlusTextFormatException extends SIGPlusException {
	protected $textfile;

	public function __construct($textfile) {
		$this->textfile = str_replace(array(JPATH_ROOT,DS), array('<em>root</em>','/'), $textfile);
		parent::__construct('SIGPLUS_EXCEPTION_TEXTFORMAT');
	}
}

/**
* Triggered when an XML file or data does not validate.
*/
class SIGPlusXMLFormatException extends SIGPlusException {
	public function __construct() {
		parent::__construct('SIGPLUS_EXCEPTION_XMLFORMAT');
	}
}

/**
* Triggered when the source specified for a gallery is not valid.
*/
class SIGPlusImageSourceException extends SIGPlusInvalidValueException {
	public function __construct($source) {
		parent::__construct('SIGPLUS_EXCEPTION_SOURCE', $source);
	}
}

/**
* Triggered when a file or folder does not exist or is inaccessible.
*/
class SIGPlusAccessException extends SIGPlusFileSystemException {
	public function __construct($file) {
		parent::__construct('SIGPLUS_EXCEPTION_ACCESS', $file);
	}
}

/**
* Thrown when the extension lacks permissions to create a folder.
*/
class SIGPlusFolderCreateException extends SIGPlusFileSystemException {
	public function __construct($folder) {
		parent::__construct('SIGPLUS_EXCEPTION_CREATE', $folder);
	}
}

/**
* Triggered when the image base folder is not valid.
*/
class SIGPlusBaseFolderException extends SIGPlusInvalidValueException {
	public function __construct($folder) {
		parent::__construct('SIGPLUS_EXCEPTION_FOLDER_BASE', $folder);
	}
}

/**
* Triggered when a folder specification is not valid.
*/
class SIGPlusInvalidFolderException extends SIGPlusException {
	protected $value;
	protected $type;
	
	public function __construct($value, $type) {
		$this->value = $value;
		$this->type = $type;
		parent::__construct('SIGPLUS_EXCEPTION_FOLDER_INVALID');
	}
}

/**
* Triggered when folders are set to point to the same directory.
*/
class SIGPlusFolderConflictException extends SIGPlusInvalidValueException {
	public function __construct($folder) {
		parent::__construct('SIGPLUS_EXCEPTION_FOLDER_CONFLICT', $folder);
	}
}

/**
* Triggered when a required engine is not available.
*/
class SIGPlusEngineUnavailableException extends SIGPlusException {
	protected $engine;
	protected $enginetype;
	
	public function __construct($engine, $enginetype) {
		$this->engine = $engine;
		if ($enginetype) {
			$this->enginetype = JText::_('SIGPLUS_ENGINE_'.strtoupper($enginetype));
		}
		parent::__construct('SIGPLUS_EXCEPTION_ENGINE');
	}
}

/**
* Triggered when a required library dependency is not available.
*/
class SIGPlusLibraryUnavailableException extends SIGPlusException {
	protected $library;

	public function __construct($library) {
		$this->library = $library;
		parent::__construct('SIGPLUS_EXCEPTION_LIBRARY');
	}
}

/**
* Triggered when the extension attempts to allocate memory for a resource with prohibitively large memory footprint.
*/
class SIGPlusOutOfMemoryException extends SIGPlusFileSystemException {
	protected $required;
	protected $available;

	public function __construct($required, $available, $resourcefile) {
		$this->required = $required;
		$this->available = $available;
		parent::__construct('SIGPLUS_EXCEPTION_MEMORY', $resourcefile);
	}
}

class SIGPlusNotSupportedException extends SIGPlusException {
	public function __construct() {
		parent::__construct('SIGPLUS_EXCEPTION_NOTSUPPORTED');
	}
}