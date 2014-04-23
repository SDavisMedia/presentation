<?php
/**
 * The Sidebar containing the bbPress widget areas.
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php if ( is_active_sidebar( 'sidebar-bbpress' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-bbpress' ); ?>
		<?php else : ?>
			<?php dynamic_sidebar( 'sidebar-main' ); ?>
		<?php endif; ?>
	</div>