<?php
// $typekit = "wyg2ypd";

define("TYPEKIT", "fvb3ypv");

define("HAS_SIDEBAR", true);
define("CUSTOM_CSS_PATH", "/css_path/");

define("SHOW_AUTHORS", true);
define("ROOT_PATH", "/web/sites/people/chsilverman/foliotheme");
define("URL_PATH", "/chsilverman/foliotheme");
define("ASSETS_PATH", URL_PATH."/wp-content/themes/groundwork-child/assets");
define("IMAGES_PATH", ASSETS_PATH."/images");


define("INCLUDE_PATH", ROOT_PATH."/wp-content/themes/groundwork-child/assets/includes");

// define("INCLUDEPATH", "/web/sites/people/chsilverman/clearwater/wp-content/themes/groundwork-child/assets/includes/");

define("SITE__SHOW_SITEDESC", false);



/*	Sitewide settings
	----------------- */

define("SITE__CUSTOM_CLASS_FOR_EACH_PAGE", true);



/*	Post settings
	------------- */
	
define("POST__ENABLE_SUBTITLES", true);		/*	If this is enabled, then any text in a post
													title following a colon will be styled as
													a subtitle. */

/*	Header settings
	--------------- */

// define("HEADER__USE_LOGO", IMAGES_PATH."/css/logo-black.svg");

define("HEADER__USE_LOGO", false);
define("HEADER__USE_INCLUDE", INCLUDE_PATH."/svg-logo.php");


/*	Page nav
	-------- */

define("POST__NAVOLDER_CONTENT", "Older posts");
define("POST__NAVNEWER_CONTENT", "Newer posts");

define("POST__NAV_SHOWTITLE", false);
	define("POST__NAV_PREVTITLE", 'Previous post');
	define("POST__NAV_NEXTTITLE", 'Next post');



/*	Comments
	-------- */

define("SHOW_COMMENTS", false);
define("COMMENT_TEXT", "0");
define("COMMENT_TEXT_1COMMENT", "1");
define("COMMENT_TEXT_MULTI", "");

define("COMMENT__HEADER_VERBOSE", false);




/*	Categories - special treatment
	------------------------------ */

/*	Any post in the following category will have
	the title of the category be displayed instead of
	the post title. */
	
define("CAT__USE_NAME_OF_CAT_AS_HEADER", "10, 14");
define("ASIDE_FORMAT__SPECIAL_DATE_FORMAT", "m/d/y");
// define("CAT__USE_SPECIAL_DATE_FORMAT", "10:m/d/y,14:m/d/y");




define("POST_DATELABEL", "Posted on");
define("POST_DATELABEL_HIDDEN", true);
define("POST_DATEFORMAT", "M d, Y");

define("AUTHOR__TITLEPAGE_PREFIX", "Posts by ");
define("AUTHOR__TITLEPAGE_POSTFIX", "");
define("AUTHOR__BYLINETEXT", "By");
define("AUTHOR__NAMEFORMAT", "NICKNAME");
	/*	FIRSTLAST		first name and last name
		DISPLAYNAME		display name
		NICKNAME		nickname
		NICENAME		nicename
	*/

define("AUTHOR__SHOWAVATAR", false);
	/*	You'll need a gravatar, or this plugin: https://wordpress.org/plugins/wp-user-avatar/	*/
	define("AUTHOR__AVATARSIZE", 64);
	define("AUTHOR__AVATARSIZE_BIOPAGE", 300);
	define("AUTHOR__SHOWAVATAR_BIOPAGE", true);


define("CATEGORY__HEADERTEXT", "Filed under");

define("TAG__HEADERTEXT", "Tagged: ");

?>