<?php
/**
 * bbPress search form
 */
?>

<form role="search" method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>">
	<div>
		<input tabindex="<?php bbp_tab_index(); ?>" type="search" placeholder="<?php echo esc_attr_x( 'Search Forums&hellip;', 'placeholder', 'presentation' ); ?>" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" />
		<input tabindex="<?php bbp_tab_index(); ?>" class="search-submit" type="submit" id="bbp_search_submit" value="<?php esc_attr_e( 'Submit', 'presentation' ); ?>" />
	</div>
</form>