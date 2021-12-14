<?php get_header() ?>


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
	            
	            <div class="col-md-4">
		            <label class="labelTitle">Prize:</label>
		            <label class="labelContent">
		            <?php
						if( have_rows('competitions') ):
							while( have_rows('competitions') ) : the_row();

							if (get_sub_field('year_edition')):
								$yeared=get_term(get_sub_field('year_edition'));
								echo($yeared->name." - ");
							endif;

							if (get_sub_field('competition')):
								$comp=get_term(get_sub_field('competition'),'competition');
								echo($comp->name." - ");
							endif;
							
							if (get_sub_field('price')):
								$price=get_term(get_sub_field('price'),'price');
								echo($price->name." - ");
							endif;
							
							if (get_sub_field('winner')):
								$w=get_sub_field('winner');
								foreach( $w as $entry ):
									echo($entry);
								endforeach;
							endif;
									
							endwhile;
						endif;
			            
			            ?>
		            </label>
	            </div>	            

            </div>

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
		</div>		
	</div>
	

	
</div>

<?php get_footer(); ?>
