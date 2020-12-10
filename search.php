<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package groundwork
 */

get_header(); ?>

	<div class="u-lContent">

		<?php if ( have_posts() ) : ?>
		
			<?php
				$title_text = cfg('SEARCH__PAGETITLE', true, 'Search Results for: %s');
			?>

			<h1 class="u-pageTitle archives__title"><?php printf( __( $title_text, 'groundwork' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	
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
