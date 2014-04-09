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
	<div class="single-post-footer">
		Post Footer
	</div>
<?php endif; ?>