<?php
/**
 * @package groundwork
 */
?>




<?php

$morePostClasses = "";
$morePostClasses .= formatPostClasses(get_post_meta($post->ID, 'post__classes', true));

?>

<div id="post-<?php the_ID(); ?>" <?php post_class("post post--".$post->post_name." ".$morePostClasses); ?>>

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

if (CAT__USE_NAME_OF_CAT_AS_HEADER) {
	$catsWithEponymousPostTitles = explode(",", CAT__USE_NAME_OF_CAT_AS_HEADER);
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
?>


<?php


$post__title = get_the_title($post->ID);
$post__format = get_post_format($post->ID);

if((strpos($post__title, ":") == true) && ($post__format == "")) 
	$postHasSubtitle = true;

// $postHasSubtitle = true;

if(POST__ENABLE_SUBTITLES) {
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

?>

<?php
	if(is_home()) {
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


?>
<?php
if (is_singular()) $hTag = "h1";

?>
	<article>
		<header class="post__header">
		<<?php echo $hTag; ?> class="post__title" title="<?php the_title(); ?>">
			<?php if(!is_single()) { ?>
				<a class="post__titleLink" href="<?php the_permalink(); ?>" rel="bookmark">
			<?php } ?>
		
		<?php if($makePostTitleTheCategoryTitle) {
				echo $categoryTitle;
			} else if(($postHasSubtitle) && (POST__ENABLE_SUBTITLES)) { 
				echo $post__mainTitle.'<b class="post__subTitle">'.$post__subTitle.'</b>';
			} else {
				the_title();
			}
			?>
			<?php if(!is_single()) { ?>
				</a>
			<?php } ?>
		</<?php echo $hTag; ?>>


		<?php if ($post__subdesc) { ?><p class="post__subdesc"><?php echo $post__subdesc."</p>"; } ?>

		</header>

	<?php if(POST__GROUP_METADATA) { ?>
		<div class="post__meta">
	<?php } ?>

		<?php if(SHOW_AUTHORS) { ?>
			<b class="post__metaItem post__authorContainer">
				<?php if(AUTHOR__SHOWAVATAR) { ?>
					<b class="author__avatar">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), AUTHOR__AVATARSIZE ); ?>
					</b>
				<?php } ?>
				<b class="author__name">
					<b class="label label--author"><?php echo AUTHOR__BYLINETEXT; ?></b>
					<b class="author__link"><?php echo the_author_posts_link(); ?></b>
				</b>
			</b>
		<?php } ?>
		<b class="post__metaItem post__dateContainer">
		
			<?php if(POST_DATELABEL === false) {
				$label_postDate_hidden = "hide--visually";
			} else { 
			?><b class="label label--postDate <?php echo $label_postDate_hidden; ?>">Posted on: </b><?php } ?>
			
			<b class="post__date"><?php the_time('M d, Y'); ?></b>
		</b>

		<?php if(POST__SHOWDATEMODIFIED) { ?>
			<b class="post__metaItem post__dateModifiedContainer">
				<b class="label label--postDate <?php echo $label_postDate_hidden; ?>">Modified on: </b>
				<b class="post__date"><?php echo $post->post_modified; ?></b>
			</b>
		<?php } ?>


		<?php if(POST__SHOWCATEGORIES) { ?>
			<b class="post__metaItem post__catContainer">
				<h2 class="label label--cats"><?php echo CATEGORY__HEADERTEXT; ?></h2>
					<?php echo get_the_category_list(); ?>
			</b>
		<?php } ?>


		<?php if(POST__SHOWTAGS && !POST__TAGSBELOWPOST) {
			$tags_list = get_the_tag_list( '', __( '', 'groundwork' ) );
			if ( $tags_list ) :
		?>
		<b class="post__metaItem post__tagsContainer">
			<h2 class="label label--postTags"><?php echo TAG__HEADERTEXT; ?></h2>
			<ul class="post__tags">
				<?php
				if(get_the_tag_list()) {
				    echo get_the_tag_list('<li>','</li><li>','</li>');
				}
				?>			
			</ul>
		</b>
		<?php endif; } ?>


		<?php if(SHOW_COMMENTS) { ?>
		<b class="post__metaItem post__commentLinkContainer">
			<b class="post__comments">
			<?php comments_popup_link( __( COMMENT_TEXT, 'groundwork' ), __( COMMENT_TEXT_1COMMENT, 'groundwork' ), __( '%'.COMMENT_TEXT_MULTI, 'groundwork' ) ); ?>
			</b>
		</b>
		<?php } ?>
		
		<?php edit_post_link( __( 'Edit', 'groundwork' ), '<b class="post__edit">', '</b>' ); ?>


	<?php if(POST__GROUP_METADATA) { ?>
		</div><!-- post__meta -->
	<?php } ?>
	<?php
	if(POST__FEATUREDIMAGE_ShowOnSingle) {
		
	 if ( has_post_thumbnail()) {
	    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), POST__FEATUREDIMAGE_SIZE);
	    
	    ?>
	    
	    <div class="post__image">
		    <?php if(!is_single()) { ?><a class="post__imageLink" href="<?php the_permalink(); ?>"><?php } ?>
			    <img src="<?php echo $large_image_url[0]; ?>">
		    <?php if(!is_single()) { ?></a><?php } ?>
		    <?php if ( $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
    <p class="caption"><?php echo $caption; ?></p>
<?php endif; ?>
	    </div>
	    <?php
		   }
	 }
	 ?>
	 
	 <?php
		  if((BLOG__EXCPT_ON_HOME) && is_home()) $only_show_excerpt_on_home = true;
	 ?>
	<?php if ( (is_search() || is_archive())
		 || $only_show_excerpt_on_home) : // Only display Excerpts for Search ?>
	<div class="entry__summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry__content">
		<?php the_content( __( POST__READMORE_TEXT, 'groundwork' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'groundwork' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if(POST__TAGSBELOWPOST) { ?>

		<?php if(POST__SHOWTAGS) {
			$tags_list = get_the_tag_list( '', __( '', 'groundwork' ) );
			if ( $tags_list ) :
		?>
		<b class="post__metaItem post__tagsContainer">
			<h2 class="label label--postTags"><?php echo TAG__HEADERTEXT; ?></h2>
			<ul class="post__tags">
				<?php
				if(get_the_tag_list()) {
				    echo get_the_tag_list('<li>','</li><li>','</li>');
				}
				?>			
			</ul>
		</b>
		<?php endif; } ?>
			
	<?php } ?>

	<?php endif; ?>
	</article>
</div><!-- #post-## -->
