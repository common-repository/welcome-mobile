=== Welcome! Mobile ===
Contributors: mladimatija
Tags: mobile, android, ios, welcome message, cookie
Requires at least: 3.5
Tested up to: 4.6
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Display a welcome message to users browsing your site on smartphones.

== Description ==

Display a welcome message to users browsing your site on smartphones. Choose between Android and iOS or use a default message for all mobile platforms. You can either use built-in visual editor or output your own HTML code.

* Choose between Android & iOS or use a default message for all mobile platforms.

* Message will be displayed every time user visits the site unless she clicks on the close button.

* Clicking the close button stores the cookie locally on users computer.

* Message will not be visible unless the cookie expires or gets deleted.

* Translation ready.


Head over to Support section or visit the [GitHub](https://github.com/mladimatija/Welcome-Mobile) project page for support for this plugin.


== Installation ==

1. Upload `welcome-mobile.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Adjust your settings in Settings > Welcome! Mobile

== Frequently Asked Questions ==

= How does Welcome! Mobile detect mobile devices? =

[mobiledetect](http://mobiledetect.net/) PHP library is used for detecting mobile devices. Currently users can set up a different messages depending on which platform visitor uses to visit your site (Android or iOS) or use a default welcome message for all devices.

= How does Welcome! Mobile store cookies? =

[JavaScript Cookie](https://github.com/js-cookie/js-cookie) is used for handling the cookie which is created when the user clicks on the close button. By default cookie is valid for 20 days if the user hasn't set a expiration date.
= How can I style the welcome message? =

You can use "Custom CSS" field at the bottom of the options page to style your message which will output in the <head> section of the site.


== Screenshots ==

1. Welcome! Mobile Settings page. Pretty simple and self-explanatory.

== Changelog ==

= 1.1.1 =
* Added compatibility with the latest WordPress version (4.6 at the time of release).

= 1.1 =
* Added compatibility with the latest WordPress version (4.4.1 at the time of release).
* Updated mobiledetect library to the latest version.
* Added an option to output custom CSS and JavaScript.
* Rewrote the plugin using the WordPress Plugin Boilerplate as a base.

= 1.0 =
* Initial release.

