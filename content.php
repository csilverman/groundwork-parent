<?php
/**

	A new feature
 * @package groundwork
 */
?>




<?php

$post__classes = get_post_meta($post->ID, 'post__classes', true);
$morePostClasses = "";
$morePostClasses .= formatPostClasses($post__classes);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("post post--".$post->post_name." ".$morePostClasses); ?>>

<?php 
	$post__subdesc = get_post_meta($post->ID, 'subdesc', true); 
?>

<?php


/*	Figure out special treatment for this post,
	based on its category
	===================== */


$makePostTitleTheCategoryTitle = false;
$dateFormat = '';


/*	The following arrays contain the IDs of categories
	with specific requirements. */

if (cfg('CAT__USE_NAME_OF_CAT_AS_HEADER')) {
	$catsWithEponymousPostTitles = explode(",", cfg('CAT__USE_NAME_OF_CAT_AS_HEADER', true));
	$catsWithSpecialDateFormat = specialDateFormatArray();

	
	$categories = get_the_category();

	if($categories){
		foreach($categories as $category) {
			$thisPostsCategory = $category->term_id;

			if(in_array($thisPostsCategory, $catsWithEponymousPostTitles)) {
				$makePostTitleTheCategoryTitle = true;
				$categoryTitle = $category->cat_name;
			}
			if ($catsWithSpecialDateFormat) {
				if(array_key_exists($thisPostsCategory, $catsWithSpecialDateFormat)) {
					$dateFormat = $catsWithSpecialDateFormat[$thisPostsCategory];
				}
			}
		}
	}
}

$post__title = get_the_title($post->ID);
$post__format = get_post_format($post->ID);

if((strpos($post__title, ":") == true) && ($post__format == "")) 
	$postHasSubtitle = true;

// $postHasSubtitle = true;

if(cfg('POST__ENABLE_SUBTITLES')) {
	if($postHasSubtitle) {
		$post__title = explode(":", $post__title);
		$post__mainTitle = $post__title[0];
		$post__subTitle = $post__title[1];
	}
}

/*	If a page of posts is being displayed, post headers should
	be h2s. But if a single post is being displayed, its header
	should be an h1. This determines what that tag is. */
	
$hTag = "h2";


	/*	HOMEPAGE/ARCHIVE */
	
	if(!is_single()) {
		$hp_post__styling = get_post_meta($post->ID, 'hp-post-styling', true);
		$hp_more_css = get_post_meta($post->ID, 'hp-more-css', true);

		echo '<style>';

		/*	First thing: styles applied to this post specifically. That'll typically be CSS variables, although you can include other things like background-size, if you've applied an image to the post background. Anything in 	hp-post-styling automatically appears inside a selector targeting that specific post. You can't add any selectors to this field, only rules.
		*/	
		echo ".post--".$post->post_name." {".$hp_post__styling."}";

		/*	If you want to do more styling to a post - targeting selectors other than the post container itself - use the hp-more-css field. Anything can go in there. Typically, this should be styling that applies to the post it's attached to. You could use this for changing the background color on the title, or other adjustments that are more complicated than styling the basic container selector.
		*/
		echo $hp_more_css;
		echo '</style>';
	}

	if (is_singular()) { 
		$hTag = "h1";
	}
?>

	<?php if(cfg('POST__GROUP_TITLE_AND_META')) { ?>
		<div class="post__headerblock">
	<?php
		do_action( 'gwp__headerblock_open');
	} ?>


		<header class="post__header">
		<<?php echo $hTag; ?> class="post__title" title="<?php the_title(); ?>">
		
		<?php
		/*	There are two situations where an item's title would *not* be linked:
		
			-	It's a permalink page. If you're viewing a blog post, that post's title should
				not be linked to the page you're already on.

			-	It's a content type that you don't want to link to a single page, and you've
				listed that content type in CTYPE__DONT_LINK_TITLE.
			
			Right now, we're going to check to see if the current post belongs to a content
			type that shouldn't link.
		*/
		
		
			$this_post_type = get_post_type();
			
			//	This gets us a comma-delimited list of types that shouldn't link
			$types_that_shouldnt_link = cfg('CTYPE__DONT_LINK_TITLE', true);
			
			//	Turn it into an array
			$types_that_shouldnt_link = explode(',', $types_that_shouldnt_link);
		?>
		
			<?php if(!is_singular() && !in_array($this_post_type, $types_that_shouldnt_link, true)) { ?>
				<a class="post__titleLink" href="<?php the_permalink(); ?>" rel="bookmark">
			<?php } ?>
		
			<?php if($makePostTitleTheCategoryTitle) {
				echo $categoryTitle;
			} else if(($postHasSubtitle) && (cfg('POST__ENABLE_SUBTITLES'))) { 
				echo $post__mainTitle.'<b class="post__subTitle">'.$post__subTitle.'</b>';
			} else {
				the_title();
			}
			?>
			<?php if(!is_singular() && !in_array($this_post_type, $types_that_shouldnt_link, true)) { ?>
				</a>
			<?php } ?>
		</<?php echo $hTag; ?>>


		<?php if ($post__subdesc) { ?>
			<p class="post__subdesc">
		<?php
			echo $post__subdesc."</p>";
			}
		?>

		</header>



	<?php
		if( get_post_type() !== 'page' ) {
			include(get_template_directory() . '/inc/post-meta.php');
		}

		if(cfg('POST__GROUP_TITLE_AND_META')) {
			do_action( 'gwp__headerblock_close');
		?>
		</div><!-- end tag for post__headerblock -->
	<?php } ?>

	<?php include(get_template_directory() . '/template-tags/featured-image.php'); ?>

	 <?php
		if((cfg('BLOG__EXCPT_ON_HOME')) && is_home()) {
			 $only_show_excerpt_on_home = true;
		}

		if ( (is_search() || is_archive()) || $only_show_excerpt_on_home ) { // Only display Excerpts for Search
	?>

			<div class="entry__summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		<?php } else { ?>

	<div class="entry__content">
		<?php
			the_content( __( cfg('POST__READMORE_TEXT', true), 'groundwork' ) );
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'groundwork' ),
				'after'  => '</div>',
			) );
		}
		?>
	</div><!-- .entry-content -->

	<?php if(cfg('POST__TAGSBELOWPOST')) {
		if(cfg('POST__SHOWTAGS')) {

/*			$tags_list = get_the_tag_list( '', __( '', 'groundwork' ) );
			
			if ( $tags_list ) { */
		?>
		<b class="post__metaItem post__tagsContainer">
			<h2 class="label label--postTags"><?php echo cfg('TAG__HEADERTEXT', true); ?></h2>
			<ul class="post__tags">
				<?php
				if(get_the_tag_list()) {
				    echo get_the_tag_list('<li>','</li><li>','</li>');
				}
				?>
			</ul>
		</b>
		<?php 
			}
		}
		
	// endif; ?>
</article><!-- #post-## -->
