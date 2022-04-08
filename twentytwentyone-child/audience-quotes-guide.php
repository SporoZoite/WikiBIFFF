
<header class="page-header alignwide">
    <h1 class="page-title"><?php echo get_the_title(); ?></h1>
</header>

	<div class="quotes-container">

        <div class="quotes-text">
             <?php echo get_the_content(); ?>
        </div>
       
        <div class="quotes-list">
		     <?php echo get_post_meta($post->ID, 'audience_quotes', true); ?>
        </div>

	</div>