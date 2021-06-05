	<?php
	if((!is_single() && (cfg('POST__FEATUREDIMAGE_ShowInList') || show_featured_image_for_this_post($post__classes) )) || cfg('POST__FEATUREDIMAGE_ShowOnSingle')) {
		
	 if (has_post_thumbnail()) {
	    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), cfg('POST__FEATUREDIMAGE_SIZE', true));
	    
	    ?>
	    
	    <div class="post__image">
		    <?php if(!is_single()) { ?>
		    	<a class="post__imageLink" href="<?php the_permalink(); ?>">
			<?php } ?>
			
			<img src="<?php echo $large_image_url[0]; ?>">
		    
		    <?php if(!is_single()) { ?>
		    	</a>
		    <?php } ?>
		    
		    <?php if ( $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
    <p class="caption"><?php echo $caption; ?></p>
<?php endif; ?>
	    </div>
	    <?php
		   }
	 }
	 ?>
	 