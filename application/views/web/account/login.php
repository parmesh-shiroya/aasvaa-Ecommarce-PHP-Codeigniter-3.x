<div class="pp-container">
   <div class="pp-row pp-center">
      <div class="pp-col pm12 pl6 ">
         <div class="pp-col ps12 zero_padding z-depth-0 border3-1px card dark-white-1">
            <div class="pp-col  p-padding_10  bp center-align pp-padres pm12">
               <span class="white-text font-roboto_slab font21 center-align">Login</span>
            </div>
            <div class="divider">
            </div>
            <form class="pp-form " id="customer_login_form" method="post">
               <div class="pp-col p-padding_10 pp-margin-t-12 pm12">
                  <div class="pp-col pp-text-field ps12">
                     <label>Email Id</label>
                     <input placeholder="Email Id" name="login_email" required type="email" class="style_type1 login_email_id_txb">
                  </div>
               </div>
               <div class="pp-col p-padding_10  pm12">
                  <div class="pp-col pp-text-field ps12">
                     <label>Password</label>
                     <input placeholder="Password" name="login_password" required type="password" class="style_type1 login_password_txb">
                  </div>
               </div>
               <div class="pp-col pp-padres pm12">
                  <div class="pp-col pp-margin-t-7 pm12">
                     <div class="pp-col ps2 pm4  padding1"></div>
                     <button class="c-btnp btn-round button waves-effect pp-col ps8 pm4 waves-light " type="submit" name="">Login
                     <i class="material-icons left">vpn_key</i>
                     </button>
                     <div class="pp-col ps2 pm4  padding1"></div>
                     <div class="pp-col ps12 center pp-margin-t-12 font13" ><a class="grey-text font-roboto_slab text-darken-2 hover-text-primary" href="<?php echo site_url('account/login/forgot_password'); ?>">Forgot Password?</a></div>
                  </div>
               </div>
            </form>
            <div class="pp-col p-padding_lr_1rem pp-margin-tb-25 pm12">
                     <!-- <div class="pp-col ps2 pm4  padding1"></div> -->
                     <button class="c-btnp  btn-round waves-effect pp-col ps12 pm5 waves-light google_login_button" type="submit" name="add_product_submit">Login With Google
                     <i class="fa fa-google left" aria-hidden="true"></i>
                     </button>
                     <div class="pp-col ps12 pm2  p-padding_10"></div>
                     <button class="btn  btn-round waves-effect pp-col ps12 pm5 waves-light facebook_login_button" type="submit" name="add_product_submit">Login With Facebook
                     <i class="fa fa-facebook left" aria-hidden="true"></i>
                     </button>
               </div>
         </div>
      </div>
      <div class="pp-col pm12 pl6 ">
         <div class="pp-col ps12 zero_padding z-depth-0 border3-1px card dark-white-1">
            <div class="pp-col bp p-padding_10 center-align pp-padres pm12">
               <span class="white-text font-roboto_slab font21 center-align">Register Now</span>
            </div>
            <div class="divider">
            </div>
            <form class="pp-form" id="customer_register_form" action="<?php echo base_url('account/login/register'); ?>" method="post">
               <div class="pp-col p-padding_10 pp-margin-t-12 pm12">
                  <div class="pp-col pp-text-field ps12">
                     <label>Email Id</label>
                     <input placeholder="Email Id" name="register_email" required type="email" class="style_type1 signup_email_id_txb">
                  </div>
               </div>
               <div class="pp-col p-padding_10  pm12">
                  <div class="pp-col pp-text-field ps12">
                     <label>Password</label>
                     <input placeholder="Password" name="register_password" required type="password" class="style_type1 signup_password_txb">
                  </div>
               </div>
               <div class="pp-col p-padding_10  pm12">
                  <div class="pp-col pp-text-field ps12">
                     <label>First Name</label>
                     <input placeholder="Enter Your first name" name="register_first_name" required type="text" class="style_type1 ">
                  </div>
               </div>
               <div class="pp-col p-padding_10  pm12">
                  <div class="pp-col pp-text-field ps12">
                     <label>Last Name</label>
                     <input placeholder="Enter Your last name" name="register_last_name" required type="text" class="style_type1 ">
                  </div>
               </div>
               <div class="pp-col p-padding_10  pm12">
                  <div class="pp-col pp-text-field ps12">
                     <label>Gender : </label>
                      <input name="register_gender" value="male" checked type="radio" id="male_radio" />
      <label for="male_radio">Male</label>
       <input name="register_gender" type="radio" value="female" id="female_radio" />
      <label for="female_radio">Female</label>
                  </div>
               </div>
               <div class="pp-col pp-padres pm12">
                  <div class="pp-col pp-padres pm12">
                     <div class="pp-col ps2 pm4  padding1"></div>
                     <button class="c-btnp p-padding_lr_1rem btn-round waves-effect pp-col ps8 pm4 waves-light add_product_submit" type="submit" name="register_sign_up">Sign up
                     <i class="material-icons left">lock</i>
                     </button>
                     <div class="pp-col ps2 pm4  padding1"></div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<style type="text/css" media="screen">
   .google_login_button{
      background: #EA4335;
      padding-left: 1rem !important;
      padding-right: 1rem !important;
      font-family: "Fira Sans",sans-serif;
      text-transform: none;
       box-shadow: 0 4px 7px rgba(234, 67, 53, 0.5) !important;
   }
   .facebook_login_button{
    background: rgb(59,89,152);

      padding-left: 1rem !important;
      padding-right: 1rem !important;
      font-family: "Fira Sans",sans-serif;
      text-transform: none;
       box-shadow: 0 4px 7px rgba(59, 89, 152, 0.5) !important;
   }
    .google_login_button:hover,.google_login_button:focus{
      background: #EA4335 !important;

        box-shadow: 0px 6px 10px rgba(234, 67, 53, 0.8) !important;
    }
     .facebook_login_button:hover,.facebook_login_button:focus{
      background: rgb(59,89,152) !important;

        box-shadow: 0px 6px 10px rgba(59, 89, 152, 0.8) !important;
    }
</style>
<script>
// ================= Login Customer========================= //
$("#customer_login_form").on('submit', function(event) {
event.preventDefault();
var datas = $(this).serialize();
var email = $(".login_email_id_txb").val();
var password = $(".login_password_txb").val();
$.post(base_url+'/account/login/login',  datas  , function(data, textStatus, xhr) {
if(data.result == true){
   login_with_firebase(email,password);
$('#customer_login_form').find('.pp-error-text').remove();
$('#customer_login_form').find('.pp-text-field').removeClass('pp-error');

// location.href = base_url+'account/dashboard';
}else if (data.result == 2) {
Materialize.toast('Email and Password not match.', 4000);
$('#customer_login_form').find('.pp-error-text').remove();
$('#customer_login_form .pp-text-field').addClass('pp-error');
$('#customer_login_form .pp-text-field').append('<span class="pp-error-text ">Email and Password does not match. Check your email and password.</span>');
}
else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#customer_login_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#customer_login_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#customer_login_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');

});
// ================= End Login Customer========================= //
// ================= Register Customer========================= //
$("#customer_register_form").on('submit', function(event) {
event.preventDefault();
var datas= $(this).serialize();
var email = $(".signup_email_id_txb").val();
var password = $(".signup_password_txb").val();
$.post(base_url+'/account/login/register',  datas  , function(data, textStatus, xhr) {
if(data.result == true){
signup_with_firebase(email,password);
$('#customer_register_form').find('.pp-error-text').remove();
$('#customer_register_form').find('.pp-text-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
}else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#customer_register_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#customer_register_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#customer_register_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');
});

$(".facebook_login_button").on('click', function(event) {
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

$(".google_login_button").on('click', function(event) {
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

function signup_with_firebase(emails,password){
const email = emails;
const pass = password;
const auth=  firebase.auth();

const promise= auth.createUserWithEmailAndPassword(email,pass);
promise
.catch(e=> console.log(e.message));

firebase.auth().onAuthStateChanged(firebaseUser => {
   if(firebaseUser){
      location.href = base_url+'account/dashboard';
   } else{
      location.href = base_url+'account/dashboard';
   }
});
}

function login_with_firebase(emails,password){
const email = emails;
const pass = password;
const auth=  firebase.auth();

const promise= auth.signInWithEmailAndPassword(email,pass);
promise
.catch(e=> console.log(e.message));

firebase.auth().onAuthStateChanged(firebaseUser => {
   if(firebaseUser){
      location.href = base_url+'account/dashboard';
   } else{
      location.href = base_url+'account/dashboard';
   }
});
}



// ================= End Register Customer========================= //
</script>