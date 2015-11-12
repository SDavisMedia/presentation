<?php
/**
 * the closing of the main content elements and the footer element
 */
?>

			</div>
		</div>
	</div>

	<div class="footer-area full">
		<div class="main">
			<footer id="colophon" class="site-footer inner" role="contentinfo">
				<span class="site-info">
					<?php
						$credits = sprintf( __( 'Built with WordPress & %s', 'presentation' ), '<a href="' . PRESENTATION_HOME . '">' . PRESENTATION_NAME . '</a>' );
						// If copyright & credits are left empty or have not been set, display default info.
						if ( '' == get_theme_mod( 'presentation_credits_copyright' ) ) :
							echo $credits;
						else :
							echo get_theme_mod( 'presentation_credits_copyright', $credits );
						endif;
					?>
				</span>
			</footer>
		</div>
	</div>

<?php wp_footer(); ?>

</body>
</html>