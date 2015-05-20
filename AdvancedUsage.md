# Advanced usage #

After you installed and enabled the extension on your site for the first time, the following settings are shown on the _Advanced Options_ tab of the sigplus configuration page in the administration back-end:

  * **Download access level**: Guest
  * **Metadata access level**: Guest
  * **Image protection**: No
  * **Preview margin**: Default
  * **Preview border style**: default
  * **Preview border width**: default
  * **Preview border color**: (Choose)
  * **Preview padding**: Default
  * **Image sort criterion**: labels file (file name)
  * **Image sort order**: ascending
  * **Recursion depth**: 0
  * **Watermark position**: none
  * **Distance from horizontal**: _empty_
  * **Distance from vertical**: _empty_
  * **Filename for watermark**: _empty_
  * **Thumbnail width**: 60
  * **Thumbnail height**: 60
  * **Crop when resizing**: No
  * **Lightbox transition effect**: sinusoidal
  * **Rotator item alignment**: center
  * **Rotator transition effect**: sinusoidal
  * **Image title template**: _empty_
  * **Image summary template**: {$text} ({$current}/{$total})
  * **Folder for caching images**: Joomla cache folder
  * **Thumbnail folder**: thumb
  * **Preview folder**: preview
  * **Folder for originals**: fullsize
  * **Folder for watermarking**: watermarked
  * **Generated image quality**: 85
  * **Filename for labels**: labels.txt
  * **Use multilingual labels**: No
  * **Gallery activation tag**: gallery
  * **Lightbox activation tag**: lightbox

The examples below demonstrate using advanced settings as well as customizing basic settings. As with [basic usage](BasicUsage.md), the examples show both approaches to setting parameters: (1) configuration from the back-end interface and (2) using in-line parameter name and value pairs in the activation tag. In the first part of the examples you find the parameters that have to be changed in the administration back-end in order to customize all galleries. If you want to customize a specific gallery in the body of an article, use the parameter names you find at the end of each example.


## How to add border to preview images ##

### Configuration in the administration back-end ###

Basic settings:

  * **Image row count**: 2
  * **Image column count**: 3
  * **Alignment on page**: center
  * **Slideshow delay (in ms)**: 5000
  * **Image rotator orientation**: vertical

Advanced settings:

  * **Preview margin**: 4
  * **Preview border style**: dotted
  * **Preview border width**: 2
  * **Preview border color**: dark red (#520909)
  * **Preview padding**: 2

All other settings are unchanged with respect to their defaults.

### Description and live example ###

{sigplus rows=2 cols=3 alignment=center lightbox\_slideshow=5000 rotator\_orientation=vertical preview\_margin=4 preview\_border\_style=dotted preview\_border\_width=2 preview\_border\_color="#520909" preview\_padding=2}hungary{/sigplus}

A gallery is shown with two rows and three columns aligned in the center. Pressing the slideshow control button in the pop-up window will start a slideshow in which each subsequent image is displayed automatically after 5 seconds. Rows move vertically by clicking on the navigation links. There is margin around every preview image, clearing a completely transparent 4 px wide area around the border. A 2 px wide, dark red dotted border is displayed around all the previews. Padding lies between the preview and the border, a transparent area which is 2 px wide.

### Usage in article text ###

<pre>
{gallery rows=2 cols=3 alignment=left lightbox_slideshow=5000 rotator_orientation=vertical<br>
preview_border_style=dotted preview_border_width=2 preview_border_color="#520909"<br>
preview_margin=4 preview_padding=2}myfolder{/gallery}</pre>


## Sorting images according to their size ##

### Configuration in the administration back-end ###

Basic settings:

  * **Image row count**: 1
  * **Image column count**: 4
  * **Lightbox navigation bar**: in caption area
  * **Animation delay (in ms)**: 2000

Advanced settings:

  * **Preview margin**: 4
  * **Preview border style**: double
  * **Preview border width**: 3
  * **Preview border color**: deep sky blue (#216b80)
  * **Preview padding**: 3
  * **Image sort criterion**: file size
  * **Image sort order**: ascending

All other settings are unchanged with respect to their defaults.

### Description and live example ###

{sigplus rows=1 cols=4 lightbox\_thumbs=outside rotator\_delay=2000 preview\_margin=4 preview\_border\_style=double preview\_border\_width=3 preview\_border\_color="#216b80" preview\_padding=3 sort\_criterion=filesize sort\_order=asc}budapest{/sigplus}

The example shows as a gallery with one row and four columns. In the pop-up window the navigation bar lies in the caption area, above the image title. Two seconds pass between successive automatic slide steps when the mouse moves away from over the rotator. The margin has a width of 4 px and a 3 px wide deep sky blue double-line border that surrounds all the previews. Padding is 3 px wide. Images are sorted according to their size and are shown in ascending order (smallest file size first).

### Usage in article text ###

<pre>
{gallery rows=1 cols=4 lightbox_thumbs=outside rotator_delay=2000 preview_margin=4 preview_border_style=double<br>
preview_border_width=3 preview_border_color="#216b80" preview_padding=3<br>
sort_criterion=filesize sort_order=asc}myfolder{/gallery}</pre>


## Customizing sort options ##

### Configuration in the administration back-end ###

Basic settings:

  * **Image row count**: 3
  * **Image column count**: 3
  * **Alignment on page**: right
  * **Lightbox pop-up type**: boxplus light rounded theme
  * **Lightbox navigation bar**: in caption area
  * **Slideshow delay (in ms)**: 5000
  * **Autostart slideshow**: yes
  * **Trigger action step**: page

Advanced settings:

  * **Preview margin**: 5
  * **Preview border style**: 3D ridged
  * **Preview border width**: 5
  * **Preview border color**: golden rod (#daa520)
  * **Preview padding**: 4
  * **Image sort criterion**: file name
  * **Image sort order**: descending

### Description and live example ###

{sigplus rows=3 cols=3 alignment=right lightbox=boxplus/lightrounded lightbox\_thumbs=outside lightbox\_slideshow=5000 lightbox\_autostart=1 rotator\_step=page preview\_margin=5 preview\_border\_style=ridge preview\_border\_width=5 preview\_border\_color="#daa520" preview\_padding=4 sort\_criterion=filename sort\_order=desc}impressionist{/sigplus}

This example shows a gallery with three rows and three columns on the right side of the page. Clicking on any previews will bring up the pop-up window with a white background and rounded corners. The lightbox navigation bar lies in the caption area and without pressing the control button the slideshow will start immediately as soon as the pop-up window appears. The image rotator advances by a whole page when using navigation controls _Previous_ and _Next_. The preview images are surrounded by a 5 px wide margin, a 5 px wide golden ridged 3D border and a 4 px wide padding. Images in the gallery are sorted according to their filenames, following one another in descending order.

### Usage in article text ###

<pre>
{gallery rows=3 cols=3 alignment=right rotator_step=page preview_margin=5 preview_padding=4<br>
preview_border_style=ridge preview_border_width=5 preview_border_color="#daa520"<br>
lightbox=boxplus/lightrounded lightbox_thumbs=outside lightbox_slideshow=5000 lightbox_autostart=1<br>
sort_criterion=filename sort_order=desc}myfolder{/gallery}</pre>


## How to change the thumbnail width and height ##

### Configuration in the administration back-end ###

Basic settings:

  * **Image row count**: 2
  * **Image column count**: 2
  * **Alignment on page**: left with text wrapping around
  * **Image rotator orientation**: vertical
  * **Animation delay (in ms)**: 4000
  * **Image caption position**: above

Advanced settings:

  * **Preview margin**: 4
  * **Preview border style**: 3D outset
  * **Preview border width**: 2
  * **Preview border color**: forest green (#1c451c)
  * **Preview padding**: 3
  * **Thumbnail width**: 70
  * **Thumbnail height**: 50
  * **Crop when resizing**: yes

### Description and live example ###

{sigplus rows=2 cols=2 alignment=left-float rotator\_orientation=vertical rotator\_delay=4000 caption\_position=above preview\_margin=4 preview\_border\_style=outset preview\_border\_width=2 preview\_border\_color="#1c451c" preview\_padding=3 thumb\_width=70 thumb\_height=50 thumb\_crop=yes}hungary{/sigplus}

This example shows a gallery with two rows and two columns on the left side, where the text is allowed to wrap around the previews. The rows move from downwards to upwards automatically, four seconds pass between slide steps when the mouse moves away from over the rotator. The image captions display above the previews. Margin around the borders is 4 px wide. The border has 2 px width, forest green color and is shown in 3D outset style. The padding surrounding the previews is 3 px wide. All the thumbnails shown in the pop-up window have the same width and height of 70x50 px regardless of their original size.

### Usage in article text ###

<pre>
{gallery rows=2 cols=2 alignment=left-float rotator_orientation=vertical rotator_delay=4000 caption_position=above<br>
preview_margin=4 preview_border_style=outset preview_border_width=2 preview_border_color="#1c451c" preview_padding=3<br>
thumb_width=70 thumb_height=50 thumb_crop=yes}myfolder{/gallery}</pre>


## How to make captions always visible ##

### Configuration in the administration back-end ###

Basic settings:

  * **Image row count**: 2
  * **Image column count**: 3
  * **Maximum image count**: 5
  * **Alignment on page**: center
  * **Lightbox pop-up type**: boxplus light rounded theme
  * **Slideshow delay (in ms)**: 7000
  * **Image rotator orientation**: vertical
  * **Trigger action step**: page
  * **Image caption visibility**: always
  * **Image caption position**: overlay top

Advanced settings:

  * **Preview margin**: 4
  * **Preview border style**: 3D outset
  * **Preview border width**: 2
  * **Preview border color**: brown (#4f2105)
  * **Preview padding**: 3
  * **Thumbnail width**: 40
  * **Thumbnail height**: 40
  * **Crop when resizing**: yes

### Description and live example ###

{sigplus rows=2 cols=3 maxcount=5 alignment=center lightbox=boxplus/lightrounded lightbox\_slideshow=7000 rotator\_orientation=vertical rotator\_step=page caption\_visibility=always caption\_position=overlay-top preview\_margin=4 preview\_border\_style=outset preview\_border\_width=2 preview\_border\_color="#4f2105" preview\_padding=3 thumb\_width=40 thumb\_height=40 thumb\_crop=yes}margaret{/sigplus}

The result is a gallery with two rows and three columns in the middle of the page. Clicking on any of the previews will bring up a pop-up window with a white background and rounded corners. Pressing the control button will start a slideshow that displays the next image automatically after 7 seconds. The rotator advances vertically by a whole page when you use the navigation links _Next_ and _Previous_. Image captions can be seen permanently in the upper part of the previews. 2 px wide brown borders in 3D outset style are shown around the 3 px wide padding. Margin has a width of 4 px. Each thumbnail in the pop-up window has the same width and height, which is 40x40 px.

### Usage in article text ###

<pre>
{gallery rows=2 cols=3 maxcount=5 alignment=center lightbox=boxplus/lightrounded lightbox_slideshow=7000<br>
rotator_orientation=vertical rotator_step=page caption_visibility=always caption_position=overlay-top<br>
preview_margin=4 preview_border_style=outset preview_border_width=2 preview_border_color="#4f2105" preview_padding=3<br>
thumb_width=40 thumb_height=40 thumb_crop=yes}myfolder{/gallery}</pre>


## Changing the lightbox and the rotator transition effect and the rotator location ##

### Configuration in the administration back-end ###

Basic settings:

  * **Image row count**: 1
  * **Image column count**: 1
  * **Alignment on page**: left with text wrapping around
  * **Lightbox pop-up type**: boxplus dark rounded theme
  * **Lightbox navigation bar**: in caption area
  * **Navigation trigger**: mouseover

Advanced settings:

  * **Preview margin**: 5
  * **Preview border style**: 3D ridged
  * **Preview border width**: 5
  * **Preview border color**: silver
  * **Preview padding**: 4
  * **Lightbox transition effect**: circular
  * **Rotator item alignment**: east
  * **Rotator transition effect**: exponential

### Description and live example ###

{sigplus rows=1 cols=1 alignment=left-float lightbox=boxplus/darkrounded lightbox\_thumbs=outside rotator\_trigger=mouseover preview\_margin=5 preview\_border\_style=ridge preview\_border\_width=5 preview\_border\_color="silver" preview\_padding=4 lightbox\_transition=circular rotator\_alignment=e rotator\_transition=exponential}impressionist{/sigplus}

The result is a gallery with one row and one column on the left side. Text is allowed to wrap around the preview. A pop-up window with a black background and rounded corners will display if you click on the preview image. The thumbnails are shown in the caption area. Moving the mouse pointer over the control links near the preview causes the rotator to start advancing. The border is 5 px wide, has silver color, shows in 3D ridged style, and is surrounded by a 5 px wide margin. Padding around the preview is 4 px wide.

### Usage in article text ###

<pre>
{gallery rows=1 cols=1 alignment=left-float lightbox=boxplus/darkrounded lightbox_thumbs=outside rotator_trigger=mouseover<br>
preview_margin=5 preview_border_style=ridge preview_border_width=5 preview_border_color="silver" preview_padding=4<br>
lightbox_transition=circular rotator_alignment=e rotator_transition=exponential}myfolder{/gallery}</pre>


## How to place a watermark on the images ##

### Configuration in the administration back-end ###

Basic settings:

  * **Image row count**: 3
  * **Image column count**: 2
  * **Alignment on page**: left with text wrapping around
  * **Lightbox pop-up type**: boxplus light rounded theme
  * **Slideshow delay (in ms)**: 3000
  * **Autostart slideshow**: yes
  * **Image caption position**: below

Advanced settings:

  * **Preview margin**: 6
  * **Preview border style**: solid
  * **Preview border width**: 2
  * **Preview border color**: dark violet (#541054)
  * **Preview padding**: 3
  * **Watermark position**: southeast
  * **Distance from horizontal**: 12
  * **Distance from vertical**: 7
  * **Filename for watermark**: watermark.png
  * **Lightbox transition effect**: linear
  * **Rotator item alignment**: west
  * **Rotator transition effect**: linear

### Description and live example ###

{sigplus rows=3 cols=2 alignment=left-float lightbox=boxplus/lightrounded lightbox\_slideshow=3000 lightbox\_autostart=1 caption\_position=below preview\_margin=6 preview\_border\_style=solid preview\_border\_width=2 preview\_border\_color="#541054" preview\_padding=3 watermark\_position=se watermark\_x=12 watermark\_y=7 watermark\_source=watermark.png lightbox\_transition=linear rotator\_alignment=w rotator\_transition=linear}budapest{/sigplus}

This example shows a gallery with three rows and two columns on the left-hand side of the page. Text is allowed to wrap around the previews. The pop-up window displays with a white background and rounded corners. The slideshow will start immediately as soon as the pop-up window appears, there is no need to press the control button. During the slideshow three seconds pass between navigating to successive images. Image captions show up below the previews. A 2 px wide dark violet solid border belongs to all the previews. Margin around the borders has a width of 6 px, and a 3 px wide padding surrounds the previews. Each image in the pop-up window is watermarked in the lower right corner. The distance of the watermark from the edge of the image is 12 px horizontally and 7 px vertically.

### Usage in article text ###

<pre>
{gallery rows=3 cols=2 alignment=left-float caption_position=below rotator_alignment=w rotator_transition=linear<br>
lightbox=boxplus/lightrounded lightbox_slideshow=3000 lightbox_autostart=1 lightbox_transition=linear<br>
preview_margin=6 preview_border_style=solid preview_border_width=2 preview_border_color="#541054" preview_padding=3<br>
watermark_position=se watermark_x=12 watermark_y=7 watermark_source=watermark.png}myfolder{/gallery}</pre>


## How to make the images downloadable and metadata accessible only for registered viewers ##

### Configuration in the administration back-end ###

Basic settings:

  * **Image row count**: 1
  * **Image column count**: 2
  * **Alignment on page**: right with text wrapping around
  * **Lightbox navigation bar**: hide
  * **Slideshow delay (in ms)**: 2000
  * **Autostart slideshow**: yes
  * **Animation delay (in ms)**: 1000

Advanced settings:

  * **Download access level**: Registered
  * **Metadata access level**: Registered
  * **Preview margin**: 4
  * **Preview border style**: 3D grooved
  * **Preview border width**: 3
  * **Preview border color**: dark green
  * **Preview padding**: 3

### Description and live example ###

{sigplus rows=1 cols=2 alignment=right-float lightbox\_thumbs=none lightbox\_slideshow=2000 lightbox\_autostart=1 rotator\_delay=1000 download="Registered" metadata="Registered" preview\_margin=4 preview\_border\_style=groove preview\_border\_width=3 preview\_border\_color="#006400" preview\_padding=3 caption\_source=filename}margaret{/sigplus}

The above example shows a gallery with one row and two columns on the right side of the page. The text wraps around the previews. The slideshow in the pop-up window starts automatically and shows the next image in two seconds. Thumbnails are hidden. One second passes between successive automatic slide steps when the mouse moves away from over the rotator. Only registered users can download the images and access image metadata such as the person who took the image, location and camera information. Preview margin is 4 px, padding is 3 px wide. 3 px wide dark green 3D grooved borders display around the previews.

### Usage in article text ###

<pre>
{gallery rows=1 cols=2 alignment=right-float rotator_delay=1000 preview_margin=4 preview_padding=3<br>
preview_border_style=groove preview_border_width=3 preview_border_color="#006400"<br>
lightbox_thumbs=none lightbox_slideshow=2000 lightbox_autostart=1<br>
download="Registered" metadata="Registered" caption_source=filename}myfolder{/gallery}</pre>

## How to combine custom layout with the lightbox effect ##

Sometimes, you might want to display a gallery inside a lightbox pop-up window but not directly on the web page. Occasionally, you might also want to display a couple of showcase preview images directly on the web page but make the full gallery navigable only when a visitor clicks the preview image and the pop-up window appears. A clever combination of hidden galleries and the lightbox pop-up activation tag allows you to utilize the power of sigplus yet have full control over the layout.

The principle is illustrated below. The key idea is to put as many activation tag instances in the article body as there are galleries you want to be shown. First, each gallery is assigned a unique identifier with the attribute `id`, and has the special layout attribute `hidden`, which hides all visuals normally associated with galleries like preview images and controls. Next, build a totally custom layout and create links that refer back to the hidden galleries with the activation tag `lightbox` having the attribute `link`. Each `lightbox` activation tag transforms into an HTML anchor and can wrap any HTML inline content including image and text.

<pre>
<div><br>
{gallery layout=hidden id=gallery1 source=folder1 /}<br>
{gallery layout=hidden id=gallery2 source=folder2 /}<br>
{gallery layout=hidden id=gallery3 source=folder3 /}<br>
<br>
<br>
Unknown end tag for </div><br>
<br>
<br>
<p><br>
Custom layout with two showcase images<br>
{lightbox link=gallery1}<img src="image1.jpg" alt="" />{/lightbox}<br>
and<br>
{lightbox link=gallery2}<img src="image2.jpg" alt="" />{/lightbox}<br>
and a {lightbox link=gallery3}link{/lightbox}.<br>
<br>
<br>
Unknown end tag for </p><br>
<br>
<br>
</pre>