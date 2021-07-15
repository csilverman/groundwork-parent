<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package groundwork
 */
?><!DOCTYPE html>

<?php
include('inc/html-classes.php');


//	Determine whether site title should be an h1 or not

function h1_or_not() {
	if(is_home()) echo "h1";
	else echo "p";
}



/*	Do the following:
	 - Find out what Wordpress function generates a path
	 	to the main Groundwork theme
	 - Set this up as the groundwork_path variable
	 - Get the custom class toggle working.

*/

// include($groundwork_path."/add-ons/customPostClass.php");


?>

<html <?php language_attributes(); ?> <?php body_class("no-js ".$html__classes); ?>>
	<head>

		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo SITE__GOOGLEANALYTICS_CODE; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo SITE__GOOGLEANALYTICS_CODE; ?>');
</script>

		
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">			

<?php

global $post;
$page_id = $post->ID;
if ( has_post_thumbnail( $page_id ) ) :
    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'optional-size' );
    $image = $image_array[0];
else :
    $image = get_stylesheet_directory_uri() . '/assets/images/feature-image.png';
endif;
		
	if(is_single()) {
		$og_obj = array(
			"image" => $image,
			"title" => get_the_title($page_id),
			"twitter:username" => "_csilverman",
			"og:url" => get_permalink($page_id),
			"description" => get_the_excerpt($page_id)
		);

		echo socialcard($og_obj);
	}
	else {
		$og_obj = array(
			"image" => $image,
			"title" => gw__get_site_title(),
			"twitter:username" => "_csilverman",
			"og:url" => esc_url( home_url( '/' ) ),
			"description" => get_bloginfo( 'description' )
		);

		echo socialcard($og_obj);
	}

?>
		<?php wp_head(); ?>
		
		<?php
			if ( (is_single()) || (is_page()) ) {
				$post__custom_styling = get_post_meta($post->ID, 'css', true);
				if($post__custom_styling) { ?>
				
				<style type="text/css">
					<?php include('inc/webfonts.php'); ?>		
					<?php echo $post__custom_styling; ?>

				</style>

		<?php }
			}
		?>
<!-- webtype goes here -->
<?php echo get_post_meta($post->ID, "webtype", true); ?>

		
		
		<!-- custom post CSS file goes here -->
		
	</head>
	
	<body>
		<div class="u-lPageContent hfeed site">

		<?php if(SITE__HAS_NAVIGATION) { ?>
				<a class="ac-hiddenVisually ac-skipLink" href="#targetnavigation">skip to navigation (press enter key)</a>
				<a class="ac-NavAnchor ac-NavAnchor--menu icomoon" href="#navigation">Menu</a>
		<?php } ?>

			<div class="u-lHeader" role="banner">
				<header>
					<div class="u-Masthead">
						<?php include('inc/site-title.php'); ?>

						<?php if(SITE__SHOW_SITEDESC) { ?>
						<h2 class="u-Masthead__siteDesc"><?php echo get_bloginfo( 'description' ); ?></h2>
						<?php } ?>
					</div>
				</header>
			</div><!-- #masthead -->
	
		
			<div class="u-lMain" role="main">