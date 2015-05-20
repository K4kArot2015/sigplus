Information on this page applies to sigplus 1.5.x and later. For specifics regarding sigplus 1.4.x, the latest production version to date, refer to its [documentation](http://hunyadi.info.hu/levente/en/sigplus/settings).

# Introduction #

A central notion to sigplus is image captions. The term _caption_ may refer to
  * short image title or
  * summary text.

The title, which is usually a few words long, will typically appear
  * directly on the page, either in an overlay caption, or above or below preview images, and
  * inside the lightbox pop-up window as a window title, in a distinctive position.
  * as alternate text for the `img` element in the generated HTML content (to help search engines identify images)

In contrast, the summary text, which is usually a sentence long, will appear below or next to the magnified image within the lightbox pop-up window.

The following all act as sources for image captions (in decreasing order of precedence):
  1. an explicit entry in a `labels.txt` file
  1. image metadata (IPTC and EXIF)
  1. default caption set via a `labels.txt` file with a wildcard pattern containing `?` and `*`
  1. default caption specified in the back-end

This implies that if you use no external labels file (`labels.txt`) to attach captions to images or the caption is missing, sigplus will use IPTC tags _Headline_ and _Caption-Abstract_ to label images. Metadata are extracted from the APP13 IPTC block. The implementation uses the PHP function [iptcparse](http://php.net/manual/en/function.iptcparse.php). This function is known to fail, thereby not returning any metadata whatsoever, if the image contains non-standard proprietary tags added by commercial applications (e.g. Photoshop). These software can usually be configured in such a way as to restrict the tags added to images to those in the standard set.

# Labels file #

A labels file (typically called `labels.txt`) is a plain text file in the image folder with a three-fold function:
  1. binds a short title and summary text to images,
  1. defines a relative order of images in the gallery, and
  1. associates default captions with wildcard patterns.

Image file name, title and summary in `labels.txt` are separated by a `|` (vertical bar).

A sample `labels.txt` is shown below:
<pre>
example.png|An image title|A longer, more verbose description.<br>
example.jpg||A description that may contain <em>html formatting<br>
<br>
Unknown end tag for </em><br>
<br>
.<br>
apple.jpg|A ripe apple|This apple not only looks great but tastes just as good.<br>
bunny.jpg|A cute bunny|This terra-cotta bunny has been laser-scanned at Budapest University of Technology.<br>
example.jpg<br>
*|Default title|Default summary text for <a href="http://hunyadi.info.hu/projects/sigplus/">sigplus<br>
<br>
Unknown end tag for </a><br>
<br>
</pre>

As shown in the example, both title and summary are optional. Similarly to the back-end where you can specify a default title and summary  associated with images that do not have an explicitly assigned title and summary or image metadata, a `labels.txt` file has the special entry `*`. Whenever an item has no title or summary, the default will be assigned.

## Wildcard patterns ##

sigplus can interpret more complex wildcard expressions like `*.jpg`, which act as fall-back patterns. Two special wildcard characters are understood, inspired by operating system pattern matching:
  1. `*` matches zero or more characters, and
  1. `?` matches a single character.

Whenever an image lacks a title or summary, sigplus tries to match the file name against wildcard expressions from top to bottom: the first pattern that matches assigns the associated title or summary to the image. This implies that it makes sense to put the most general pattern (typically a single `*` entry) last.

In order to illustrate how the wildcard matching mechanism works, consider the following example:

<pre>
*.jpg|A photo|A photograph taken with a digital camera.<br>
car*|A car|A Porsche model.<br>
*|Default title|Default summary text.<br>
*.png|A graphic image</pre>

sigplus will make the following assignments to image titles based on the above `labels.txt` file:
  1. The file `car.jpg` matches `*.jpg` and will be assigned the title _A photo_. Even though `car.jpg` would also match `car*`, that pattern has lower priority.
  1. `car.png` does not match `*.jpg` but matches `car*` and thus will have the title _A car_.
  1. `cat.png` matches neither of the first two patterns, it will get the default title.
  1. No file will match the pattern `*.png` because the pattern `*` has higher precedence.

Entries without wildcard characters always take precedence over entries with wildcards, regardless of their position in `labels.txt`.

## Multilingual support ##

Labeling supports multilingual sites. If multilingual support is enabled in the administration panel and a file `labels.xx-XX.txt` exists in a folder, where `xx-XX` is the placeholder for the ISO language code, e.g. `en-GB` for English (United Kingdom) or `hu-HU` for Hungarian, the language-specific labels file is used, with fallback to the default `labels.txt`.

## Encoding ##

All label files are assumed to be UTF-8 encoded. (If you use English characters only, your text automatically qualifies as UTF-8.) For Windows, the editor [Notepad++](http://notepad-plus.sourceforge.net/) has the option _Convert to UTF-8 without BOM_ in the _Format_ menu. sigplus can also recognize and remove the redundant byte-order mark (BOM) inserted by the default Windows text editor Notepad at the beginning of a UTF-8 encoded file.

# Caption templates #

In addition to caption and default caption, sigplus has a notion (and
configuration parameter) of _caption templates_ referred to as _Image title template_ and _Image summary template_ in the back-end. A template is a format-description text with special semantics, including placeholders like `{$text}`, `{$filename}`, `{$count}` and `{$total}`, which define how a caption is formatted when it appears as an image label. The placeholder semantics are as follows:
  * `{$text}` is substituted with the caption text, either explicitly specified using a `labels.txt` file or extracted from image metadata, or the default caption as specified in the configuration.
  * `{$current}` and `{$total}` are substituted with the ordinal number of the image in its gallery and the total number of images in the gallery, respectively.
  * `{$filename}` is substituted with the image file name without path.

An insightful example is as follows:

Back-end settings:
  * Image title template: `{$text} ({$count} of {$total})`
  * Default image title: `Unidentified fruit`

`labels.txt` contents:
<pre>
cherry.jpg|Three cherries|Some cherries in my fruit collection.<br>
pears.jpg|Two pears|A few pears in my fruit collection.<br>
strawberry.jpg|A strawberry|A strawberry in my fruit collection.</pre>

Folder directory listing:
<pre>
cherry.jpg<br>
pears.jpg<br>
peas.jpg<br>
strawberry.jpg</pre>

Formatted caption for each file:
  * Three cherries (1 of 4)
  * Two pears (2 of 4)
  * Unidentified fruit (3 of 4)
  * A strawberry (4 of 4)

# BBCode #

Default image title, default image summary, image title template and image summary template support BBCode (bulletin board code). [BBCode](http://en.wikipedia.org/wiki/BBCode) is a lightweight markup language used to format posts in many message boards. With BBCode markers in captions and caption templates, you can apply a subset of HTML formatting styles to title and summary text, getting around Joomla security measures that prohibit the direct use of HTML in many places, including back-end configuration settings. The following BBCode markers are supported:
  * `[b]bold[/b]`, which maps to **bold** (HTML `<b>bold</b>`);
  * `[i]italic[/i]`, which maps to _italic_ (HTML `<i>italic</i>`);
  * `[u]underline[/u]` (HTML `<u>underline</u>`);
  * `[s]strikeout[/s]`, which maps to ~~strikeout~~ (HTML `<s>strikeout</s>`);
  * `[sup]superscript[/sup]`, which maps to <sup>super</sup>script (HTML `<sup>superscript</sup>`);
  * `[sub]subscript[/sub]`, which maps to <sub>sub</sub>script (HTML `<sub>subscript</sub>`);
  * `[url]http://hunyadi.info.hu/projects/sigplus/[/url]` and `[url=http://hunyadi.info.hu/projects/sigplus/]link[/url]`, which map to http://hunyadi.info.hu/projects/sigplus/ and [link](http://hunyadi.info.hu/projects/sigplus/), respectively.

In addition, linefeed characters are automatically converted into line breaks (HTML `<br/>`).