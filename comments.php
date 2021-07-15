<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package groundwork
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php if(SHOW_COMMENTS) { ?>
<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				if(COMMENT__HEADER_VERBOSE) {
					printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'groundwork' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				
				}
				else
					printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'groundwork' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );

			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'groundwork' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'groundwork' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'groundwork' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'groundwork' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'groundwork' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'groundwork' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'groundwork' ); ?></p>
	<?php endif; ?>

<?php $comment_args = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<p class="commentsItem commentsItem--author">' .
                '<label'.( $req ? ' class="required" ' : '' ). 'for="author">'.( $req ? '<b class="requiredMarker">*</b> ' : '' ) . __( 'Your Name' ) . '</label> ' .
                
                '<input id="author" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
                '</p><!-- #form-section-author .form-section -->',
    'email'  => '<p class="commentsItem commentsItem--email">' .
                '<label' .( $req ? ' class="required" ' : '' ). 'for="email">'.( $req ? '<b class="requiredMarker">*</b> ' : '' ) . __( 'Your Email' ) . '</label> ' .
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
		'</p><!-- #form-section-email .form-section -->',
    
    'url' =>
    '<p class="commentsItem commentsItem--url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></p>',
    
    ) ),
    'comment_field' => '<p class="commentsItem commentsItem--comment">' .
                '<label for="comment">' . __( 'Comment:' ) . '</label>' .
                '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
                '</p><!-- #form-section-comment .form-section -->',
    'comment_notes_after' => '',
    $required_text
);
comment_form($comment_args); ?>



</div><!-- #comments -->
<?php } ?>