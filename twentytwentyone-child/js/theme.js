/*!
  * Bootstrap v1.0.0 (undefined)
  * Copyright 2011-2022 
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
  */
(function (factory) {
	typeof define === 'function' && define.amd ? define(factory) :
	factory();
})((function () { 'use strict';

	/**
	 * File skip-link-focus-fix.js.
	 *
	 * Helps with accessibility for keyboard only users.
	 *
	 * Learn more: https://git.io/vWdr2
	 */
	(function () {
	  var isWebkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
	      isOpera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
	      isIe = navigator.userAgent.toLowerCase().indexOf('msie') > -1;

	  if ((isWebkit || isOpera || isIe) && document.getElementById && window.addEventListener) {
	    window.addEventListener('hashchange', function () {
	      var id = location.hash.substring(1),
	          element;

	      if (!/^[A-z0-9_-]+$/.test(id)) {
	        return;
	      }

	      element = document.getElementById(id);

	      if (element) {
	        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
	          element.tabIndex = -1;
	        }

	        element.focus();
	      }
	    }, false);
	  }
	})();

	var myQuote = document.getElementById("error-404-text");

	window.onload = function () {
	  showQuote();
	};

	function showQuote() {
	  var quotes = ["One, Two, Freddy's Coming For You...", "He Came Home.", "Swallow This.", "They're Here.", "It's Alive! It's Alive!", "You're Gonna Need A Bigger Boat.", "Do You Like Scary Movies?", "We All Go A Little Mad Sometimes.", "Whatever you do, don’t fall asleep.", "Congratulations. You are still alive.", "Here's Johnny!", "Be afraid. Be very afraid.", "Thrill me.", "Where we’re going, we won’t need eyes to see.", "Send…more…paramedics.", "What an excellent day for an exorcism.", "We came, we saw, we kicked its a**!", "Tasty, tasty, beautiful fear.", "Look what your brother did to the door!", "I see dead people", "I’m scared to close my eyes, I’m scared to open them!", "Wouldst thou like to live deliciously?", "Oh, no tears, please. It’s a waste of good suffering.", "Seven days…", "Sometimes, dead is better.", "They’re all gonna laugh at you!", "He has his father’s eyes.", "A mind is a terrible thing to waste."];
	  var randomNumber = Math.floor(Math.random() * quotes.length);
	  var randomQuote = quotes[randomNumber];
	  myQuote.innerText = randomQuote;
	} //Get the button


	var mybutton = document.getElementById("myBtn"); // When the user scrolls down 20px from the top of the document, show the button

	window.onscroll = function () {
	  scrollFunction();
	};

	mybutton.addEventListener("click", topFunction);

	function scrollFunction() {
	  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	    mybutton.style.display = "block";
	  } else {
	    mybutton.style.display = "none";
	  }
	} // When the user clicks on the button, scroll to the top of the document


	function topFunction() {
	  window.scroll({
	    top: 0,
	    left: 0,
	    behavior: "smooth"
	  });
	}

}));
//# sourceMappingURL=theme.js.map
