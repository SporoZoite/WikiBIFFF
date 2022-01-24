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
						<label class="labelTitle">Edition:</label>
						<label class="labelContent">
							<?php 
							$linked_editions = get_field('edition');
							if( $linked_editions ):
								foreach( $linked_editions as $edpost ): 
								echo("<a href='".get_post_permalink($edpost->ID)."'>".$edpost->post_title."</a> ");
								endforeach;
							endif;
							?></label>
					</div>
		          
					<div>
						<label class="labelTitle">Sections:</label>
						<label class="labelContent"><?php
							$sec=get_term(get_field("sections")[0], "section"); 
							echo($sec->name);
							?></label>
					</div>	
					
					<div>
						<label class="labelTitle">Location:</label>
						<label class="labelContent"><?php
							if (get_field("location")):
								$loc=get_term(get_field("location"), "locations"); 
								echo($loc->name);
							endif;
							?></label>
					</div>	
										
					<div>
						<label class="labelTitle">Dates:</label>
						<label class="labelContent"><?php the_field('date');?></label>
					</div>	
	            </div>
	            
	           
	            
	            <div class="col-md-8">
		            <label class="labelTitle"></label><br/>
		            <label class="labelContent">
		       
		            </label>
	            </div>	            

            </div>
            
            <?php
	        	$movies_linked=get_field("movies");  
	        	if ($movies_linked) { 
	        ?>
            
			<div><h4>Movies</h4></div>
            <div class="mb-1 row">
	            <div class="col-md-12"> 
		            
		        	<div class="channel">
		                <div class="app">
			                <ul class="hs full">
			                <?php
			                	foreach ($movies_linked as $mv):
									$imgurl=get_the_post_thumbnail_url($mv);
									if ($imgurl){
	                		?>
								<li class="item"style="background-color:#000000;height:25rem;">
		                        <a href="<?php echo get_permalink($mv); ?>">
		                        	<img src="<?php echo get_the_post_thumbnail_url($mv); ?>" style="height:25rem;" title="<?php echo get_the_title($mv); ?>" alt="<?php echo get_the_title($mv); ?>"/>
		                        </a>
								</li>
			            	<?php 
				            	};
				            	endforeach; ?>
			            	</ul>
		                </div>
				    </div>	
				    
	            </div>
            </div>  
            <?php
	            }
	        ?>         
            
            
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

        <?php
        	$guests = get_field('guests');
        	if ($guests) { 
        ?>

        <div><h4>Guests</h4></div>

        <div class="mb-1 row">
			<div class="col-md-12">
            <?php 
			
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
	    </div>

		
		<?php
	        }
	    ?>
	

		</div>
    </div>	
	
	
</div>

<script>
	 var root = document.documentElement;
const lists = document.querySelectorAll('.hs'); 

lists.forEach(el => {
  const listItems = el.querySelectorAll('li');
  const n = el.children.length;
  el.style.setProperty('--total', n);
});
	 
</script>   

<?php get_footer(); ?>
