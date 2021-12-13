<main class="container">
    <div><h3>COMPETITION WINNERS</h3></div>

    <div class="mb-2 row" text-white rounded bg-dark>
        <!--
            * afficher les winners films d'une edition
            * problème d'image réglé
            * faut encore afficher les la compéttion(taxonomy) et le prix(taxonomy)
        -->
        <?php
	       
	        $related = get_posts( 
				array( 
					'post_type' => 'movie',
				    'category__in' => wp_get_post_categories( $post->ID ), 
				    'numberposts'  => 100, 
				    'post__not_in' => array( $post->ID ) 
				) 
			);
		?>

        <ul>
            <div class="row">
                <?php foreach ($related as $movie): ?>
                <div class="col-md-3">
                    
                    <div class="mb-4 overflow-hidden border rounded shadow-sm row g-0 flex-md-row h-md-250 position-relative">
                        <a href="<?php echo get_permalink($movie); ?>"> <?php echo get_the_title($movie); ?> </a>
                        <?php the_post_thumbnail(); ?>
                        
                        <?php
	                    
							if( have_rows('competitions', $movie->ID) ):
							while ( have_rows('competitions', $movie->ID) ) : the_row();
							
								$subcomp = get_sub_field('competition');
								$subcomp_txt=($subcomp && $subcomp!=="")? get_term( $subcomp )->name: "";
								$subprice =get_sub_field('price');
								//echo "subprice=(".$subprice.")";
								$subprice_txt=($subprice && $subprice!=="")? get_term( $subprice )->name: "";
								echo ($subcomp_txt!=="")?"<h5>".$subprice_txt." - ".$subcomp_txt."</h5>":"";
							endwhile;

							endif;
	                        
	                    ?>

                    </div>
                    
                </div>
                <?php endforeach; ?>
                
            </ul>
        <div class="invites">




                    <section id="guestos">
                    <div class="container my-3 py-5 text-center">
                        <div class="row mb-5">
                            <div class="col">
                                <h3>JURE PRESIDENTS AND GUESTS OF HONNOR</h3>
                                <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet
                                    doloremque doloribus ea eos illum, labore molestias mollitia quam quas
                                    similique.</p>
                            </div>
                        </div>

                        <div class="row">
                            <?php


                       //     $loop = new WP_Query(array('post_type' => 'guest', 'tax_query' => [
                        //        'taxonomy' => 'category',
                         //       'field'=>'annee',
                         //       'terms'=>'2021'
                          //  ]

                           // ));

					        $relatedGuests = get_posts( 
								array( 
									'post_type' => 'guest',
								    'category__in' => wp_get_post_categories( $post->ID ), 
								    'numberposts'  => 100
								) 
							);

                            foreach ($relatedGuests as $post):
                            ?>


                            <div class="col-lg-3 col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <img src="https://via.placeholder.com/150x150" alt="" class="img-fluid rounded-circle w-50 mb-3 m-auto">
                                        <h4>
                                        	<?php
	                                        	$idGuest=$post->ID;
	                                         	echo get_field('surname', $idGuest)." ".get_field('firstname', $idGuest); 
	                                         ?>
	                                    </h4>
                                        <h5><?php
                                        //$nameGuest = get_the_terms($idGuest,'type_guest');
                                        //echo $nameGuest[0]->name;
                                        ?></h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, reiciendis.</p>
                                        <hr/>
                                        <a href="#" style="text-decoration:none;color:red;"><h3>MORE INFO</h3></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <a href="#" class="juryGuestListBar">2020 JURY/GUESTS LIST</a>
                </section>


                <div class="mb-2 row" text-white rounded bg-dark>
                    <?php
                    $posts = get_field('invites');
                    if ($posts): ?>
                    <ul>
                        <div class="row">
                            <?php foreach ($posts

                            as $post):; ?>
                            <div class="col-md-3">
                                <?php setup_postdata($post); ?>
                                <div class="mb-4 overflow-hidden border rounded shadow-sm row g-0 flex-md-row h-md-250 position-relative">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                        <img style="width:200px ; height:200px;" src="<?php the_post_thumbnail(); ?>
                                        <p><?php the_field('nom'); ?></p>
                                        <p><?php the_field('prenom'); ?></p>
                                        <h5> Type d'invitation :   <?php the_terms(get_the_ID(), 'guest_type'); ?></h5>
                                    </a>
                                </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </ul>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>

</main><!-- /.container -->