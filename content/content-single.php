<?php
/**
 * The template used for displaying single post content in single.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( ! has_post_format( 'aside' ) ) : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php endif; ?>

		<div class="entry-meta">
			<?php sdm_posted_on(); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php
			// display featured image?
			if ( has_post_thumbnail() && get_theme_mod( 'sdm_single_featured_image' ) == 1 ) :
				the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) );
			endif; 
			the_content(); 
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sdm' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<footer class="entry-meta">
		<?php
		$category_list = get_the_category_list( __( ', ', 'sdm' ) );
		$tag_list = get_the_tag_list( '', __( ', ', 'sdm' ) );

		if ( ! sdm_categorized_blog() ) :
			// This blog only has 1 category so we just need to worry about tags in the meta text
			if ( '' != $tag_list ) :
			?>
				<span class="tags-links tax-links">
					<i class="fa fa-tags"></i><?php echo $tag_list; ?>
				</span>
			<?php
			endif;
		else : 
			// But this blog has loads of categories so we should probably display them here
			if ( '' != $tag_list ) :
			?>
				<span class="cat-links tax-links">
					<i class="fa fa-archive"></i><?php echo $category_list; ?>
				</span><br>
				<span class="tags-links tax-links">
					<i class="fa fa-tags"></i><?php echo $tag_list; ?>
				</span>
			<?php
			else :
			?>
				<span class="cat-links tax-links">
					<i class="fa fa-archive"></i><?php echo $category_list; ?>
				</span>
			<?php
			endif;
		endif;
		?>
	</footer>
</article>

<?php // show post footer? theme customizer options ?>
<?php if ( get_theme_mod( 'sdm_post_footer' ) == 1 && ! has_post_format( 'aside' ) ) : ?>
	<div class="single-post-footer clear">
		<div class="post-footer-author">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', get_the_author_meta( 'display_name' ) ); ?>
			<h5 class="author-name"><?php echo __( 'written by ', 'sdm' ) . get_the_author_meta( 'display_name' ); ?></h5>
			<div class="social-links">
				<?php
				$social_profiles = array( 
					'twitter'	=> array(
						'icon' 		=> '<i class="fa fa-twitter-square"></i>',
						'option'	=> get_theme_mod( 'sdm_twitter' )
					),
					'facebook'	=> array(
						'icon' 		=> '<i class="fa fa-facebook-square"></i>',
						'option'	=> get_theme_mod( 'sdm_facebook' )
					),
					'gplus'	=> array(
						'icon' 		=> '<i class="fa fa-google-plus-square"></i>',
						'option'	=> get_theme_mod( 'sdm_gplus' )
					),
					'linkedin'	=> array(
						'icon' 		=> '<i class="fa fa-linkedin-square"></i>',
						'option'	=> get_theme_mod( 'sdm_linkedin' )
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
		<?php if ( ! get_the_author_meta( 'description' ) == '' ) : ?>
			<div class="post-footer-author-bio">
				<p><?php echo get_the_author_meta( 'description' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>