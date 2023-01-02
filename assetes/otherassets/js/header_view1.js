$(document).ready(function() {
    $(".button-collapse").sideNav(
        {
            closeOnClick: true
        });
    $(".cart_button").hover(function() {
        $("#cart-div-main").css('display', 'block');
    }, function() {
        $("#cart-div-main").css('display', 'none');
    });


 $(".login_model_call_button").on('click', function(event) {
                event.preventDefault();
        $('#quick_login_model').openModal();


            });

     // ================= GUEST Login Customer========================= //
$("#guest_user_login_form").on('submit', function(event) {
event.preventDefault();
var datas = $(this).serialize();
$.post(base_url+'/account/login/guest_login',  datas  , function(data, textStatus, xhr) {
if(data.result == true){
// login_with_firebase(email,password);
$('#guest_user_login_form').find('.pp-error-text').remove();
$('#guest_user_login_form').find('.pp-text-field').removeClass('pp-error');
location.reload();
}else if (data.result == 2) {
Materialize.toast('Email and Password not match.', 4000);
$('#guest_user_login_form').find('.pp-error-text').remove();
$('#guest_user_login_form .pp-text-field').addClass('pp-error');
$('#guest_user_login_form .pp-text-field').append('<span class="pp-error-text ">Email and Password does not match. Check your email and password.</span>');
}
else{
// Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
Materialize.toast(el, 3000,'rounded');
$("#guest_user_login_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#guest_user_login_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#guest_user_login_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');

});
// ================= End GUEST Login Customer========================= //
// ================= Login Customer========================= //
$("#customer_login_form_header").on('submit', function(event) {
event.preventDefault();
var datas = $(this).serialize();
var email = $(".login_email_id_txb").val();
var password = $(".login_password_txb").val();
$.post(base_url+'/account/login/login',  datas  , function(data, textStatus, xhr) {
if(data.result == true){
   // login_with_firebase(email,password);
$('#customer_login_form_header').find('.pp-error-text').remove();
$('#customer_login_form_header').find('.pp-text-field').removeClass('pp-error');

location.href = base_url+'account/dashboard';
}else if (data.result == 2) {
Materialize.toast('Email and Password not match.', 4000);
$('#customer_login_form_header').find('.pp-error-text').remove();
$('#customer_login_form_header .pp-text-field').addClass('pp-error');
$('#customer_login_form_header .pp-text-field').append('<span class="pp-error-text ">Email and Password does not match. Check your email and password.</span>');
}
else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#customer_login_form_header [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#customer_login_form_header [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#customer_login_form_header [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');

});
// ================= End Login Customer========================= //







$(".facebook-login-btn").on('click', function(event) {
   event.preventDefault();
   var provider = new firebase.auth.FacebookAuthProvider();
   firebase.auth().signInWithPopup(provider).then(function(result) {
  // This gives you a Google Access Token. You can use it to access the Google API.
  console.log(result);
  var tokens = result.credential.accessToken;
  // The signed-in user info.
  var user = result.user;

  $.post(base_url+'account/login/login_with_facebooks', {email_address: user.email,first_name:user.displayName,user_ids:user.m,image_links:user.photoURL}, function(data, textStatus, xhr) {
     console.log(data);
     if (data.result == 'true') {
location.href = base_url+'account/my_account/password';
     }else{
      Materialize.toast(data.result,3000);
     }
  },"json");
}).catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  var errorMessage = error.message;
  // The email of the user's account used.
  var email = error.email;
  // The firebase.auth.AuthCredential type that was used.
  var credential = error.credential;
  // ...
});
});

$(".google-login-btn").on('click', function(event) {
   event.preventDefault();
   var provider = new firebase.auth.GoogleAuthProvider();
   provider.addScope('https://www.googleapis.com/auth/plus.login');
   firebase.auth().signInWithPopup(provider).then(function(result) {
  // This gives you a Google Access Token. You can use it to access the Google API.
  console.log(result);
  var tokens = result.credential.accessToken;
  // The signed-in user info.
  var user = result.user;


  $.post(base_url+'account/login/login_with_google', {email_address: user.email,first_name:user.displayName,user_ids:user.m,image_links:user.photoURL}, function(data, textStatus, xhr) {
     console.log(data);
      if (data.result == 'true') {
location.href = base_url+'account/my_account/password';
      }else{
      Materialize.toast(data.result,3000);
     }
  },"json");
  // ...
}).catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  var errorMessage = error.message;
  // The email of the user's account used.
  var email = error.email;
  // The firebase.auth.AuthCredential type that was used.
  var credential = error.credential;
  // ...
});
});





});
$("#cart-div-main").hover(function() {
    $("#cart-div-main").css('display', 'block');
}, function() {
    $("#cart-div-main").css('display', 'none');
});





$(document).ready(function() {
  

    /*/=============================================================
    =========================== CART HANDLER =====================================
    =============================================================/*/
///////// Add To Cart //////////////
$("body").on('click', '.btn_add_to_cart2', function(event) {
  event.preventDefault();
   $.post(base_url+'api/cart_api',{ method:'add_to_cart2',product_id:$(this).attr('prod-id') }, function(data, textStatus, xhr) {
    Lobibox.notify('default', {
      position: 'center bottom',
      pauseDelayOnHover: true,    
    closable: false,  
   'icon':'fa fa-check-circle green-text',
    msg: 'Product added to cart successfully. <a href="'+base_url+'shopping_cart"><span class="blue-text g8pl10">GO TO CART</span></a>'
});
get_cart_data();

   },'json');
});
$(".btn_add_to_cart").on('click', function(event) {
   event.preventDefault();

   $.post(base_url+'api/cart_api',{ method:'add_to_cart2',product_id:$(this).attr('product-id') }, function(data, textStatus, xhr) {
Lobibox.notify('default', {
     
          position: 'center bottom',
      pauseDelayOnHover: true,    
    closable: false,  
   'icon':'fa fa-check-circle green-text',
    msg: 'Product added to cart successfully. <a href="'+base_url+'shopping_cart"><span class="blue-text g8pl10">GO TO CART</span></a>'
});
get_cart_data();

   },'json');
});
///////// End Add To Cart //////////////
///============ Get cart Date ===========///
get_cart_data();
function get_cart_data(){
   $.post(base_url+'api/cart_api', {method: 'get_cart_ci'}, function(data, textStatus, xhr) {
      if(data !== "" && data !== undefined && data !== null){
$html = "";
         $.each(data.datas,function(index, el) {

$html += '<div class="c-row gmf z-depth-0 cart-div card hoverable"><div class="grid gpf g124"><div class="grid gpf g13"><img style="width:48px;" class="br3" src="'+base_url+'uploads/pro_image/94_130/'+el.image+'"> </div> <div class="grid gpf g111"> <p class="cart-pro-name wsn oh toe g8ls4 font12"><a class="black-text" href="'+base_url+'/product/quick/product/'+el.sku+'/'+el.id+'/'+el.name+'">'+el.name+'</a></p> </div><div class="grid gpf g8plr4 center valign-wraper gf g14"><div class="grid gpf white border-1px center"><div product-id="'+el.id+'" rowid="'+el.rowid+'" class="g8ptb2 font-roboto qty-minus g8fw900 pointer g8fs14 g8plr7 left">-</div><p  rowid="'+el.rowid+'"  product-id="'+el.id+'" class="g8ptb3  stock_counter-div font-roboto g8fw300 g8fs14 g8plr4 cart-pro-name left">'+el.qty+'</p><div product-id="'+el.id+'" rowid="'+el.rowid+'" class="g8ptb2 qty-plus pointer font-roboto g8fw900 g8fs14 g8plr7 left">+</div></div></div> <div class="grid gpf g14"> <p class="cart-pro-name  g8fw500 g8ls10">'+ el.total_price+'</p> </div> <div class="grid gpf g11 valign-wraper"> <p class="cart-pro-name valign"> <i product-id="'+el.id+'" cart-id="'+index+'" class="material-icons g8fs14 grey-text icon-delete">clear</i></p> </div> </div> </div>';
         });
         $(".cart_size_span").text(data.size);
         $("#cart-div-main .shipping_charges").html(data.shipping_charges);
         $("#cart-div-main .total_prices").html(data.total_price);
         if($html == ""){
$html = '<h6 class="g8mt20 font-karla g8fs20">Cart Is Empty</h6><img class="responsive-img" width="45px" src="'+base_url+'assetes/img/cart.png"><div class="divider g8mb10"></div>';
         }
$("#cart-div-main-sub").html($html);
      }
   },'json');
   ///============ End Get cart Date ===========///
}
///////// End Add To Cart //////////////
/////// Delete From Cart ////////
$("#cart-div-main").on('click', '.icon-delete', function(event) {
   event.preventDefault();
   var prod_id = $(this).attr('cart-id');
   $.post(base_url+'api/cart_api',{method:'remove_from_cart_ci',product_id:prod_id}, function(data, textStatus, xhr) {
   
      get_cart_data();

   });
});
/////// End Delete From Cart ////////
///============= Qty Handler ================///
  $("#cart-div-main").on('click','.qty-minus' ,function(event) {
event.preventDefault();
var values = parseInt($(".stock_counter-div[rowid='"+$(this).attr('rowid')+"']").text()) - 1;
if(values >= 1){
$(".stock_counter-div[rowid='"+$(this).attr('rowid')+"']").text(values);
update_to_cart($(this).attr('rowid'),values);
// get_cart_data();
}
});
$("#cart-div-main").on('click', '.qty-plus',function(event) {
event.preventDefault();
var values =  parseInt($(".stock_counter-div[rowid='"+$(this).attr('rowid')+"']").text()) + 1;
if(values <= 10){
$(".stock_counter-div[rowid='"+$(this).attr('rowid')+"']").text(values);
update_to_cart($(this).attr('rowid'),values);
// get_cart_data();
}
});
function update_to_cart(rowid,values){
$.post(base_url+'api/cart_api/', {method: 'update_cart_qty',rowids : rowid,qty :values}, function(data, textStatus, xhr) {
console.log(data);
 if (data == 1 ) {
get_cart_data();
  }
});
}
///============= End Qty Handler ================///
/*/=============================================================
=========================== End CART HANDLER=====================================
=============================================================/*/
/******************** Like Handler***************/
update_like_prod_status();
$(".btn_like").on('click', function(event) {

   event.preventDefault();
   if($(this).hasClass('btn_like')){
   $.post(base_url+'api/product_api',{method: 'like_product',product_id:$(this).attr('product-id')}, function(data, textStatus, xhr) {

      if(data !=="0"){
        Lobibox.notify('default', {
    msg: 'Added to Wishlist.'
});
        $(".btn_like.sing_prod.material-icons").text('favorite');
        $(".btn_like.sing_prod.material-icons").addClass('primary-light-text')
update_like_prod_status();
      }else{
                Lobibox.notify('default', {
    msg: 'Please Login First.'
});
   
      }
   });
} else if ($(this).hasClass('btn_remove_like')) {


   $.post(base_url+'api/product_api',{method: 'remove_like_product',product_id:$(this).attr('product-id')}, function(data, textStatus, xhr) {
      if(data !== 0){
        Lobibox.notify('default', {
    
    msg: 'Remove From Wishlist.'
});
        $(".btn_remove_like.sing_prod.material-icons").text('favorite_border');
update_like_prod_status();
      }else{
        Lobibox.notify('default', {
   
    msg: 'Please Login First.'
});
      }
   });
}
});
$('.btn_remove_like').on('click', function(event) {
   event.preventDefault();
   $.post(base_url+'api/product_api',{method: 'remove_like_product',product_id:$(this).attr('product-id')}, function(data, textStatus, xhr) {

      if(data !== 0){
        
update_like_prod_status();

  
      }else{
          Lobibox.notify('default', {
    
    msg: 'Please Login First.'
});
        
      }
   });
});

function update_like_prod_status(){
   $.post(base_url+'api/product_api',{method: 'get_like_product'}, function(data, textStatus, xhr) {
if(data !== "" && data !== undefined && data !== null && data !== "0"){
   
   $(".btn_remove_like").addClass('btn_like');
   $(".btn_remove_like").children('.material-icons').html('favorite_border');
   $(".btn_remove_like").children('.material-icons').removeClass('primary-light-text');
   $(".btn_remove_like").removeClass('btn_remove_like');
   
   $(".btn_like").children('.material-icons').removeClass('active_prod_icon');
   $(".btn_like").children('.fa').removeClass('active_prod_icon');
   $.each(data,function(index, el) {
    
$(".btn_like[product-id='"+el.product_id+"']").children('.material-icons').html('favorite');
$(".btn_like[product-id='"+el.product_id+"']").children('.fa').addClass('active_prod_icon');
$(".btn_like[product-id='"+el.product_id+"']").children('.material-icons').addClass('primary-light-text');
$(".btn_like[product-id='"+el.product_id+"']").addClass('btn_remove_like');

      $(".btn_remove_like[product-id='"+el.product_id+"']").removeClass('btn_like');
$(".material-icons.btn_remove_like[product-id='"+el.product_id+"']").text('favorite');
$(".material-icons.btn_remove_like[product-id='"+el.product_id+"']").addClass('primary-light-text');
   });
}if(data === ""){
   $(".btn_remove_like").addClass('btn_like');

   $(".btn_remove_like").removeClass('btn_remove_like');

   $(".btn_like").children('.material-icons').removeClass('active_prod_icon');
   $(".btn_like").children('.fa').removeClass('active_prod_icon');

}
   });
}


});