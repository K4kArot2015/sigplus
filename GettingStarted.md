# Getting started #

The sigplus package installs the following extensions:
  * The sigplus [content plug-in](GettingStarted#Content_plug-in.md) (`plg_content_sigplus`) is the heart of sigplus and contains all necessary files for sigplus to be fully operational. Once `plg_content_sigplus` has been installed and enabled, you can use the content plug-in by typing gallery activation tags in content items. All other sigplus extensions require `plg_content_sigplus` to be installed and enabled, or they will trigger an error message otherwise.
  * The sigplus module (`mod_sigplus`) is a supplement to the sigplus content plug-in that allows you to have a sigplus gallery in a module position without using the activation tag.
  * The sigplus [search plug-in](GettingStarted#Search_plug-in.md) integrates a new search criterion _Images_ into standard Joomla site search.
  * The sigplus [editor button plug-in](GettingStarted#Editor_button_plug-in.md) adds a new button to your Joomla editor that lets you embed a sigplus activation tag using a dialog interface.

## Content plug-in ##

The sigplus content plug-in generates image galleries in place of activation tags (e.g. `{gallery}myfolder{/gallery}`) embedded in the text of articles.

### Quick start ###

Below you find a step-by-step guide for using the sigplus content plug-in once the sigplus extension package has been installed with Joomla 1.6 and later.

  * Log in to the Joomla administration back-end.
  * Open the menu _Extensions_ and choose _Plug-in Manager_.
  * Select type _content_ from the drop-down list in the top right corner of the page.
  * Find _Content - Image gallery - sigplus_ in the list. Click the red marker in the column _Enabled_, which will turn into a green marker with a tick.
  * Open the menu _Content_ and choose _Media Manager_.
  * Type `myfolder` next to the button _Create Folder_ in the bottom part of the page and press the button. A new folder called `myfolder` will appear in the _Files_ panel.
  * Click the folder icon `myfolder`. The folder should be empty.
  * Click _Browse…_ in the bottom part of the page and select an image file (with extension `.jpg`, `.png` or `.gif`) on your local computer. Be careful not to choose a huge file of several megabytes. Click _Start upload_. After a short while, the image file should appear in the folder. Repeat as necessary with some other files.
  * Open the menu _Content_ and choose _Article Manager_. Click the title of an existing article to open it.
  * Type the following (do not copy-and-paste from here) into the editor: `{gallery}myfolder{/gallery}`.
  * Click _Save_. When the article is shown in the front-end, an image gallery will be displayed in place of `{gallery}myfolder{/gallery}`.

## Search plug-in ##

The sigplus search plug-in integrates a new search criterion _Images_ into standard Joomla site search.

In the administration back-end, click _Extensions_, then _Plug-in Manager_, and select type _search_ from the drop-down list in the top right corner of the page, and finally enable _Search - Image gallery - sigplus_.

In order to test the search plug-in, add a search module to the site front-end if you do not already have one, and type a phrase into the search box, and see how image results are included in the search results. Image search looks in image filename, title and
description.

## Editor button plug-in ##

In the administration back-end, click _Extensions_, then _Plug-in Manager_, and select type _editor-xtd_ (editor extender) from the drop-down list in the top right corner of the page, and finally enable _Button - sigplus_.

Open any article in _Article Manager_ and the sigplus editor button
(with label _sigplus_) should appear below the editor text area.

The sigplus editor button requires the sigplus content plug-in to be enabled.