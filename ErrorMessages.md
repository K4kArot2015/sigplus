# Text format exceptions #

#### SIGPLUS\_EXCEPTION\_TEXTFORMAT ####

**Text files are assumed to be plain text with UTF-8 character encoding but _textfile_ uses a different format or encoding.**

The `labels.txt` file used to attach captions to individual images contains international characters outside the [ASCII](http://en.wikipedia.org/wiki/ASCII) character set. You should either remove these characters (typically accented characters or certain punctuation characters) or save your file in [UTF-8](http://en.wikipedia.org/wiki/UTF-8) encoding. In the open-source editor [Notepad++](http://notepad-plus-plus.org/) for Windows, for instance, this can be done by opening the menu _Encoding_ and selecting _Convert to UTF-8 without BOM_.

# Configuration exceptions #

#### SIGPLUS\_EXCEPTION\_FOLDER\_BASE ####

**The image base folder specified in the administration back-end is expected to be a relative path w.r.t. the Joomla root or an absolute path but _value_ appears to be neither of them.**

The image base folder is the folder you specify on the sigplus plug-in configuration page in the administration back-end. An example is `images`, which corresponds to the usual article image folder of a Joomla 1.6+ installation. Another important related term is the image source folder, which is the folder you specify with the activation tag syntax `{gallery}_folder_{/gallery}`. An example is `birds`, which is set with `{gallery}birds{/gallery}`. When looking for images to display, sigplus concatenates the base folder and the source to get the folder where the images are (and prefixes it with the Joomla root folder if necessary). This means that the image base folder should be a valid, existing folder on its own.

#### SIGPLUS\_EXCEPTION\_SOURCE ####

**Image source is expected to be a full URL or a path relative to the image base folder specified in the back-end but _value_ is neither a URL nor a relative path to an existing file or folder.**

The folder specified on the module back-end configuration settings page that sigplus draws images to display from does not exist in the file system or sigplus has insufficient permissions to get a listing of files in this folder. Make sure the folder is valid and is accessible to Joomla, which typically means UNIX permissions 755.

#### SIGPLUS\_EXCEPTION\_FOLDER\_INVALID ####

**The folder for _type_ specified in the administration back-end is expected to be a relative path w.r.t. the image folder but _value_ does not appear to be one.**

The folders for thumbnails, medium-sized image previews, high-resolution image variants and watermarked images must all be valid folder names, with characters accepted by the operating system. It is best to use (unaccented) letters, digits and underscored only.

#### SIGPLUS\_EXCEPTION\_FOLDER\_CONFLICT ####

**Folders for different types of generated images must be all different, but currently at least two of them are set to _value_.**

The folders for thumbnails, medium-sized image previews, high-resolution image variants and watermarked images must all be different to avoid file name clashes (i.e. to prevent a thumbnail overwriting a preview image).

#### SIGPLUS\_EXCEPTION\_ENGINE ####

**The current combination of configuration settings requires the _engine_ _enginetype_ engine, which is not available.**

The current configuration expects a lightbox, rotator or caption engine that is not available in the system. Please check if you have accidentally mistyped the engine name or have removed the engine files from the folder `/plugins/content/sigplus/engines`.

#### SIGPLUS\_EXCEPTION\_LIBRARY ####

**This operation expects the PHP extension _library_ to be enabled in the PHP configuration, please consult your server administrator.**

There are several PHP extensions sigplus relies on to make certain services available. For instance, Picasa web album support requires HTTP URL wrappers. Should this extension be missing or disabled in the PHP configuration (`php.ini`), sigplus cannot download Picasa web album feeds and cannot build a gallery of images stored in Picasa albums. Other services that do not require HTTP URL wrappers, however, will operate normally.

[Graphics Draw](http://www.php.net/manual/en/book.image.php) (gd) and [ImageMagick](http://www.php.net/manual/en/book.imagick.php) (imagick) are two notable PHP extensions for image processing sigplus uses to generate preview images and thumbnails. If none of these are available, you will not be able to have thumbnail, preview and watermarked image automatically generated. Given that these are essential to seamless operation, contact your server administrator on how to have one of these libraries enabled.

#### SIGPLUS\_EXCEPTION\_BASEURL ####

**Unable to deduce image base URL from the current configuration settings, please specify an explicit base URL in the back-end.**

If you have set an absolute base folder that is outside the Joomla root folder, sigplus cannot determine automatically (partially for security reasons) the URL to prefix image relative URLs with. You must supply an explicit value for the base URL in the administration back-end.

# File system exceptions #

#### SIGPLUS\_EXCEPTION\_ACCESS ####

**Insufficient file system permissions to access the file or folder _file_.**

Please check whether sigplus has proper file system permissions on the file or folder to read its contents, which typically means UNIX permissions 644 for files and 755 for folders.

#### SIGPLUS\_EXCEPTION\_CREATE ####

**Insufficient file system permissions to create the file or folder _file_.**

sigplus was trying to create a subfolder, usually for preview images or thumbnails, but it does not have sufficient rights so that this can be performed. Please make sure the parent folder has the right permissions, which typically means UNIX permissions 755.

# Miscellaneous #

#### SIGPLUS\_EXCEPTION\_MEMORY ####

**Insufficient memory to carry out an operation on _file_, _required_ bytes required, _available_ bytes available.**

When generating preview images and thumbnails, the original image has to fit into the memory available on the server. Most image formats used on the web are compressed images (e.g. GIF, JPEG or PNG images), which have to be decompressed before they could be processed. If Joomla is not allocated enough server-side memory to store the actual image, image generation fails.

Do not be deceived by raw file size when judging the amount of memory required to have a GIF, JPEG or PNG image re-scaled on the server. These image formats use efficient compression schemes that can reduce the file size to a fraction of the true image size (width × height × color depth). In order for sigplus to re-scale an image, however, it has to perform a decompression, and sufficient memory must be available to store each pixel of the decompressed image.

As a solution to eliminate the error message, you are recommended either to increase server-side memory, or resize your images before you upload them to the image gallery folder. Usually, images intended for the web rarely need a resolution multiple times the size of a regular display, which a normal digital camera would take.

#### SIGPLUS\_EXCEPTION\_URLENCODING ####

**URLs are assumed to have been URL-encoded but the URL _url_ appears to have an invalid character.**