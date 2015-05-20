Information on this page applies to sigplus 1.5.x and later. For specifics regarding sigplus 1.4.x, the latest production version to date, refer to its [documentation](http://hunyadi.info.hu/levente/en/sigplus/settings).

# Custom preview image styling #

If you do not like the way image previews are displayed, you can use CSS styling to customize it. The folder `/media/sigplus/css` contains the stylesheet file `sigplus.css`, which all image galleries use. You can change, among others, image margin (spacing outside border), border and padding (spacing inside border).

(You might notice that the folder also contains another file `sigplus.min.css`, which is a minified file automatically generated when the extension is installed. Since `sigplus.min.css` does not contain comments or whitespace, it takes shorter to download, and is therefore used by sigplus unless _Client debug mode_ is active. If sigplus detects `sigplus.css` has been modified since `sigplus.min.css` was generated, it will always use `sigplus.css` instead.)

The example below applies a border, changes margin to 6 pixels and padding to 4 pixels.

```css

.sigplus-gallery ul > li > div > img,
.sigplus-gallery ul > li > div > a > img,
.sigplus-gallery ul > li > div > .captionplus > img,
.sigplus-gallery ul > li > div > .captionplus > a > img {
border:1px solid gray !important;
margin:6px !important;
padding:4px !important;
}```

The `!important` rule forces style application even if a conflicting rule would occur in your Joomla template. Without `!important`, the style you set in `sigplus.css` may be overriden by the stylesheet of the template you use, which is included after `sigplus.css`, possibly leading to unexpected appearance.

The CSS selectors have the following semantics:
  * `.sigplus-gallery ul > li > div > img` and `.sigplus-gallery ul > li > div > a > img` are used when the preview image has no caption. The selectors with `.captionplus` are applied to images with a caption.
  * `.sigplus-gallery ul > li > div > img` and `.sigplus-gallery ul > li > div > .captionplus > img` are used when the image has no lightbox or external target URL associated with it. In contrast, `.sigplus-gallery ul > li > div > a > img` and `.sigplus-gallery ul > li > div > .captionplus > a > img` apply when clicking the image opens a lightbox or takes you to another location.

The example below illustrates more advanced usage. It will apply a gray border around thumbnail images, which changes to red when the user moves the mouse over an image. Each image cell is then surrounded by a blue border.

```css

.sigplus-gallery ul > li > div > img,
.sigplus-gallery ul > li > div > a > img,
.sigplus-gallery ul > li > div > .captionplus > img,
.sigplus-gallery ul > li > div > .captionplus > a > img {
border:thin solid gray !important;
margin:2px !important;
padding:2px !important;
}
.sigplus-gallery ul > li > div > a:hover > img,
.sigplus-gallery ul > li > div > .captionplus > a:hover > img {
border:thin solid red !important;
}
.sigplus-gallery > ul > li {
display:inline-block !important;
margin:4px !important;
border:0 none transparent !important;
padding:2px !important;
background:transparent none no-repeat scroll 0 0 !important;
text-align:center !important;
}```