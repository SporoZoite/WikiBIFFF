<!-- http://localhost/wikibifff/home/ -->


<?php get_header() ?>

<div class="home-container">

    <div class="home-left">
        <div class="home-left-img">
            <img class="home-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/bifff.png" alt="bifff-logo">
            <img class="home-raven" src="<?php echo get_stylesheet_directory_uri(); ?>/images/raven.png" alt="bifff-logo">
            <img class="home-typo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/font bifff.png" alt="bifff-logo">
        </div>
        <button onclick="window.location.href='https://wiki.bifff.net/editions/';" class="home-left-button">EDITIONS</button>
    </div>

    


    <div class="home-right">

        <div class="home-right-top">
        </div>
        <div class="home-right-middle">
            <h2 class="home-right-zombie-text">I DON'T LIKE ZOMBIE MOVIES!</h1>
            <button onclick="window.location.href='http://wiki.bifff.net/films/';" class="home-right-button">BROWSE MOVIE LIST</button>
        </div>

        <div class="home-right-search">
            <span class="home-separator"></span>
            <h1 class="home-right-search-title">SEARCH IN OUR MOVIE DATABASE</h1>
            <?php get_search_form(); ?>
        </div>

    </div>

    <div class="home-second">
         <img class="home-second-picture" src="<?php echo get_stylesheet_directory_uri(); ?>/images/tentacles.png" alt="tentacles">
         <div class="home-second-right">
           <iframe class="home-second-video" width="560" height="315" src="https://www.youtube.com/embed/Roj19_E44hk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>



    <div class="home-third">
        <div class="home-third-section">
           <p class="home-third-text"><?php echo get_post_meta($post->ID, 'about', true); ?>
           </p>
        </div>
    </div>


    <div class="home-four">
        <div class="home-four-section">
           <h3 class="home-four-title">The Audience Quotes Guide</h3>
           <p class="home-four-text"><?php echo get_post_meta($post->ID, 'audience', true); ?>
           </p>
           <button onclick="window.location.href='https://wiki.bifff.net/audience-quotes-guide/';" class="home-four-button">TO GUIDE</button>
        </div>
    </div>

     <div class="home-five">
        <div id="home-five-container">
            <h3 id="typewrite"></h3><div id="cursor"></div>   
        </div>
       
         <div class="home-five-right">
           <p class="home-five-text"><?php echo get_post_meta($post->ID, 'top', true); ?>
           </p>
           <button onclick="window.location.href='https://wiki.bifff.net/all-top10/';" class="home-five-button">TOP10</button>
        </div>
        
    </div>
</div>



</body>
</html>