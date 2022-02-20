<?php get_header() ?>

<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/drop.svg" id="myBtn" title="Go to top">
<div class="single-container">

    <div class="mb-2 row">

    	<div class="col-md-3">
            <div class="mb-3 rounded bg-light">
        	<img src="<?php echo get_the_post_thumbnail_url() ?>" style="width:100%;margin-bottom:10px;">
            </div>

	        <div class="singleFilmButtonBox">
		        <a href="#" class="singleFilmButton">WATCH TRAILER</a>
		        <div class="singleFilmButton"> <?php the_terms(get_the_ID(), 'category'); ?> MOVIE LIST</div>
		        <a href="http://localhost/wikibifff/films/" class="singleFilmButton">BIFFF MOVIE LIST</a>
	        </div>

		</div>

		<div class="col-md-9 ">


            <h3><?php the_title();?></h3>
            <p> <?php the_content();?></p>
            
            <div class="row single-infos rounded bg-dark">
	            <div class="col-md-4">

					<div>
						<label class="labelTitle">Jobtitle: </label>
						<label class="labelContent"><?php the_field('jobtitle');?></label>
					</div>
		            
					<div style="display:flex;">
						<label class="labelTitle">Year(s): </label>
						<label class="labelContent"> <?php the_category();?></label>
					</div>
					
					<div>
						<label class="labelTitle">Country: </label>
						<label class="labelContent"> <?php the_terms(get_the_ID(), 'country'); ?></label>
					</div>		           

					<div>
						<label class="labelTitle">Sections: </label>
						<label class="labelContent"><?php the_field('length');?></label>
					</div>	
					

	            </div>
	            
	           
	            
	            <div class="col-md-8">
		            <label class="labelTitle">Participation:</label><br/>
		            <label class="labelContent">
		            <?php
						if( have_rows('participation') ):
							while( have_rows('participation') ) : the_row();
								
								if (get_sub_field('year')):
									$yeared=get_term(get_sub_field('year')[0]);
									echo($yeared->name." - ");
								endif;

								if (get_sub_field('type')):
									$typ=get_term(get_sub_field('type'),'guest_type');
									echo($typ->name." - ");
								endif;
	
								if (get_sub_field('competition')):
									$comp=get_term(get_sub_field('competition'),'competition');
									echo($comp->name." - ");
								endif;
								
								$movies=get_sub_field('movie');
								if ($movies):
									foreach( $movies as $movie):
										echo("<a href='".get_post_permalink($movie->ID)."'>".$movie->post_title."</a> ");
									endforeach;
								endif;

								$events=get_sub_field('event');
								if ($events):
									foreach( $events as $event):
										echo("<a href='".get_post_permalink($event->ID)."'>".$event->post_title."</a> ");
									endforeach;
								endif;
							
								echo "<br>";
							endwhile;
						endif;
			            
			            ?>
		            </label>
	            </div>	            

            </div>

            <div><h4>Gallery</h4></div>
            <div class="mb-1 row">
	            <div class="col-md-12">
						<?php

							// Load value (array of ids).
							$images = get_field('gallery');
							$image_ids = array();
							//print_r($images[0]);
							foreach( $images as $image ):
							
							//echo $image["ID"];
							array_push($image_ids, $image["ID"]);
							endforeach;
							//echo "xxx". implode( ',', $image_ids )."yyy";
							if( $image_ids ) {
							
							    // Generate string of ids ("123,456,789").
							    $images_string = implode( ',', $image_ids );
							
							    // Generate and do shortcode.
							    // Note: The following string is split to simply prevent our own website from rendering the gallery shortcode.
							    $shortcode = sprintf( '[' . 'gallery ids="%s" size="medium" link="file" columns="6"]', esc_attr($images_string) );
							    echo do_shortcode( $shortcode );
							    //echo do_shortcode( '[simplemasonrygallery][gallery ids="17105,17102,17099,17096,17093,17090,17087,17084,17081,17078,17075" size="medium" link="file"][/simplemasonrygallery]' );
							}
						?>		            
	            </div>
            </div>

		</div>
	</div>
	
	
</div>

<?php get_footer(); ?>
