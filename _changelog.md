Nov 24, 2020 - version 0.2.1
============================

* Search results
** The h1 class was post__title, which conflicted with the actual titles of the displayed posts. Changed this to u-pageTitle archives__title.
** Also noticed that the Search page title had a header tag around it—removed that to get it to match the other templates.
** Added a cfg() variable, SEARCH__PAGETITLE, to modify the search title.

* inc/site-title.php
** Replaced some hardcoded links to the SVG logo and include with cfg() values

* functions.php
** Added the new, more reliable cfg() function I wrote for vassar-parent
** Gutenberg font sizes: Replaced the four ludicrously large font sizes with a tasteful "intro" size
** Added custom image sizes
** Replaced a few instances of the old way of checking cfg variables - "if (CAT__USE_SPECIAL_DATE_FORMAT)" - with the new, better way: "if (cfg('CAT__USE_SPECIAL_DATE_FORMAT'))".

* content.php
** Replaced a lot of if(CFG_SETTING) with if(cfg(CFG_SETTING))

* footer.php
** Replaced a lot of if(CFG_SETTING) with if(cfg(CFG_SETTING))

* header.php
** Removed hardcoded link to stylesheet that isn't there anymore


June 8, 2020 - version 0.1
==========================

* Changed the existing cfg() function with the more versatile one from Vassar Parent. Note: the old cfg() returned the value of a setting without an additional parameter. You might need to replace something like cfg('POST__FEATUREDIMAGE_ShowForThese') with cfg('POST__FEATUREDIMAGE_ShowForThese', true).

* In inc/site-title.php:
** Updated it with calls to the new cfg()
** A path to the CSI SVG logo was hardcoded in this. I changed that to have it pull in a file specified in HEADER__USE_INCLUDE instead.

* functions.php:
** Set up Gutenberg overrides section. First function in there removes the standard font sizes (the menu for paragraph blocks) and replaces them with a normal and Intro font-size.