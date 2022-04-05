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


<div class="events-container">

    <div class="events-bar">
	

			<h1>JURY</h1>

	
	
		<?php 
         echo do_shortcode('[searchandfilter id="192240"]'); 
			/* echo do_shortcode('[searchandfilter id="191763"]'); */
		?>
	</div>	
	
	<div id="eventslist">
	
		<?php 
		  echo do_shortcode ('[custom-layout id="192241"]'); 
			/* echo do_shortcode ('[custom-layout id="191764"] '); */
		?>
		
	</div>
	
		

</div>
<?php get_footer(); ?>
