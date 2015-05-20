# Basic syntax #

By typing

<pre>{gallery}imagefolder{/gallery}</pre>

into the body of an article (content item), the plug-in will automatically produce previews of all the images in the folder `/images/`_`imagefolder`_. Clicking on any of the preview images will bring up a pop-up window. For example, type the following into the body of an article:

<pre>{gallery}sampledata/parks/landscape{/gallery}</pre>

The extension will produce a gallery of all the images drawn from the folder `/images/sampledata/parks/landscape`.

sigplus galleries can be configured globally (in the administration back-end) as well as locally (within content item text). Local settings are attached to the `{gallery}` marker as key-value pairs, e.g.

<pre>{gallery maxcount=4}sigplus/birds{/gallery}</pre>

When present, local parameters override global settings, e.g. `{gallery preview-width=100}sigplus/birds{/gallery}` overrides the default preview image width.

The syntax for the activation tag attribute list is very flexible. The following attribute lists are all equivalent:

<pre>
{gallery preview-width=300 preview-height=200}birds{/gallery}<br>
{gallery preview_width=300 preview_height=200}birds{/gallery}<br>
{gallery preview-width="300" preview-height="200"}birds{/gallery}<br>
{gallery preview-width='300' preview-height="200"}birds{/gallery}<br>
{gallery preview-width=|300| preview-height=|200|}birds{/gallery}</pre>

Observe how the syntax permits exchanging hyphens (`-`) with underscores (`_`) as name component separators, and double or single quote characters (`'` and `"`) with the vertical bar character (`|`) as delimiters. Attribute values that comprise of more than one word must always be delimited to avoid ambiguity.

# Wildcard patterns #

sigplus can interpret more complex wildcard expressions like `*.jpg` in the path expression between the activation opening and closing tag. Two special wildcard characters are understood, inspired by operating system pattern matching:
  1. `*` matches zero or more characters, and
  1. `?` matches a single character.

The following example demonstrates how wildcard pattern matching works. The example will match any file whose name contains the word `australia` at any location within the file name component.

<pre>
{gallery id=parks}sampledata/parks/landscape/*australia*{/gallery}</pre>

Wildcard patterns are understood only in the file name component of the path. When sigplus encounters a path with a special wildcard character, the path is split into a directory component (e.g. `sampledata/parks/landscape`) and a pattern component (e.g. `*australia*`). The pattern will act as a filter on files in the directory.

Wildcard expressions are supported for only those galleries that are backed by the same file system where Joomla is running (local file system).

# User name substitution #

For logged-in users, sigplus can substitute the user name in the image source reference. Use

<pre>
{gallery}users/{$username}/images{/gallery}</pre>

to have the log-in name of the current user be substituted in place of `{$username}`. Galleries created with such activation tags are accessible to registered users only, anonymous users are prompted an access forbidden message.

# Activating the lightbox #

Occasionally, you do not need to have sigplus generate a possibly rotating gallery of images drawn from a particular folder but you would like to associate a pop-up window with a link targeted at an image or another resource. In order to cope with these situations, sigplus offers the possibility to directly invoke the pop-up window on a mouse click event associated with an anchor (HTML `<a>`).

Create a lightbox-powered link to
  * a local image: `{lightbox href=birds/owl.jpg}Owl{/lightbox}`
  * an external image: `{lightbox href=http://www.google.com/logos/2010/hungarynationalday2010-ps.jpg title="October 23"}Hungary, 1956{/lightbox}`

Create an anchor to an existing gallery (previously created with `{gallery}`)
  * linking to the first image: `{lightbox link=parks}A gallery{/lightbox}`
  * linking to the specified image: `{lightbox link=parks index=3}A gallery{/lightbox}`

Make all anchors that meet a selector criterion lightbox-powered anchors:
  * associate with all links whose `href` attribute ends in the extension `.jpg`: `{lightbox selector=|a[href$=.jpg]| /}`
  * associate with all links whose `rel` attribute equals `lightbox`: `{lightbox selector=|a[rel=lightbox]| /}`

The selector can be an arbitrary CSS selector understood by the MooTools function [Element.getElements](http://mootools.net/docs/core/Element/Element#Element:getElements).