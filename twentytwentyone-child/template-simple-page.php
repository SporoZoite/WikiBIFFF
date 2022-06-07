<?php
/**
 * Template Name: Simple Page
 * Template Post Type: post,page,edition-post
 */

get_header();?>

<header class="page-header alignwide">
    <h1 class="page-title"><?php echo get_the_title(); ?></h1>
</header>

	<div class="simple-container">

        <div class="simple-text">
             <?php echo get_the_content(); ?>
        </div>

	</div>
	
<?php
get_footer();
?>
