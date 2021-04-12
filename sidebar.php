<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package groundwork
 */
?>
<?php if(SITE__HAS_SIDEBAR) { ?>
	<div class="sidebar">
		<?php do_action( 'gwp_inner_sidebar_before' ); ?>

		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
		<?php endif; // end sidebar widget area ?>

		<?php do_action( 'gwp_inner_sidebar_after' ); ?>
	</div>
<?php } ?>