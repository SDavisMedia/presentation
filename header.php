<?php
/**
 * the header element and the opening of the main content elements
 */
$title = get_bloginfo('name');
$tagline = get_bloginfo('description');
$char = get_bloginfo('charset');
$ping = get_bloginfo('pingback_url');
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo $char; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo $ping; ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="top-bar-area full">
		<div class="main">
			<div id="top-bar" class="top-bar inner">
				<?php if ( get_theme_mod( 'presentation_hide_tagline' ) != 1 ) : ?>
					<h1 class="site-description"><?php echo $tagline; ?></h1>
				<?php endif; ?>
				<div class="social-links">
					<?php
					$social_profiles = array( 
						'twitter'	=> array(
							'icon' 		=> '<i class="fa fa-twitter-square"></i>',
							'option'	=> get_theme_mod( 'presentation_twitter' )
						),
						'facebook'	=> array(
							'icon' 		=> '<i class="fa fa-facebook-square"></i>',
							'option'	=> get_theme_mod( 'presentation_facebook' )
						),
						'gplus'	=> array(
							'icon' 		=> '<i class="fa fa-google-plus-square"></i>',
							'option'	=> get_theme_mod( 'presentation_gplus' )
						),
						'linkedin'	=> array(
							'icon' 		=> '<i class="fa fa-linkedin-square"></i>',
							'option'	=> get_theme_mod( 'presentation_linkedin' )
						),
					);
					foreach ( $social_profiles as $profile ) {
						if ( '' != $profile[ 'option' ] ) :
							echo '<a href="', $profile[ 'option' ], '">', $profile[ 'icon' ], '</a>'; 
						endif;
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="header-area full">
		<div class="main">
			<header id="masthead" class="site-header inner">
				<div class="header-elements">
					<span class="site-title">
						<?php if ( get_theme_mod( 'presentation_logo' ) ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo get_theme_mod( 'presentation_logo' ); ?>" alt="<?php echo esc_attr( $title ); ?>">
							</a>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $title ); ?>">
								<?php echo $title; ?>
							</a>
						<?php endif; ?>
					</span>
					<nav id="header-navigation" class="header-menu" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'header', 'fallback_cb' => '' ) ); ?>
					</nav>
				</div>
			</header>
			<div class="main-menu-container inner">
				<nav id="site-navigation" class="main-navigation clear" role="navigation">
					<span class="menu-toggle"><?php echo '<i class="fa fa-bars"></i> ' . __( 'Menu', 'presentation' ); ?></span>
					<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'presentation' ); ?></a>
		
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => '' ) ); ?>
				</nav>
			</div>
		</div>
	</div>
	<div class="main-content-area full">
		<div class="main">
			<div id="content" class="site-content inner">