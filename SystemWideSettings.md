Information on this page applies to sigplus 1.5.x and later. For specifics regarding sigplus 1.4.x, the latest production version to date, refer to its [documentation](http://hunyadi.info.hu/levente/en/sigplus/settings).

# System-wide settings #

While most configuration settings govern the appearance and behavior of galleries, and can be configured both at a global level and at the gallery level, a few settings apply to sigplus in general, including all usages of the plug-in in articles (content items) and all module instances. For these settings, the override mechanism normally used in sigplus would typically not make sense or may lead to undefined behavior.

System-wide settings are typically found on the tab _Advanced settings_ or _Expert settings_ on the sigplus plug-in configuration page: open the _Plug-in Manager_ in the Joomla administration back-end and click _Content - Image gallery - sigplus_ in the list.

## Use multilingual labels ##

**Purpose**: Whether to support multilingual labeling.

**Expected value**: _yes_ or _no_

**Parameter name**: `multilingual`

## Base folder ##

**Purpose**: Base directory for images.

**Expected value**: a path relative to the Joomla root directory, or an absolute path

**Parameter name**: `base_folder`

## Base URL ##

**Purpose**: Base URL the directory for images corresponds to.

**Expected value**: none, or an absolute path

**Parameter name**: `base_url`

## Thumbnail folder ##

**Purpose**: Subdirectory for thumbnail images.

**Expected value**: a relative path

**Parameter name**: `folder_thumb`

## Preview folder ##

**Purpose**: Subdirectory for preview images.

**Expected value**: a relative path

**Parameter name**: `folder_preview`

## Folder for originals ##

**Purpose**: Subdirectory for full-size images.

**Expected value**: a relative path

**Parameter name**: `folder_fullsize`

## Folder for watermarking ##

**Purpose**: Subdirectory for watermarked images.

**Expected value**: a relative path

**Parameter name**: `folder_watermarked`

## Folder for scripts ##

**Purpose**: Subdirectory for external script files.

**Expected value**: a relative path

**Parameter name**: `folder_script`

## Use cache for images ##

**Purpose**: Whether to use Joomla cache folder for storing generated images.

**Expected value**: _yes_ or _no_

**Parameter name**: `cache_image`

## Use cache for content ##

**Purpose**: Whether to use Joomla cache folder for storing temporary generated content.

**Expected value**: _yes_ or _no_

**Parameter name**: `cache_content`

## Image processing library ##

**Purpose**: Image processing library to use.

**Expected value**: _default_, _GD_ or _ImageMagick_

**Parameter name**: `library_image`

**Supported parameter values**: `'none'`, `'gd'`, `'imagick'`

## JavaScript library source ##

**Purpose**: JavaScript library to use.

**Expected value**: _Google Ajax API CDN_, _Microsoft CDN_, _jQuery CDN_, _local copy_ or _none_

**Parameter name**: `library_jsapi`

**Supported parameter values**: `'default'`, `'local'`, `'none'`, `'cdn-google'`, `'cdn-microsoft'`, `'cdn-jquery'`

## Client debug mode ##

**Purpose**: Whether to use uncompressed versions of lightbox and rotator engine scripts.

**Expected value**: _yes_ or _no_

**Parameter name**: `debug_client`

## Server debug mode ##

**Purpose**: Whether to print verbose status messages of actions performed on the server.

**Expected value**: _yes_ or _no_

**Parameter name**: `debug_server`