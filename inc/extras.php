<?php
/**
 * Custom functions that act independently of the theme templates
 */
 
/**
 * social profiles
 */
function presentation_social_profiles() { 
	if ( get_theme_mod( 'presentation_twitter' ) || get_theme_mod( 'presentation_facebook' ) || get_theme_mod( 'presentation_gplus' ) || get_theme_mod( 'presentation_linkedin' ) ) : ?>
		<div class="social-links">
			<?php
			$social_profiles = array( 
				'twitter'	=> array(
					'icon' 		=> '<i class="fa fa-twitter-square"></i>',
					'option'	=> esc_url( get_theme_mod( 'presentation_twitter' ) )
				),
				'facebook'	=> array(
					'icon' 		=> '<i class="fa fa-facebook-square"></i>',
					'option'	=> esc_url( get_theme_mod( 'presentation_facebook' ) )
				),
				'gplus'	=> array(
					'icon' 		=> '<i class="fa fa-google-plus-square"></i>',
					'option'	=> esc_url( get_theme_mod( 'presentation_gplus' ) )
				),
				'linkedin'	=> array(
					'icon' 		=> '<i class="fa fa-linkedin-square"></i>',
					'option'	=> esc_url( get_theme_mod( 'presentation_linkedin' ) )
				),
			);
			foreach ( $social_profiles as $profile ) {
				if ( '' != $profile[ 'option' ] ) :
					echo '<a href="', $profile[ 'option' ], '">', $profile[ 'icon' ], '</a>'; 
				endif;
			}
			?>
		</div>
	<?php 
	endif; // end check for any social profile
}
add_action( 'presentation_social_profiles', 'presentation_social_profiles' ); 

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function presentation_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) :
		$classes[] = 'group-blog';
	endif;
	
	if ( is_page_template( 'edd_templates/edd-store-front.php' ) ) :		
		$classes[] = 'edd-store-front-template';
	elseif ( is_page_template( 'edd_templates/edd-checkout.php' ) ) :		
		$classes[] = 'edd-checkout-template';	
	elseif ( is_page_template( 'edd_templates/edd-confirmation.php' ) ) :		
		$classes[] = 'edd-confirmation-template';
	elseif ( is_page_template( 'edd_templates/edd-history.php' ) ) :		
		$classes[] = 'edd-history-template';
	elseif ( is_page_template( 'edd_templates/edd-members.php' ) ) :		
		$classes[] = 'edd-members-template';
	elseif ( is_page_template( 'edd_templates/edd-failed.php' ) ) :		
		$classes[] = 'edd-failed-template';
	endif;
	
	if ( class_exists( 'bbPress' ) && is_bbpress() && 1 == get_theme_mod( 'presentation_bbpress_full_width' ) ) :
		$classes[] = 'no-sidebar';
	endif;

	return $classes;
}
add_filter( 'body_class', 'presentation_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function presentation_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'presentation_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function presentation_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'presentation_setup_author' );
