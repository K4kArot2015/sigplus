<?php
/**
* @file
* @brief    sigplus Image Gallery Plus file system functions
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

/*****************************************************************************
* UTF-8 file system compatibility layer
*****************************************************************************/

if (!interface_exists('fsx_functions') && !class_exists('fsx')) {

/**
* UTF-8 compatibility layer for filesystem functions.
*
* This layer exposes PHP 5 filesystem functions like file_exists, filesize, filemtime, readfile,
* etc. that support files whose filename contains UTF-8 (non-ASCII) characters. Prefix function
* names with the static class name "fsx" to unlock functionality. For instance, the statement
*
* $size = fsx::filesize($file);
*
* returns the file size in bytes even if the variable $file contains non-ASCII characters.
*
* Normally, PHP 4/5 filesystem functions use ANSI versions of Windows filesystem functions, which
* fail with non-ASCII characters in filenames. This thin layer uses COM scripting services to
* interact with the Windows filesystem in a way that makes it possible to pass UTF-8 characters
* in filenames.
*/
interface fsx_functions {
	public function scandir($dir);
	public function scandir_mtime($dir);
	public function get_files_with_extension($dir, array $ext, $rev = false);
	public function file_exists($path);
	public function filemtime($file);
	public function filesize($file);
	public function file_get_contents($file);
	public function file_put_contents($file, $data);
	public function readfile($file);
}

class fsx_windows implements fsx_functions {
	/**
	* A COM file system object in Windows.
	*/
	private $fs = null;

	public function __construct($fs) {
		$this->fs = $fs;
	}

	public function __destruct() {
		unset($this->fs);
	}

	public function get_short_path($path) {
		try {
			if ($this->fs->FileExists($path)) {
				return $this->fs->GetFile($path)->ShortPath;
			}
			if ($this->fs->FolderExists($path)) {
				return $this->fs->GetFolder($path)->ShortPath;
			}
		} catch (com_exception $e) {}
		return $path;  // no short path available
	}

	public function scandir($dir) {
		$results = array();
		try {
			$fsdir = $this->fs->GetFolder($dir);
			foreach ($fsdir->SubFolders as $fsfolder) {
				$results[] = $fsfolder->Name;
			}
			foreach ($fsdir->Files as $fsfile) {
				$results[] = $fsfile->Name;
			}
			unset($fsdir);
			return $results;
		} catch (com_exception $e) { }
		return false;
	}

	public function scandir_mtime($dir) {
		$results = array();
		try {
			$fsdir = $this->fs->GetFolder($dir);
			foreach ($fsdir->Files as $fsfile) {
				$results[$fsfile->Name] = $fsfile->DateLastModified;
			}
			unset($fsdir);
			return $results;
		} catch (com_exception $e) { }
		return false;
	}

	/**
	* Get a directory listing in character set UTF-8.
	*/
	public function get_files_with_extension($dir, array $ext, $rev = false) {
		$results = array();
		try {
			$fsdir = $this->fs->getFolder($dir);
			foreach ($fsdir->Files as $fsfile) {
				$fsname = $fsfile->Name;
				$fsext = '';
				if (($pos = strrpos($fsname, '.')) !== false) {
					$fsext = substr($fsname, $pos + 1);  // skip dot (.)
				}
				if (in_array($fsext, $ext)) {
					$results[] = $fsname;
				}
			}
			unset($fsdir);
			return $results;
		} catch (com_exception $e) { }
		return false;
	}

	public function file_exists($path) {
		return $this->fs->FileExists($path) || $this->fs->FolderExists($path);
	}

	public function filemtime($file) {
		try {
			if ($this->fs->FileExists($file)) {
				return variant_date_to_timestamp($this->fs->GetFile($file)->DateLastModified);
			}
			if ($this->fs->FolderExists($file)) {
				return variant_date_to_timestamp($this->fs->GetFolder($file)->DateLastModified);
			}
		} catch (com_exception $e) {}
		return false;
	}

	public function filesize($file) {
		try {
			if ($this->fs->FileExists($file)) {
				return $this->fs->GetFile($file)->Size;
			}
		} catch (com_exception $e) {}
		return false;
	}

	public function file_get_contents($file) {
		try {
			$stream = new COM('ADODB.Stream', null, CP_UTF8);
			$stream->Type = 1;  // adTypeBinary
			$stream->Open();
			$stream->LoadFromFile($file);
			$data = $stream->Read();  // convert to PHP Traversable
			ob_start();
			foreach ($data as $item) {  // iterate COM SAFEARRAY as character codes and print each character
				print chr($item);
			}
			$string = ob_get_clean();
			$stream->Close();
			return $string;
		} catch (com_exception $e) {
			return file_get_contents($this->get_short_path($file));
		}
	}

	public function file_put_contents($file, $data) {
		try {
			$tempfile = tempnam(dirname($file), 'fsx');
			$result = file_put_contents($tempfile, $data);
			if ($this->fs->FileExists($file)) {
				$this->fs->DeleteFile($file);
			}
			$this->fs->MoveFile($tempfile, $file);
			return $result;
		} catch (com_exception $e) {
			if (isset($tempfile) && file_exists($tempfile)) {
				unlink($tempfile);
			}
			return false;
		}
	}

	public function readfile($file) {
		try {
			$stream = new COM('ADODB.Stream', null, CP_UTF8);
			$stream->Type = 1;  // binary
			$stream->Open();
			$stream->LoadFromFile($file);
			$data = $stream->Read();  // convert to PHP Traversable
			foreach ($data as $item) {  // iterate COM SAFEARRAY as character codes and print each character
				print chr($item);
			}
			$stream->Close();
			return true;
		} catch (com_exception $e) {
			return readfile($this->get_short_path($file));
		}
	}

	public function getimagesize($file) {
		return getimagesize($this->get_short_path($file));
	}
}

class fsx_unix implements fsx_functions {
	public function scandir($dir) {
		return scandir($dir);
	}

	/**
	* List files and directories inside the specified path with modification time.
	* @return An associative array with filenames as keys and timestamps as values.
	*/
	public function scandir_mtime($dir) {
		$dh = @opendir($dir);
		if ($dh === false) {  // cannot open directory
			return false;
		}
		$files = array();
		while (false !== ($filename = readdir($dh))) {
			if (!is_regular_file($filename)) {
				continue;
			}
			$files[$filename] = filemtime($dir.DIRECTORY_SEPARATOR.$filename);
		}
		closedir($dh);
		return $files;
	}

	/**
	* Get all files in a directory that have the specified extension.
	* @param {string} $dir Absolute path to a directory.
	* @param {string} $ext Extension to check file names against.
	* @param {boolean} $rev True if file names are to be sorted in reverse order.
	*/
	public function get_files_with_extension($dir, array $ext, $rev = false) {
		$results = array();
		$files = scandir($dir, $rev);
		foreach ($files as $file) {
			if (in_array(pathinfo($file, PATHINFO_EXTENSION), $ext)) {
				$results[] = $file;
			}
		}
		return $results;
	}

	public function file_exists($path) {
		return file_exists($path);
	}

	public function filemtime($file) {
		return filemtime($file);
	}

	public function filesize($file) {
		return filesize($file);
	}

	public function file_get_contents($file) {
		return file_get_contents($file);
	}

	public function file_put_contents($file, $data) {
		return file_put_contents($file, $data);
	}

	public function readfile($file) {
		return readfile($file);
	}

	public function getimagesize($file) {
		return getimagesize($file);
	}
}

/**
* File system extensions.
* File system portability layer for Windows and UNIX-based systems.
*/
class fsx {
	private static $instance;

	public static function initialize() {
		$fs = false;
		if (class_exists('COM')) {
			try {
				$fs = new COM('Scripting.FileSystemObject', null, CP_UTF8);
			} catch (com_exception $e) { }
		}
		if ($fs !== false) {
			self::$instance = new fsx_windows($fs);  // use Windows FileSystemObject
		} else {  // COM Scripting not available
			self::$instance = new fsx_unix();  // use PHP's own functions with a thin wrapper
		}
	}

	public static function scandir($dir) {
		return self::$instance->scandir($dir);
	}

	public static function scandir_mtime($dir) {
		return self::$instance->scandir_mtime($dir);
	}

	public static function get_files_with_extension($dir, $ext, $rev = false) {
		if (!is_array($ext)) {
			$ext = array($ext);
		}
		return self::$instance->get_files_with_extension($dir, $ext, $rev);
	}

	/**
	* Get all files in a directory that have the specified extension sorted by last modified time.
	* @param {string} $dir Absolute path to a directory.
	* @param {string} $ext Extension to check file names against.
	* @param {boolean} $rev True if file names are to be sorted in reverse order.
	*/
	public static function get_files_with_extension_time($dir, $ext, $rev = false) {
		$files = self::$instance->get_files_with_extension($dir, $ext, $rev);

		// fetch last modified date for each file
		$times = array();
		foreach ($files as $file) {
			$times[] = self::filemtime($dir.DIRECTORY_SEPARATOR.$file);
		}

		// sort file array based on timestamp values
		$sortorder = $rev ? SORT_DESC : SORT_ASC;
		array_multisort($times, $sortorder, SORT_NUMERIC, $files, $sortorder, SORT_STRING);

		return $files;
	}

	public static function file_exists($path) {
		return self::$instance->file_exists($path);
	}

	public static function filemtime($file) {
		return self::$instance->filemtime($file);
	}

	public static function filesize($file) {
		return self::$instance->filesize($file);
	}

	public static function file_get_contents($file) {
		return self::$instance->file_get_contents($file);
	}

	public static function file_put_contents($file, $data) {
		return self::$instance->file_put_contents($file, $data);
	}

	public static function readfile($file) {
		return self::$instance->readfile($file);
	}

	public static function getimagesize($file) {
		return self::$instance->getimagesize($file);
	}

	public static function filemdate($file) {
		return gmdate('Y-m-d H:i:s', fsx::filemtime($file));
	}
}

fsx::initialize();

}  // if (!interface_exists('fsx_functions') && !class_exists('fsx'))

/*****************************************************************************
* Directory listing
*****************************************************************************/

if (!function_exists('walkdir')) {

/**
* List files and directories inside the specified path recursively.
* @param {string} $path The directory whose files and subdirectories to list.
* @param {array} $exclude Subdirectories to exclude from the listing.
* @param {int} $depth Maximum depth to traverse the directory hierarchy; >0 for recursive directory listing with a limit, 0 for flat listing, or -1 for listing with no limit.
* @param $callback Callback function to invoke for each directory hierarchy level.
* @param {array} $ancestors Breadcrumbs for current directory ancestors returned by the callback function
*/
function walkdir($path, array $exclude = array(), $depth = 0, $callback = null, $ancestors = null) {
	if (($entries = fsx::scandir($path)) !== false) {
		$folders = array();
		$files = array();
		foreach ($entries as $entry) {
			if ($entry{0} != '.' && !in_array($entry, $exclude)) {  // skip hidden files, special directory entries "." and "..", and excluded entries
				if (is_file($path.DIRECTORY_SEPARATOR.$entry)) {
					$files[] = $entry;
				} elseif (is_dir($path.DIRECTORY_SEPARATOR.$entry)) {
					$folders[] = $entry;
				}
			}
		}

		// invoke callback function
		if (isset($callback)) {
			if (is_array($callback)) {
				$object = $callback[0];
				$params = $callback[1];
				$func = array($object, $params);
			} else {
				$func = $callback;
			}
			if (isset($ancestors)) {
				$ancestor = call_user_func($func, $path, $files, $folders, $ancestors);
				array_unshift($ancestors, $ancestor);  // add current folder to list of ancestors
			} else {
				call_user_func($func, $path, $files, $folders);
			}
		}

		// scan descandant folders
		if ($depth < 0 || $depth > 0) {
			foreach ($folders as $folder) {
				if (isset($ancestors)) {
					walkdir($path.DIRECTORY_SEPARATOR.$folder, $exclude, $depth - 1, $callback, $ancestors);
				} else {
					walkdir($path.DIRECTORY_SEPARATOR.$folder, $exclude, $depth - 1, $callback);
				}
			}
		}
	}
}

}  // if (!function_exists('walkdir'))

/*****************************************************************************
* Miscellaneous file system management.
*****************************************************************************/

/**
* Ensure that a string is a relative path, removing leading and trailing space and slashes from a path string.
*/
function relativepath($path) {
	return str_replace('\\', '/', trim($path, "\t\n\r /"));  // remove leading and trailing spaces and slashes
}

/**
* Ensures that all components of a URL are URL-encoded.
*/
function safeurlencode($url) {
	$urlparts = parse_url($url);
	$pattern = '#^([0-9A-Za-z!"$&\'()*+,.:;=@_-]|%[0-9A-Za-z]{2})+$#';
	$segments = explode('/', $urlparts['path']);
	foreach ($segments as &$segment) {
		if (!preg_match($pattern, $segment)) {  // path segment contains a character that has not been URL-encoded
			$segment = rawurlencode($segment);
		}
	}
	$urlparts['path'] = implode('/', $segments);
	if (!empty($urlparts['query'])) {
		if (!preg_match($pattern, $urlparts['query'])) {  // query contains a character that has not been URL-encoded
			$urlparts['query'] = rawurlencode($urlparts['query']);
		}
	}
	return
		$urlparts['scheme'].'://'.
		( empty($urlparts['user']) ? '' : $urlparts['user'].( empty($urlparts['pass']) ? '' : ':'.$urlparts['pass'] ).'@' ).
		$urlparts['host'].$urlparts['path'].
		( empty($urlparts['query']) ? '' : '?'.$urlparts['query'] ).
		( empty($urlparts['fragment']) ? '' : '#'.$urlparts['fragment'] );
}

/**
* URL-encodes all components of a path.
*/
function pathurlencode($path) {
	$parts = explode('/', strtr($path, DIRECTORY_SEPARATOR, '/'));
	foreach ($parts as &$part) {
		$part = rawurlencode($part);
	}
	return implode('/', $parts);
}

/**
* Tests whether a string is a HTTP URL.
*/
function is_url_http($string) {
	return preg_match('#^https?://#', $string);
}

/**
* Check if a path is a UNIX- or Windows-style absolute file system path.
*/
function is_absolute_path($path) {
	return (bool) preg_match('#^(/|([A-Za-z0-9]:)?\\\\)#S', $path);
}

/**
* Filters regular files, skipping those that are hidden.
* The filename of a hidden file starts with a dot.
*/
function is_regular_file($filename) {
	return $filename{0} != '.';
}

function is_filename($filename) {
	return strpos(strtr($filename, DIRECTORY_SEPARATOR, '/'), '/') === false;
}

/**
* Checks whether a file or directory exists accepting both lowercase and uppercase extension.
* @return The file name with extension as found in the file system.
*/
function file_exists_case_insensitive($path) {
	$realpath = realpath($path);
	if ($realpath !== false) {
		return pathinfo($realpath, PATHINFO_BASENAME);  // file name possibly with extension
	}
	$filename = pathinfo($path, PATHINFO_BASENAME);  // file name possibly with extension
	if (fsx::file_exists($path)) {  // file exists as-is, no inspection of extension is necessary
		return $filename;
	}
	$extension = pathinfo($path, PATHINFO_EXTENSION);  // file extension if present
	if ($extension) {  // if file has extension
		$p = strrpos($path, '.');              // starting position of extension (incl. dot)
		$base = substr($path, 0, $p);          // everything up to extension
		$extension = substr($path, $p);        // extension (incl. dot)
		$p = strrpos($filename, '.');
		$filename = substr($filename, 0, $p);  // drop extension from filename
		$extension = strtolower($extension);
		if (fsx::file_exists($base.$extension)) {   // file with lowercase extension
			return $filename.$extension;
		}
		$extension = strtoupper($extension);
		if (fsx::file_exists($base.$extension)) {   // file with uppercase extension
			return $filename.$extension;
		}
	}
	return false;  // file not found
}

/**
* Get the lastest time the folder or one of its descendants has been modified.
* @param {string} $dir An absolute path to a folder.
* @param {int} $depth 0 for current folder only, 1 for current and children, n (>1) for descandants until the given limit, -1 for all descendants.
*/
function get_folder_last_modified($dir, $depth = 0) {
	$mtime = fsx::filemtime($dir);
	if ($depth != 0) {
		// scan directory for last modified descandant folder
		if ($dh = @opendir($dir)) {
			while (($entry = readdir($dh)) !== false) {
				if ($entry != '.' && $entry != '..' && is_dir($dir.DIRECTORY_SEPARATOR.$entry)) {
					$mtime = max($mtime, get_folder_last_modified($dir.DIRECTORY_SEPARATOR.$entry, $depth - 1));
				}
			}
			closedir($dh);
		}
	}
	return $mtime;
}

/**
* Fetch a resource, validating it against a (weak) entity tag.
* If the resource pointed to by the entity tag has expired, the resource is fetched.
* @param {string} $url The URL to retrieve.
* @param {string} $lastmod Last modified date.
* @param {string} $etag A (weak) entity tag.
*/
function http_get_modified($url, &$lastmod = null, &$etag = null, $method = 'GET', $headers = array()) {
	// add If-Modified-Since header
	if (!empty($lastmod)) {
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $lastmod, new DateTimeZone('UTC'));
		$headers[] = 'If-Modified-Since: '.$date->format('D, d M Y H:i:s T');
	}

	// add HTTP ETag
	if (!empty($etag)) {
		$headers[] = 'If-None-Match: '.$etag;  // test for HTTP ETag match
	}

	// fetch remote content
	if (function_exists("curl_init") && function_exists("curl_setopt") && function_exists("curl_exec") && function_exists("curl_close")) {
		// cURL support is available
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		switch ($method) {
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, true); break;
			case 'GET':
			default:
				curl_setopt($ch, CURLOPT_HTTPGET, true); break;
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($ch);
		$header_length = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$content_length = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
		curl_close($ch);

		$header_array = explode("\r\n", substr($response, 0, $header_length));
		$data = substr($response, $header_length);
	} else {
		// explicit cURL support is not available, create stream context
		if (!empty($headers)) {
			$options = array(
				'http' => array(
					'method' => $method,
					'header' => implode("\r\n", $headers)."\r\n"
				)
			);
			$context = stream_context_create($options);
			$stream = @fopen($url, 'r', false, $context);
		} else {
			$stream = @fopen($url, 'r');
		}

		// read data to force (in-built) cURL to fetch HTTP headers
		// if HTTP ETag matches, there is no payload to be read
		if ($stream !== false) {
			$data = stream_get_contents($stream);
		} else {
			$data = false;
		}

		if (isset($http_response_header)) {
			// $http_response_header is a predefined PHP local variable if HTTP wrapper is supported
			$header_array = $http_response_header;
		} else {
			$header_array = null;
		}
		
		// close stream
		if ($stream !== false) {
			fclose($stream);
		}
	}

	// process response HTTP headers and payload
	if (!isset($header_array) || empty($header_array)) {  // HTTP wrappers are disabled
		$data = false;  // cannot access resource
	} elseif (preg_match('#^HTTP/[\d.]+\s+(\d+)#S', $header_array[0], $matches)) {
		$statuscode = $matches[1];
		if ($statuscode == '304') {  // HTTP 304 "Not modified" indicates ETag match
			$data = true;  // resource not modified
		} elseif ($statuscode == '200') {
			foreach ($header_array as $header) {  // go through header lines, looking for HTTP ETag
				if (preg_match('#^ETag:\s+(\S+)#iS', $header, $matches)) {  // locate ETag header
					$etag = $matches[1];  // extract and update ETag value
					break;
				} elseif (preg_match('#^Last-Modified:\s+(.+)$#iS', $header, $matches)) {
					$timestring = $matches[1];
					if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
						$date = DateTime::createFromFormat('D, d M Y H:i:s T', $timestring);  // parse HTTP date format (RFC 822, updated by RFC 1123)
					} else {
						$unixtime = strtotime($timestring);
						if ($unixtime !== false && $unixtime !== -1) {
							$date = new DateTime('@'.$unixtime);
						} else {
							$date = false;
						}
					}

					if ($date !== false) {
						$lastmod = $date->format('Y-m-d H:i:s');  // generate database date format
					} else {
						$lastmod = false;
					}
				}
			}
		} else {
			$data = false;  // unrecognized HTTP status code
		}
	} else {
		$data = false;  // invalid response
	}

	return $data;
}

/**
* Compute an image hash.
*/
function image_hash($imagepath, $userdata = false, $secret = false, $size = false) {
	if ($size === false) {
		$size = @fsx::getimagesize($imagepath);
	}
	if ($size !== false) {
		return sha1($secret.$userdata.$imagepath.'_'.$size[0].'x'.$size[1]);
	} else {
		return false;
	}
}