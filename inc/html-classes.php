<?php

//	Here's where we set up the HTML classes.
//	Right now, I'm just adding everything onto a string, but this
//	should really be an array.

$html__classes = 'wp no-js ';


//	First of all: to subnav or not to subnav?

//	If a page has subpages, subnav will automatically be shown. However,
//	this can be overridden with a custom field of `noSubnav`, set to true.
$no_subnav = get_post_meta($post->ID, 'noSubnav', true);

if ( has_subpage() && !$no_subnav && !is_404() ) $html__classes .= ' has-subnav';
else $html__classes .= ' no-subnav';

//	Now then; do we have a sidebar or not?

$no_sidebar = get_post_meta($post->ID, 'vpress__no-sidebar', true);

if($no_sidebar) $html__classes .= ' no-sidebar';
else $html__classes .= ' has-sidebar';

//	On Offices, the blog feature is being used for announcements. Since it's a list of
//	announcements, we want a more compact layout for each post similar to the standard Vassar news page.

if(!is_singular() && cfg('BLOG__USE_MINIPOST')) $html__classes .= ' minimal-post-on-frontpage';

if( is_404() ) $html__classes .= ' page';

if(is_singular()) $html__classes .= ' is-singular';

if(has_post_thumbnail()) $html__classes .= ' has-postThumbnail';

//	Get the root parent for this page

$this_post_parent = get_root_parent($post);
$parent_slug = $this_post_parent->post_name;

$html__classes .= ' rootParent-'.$parent_slug;

	
// $html__classes = "wp";

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