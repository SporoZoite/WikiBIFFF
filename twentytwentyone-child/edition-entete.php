
<?php
	// load all movies and sort them!

	$edition_year=get_field("year");
	$currentcatid=$post->ID;
	$movies = get_posts( 
		array( 
			'post_type' => 'movie',
		    'category__in' => wp_get_post_categories( $post->ID ), 
		    'numberposts'  => 300,
		    'orderby'=>'title',
		    'order'=>'ASC'
		) 
	);
	
	$sections_disp=get_field("displayed_sections");
	$events_disp=get_field("displayed_events");
	
	$opening=array();
	$closing=array();
	$winner_mv=array();
	$winner_st_mv=array();
	$winner_lt_mv=array();
	$cp_movies=0;
	$cp_short=0;
	$cp_premiere=0;
	$section_array=array();
	$competition_array=array();
	foreach($movies as $mv){
		$sc=get_field("schedule",$mv->ID);
		if (! is_null($sc) && is_array($sc) && count($sc)>0){
			if ($sc[0]=="opening"){
				array_push($opening, $mv);
			}
			if ($sc[0]=="closing"){
				array_push($closing, $mv);
			}
		}
		$mtype=get_field("movie_type",$mv->ID);
		if ($mtype=="short"){
			$cp_short=$cp_short+1;
		}
		if ($mtype=="movie"){
			$cp_movies=$cp_movies+1;
		}
		$pr=get_field("premiere",$mv->ID);
		if (! is_null($pr) && $pr!==""){
			$cp_premiere=$cp_premiere+1;
		}
		
		
		$sec=get_field("sections",$mv->ID);
		if (is_array($sec)){
				$seca=$sec;
			} else {
				$seca=[$sec];
			}
		//print_r($sec);
		if (is_array($seca)){
			foreach ($seca as $s){
			//echo "..".$sec."<br/>";

				if (is_int($s)){
					if (isset($section_array[$s])!==true) {
						$section_array[$s]=[$mv];		
					} else {
						array_push($section_array[$s],$mv);
					}
				}	
				//print_r($s);		
			}
		}
		
		
		if (have_rows("competitions", $mv->ID)){
			$allrows=get_field("competitions",$mv->ID);
			foreach ($allrows as $checkRow){
				$take_it=true;
				if (is_int($checkRow["year_edition"])){
					//echo "year edition:".get_term( $checkRow["year_edition"] )->name."***".get_term( $edition_year)->name;
					if (get_term( $checkRow["year_edition"] )->name !== get_term( $edition_year)->name){
						$take_it=false;
					}
				}
				if ($take_it){
					if (is_int($checkRow["competition"])){
						if (isset($competition_array[$checkRow["competition"]])!==true) {
							$competition_array[$checkRow["competition"]]=[$mv];		
						} else {
							array_push($competition_array[$checkRow["competition"]],$mv);
						}
					}
					if (is_array($checkRow["winner"]) && count($checkRow["winner"])>0){
						if ($checkRow["winner"][0]=="winner"){
							
							$subcomp = $checkRow["competition"];
							$subcomp_txt=($subcomp && $subcomp!=="")? get_term( $subcomp )->name: "";
							
							$subprice =$checkRow["price"];
							$subprice_txt=($subprice && $subprice!=="")? get_term( $subprice )->name: "";
							
							$mv->lineprice=$subcomp_txt."-".$subprice_txt;
							$tmpmv=clone($mv);
							if ($mtype=="movie"){
								array_push($winner_lt_mv, $tmpmv);
							} else {
								array_push($winner_st_mv, $tmpmv);
							}
						}
					}
				}
			}
		}
	}
	$winner_mv=array_merge($winner_lt_mv, $winner_st_mv);
	//print_r($competition_array);
	//print_r(array_keys($section_array));
	?>

<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/drop.svg" id="myBtn" title="Go to top">


<main class="edition-container" style="overflow:hidden;">

    <div class="mb-2 row">

        <div class="col-md-3">
            <div class="mb-3 rounded bg-light">
	            <?php the_post_thumbnail('medium'); ?>
            </div>
            <div>
                <a href="#" class="singleFilmButton">WATCH TRAILER</a>
                <a href="#edprize" class="singleFilmButton">PRICES</a>
                <a href="#edcompetitions" class="singleFilmButton">COMPETITIONS</a>
                <a href="#edsections" class="singleFilmButton">SECTIONS</a>
                <a href="#edmovies" class="singleFilmButton">MOVIES LIST</a>
                <a href="#edshorts" class="singleFilmButton">SHORTS LIST</a>
                <a href="#edguests" class="singleFilmButton">GUESTS LIST</a>
                <a href="#edevents" class="singleFilmButton">EVENTS LIST</a>
                
            </div>
        </div>

        <div class="col-md-6">
            <div class="overflow-hidden row g-0 flex-md-row h-md-250 position-relative">
                <div class="col d-flex flex-column position-static">
	                
	                
	                


                </div>
            </div>
            <div class="mb-6 row">
	            
	            <div class="col-md-12">
		            
		            
		             <h3 id = "edition-title" class="mb-3"><?php the_field('name'); ?>  </h3>
					<p class="mb-3" style="padding-top:0rem;"><?php the_content(); ?></p>
		            
	            </div>
                
            </div>

           

        </div>

        <div class="col-md-3">
            <div id="edition-infos" class="p-4 mb-3 rounded bg-dark">
                    <ul>
                        <li><span style="color: #BE1B17; font-family: 'RobotoBold';  text-shadow: -1px 1px 0 #000, 1px 1px 0 #000, 1px -1px 0 #000,
      -1px -1px 0 #000;">DATES : <br></span><?php echo get_field("dates"); ?></li>
                        <li><span style="color: #BE1B17; font-family: 'RobotoBold';  text-shadow: -1px 1px 0 #000, 1px 1px 0 #000, 1px -1px 0 #000,
      -1px -1px 0 #000;">LOCATION :</span> <?php
	                        $loc=get_field("locations");
	                        $loctxt=array();
	                        foreach ($loc as $l){
		                        array_push($loctxt, get_term( $l)->name);
	                        }
	              
	                         echo implode(", ",$loctxt); 
	                         ?></li>
                        <li><span style="color: #BE1B17; font-family: 'RobotoBold';  text-shadow: -1px 1px 0 #000, 1px 1px 0 #000, 1px -1px 0 #000,
      -1px -1px 0 #000;"># movies : </span><?php echo $cp_movies; ?></li>
                        <li><span style="color: #BE1B17; font-family: 'RobotoBold';  text-shadow: -1px 1px 0 #000, 1px 1px 0 #000, 1px -1px 0 #000,
      -1px -1px 0 #000;"># short : </span><?php echo $cp_short; ?></li>   
                        <li><span style="color: #BE1B17; font-family: 'RobotoBold';  text-shadow: -1px 1px 0 #000, 1px 1px 0 #000, 1px -1px 0 #000,
      -1px -1px 0 #000;"># previews : </span><?php echo $cp_premiere; ?></li>
                        <li><span style="color: #BE1B17; font-family: 'RobotoBold';  text-shadow: -1px 1px 0 #000, 1px 1px 0 #000, 1px -1px 0 #000,
      -1px -1px 0 #000;"># tickets : </span><?php echo get_field("nbtickets"); ?></li>
                    </ul>
            </div>

			<div class="mb-3">
                <div class="col-md-4">
					<h4>Opening</h4>
                    <?php
	                    foreach($opening as $o){
		                    $imgurl=get_the_post_thumbnail_url($o);
		                    echo "<img src='".$imgurl."' style='width:100%;'>";
		                    echo "<h5 style=\"font-size:1rem;\">".get_the_title($o)."</h5>";
	                    }   
		            ?>
                </div>
			 </div>
			 <div class="mb-3">
                <div class="col-md-4">
					<h4>Closing</h4>
                    <?php
	                    foreach($closing as $c){
		                    $imgurl=get_the_post_thumbnail_url($c);
		                    echo "<img src='".$imgurl."' style='width:100%;'>";
		                    echo "<h5 style=\"font-size:1rem;\">".get_the_title($c)."</h5>";
	                    }   
		            ?>
                </div>
            </div>

        </div>

    </div>

</main><!-- /.container -->

<main class="container">

<div><a name="edprize"></a><h3>HIGHLIGHTS</h3></div>

    <div class="channel">
        <div class="app slider" style="height:25rem;">
	        <ul class="hs full slide-track">
        		<?php

					// Load value (array of ids).
					$images = get_field('gallery');
					$image_ids = array();
					//print_r($images[0]);
					foreach( $images as $image ):
					?>
						<li class="item slide" style="height:20rem;width: max-content;">
	                        	<img src="<?php echo $image["url"]; ?>" style="max-height:100%;height:20rem" title="<?php echo $image["title"]; ?>" alt="<?php echo $image["title"]; ?>"/>
						</li>
                <?php 
	                endforeach; ?>
			</ul>
		</div>
    </div>
 
    <div><a name="edprize"></a><h3>COMPETITION WINNERS</h3></div>

    <div class="channel">
        <div class="app">
	        <ul class="hs full">
                <?php foreach ($winner_mv as $mv):
	                $imgurl=get_the_post_thumbnail_url($mv);
	                if ($imgurl){ ?>
						<li class="item" style="background-color:#d60606;height:25rem;">
                        <a href="<?php echo get_permalink($mv); ?>">
                        	<img src="<?php echo get_the_post_thumbnail_url($mv); ?>" style="height:18.75rem;" title="<?php echo get_the_title($mv); ?>" alt="<?php echo get_the_title($mv); ?>"/>
                        </a>
                        <?php
	                    	echo "<h5 style=\"padding:0.2rem;text-align:center;float: left;margin-top: -1.875rem;background-color: #212529;width: 100%;height: 3.125rem;font-size:1rem;border-radius:0.25em;\">".$mv->lineprice."</h5>";	                        
	                    ?>
                        
                        <?php
	                        } else {                        
	                    ?>                
						<li class="item" style="background-color:#d60606;height:25rem;">
						<h5><a href="<?php echo get_permalink($mv); ?>"><?php echo get_the_title($mv); ?></a></h5>
						<h5 style="padding:0.2rem;text-align:center;float: left;background-color: #212529;width: 100%;height: 3.125rem;font-size:1rem;border-radius:0.25em;"><?php echo $mv->lineprice; ?></h5>
						<?php 
							}
							?>
						</li>
                <?php endforeach; ?>
			</ul>
		</div>
    </div>

    
     
	<div><a name="edcompetitions"></a><h3>Highlighted competitions</h3></div>
	<div class="channel">
                <?php 
	                $comp_all=array_keys($competition_array);
	                foreach ($comp_all as $comp): ?>
	                
	                <div class="app">
		                
	                <?php
	                	echo "<h4>". get_term( $comp )->name."</h4><ul class=\"hs full\">";
	                	foreach ($competition_array[$comp] as $mv):
	                		$imgurl=get_the_post_thumbnail_url($mv);
	                		if ($imgurl){
	                	?>
						<li class="item"style="background-color:#000000;height:25rem;">
                        <a href="<?php echo get_permalink($mv); ?>">
                        	<img src="<?php echo get_the_post_thumbnail_url($mv); ?>" style="height:25rem;" title="<?php echo get_the_title($mv); ?>" alt="<?php echo get_the_title($mv); ?>"/>
                        </a>
                        
                        <?php
	                        } else {                        
	                    ?>
						<li class="item-2" style="background-color:#212529 ;height:25rem;">
						<h5 style="text-align:center;"><a href="<?php echo get_permalink($mv); ?>" style="color:#ffffff!important;font-family:'RobotoBold';"><?php echo get_the_title($mv); ?></a></h5>
						<?php 
							}
							?>
                    
						</li>
                	<?php endforeach; ?>
		            </ul>
	                </div>
                <?php endforeach; ?>
	</div>
 

    
    
    <div><a name="edsections"></a><h3>Highlighted sections</h3></div>


    <div class="channel">


                <?php 
	                $sec_all=array_keys($section_array);
	                foreach ($sections_disp as $sec): ?>
	                
	                <div class="app">
		                
	                <?php
	                	echo "<h4>". get_term( $sec )->name."</h4><ul class=\"hs full\">";
	                	foreach ($section_array[$sec] as $mv):
	                		$imgurl=get_the_post_thumbnail_url($mv);
	                		if ($imgurl){
	                	?>
						<li class="item">
                        <a href="<?php echo get_permalink($mv); ?>">
                        	<img src="<?php echo get_the_post_thumbnail_url($mv); ?>" style="height:25rem;" title="<?php echo get_the_title($mv); ?>" alt="<?php echo get_the_title($mv); ?>"/>
                        </a>
                        
                        <?php
	                        } else {                        
	                    ?>
						<li class="item-2" style="background-color:#212529 ;height:25rem;">
						<h5 style="text-align:center;"><a href="<?php echo get_permalink($mv); ?>" style="color:#ffffff!important;font-family:'RobotoBold';"><?php echo get_the_title($mv); ?></a></h5>
						<?php 
							}
							?>
                    
						</li>
                	<?php endforeach; ?>
		            </ul>
		                
	                </div>
                <?php endforeach; ?>

    </div>
 
 
    
    <div id="edition-movies">
		<div><h3>MOVIES</h3>
	    </div>


		<div><a name="edmovies"></a><h4>LONG MOVIES</h4>
	    </div>



    <div class="mb-2 row" text-white rounded bg-dark>
        <!--
            * afficher les winners films d'une edition
            * problème d'image réglé
            * faut encore afficher les la compéttion(taxonomy) et le prix(taxonomy)
        -->

            <div class="row">
			<div class="col-md-6">
                <?php
	                $curcount=0; 
	                foreach ($movies as $movie): 
	                $sc=get_field("movie_type",$movie->ID);
	                
	                if ($sc=="movie") {
		                $curcount=$curcount+1;
                ?>
                <div class="row">
	                <div class="col-md-12">
                    <a href="<?php echo get_permalink($movie); ?>"> <?php echo get_the_title($movie); ?> </a>
                <?php 
					$genres=get_field('genres',$movie);
					if ($genres){
						foreach ($genres as $genre){
							$genre_term=get_term($genre);
							echo("<span class=\"badge badge-light\">".$genre_term->name."</span> ");
						}
					}
	                ?>
	                </div>
	            </div>
	                <?php
	                	if ($curcount>=($cp_movies/2)) {
		                	$curcount=-400;
		                	?>
					</div>
					<div class="col-md-6">
		                	<?php
	                	}
	                
	                
	                } 
	                endforeach; ?>
			</div>
            </div>
    </div>
	
    

    	<div><a name="edshorts"></a><h4>SHORT MOVIES</h4></div>
    <div class="mb-2 row" text-white rounded bg-dark>
        <div class="row">

			<div class="col-md-6">
                <?php
	                $curcount=0; 
	                foreach ($movies as $movie): 
	                $sc=get_field("movie_type",$movie->ID);
	                
	                if ($sc=="short") {
		                $curcount=$curcount+1;
                ?>
                <div class="row">
	                <div class="col-md-12">
                    <a href="<?php echo get_permalink($movie); ?>"> <?php echo get_the_title($movie); ?> </a>
                <?php 
					$genres=get_field('genres',$movie);
					if ($genres){
						foreach ($genres as $genre){
							$genre_term=get_term($genre);
							echo("<span class=\"badge badge-light\">".$genre_term->name."</span> ");
						}
					}
	                ?>
	                </div>
	            </div>
	                <?php
	                	if ($curcount>=($cp_short/2)) {
		                	$curcount=-400;
		                	?>
					</div>
					<div class="col-md-6">
		                	<?php
	                	}
	                
	                
	                } 
	                endforeach; ?>
			</div>


        </div>
    </div>    
    
		<div><h4>VR MOVIES</h4></div>
		
    <div class="mb-2 row" text-white rounded bg-dark>
        <!--
            * afficher les winners films d'une edition
            * problème d'image réglé
            * faut encore afficher les la compéttion(taxonomy) et le prix(taxonomy)
        -->

        <ul>
            <div class="row">
	            <ul>
                <?php foreach ($movies as $movie): 
	                $sc=get_field("movie_type",$movie->ID);
	                if ($sc=="vr") {
                ?>
					<li>
                        <a href="<?php echo get_permalink($movie); ?>"> <?php echo get_the_title($movie); ?> </a>
					</li>
                <?php } 
	                endforeach; ?>
                
            </ul>
    </div>
	</div>

		<div style="margin-top:2rem;"><a name="edguests"></a><h3>ALL GUESTS</h3></div>
		
        <div class="channel">
	        <div class="app">
		        <ul class="hs full">
		            <?php
		
			        $relatedGuests = get_posts( 
						array( 
							'post_type' => 'guest',
						    'category__in' => wp_get_post_categories($currentcatid ), 
						    'numberposts'  => 100,
						    'orderby'=>'title',
							'order'=>'ASC'
						) 
					);
		
		            foreach ($relatedGuests as $post):
		            ?>
		            
		            
		
		
		            <li class="item" style="padding-left:0.313rem;padding-right:0.313rem;">
		                <div class="card bg-dark">
		                    <div class="card-body">
		                        <div class="guest">
		                            <img src="<?php
		                                echo get_the_post_thumbnail_url($post);
		                                ?>" alt="" class="img-fluid">
		                        </div>
								<div style="height:5rem;display: flex;align-items: center;justify-content: center;">
		                        <h4 style="text-align:center;max-width:14rem;">
		                        	<?php
		                            	$idGuest=$post->ID;
		                             	echo get_field('surname', $idGuest)." ".get_field('firstname', $idGuest); 
		                             ?>
		                        </h4>
								</div>
		                        <div style="height:5rem;width:16rem;">
		                        <p>
		                        <?php echo substr(get_post_field('post_content', $idGuest),0,70)."..."; ?>
		                        <!-- --></p>
		                        </div>
		                        <hr/>
		                        <a href="<?php echo get_permalink($post); ?>" style="text-decoration:none;color:#D00019!important;"><h4>MORE INFO</h4></a>
		                    </div>
		                </div>
		            </li>
		            <?php endforeach; ?>
		        </ul>
		    </div>
		</div>		
		
		
		
		<div style="margin-top:2rem;"><a name="edevents"></a><h3>EVENTS</h3></div>
		
		
	    <div class="channel">
	
	
            <?php 
                foreach ($events_disp as $ev): 
            ?>
                <div class="app">
	             
                <?php
                	echo "<h4>". $ev->post_title."</h4><ul class=\"hs full\">";
                	$ev_gal=get_field("gallery", $ev->ID);
                	
                	foreach( $ev_gal as $image ):
					?>
						<li class="item" style="height:20rem;">
	                        	<img src="<?php echo $image["url"]; ?>" style="max-height:150%;" title="<?php echo $image["title"]; ?>" alt="<?php echo $image["title"]; ?>"/>
						</li>
            	<?php endforeach; ?>
	                
                </div>
            <?php endforeach; ?>
	
	    </div>		
		
		<div style="margin-top:2rem;"><a name="edguests"></a><h3>ALL EVENTS</h3></div>
            <div class="mb-2 row" style="margin-top:1rem;">
            <div class="col-md-6">
                <?php

		        $events = get_posts( 
					array( 
						'post_type' => 'event',
					    'category__in' => wp_get_post_categories( $currentcatid ), 
					    'numberposts'  => 100,
					    'orderby'=>'title',
						'order'=>'ASC'
					) 
				);

                foreach ($events as $ev):
                ?>				

				<div class="row">
					<div class="col-md-12">
                    <a href="<?php echo get_permalink($ev); ?>"> <?php echo get_the_title($ev); ?> </a>
					</div>
				</div>
				
				<?php endforeach; ?>
                
             
            </div>  

</main>
 
<script>
	 var root = document.documentElement;
const lists = document.querySelectorAll('.hs'); 

lists.forEach(el => {
  const listItems = el.querySelectorAll('li');
  const n = el.children.length;
  el.style.setProperty('--total', n);
});
	 
</script>                    
