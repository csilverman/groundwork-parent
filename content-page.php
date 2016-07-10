<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package groundwork
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<article>
		<div class="post__header">
			<header>
				<h1 class="post__title" title="<?php the_title(); ?>"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->
		</div>
		<div class="entry__content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'groundwork' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php edit_post_link( __( 'Edit', 'groundwork' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
	</article>
</div><!-- #post-## -->
