<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

?>


<div class="movies-container">

    <div class="movies-bar">
	

			<h1>MOVIES</h1>

	
	
		<?php 
			echo do_shortcode('[searchandfilter id="142192"]');
		?>
	</div>	
	
	<div id="mainlist">
	
		<?php 
			echo do_shortcode('[searchandfilter id="142192" show="results"]');
		?>
		
	</div>
	
		

</div>
<?php get_footer(); ?>
