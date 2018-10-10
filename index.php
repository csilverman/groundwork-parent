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

	<?php if(HOMEPAGE__HAS_BLOGINTRO) { ?>
		<div class="blogIntro">
			<?php show_post("blogintro"); ?>
		</div>
	<?php } ?>

	<?php if(HOMEPAGE__HAS_PRECONTENTWIDGETS) { ?>
		<div class="widget-area hp__precontentbar" role="complementary">
			<?php if ( ! dynamic_sidebar( 'sidebar-4' ) ) : ?>
	
			<?php endif; // end sidebar widget area ?>
		</div><!-- /u-lAside -->
	<?php } ?>

	<div class="u-lContent">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ 
				$post_count = 0;
			?>
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php
				/*
				The following determines if a post has a specific format. If
				a post does not have a specific format, the standard post template
				is used. If a post has been assigned a format, though—link, video, etc—
				the file for that specific format is used.
				
				Advantages: means that different format markup can be
				split out into different files.
				
				*/
				?>
				<?php 
					if(!get_post_format()) {
						get_template_part('content', get_post_format());
					} else {
						get_template_part('format', get_post_format());
					}
					
					$post_count++;
					if($post_count==HOMEPAGE__INLOOPCONTENT_AFTERPOST) { ?>

					<div class="widget-area" role="complementary">
						<?php if ( ! dynamic_sidebar( 'in-loop-content' ) ) : ?>
				
						<?php endif; // end sidebar widget area ?>
					</div><!-- /u-lAside -->

				<?php } ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					// get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php groundwork_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- /u-lContent -->


	<?php if(HOMEPAGE__HAS_OWNSIDEBAR) $addtlClasses = "widget-area--hpsidebar"; ?>
	
		<div class="u-lAside widget-area <?php echo $addtlClasses; ?>" role="complementary">
		<?php
			if(HOMEPAGE__HAS_OWNSIDEBAR) { 
				if ( ! dynamic_sidebar( 'sidebar-3' ) ) : ?>
	
			<?php endif; // end sidebar widget area ?>
		
		<?php }
			else {
				get_sidebar();
			}
		?>
	</div><!-- /u-lAside -->

<?php get_footer(); ?>














