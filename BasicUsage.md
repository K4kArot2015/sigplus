# Basic usage #

After you have installed and enabled the extension for the first time, you will find the following basic settings in the administration back-end:

  * **Base folder**: images
  * **Gallery layout**: fixed
  * **Image row count**: 1
  * **Image column count**: 3
  * **Maximum image count**: 0
  * **Crop when rescaling**: no
  * **Alignment on page**: center
  * **Preview image width**: 200
  * **Preview image height**: 200
  * **Lightbox pop-up type**: boxplus light sguare theme
  * **Center on scroll**: no
  * **Fit to window**: no
  * **Lightbox navigation bar**: overlaying image
  * **Slideshow delay (in ms)**: 0
  * **Autostart slideshow**: no
  * **Image rotator orientation**: horizontal
  * **Hotspot navigation**: show
  * **Navigation bar**: bottom
  * **Paging buttons**: show
  * **Navigation trigger**: click
  * **Trigger action step**: single
  * **Slide duration (in ms)**: 800
  * **Animation delay (in ms)**: 0
  * **Wrap around at end**: on
  * **Image caption visibility**: on mouse over only
  * **Image caption position**: overlay bottom

In order to use the extension you should type the name of an image folder in between the so-called _activation tags_ into the body of an article. The image folder contains your pictures, and is searched for by default inside the folder `images` located in your Joomla root folder:

<pre>
{gallery}hungary{/gallery}</pre>

The plug-in will automatically produce a preview of all the images in the folder `images/hungary`, and unless you change any configuration settings in the administration back-end, the result will look as follows:

{sigplus}hungary{/sigplus}

Clicking on any of the previews will bring up a pop-up window with squared corners and white as the basic background color.

Below you will find the further examples how to use sigplus and create beautiful galleries easily. There are two ways for fine-tuning how the galleries will look on your site. The first option is configuring sigplus in the administration back-end for which the information can be read in the first part of each example. The second option is entering all the necessary parameters you want to change directly into the body of the article as attributes of the activation tag. You can find the parameter names and values at the end of each example.

If you choose the first approach of configuring the extension in the administration back-end then all the galleries will share the same settings across the entire site. However, if you would like to display galleries customized in different ways then choose the second approach and type the necessary parameter names and values into the the body of the article as attributes of the activation tag. In this case you can have different gallery features for each usage of the sigplus activation tag. New parameter values set with the second approach override the settings inherited from the administration back-end.


## How to display all the images at once ##

### Configuration in the administration back-end ###

  * **Gallery layout**: flow (without rotator)

### Description and live example ###

As shown in the previous example, only a fixed number of images are shown at a time, and you may use navigation links to slide to the next set of images, which is practical if the image gallery contains many images. If you want no image slider but to display all image previews at once, simply activate flow layout (without rotator) in the administration back-end.

The previews will look as follows:

{sigplus layout=flow}budapest{/sigplus}

### Usage in article text ###

If you would like to show several galleries with different settings on your site, type the following parameters into the body of the article as part of the activation code:

<pre>
{gallery layout=flow}myfolder{/gallery}</pre>

If you choose this approach there is no need to change any of the parameters in the administration back-end.


## How to change gallery alignment, number of rows and columns ##

### Configuration in the administration back-end ###

  * **Image row count**: 2
  * **Image column count**: 2
  * **Alignment on page**: right

All other settings are to be left with their defaults; refer to the list at the top.

### Description and live example ###

{sigplus rows=2 cols=2 alignment=right}margaret{/sigplus}

The example shows a gallery with two rows and two columns on the right side of the page.

### Usage in article text ###

<pre>
{gallery rows=2 cols=2 alignment=right}myfolder{/gallery}</pre>


## How to show only a specified number of previews and let the text wrap around the gallery ##

### Configuration in the administration back-end ###

  * **Image row count**: 2
  * **Image column count**: 2
  * **Maximum image count**: 3
  * **Alignment on page**: before-float
  * **Lightbox pop-up type**: boxplus light rounded theme
  * **Image rotator orientation**: vertical
  * **Animation delay (in ms)**: 5000

All other settings are unchanged with respect to their defaults.

### Description and live example ###

{sigplus rows=2 cols=2 maxcount=3 alignment=before-float lightbox=boxplus/lightrounded rotator\_orientation=vertical rotator\_delay=5000}impressionist{/sigplus}

The example shows a gallery with two rows and two columns. Only three images display in the preview. The text is allowed to wrap around the gallery from the left (assuming left-to-right reading order). Clicking on the previews will bring up the pop-up window with rounded corners and a white background. The orientation of the image rotator is vertical, which means that rows move from downwards to upwards. Five seconds pass between successive automatic slide steps when the mouse moves away from over the rotator.

### Usage in article text ###

<pre>
{gallery rows=2 cols=2 maxcount=3 alignment=before-float lightbox=boxplus/lightrounded<br>
rotator_orientation=vertical rotator_delay=5000}myfolder{/gallery}</pre>


## How to display each preview with the same width and height and make them move through an automatic animation ##

### Configuration in the administration back-end ###

  * **Image row count**: 3
  * **Image column count**: 1
  * **Alignment on page**: right
  * **Preview image width**: 180
  * **Preview image height**: 180
  * **Crop when rescaling**: yes
  * **Lightbox pop-up type**: boxplus dark rounded theme
  * **Animation delay (in ms)**: 3000

All other settings are unchanged with respect to their defaults.

### Description and live example ###

{sigplus rows=3 cols=1 preview\_crop=yes alignment=right preview\_width=180 preview\_height=180 lightbox=boxplus/darkrounded rotator\_delay=3000}budapest{/sigplus}

This gallery is shown with three rows and one column, located on the right side. All previews have the same width and height, which is 180x180 px. The pop-up window uses the dark rounded theme. Three seconds pass between successive automatic slide steps when the mouse moves away from over the rotator.

### Usage in article text ###

<pre>
{gallery rows=3 cols=1 preview_crop=yes alignment=right preview_width=180 preview_height=180<br>
lightbox=boxplus/darkrounded rotator_delay=3000}myfolder{/gallery}</pre>


## Change the rotator orientation from horizontal to vertical and the style of the pop-up window background ##

### Configuration in the administration back-end ###

  * **Image row count**: 1
  * **Image column count**: 4
  * **Preview image width**: 200
  * **Preview image height**: 150
  * **Crop when rescaling**: yes
  * **Lightbox pop-up type**: boxplus dark square theme
  * **Lightbox navigation bar**: hide
  * **Image rotator orientation**: vertical
  * **Wrap around at end**: off
  * **Image caption position**: overlay top

### Description and live example ###

{sigplus rows=1 cols=4 preview\_width=200 preview\_height=150 preview\_crop=yes lightbox=boxplus/darksquare lightbox\_thumbs=none rotator\_orientation=vertical loop=off caption\_position=overlay-top}hungary{/sigplus}

It shows a gallery with one row and four columns. Each and every preview has the same width and height, which is 200x150 px. All the pop-up windows feature a black squared theme, and no navigation bar is shown. The images move from downwards to upwards when clicking on the navigation links because the orientation of the image rotator is vertical. After the last preview of the gallery is shown, the gallery will not start with the first image again when clicking the navigation button, you must navigate backwards to get back to the first preview image. The caption shows up above the preview image.

### Usage in article text ###

<pre>
{gallery rows=1 cols=4 preview_width=200 preview_height=150 preview_crop=yes<br>
lightbox=boxplus/darksquare lightbox_thumbs=none rotator_orientation=vertical<br>
loop=off caption_position=overlay-top}myfolder{/gallery}</pre>


## Change the position of captions and thumbnails and make the gallery advance by a whole page ##

### Configuration in the administration back-end ###

  * **Image row count**: 2
  * **Image column count**: 3
  * **Lightbox navigation bar**: in caption area
  * **Slideshow delay (in ms)**: 4000
  * **Trigger action step**: page
  * **Image caption position**: above

### Description and live example ###

{sigplus rows=2 cols=3 lightbox\_thumbs=outside lightbox\_slideshow=4000 rotator\_step=page caption\_position=above}impressionist{/sigplus}

This example displays a gallery with two rows and three columns. In the pop-up window the navigation bar is placed in the caption area, above the title text. A slideshow control button appears in the pop-up window. Pressing this button will trigger a slideshow, automatically showing the next image after 4 seconds of delay. The image rotator advances by a whole page instead of a single column when using navigation controls _Previous_ and _Next_. Image captions show up above the preview images.

### Usage in article text ###

<pre>
{gallery rows=2 cols=3 lightbox_thumbs=outside lightbox_slideshow=4000 rotator_step=page<br>
caption_position=above}myfolder{/gallery}</pre>


## Create an automatic slideshow in the pop-up window and let the rotator proceed by mouse-over ##

### Configuration in the administration back-end ###

  * **Image row count**: 1
  * **Image column count**: 1
  * **Alignment on page**: right
  * **Slideshow delay (in ms)**: 4000
  * **Autostart slideshow**: yes
  * **Navigation bar**: top
  * **Navigation trigger**: mouseover
  * **Image caption visibility**: always

### Description and live example ###

{sigplus rows=1 cols=1 alignment=right lightbox\_slideshow=4000 lightbox\_autostart=1 rotator\_navigation=top rotator\_trigger=mouseover caption\_visibility=always}margaret{/sigplus}

This example shows up as a gallery with one row and one column, on the right side of the page. The slideshow control button also appears in the pop-up window, but there is no need to press the button because the slideshow starts automatically and shows the next image after 4 seconds. The navigation bar for the image rotator displays on the top. Moving the mouse pointer over the control links causes the rotator to start advancing. Image captions can always be seen, not only when the mouse pointer moves over the previews.

### Usage in article text ###

<pre>
{gallery rows=1 cols=1 alignment=right lightbox_slideshow=4000 lightbox_autostart=1<br>
rotator_navigation=top rotator_trigger=mouseover caption_visibility=always}myfolder{/gallery}</pre>