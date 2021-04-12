<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package groundwork
 */

get_header(); ?>

	<div class="u-lContent">
	
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

		<?php if(SHOW_COMMENTS) { ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>
				
		<?php } ?>

			<?php endwhile; // end of the loop. ?>

	</div><!-- /u-lContent -->
	
<?php
	if(SITE__HAS_SIDEBAR) {
		get_sidebar();
	}
?>
<?php get_footer(); ?>
