
<header class="page-header alignwide">
    <h1 class="page-title"><?php echo get_the_title(); ?></h1>
</header>

	<div class="quotes-container">
		<?php echo get_post_meta($post->ID, 'audience_quotes', true); ?>
	</div>