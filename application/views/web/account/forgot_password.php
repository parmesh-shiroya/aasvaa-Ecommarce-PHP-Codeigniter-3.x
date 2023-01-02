<div class="pp-container">
<div class="pp-row pp-padres pp-center">
<div class="pp-col zero_padding zero_margin   card ps6">
  <div class="pp-padres cyan z-depth-1 center"><span class="font21 font-roboto_slab white-text">Reset Password</span></div>
  <div class=" pp-col ps12 pp-padres grey lighten-3 grey-text text-derken-3">
  <div class="pp-col p-padding_10 font-raleway font14 ps12">Enter your email address associated with your account and click on reset password button to retrive new password in your email.</div><div class="divider"></div>
  	<form class="pp-form " id="forgot_cst_password_form">
<div class="pp-col p-padding_10  pm12">
                  <div class="pp-col zero_padding pp-text-field ps12">
                     <label class="active">Email Id</label>
                     <input placeholder="Email Id" name="forgot_pass_email" required="" class="style_type1 login_email_id_txb" type="email">
                  </div>
               </div>
               <div class="pp-col p-padding_10 center ps12">
               <button class="btn btn-round button waves-effect waves-light cyan" type="submit" name="">Reset Password
                     <i class="material-icons left">vpn_key</i>
                     </button>
                     </div>
  	</form>
  </div>
</div>
</div>
</div>

<script>
// ================= Forgot Password ========================= //
$("#forgot_cst_password_form").on('submit', function(event) {
event.preventDefault();
var datas = $(this).serialize();
$.post(base_url+'/api/web_api/forgot_password',  datas  , function(data, textStatus, xhr) {
if(data.result == true){
	Materialize.toast('We Send A New Password To Your Email.', 4000);
$('#forgot_cst_password_form').find('.pp-error-text').remove();
$('#forgot_cst_password_form').find('.pp-error-text').val("");
$('#forgot_cst_password_form').find('.pp-text-field').removeClass('pp-error');

// location.href = base_url+'account/dashboard';
}else if (data.result == 2) {
Materialize.toast('Email Id Not Found.', 4000);
$('#forgot_cst_password_form').find('.pp-error-text').remove();
$('#forgot_cst_password_form .pp-text-field').addClass('pp-error');
$('#forgot_cst_password_form .pp-text-field').append('<span class="pp-error-text ">Email Id Not Found. Check your email id.</span>');
}
else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#forgot_cst_password_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#forgot_cst_password_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#forgot_cst_password_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');

});
// ================= End Forgot Password ========================= //

</script>