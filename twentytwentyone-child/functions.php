<?php


/* Initialisation de la variable que je souhaites récupérer */

function wpd_add_query_vars( $qvars ) {
    $qvars[] = 'edition';
    $qvars[] = 'type';
    $qvars[] = 'competition';
    return $qvars;
}
add_filter( 'query_vars', 'wpd_add_query_vars' );

/* Initialisation du rewriting de l'URL */

function wpd_page_rewrite(){
    add_rewrite_rule( '^guests/([^/]*)/([^/]*)/?', 'index.php?pagename=guests&edition=$matches[1]&type=$matches[2]', 'top' );
//add_rewrite_rule('^competition','index.php?competition=0&edition=0','top');
//add_rewrite_rule('^competition/([^/]*)','index.php?competition=$matches[1]&edition=0','top');
    add_rewrite_rule('^competition/([^/]*)/([^/]*)/?','index.php?competition=$matches[1]&edition=$matches[2]','top');

}
add_action( 'init', 'wpd_page_rewrite' );

$variable1 = get_query_var('edition');
$variable2 = get_query_var('type');
$variable3 = get_query_var('competition');
function theme_register_assets(){
    wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css');
    wp_deregister_script('jquery');
    wp_register_script('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
    wp_enqueue_style('stylecss', get_stylesheet_uri());
}

function theme_charger_js_web() {

    wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'child-js', get_stylesheet_directory_uri() . '/js/theme.min.js', array(), false, true);
} 

add_action('wp_enqueue_scripts', 'theme_charger_js_web');


// Exit if accessed directly XD
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')) :
    function child_theme_configurator_css()
    {
        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('twenty-twenty-one-style', 'twenty-twenty-one-style', 'twenty-twenty-one-print-style'));
		wp_register_style( 'child-sass', get_stylesheet_directory_uri() . '/css/theme.css', array(), rand(111, 9999), 'all' );
		wp_enqueue_style( 'child-sass' );
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);
add_action('wp_enqueue_scripts', 'theme_register_assets');




// END ENQUEUE PARENT ACTION

// CODE AJOUT POST VIA CSV //

/**
 * Ajout du bouton "insert Post" pour admin
 */
add_action("admin_notices", function () {
    echo "<div class='updated'>";
    echo "<p>";
    echo "To insert the posts into the database, click the button to the right.";
    echo "<a class='button button-primary' style='margin:0.25em 1em' href='{$_SERVER["REQUEST_URI"]}&insertion_csv_post'>Insert Posts</a>";
    echo "</p>";
    echo "</div>";
});



if (!function_exists('wp_dump')) :
    function wp_dump()
    {
        if (func_num_args() === 1) {
            $a = func_get_args();
            echo '<pre>', var_dump($a[0]), '</pre><hr>';
        } else if (func_num_args() > 1)
            echo '<pre>', var_dump(func_get_args()), '</pre><hr>';
        else
            throw Exception('You must provide at least one argument to this function.');
    }
endif;


/* Initialisation de la variable que je souhaites récupérer */
/*function wpd_add_query_vars($qvars)
{
	$qvars[] = 'edition';
	return $qvars;
}
add_filter('query_vars', 'wpd_add_query_vars');*/

/* Initialisation du rewriting de l'URL */
/*function wpd_page_rewrite()
{
	add_rewrite_rule('^films/([^/]*)?', 'index.php?pagename=films&edition=$matches[1]', 'top');
}
add_action('init', 'wpd_page_rewrite');

$variable = get_query_var('edition');
*/


/**
 * Creation et insertion des posts depuis fichiers CSV
 */

function getAndCreateTerm($taxname, $termname){
	if ($termname==""){
		$id=null;
	} else {
		$term0 = get_term_by('name', $termname, $taxname);
		$term1 = get_term_by('name', ucwords($termname), $taxname);
		if ($term0==null){
			$term=$term1;
			$termname=ucwords($termname);
		} else {
			$term=$term0;
		}
		if ($term==null){
			$robj= wp_insert_term($termname, $taxname, sanitize_title($termname));
			$id=$robj["term_id"];
		} else {
			$id=$term->term_id;
		}
	}
	return $id;
}

function getAndCreateTermList($taxname, $termnameList){

	$termList=explode(",", $termnameList);
	$termList=array_unique($termList);
	
	$idList=array();
	foreach($termList as $term){
		array_push($idList, getAndCreateTerm($taxname, trim($term)));
	}
	
	return $idList;
}

function getAndCreateMovie($movieTitle){
    $gpost = get_page_by_title($movieTitle, OBJECT, 'movie');
	if (is_null($gpost)){
		$post["ID"] = wp_insert_post(array(
			            "post_title" => $movieTitle,
			            "post_content" => "",
			            "post_type" => 'movie',
			            "post_status" => "publish"
			        ));
		$id=$post["ID"];
	} else {
		$id=$gpost->ID;
	}
	return $id;    	
}

function getAndCreateEdition($year){
    $editionQuery= new WP_Query(array('post_type' => 'edition'));
    $allEditions = $editionQuery->posts;

	$id=0;
    foreach ($allEditions as $edyn) {
       // var_dump($edyn);
        $edition_id=$edyn -> ID;
        $allCategories=get_the_category($edition_id);

		foreach ($allCategories as $cat) {  
			if ($cat-> name == $year){
				$id=$edition_id;
			}
		}         
    }
    if ($id==0){
		$id = wp_insert_post(array(
            "post_title" => "Edition".$year,
            "post_content" => "",
            "post_type" => 'edition',
            "post_status" => "publish"
        ));	    
        $yearID= getAndCreateCategory($year);
        wp_set_post_categories($id, $yearID);
	    
    }
	return $id;
}

function getAndCreateGuest($guestnametxt){
	
	$guestname=explode(",", $guestnametxt);
	if (count($guestname)==2){
		$title=trim($guestname[0])." ".trim($guestname[1]);	
	} else {
		$guestname[0]=$guestnametxt;
		$guestname[1]="";
		$title=trim($guestname[0])." ".trim($guestname[1]);	
	}
		
	
    $gpost = get_page_by_title($title, OBJECT, 'guest');
	if (is_null($gpost)){
		$post["ID"] = wp_insert_post(array(
			            "post_title" => $title,
			            "post_content" => "",
			            "post_type" => 'guest',
			            "post_status" => "publish"
			        ));
        update_field('firstname', trim($guestname[1]), $post["ID"]);
		update_field('surname', trim($guestname[0]), $post["ID"]);
		$id=$post["ID"];
	} else {
		//var_dump($title);
		//var_dump($gpost);
		$id=$gpost->ID;
	}
	return $id;
}

function getAndCreateCategory($cat){
	if (get_cat_ID($cat) == 0) {
        $obj = wp_insert_term($cat, 'category', $args = array(
            'parent' => 40
        ));
        $id=$obj["term_id"];
    } else {
        $id=get_cat_ID($cat);
    }  
    return $id;         
}

function addtoField($fieldname, $fieldvalueList, $postID){
	$currentValues=get_field($fieldname, $postID);
	if (! is_array($currentValues)){
		$currentValues=[$currentValues];
	}
	//var_dump($currentValues);
	if (is_null($currentValues)){
		$allValues=$fieldvalueList;
	} else {
		$allValues=array_merge($currentValues,$fieldvalueList);
	}
	//var_dump($allValues);
	$allValues=array_unique($allValues);
	update_field($fieldname, $allValues, $postID);
}

function addtoRelationship($fieldname, $fieldvalueList, $postID){
	$currentValues=get_field($fieldname, $postID);
	//var_dump($currentValues);
	if (is_null($currentValues)){
		$allValues=$fieldvalueList;
	} else {
		$currentID=array();
		foreach($currentValues as $p){
			array_push($currentID, $p->ID);
		}
		$allValues=array_merge($currentID,$fieldvalueList);
	}
	//var_dump($allValues);
	$allValues=array_unique($allValues);
	update_field($fieldname, $allValues, $postID);
}

add_action("admin_init", function () {
    global $wpdb;

    if (!isset($_GET["insertion_csv_post"])) {
        return;
    }


    // Récupération des datas des CSV

    $data = array();
    $errors = array();

    //tableau des fichiers CSV
    $files = glob(__DIR__ . "/data/wiki-ok8-*.csv");

    foreach ($files as $file) {

        // On tente de changer la permission si pas readable
        if (!is_readable($file)) {
            chmod($file, 0744);
        }

        //On check si le fichier est writable, puis on l'ouvre en mode 'read only'
        if (is_readable($file) && $_file = fopen($file, "r")) {

            // To sum this part up, all it really does is go row by
            //  row, column by column, saving all the data
            $post = array();

            // On recup la premiere ligne du csv (headers)
            $header = fgetcsv($_file);

            while ($row = fgetcsv($_file)) {

                foreach ($header as $i => $key) {
                    $post[$key] = trim($row[$i]);
                }

                $data[] = $post;
            }

            fclose($_file);
            
            treatBatch($data);
            $wpdb->flush();
            
        } else {
            $errors[] = "File '$file' could not be opened. Check the file's permissions to make sure it's readable by your server.";
        }
    }

    if (!empty($errors)) {
        echo $errors;
    }


    //Redirection pour clear l'url du &insertion_csv_post afin d'eviter le lancement de la fonction à chaque refresh
    $url = "http://localhost/wikibifff/wp-admin";
    //wp_redirect($url);
    exit;

});

function treatBatch($posts){
	$wpdb= new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

    $insert_post = array(
        "custom-field" => "post_attachment",
        "custom-post-type" => "movie"
    );
	
    foreach ($posts as $post) {

		if (trim($post["type"])=="short" || trim($post["type"])=="movie" || strtolower(trim($post["type"]))=="vr") {
	        // Si le post existe déjà , on skip ce post et on passe au suivant
	        
	        $expost = get_page_by_title($post["title"], OBJECT, 'movie');
	        
	        if (! is_null($expost)){
	            continue;
	            // en cas d'update, ici <-
	            //si pas d'update, impossible de rajouter des champs, car le test des doublons "continue" le code et skip l'entrée
	        }
	
			$idGenres=getAndCreateTermList("genre", $post["genre"]);
			$idPays=getAndCreateTermList("country", $post["country"]);
			$idCompetitions=getAndCreateTermList("competition", $post["competition"]);
			
			// add competition in section
			if ($post["competition"]!==""){
				$idSections=getAndCreateTermList("section", $post["subtype"].",".$post["competition"]);
			} else {
				$idSections=getAndCreateTermList("section", $post["subtype"]);
			}

	        $year = $post["edition"];
	
			$idYear= getAndCreateCategory($year);
			$idEdition=getAndCreateEdition($year);
	        
	        
	        
			//var_dump($mapEdition);
	
	/*
	        // Add Featured Image to Post
	        $image_url        = $post["images"]; // Define the image URL here
	        $image_name       = preg_replace('/[^a-z0-9]/i', '', $post["post_name"]) . "_poster.jpg";
	        $upload_dir       = wp_upload_dir(); // Set upload folder
	        $image_data       = file_get_contents($image_url); // Get image data
	        $unique_file_name = wp_unique_filename($upload_dir['path'], $image_name); // Generate unique name
	        $filename         = basename($unique_file_name); // Create image file name
	
	        // Check folder permission and define file location
	        if (wp_mkdir_p($upload_dir['path'])) {
	            $file = $upload_dir['path'] . '/' . $filename;
	        } else {
	            $file = $upload_dir['basedir'] . '/' . $filename;
	        }
	
	        // Create the image  file on the server
	        file_put_contents($file, $image_data);
	
	        // Check image file type
	        $wp_filetype = wp_check_filetype($filename, null);
	
	        // Set attachment data
	        $attachment = array(
	            'post_mime_type' => $wp_filetype['type'],
	            'post_title'     => sanitize_file_name($filename),
	            'post_content'   => '',
	            'post_status'    => 'inherit'
	        );
	
	        // Create the attachment
	
	        $attach_id = wp_insert_attachment($attachment, $file, $post["ID"]);
	        // var_dump($post["ID"]);
	
	        // Include image.php
	        require_once(ABSPATH . 'wp-admin/includes/image.php');
	
	        // Define attachment metadata
	        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
	
	        // Assign metadata to attachment
	        wp_update_attachment_metadata($attach_id, $attach_data);
	
	*/
	
	        // Insertion du post dans la database
	        $post["ID"] = wp_insert_post(array(
	            "post_title" => $post["title"],
	            "post_content" => $post["text_en"],
	            "post_type" => $insert_post["custom-post-type"],
	            //"attribute:pa_cast" => $post["attribute:pa_cast"],
	            //"images" => $image_name,
	            "post_status" => "publish"
	        ));
		
	        //set_post_thumbnail($post["ID"], $attach_id);
	
	        // Update post's custom field
	
	        //modif des "|" en ","
	        $castingModif = str_replace("|",", ",$post["casting"]);
	        $directorModif = str_replace("|",", ",$post["director"]);
	        $distributorModif = str_replace("|",", ",$post["distributor"]);
	        $producerModif = str_replace("|",", ",$post["producer"]);
	        $screenplayModif = str_replace("|",", ",$post["screenplay"]);
	        $soundtracksModif = str_replace("|",", ",$post["soundtrack"]);
	        $subtitlesModif = str_replace("|",", ",$post["subtitles"]);
	
	
	
	        update_field('original_title', $post["original_title"], $post["ID"]);                   // X
	        //update_field('entry-content', $post["text_en"], $post["ID"]);                  // X
	        update_field('casting', $castingModif, $post["ID"]);                                // X
	        update_field('field_603f90e6ce939', $directorModif, $post["ID"]);                   // X
	        update_field('field_603f94b779937', $distributorModif, $post["ID"]);                // X
	        update_field('field_6086a55be1f93', $producerModif, $post["ID"]);                   // X
	        update_field('field_6086a5e561f18', $screenplayModif, $post["ID"]);                 // X
	        update_field('field_6086a66d57dcd', $soundtracksModif, $post["ID"]);                // X
	        update_field('field_603f8eda0fa62', $subtitlesModif, $post["ID"]);                  // X
	        update_field('field_6086a71c5903b', $post["audio"], $post["ID"]);      // X
	        update_field('field_603f868edc555', $post["premiere"], $post["ID"]);   // X
	        update_field('field_603f871fdc556', $idPays, $post["ID"]);                          // X
	        update_field('field_60364d57c8199', $idGenres, $post["ID"]);                        // X
	        update_field('field_603f93d74445a', trim($post["type"]), $post["ID"]);                        // X
	        update_field('field_6040fa15c7638', trim($post["year"]), $post["ID"]);                        // X
	        update_field('field_6086a71c5903b', trim($post["audio"]), $post["ID"]);
	        update_field('field_60a5225dcf0cf', $idSections, $post["ID"]);
	        //if (trim(strtolower($post["subtype"]))=="opening" || trim(strtolower($post["subtype"]))=="closing") update_field('field_609f9216931d4', trim(strtolower($post["subtype"])), $post["ID"]);                        // X
	        update_field('field_603f8df9dc55f', (int)trim($post["length"]), $post["ID"]);  

	
	
	        update_field('field_603f921144457', $idEdition, $post["ID"]);
	        wp_set_post_categories($post["ID"], $idYear);
	
			//build array for repeater field
	        $repeater = 'field_6041fb8035075';  
	        $repeatComp = array();
	        foreach ($idCompetitions as $comp) {		        
		        $myrow=array('field_6041fb9f35076' => $comp,'field_6041fbcc35077'=>null, 'field_6041fbf035078'=>'');
		        add_row($repeater, $myrow, $post["ID"]);	
		    }	
		    
		}
		if (trim($post["type"])=="palmares") {
		
			$cpost = get_page_by_title($post["title"], OBJECT, 'movie');
			
			if ($cpost!==null){

				// get price id in taxonomy (and create it if not)
				$price=trim($post["subtype"]);
		        $price_dyn = get_terms(
		            'price',
		            array(
		                'hide_empty' => false
		            )
		        );
		
		        $priceList = array();
		        foreach ($price_dyn as $pdyn) {
		            $priceList[$pdyn->name] = $pdyn->term_id;
		        }
		
		        if ($price!==""){
			    	if (array_key_exists($price, $priceList)) {
				    	$idPrice=$priceList[$price];
				    } else {
		                //the taxonomy does not exist --> create it
		                //var_dump($comp);
		                $idPrice= wp_insert_term($price, "price", sanitize_title($price));
		            }
		        }
				
				$field_key = "field_6041fb8035075";
				$post_id = $cpost->ID;
				$value = get_field($field_key, $post_id);
				
				
				// audience price
				if (trim($post['competition'])==""){
					// add a row
					$myrow=array('field_6041fb9f35076' => "",'field_6041fbcc35077'=>$idPrice, 'field_6041fbf035078'=>trim($post['winner']));
					add_row($field_key, $myrow, $post_id);
					
				} else {
			
					// loop on rows to detect the good one and replace it
					for ($i = 0; $i < count($value); $i++) {
						$row=$value[$i];

						$term = get_term_by('name', trim($post['competition']), 'competition');
						if ($row['competition']==$term->term_id){
							$value[$i]['price']=$idPrice;
							$value[$i]['winner']=trim($post['winner']);
						}
					}
					update_field( $field_key, $value, $post_id );		
				}

			}
			
		}
		if (trim($post["type"])=="guest") {
			
			$guestname=explode(",", $post["director"]);
			if (count($guestname)<2){
				var_dump($post["director"]);
			}
			
			$title=trim($guestname[0])." ".trim($guestname[1]);
			
			$gpost = get_page_by_title($title, OBJECT, 'guest');
			if ($gpost==null){
				// we create the post
				$txt=$post["text_en"];
				if ($txt==""){
					$txt=$post["competition"];
				}
				
				$post["ID"] = wp_insert_post(array(
		            "post_title" => $title,
		            "post_content" => $txt,
		            "post_type" => 'guest',
		            "post_status" => "publish"
		        ));
		        update_field('firstname', trim($guestname[1]), $post["ID"]);
				update_field('surname', trim($guestname[0]), $post["ID"]);
				$post_id = $post["ID"];
			} else {
				$post_id=$gpost->ID;
			}
			
			$field_key = "field_609ff3a8cbf54";
			
			$yearID=getAndCreateCategory($post["edition"]);
			$typeID=getAndCreateTerm("guest_type", $post["subtype"]);
			
			if (strtolower($post["subtype"])=="jury" || strtolower($post["subtype"])=="president"){
				$editionID=getAndCreateEdition($post["edition"]);
				$competitionID=getAndCreateTerm("competition", $post["title"]);
				
				$newRow=array('edition' => $editionID,'year'=>$yearID, 'type'=>$typeID, 'competition'=>$competitionID);
				$isNew=true;
				if (have_rows("field_609ff3a8cbf54", $post_id)){
					$allrows=get_field("field_609ff3a8cbf54",$post_id);
					foreach ($allrows as $checkRow){
						if ($checkRow["edition"]==$newRow["edition"] && $checkRow["type"]==$newRow["type"] && $checkRow["competition"]==$newRow["competition"] && $checkRow["year"]==$newRow["year"]){
							$isNew=false;
						}
					}
				}
				if ($isNew==true){
					add_row("field_609ff3a8cbf54", $newRow, $post_id);
				}
				
				addtoField("sections", [$competitionID], $post_id);
			}
			
			if (strtolower($post["subtype"])=="knight"){
				$editionID=getAndCreateEdition($post["edition"]);
				
				$newRow=array('edition' => $editionID,'year'=>$yearID, 'type'=>$typeID);
				$isNew=true;
				if (have_rows("field_609ff3a8cbf54", $post_id)){
					$allrows=get_field("field_609ff3a8cbf54",$post_id);
					foreach ($allrows as $checkRow){
						if ($checkRow["edition"]==$newRow["edition"] && $checkRow["type"]==$newRow["type"] && $checkRow["year"]==$newRow["year"]){
							$isNew=false;
						}
					}
				}
				if ($isNew==true){
					add_row("field_609ff3a8cbf54", $newRow, $post_id);
				}
			}
			
			if ($post["subtype"]=="movie"){
				var_dump($post["title"]);
				var_dump($guestname);
				$editionID=getAndCreateEdition($post["edition"]);
				$movieID=getAndCreateMovie($post["title"]);
				
				$newRow=array('edition' => $editionID,'year'=>$yearID, 'type'=>$typeID, 'movie'=>$movieID);
				$isNew=true;
				if (have_rows("field_609ff3a8cbf54", $post_id)){
					$allrows=get_field("field_609ff3a8cbf54",$post_id);
					foreach ($allrows as $checkRow){
						if ($checkRow["edition"]==$newRow["edition"] && $checkRow["type"]==$newRow["type"] && $checkRow["movie"]==$newRow["movie"] && $checkRow["year"]==$newRow["year"]){
							$isNew=false;
						}
					}
				}
				if ($isNew==true){
					add_row("field_609ff3a8cbf54", $newRow, $post_id);
				}

				// add guests in movie
				addtoRelationship("guests", [$post_id], $movieID);
			}					   
			
			
		} // end guest		

		if (trim($post["type"])=="event") {
		
			$title=$post["title"];
			$gpost = get_page_by_title($title, OBJECT, 'event');
			if ($gpost==null){
				// we create the post
				
				$post["ID"] = wp_insert_post(array(
		            "post_title" => $title,
		            "post_content" => $post["text_en"].$post["competition"],
		            "post_type" => 'event',
		            "post_status" => "publish"
		        ));		
		        $eventID=$post["ID"];
				$yearID=getAndCreateCategory($post["edition"]);
				$editionID=getAndCreateEdition($post["edition"]);
				$sectionIDList=getAndCreateTermList("section",$post["subtype"]);
				$locationID=getAndCreateTerm("locations",$post["country"]);
				
				update_field('edition', $editionID, $post["ID"]);
				update_field('location', $locationID, $post["ID"]);
				update_field('sections', $sectionIDList, $post["ID"]);
				//update_field('date', $post["competition"], $post["ID"]);
				update_field('name', $post["title"], $post["ID"]);
				update_field('year', $yearID, $post["ID"]);
				
				$guestList=explode(";", $post["director"]);
				$idGuestArray=array();
				foreach ($guestList as $guest){
					$idguest=getAndCreateGuest($guest);
					array_push($idGuestArray, $idguest);
					// add row
					// add section
					addtoField("sections", $sectionIDList, $idguest);
					
					$typeID=getAndCreateTerm("guest_type", "participant");
					$newRow=array('edition' => $editionID,'year'=>$yearID, 'type'=>$typeID, 'event'=>$eventID);
					$allrows=get_field("field_609ff3a8cbf54",$idguest);
					$isNew=true;
					if (have_rows("field_609ff3a8cbf54", $idguest)){
						foreach ($allrows as $checkRow){
							if ($checkRow["edition"]==$newRow["edition"] && $checkRow["type"]==$newRow["type"] && $checkRow["competition"]==$newRow["competition"] && $checkRow["event"]==$newRow["event"]){
								$isNew=false;
							}
						}
					}
					if ($isNew==true){
						add_row("field_609ff3a8cbf54", $newRow, $idguest);
					}
				}
				update_field('guests', $idGuestArray, $post["ID"]);
			
			
			} else {
				// the post exists, I'll update guest.
				$editionID=getAndCreateEdition($post["edition"]);
				$yearID=getAndCreateCategory($post["edition"]);
				$eventID=$gpost->ID;
				
				$guestList=explode(";", $post["director"]);
				$idGuestArray=array();
				foreach ($guestList as $guest){
					$idguest=getAndCreateGuest($guest);
					array_push($idGuestArray, $idguest);
					// add row
					// add section
					
					$typeID=getAndCreateTerm("guest_type", "participant");
					$newRow=array('edition' => $editionID,'year'=>$yearID, 'type'=>$typeID, 'event'=>$eventID);
					$allrows=get_field("field_609ff3a8cbf54",$idguest);
					$isNew=true;
					if (have_rows("field_609ff3a8cbf54", $idguest)){
						foreach ($allrows as $checkRow){
							if ($checkRow["edition"]==$newRow["edition"] && $checkRow["type"]==$newRow["type"] && $checkRow["competition"]==$newRow["competition"] && $checkRow["event"]==$newRow["event"]){
								$isNew=false;
							}
						}
					}
					if ($isNew==true){
						add_row("field_609ff3a8cbf54", $newRow, $idguest);
					}
				}
				var_dump($idGuestArray);
				addtoRelationship("guests", $idGuestArray, $gpost->ID);
			}
		
		}

     
    }
	
}

