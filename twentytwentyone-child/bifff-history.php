<!-- http://localhost/wikibifff/bifff-history/  -->

<?php get_header() ?>


<div class="history-container">

  <div class="timeline-bar">
    <h1>BIFFF TIMELINE</h1>
     <div class="select">
     <select id="standard-select">
     <option value="0"> SELECT YEAR </option>
      <?php $i = 0; ?>
      <?php
      $loop = new WP_Query(array('post_type' => 'edition', 'posts_per_page'=>-1, 'orderby'=>'title'));
      while ($loop->have_posts()) :
      $loop->the_post();
      $i++;
      ?>
      <option value="<?php echo $i ?>"> <?php the_terms(get_the_ID(), 'category'); ?></option>
      <?php endwhile; ?>
      </select>
       <span class="focus"></span>
      </div>
  </div>


<div class="timeline-container">
  
    <?php $i = 1; ?>


    <?php
    $loop = new WP_Query(array('post_type' => 'edition', 'posts_per_page'=>-1, 'orderby'=>'title'));


    while ($loop->have_posts()) :
    $loop->the_post();
    $i++;


    ?>


    <?php if ($i % 2 == 0) { ?>
   <div id="timeline">
				            <div class="timeline-item">
                    			<div class="timeline-box">
                                    <div class="timeline-box-image"> 
                                        <?php // the_post_thumbnail('full', array('class' => 'imgHeight')); ?>
                                         <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/19.jpg">
                                    </div>
                                    <div class="timeline-box-text">
                                      <div class="timeline-box-title">
                                            <h4 class="box-title"> EDITION 1
                                             <?php // the_field('nom'); ?></h4>
                                      </div>                          
                                      <div class="timeline-box-content"> 
                                          <p><?php
                                          $field = get_field('description');
                                          $trimmedfield = wp_trim_words( $field, $num_words = 30, $more = '… ' );
                                           echo $trimmedfield; ?></p>
                                      </div>
                                    </div>
                                    <div id="timeline-box-button"> 
                                        <a href="<?php the_permalink(); ?>" class="timeline-box-button">VOIR PLUS</a>
                                    </div>
                                     <div class="years">
                                       <?php the_terms(get_the_ID(), 'category'); ?>
                                    </div>
                                </div>  
                                   
                                 <div class="timeline-line">
                                    <svg class="Ligne_1" viewBox="0 0 101 3">
		                            <path id="Ligne_1" d="M 101 0 L 0 0">
		                            </path>
	                                </svg>
                                 </div>
                                 <div class="timeline-circle">
                                 </div> 
                            </div>
    </div>
    <?php } ?>                


            
              
               

    <?php if ($i % 2 !== 0) { ?>
    <div id="timeline" >
				            <div class="timeline-item right">
                                <div class="timeline-circle">
                                </div> 
                                <div class="timeline-line">
                                    <svg class="Ligne_2" viewBox="0 0 101 3">
		                            <path id="Ligne_2" d="M 101 0 L 0 0">
		                            </path>
	                                </svg>
                                </div>
                    			<div class="timeline-box">
                                     <div class="timeline-box-image"> 
                                        <?php // the_post_thumbnail('full', array('class' => 'imgHeight')); ?>
                                         <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/89.jpg">
                                     </div>
                                    <div class="timeline-box-text">
                                      <div class="timeline-box-title">
                                         <h4 class="box-title"> EDITION 2
                                             <?php // the_field('nom'); ?></h4>
                                      </div>                          
                                       <div class="timeline-box-content"> 
                                          <p><?php
                                          $field = get_field('description');
                                          $trimmedfield = wp_trim_words( $field, $num_words = 30, $more = '… ' );
                                           echo $trimmedfield; ?></p>
                                      </div>
                                    </div>
                                    <div id="timeline-box-button"> 
                                        <a href="<?php the_permalink(); ?>" class="timeline-box-button">VOIR PLUS</a>
                                    </div>
                                     <div class="years">
                                       <?php the_terms(get_the_ID(), 'category'); ?>
                                    </div>
                          </div>  
                                   
                               
                                
                    </div>
    </div>
    <?php } ?>


            <?php endwhile; ?>
</div>     


    <?php wp_reset_query(); ?>

  
<?php get_footer() ?>
</div>
  </div>
