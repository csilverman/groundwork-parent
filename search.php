<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package groundwork
 */

get_header(); ?>

	<div class="u-lContent">

		<?php if ( have_posts() ) : ?>

			<div class="post__header">
				<header>
					<h1 class="post__title"><?php printf( __( 'Search Results for: %s', 'groundwork' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .entry-header -->
			</div>
	
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php groundwork_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- /u-lContent -->

<?php
	if(SITE__HAS_SIDEBAR) {
		get_sidebar();
	}
?>
<?php get_footer(); ?>
