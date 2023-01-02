<div class="pp-row pheight_100vh main-divss zero_margin pp-center pp-vert-center ">
	<div class="pp-col ps12 pm8 pl3 p-padding_15 z-depth-5 card">
	<div class="pp-col ps12 p-padding_15 center"><img src="<?php echo base_url('assetes/img/logo.png'); ?>" class="z-depth-1 circle responsive-img"></div>
	<div class="pp-col ps12 pp-margin-b-10">
		<div class="pp-col ps12 center"><span class="font24  grey-text text-darken-2">Welcome</span></div>
		<div class="pp-col ps12 center"><span class="font14  grey-text text-darken-1">Sign in your account.</span></div>
		</div>
		<form class="pp-form " id="admin_login_form">
			<!-- <div class="pp-col p-padding_10 pp-text-field ps12">
				<input autocomplete="off" placeholder="Email id" name="admin_email_id" required type="text" class="textbox text-tran_none">
			</div> -->
			<div class="pp-col  p-padding_10 pp-text-field ps12">
				<input autocomplete="off" placeholder="Password" name="admin_password" required type="password" class="textbox">
			</div>
			<div class="pp-col ps12 p-padding_10 center">
<button type="submit" class="btn btn-round"><i class="material-icons left">vpn_key</i> Login</button>
			</div>
		</form>
		<div class="pp-col p-padding_10  ps12 center"><span class="font14 pointer forgot_password hover-text-primary grey-text">Forgot password?</span></div>
	</div>
</div>
<style>
</style>


<style type="text/css" media="screen">
.main-divss{
	background: rgba(0, 0, 0, 0) linear-gradient(0deg, rgba(0, 0, 0, 0) 50%, rgb(0, 150, 136) 50%) repeat scroll 0 0;
}
.textbox{
	-webkit-box-shadow: 0 0 1px 0 rgba(0,0,0,0.54) inset;
  box-shadow: 0 0 1px 0 rgba(0,0,0,0.54) inset;
  text-shadow: 1px 1px 0 rgba(255,255,255,0.66) ;
}
</style>

<script>
$(document).ready(function() {

$("#admin_login_form").on('submit', function(event) {
event.preventDefault();
var datas= $(this).serialize();
$.post(base_url+'admin/login/login',  datas  , function(data, textStatus, xhr) {
if(data.result == true){
  // location.reload();
  // Materialize.toast('Admin Login Successfully.', 4000);
$('#admin_login_form').find('.pp-error-text').remove();
$('#admin_login_form').find('.pp-text-field').removeClass('pp-error');
show_loginotp_popup();
// location.href = base_url+'account/dashboard';
}else if (data.result == 2) {
Materialize.toast('Password not match.', 4000);
$('#admin_login_form').find('.pp-error-text').remove();
$('#admin_login_form .pp-text-field').addClass('pp-error');
$('#admin_login_form .pp-text-field').append('<span class="pp-error-text ">Email and Password does not match. Check your email and password.</span>');
}
else if(data.result == false){
  Lobibox.notify('error', {
      position: 'center top',
      pauseDelayOnHover: true,
    closable: false,

    msg: data.message,
});
}
else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#admin_login_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#admin_login_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#admin_login_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');
});


function show_loginotp_popup(){
	swal({
  title: "Enter Otp.",
  text: "Enter Otp For Login.",
  type: "input",
  showCancelButton: true,
  closeOnConfirm: false,
  animation: "slide-from-top",
  inputPlaceholder: "Write OTP Here"
},
function(inputValue){
  if (inputValue === false) return false;

  if ($.trim(inputValue) === "") {
    swal.showInputError("You need to write OTP.");
    return false
  }else{
  	check_loginotp(inputValue);
  }


});
}

function check_loginotp(inputValue){
	$.post(base_url+'admin/login/login_confirm_otp', {otp: inputValue}, function(data, textStatus, xhr) {
if (data.result == true) {
	swal("Done!", "Login Successfully.","success");
	location.reload();
}else if(data.result == 'wrongotp'){
 swal("Cancelled", "Your OTP is Wrong Try Again. :)", "error");
}
else{
    Lobibox.notify('error', {
      position: 'center top',
      pauseDelayOnHover: true,
    closable: false,

    msg: data.message,
});
}
},"json");
}





$(".forgot_password").on('click', function(event) {
	event.preventDefault();
$.post(base_url+'admin/login/forogot_password_request', {param1: 'value1'}, function(data, textStatus, xhr) {
if (data.result == true) {
show_popup();
}else{
    Lobibox.notify('error', {
      position: 'center top',
      pauseDelayOnHover: true,
    closable: false,

    msg: data.message
});
}
},"json");
});


function show_popup(){
	swal({
  title: "Enter Otp.",
  text: "Enter Otp For Get New Password.",
  type: "input",
  showCancelButton: true,
  closeOnConfirm: false,
  animation: "slide-from-top",
  inputPlaceholder: "Write OTP Here"
},
function(inputValue){
  if (inputValue === false) return false;

  if ($.trim(inputValue) === "") {
    swal.showInputError("You need to write OTP.");
    return false
  }else{
  	check_otp(inputValue);
  }


});
}

function check_otp(inputValue){
	$.post(base_url+'admin/login/check_otp', {otp: inputValue}, function(data, textStatus, xhr) {
if (data.result == true) {
	swal("Done!", "New Password Send in your mail.","success");
}else if(data.result == 'wrongotp'){
 swal("Cancelled", "Your OTP is Wrong Try Again. :)", "error");
}
else{
    Lobibox.notify('error', {
      position: 'center bottom',
      pauseDelayOnHover: true,
    closable: false,

    msg: data.message,
});
}
},"json");
}
});
</script>