<?php get_header() ?>


<div class="single-container">

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


            <h3><?php the_title();?></h3>
            <p> <?php the_content();?></p>
            
            <div class="row single-infos rounded bg-dark">
	            <div class="col-md-4">

					<div>
						<label class="labelTitle">Jobtitle:</label>
						<label class="labelContent"><?php the_field('jobtitle');?></label>
					</div>
		            
					<div>
						<label class="labelTitle">Year:</label>
						<label class="labelContent"><?php the_category();?></label>
					</div>
					
					<div>
						<label class="labelTitle">Country:</label>
						<label class="labelContent"><?php the_terms(get_the_ID(), 'country'); ?></label>
					</div>		           

					<div>
						<label class="labelTitle">Sections:</label>
						<label class="labelContent"><?php the_field('length');?></label>
					</div>	
					
					<div>
						<label class="labelTitle">Gallery:</label>
						<label class="labelContent"><?php the_field('audio');?></label>
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


		</div>
	</div>
	
    <div class="mb-2 row">

    	<div class="col-md-12"><h4></h4></div>
    </div>
    <div class="mb-2 row">



    </div>	
	
	
</div>

<?php get_footer(); ?>
