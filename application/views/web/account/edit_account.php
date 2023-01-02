<div class="pp-col card ps12">
	<div class="pp-col p-padding_10 ps12">
		<h6 class="title  font18">MY ACCOUNT INFORMATION</h6>
	</div>

	<div class="pp-col ps12">
		<div class="pp-col pp-margin-tb-7 zero_padding ps12">
			<form id="edit_information_form" class=" pp-form">
				<div class="pp-col p-padding_10 pm12">
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span> First Name</label>


						<input placeholder="First Name" value="<?php echo (isset($account_detail) && !empty($account_detail->first_name)) ? $account_detail->first_name : ""; ?>" name="account_first_name" required type="text" class="">
					</div>
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span> Last Name</label>
						<input placeholder="Last Name" value="<?php echo (isset($account_detail) && !empty($account_detail->last_name)) ? $account_detail->last_name : ""; ?>" name="account_last_name" required type="text" class="">
					</div>
				</div>
				<div class="pp-col p-padding_10 pm12">
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span> E-Mail</label>
						<input placeholder="Email Id" name="account_email_id" value="<?php echo (isset($account_detail) && !empty($account_detail->email_id)) ? $account_detail->email_id : ""; ?>" required type="text" class="text-tran_none">
					</div>
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span> Mobile no</label>
						<input placeholder="Mobile no" value="<?php echo (isset($account_detail) && !empty($account_detail->mobileno)) ? $account_detail->mobileno : ""; ?>" name="account_mobile" required type="text" class="only-number">
					</div>
				</div>
				<div class="pp-col p-padding_10  pm12">
                  <div class="pp-col pp-text-field ps12">
                     <label>Gender : </label>
                      <input                                                         <?php echo (isset($account_detail->gender) && $account_detail->gender == 'male') ? "checked" : ""; ?> name="account_gender" value="male"  type="radio" id="male_radio" />
      <label for="male_radio">Male</label>
       <input                           <?php echo (isset($account_detail->gender) && $account_detail->gender == 'female') ? "checked" : ""; ?> name="account_gender" type="radio" value="female" id="female_radio" />
      <label for="female_radio">Female</label>
                  </div>
               </div>
				<div class="pp-col center p-padding_10 ps12 pm10 pl6">
<button type="submit" class="btn primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$("#edit_information_form").on('submit', function(event) {
		event.preventDefault();
		var datas = $(this).serialize();
		$.post(base_url+'account/edit_account/edit',datas , function(data, textStatus, xhr) {
			if(data.result == true){
$('#edit_information_form').find('.pp-error-text').remove();
$('#edit_information_form').find('.pp-text-field').removeClass('pp-error');
Materialize.toast('Update Successfully.', 4000);
// location.href = base_url+'account/dashboard';
}
else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#edit_information_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#edit_information_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#edit_information_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
		},"json");
	});
</script>