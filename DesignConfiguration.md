# Configuration framework #

## Parameter stack ##

sigplus configuration is based on the concept of parameter stack. Initially, a single configuration object is pushed into the stack and each time a new configuration context is created, a new object is added on top of it. Unless overridden, the new object copies all properties of the topmost item in the stack.

The following contexts are in play when you use the sigplus content plug-in in an article:
  * settings as configured on the plug-in page in the administration back-end (global settings)
  * custom settings defined as key`=`value pairs, typed into the _Custom settings_ multiline text box on the plug-in page in the back-end
  * settings passed via key`=`value pairs in the activation start tag (local settings)

The following contexts are applicable when you use the sigplus module:
  * settings as configured on the _content plug-in page_ in the administration back-end
  * settings as configured on the module page in the back-end
  * custom settings defined as key`=`value pairs on the module page in the back-end

Except for the very first context, which typically sets values for all possible parameters, subsequent contexts redefine only a subset of the parameters. In particular, you typically override settings for only a couple of parameters in the activation tag.

## Parameter types ##

Parameters fall into two categories. Regular parameters are implemented as public properties of the configuration object and are validated directly by sigplus. In contrast, parameters specific to a particular engine, e.g. a given lightbox, rotator or captions engine implementation, are passed almost unaltered (with appropriate type casting but without validation) to the JavaScript implementation of these engines.