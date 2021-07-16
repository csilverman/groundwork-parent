
	<?php if(cfg('POST__GROUP_METADATA')) { ?>
		<div class="post__meta">
	<?php } ?>

		<?php do_action( 'postMeta__inner_start'); ?>

		<?php if(cfg('SHOW_AUTHORS')) { ?>
			<b class="post__metaItem post__authorContainer">
				<?php if(cfg('AUTHOR__SHOWAVATAR')) { ?>
					<b class="author__avatar">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), cfg('AUTHOR__AVATARSIZE', true) ); ?>
					</b>
				<?php } ?>
				<b class="author__name">
					<b class="label label--author"><?php echo cfg('AUTHOR__BYLINETEXT', true); ?></b>
					<b class="author__link"><?php echo the_author_posts_link(); ?></b>
				</b>
			</b>
		<?php } ?>
		
		<b class="post__metaItem post__dateContainer">
		
			<?php if(cfg('POST_DATELABEL') === false) {
				$label_postDate_hidden = "hide--visually";
			} else { 
			?><b class="label label--postDate <?php echo $label_postDate_hidden; ?>">Posted on: </b><?php } ?>
			
			<b class="post__date"><?php the_time('M d, Y'); ?></b>
		</b>

		<?php if(cfg('POST__SHOWDATEMODIFIED')) { ?>
			<b class="post__metaItem post__dateModifiedContainer">
				<b class="label label--postDate <?php echo $label_postDate_hidden; ?>">Modified on: </b>
				<b class="post__date"><?php echo $post->post_modified; ?></b>
			</b>
		<?php } ?>

		<?php if(cfg('POST__SHOWCATEGORIES')) { ?>
			<span class="post__metaItem post__catContainer">
				<h2 class="label label--cats"><?php echo cfg('CATEGORY__HEADERTEXT', true); ?></h2>
					<?php 

//https://codex.wordpress.org/Function_Reference/get_category
	$all_categories = get_the_category();

	echo '<ul class="post__categories">';
	foreach($all_categories as $categories_item) {
		if (cfg('POST__SHOW_CAT_DESC') && $categories_item->description) {
			$cat_desc = '<b class="category__description">'.$categories_item->description.'</b>';
			$cat__name	= '<b class="category__name"><a href="'.get_category_link($categories_item->term_id).'">'.$categories_item->cat_name.'</a></b>';
		}
		else $cat__name = '<a href="'.get_category_link($categories_item->term_id).'">'.$categories_item->cat_name.'</a>';

		echo '<li>'.$cat__name.$cat_desc.'</li>';
	}
	echo '</ul>';

					?>
			</span>
		<?php } ?>


		<?php if(cfg('POST__SHOWTAGS') && !cfg('POST__TAGSBELOWPOST')) {
			$tags_list = get_the_tag_list( '', __( '', 'groundwork' ) );
			if ( $tags_list ) :
		?>
		<span class="post__metaItem post__tagsContainer">
			<h2 class="label label--postTags"><?php echo cfg('TAG__HEADERTEXT', true); ?></h2>
			<ul class="post__tags">
				<?php
				if(get_the_tag_list()) {
				    echo get_the_tag_list('<li>','</li><li>','</li>');
				}
				?>			
			</ul>
		</span>
		<?php endif; } ?>


		<?php if(cfg('SHOW_COMMENTS')) { ?>
		<b class="post__metaItem post__commentLinkContainer">
			<b class="post__comments">
			<?php comments_popup_link( __( cfg('COMMENT_TEXT', true), 'groundwork' ), __( cfg('COMMENT_TEXT_1COMMENT', true), 'groundwork' ), __( '%'.cfg('COMMENT_TEXT_MULTI', true), 'groundwork' ) ); ?>
			</b>
		</b>
		<?php } ?>
		
		<?php edit_post_link( __( 'Edit', 'groundwork' ), '<b class="post__edit">', '</b>' ); ?>

		<?php do_action( 'postMeta__inner_end'); ?>

	<?php if( cfg('POST__GROUP_METADATA') ) { ?>
		</div><!-- post__meta -->
	<?php } ?>
