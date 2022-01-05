 /!\LAST CORRECTIONS/!\ <br>
 <br>

  => replace sass file <br>
  => missing custom logo for navbar => replace site-branding.php with my version <br>
  + added sound file + temporary mp3 "welcome" sound <br>
  => add sound file <br>
  => replace template-parts file => header + footer files to have corrections on navigation bar + footer <br>


__________________________________________________________________________________________<br>

# WikiBIFFF

#WITH EACH UPDATE

+ replace style.css byt the one in my folder <br>
+ add fonts, images, src, css and js files from my folder <br>
+ you can add you css style in sass/pages/theme/_theme.scss <br>
+ /!\ leave style.css empty like the one in the folder /!\
+ I will dispatch it in the different files from there<br>
+ Don't forget to compile sass to be able to see your changes => npm run watch (see installation process below)<br>

__________________________________________________________________________________________<br>

#7- FAVICON

+ Add favicon files from "BIFFF_favicon_io file" to wordpress medias <br>
=> added in "logo & autres trucs utiles"
+ Go to Appearance => customize => site identity => site icon <br>
=> done! Now we have the raven displayed on web tabs! =)

__________________________________________________________________________________________<br>

#6- SINGLE PAGES (First Version OK/ responsive OK/ gallery style OK )

+ replace files: single-movie.php/single-event.php/single-guest.php + fonts, images, src, css and js files to add new modifications <br>
=> they now have the same 'template'/ they have matching names and structure <br>
+ css style of all pages is based on the single-movie's one <br>
+ it's a temporary version, waiting for all the data that must be displayed on them for final version <br>
+ responsive for desktop/tablet and smartphone <br>
+ added custom background to movies with no posters <br>
+ styling of galleries <br>
 => made all pictures same sized on pages as previews <br>
+ corrections of custom js path in functions.php <br>
+ added up button on all single pages with some custom js <br>

__________________________________________________________________________________________<br>

#5- EDITION PAGE (done!)

+ modifs css for all screen views on all of the page <br>
+ changed grid view for tablet <br>
+ changed edition-entete.php => added ids/ changed opening&closing boxes to put them on the right/ changed some titles <br>
+ added svg and png files to images file <br>
+ replace files : css / images/ js / src and edition-entete.php to add new modifications <br>

__________________________________________________________________________________________<br>

#4- FOOTER (ok for current version of widgets for all screen views)

+ changed widget "categories" directly in wordpress wikibifff to "dropdown" for better years display + added style to the dropdown <br>
- /!\ could change title from "Categories" to "Years" ? /!\
--------------------- UPDATE: ----------------------------------
+ changed footer.php <br>
=> replace footer.php
+ modifs css <br>
+ added images in images file
+ remove widgets archives + recents posts + cathegories
+ add widget "image" 
=> put any image from media library at first
=> click on 'replace'
=> change 'Current media URL' by http://wiki.bifff.net/wp-content/themes/twentytwentyone-child/images/bifff-logo-footer.png
+ add widget navigation and call it "About us" (it's temporary) select the main navigation
=>reorganise widgets and put the image in first position, About us in second position then the comments, then meta, and finally the search bar in last position by clicking on arrows<br>
=> ok responsive all supports

__________________________________________________________________________________________<br>

#3- NAVBAR (done!)

+ added responsive logo <br>
+ changed css + added red background color on mobile hamburger's overlay <br>
+ modifs can be added when simply changing src/css/js files as usual <br>
+ corrections of styling made on toggle navigation (navbar/hamburger menu smartphone screen) <br>

___________________________________________________________________________________________<br>

#2- TIMELINE (done! updated comment below)

+ added correction path to sass js => functions.php (ligne 40) <br>
+ added modification in bifff-history.php <br>
- added the php code for the years select box + style (updated since only desktop version) <br>
- added images and text for test, original php is still in comments (test images and text to be removed for the final version) <br>
- added php code to trim texts in timelines <br>
=> (depending of the length of the fields, maybe we'll need to add trim to home-page text too not to break the design (like in timeline elements) <br>
+ replace files : css / images/ js / src and bifff-history.php to add new modifications <br>
+ style is made and optimised for all devices (desktop/ tablet/ smartphones).<br>
- /!\ /!\ /!\ presence of doubled years from year 2021 to year 2017, is it wordpress files?? /!\ /!\ /!\

____________________________________________________________________________________________<br>

#1- HOMEPAGE (done - last correction: 14th december)

- /!\ /!\ /!\ remove widgets from homepage so it does not break the design! /!\ /!\ /!\ <br>
+ replace home.php with the one in my folder (added rest of the home page : next bifff + guild) <br>
+ replace searchform.php

_____________________________________________________________________________________________<br>

#0- INSTALL SASS + ADD FILES

+ add package.json <br>
+ install node => npm install <br>
+ replace style.css by the one in my folder <br>
+ add fonts, images, src, css and js files from my folder <br>
+ replace functions.php with the one in my folder (added link to sass css and sass js) <br>
- run « npm run watch » if you want to compile sass in real time / and at the end to compile <br>

