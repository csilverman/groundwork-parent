<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package groundwork
 */

if ( ! function_exists( 'groundwork_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function groundwork_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation pagingNav" role="navigation">
		<h1 class="hide--visually ac-hiddenVisually ac-navTitle"><?php _e( 'Posts navigation', 'groundwork' ); ?></h1>
		<div class="pagingNav__container">

			<?php if ( get_next_posts_link() ) : ?>
			
			<div class="pagingNav__navItem navItem--previous pagingNav__previous"><?php next_posts_link( __( POST__NAVOLDER_CONTENT, 'groundwork' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="pagingNav__navItem navItem--next pagingNav__next"><?php previous_posts_link( __( POST__NAVNEWER_CONTENT, 'groundwork' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'groundwork_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function groundwork_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<div class="navigation postNav" role="navigation">
		<h1 class="ac-hiddenVisually ac-navTitle"><?php _e( 'Post navigation', 'groundwork' ); ?></h1>
		<div class="postNav__container">
			<?php
			
				if(POST__NAV_SHOWTITLE) { 
					$prevpost_text = '%title';
					$nextpost_text = '%title';
				}
				else
				{
					$prevpost_text = POST__NAV_PREVTITLE;
					$nextpost_text = POST__NAV_NEXTTITLE;
				}
			?>			
	
			<div class="postNav__navItem navItem--previous postNav__previous">
				<?php echo get_previous_post_link('%link', '<b class="prevnext__title">Previous</b><b class="prevnext__name">%title</b>'); ?>
			</div>
			<div class="postNav__navItem navItem--next postNav__next">			
				<?php echo get_next_post_link('%link', '<b class="prevnext__title">Next</b><b class="prevnext__name">%title</b>'); ?>
			</div>
		

<?php 
/*				previous_post_link( '<div class="postNav__navItem navItem--previous postNav__previous">%link</div>', _x( $prevpost_text, 'Previous post link', 'groundwork' ) );
				
				next_post_link(     '<div class="postNav__navItem navItem--next postNav__next">%link</div>',     _x( $nextpost_text, 'Next post link',     'groundwork' ) ); */
				
			?>
		</div><!-- .nav-links -->
	</div><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'groundwork_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function groundwork_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'groundwork' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function groundwork_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'groundwork_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'groundwork_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so groundwork_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so groundwork_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in groundwork_categorized_blog.
 */
function groundwork_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'groundwork_categories' );
}
add_action( 'edit_category', 'groundwork_category_transient_flusher' );
add_action( 'save_post',     'groundwork_category_transient_flusher' );
