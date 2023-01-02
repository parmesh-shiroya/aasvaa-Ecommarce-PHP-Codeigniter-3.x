<div class="pp-col card ps12">
	<div class="pp-col p-padding_10 ps12">
		<h6 class="title  font18">My Address</h6>
	</div>
	<div class="pp-col ps12">
		<div class="pp-col pp-margin-tb-7 zero_padding ps12">
			<form id="edit_addresss" class=" pp-form">
				<div class="pp-col p-padding_10 pm12">

					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span>Name</label>
						<input placeholder="First Name" value="<?php echo (isset($address) && !empty($address->name)) ? $address->name : ""; ?>" name="address_first_name" required type="text" class="">
					</div>
				</div>
				<div class="pp-col p-padding_10 pm12">
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span> Address 1</label>
						<input placeholder="Address" value="<?php echo (isset($address) && !empty($address->address1)) ? $address->address1 : ""; ?>" required type="text" name="address_1" class="text-tran_none">
					</div>
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span> Address 2</label>
						<input placeholder="Address" value="<?php echo (isset($address) && !empty($address->address2)) ? $address->address2 : ""; ?>" name="address_2" required type="text" class="text-tran_none">
					</div>
				</div>
				<div class="pp-col p-padding_10 pm12">
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span> City</label>
						<input placeholder="City" value="<?php echo (isset($address) && !empty($address->city)) ? $address->city : ""; ?>" name="address_city" required type="text" class="">
					</div>
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span> Post Code</label>
						<input placeholder="Mobile no" value="<?php echo (isset($address) && !empty($address->post_code)) ? $address->post_code : ""; ?>" name="address_postcode" required type="text" maxlength="6" class="only-number">
					</div>
				</div>
				<div class="pp-col p-padding_10 pm12">
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span> Mobile No</label>
						<input placeholder="Mobile no" value="<?php echo (isset($address) && !empty($address->mobile_no)) ? $address->mobile_no : ""; ?>" name="address_mobileno" required type="text" class="only-number">
					</div>
				</div>
				<div class="pp-col p-padding_10 pm12">
					<div class="pp-col pp-text-field ps12 pm6 pl5">
					<label><span class="red-text">*</span> Country</label>
						<select id="country1_select" name="address_country" value="<?php echo (isset($address) && !empty($address->country)) ? $address->country : ""; ?>" class="browser-default">
							<option  value="" disabled selected>Choose your option</option>
							 <?php foreach ($countrys as $key => $value) {
	$selected = ($value->name == 'India') ? 'selected' : '';

	echo '<option id="' . $value->id . '" ' . $selected . ' value="' . strtolower($value->name) . '" >' . $value->name . '</option>';
}?>
						</select>
					</div>
					<div class="pp-col pp-text-field ps12 pm6 pl5">
					<label><span class="red-text">*</span> State</label>
						<select id="state1_select" name="address_state" value="<?php echo (isset($address) && !empty($address->state)) ? $address->state : ""; ?>" class="browser-default">
							<option value="" disabled selected>Choose your option</option>
						</select>
						<input type="hidden" name="address_id" value="<?php echo (isset($address) && !empty($address->id)) ? $address->id : "0"; ?>" class="display_none"/>
					</div>
				</div>
				<div class="pp-col center p-padding_10 ps12 pm10 pl6">
					<button type="submit" class="btn">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	$("#edit_addresss").on('submit', function(event) {
		event.preventDefault();
		var datas = $(this).serialize();
		$.post(base_url+'account/my_account_ajax/edit_address_ajax',datas , function(data, textStatus, xhr) {
			console.log(data);
			if(data.result == true){
$('#edit_addresss').find('.pp-error-text').remove();
$('#edit_addresss').find('.pp-text-field').removeClass('pp-error');
Materialize.toast('Update Successfully.', 4000);
// location.href = base_url+'account/dashboard';
}
else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#edit_addresss [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#edit_addresss [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#edit_addresss [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
		},"json");
	});
$(document).ready(function() {


get_state_by_country1();
$("#country1_select").on('change', function (event) {
	        event.preventDefault();
	        get_state_by_country1();
	    });
	function get_state_by_country1() {
	        var value = $("#country1_select").val();

	        var id = $("#country1_select option[value='" + value + "']").attr('id');
	        $.post(base_url + '/checkout/state_list', {
	            ids: id
	        }, function (data, textStatus, xhr) {

	            var html = "";
	            $.each(data, function (index, el) {
	                html += "<option value='" + el.name.toLowerCase() + "' id='" + el.id + "'>" + el.name + "</option>";
	            });
	            $("#state1_select").html(html);
	        }, "json");
	    }
	    $("#country2_select").on('change', function (event) {
	        event.preventDefault();
	        get_state_by_country2();
	    });
	    	});
</script>