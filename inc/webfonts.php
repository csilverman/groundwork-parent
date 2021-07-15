<?php
	$font_path = get_stylesheet_directory_uri()."/assets/fonts/";
	/*
		If the post has a locally hosted webfont specified, generate the CSS here.
		localfont should be the name of the font file(s), no file extension
	*/
	$fontname = get_post_meta($post->ID, "localfonts", true);
	$fonts = explode(',', $fontname);

	for($i=0; $i<count($fonts); $i++) {
		$the_font = $fonts[$i];
$css_template = <<<FONT
@font-face {
font-family: '$the_font';
src: url( '$font_path/$the_font.eot' );
src: url( '$font_path/$the_font?#iefix' ) format( 'embedded-opentype' ),
 url( '$font_path/$the_font.woff2' ) format( 'woff2' ),
 url( '$font_path/$the_font.woff' ) format( 'woff' ),
 url( '$font_path/$the_font.ttf' ) format( 'truetype' );
}
FONT;
		echo $css_template;
	}
	
?>
