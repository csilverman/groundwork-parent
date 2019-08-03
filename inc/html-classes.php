<?php 
	
$html__classes = "wp";

//	First, add post categories to the class list
//	But only if we're on a post page

if (is_single()) {
	global $post;
	$category = get_the_category($post->ID);
	for ($i=0;$i<count($category);$i++) {
		$html__classes .= " cat--".$category[$i]->name;	
	}
}

//	Then add classes for whatever page we're on

function theSlug() {
	if(SITE__CUSTOM_CLASS_FOR_EACH_PAGE) {
		if ( is_home() ) {
			$theSlug = false;
		}
		else {
			global $post;
			$theSlug = get_post( $post )->post_name;
			if ( is_page() ) {
				$theSlug = "page--".$theSlug;
			} else {
				$theSlug = "post--".$theSlug;
			}
			return $theSlug;
		}
	}
}

$html__classes .= " ".theSlug();

//	Now add any classes the user specified in custom fields

if (is_single()) {
	global $wp_query;
	$postid = $wp_query->post->ID;
	$html__classes .= " ".get_post_meta($postid, "html__classes", true);
	wp_reset_query();
}

?>