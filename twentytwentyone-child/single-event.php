<?php get_header() ?>


<div class="container">

    <div class="mb-2 row">

    	<div class="col-md-3">

        	<img src="<?php echo get_the_post_thumbnail_url() ?>" style="width:100%;margin-bottom:10px;">

	        <div class="singleFilmButtonBox">
		        <a href="#" class="singleFilmButton">WATCH TRAILER</a>
		        <div class="singleFilmButton"> <?php the_terms(get_the_ID(), 'category'); ?> MOVIE LIST</div>
		        <a href="http://localhost/wikibifff/films/" class="singleFilmButton">BIFFF MOVIE LIST</a>
	        </div>

		</div>

		<div class="col-md-9 ">


            <h1><?php the_title();?></h1>
            <p> <?php the_content();?></p>
            
            <div class="row">
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

					<div>
						<label class="labelTitle">Gallery:</label>
						<label class="labelContent"><?php the_field('audio');?></label>
					</div>	
					

	            </div>
	            
	           
	            
	            <div class="col-md-8">
		            <label class="labelTitle"></label><br/>
		            <label class="labelContent">
		       
		            </label>
	            </div>	            

            </div>


		</div>
	</div>
	
    <div class="mb-2 row">

    	<div class="col-md-12"><h3>Guests</h3></div>
    </div>
    <div class="mb-2 row">

		<?php 
			$guests = get_field('guests');
			if( $guests ):
				foreach( $guests as $guest ): ?>
				
		<div class="col-md-3">
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

<?php get_footer(); ?>
