=== Presentation ===

Created by Sean Davis: http://seandavis.co/ - http://buildwpyourself.com/

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html



== Description ==

A clean and simple theme designed with minimal distractions to make your content the most important element on any given page. Social networking links are easily implemented along with two appropriately styled nav menus. A post footer is built automagically based on your user information and theme customizer settings. Full support for bbPress and Easy Digital Downloads takes your site to the next level.



== Installation ==

1. Upload `presentation` to the `/wp-content/themes/` directory
2. Activate the theme through the 'Themes' menu in WordPress
3. Use the Theme Customizer settings under "Appearance -> Customize" to adjust Presentation's settings



== Frequently Asked Questions ==

= Does this theme support child themes? =

Certainly! Here's exactly what you need to do.

1. Through FTP, navigate to `your_website/wp-content/themes/` and in that directory, create a new folder as the name of your child theme. Something like `presentation-child` is perfectly fine.

2. Inside of your new folder, create a file called `style.css` (the name is NOT optional).

3. Inside of your new `style.css` file, add the following CSS:

. . . . . . . . . . copy what's below . . . . . . . . . . . . 


	/*
		Theme Name: your_child_theme_name
		Author: your_name
		Author URI: 
		Description: Child theme for Presentation
		Template: presentation
	*/
	
	@import url("../presentation/style.css");
	
	/*--------------------------------------------------------------
	Theme customization starts here
	--------------------------------------------------------------*/


. . . . . . . . . . copy what's above . . . . . . . . . . . . 

4. You may edit all of what you pasted EXCEPT for the `Template` line as well as the `@import` line. Leave those two lines alone or the child theme will not work properly.

5. With your new child theme folder in place and the above CSS pasted inside of your `style.css` file, go back to your WordPress dashboard and navigate to "Appearance -> Themes" and locate your new theme (you'll see the name you chose). Activate your theme.

6. With your child theme activated, you can edit its stylesheet all you like. You may also create a `functions.php` file in the root of your child theme to add custom PHP.

7. Enjoy!

= Can I override template files? =

Yup. Any of the template files in the root of Presentation can be copied to the root of your child theme (see above) and WordPress will use the child theme's file's instead. This also applies to template files inside of the `content` folder.



== Credits ==

Presentation WordPress Theme, Copyright (C) 2014 Sean Davis - SDavis Media LLC
Presentation is distributed under the terms of the GNU GPL
Presentation is based on Underscores http://underscores.me/, (C) 2012-2014 Automattic, Inc.

Font Awesome http://fortawesome.github.io/Font-Awesome/license/
Font Awesome Licenses:	SIL Open Font License http://scripts.sil.org/OFL 
						MIT License http://opensource.org/licenses/mit-license.html 
						CC BY 3.0 License – http://creativecommons.org/licenses/by/3.0/
Copyright: Dave Gandy, http://fontawesome.io



== Changelog ==

= 1.1.4 =
* Tweaked: cleaner translation strings
* added: new langauge files (updated after translation string tweaks)

= 1.1.3 =
* Tweaked: user input sanitization for store front item count
* Tweaked: show search query in search field on search results page
* Tweaked: sidebar product info HTML markup on single downloads
* Fixed: only show posts in regular search results

= 1.1.2 =
* Added: custom menu fallback for both theme menus
* Added: theme and additional resource copyright 
* Tweaked: nav menu register functions combined 
* Tweaked: social profile links placed in custom function and hooked in place 
* Tweaked: $content_width setting to 690px 
* Fixed: unescaped values throughout theme files 
* Fixed: inaccurate text domain

= 1.1.1 =
* Tweaked: user input sanitization for theme customizer options

= 1.1.0 =
* Added: full support for bbPress

= 1.0.0 =
* first stable version