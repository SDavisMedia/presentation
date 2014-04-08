<?php
/**
 * default search form
 */
?>
<form role="search" method="get" id="search-form" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'sdm' ); ?></label>
        <input type="search" placeholder="Search&hellip;" name="s" id="search-input" />
        <input class="screen-reader-text" type="submit" id="search-submit" value="Search" />
    </div>
</form>