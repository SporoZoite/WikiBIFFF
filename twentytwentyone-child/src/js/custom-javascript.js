

var myQuote = document.getElementById("error-404-text");

window.onload = function () {
  showQuote();
};

function showQuote() {
  var quotes = [
    "One, Two, Freddy's Coming For You...",
    "He Came Home.",
    "Swallow This.",
    "They're Here.",
    "It's Alive! It's Alive!",
    "You're Gonna Need A Bigger Boat.",
    "Do You Like Scary Movies?",
    "We All Go A Little Mad Sometimes.",
    "Whatever you do, don’t fall asleep.",
    "Congratulations. You are still alive.",
    "Here's Johnny!",
    "Be afraid. Be very afraid.",
    "Thrill me.",
    "Where we’re going, we won’t need eyes to see.",
    "Send…more…paramedics.",
    "What an excellent day for an exorcism.",
    "We came, we saw, we kicked its a**!",
    "Tasty, tasty, beautiful fear.",
    "Look what your brother did to the door!",
    "I see dead people",
    "I’m scared to close my eyes, I’m scared to open them!",
    "Wouldst thou like to live deliciously?",
    "Oh, no tears, please. It’s a waste of good suffering.",
    "Seven days…",
    "Sometimes, dead is better.",
    "They’re all gonna laugh at you!",
    "He has his father’s eyes.",
    "A mind is a terrible thing to waste.",
  ];

  var randomNumber = Math.floor(Math.random() * quotes.length);
  var randomQuote = quotes[randomNumber];
  myQuote.innerText = randomQuote;
}



//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
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
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  window.scroll({
    top: 0,
    left: 0,
    behavior: "smooth",
  });
}
