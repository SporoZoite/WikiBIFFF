<?php
/**
 * Template Name: Creators Page
 * Template Post Type: post,page,edition-post
 */

get_header();?>

<header class="page-header alignwide">
    <h1 class="page-title"><?php echo get_the_title(); ?></h1>
</header>

	<div class="quotes-container">

        <div class="quotes-text">
             <?php echo get_the_content(); ?>
        </div>

	</div>
	
<?php
get_footer();
?>
