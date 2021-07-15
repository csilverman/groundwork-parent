<<?php h1_or_not(); ?> class="u-Masthead__siteTitle">
	<?php // if(!is_home()) { ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	<?php // } ?>

	<?php if(cfg('HEADER__USE_LOGO')) { ?>
		<img src="<?php echo cfg('HEADER__USE_LOGO', true); ?>" />
	<?php } ?>

	<?php if(cfg('HEADER__USE_INCLUDE')) { ?>
		<?php
			$header_include_path = cfg('HEADER__USE_INCLUDE', true);
			include($header_include_path);
		?>
	<?php } ?>
	
	<b class="u-Masthead__siteTitle__text">
		<?php
			/*
			if (cfg('SITE__CUSTOM_TITLE')) {
				echo SITE__CUSTOM_TITLE; 
			}
			else echo get_bloginfo( 'name' ); 
			*/
			echo gw__get_site_title();
		?>
	</b>
	
	<?php // if(!is_home()) { ?>
	</a>
	<?php // } ?>

</<?php h1_or_not(); ?>>
