<?php if(!cfg('SITE__NO_NAV')) { ?>

		<div class="nav u-NavSite" id="navigation">
			<nav role="navigation">
	
	<a href="#close-menu" class="icon icon-close"> <svg aria-labelledby="close-menu-title" role="img" viewBox="0 0 8 8"><title id="close-menu-title">CLose Menu</title> <line stroke="#000" fill="none"></line> <path d="M7.93 6.43l-2.43-2.43 2.43-2.43.06-.09c.03-.09.01-.19-.06-.26l-1.15-1.15c-.07-.07-.17-.09-.26-.05l-.09.05-2.43 2.43-2.43-2.43-.09-.05c-.08-.04-.19-.02-.26.05l-1.15 1.15c-.07.07-.09.17-.05.26l.06.09 2.42 2.43-2.43 2.43-.05.09c-.04.09-.02.19.05.26l1.15 1.15c.07.07.18.09.26.05l.09-.06 2.43-2.42 2.43 2.43.09.06c.09.03.19.01.26-.06l1.15-1.15c.07-.07.09-.17.05-.26l-.05-.09z"></path> <image alt="Close Menu" height="32" src="/chsilverman/mediastudies1034icon-32-close.png" width="32"></image> </svg></a>
	
				<a class="ac-NavAnchor ac-NavAnchor--top icomoon-top" href="#page">top</a>
			<!--<h1 class="menu-toggle"><?php _e( 'Menu', 'groundwork' ); ?></h1>-->
	
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	
			</nav>
		</div> <!-- /u-NavSite -->


<nav class="u-NavSite u-NavSite__secondary" id="s-navigation" tabindex="-1" aria-hidden="true">

<?php

wp_nav_menu( array(
  'menu'     => 'Main Navigation',
  'sub_menu' => true,
  'container_class' => 'menu-subnav-container',
  'menu_id' => '',
  'menu_class' => 'u-NavSite__level--2',
) );

?>

</nav>

<?php } ?>

