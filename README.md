 /!\LAST ADD/!\ <br>
 <br>
 /!\dernière update = 8 mai/!\ <br>
 <br>
 
 + Mises à jour css => remplacer fichiers "src" "css" et "js" <br>
 + Mise en place des premiers  customs fields => remplacer ficher "home.php"<br>
 + Ajout des images du audience quotes guide => remplacer fichier "images"<br>
 + Mise en page du audience quotes guide => remplacer fichier "audience-quotes-guide.php" <br>

 

 

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

 #14- Top10

+ inside template-parts => created new file "top10"<br>
   => added newtop10.php<br>
   <br>

 + created page <br>
   => added template-newtop10.php<br>
   <br>

 + => need to change pages templates :<br>
 + top10 new => new-top-10<br>
 + top10 edit => new-top-10<br>
 <br>

 + added sass file : top10 <br>
 + added top10.scss <br>
 + added newtop10.scss <br>
 <br>

 + made changes in template-my-top10.php <br>

__________________________________________________________________________________________<br>

 #13- Politique de confidentialité

 + added sass page Politique de confidentialité <br>
  => politique-de-confidentialité.scss <br>
  <br>

__________________________________________________________________________________________<br>
 
 
 #12-USER PAGES

+ inside template-parts => created new file "users"<br>
  => added account.php<br>
  => added login.php<br>
  => added members.php<br>
  => added password.php<br>
  => added register.php<br>
  => added user.php<br>
  <br>

 + created pages <br>
  => added template-account.php<br>
  => added template-login.php<br>
  => added template-register.php<br>
  => added template-password.php<br>
  => added template-members.php<br>
  => added template-user.php<br>
  <br>

  => need to change pages templates :<br>
 + account => Bifff-account<br>
 + login et logout => Account-login<br>
 + members => Account-members<br>
 + password reset => Account-password<br>
 + register => Account-register<br>
 + user => Account-user<br>
 <br>

 + added sass file : users <br>
 + added login.scss <br>
 + added account.scss <br>
 + added members.scss <br>
 + added password.scss <br>
 + added register.scss <br> 
 + added user.scss <br>
 <br>

__________________________________________________________________________________________<br>

#11- ERROR 404

 + ajout de javascript dans src/js/custom-javascript.js <br>
 + ajout page 404.scss + modifications sur la page 404.php <br>
 + ajouts de fonts dans font file <br>

__________________________________________________________________________________________<br>

#10- LOGIN/USER/ACCOUNT/... PAGES

 + made style for login page <br>
  => in src file : added _login.scss page <br>

__________________________________________________________________________________________<br>

#9- SECTION PAGE/VAMPIRE BALL

 + made style for section pages (ex: ball des vampires) <br>
 + ok responsive all supports + ok pour all section pages <br>
  => in src file : added _vampire-ball.scss page <br>

__________________________________________________________________________________________<br>

#8- MOVIES

+ added css for archive-movie <br>
=> replace sass file <br>
+ modified classes names of archive-movie.php
=> replace archive-movie.php with my version <br>
=> done responsive for all devices <br>
LAST ADDS <br>
  + added css for archive-movie <br>
  + modified classes names of archive-movie.php <br>


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
LAST ADDS <br>
++ made changes on highlight design <br>
  + added line to hide scrollbar in sass file <br>
  + replace "edition-entête" by my version to add carousel-like highlight section and other small changes <br>
  + replace sass file to add new css <br>

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

