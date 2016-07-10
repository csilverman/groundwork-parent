<?php
/**
 * The Template for displaying all single posts.
 *
 * @package groundwork
 */

get_header(); ?>

	<div class="u-lContent">
	
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<?php groundwork_post_nav(""); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- /u-lContent -->
	
<?php
	if(HAS_SIDEBAR) {
		get_sidebar();
	}
?>
<?php get_footer(); ?>