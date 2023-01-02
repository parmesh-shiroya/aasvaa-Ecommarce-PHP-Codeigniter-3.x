var base_url = "http://aasvaa.com/aasvaa/";
/////////////Price Seprater *////////////////
function price_seprate(price) {
var x = price;
if (x !== null) {
x = x.toString();
var lastThree = x.substring(x.length - 3);
var otherNumbers = x.substring(0, x.length - 3);
if (otherNumbers !== '')
lastThree = ',' + lastThree;
var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
return res;
}
}

///////// Google Analytics ///////
  // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  // })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  // ga('create', 'UA-88717305-1', 'auto');
  // ga('send', 'pageview');




///////// Pre Loader web Loading ///////
window.onload = function(){
  var preloader = document.querySelector(".preloader");
  if(preloader !== null){
  preloader.style.opacity = 0;
  setTimeout(function(){
   preloader.style.display = "none";
},1000);
}
};
 ///////// Pre Loader  End web Loading ///////
//// To Upper case ////


function toUpperCase(string){
string = string.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    return letter.toUpperCase();
});
return string;
}
/// End Upeper caer ////


$(document).ready(function() {
add_couma_in_number();
function add_couma_in_number(){
$('.num-comma').each(function(){
  var number = $(this).attr('numbers');
$(this).text(price_seprate(number));
});
}


Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
 title:false,
      size: 'mini',
      rounded: false,
position: 'center top',
delay: 3000,
delayIndicator: false,
iconSource: "fontAwesome",
closeOnClick: true, 
pauseDelayOnHover: false, 
    continueDelayOnInactiveTab: true,
});




   $(".price").each(function(index, el) {
   var x = $.trim($(this).attr('price'));
   
   $(this).html("&#8377;" + price_seprate(x));
   });


   jQuery.getJSON('http://freegeoip.net/json/', function(location) {
  // alert(location.country_code);
  // alert(location.country_name);
});

    /////////// super-hover Materialize depth 0 to 2 on hover //////////////
    $(".super-hover").hover(function() {
       /* Stuff to do when the mouse enters the element */

       $(this).removeClass('z-depth-0');
       $(this).addClass('z-depth-2');
    }, function() {
       /* Stuff to do when the mouse leaves the element */
       $(this).removeClass('z-depth-2');
       $(this).addClass('z-depth-0');
    });

    ////////// End pp Hover Materialize depth 0 to 2 on hover /////////

/******************** End Like Handler***************/
///pp_action To show ////
$(".pp-click-show2").on('click', function(event) {
    var div_class = $(this).attr("pp-action");
    $("."+div_class).toggleClass('pp-click-show-div-activate',300);
});


/******** Subscription Form *******/

      $(window).scroll( function() { 
 var scrolled_val = $(document).scrollTop().valueOf();
 
 if(scrolled_val > 300){
$('.scroll-to-top').addClass('scroll-to-top-activated');

 }
 else{
  $('.scroll-to-top').removeClass('scroll-to-top-activated');  

 }
});

$(".scroll-to-top").on('click', function(event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    
});

});
