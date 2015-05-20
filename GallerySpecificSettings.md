Information on this page applies to sigplus 1.5.x and later. For specifics regarding sigplus 1.4.x, the latest production version to date, refer to its [documentation](http://hunyadi.info.hu/levente/en/sigplus/settings).

# Gallery-specific settings #

In contrast to system-wide configuration settings that apply to sigplus in general, gallery-specific settings are meant to customize the appearance and behavior of galleries and can be configured both globally (in the administration back-end on the plug-in configuration page) and locally (in the article text or on the module instance configuration page). These settings are found on the tabs _Basic settings_ and _Advanced settings_ on the sigplus plug-in or module configuration page: open the _Plug-in Manager_ or the _Module Manager_ in the Joomla administration back-end and click _Content - Image gallery - sigplus_ or one of the modules with type _sigplus_ in the list.

## Lightbox pop-up type ##

**Purpose**: The JavaScript lightbox engine to use.

**Parameter name**: `lightbox`

## Image rotator type ##

**Purpose**: The JavaScript image rotator engine to use.

**Parameter name**: `rotator`

## Image caption type ##

**Purpose**: The JavaScript image caption engine to use.

**Parameter name**: `caption`

## HTML identifier ##

**Purpose**: Unique HTML identifier to use for the gallery.

**Parameter name**: `id`

## Image source ##

**Purpose**: Image gallery source.

**Expected value**: a path relative to the base folder

**Parameter name**: `source`

## Gallery layout ##

**Purpose**: The way the gallery is rendered in HTML.

**Expected value**: _fixed_, _flow_, _packed_ or _hidden_ (for the plug-in); _fixed_ or _flow_ (for the module)

**Parameter name**: `layout`

## Image row count ##

**Purpose**: Number of rows per rotator page.

**Expected value**: a positive integer

**Parameter name**: `rows`

## Image column count ##

**Purpose**: Number of columns per rotator page.

**Expected value**: a positive integer

**Parameter name**: `cols`

## Maximum image count ##

**Purpose**: Maximum number of preview images to show in the gallery.

**Parameter name**: `maxcount`

## Preview image width ##

**Purpose**: Width of preview images in pixels.

**Expected value**: a positive integer

**Parameter name**: `preview_width`

## Preview image height ##

**Purpose**: Height of preview images in pixels.

**Expected value**: a positive integer

**Parameter name**: `preview_height`

## Crop preview images when rescaling ##

**Purpose**: Whether to allow cropping images for more aesthetic preview images.

**Expected value**: _yes_ or _no_

**Parameter name**: `preview_crop`

## Thumbnail width ##

**Purpose**: Width of thumbnail images in pixels.

**Expected value**: a positive integer

**Parameter name**: `thumb_width`

## Thumbnail height ##

**Purpose**: Height of thumbnail images in pixels.

**Expected value**: a positive integer

**Parameter name**: `thumb_height`

## Crop thumbnails when rescaling ##

**Purpose**: Whether to allow cropping images for more aesthetic thumbnails.

**Expected value**: _yes_ or _no_

**Parameter name**: `thumb_crop`

## Generated image quality ##

**Purpose**: JPEG quality.

**Expected value**: a quality percentage measure between 0 (worst) and 100 (best)

**Parameter name**: `quality`

## Alignment on page ##

**Purpose**: Alignment of image gallery.

**Expected value**: _left_, _left (with text wrapping around)_, _center_, _right_ or _right (with text wrapping around)_ (for the plug-in); _left_, _center_ or _right_ (for the module)

**Parameter name**: `alignment`

## Center on scroll ##

**Purpose**: Whether the lightbox engine automatically centers the image in the browser window.

**Expected value**: _yes_ or _no_

**Parameter name**: `lightbox_autocenter`

## Fit to window ##

**Purpose**: Whether the lightbox engine automatically reduces oversized images.

**Expected value**: _yes_ or _no_

**Parameter name**: `lightbox_autofit`

## Lightbox navigation bar ##

**Purpose**: Position to show small thumbnails for faster navigation inside the lightbox.

**Expected value**: _overlaying image_, _in caption area_, _hide_

**Parameter name**: `lightbox_thumbs`

## Slideshow delay ##

**Purpose**: Time an image is shown before navigating to the next in a slideshow, expressed in milliseconds.

**Expected value**: a nonnegative integer, or 0 to disable slideshow mode

**Parameter name**: `lightbox_slideshow`

## Autostart slideshow ##

**Purpose**: Whether to automatically activate slideshow mode when the lightbox opens.

**Expected value**: _yes_ or _no_

**Parameter name**: `lightbox_autostart`

## Lightbox transition effect ##

**Purpose**: Lightbox transition effect easing equation.

**Expected value**: _linear_, _quadratic_, _cubicular_, _quartetic_, _quintic_, _exponential_, _circular_, _sinusoidal_, _back and forth_, _bouncy_, _elastic curve_

**Parameter name**: `lightbox_transition`

## Image rotator orientation ##

**Purpose**: Orientation of image gallery viewport.

**Expected value**: _horizontal_ or _vertical_

**Parameter name**: `rotator_orientation`

## Navigation bar ##

**Purpose**: Position of navigation and paging controls.

**Expected value**: _bottom_, _top_, _none_ or _both_

**Parameter name**: `rotator_navigation`

## Hotspot navigation ##

**Purpose**: Show control buttons in navigation bar.

**Expected value**: _yes_ or _no_

**Parameter name**: `rotator_buttons`

## Paging buttons ##

**Purpose**: Show page links in navigation bar.

**Expected value**: _yes_ or _no_

**Parameter name**: `rotator_links`

## Navigation trigger ##

**Purpose**: User action to advance the rotator.

**Expected value**: _click_ or _mouse-over_

**Parameter name**: `rotator_trigger`

## Trigger action step ##

**Purpose**: Unit the rotator advances upon a single mouse click.

**Expected value**: _single_ or _page_

**Parameter name**: `rotator_step`

## Slide duration ##

**Purpose**: Time taken for the rotator to move from one page to another, expressed in milliseconds.

**Expected value**: a nonnegative integer

**Parameter name**: `rotator_duration`

## Animation delay ##

**Purpose**: Time the rotator waits before it starts to move from one page to another, expressed in milliseconds.

**Expected value**: a nonnegative integer

**Parameter name**: `rotator_delay`

## Rotator item alignment ##

**Purpose**: Alignment of rotator items within their container.

**Expected value**: _center_, _north_, _northeast_, _east_, _southeast_, _south_, _southwest_, _west_, _northwest_

**Parameter name**: `rotator_alignment`

## Rotator transition effect ##

**Purpose**: Rotator transition effect easing equation.

**Expected value**: _linear_, _quadratic_, _cubicular_, _quartetic_, _quintic_, _exponential_, _circular_, _sinusoidal_, _back and forth_, _bouncy_, _elastic curve_

**Parameter name**: `rotator_transition`

## Wrap around at end ##

**Purpose**: Whether the rotator (and the lightbox) engine wraps around.

**Expected value**: _yes_ or _no_

**Parameter name**: `loop`

## Image caption visibility ##

**Expected value**: _none_, _on mouse over only_, _always_

**Parameter name**: `caption_visibility`

## Image caption position ##

**Purpose**: Position of image captions.

**Expected value**: _overlay bottom_, _overlay top_, _below_, _above_

**Parameter name**: `caption_position`

## Filename for labels ##

**Purpose**: The name of the file from where text for captions is drawn.

**Expected value**: a file name with extension but without path

**Parameter name**: `caption_source`

## Default image title ##

**Purpose**: Default title to assign to images.

**Expected value**: any text

**Parameter name**: `caption_title`

## Default image summary ##

**Purpose**: Default description to assign to images.

**Expected value**: any text

**Parameter name**: `caption_summary`

## Image title template ##

**Purpose**: Title template used to build the image title.

**Expected value**: empty, or an image template specification, please check the manual

**Parameter name**: `caption_title_template`

## Image summary template ##

**Purpose**: Description template used to build the image description.

**Expected value**: empty, or an image template specification, please check the manual

**Parameter name**: `caption_summary_template`

## Download access level ##

**Purpose**: Access level required to download original image.

**Parameter name**: `download`

## Metadata access level ##

**Purpose**: Access level required to display metadata information.

**Parameter name**: `metadata`

## Image protection ##

**Purpose**: Client-side protection for images.

**Expected value**: _yes_ or _no_

**Parameter name**: `protection`

## Preview margin ##

**Purpose**: Margin (with or without unit).

**Expected value**: empty (to inherit from stylesheet), a nonnegative integer (pixels), or a CSS dimension value with a unit

**Parameter name**: `preview_margin`

## Preview border style ##

**Purpose**: Border style.

**Expected value**: _default_ (to inherit from stylesheet), _none_, _dotted_, _dashed_, _solid_, _double_, _3D grooved_, _3D ridged_, _3D inset_, _3D outset_

**Parameter name**: `preview_border_style`

## Preview border width ##

**Purpose**: Border width (with or without unit).

**Expected value**: empty (to inherit from stylesheet), a nonnegative integer (pixels), or a CSS dimension value with a unit

**Parameter name**: `preview_border_width`

## Preview border color ##

**Purpose**: Border color.

**Expected value**: empty (to inherit from stylesheet), a hexadecimal value in between 000000 or ffffff inclusive, or an HTML color name

**Parameter name**: `preview_border_color`

## Preview padding ##

**Purpose**: Padding (with or without unit).

**Expected value**: empty (to inherit from stylesheet), a nonnegative integer (pixels), or a CSS dimension value with a unit

**Parameter name**: `preview_border_color`

## Image sort criterion ##

**Expected value**: labels file (with fallback to file name for those not listed), labels file (with fallback to last modification time), labels file (with fallback to random order), file name, last modification time, random

**Parameter name**: `sort_criterion`

## Image sort order ##

**Expected value**: _ascending_ or _descending_

**Parameter name**: `sort_order`

## Recursion depth ##

**Purpose**: Depth limit for scanning directory hierarchies recursively.

**Expected value**: -1 for no limit, or a nonnegative integer

**Parameter name**: `depth`

## Watermark position ##

**Purpose**: The position of the watermark within the image.

**Expected value**: _none_, _center_, _north_, _northeast_, _east_, _southeast_, _south_, _southwest_, _west_, _northwest_

**Parameter name**: `watermark_position`

## Distance from horizontal ##

**Purpose**: The distance to keep from the left or right edge, as appropriate.

**Parameter name**: `watermark_x`

## Distance from vertical ##

**Purpose**: The distance to keep from the top or bottom edge, as appropriate.

**Parameter name**: `watermark_y`

## Filename for watermark ##

**Purpose**: Image file to use for watermarking.

**Parameter name**: `watermark_source`

## Representative image ##

**Expected value**: a positive integer

**Parameter name**: `index`