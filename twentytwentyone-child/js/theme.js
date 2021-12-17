/*!
  * Bootstrap v1.0.0 (undefined)
  * Copyright 2011-2021 
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

	//Get the button
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
