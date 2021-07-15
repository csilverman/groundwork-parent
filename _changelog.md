Does this work?

Jun 5, 2021 - version 0.5.1
===========================

## template-tags folder
* Added this for includes that contain template functionalities. A lot of those includes are currently in /inc; these will need to be moved in the future.

## content.php
* Moved all code for displaying a featured image into /template-tags/featured-image.php

## inc/post-meta.php
* Fixed an issue where a closing `</div>` wasn't output. This was breaking the entire template. The problem was the following line: `if(POST__GROUP_METADATA)`. I'm no longer checking the cfg constants directly; I'm using `cfg()`, so it should have been `if( cfg('POST__GROUP_METADATA') )`. 
* There were a couple of places where a `b` tag was containing an `h2` tag. This wasn't causing problems, but it's not valid HTML. Changed the `b` tags to `span`.

## content.php
* This thing has way too many `if` structures and needs to be cleaned out. I replaced some of the colon-style ones with regular bracket-based ones for consistency.


Apr 11, 2021 - version 0.4
==========================

## content.php
* Removed all metadata code and put that into its own /inc file, post-meta.php. Added conditional to determine whether a page is being displayed; pages shouldn't show metadata in most circumstances. In the future, I might need more control over this.

## inc/navigation.php
* Added classes to 



Apr 11, 2021 - version 0.3
==========================

* Renamed page.php and single.php to unused-. This is so pages and single posts will get the index.php template, not their own templates. That way, I can change the template markup in one place and have it take effect everywhere.

## content.php
* Noticed that titles on single pages were links, even though they had no reason to be since they only linked back to the page you're already on. I actually did have code that checked to see whether a link should be displayed, and that code used the is_single() conditional. That was returning false, since that only works on single posts, not pages. Now that pages don't have their own template - the standard blog template is being applied to pages - the page titles were being linked as though the content type was for a blog post in a list, not a final endpoint page. I changed is_single() to is_singular(), which returns true if it's called from any single page/post.

## footer.php
* Moved nav out of footer. Nav is now in inc/navigation.php
* Moved the end tag for u-lMain into the main index.php template

## functions.php
* Added has_subpage() function. This is necessary for adding the 'has-subnav' class to the HTML tag.
	* Added get_root_parent() function. This is necessary for adding the class of a page's rootmost parent to the HTML tag.
	* Added some code from Christian Varga for the subnav area. Having subnav on each page that only contains the subnav for that section is not easy to do, but CV has some code that does the job. This is what I was using on the Vassar parent theme as well.

## inc/html-classes.php
* Added code from Vassar parent theme for applying various classes to the HTML tag. While this code was in the header.php file in the Vassar theme, GWP is already set up to include the html-classes file, so I didn't need to set that up as an include, I just needed to add the class code.

## inc/navigation.php
* Added this file. This contains both the top-level and subnav for the theme. Up to this point, I'd put nav in footer.php; I've removed it from there, so nav has its own file now.

## index.php
* Since index.php is the template applied to all situations now, it needs to include paging nav for when it's displaying a single page or post. Previously, it only included paging nav for posts, since pages had their own template; it now determines whether it's being used for a page or post, and displays paging nav for both.
* Added include for inc/navigation.php

## page.php
* Deprecated - renamed to unused-page.php

## single.php
* Deprecated - renamed to unused-single.php

## sidebar.php
* Added hooks for gwp_inner_sidebar_before and gwp_inner_sidebar_after. These come before and after the sidebar widget area. I added these for the Jolt project, when I needed to wrap the sidebar in something.







Nov 24, 2020 - version 0.2.1
============================

## Search results
* The h1 class was post__title, which conflicted with the actual titles of the displayed posts. Changed this to u-pageTitle archives__title.
* Also noticed that the Search page title had a header tag around it—removed that to get it to match the other templates.
* Added a cfg() variable, SEARCH__PAGETITLE, to modify the search title.

## inc/site-title.php
* Replaced some hardcoded links to the SVG logo and include with cfg() values

## functions.php
* Added the new, more reliable cfg() function I wrote for vassar-parent
* Gutenberg font sizes: Replaced the four ludicrously large font sizes with a tasteful "intro" size
* Added custom image sizes
* Replaced a few instances of the old way of checking cfg variables - "if (CAT__USE_SPECIAL_DATE_FORMAT)" - with the new, better way: "if (cfg('CAT__USE_SPECIAL_DATE_FORMAT'))".

## content.php
* Replaced a lot of if(CFG_SETTING) with if(cfg(CFG_SETTING))

## footer.php
* Replaced a lot of if(CFG_SETTING) with if(cfg(CFG_SETTING))

## header.php
* Removed hardcoded link to stylesheet that isn't there anymore


June 8, 2020 - version 0.1
==========================

* Changed the existing cfg() function with the more versatile one from Vassar Parent. Note: the old cfg() returned the value of a setting without an additional parameter. You might need to replace something like cfg('POST__FEATUREDIMAGE_ShowForThese') with cfg('POST__FEATUREDIMAGE_ShowForThese', true).

## In inc/site-title.php:
* Updated it with calls to the new cfg()
	* A path to the CSI SVG logo was hardcoded in this. I changed that to have it pull in a file specified in HEADER__USE_INCLUDE instead.

## functions.php:
* Set up Gutenberg overrides section. First function in there removes the standard font sizes (the menu for paragraph blocks) and replaces them with a normal and Intro font-size.