<?php

function cfg($constant) {
	/*	cfg() checks if a setup constant exists before trying to use it. I need to use this on every setup var I have, because if I don't, there's going to be a lot of warnings, and people would need to have every setup var in their file whether they're using it or not. That's cluttery.	
	*/
	if (defined($constant)) 
		return constant($constant);
	else return false;
}

$child_path = get_stylesheet_directory();
$setup_file = $child_path."/_SETUP.php";
if (file_exists($setup_file))
	include($setup_file);

/**
 * groundwork functions and definitions
 *
 * @package groundwork
 */
 
/*
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 */
add_theme_support( 'post-thumbnails' );


/*  Script for no-js / js class
/* ------------------------------------ */
function alx_html_js_class () {
    echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
}
add_action( 'wp_head', 'alx_html_js_class', 1 );


 
if ( ! function_exists( 'groundwork_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function groundwork_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on groundwork, use a find and replace
	 * to change 'groundwork' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'groundwork', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'groundwork' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'groundwork_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // groundwork_setup
add_action( 'after_setup_theme', 'groundwork_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function groundwork_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'groundwork' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget widget--side %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget__title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'groundwork_widgets_init' );

/* Footer widget area */

function groundwork_footerwidgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer-bar', 'groundwork' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget widget--footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget__title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'groundwork_footerwidgets_init' );


function groundwork_hpsidebar_init() {
	register_sidebar( array(
		'name'          => __( 'HomepageSidebar', 'groundwork' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget hp--sidebar %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget__title">',
		'after_title'   => '</h1>',
	) );
}

function groundwork_hpprecontentbar_init() {
	register_sidebar( array(
		'name'          => __( 'HomepagePreContentBar', 'groundwork' ),
		'id'            => 'sidebar-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget hp__precontentbar--widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget__title">',
		'after_title'   => '</h1>',
	) );
}

function groundwork_inloopcontent_init() {
	register_sidebar( array(
		'name'          => __( 'HomepageInLoopContent', 'groundwork' ),
		'id'            => 'in-loop-content',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget hp__inloopcontent--widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget__title">',
		'after_title'   => '</h1>',
	) );
}
if (HOMEPAGE__HAS_INLOOPCONTENT) {
	add_action( 'widgets_init', 'groundwork_inloopcontent_init' );	
}


if (HOMEPAGE__HAS_OWNSIDEBAR) {
	add_action( 'widgets_init', 'groundwork_hpsidebar_init' );	
}
if (HOMEPAGE__HAS_PRECONTENTWIDGETS) {
	add_action( 'widgets_init', 'groundwork_hpprecontentbar_init' );	
}


//	https://colorlib.com/wp/load-wordpress-jquery-from-google-library/
function replace_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/js/libraries/jquery.min.js', false, '3.1.1');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'replace_jquery');

/**
 * Enqueue scripts and styles.
 */
function groundwork_scripts() {
	wp_enqueue_style( 'groundwork-style', get_stylesheet_uri() );

    wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/libraries/jquery.waypoints.min.js',  array('jquery') ); 
    wp_register_script( 'highlight-js', get_template_directory_uri() . '/js/libraries/highlight/highlight.pack.js');
	wp_register_style( 'highlight-js-style', get_template_directory_uri().'/js/libraries/highlight/styles/agate.css');

	//	https://github.com/goblindegook/littlefoot
    wp_register_script( 'littlefoot-js', get_template_directory_uri() . '/js/libraries/littlefoot/littlefoot.min.js',  array('jquery') ); 
	wp_register_style( 'littlefoot-js-style', get_template_directory_uri().'/js/libraries/littlefoot/littlefoot.css');

    wp_register_script( 'imagesloaded', get_template_directory_uri() . '/js/libraries/imagesloaded.pkgd.min.js');

	/*	Get rid of the built-in Gutenberg styling. Needed to do this when the image-and-text module proved to not be responsive, and I realized that building it from scratch was simply easier. */
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');

    wp_register_script( 'site', get_stylesheet_directory_uri() . '/assets/js/site.js',  array('jquery'), time() ); 

}

add_action( 'wp_enqueue_scripts', 'groundwork_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/** Admin Slug Function
http://wpalkane.com/hacks/get-the-slug-of-current-post/#sthash.mauN6AFA.dpuf */
/*	Skyhook-specific	*/
function postSlug($format) {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
	if ($format=="headerClass")
	    return "post--".$slug;
}
function categoryList($format) {
	$categories = get_the_category($post->ID);
	if ($format=="headerClass") $cat_prefix = "cat--";
	for ($i=0; $i<count($categories); $i++) {
		$category_list .= " ".$cat_prefix.$categories[$i]->category_nicename;
	}
	return $category_list;
}
/*	End skyhook	*/

function postClass() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return "post--".$slug;
}

function gw__get_site_title() {
	if (cfg('SITE__CUSTOM_TITLE')) {
		return SITE__CUSTOM_TITLE; 
	}
	else return get_bloginfo( 'name' ); 
}

function categoryClass() {
	$categories = get_the_category($post->ID);
	$cat_prefix = "cat--";
	for ($i=0; $i<count($categories); $i++) {
		$category_list .= " ".$cat_prefix.$categories[$i]->category_nicename;
	}
	return $category_list;
}

/* http://digwp.com/2010/01/wordpress-more-tag-tricks/ */
function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

function show_featured_image_for_this_post($post__classes) {
	/*	This function determines whether or not to override POST__FEATUREDIMAGE_ShowInList. If POST__FEATUREDIMAGE_ShowInList is set to true, this never runs because everything's going to be shown anyway. If it's false, though, there may be exceptions: posts where the featured image is intended to appear despite the fact that featured images for post listings are turned off.
		
		These exceptions are defined in POST__FEATUREDIMAGE_ShowForThese. That's an array of items that, if used in post__classes, indicate that the featured image should be displayed for that post.

		 This function accepts whatever is set in the current post's post__classes field.
	*/
	
	$exceptions = cfg('POST__FEATUREDIMAGE_ShowForThese');

	if($exceptions) {
		//	First, turn the post__classes into an array, because they're not
		$post__classes = explode(' ', $post__classes);
				
		//	Then see if there's any overlap between the two arrays
		if (array_intersect($exceptions, $post__classes)) {
			return true;
		}
	}
	else return false;
}

function socialcard($arr) {
	foreach ($arr as $key => $value) {
		$markup .= PHP_EOL;
		
		//	Some values appear in both Facebook and Twitter tags
		//	Let's deal with those first
		if (strpos($key, 'image') !== false) {
			/* "The provided 'og:image' properties are not yet available because new images are processed asynchronously. To ensure shares of new URLs include an image, specify the dimensions using 'og:image:width' and 'og:image:height' tags." */
				
			$local_image_url = wp_make_link_relative($value);
			$local_image_url = $_SERVER['DOCUMENT_ROOT'].$local_image_url;
			if(file_exists($local_image_url))

				list($image_width, $image_height, $image_type, $image_attr) = getimagesize($local_image_url);
			$markup .= '<meta name="og:image:width" content="'.$image_width.'">';
			$markup .= '<meta name="og:image:height" content="'.$image_height.'">';

			
			$markup .= '<meta name="twitter:card" content="summary_large_image">';
			$markup .= '<meta name="twitter:image" content="'.$value.'">'.PHP_EOL.'<meta property="og:image" content="'.$value.'">';
		}
		if (strpos($key, 'title') !== false) {
			$value = strip_tags($value);
			$markup .= '<meta name="twitter:title" content="'.$value.'">'.PHP_EOL.'<meta property="og:title" content="'.$value.'">';
		}
		if (strpos($key, 'description') !== false) 
			$markup .= '<meta name="twitter:description" content="'.$value.'">'.PHP_EOL.'<meta property="og:description" content="'.$value.'">';


		//	Network-specific stuff here
		if (strpos($key, 'twitter') !== false)
			$markup .= '<meta name="'.$key.'" content="@'.$value.'">';
		else if (strpos($key, 'og:') !== false)
			$markup .= '<meta property="'.$key.'" content="'.$value.'">';
	}
    return $markup;
}

function specialDateFormatArray() {
	if (CAT__USE_SPECIAL_DATE_FORMAT) {
	
		/*	Goal: Take the string specified for CAT__USE_SPECIAL_DATE_FORMAT
			and turn it into an array that can then be checked to see if the
			category for the current post is included in it. */
		
		//	Creates new, empty array
		$cats_useSpecialDate_arr = array();
		
		$cats_useSpecialDate = CAT__USE_SPECIAL_DATE_FORMAT;
		$cats_useSpecialDate = explode(",", $cats_useSpecialDate);
		foreach ($cats_useSpecialDate as $item) {
			$item_arr = explode(":", $item);
			$cats_useSpecialDate_arr[$item_arr[0]] = $item_arr[1];
		}
		// print_r($cats_useSpecialDate_arr);
		return $cats_useSpecialDate_arr;
	}
}

//	https://gretathemes.com/guides/remove-category-title-category-pages/
function prefix_category_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'prefix_category_title' );


add_filter('get_archives_link', 'translate_archive_month');

function translate_archive_month($list) {

	$patterns = array( 
	'/January/', '/February/', '/March/', '/April/', '/May/', '/June/',
	'/July/', '/August/', '/September/', '/October/',  '/November/', '/December/'
	);
	
	$replacements = array( //PUT HERE WHATEVER YOU NEED
	'01.', '02.', '03.', '04.', '05.', '06.', 
	'07.', '08.', '09.', '10.', '11.', '12.'
	);    
	
	$list = preg_replace($patterns, $replacements, $list);
	return $list; 
}


/*	http://joostkiens.com/improving-wp-caption-shortcode/ 
	I modified this to remove the inline width from the caption, and to
	add the "class" attribute to the shortcode container.
*/

/**
 * Improves the caption shortcode with HTML5 figure & figcaption; microdata & wai-aria attributes
 * 
 * @param  string $val     Empty
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Shortcode content
 * @return string          Shortcode output
 */
function jk_img_caption_shortcode_filter($val, $attr, $content = null)
{
	extract(shortcode_atts(array(
		'id'      => '',
		'align'   => 'aligncenter',
		'width'   => '',
		'caption' => '',
		'class' => ''
	), $attr));
	
	// No caption, no dice... But why width? 
	if ( 1 > (int) $width || empty($caption) )
		return $val;
 
	if ( $id )
		$id = esc_attr( $id );
     
	// Add itemprop="contentURL" to image - Ugly hack

	$content = str_replace('<img', '<img class="figure__image"', $content);

	$content = str_replace('<a', '<a class="figure__imageLink"', $content);

	return '<div id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="figure ' . esc_attr($class) . " " . esc_attr($align) . '"><figure>' . do_shortcode( $content ) . '<div id="figcaption_'. $id . '" class="figure__imageCaption"><figcaption>' . $caption . '</figcaption></div></div>';
}
add_filter( 'img_caption_shortcode', 'jk_img_caption_shortcode_filter', 10, 3 );

function show_post($path) {
	$post = get_page_by_path($path);
	$content = apply_filters('the_content', $post->post_content);
	echo $content;
}

function formatPostClasses($classes) {
	/*	This accepts a series of space-delimited classes (class1 class2)
		and returns them BEM-formatted (post--class1 post--class2)
	*/
	$classes = explode(" ", $classes);
	for ($i=0;$i<count($classes);$i++) {
		$final_classes .= " post--".$classes[$i];
	}
	return $final_classes;
}

function exclude_category( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'cat', HOMEPAGE__EXCLUDE_CATEGORIES );
	}
}
add_action( 'pre_get_posts', 'exclude_category' );


function the_categories($categories) {
	/*	This accepts the standard output from the WordPress function get_the_category_list() and modifies it as needed. While I could probably write my own function to get the category list entirely, rather than using the WP function as input, the standard WP function also includes the /category/ base. That's configurable through WordPress - something I'm not sure how to account for in my own get-category function - and I'd rather not replicate WP functionality where I don't have to.
	*/

/*	$categories = str_ireplace('<ul class="post-categories">', '', $categories);
	$categories = str_ireplace('</ul>', '', $categories);	
	$categories = str_ireplace('</li>', ',', $categories);
	$categories = str_ireplace('<li>', '', $categories);
	return $categories;
	*/


	$doc = DOMDocument::loadHTML($categories);
	$xpath = new DOMXPath($doc);
	$query = "//a[@rel='category tag']";
	$entries = $xpath->query($query);

	foreach ($entries as $entry) {
		echo $entry->getAttribute("href");
	}
	
	// return $categories;
	
}



// https://css-tricks.com/snippets/wordpress/remove-privateprotected-from-post-titles/

function the_title_trim($title) {

//	$title = attribute_escape($title);

	$findthese = array(
		'#Protected:#',
		'#Private:#'
	);

	$replacewith = array(

/*		'', // What to replace "Protected:" with
		'' // What to replace "Private:" with */


		'<b class=label--admin>Protected</b>', // What to replace "Protected:" with
		'<b class=label--admin>Private</b>' // What to replace "Private:" with
	);

	$title = preg_replace($findthese, $replacewith, $title);
	return $title;
}
add_filter('the_title', 'the_title_trim');







