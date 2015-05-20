# Configuration settings #

This section summarizes possible global settings and local setting overrides for the sigplus plug-in, and module-specific settings for the sigplus module that can be set either in the administration back-end or (for the plug-in) with inline attributes.

As with other Joomla plug-ins, global settings can be changed in the administration back-end; from the menu, choose _Extensions/Plugin manager_ and click _Content – Image gallery – sigplus_ in the list. Local settings can override those set in the back-end using name-value pairs in the attribute list of the activation start tag:
<pre>
{gallery id=birds rows=2 cols=3<br>
preview-width=100 preview-height=100 preview-crop=1<br>
alignment=center rotator-orientation=horizontal<br>
caption-source=captions.txt}<br>
sigplus/birds<br>
{/gallery}<br>
</pre>

Likewise, in order to change module-specific settings for a sigplus module, choose _Extensions/Module manager_ from the menu and click the module whose settings to update (the name of the module is _sigplus_ by default).

Each of the entries is organized as follows:

**Name** (heading): The name serves as an identifier when changing the value of the configuration setting, and should be used in the plug-in activation tag attribute list to assign a new value to a setting. For instance, preview image width set to 200 in the back-end can be overridden with the local name-value pair `preview-width=100`. Note that underscores (`_`) may be replaced with hyphens (`-`) in configuration setting names.

**Back-end name**: The name under which you can find the configuration setting when you open the plug-in or the module configuration panel in _Extensions/Plugin manager_ or _Extensions/Module manager_.

**Type/value**: Type determines the range of possible values the setting can take:
  * _string_ is a series of characters,
  * _text_ is unstructured text possibly with newlines,
  * _html_ is unstructured text interspersed with inline HTML tags (e.g. `a`, `strong`, `em`, `span`) or BBCode,
  * the bracket syntax `[one|two|three]` indicates that the configuration setting accepts any one of the listed values `one`, `two` or `three`.

**Summary**: Summary is a short synopsis of what the parameter does, and lists the possible values it can take and what their effect is. This text is also shown as a tool-tip in the back-end when you move the mouse pointer over the label of a configuration setting.

**Details**: Further explanation and technical details on the configuration setting help effective usage. This text is typically not shown in the back-end.

**Example**: Examples illustrate how the attribute list syntax can be used in the activation tag. Applicable to plug-in only.

The comprehensive list of [all settings](BackendConfigurationSettings.md) you can configure in the administration back-end is recommended for further reading.