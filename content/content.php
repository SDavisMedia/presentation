<?php
/**
 * generic content display
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! has_post_format( 'aside' ) ) : ?>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php sdm_posted_on(); ?>
				</div>
			<?php endif; ?>
		</header>
	<?php endif; ?>

	<?php // show excerpts on search results and main content if options is selected ?>
	<?php if ( ! has_post_format( 'aside' ) && ( is_search() || get_theme_mod( 'sdm_post_content' ) == 'excerpt' ) ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php else : ?>
		<?php if ( has_post_format( 'aside' ) ) : ?>
			<div class="aside-meta">
				<?php sdm_posted_on(); ?>
			</div>
		<?php endif; ?>
		<div class="entry-content">
			
			<?php 
			// display featured image full
			if ( has_post_thumbnail() && get_theme_mod( 'sdm_featured_image' ) != 0 ) :
				the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) );
			endif;
			
			the_content( __( get_theme_mod( 'sdm_read_more' ), 'sdm' ) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sdm' ),
				'after'  => '</div>',
			) );
			?>
		</div>
	<?php endif; ?>
	
	<?php if ( has_post_format( 'aside' ) ) : ?>
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
	<?php endif; ?>
</article>
