<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->
	<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>


	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
				<ul class="footer-navigation-wrapper">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'items_wrap'     => '%3$s',
							'container'      => false,
							'depth'          => 1,
							'link_before'    => '<span>',
							'link_after'     => '</span>',
							'fallback_cb'    => false,
						)
					);
					?>
				</ul><!-- .footer-navigation-wrapper -->
			</nav><!-- .footer-navigation -->
		<?php endif; ?>

		<div class="footer-wrapper">
			<div class="footer-copyright">
			<p>©BIFFF 2021 all right reserved</p>
			</div>
			<div class="footer-socials">
			 <img onclick="window.location.href='https://www.facebook.com/BrusselsInternationalFantasticFilmFestival';" class="footer-social" src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook.svg" alt="bifff-social">
			 <img onclick="window.location.href='https://twitter.com/bifff_festival';" class="footer-social" src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter.svg" alt="bifff-social">
			 <img onclick="window.location.href='https://www.instagram.com/bifff_festival/';" class="footer-social" src="<?php echo get_stylesheet_directory_uri(); ?>/images/instagram.svg" alt="bifff-social">
			 <img onclick="window.location.href='https://www.youtube.com/c/BIFFF_festival';" class="footer-social" src="<?php echo get_stylesheet_directory_uri(); ?>/images/youtube.svg" alt="bifff-social">
			</div>
		</div>
		
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
