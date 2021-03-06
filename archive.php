<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package groundwork
 */

get_header(); ?>

	<div class="u-lContent">

		<?php if ( have_posts() ) : ?>
		
			<?php
				echo get_the_archive_title();
				//	post_type_archive_title();
			?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- /u-lContent -->

	<?php groundwork_paging_nav(); ?>

	<div class="u-lAside widget-area <?php echo $addtlClasses; ?>" role="complementary">
		<?php
			if(cfg('HOMEPAGE__HAS_OWNSIDEBAR')) { 
				if ( ! dynamic_sidebar( 'sidebar-3' ) ) : ?>
	
			<?php endif; // end sidebar widget area ?>
		
		<?php }
			else {
				get_sidebar();
			}
		?>
	</div><!-- /u-lAside -->
</div> <!-- /u-lMain -->

<?php 
	include(get_template_directory() . '/inc/navigation.php'); ?>

<?php get_footer(); ?>
