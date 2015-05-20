Information on this page applies to sigplus 1.5.x and later. For specifics regarding sigplus 1.4.x, the latest production version to date, refer to its [documentation](http://hunyadi.info.hu/levente/en/sigplus/settings).

# Include and exclude filters #

Typically, the activation tag specifies a single source folder to take images from, in which case all images in the folder are shown. However, in many cases it might be necessary to show only a subset of the images in the source folder. _Include filters_ provide a mechanism to select a particular set of files for display from the set of all images in the folder, whereas _exclude filters_ discard a subset of the elements selected by the include filters. Both filter types are pattern-based and match the full image file name.

Patterns for selecting a group of files can be specified with the parameters `filter-include` (files to be included in the gallery) and `filter-exclude` (files not to be included in the gallery). The exclude filter is applied after the include filter, and the exclude filter takes precedence. Selector items are separated by semicolons (`;`) and the semantics of the combination of items is an "or"-relationship. Within a selector pattern, the special character `*` stands for zero or more characters whereas `?` stands for a single character.

For example, the following activation tag will show images with a file name that starts with the characters `owl_`, or includes the text `_portrait_` in any part of the file name, but omits PNG files:

<pre>{gallery filter-include="owl_*;*_portrait_*" filter-exclude="*.png"}animals{/gallery}</pre>