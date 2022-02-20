<?php
/**
 * Template Name: Bifff-MyTop10
 * Template Post Type: page
 */

get_header();
?>

<div class="top10-container">
	
		<header class="page-header alignwide">
			<h1>My Top 10 list</h1>
		</header><!-- .page-header -->
		
		<div id="mainlist" style="margin-top:1rem;">	
			<div class="row ">
	            <div class="col-md-12">
		            <a class="um-button um-alt" style="width: 10rem;float: right;" href="/top10-new">new top10</a>
	            </div>
			</div>
			<div class="row ">
	            <div class="col-md-12">
		            <hr/>
	            </div>
			</div>				
		<?php 
			$author = get_current_user_id(); // defines your author ID if it is on the post in question

			$args = array(
                 'post_type' => 'top10',
                 'post_status' => 'publish',
                 'author'=>$author,
                 'posts_per_page' => 5, // the number of posts (books) you'd like to show
                 'orderby' => 'date',
                 'order' => 'DESC'
                );
			$results = new WP_Query($args);
			//    '<pre>'.print_r($results).'</pre>'; // This is a useful line to keep - uncomment it to print all results found - it can then be used to work out if the query is doing the right thing or not.
			while ($results->have_posts()) {
			$results->the_post();
			?>
			<div class="row ">
	            <div class="col-md-10"  style="padding-left:4rem;">
				<div class="title-autor">
	            <?php
				echo '<strong>'.get_the_title().'</strong> (by '.get_the_author().')';
	            ?>
				</div>
	            <div class="related_movies">
	            <?php
		            $movies_linked=get_field("movies");  
					if ($movies_linked) { 
						foreach ($movies_linked as $mv):
							$imgurl=get_the_post_thumbnail_url($mv);
							if ($imgurl){
	                		?>
		                        <img class="top-img" src="<?php echo get_the_post_thumbnail_url($mv); ?>" title="<?php echo get_the_title($mv); ?>" alt="<?php echo get_the_title($mv); ?>"/>
							<?php
							}
						endforeach;
					}
		            ?>    
	            </div>
	            </div>
	            <div class="col-md-2" style="display: flex;align-items: center;justify-content: flex-end;">
		            <?php
				echo '<a style="margin-top:1rem;" class="um-button um-alt" href="/top10-edit?id='.get_the_ID().'">edit</a>';
				?>
	            </div>
			</div>
			<div class="row ">
	            <div class="col-md-12">
		            <hr/>
	            </div>
			</div>
			<?php
			}
		?>
		</div>
		

</div>

<?php
get_footer();
?>
