Information on this page applies to sigplus 1.5.x and later. For specifics regarding sigplus 1.4.x, the latest production version to date, refer to its [documentation](http://hunyadi.info.hu/levente/en/sigplus/settings).

# Engine-specific settings #

While part of generating a gallery takes place on the server, much of the dynamic behavior is implemented with JavaScript files, executed directly in the browser. sigplus ships with several pop-up window, rotator and overlay caption engines, and these are activated by choosing a particular engine in the administration back-end.

Each engine typically consists of a stylesheet file (extension `.css`) and a script file (extension `.js`), which govern its appearance and behavior, respectively. These are to be found inside the directory `/media/sigplus/engines/`. For instance, images arranged in a rotator may dim when the mouse cursor is not positioned over an image and is controlled by a pair of stylesheet rules as follows:

```
.slideplus-active {
opacity:1;
}

.slideplus-inactive {
opacity:0.5;
}
```

Likewise, engines have parameters that control dynamic behavior. For instance, the rotator has parameters that tell whether it wraps around at the end, how fast it scrolls and how much it acceleates when you hold down the mouse button near the edges for a speed-scroll. Some of these parameters can be configured in the back-end, such as whether the rotator wraps around, others, however, do not have a direct user interface. There is always a compromise between making a software easy to use and offer a high degree of versatility. The developer has opted to make the most popular settings available in the back-end, and use the parameter mechanism to let expert users access advanced features.

To attach engine-specific parameters to a particular gallery instance, add an engine type qualifier before the parameter name:

```
{gallery lightbox:protection=true rotator:scrollspeed=500 caption:horzalign=start}fruit{/gallery}
```

As the example shows, engine-specific parameters begin with the word `lightbox`, `rotator` or `caption`, and are followed by a colon and a parameter name. Such parameters are passed unaltered to the engine implementation, they are not processed directly by sigplus.

Below you find parameters applicable to the family of products maintained and developed as part of sigplus. You should consult the respective documentation on what parameters are accepted by third-party engines like [Fancybox](http://fancybox.net/api) or [Slimbox](http://www.digitalia.be/software/slimbox#usage).

Advanced users' note: Type conversions apply when interpreting parameter values. Values that comprise of digits are converted into type integer, other numeric values are converted into type float, and the rest are marshaled as type string. Parameters are passed to implementations as a JSON object.

The type specification for each parameter complies with [Annotating JavaScript for the Closure Compiler](http://code.google.com/closure/compiler/docs/js-for-compiler.html).

## boxplus ##

boxplus is the pop-up window (lightbox) implementation native to sigplus.

### theme ###

Pop-up window theme. If set, stylesheets that have a `title` attribute starting with `boxplus` but with a different ending than specified will be disabled. This lets you use multiple boxplus themes on a single page. As an example, consider the following excerpt taken from the `<head>` section of an HTML page:

```
<link rel="stylesheet" href="/media/sigplus/engines/boxplus/css/boxplus.lightsquare.css" type="text/css" title="boxplus-lightsquare" />
<link rel="stylesheet" href="/media/sigplus/engines/boxplus/css/boxplus.darksquare.css" type="text/css" title="boxplus-darksquare" />
<link rel="stylesheet" href="/media/sigplus/engines/boxplus/css/boxplus.lightrounded.css" type="text/css" title="boxplus-lightrounded" />
<link rel="stylesheet" href="/media/sigplus/engines/boxplus/css/boxplus.darkrounded.css" type="text/css" title="boxplus-darkrounded" />
```

In the example above, the value `darksquare` will enable the stylesheet `boxplus-darksquare` but disable all others, including `boxplus-darkrounded` and `boxplus-lightsquare`.

boxplus shipped with sigplus supports values `darkrounded`, `darksquare`, `lightrounded`, `lightsquare`.

This setting applies to the pop-up window.

**Type**: `{boolean|string`}

### navigation ###

Whether navigation controls are displayed.

This setting applies to the pop-up window.

**Type**: `{boolean`}

### autocenter ###

Whether to center pop-up windows smaller than browser window size within the browser viewport.

This setting applies to the pop-up window.

**Type**: `{boolean`}

### autofit ###

Whether to reduce images that would otherwise exceed screen dimensions to fit the browser window when they are displayed.

This setting applies to the pop-up window.

**Type**: `{boolean`}

### duration ###

Duration of animation sequences. Expects a value in milliseconds, or one of `short` or `long`.

This setting applies to the pop-up window.

**Type**: `{number|string`}

### transition ###

Easing equation to use for the transition effect. The easing equation determines the speed at which the animation progresses at different stages of an animation. Examples values include `sine`, `linear` and `bounce`. For a complete list of supported values see the MooTools framework object [Fx.Transitions](http://mootools.net/docs/core/Fx/Fx.Transitions).

This setting applies to the pop-up window.

**Type**: `{string`}

### protection ###

Whether to activate the client-side image protection feature. This feature suppresses the standard browser `contextmenu` and `dragstart` events so that a user cannot easily extract the image with conventional methods. Needless to say, such measures are completely ineffective against advanced users who can always extract the image from the browser cache or use developer page inspection tools like Firebug.

This setting applies to the pop-up window.

**Type**: `{boolean`}

### scrollspeed ###

Standard scroll speed for the thumbnail navigation bar. Measured in pixels per second.

This setting applies to the pop-up window.

**Type**: `{number`}

### scrollfactor ###

Scroll speed acceleration factor. The acceleration factor is a scroll speed multiplier when the user enters fast scroll mode. This is usually triggered by holding the mouse button depressed when the cursor is positioned near the edge of the thumbnail navigation bar.

This setting applies to the pop-up window.

**Type**: `{number`}

### width ###

Default width if no width is specified or can be derived. This value is used when displaying a resource that has no inherent width, such as a PDF document.

This setting applies to the pop-up window.

**Type**: `{number`}

### height ###

Default height if no height is specified or can be derived. This value is used when displaying a resource that has no inherent height, such as a PDF document.

This setting applies to the pop-up window.

**Type**: `{number`}

### slideshow ###

Time spent viewing an image when slideshow mode is active, or 0 to disable slideshow mode.

This setting applies to a collection of images shown in the pop-up window.

**Type**: `{number`}

### autostart ###

Whether to start a slideshow when the dialog opens.

This setting applies to a collection of images shown in the pop-up window.

**Type**: `{boolean`}

### loop ###

Whether the image/content sequence loops such that the first image/content follows the last.

This setting applies to a collection of images shown in the pop-up window.

**Type**: `{boolean`}

### captions ###

Placement of captions. Takes the value `bottom` (below the image), `sideways` (next to the image) or `none`.

This setting applies to a collection of images shown in the pop-up window.

**Type**: `{string`}

### thumbs ###

Placement of thumbnail navigation bar. Takes the value `inside` (over the image), `outside` (in the caption area) or `none`.

This setting applies to a collection of images shown in the pop-up window.

**Type**: `{string`}

### cloak ###

Whether to cloak anchor URLs. Cloaked anchors will not reveal the target image URL when the user positions the mouse cursor over the image. Cloaking URLs also prevents other javascript code from reading the anchor `href` attribute.

This setting applies to a collection of images shown in the pop-up window.

**Type**: `{boolean`}

## slideplus ##

slideplus is the rotator implementation native to sigplus.

### size ###

Determines the tiling of images on the slider strip. Accepts a JSON object like as shown below:
```
{ 'rows': 1, 'cols': 3 }
```

### step ###

Unit the slider advances in response to navigation buttons _Previous_ or _Next_. Takes a value of `single` or `page`.

**Type**: `{string`}

### loop ###

Whether the rotator loops around in a circular fashion.

**Type**: `{boolean`}

### orientation ###

Orientation of sliding image strip. Takes a value of `horizontal` (the slider moves left-to-right or right-to-left) or `vertical` (the slider moves top-to-bottom or bottom-to-top).

**Type**: `{string`}

### horzalign ###

Horizontal alignment of current image in sliding image strip. Takes a value of `center`, `start` or `end`. The values `start` and `end` are relative to the document reading order, e.g. for languages with left-to-right reading order, `start` corresponds to alignment to the left edge and `end` corresponds to alignment to the right edge.

**Type**: `{string`}

### vertalign ###

Vertical alignment of current image in sliding image strip. Takes a value of `center`, `start` or `end`.

**Type**: `{string`}

### navigation ###

Position where navigation controls are displayed. Accepts a combination of `top`, `bottom` and `over` or a Boolean value of `false`.

**Type**: `{(Array.<string>|boolean)`}

### trigger ###

Action to trigger advancing the slider using navigation buttons _Previous_ or _Next_. Takes a value of `click` or `mouseover`.

**Type**: `{string`}

### links ###

Whether to show navigation links.

**Type**: `{boolean`}

### counter ###

Whether to show page counter.

**Type**: `{boolean`}

### edges ###

Edge effect. Possible values are `none` and `fade`.

**Type**: `{string`}

### duration ###

Duration of animation sequences. Expects a value in milliseconds, or one of `short` or `long`.

**Type**: `{number|string`}

### transition ###

Easing equation to use for the transition effect. The easing equation determines the speed at which the animation progresses at different stages of an animation. Examples values include `sine`, `linear` and `bounce`. For a complete list of supported values see the MooTools framework object [Fx.Transitions](http://mootools.net/docs/core/Fx/Fx.Transitions).

**Type**: `{string`}

### protection ###

Whether to activate the client-side image protection feature. This feature suppresses the standard browser `contextmenu` and `dragstart` events so that a user cannot easily extract the image with conventional methods. Needless to say, such measures are completely ineffective against advanced users who can always extract the image from the browser cache or use developer page inspection tools like Firebug.

**Type**: `{boolean`}

### delay ###

Time between successive automatic slide steps. Use a millisecond value, or `false` to disable automatic sliding.

**Type**: `{number|boolean`}

### scrollspeed ###

Standard scroll speed for the thumbnail navigation bar. Measured in pixels per second.

**Type**: `{number`}

### scrollfactor ###

Scroll speed acceleration factor. The acceleration factor is a scroll speed multiplier when the user enters fast scroll mode. This is usually triggered by holding the mouse button depressed when the cursor is positioned near the edge of the thumbnail navigation bar.

**Type**: `{number`}