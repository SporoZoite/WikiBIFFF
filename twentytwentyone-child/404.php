<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

<div class="container">
	<svg class="ghost" xmlns="http://www.w3.org/2000/svg" width="145" height="140" viewBox="0 0 145 140">
  <ellipse id="Ellipse_1" data-name="Ellipse 1" cx="72.5" cy="70" rx="72.5" ry="70" fill="#fff"/>
  <ellipse id="Ellipse_2" data-name="Ellipse 2" cx="44.5" cy="43" rx="44.5" ry="43" transform="translate(28 27)" fill="#d00019"/>
  <ellipse id="Ellipse_3" data-name="Ellipse 3" cx="26.5" cy="25.5" rx="26.5" ry="25.5" transform="translate(46 45)"/>
  <circle id="Ellipse_4" data-name="Ellipse 4" cx="9" cy="9" r="9" transform="translate(81 52)" fill="#fff"/>
</svg>
 <p class="shadowFrame"><svg version="1.1" class="shadow" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="61px" y="20px"
	 width="122.436px" height="39.744px" viewBox="0 0 122.436 39.744" enable-background="new 0 0 122.436 39.744"
	 xml:space="preserve">
<ellipse fill="#9c0b0b" cx="61.128" cy="19.872" rx="49.25" ry="8.916"/>
    </svg></p>
</div>

	<div class="error-404 not-found default-max-width">
		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentytwentyone' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .page-content -->
	</div><!-- .error-404 -->

<?php
get_footer();
