# Migrating settings from earlier versions #

The following table helps you convert configuration settings from sigplus 1.4.x to sigplus Novo (sigplus 1.5.x or later). In the first column you find the parameters that belong to sigplus Novo in the same order and with the same name as they appear in the administration back-end. The second column contains the corresponding activation tag parameter names that belong to the back-end names. Finally, the third and the fourth column contain the appropriate parameters from sigplus 1.4.x with their back-end names and parameter names. If a sigplus Novo parameter in a row does not have a matching sigplus 1.4.x parameter name then it means the current setting cannot be configured in earlier versions of sigplus, only in sigplus Novo. Missing back-end names indicate that configuration is possible solely in the body of an article with attributes in the activation tag but not in the administration back-end. Names printed in italics are drop-down list item names.

| **sigplus Novo (sigplus 1.5.x)** | | **sigplus 1.4.x** | |
|:---------------------------------|:|:------------------|:|
| **Back-end name**                | **Parameter name** | **Back-end name** | **Parameter name** |
| Base folder                      | `base_folder` | Base folder       |  |
| Gallery layout                   | `layout` | Gallery layout    | `layout` |
| _fixed with rotator_             | `fixed` | _fixed_           | `fixed` |
| _flow without rotator_           | `flow` | _flow_            | `flow` |
| _packed without rotator_         | `packed` |                   |  |
| _hidden_                         | `hidden` |                   |  |
| Image row count                  | `rows` | Rows              | `rows` |
| Image column count               | `cols` | Columns           | `cols` |
| Maximum image count              | `maxcount` | Maximum preview image count | `maxcount` |
| Alignment on page                | `alignment` | Alignment         | `alignment` |
| _left_                           | `left` | _left_            | `left` |
| _left with text wrapping around_ | `left-float` | _left with text wrapping around_ | `left-float` |
| _center_                         | `center` | _center_          | `center` |
| _right_                          | `right` | _right_           | `right` |
| _right with text wrapping around_ | `right-float` | _right with text wrapping around_ | `right-float` |
| Perview image width              | `preview_width` | Perview image width | `width` |
| Preview image height             | `preview_height` | Preview image height | `height` |
| Crop when rescaling              | `preview_crop` | Crop when resizing | `crop` |
| _yes_                            | `yes/1` | _yes_             | `1` |
| _no_                             | `no/0` | _no_              | `0` |
| Lightbox pop-up type             | `lightbox` | Lightbox pop-up   | `lightbox` |
| _none_                           | `none` | _none_            | `none` |
| _boxplus light square theme_     | `boxplus/lightsquare` | _boxplus light square theme_ | `boxplus/lightsquare` |
| _boxplus dark square theme_      | `boxplus/darksquare` | _boxplus dark square theme_ | `boxplus/darksquare` |
| _boxplus light rounded theme_    | `boxplus/lightrounded` | _boxplus light rounded theme_ | `boxplus/lightrounded` |
| _boxplus dark rounded theme_     | `boxplus/darkrounded` | _boxplus dark rounded theme_ | `boxplus/darkrounded` |
| Center on scroll                 | `lightbox_autocenter` |                   |  |
| _yes_                            | `yes/1` |                   |  |
| _no_                             | `no/0` |                   |  |
| Fit to window                    | `lightbox_autofit` |                   | `lightbox:autofit` |
| _yes_                            | `yes/1` |                   | `1` |
| _no_                             | `no/0` |                   | `0` |
| Lightbox navigation bar          | `lightbox_thumbs` |                   | `lightbox:thumbs` |
| _Overlaying image_               | `inside` |                   | `inside` |
| _In caption area_                | `outside` |                   | `outside` |
| _Hide_                           | `none` |                   |  |
| Slideshow delay (in ms)          | `lightbox_slideshow` | Slideshow delay   | `slideshow` |
| Autostart slideshow              | `lightbox_autostart` |                   |  |
| _yes_                            | `1` |                   |  |
| _no_                             | `0` |                   |  |
|                                  |  | Image slider      |  |
|                                  |  | _none_            | `none` |
|                                  |  | _boxplus image slider (with jQuery)_ | `boxplus.slider` |
|                                  |  | _boxplus image carousel (with jQuery)_ | `boxplus.carousel` |
|                                  |  | _boxplus image transition (with jQuery)_ | `boxplus.transition` |
| Image rotator orientation        | `rotator_orientation` | Image slider orientation | `orientation` |
| _horizontal_                     | `horizontal` | _horizontal_      | `horizontal` |
| _vertical_                       | `vertical` | _vertical_        | `vertical` |
| Hotspot navigation               | `rotator_buttons` | Overlay navigation | `overlay` |
| _Show_                           | `1` | _Show_            | `1` |
| _Hide_                           | `0` | _Hide_            | `0` |
| Navigation bar                   | `rotator_navigation` | Navigation bar    | `navigation` |
| _bottom_                         | `bottom` | _bottom_          | `bottom ` |
| _top_                            | `top` | _top_             | `top` |
| _both_                           | `both` | _both_            | `both` |
|                                  |  | Navigation buttons | `buttons` |
|                                  |  | _Show_            | `1` |
| _none_                           | `none/0` | _Hide_            | `0` |
| Paging buttons                   | `rotator_links` | Navigation links  | `links` |
| _Show_                           |  | _Show_            | `1` |
| _Hide_                           | `none` | _Hide_            | `0` |
|                                  |  | Page counter      | `counter` |
|                                  |  | _Show_            | `1` |
|                                  |  | _Hide_            | `0` |
| Navigation trigger               | `rotator_trigger` |                   |  |
| _click_                          | `click` |                   |  |
| _mouse-over_                     | `mouseover` |                   |  |
| Trigger action step              | `rotator_step` |                   | `slider:step` |
| _single_                         | `single` |                   | `single` |
| _page_                           | `page` |                   | `page` |
| Slide duration (in ms)           | `rotator_duration` | Slide duration    | `duration` |
| Animation delay (in ms)          | `rotator_delay` | Animation delay   | `animation` |
| Wrap around at end               | `loop` |                   | `slider:loop` |
| _On_                             | `on/1` |                   | `1` |
| _Off_                            | `off/0` |                   | `0` |
| Image caption visibility         | `caption_visibility` |                   |  |
| _none_                           | `none` |                   |  |
| _on mouse over only_             | `mouseover` |                   |  |
| _always_                         | `always` |                   | `captions:alwaysOnTop=1` |
| Image caption position           | `caption_position` | Image caption     | `captions` |
| _overlay bottom_                 | `overlay-bottom` | boxplus overlay captions (with jQuery) | `boxplus.caption` |
| _overlay top_                    | `overlay-top` |                   |  |
| _below_                          | `below` |                   |  |
| _above_                          | `above` |                   |  |
|                                  |  | _none_            | `none` |
|                                  |  |                   | `boxplus.hover` |
| Default image title              | `caption_title` | Default title     | `deftitle` |
| Default image summary            | `caption_summary` | Default description text | `defdescription` |
| Download access level            | `download` | Download icon     | `download` |
| _Guest_                          | `"Guest"` |                   |  |
| _Public_                         | `"Public"` |                   |  |
| _Registered_                     | `"Registered"` |                   |  |
| _Special_                        | `"Special"` |                   |  |
|                                  |  | _Show_            | `1` |
|                                  |  | _Hide_            | `0` |
| Metadata access level            | `metadat` | Metadata icon     | `metadata` |
| _Guest_                          | `"Guest"` |                   |  |
| _Public_                         | `"Public"` |                   |  |
| _Registered_                     | `"Registered"` |                   |  |
| _Special_                        | `"Special"` |                   |  |
|                                  |  | _Show_            | `1` |
|                                  |  | _Hide_            | `0` |
| Image protection                 | `protection` |                   |  |
| _yes_                            |  |                   | `lightbox:contextmenu=0` |
| _no_                             |  |                   | `lightbox:contextmenu=1` |
| Preview margin                   | `preview_margin` | Margin            | `margin` |
| Preview border style             | `preview_border_style` | Border style      | `borderstyle` |
| _default_                        | `default` | _default_         | `default` |
| _none_                           | `none` | _none_            | `none` |
| _dotted_                         | `dotted` | _dotted_          | `dotted` |
| _dashed_                         | `dashed` | _dashed_          | `dashed` |
| _solid_                          | `solid` | _solid_           | `solid` |
| _double_                         | `double` | _double_          | `double` |
| _3D grooved_                     | `groove` | _3D grooved_      | `groove` |
| _3D ridged_                      | `ridge` | _3D ridged_       | `ridge` |
| _3D inset_                       | `inset` | _3D inset_        | `inset` |
| _3D outset_                      | `outset` | _3D outset_       | `outset` |
| Preview border width             | `preview_border_width` | Border width      | `borderwidth` |
| Preview border color             | `preview_border_color` | Border color      | `bordercolor` |
| Preview padding                  | `preview_padding` | Padding           | `padding` |
| Image sort criterion             | `sort_criterion` | Default sort criterion | `sortcriterion` |
| _labels file (file name)_        | `labels-filename` | _labels file (with fallback to filename)_ | `labels-filename` |
| _labels file (last modification time)_ | `labels-mtime` | _labels file (with fallback to modification time)_ | `labels-mtime` |
| _labels file (file size)_        | `labels-filesize` |                   |  |
| _labels file (random order)_     | `randomlabels` | _random (restricted to labels file)_ | `randomlabels` |
| _file name_                      | `filename` | _file name_       | `filename` |
| _last modification time_         | `mtime` | _last modification time_ | `mtime` |
| _file size_                      | `filesize` |                   |  |
| _random_                         | `random` | _random_          | `random` |
| Image sort order                 | `sort_order` | Default sort order | `sortorder` |
| _ascending_                      | `asc` | _ascending_       | `asc` |
| _descending_                     | `desc` | _descending_      | `desc` |
|                                  |  | Data population method | `linkage` |
|                                  |  | _embed in HTML body_ | `inline` |
|                                  |  | _generate using script in HTML head_ | `head` |
|                                  |  | _generate using external script in cache folder_ | `external` |
| Recursion depth                  | `depth` |                   | `depth` |
| Watermark position               | `watermark_position` |                   | `watermark:position` |
| _none_                           | `none/0` |                   |  |
| _north_                          | `n ` |                   | `n ` |
| _northeast_                      | `ne` |                   | `ne` |
| _east_                           | `e` |                   | `e` |
| _southeast_                      | `se` |                   | `se` |
| _south_                          | `s` |                   | `s` |
| _southwest_                      | `sw` |                   | `sw` |
| _west_                           | `w ` |                   | `w ` |
| _northwest_                      | `nw` |                   | `nw` |
| _center_                         | `c ` |                   | `c ` |
| Distance from horizontal         | `watermark_x` |                   | `watermark:x` |
| Distance from vertical           | `watermark_y` |                   | `watermark:y` |
| Filename for watermark           | `watermark_source` |                   | `watermark=1` |
| Thumbnail width                  | `thumb_width` |                   |  |
| Thumbnail height                 | `thumb_height` |                   |  |
| Crop when resizing               | `thumb_crop` |                   |  |
| _yes_                            | `yes/1` |                   |  |
| _no_                             | `no/0` |                   |  |
| Lightbox transition effect       | `lightbox_transition` |                   | `lightbox:easing` |
| _linear_                         | `linear` |                   |  |
| _quadratic_                      | `quadratic` |                   |  |
| _cubicular_                      | `cubicular` |                   |  |
| _quartetic_                      | `quartetic` |                   |  |
| _quintic_                        | `quintic` |                   |  |
| _exponential_                    | `exponential` |                   |  |
| _circular_                       | `circular` |                   |  |
| _sinusoidal_                     | `sinusoidal` |                   |  |
| _back and forth_                 |  |                   |  |
| _bouncy_                         |  |                   |  |
| _elastic curve_                  |  |                   |  |
| Rotator item alignment           | `rotator_alignment` |                   |  |
| _center_                         | `c ` |                   |  |
| _north_                          | `n ` |                   |  |
| _northeast_                      | `ne` |                   |  |
| _east_                           | `e` |                   |  |
| _southeast_                      | `se` |                   |  |
| _south_                          | `s` |                   |  |
| _southwest_                      | `sw` |                   |  |
| _west_                           | `w ` |                   |  |
| _northwest_                      | `nw` |                   |  |
| Rotator transition effect        | `rotator_transition` |                   |  |
| _linear_                         | `linear` |                   |  |
| _quadratic_                      | `quadratic` |                   |  |
| _cubicular_                      | `cubicular` |                   |  |
| _quartetic_                      | `quartetic` |                   |  |
| _quintic_                        | `quintic` |                   |  |
| _exponential_                    | `exponential` |                   |  |
| _circular_                       | `circular` |                   |  |
| _sinusoidal_                     | `sinusoidal` |                   |  |
| _back and forth_                 |  |                   |  |
| _bouncy_                         |  |                   |  |
| _elastic curve_                  |  |                   |  |
| Image title template             | `caption_title_template` |                   |  |
| Image summary template           | `caption_summary_template` |                   |  |
| Folder for caching images        | `cache_image` | Use cache for generated images |  |
| _Joomla cache folder_            |  |                   |  |
| _Joomla media folder_            |  |                   |  |
| _Image source folder_            |  |                   |  |
|                                  |  | _yes_             |  |
|                                  |  | _no_              |  |
| Thumbnail folder                 | `folder_thumb` | Thumbnail folder  |  |
| Preview folder                   | `folder_preview` | Preview folder    |  |
| Folder for originals             | `folder_fullsize` | Folder for originals |  |
| Folder for watermarking          | `folder_watermarked` |                   |  |
| Generated image quality          | `quality` | Thumbnail quality | `quality` |
| Filename for labels              | `caption_source` | Filename for labels | `labels ` |
| Use multilingual labels          | `multilingual` | Multilingual support |  |
| _yes_                            | `yes/1` | _yes_             | `1` |
| _no_                             | `no/0` | _no_              | `0` |
| Gallery activation tag           | `tag_gallery` | Activation tag    |  |
| Lightbox activation tag          | `tag_lightbox` |                   |  |
|                                  |  | Custom settings   |  |
| Migrate settings                 | `settings_exporter` | Backup/Restore settings |  |
| _Export_                         |  | _Backup_          |  |
| _Import_                         |  | _Restore_         |  |
| Base URL                         | `base_url` | Base URL          |  |
| JavaScript library source        | `library_jsapi` | Ajax library source |  |
|                                  |  | _default (Google CDN with version check)_ |  |
| _Google Ajax API CDN_            |  | _Google Ajax API CDN_ |  |
| _Microsoft CDN_                  |  | _Microsoft CDN_   |  |
| _jQuery CDN_                     |  | _jQuery CDN_      |  |
| _local copy_                     |  | _local copy_      |  |
| _none_                           |  | _none_            |  |
| Image processing library         | `library_image` | Image library     |  |
| _GD (Graphics Draw)_             |  | _GD (Graphics Draw)_ |  |
| _default_                        |  | _default_         |  |
| Client debug mode                | `debug_client` | Debug mode        |  |
| _yes_                            | `1` | _yes_             |  |
| _no_                             | `0` | _no_              |  |
| Server debug mode                | `debug_server` |                   |  |
| _default_                        |  |                   |  |
| _laconic_                        |  |                   |  |
| _verbose_                        |  |                   |  |