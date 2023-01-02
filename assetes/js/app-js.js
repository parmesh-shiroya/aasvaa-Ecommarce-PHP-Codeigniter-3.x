var  window_height = $(window).height();
/*================== capital First Letter ==================*/
function capitalize(str){
var strs = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    return letter.toUpperCase();
});
return strs;
}
/*================== End capital First Letter ==================*/
$(document).ready(function() {
   /////////// Same Height //////////////
   $(".same_height_main").each(function(index, el) {
      var x = $(this).attr('same-class');
      var height = $(this).height();
      $("." + x).each(function(index, el) {
           $(this).css('min-height', height);
      });
      });

   ////////// End Same Height /////////
/*================== set Widow Height Full Screen Height ==================*/
////////// Open link On href class link ///////////////
$("body").on('click', '.href', function(event) {
   event.preventDefault();
   if($(this).attr('href') !== undefined && $(this).attr('href') !== null && $(this).attr('href') !== ""){
      location.href = $(this).attr('href');
   }
});
$("body").on('click', '.href a', function(event) {
   event.stopPropagation();
});
////////// End Open link On href class link ///////////////
    // $(".pheight_100vh").css('height', window_height);
/*================== End set Widow Height Full Screen Height ==================*/
/*================== Only Number Enter ==================*/
    $("body").on('keydown','.only-number',function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) ||
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
/*================== End Only Number Enter ==================*/

/******* Red Text Box When Black Focus out **********/
$("body").on('focusout', '.pp-text-field input[type=text],.pp-text-field textarea', function(event) {
    event.preventDefault();
    if($(this).prop('required') && $(this).attr('not_req') == "true" ){

        if(!$.trim($(this).val())){

            $(this).parent('.pp-text-field').addClass('pp-error');
        }else{
            $(this).parent('.pp-text-field').removeClass('pp-error');
        }
    }
});
/******* End Red Text Box When Black Focus out **********/
/******* Math **********/


$(".pp_math_text").each(function(index, el) {
   var this_obj = $(this);
    var first_obj = $(this).attr('first');
    var second_obj = $(this).attr('second');
    var math = $(this).attr('math');
    $('body').on('keyup', first_obj, function(event) {

        if($(this).val() !== ""){
       math_fun(this_obj,first_obj,second_obj,math);
       }
    });
    $('body').on('keyup', second_obj, function(event) {

if($(this).val() !== ""){
math_fun(this_obj,first_obj,second_obj,math);
}
    });
});
function math_fun(this_obj,first_obj,second_obj,math){
     if(math == "%"){
        var f = (($(second_obj).val()/$(first_obj).val())*100)-100;
var ans = "";
        if(f>0){
ans = "-"+f;
}else{
ans = Math.abs(f);
}
            $(this_obj).text("("+ans+"%)");
        }

        if(math == "+"){
         $(this_obj).text($(first_obj).val()+$(second_obj).val());
        }
        if(math == "-"){
         $(this_obj).text($(first_obj).val()-$(second_obj).val());
        }
}
/******* End Math **********/
});
