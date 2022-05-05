<!-- http://localhost/wikibifff/home/ -->


<?php get_header() ?>

<div class="home-container">

    <div class="home-left">
        <div class="home-left-img">
            <img class="home-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/bifff.png" alt="bifff-logo">
            <img class="home-raven" src="<?php echo get_stylesheet_directory_uri(); ?>/images/raven.png" alt="bifff-logo">
            <img class="home-typo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/font bifff.png" alt="bifff-logo">
        </div>
        <button onclick="window.location.href='http://wiki.bifff.net/bifff-history/';" class="home-left-button">BIFFF HISTORY</button>
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
         <h3 class="home-second-title">Join us for the next BIFFF festival</h3>
         <p class="home-second-text"> <?php echo get_post_meta($post->ID, 'next_bifff_festival', true); ?>
        </p>
        <button onclick="window.location.href='http://www.bifff.net/';" class="home-second-button">MORE INFOS</button>
        </div>
    </div>



    <div class="home-third">
        <div class="home-third-section">
           <h3 class="home-third-title">Become a guild member!</h3>
           <p class="home-third-text"><?php echo get_post_meta($post->ID, 'become_a_guild_member', true); ?>
           </p>
           <button onclick="window.location.href='http://www.bifff.net/';" class="home-third-button">JOIN THE GUILD</button>
        </div>
    </div>
</div>



</body>
</html>