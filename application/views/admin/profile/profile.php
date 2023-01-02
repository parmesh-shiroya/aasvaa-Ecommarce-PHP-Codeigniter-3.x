<div class="c-row c-center">
<div class="grid loadder hidden  g824">
		<div class="grid g85 g8p1"></div>
		<div class="grid g814">
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
		</div>
		<div class="grid g85"></div>
	</div>
	<div class="grid card p-padding_15 g820">
	<h6 class="cp g8fw600 center g8fs18 g8mb25 font-karla">Address Details</h6>
		<form id="update_prof_data" class="pp-form grey-text text-darken-2">

			<div class="grid gpf g8p7 g824">
				<div class="grid input-field g812">
				 <i class="material-icons prefix">person</i>
					<label for="contact_person_name">Contact Person Name</label>
					<input id="contact_person_name" value="<?php echo (isset($contact_person_name)) ? $contact_person_name : ""; ?>" name="contact_person_name" required type="text" class="">
				</div>
				<div class="grid input-field g812">
				 <i class="material-icons prefix">business</i>
					<label for="company_name">Company Name:</label>
					<input id="company_name"  value="<?php echo (isset($company_name)) ? $company_name : ""; ?>"  name="company_name" required type="text" class="">
				</div>
			</div>
			<div class="grid gpf g8p7 g824">
				<div class="grid input-field g824">
				 <i class="material-icons prefix">navigation</i>
<label for="address1">Address 1</label>
					<input id="address1"  name="address1" value="<?php echo (isset($address1)) ? $address1 : ""; ?>" required type="text" class=" ">
				</div>
			</div>
			<div class="grid gpf g8p7 g824">
				<div class="grid input-field g824">
				 <i class="material-icons prefix">near_me</i>
<label for="address2">Address 2</label>
					<input id="address2" name="address2" value="<?php echo (isset($address2)) ? $address2 : ""; ?>" type="text" class=" ">
				</div>
			</div>
			<div class="grid gpf g8p7 g824">
				<div class="grid input-field g812">
				 <i class="material-icons prefix">map</i>
					<label for="add_city">City</label>
					<input  id="add_city" value="<?php echo (isset($add_city)) ? $add_city : ""; ?>" name="add_city" required type="text" class="">
				</div>
				<div class="grid input-field g812">
				 <i class="material-icons prefix">place</i>
					<label for="add_pincode">Pincode</label>
					<input id="add_pincode"  value="<?php echo (isset($add_pincode)) ? $add_pincode : ""; ?>" name="add_pincode" required type="text" maxlength="6" class="only-number">
				</div>

			</div>
			<div class="grid gpf g8p7 g824">
				<div class="grid input-field g812">
				 <i class="material-icons prefix">location_city</i>
					<label for="add_state">State:</label>
					<input  id="add_state" value="<?php echo (isset($add_state)) ? $add_state : ""; ?>"  name="add_state" required type="text" class="">
				</div>
				<div class="grid input-field g812">
				 <i class="material-icons prefix">terrain</i>
					<label for="add_country">Country</label>
					<input  id="add_country" value="<?php echo (isset($add_country)) ? $add_country : ""; ?>"  name="add_country" required type="text" class="">
				</div>
			</div>
			<div class="grid gpf g8p7 g824">
				<div class="grid input-field g812">
				 <i class="material-icons prefix">call</i>
					<label for="add_contactno">Contact no</label>
					<input  id="add_contactno" value="<?php echo (isset($add_contactno)) ? $add_contactno : ""; ?>" name="add_contactno" required type="text" maxlength="10" class="only-number">
				</div>
				<div class="grid input-field g812">
				 <i class="material-icons prefix">mail</i>
					<label for="add_email">Email id:</label>
					<input id="add_email"  value="<?php echo (isset($add_email)) ? $add_email : ""; ?>"  name="add_email" required type="text" class="">
				</div>
			</div>
			<div class="grid gpf g8p7 g824 center">

						<button class="c-btna g8plr20 g8mt20 waves-effect waves-light add_prof_data" type="submit" name="add_prof_data">Submit
						</button>
					</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
$("#update_prof_data").on('submit', function(event) {
event.preventDefault();
$(".loadder").removeClass('hidden');
var datas= $(this).serialize();
$.post(base_url+'admin/profile/profile/prof_data',  datas  , function(data, textStatus, xhr) {
	$(".loadder").addClass('hidden');
if(data.result == true){
	Lobibox.notify('success', {

    msg: 'Profile Update Successfully.'
});
	$('#update_prof_data').find("input[type]").removeClass('invalid');
$('#update_prof_data').find('.pp-error-text').remove();
$('#update_prof_data').find('.input-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
    // $('#update_prof_data').find("input[type]").val("");
}else{
   Lobibox.notify('error', {

    msg: 'Form Data Not Valid.'
});
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#update_prof_data [name='"+index+"']").addClass('invalid');
$("#update_prof_data [name='"+index+"']").parent('.input-field').addClass('pp-error');
$("#update_prof_data [name='"+index+"']").parent('.input-field').children('span.pp-error-text').remove();
$("#update_prof_data [name='"+index+"']").parent('.input-field').append('<span class="pp-error-text red-text g8fs13 font-karla font-capitalize">'+el+'</span>');
});
}
},'json');
});
	});
</script>