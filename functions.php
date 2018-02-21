<?php
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



if (HOMEPAGE__HAS_OWNSIDEBAR) {
	add_action( 'widgets_init', 'groundwork_hpsidebar_init' );	
}
if (HOMEPAGE__HAS_PRECONTENTWIDGETS) {
	add_action( 'widgets_init', 'groundwork_hpprecontentbar_init' );	
}





/**
 * Enqueue scripts and styles.
 */
function groundwork_scripts() {
	wp_enqueue_style( 'groundwork-style', get_stylesheet_uri() );

	wp_enqueue_script( 'groundwork-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'groundwork-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
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