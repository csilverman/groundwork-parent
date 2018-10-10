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
	
$child_path = get_stylesheet_directory();
include($child_path."/_SETUP.php");


$html__classes = "wp";

//	First, add post categories to the class list
//	But only if we're on a post page

if (is_single()) {
	global $post;
	$category = get_the_category($post->ID);
	for ($i=0;$i<count($category);$i++) {
		$html__classes .= " cat--".$category[$i]->name;	
	}
}

//	Then add classes for whatever page we're on

function theSlug() {
	if(SITE__CUSTOM_CLASS_FOR_EACH_PAGE) {
		if ( is_home() ) {
			$theSlug = false;
		}
		else {
			global $post;
			$theSlug = get_post( $post )->post_name;
			if ( is_page() ) {
				$theSlug = "page--".$theSlug;
			} else {
				$theSlug = "post--".$theSlug;
			}
			return $theSlug;
		}
	}
}

$html__classes .= " ".theSlug();


//	Now add any classes the user specified in custom fields

global $wp_query;
$postid = $wp_query->post->ID;
$html__classes .= " ".get_post_meta($postid, "html__classes", true);
wp_reset_query();


/*	Do the following:
	 - Find out what Wordpress function generates a path
	 	to the main Groundwork theme
	 - Set this up as the groundwork_path variable
	 - Get the custom class toggle working.

*/

// include($groundwork_path."/add-ons/customPostClass.php");


?>

<html <?php language_attributes(); ?> <?php body_class("no-js ".$html__classes); ?> <body>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">				
				
		<!-- webtype goes here -->
		<?php echo get_post_meta($post->ID, "webtype", true); ?>


		<!--[if (gte IE 8)&(lt IE 9)]><link href="<?php echo get_template_directory_uri(); ?>/assets/css/ie8.css" rel="stylesheet"/><![endif]-->
		<!--[if (gte IE 9)|(lt IE 8)]><!-->
			<link href="<?php echo get_template_directory_uri(); ?>/assets/css/site.css" rel="stylesheet" />

		<!--<![endif]-->

		<?php wp_head(); ?>
		
		<?php
			if ( (is_single()) || (is_page()) ) {
				if(get_post_meta($post->ID, 'hasCustomStyling', true)==true) {
					echo '<link href="'.content_url().'/post_themes/'.get_the_date("Ymd", $post->ID ).'_'.theSlug().'/style.css" rel="stylesheet" />';
				}
			}
		?>
		
		<!-- custom post CSS file goes here -->
		
	</head>
	
	<body>
		
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-59989151-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo SITE__GOOGLEANALYTICS_CODE; ?>');
</script>

			<?php if(SITE__UNIBAR) { ?>
				<div class="universal-header">
					<?php include(SITE__UNIBAR); ?>
				</div>
			<?php } ?>
		</div>
		<div class="u-lPageContent hfeed site">

		<?php if(SITE__HAS_NAVIGATION) { ?>
				<a class="ac-hiddenVisually ac-skipLink" href="#targetnavigation">skip to navigation (press enter key)</a>
				<a class="ac-NavAnchor ac-NavAnchor--menu icomoon" href="#navigation">Menu</a>
		<?php } ?>

			<div class="u-lHeader" role="banner">
				<header>
					<div class="u-Masthead">
						<h1 class="u-Masthead__siteTitle">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

							<?php if(HEADER__USE_LOGO) { ?>
								<img src="<?php echo HEADER__USE_LOGO; ?>" />
							<?php } ?>

							<?php if(HEADER__USE_INCLUDE != "") { 
								include(HEADER__USE_INCLUDE);
							} ?>

							<b class="u-Masthead__siteTitle__text"><?php bloginfo( 'name' ); ?></b></a>
						</h1>
						
						<?php if(SITE__SHOW_SITEDESC) { ?>
						<h2 class="u-Masthead__siteDesc"><?php bloginfo( 'description' ); ?></h2>
						<?php } ?>
					</div>
				</header>
			</div><!-- #masthead -->
	
		
			<div class="u-lMain" role="main">