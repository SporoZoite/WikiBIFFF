<?php
/**
 * Template Name: new-idlzm
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

/* Start the Loop */

// the part for idlzm 

// get 6 random
$args = array(
    'post_type' => 'movie_ref',
    'orderby'   => 'rand',
    'posts_per_page' => 6, 
    );
 
$the_query = new WP_Query( $args );
$posts=get_posts( $args );
$refmv=array();

foreach( $posts as $mv ) : 
	array_push($refmv, $mv);
	//wp_reset_postdata(); 
endforeach;



// make selection 1/2
?>
<style>
	.mvselect {
		border:2px solid green;
	}
	.mvunselect {
		border:0px solid red;
	}
</style>
<script>
	function mvselect(nb){
		jQuery("#mv"+nb+" img").addClass("mvselect");
	}
	function mvunselect(nb){
		jQuery("#mv"+nb+" img").removeClass("mvselect");
	}	
	function getAllRefs(){
		st=new Array();
		for (let i = 0; i < 6; i++) {
		    if (jQuery("#mv"+i+" img").hasClass("mvselect")){
			    st.push(jQuery("#mv"+i).attr("data-id"))
		    }
		}
		field_st=st.join(",");
		jQuery("#acff-post-field_625fe2c4d5260").val(field_st);
		console.log(field_st);
		
	}
</script>

<div class= "idlzm-container">
<div class="mb-2 row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<h4>Select one movie on each pair... and we will get inspiration from it!</h4>
	</div>
	<div class="col-md-3"></div>	
</div>
<div class="mb-2 row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<a href="#x" onClick="mvselect(0); mvunselect(1);getAllRefs();" data-id="<?php echo $refmv[0]->ID; ?>" id="mv0">
		<img class="refimg" src="<?php echo get_the_post_thumbnail_url($refmv[0]); ?>" title="<?php echo get_the_title($refmv[0]); ?>" alt="<?php echo get_the_title($refmv[0]); ?>" style="height:25rem;display:inline;"/>
		</a>
		<a href="#x" onClick="mvselect(1); mvunselect(0);getAllRefs();" data-id="<?php echo $refmv[1]->ID; ?>" id="mv1">
		<img class="refimg" src="<?php echo get_the_post_thumbnail_url($refmv[1]); ?>" title="<?php echo get_the_title($refmv[1]); ?>" alt="<?php echo get_the_title($refmv[1]); ?>" style="height:25rem;display:inline;"/>
		</a>
	</div>
	<div class="col-md-3"></div>	
</div>
<div class="mb-2 row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<a href="#x" onClick="mvselect(2); mvunselect(3);getAllRefs();" data-id="<?php echo $refmv[2]->ID; ?>" id="mv2">
		<img class="refimg" src="<?php echo get_the_post_thumbnail_url($refmv[2]); ?>" title="<?php echo get_the_title($refmv[2]); ?>" alt="<?php echo get_the_title($refmv[2]); ?>" style="height:25rem;display:inline;"/>
		</a>
		<a href="#x" onClick="mvselect(3); mvunselect(2);getAllRefs();" data-id="<?php echo $refmv[3]->ID; ?>" id="mv3">
		<img class="refimg" src="<?php echo get_the_post_thumbnail_url($refmv[3]); ?>" title="<?php echo get_the_title($refmv[3]); ?>" alt="<?php echo get_the_title($refmv[3]); ?>" style="height:25rem;display:inline;"/>
		</a>
	</div>
	<div class="col-md-3"></div>	
</div>
<div class="mb-2 row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<a href="#x" onClick="mvselect(4); mvunselect(5);getAllRefs();" data-id="<?php echo $refmv[4]->ID; ?>" id="mv4">
		<img class="refimg" src="<?php echo get_the_post_thumbnail_url($refmv[4]); ?>" title="<?php echo get_the_title($refmv[4]); ?>" alt="<?php echo get_the_title($refmv[4]); ?>" style="height:25rem;display:inline;"/>
		</a>
		<a href="#x" onClick="mvselect(5); mvunselect(4);getAllRefs();" data-id="<?php echo $refmv[5]->ID; ?>" id="mv5">
		<img class="refimg" src="<?php echo get_the_post_thumbnail_url($refmv[5]); ?>" title="<?php echo get_the_title($refmv[5]); ?>" alt="<?php echo get_the_title($refmv[5]); ?>" style="height:25rem;display:inline;"/>
		</a>
	</div>
	<div class="col-md-3"></div>	
</div>

						

<?php
echo do_shortcode('[acf_frontend form="form_625fe2940e71f"]');

?>
</div>
<script>
	jQuery(".acf-field-625fe46597fe8").hide();
	jQuery(".acf-field-625fe2c4d5260").hide();
	
</script>
<?php 
get_footer();
