<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */
if ( class_exists( 'bbPress' ) && is_bbpress() && 1 == get_theme_mod( 'presentation_bbpress_full_width' ) ) :
	$bbpress_fw = 'bbpress-content';
else :
	$bbpress_fw = 'content-area';
endif; 

get_header(); ?>

	<div id="primary" class="<?php echo $bbpress_fw; ?>">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content/content', 'page' ); ?>

				<?php
					// only allow comments if chosen in theme customizer
					if ( get_theme_mod( 'presentation_page_comments' ) == 1 ) :
					
						// if comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main>
	</div>

<?php 
	if ( class_exists( 'bbPress' ) && is_bbpress() ) :
		if ( 1 != get_theme_mod( 'presentation_bbpress_full_width' ) ) :
			get_sidebar( 'bbpress' );
		endif;
	else :
		get_sidebar();
	endif;
?>
<?php get_footer(); ?>
