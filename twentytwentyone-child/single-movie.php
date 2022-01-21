<?php get_header() ?>

<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/drop.svg" id="myBtn" title="Go to top">
<div class="single-container">

    <div class="mb-2 row">

    	<div class="col-md-3">
            <div class="mb-3 rounded bg-light">
        	<img src="<?php echo get_the_post_thumbnail_url() ?>" style="width:100%;margin-bottom:10px;">
			</div>

	        <div class="singleFilmButtonBox">
		        <?php
			    $trailer=get_field("trailer");
			    if ($trailer){
		        echo do_shortcode( '[wp-video-popup start="0" video="'.$trailer.'"]' );
		        ?>
		        <a href="#" class="singleFilmButton wp-video-popup">WATCH TRAILER</a>
		        <?php
			        }
			    ?>
		        <div class="singleFilmButton"> <?php the_terms(get_the_ID(), 'category'); ?> MOVIE LIST</div>
		        <a href="http://localhost/wikibifff/movie/" class="singleFilmButton">BIFFF MOVIE LIST</a>
	        </div>

		</div>

		<div class="col-md-9 ">


            <h3><?php the_title();?></h3>
            <p> <?php the_content();?></p>
            
            <div class="row rounded bg-dark" id="single-infos">
	            <div class="col-md-4">

					<div>
						<label class="labelTitle">BIFFF Edition:</label>
						<label class="labelContent"><?php 
							$linked_editions = get_field('edition');
							if( $linked_editions ):
								foreach( $linked_editions as $edpost ): 
								echo("<a href='".get_post_permalink($edpost->ID)."'>".$edpost->post_title."</a> ");
								endforeach;
							endif;
							?></label>
					</div>

					<div>
						<label class="labelTitle">Genre:</label>
						<label class="labelContent"><?php 
							$genres=get_field('genres');
							foreach ($genres as $genre){
								$genre_term=get_term($genre);
								echo($genre_term->name.", ");
								}
							?></label>
					</div>
		            
					<div>
						<label class="labelTitle">Year:</label>
						<label class="labelContent"><?php the_field('year');?></label>
					</div>
					
					<div>
						<label class="labelTitle">Country:</label>
						<label class="labelContent"><?php the_terms(get_the_ID(), 'country'); ?></label>
					</div>		           

					<div>
						<label class="labelTitle">Length:</label>
						<label class="labelContent"><?php the_field('length');?></label>
					</div>	
					
					<div>
						<label class="labelTitle">Audio:</label>
						<label class="labelContent"><?php the_field('audio');?></label>
					</div>	
					
					<div>
						<label class="labelTitle">Subtitles:</label>
						<label class="labelContent"><?php the_field('subtitles');?></label>
					</div>	

	            </div>
	            
	            
	            <div class="col-md-4">
		            <div>
						<label class="labelTitle">Casting:</label>
						<label class="labelContent"><?php the_field('casting');?></label>
					</div>
					
					<div>
						<label class="labelTitle">Director:</label>
						<label class="labelContent"><?php the_field('director'); ?></label>
					</div>		           

					<div>
						<label class="labelTitle">Producer:</label>
						<label class="labelContent"><?php the_field('producer');?></label>
					</div>	
					
					<div>
						<label class="labelTitle">Screenwriter:</label>
						<label class="labelContent"><?php the_field('screenwriter');?></label>
					</div>	
					
					<div>
						<label class="labelTitle">Soundtrack:</label>
						<label class="labelContent"><?php the_field('soundtrack');?></label>
					</div>
					
					<div>
						<label class="labelTitle">Distributor:</label>
						<label class="labelContent"><?php the_field('distributor');?></label>
					</div>		
	            </div>
	            
	            <?php
					if( have_rows('competitions') ):
						$comp_list=array();
						$prize_list=array();
						while( have_rows('competitions') ) : the_row();
							$tmp=array();	
							
							if (get_sub_field('year_edition')):
								$yeared=get_term(get_sub_field('year_edition'));
								array_push($tmp,$yeared->name);
							endif;
	
							if (get_sub_field('competition')):
								$comp=get_term(get_sub_field('competition'),'competition');
								array_push($tmp,$comp->name);
							endif;
							
							if (get_sub_field('price')){
								$price=get_term(get_sub_field('price'),'price');
								array_push($tmp,$price->name);

								if (get_sub_field('winner')):
									$w=get_sub_field('winner');
									foreach( $w as $entry ):
										array_push($tmp,$entry);
									endforeach;
								endif;
								
								array_push($prize_list,join(" - ",$tmp));
							} else {
								array_push($comp_list,join(" - ",$tmp));
							}
								
						endwhile;
					endif;
		            
		            ?>	            
	            
	            
	            
	            <div class="col-md-4">
		            <?php 
			            if ($prize_list){
				    ?>
			            <label class="labelTitle">Prize:</label>
			            <label class="labelContent">
			            <ul>
			            <?php
				            foreach ($prize_list as $p){
					            echo "<li>".$p."</li>";
				            }
				            ?>
			            </ul>
			            </label>
			        <?php
				         }
				         if ($comp_list){
				    ?>  
		            <label class="labelTitle">Competitions:</label>
		            <label class="labelContent">
		            <ul>
		            <?php
			            foreach ($comp_list as $c){
				            echo "<li>".$c."</li>";
			            }
			            ?>
		            </ul>
		            </label>
		            <?php
				         }
				    ?>  
	            </div>	            

            </div>

	        <?php
	        	$guests = get_field('guests');
	        	if ($guests) { 
	        ?>

            <div><h4>Guests</h4></div>

            <div class="mb-1 row">

		    <?php 
			$guests = get_field('guests');
			if( $guests ):
				foreach( $guests as $guest ): ?>
				
			    <div class="col-md-3 rounded">
			    <?php
					echo("<a href='".get_post_permalink($guest->ID)."'>".$guest->post_title."</a> ");
			    ?>
			    </div>
		     <?php
				endforeach;
			endif;
		     ?>

            </div>
            <?php 
	            }

	        	$images = get_field('galleryGallery');
	        	if ($images) { 
	        ?>            
            
            <div><h4>Gallery</h4></div>
            <div class="mb-1 row">
	            <div class="col-md-12">
						<?php

							// Load value (array of ids).
							
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
							}
						?>		            
	            </div>
            </div>
            <?php 
	            }
	        ?>             
            
            
		</div>		
	</div>
	

	
</div>

<?php get_footer(); ?>
