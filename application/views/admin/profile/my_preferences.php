<div class="pp-row pp-center">
<div class="pp-col loadder hidden  pm12">
		<div class="pp-col pm2  padding1"></div>
		<div class="pp-col pm8">
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
		</div>
		<div class="pp-col pm2"></div>
	</div>
	<div class="pp-col card p-padding_15 ps8">
		<form id="update_profile_data" class="pp-form">
			<div class="pp-col pp-padres pm12">
				<div class="pp-col pp-text-field ps12">
					<label>Email Address</label>
					<input placeholder="Email Address" name="shop_add" value="<?php echo (isset($admin_id)) ? $admin_id->login_email_id : ""; ?>" required type="text" disabled class=" text-tran_none">
				</div>
			</div>
			<div class="pp-col pp-padres pm12">
				<div class="pp-col pp-text-field ps6">
					<label>New Password</label>
					<input placeholder="New Password" name="password" required type="password">
				</div>
				<div class="pp-col pp-text-field ps6">
					<label>Confirm Password:</label>
					<input placeholder="Confirm Password"  name="con_password" required type="password" class="text-tran_none">
				</div>
			</div>

			<div class="pp-col pp-padres pm10 center">

						<button class="btn waves-effect waves-light add_prof_data" type="submit" name="add_prof_data">Change
						</button>
					</div>
		</form>
	</div>
	<div class="pp-col card p-padding_15 ps8">
		<form id="update_profile_mobile_data" class="pp-form">
						<div class="pp-col pp-padres pm12">
			<h6 class="grey-text text-darken-1 g8ml15 font-karla g8fs13"><i class="fa fa-info g8mr7"></i> Write Minimum one no. Otp Send in this no.</h6>
				<div class="pp-col pp-text-field ps4">
					<label class="active">Mobile no 1:</label>
					<input placeholder="Mobile no" name="mob1" value="<?php echo (isset($admin_id)) ? $admin_id->mobileno : ""; ?>" class="only-number" type="text">
				</div>
				<div class="pp-col pp-text-field ps4">
					<label class="active">Mobile no 2:</label>
					<input placeholder="Mobile no" name="mob2" value="<?php echo (isset($admin_id)) ? $admin_id->mobileno1 : ""; ?>" class="only-number" type="text">
				</div>
  <div class="pp-col pp-text-field ps4">
					<label class="active">Mobile no 3:</label>
					<input placeholder="Mobile no" name="mob3" value="<?php echo (isset($admin_id)) ? $admin_id->mobileno2 : ""; ?>" class="only-number" type="text">
				</div>
			</div>
			<div class="pp-col pp-padres pm10 center">

						<button class="btn waves-effect waves-light add_prof_data" type="submit" name="add_prof_data">Change
						</button>
					</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
$("#update_profile_data").on('submit', function(event) {
event.preventDefault();
$(".loadder").removeClass('hidden');
var datas= $(this).serialize();
$.post(base_url+'admin/profile/preferences/change_password',  datas  , function(data, textStatus, xhr) {
	$(".loadder").addClass('hidden');
if(data.result == true){
	Materialize.toast('Password Change Successfully.', 4000);
$('#update_profile_data').find('.pp-error-text').remove();
$('#update_profile_data').find('.pp-text-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
    // $('#update_profile_data').find("input[type]").val("");
}else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#update_profile_data [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#update_profile_data [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#update_profile_data [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');
});

$("#update_profile_mobile_data").on('submit', function(event) {
event.preventDefault();
$(".loadder").removeClass('hidden');
var datas= $(this).serialize();
$.post(base_url+'admin/profile/preferences/change_mobileno',  datas  , function(data, textStatus, xhr) {
	$(".loadder").addClass('hidden');
if(data.result == true){
	Materialize.toast('Mobile no Update Successfully.', 4000);
$('#update_profile_mobile_data').find('.pp-error-text').remove();
$('#update_profile_mobile_data').find('.pp-text-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
    // $('#update_profile_mobile_data').find("input[type]").val("");
}else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#update_profile_mobile_data [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#update_profile_mobile_data [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#update_profile_mobile_data [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');
});
	});
</script>