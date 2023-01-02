
$(document).ready(function() {
   var admin_nav_show = true;
  $('.material-select').material_select();
setadmin_content_height();
function setadmin_content_height(){
$(".pp_admin_main_col .pp-admin-content").css('height', window_height-30-$(".pp_admin_main_col .pp-admin-header").height()+'px');
}
/*=============== PP show_div On Checkboc Checked ===============*/
$(".pp-show_div_on_check").each(function(index, el) {
     if($(this).is(":checked")) {
            $('.'+$(this).attr('pp-div_class')).addClass('pp_show_on_check_div-activate',300);
        }else{
            $('.'+$(this).attr('pp-div_class')).removeClass('pp_show_on_check_div-activate',300);
        }
});
$(".pp-show_div_on_check").on('change', function(event) {
    if($(this).is(":checked")) {
            $('.'+$(this).attr('pp-div_class')).addClass('pp_show_on_check_div-activate',300);
        }else{
            $('.'+$(this).attr('pp-div_class')).removeClass('pp_show_on_check_div-activate',300);
        }
      
});
/*=============== End show_div On Checkboc Checked ===============*/
     /*=============== PP Action CLick Show ===============*/
$(".pp-click-show").on('click', function(event) {
    // alert("what");
    if(admin_nav_show === false){
        show_and_hide_admin_nav();
    }
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
   if($(gets).attr('class') == null){
  gets = $("a[href='"+href+"']").parent("div.pp-admin-nav");    
}
   
    
    if( $(gets).attr('class') == null || typeof $(gets).attr('class') == 'undefined'){
      href = base_url+""+parts[1]+"/"+parts[2]+"/"+parts[3]+"/"+parts[4];
gets = $("a[href='"+href+"']").parent("div.pp-click-show-div");
if($(gets).attr('class') == null){
  gets = $("a[href='"+href+"']").parent("div.pp-admin-nav");    
}

} 
if( $(gets).attr('class') == null || typeof $(gets).attr('class') == 'undefined'){
  href = base_url+""+parts[1]+"/"+parts[2]+"/"+parts[3];
gets = $("a[href='"+href+"']").parent("div.pp-click-show-div");
if($(gets).attr('class') == null){
  gets = $("a[href='"+href+"']").parent("div.pp-admin-nav");    
}

}
if( $(gets).attr('class') == null || typeof $(gets).attr('class') == 'undefined'){
  href = base_url+""+parts[1]+"/"+parts[2];
gets = $("a[href='"+href+"']").parent("div.pp-click-show-div");
if($(gets).attr('class') == null){
  gets = $("a[href='"+href+"']").parent("div.pp-admin-nav");    
}
}
if( $(gets).attr('class') == null || typeof $(gets).attr('class') == 'undefined'){
  href = base_url+""+parts[1];
gets = $("a[href='"+href+"']").parent("div.pp-click-show-div");
if($(gets).attr('class') == null){
  gets = $("a[href='"+href+"']").parent("div.pp-admin-nav");    
}
}
}



 if( typeof $(gets).attr('class') != 'undefined'){
  $(gets).addClass('pp-activate');
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
   show_and_hide_admin_nav();
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
       setadmin_content_height();
  }



  /*=============== End PP Toogle Nav CLick Show ===============*/
});
