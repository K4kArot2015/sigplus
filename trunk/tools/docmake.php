<?php
/**
* @file
* @brief    sigplus Image Gallery Plus documentation make utility
* @author   Levente Hunyadi
* @version  $__VERSION__$
* @remarks  Copyright (C) 2011 Levente Hunyadi
* @remarks  Licensed under GNU/GPLv3, see http://www.gnu.org/licenses/gpl-3.0.html
* @see      http://hunyadi.info.hu/projects/sigplus
*/

$codeblocks = array();

function wiki_codeblock_save($matches) {
	global $codeblocks;
	static $id = 0;
	$codeblocks[$id] = $matches[1];
	$replacement = '<<<!codeblock-'.$id.'!>>>';
	$id++;
	return $replacement;
}

function wiki_codeblock_restore($matches) {
	global $codeblocks;
	return '`'.$codeblocks[$matches[1]].'`';
}

function wiki_escape($text) {
	global $codeblocks;
	$codeblocks = array();

	// save code blocks, which are exempt from escaping
	$text = preg_replace_callback('#`(.*?)`#Su', 'wiki_codeblock_save', $text);
	
	// perform replacements
	$text = preg_replace(
		array(
			'#\\[(.*?)\\]#Su',  // e.g. [px]
			'#((?:[A-Z][a-z]+){2,})#Su'  // e.g. JavaScript, MooTools
		),
		array(
			"[\xE2\x80\x8B$1\xE2\x80\x8B]",  // surround with UTF-8 representation of zero-width space to prevent wiki transformation to link
			'!$1'  // e.g. !JavaScript, !MooTools
		),
		$text
	);
	
	// restore code blocks
	$text = preg_replace_callback('#<<<!codeblock-([0-9]+)!>>>#Su', 'wiki_codeblock_restore', $text);
	
	return $text;
}

function wiki_format($text) {
	$text = preg_replace('#<code>(.*?)</code>#Su', '`$1`', $text);
	$text = preg_replace('#<kbd>(.*?)</kbd>#Su', '`$1`', $text);
	$text = preg_replace('#<var>(.*?)</var>#Su', '_$1_', $text);
	$text = preg_replace('#<em>(.*?)</em>#Su', '_$1_', $text);
	$text = str_replace(
		array('&nbsp;','&ldquo;','&rdquo;'),
		array("\xC2\xA0","\xE2\x80\x9C","\xE2\x80\x9D"),  // UTF-8 representation of non-breaking space, left double quotation mark, etc.
		$text
	);
	return $text;
}

class DocString {
	public $type;

	public function __construct($string) {
		$string = preg_replace('#^/\*{2,}\s+|\s+\*+/$#S', '', $string);  // strip leading /** and /**...** and trailing */ and **...*/
		$string = preg_replace('#^[ \t\r]*\*[ \t\r]*#mS', '', $string);  // remove leading whitespace and asterisk (*) at the beginning of line
		$lines = explode("\n", $string);
		foreach ($lines as $line) {
			if (preg_match('#@type\s+\{([^{}]+)\}#', $string, $match)) {
				$this->type = $match[1];
			}
			if (preg_match('#@example\s+(.*)$#', $string, $match)) {
				$this->example = $match[1];
			}
		}
	}
}

// load configuration XML manifest
$configuration = simplexml_load_file(dirname(__FILE__).DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'content'.DIRECTORY_SEPARATOR.'sigplus'.DIRECTORY_SEPARATOR.'sigplus.xml');
$fieldsets = $configuration->xpath('/extension/config/fields/fieldset');

// load language data
$language = parse_ini_file(dirname(__FILE__).DIRECTORY_SEPARATOR.'administrator'.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR.'en-GB'.DIRECTORY_SEPARATOR.'en-GB.plg_content_sigplus.ini');

// load parameters
$params = array();

define('_JEXEC', 1);
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'content'.DIRECTORY_SEPARATOR.'sigplus'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'params.php';
$class = new ReflectionClass('SIGPlusGalleryParameters');
//$docstring = new DocString($class->getDocComment());
foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
	$docstring = new DocString($property->getDocComment());
	$params[$property->name] = array();
	if (isset($docstring->type)) {
		$params[$property->name]['type'] = $docstring->type;
	}
	if (isset($docstring->example)) {
		$params[$property->name]['example'] = $docstring->example;
	}
}

// compile wiki page
print <<<WIKI
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
</head>
<body>
<pre style="white-space:pre-wrap;">
#summary List of configuration parameters available in the back-end.

&lt;wiki:comment&gt;
This file has been automatically generated by a tool.
&lt;/wiki:comment&gt;

WIKI;

foreach ($fieldsets as $fieldset) {
	$label = isset($fieldset['label']) ? $language[(string) $fieldset['label']] : (string)$fieldset['name'];

	print "\n= ".$label." =".PHP_EOL.PHP_EOL;
	
	$fields = $fieldset->xpath('field');
	foreach ($fields as $field) {
		if ($field['type'] == 'spacer') {  // skip XML fields with only graphical significance
			continue;
		}

		$name = htmlspecialchars((string) $field['name']);
		
		// extract label from extension XML file and language file
		$label = htmlspecialchars($language[(string) $field['label']]);
		$label = wiki_escape($label);

		// extract type information from PHP file
		if (isset($params[$name]) && isset($params[$name]['type'])) {
			$type = $params[$name]['type'];
			$type = preg_replace(
				array('#(bool(?:ean)?|(?:positive_|nonnegative_)?integer|string|array)#Su', "#'([^']+)'#Su"),
				array('_$1_', '`$1`'),
				$type
			);
		} else {
			$type = false;
		}
		
		if (isset($params[$name]) && isset($params[$name]['example'])) {
			$example = wiki_format($params[$name]['example']);
		} else {
			$example = false;
		}

		// extract summary text from language file
		$description = $language[(string) $field['description']];
		
		// replace HTML formatting in summary text
		$description = wiki_format($description);

		// escape Wiki special characters in summary text
		$description = wiki_escape($description);
		$description = htmlspecialchars($description);

		print "== {$name} ==".PHP_EOL.PHP_EOL;
		print "*Back-end name*: {$label}".PHP_EOL.PHP_EOL;
		if ($type !== false) {
			print "*Type/value*: {$type}".PHP_EOL.PHP_EOL;
		}
		print "*Summary*: {$description}".PHP_EOL.PHP_EOL;
		if ($example !== false) {
			print "*Example*: {$example}".PHP_EOL.PHP_EOL;
		}
	}
}

print <<<WIKI
</pre>
</body>
</html>
WIKI;
