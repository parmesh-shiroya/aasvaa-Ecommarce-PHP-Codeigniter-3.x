$(document).ready(function() {
	/*=============== PP Action CLick Show ===============*/
$(".pp-click-show").on('click', function(event) {
    // alert("what");
    // if(admin_nav_show === false){
        // show_and_hide_admin_nav();
    // }
    var div_class = $(this).attr("pp-action");
    $("."+div_class).toggleClass('pp-click-show-div-activate',300);
});
trigger_admin_nav_collapse_item();
///// Open collapsible item if page link under the sub items//////
function trigger_admin_nav_collapse_item(){
var url_pathname = window.location.pathname;
var parts = url_pathname.split("/");
if(parts[1] == 'aasvaa'){
parts.shift();
}

var gets = "";
var href = "";
if(parts != "" && parts !== "undefined" && parts !== null){
    href = base_url+""+parts[1]+"/"+parts[2]+"/"+parts[3]+"/"+parts[4]+"/"+parts[5];
    gets = $("a[href='"+href+"']").parent("div.pp-click-show-div");    
    
    if( $(gets).attr('class') == null || typeof $(gets).attr('class') == 'undefined'){
      href = base_url+""+parts[1]+"/"+parts[2]+"/"+parts[3]+"/"+parts[4];
gets = $("a[href='"+href+"']").parent("div.pp-click-show-div");

}
if( $(gets).attr('class') == null || typeof $(gets).attr('class') == 'undefined'){
  href = base_url+""+parts[1]+"/"+parts[2]+"/"+parts[3];
gets = $("a[href='"+href+"']").parent("div.pp-click-show-div");

}
if( $(gets).attr('class') == null || typeof $(gets).attr('class') == 'undefined'){
  href = base_url+""+parts[1]+"/"+parts[2];
gets = $("a[href='"+href+"']").parent("div.pp-click-show-div");
}
if( $(gets).attr('class') == null || typeof $(gets).attr('class') == 'undefined'){
  href = base_url+""+parts[1];
gets = $("a[href='"+href+"']").parent("div.pp-click-show-div");
}
}

var url =  window.location.href; 
$("a[href='"+url+"']").parent('.pp-admin-nav.main').addClass('pp-activate');


 if( typeof $(gets).attr('class') != 'undefined'){
$("a[href='"+href+"']").children('.subs').addClass('pp-activate');

if(typeof $(gets).attr('class') !== "undefined"){
$.each($(gets).attr('class').split(" "),function(index, el) {
    $("div[pp-action='"+el+"']").addClass('pp-activate');
$("div[pp-action='"+el+"']").click();
});
}
}
}

///// End Open collapsible item if page link under the sub items//////
  /*===============End PP Action CLick Show ===============*/
  /*=============== PP Toogle Nav CLick Show ===============*/
  $(".pp-admin-nav.nav_toogle").on('click', function(event) {
   // show_and_hide_admin_nav();
  });


  function show_and_hide_admin_nav(){

   $(".pp-admin-nav-col").toggleClass('pm05');
      $(".pp-admin-nav .p-name").toggleClass('dis-none');
      $(".pp-admin-nav .p-icon").toggleClass('ps12');
      $(".pp_admin_main_col").toggleClass('ps1105');
      $(".pp_admin_main_col .pp-admin-header .material-icons").toggleClass('small');
      $(".pp-admin-nav .p-icon .material-icons").toggleClass('small pcenter');
      if($(".pp-admin-nav .p-icon").hasClass('ps2')){
        admin_nav_show = false;
        $(".pp-admin-nav .p-icon").removeClass('ps2');
        $(".pp_admin_main_col").removeClass('ps10');
        $(".pp-admin-nav.pp-click-show-div-activate").removeClass('pp-click-show-div-activate',300)
      }else{
        admin_nav_show = true;
        $(".pp_admin_main_col").addClass('ps10');
$(".pp-admin-nav .p-icon").addClass('ps2');
      }
       // setadmin_content_height();
  }



  /*=============== End PP Toogle Nav CLick Show ===============*/
});