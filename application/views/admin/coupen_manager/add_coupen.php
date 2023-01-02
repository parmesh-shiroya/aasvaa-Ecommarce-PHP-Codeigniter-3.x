<div class="pp-row">
<div class="pp-col loadder hidden  pm12">
		<div class="pp-col pm2  padding1"></div>
		<div class="pp-col pm8">
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
		</div>
		<div class="pp-col pm2"></div>
	</div>
	<div class="pp-col card p-padding_15 ps12">
		<form id="add_coupen_form" class="pp-form">
			<div class="pp-col pp-padres pm12">
				<div class="pp-col pp-text-field ps4">
					<label>Coupen Code</label>
					<input placeholder="Coupen Code" name="coup_code" required type="text" class=" ">
				</div>
				<div class="pp-col ps4">
					<label>Coupen Area</label>
					<select required name="coupen_area" class="browser-default grey-text text-darken-2">
						<option value="india">India</option>
						<option value="other_country">Other Country</option>
						<option value="all_country">All Country</option>
					</select>
				</div>
			</div>
			<div class="pp-col pp-padres pm12">
				<div class="pp-col pp-text-field ps4">
					<label>Valid from:</label>
					<input type="date" name="coupen_valid_from" required class="datepicker">
				</div>
				<div class="pp-col pp-text-field ps4">
					<label>Valid to:</label>
					<input type="date" name="coupen_valid_to" required class="datepicker">
				</div>
			</div>
			<div class="pp-col pp-padres pm12">
				<div class="pp-col pp-text-field ps4">
					<label>Use Coupen For</label>
					<input placeholder="5 time" name="coupen_use_for" required type="text" class="only-number">
				</div>
				<div class="pp-col pp-text-field ps4">
					<label>Minimum Rs Condition:</label>
					<input placeholder="2500" name="coupen_minimum_mrp" required type="text" class="only-number">
				</div>
			</div>
			<div class="pp-col pp-padres pm12">
				<div class="pp-col ps4">
					<label>Discount Type</label>
					<select required name="coupen_discount_type" class="browser-default grey-text text-darken-2">
						<option value="0">Rs Discount</option>
						<option value="1">Percentage</option>
					</select>
				</div>
				<div class="pp-col pp-text-field ps4">
					<label>Discount (Rs/%)</label>
					<input placeholder="50" name="discount_rs" required type="text" class="only-number">
				</div>
			</div>
			<div class="pp-col pp-padres pm6">
						<div class="pp-col pm4  padding1"></div>
						<button class="btn waves-effect pp-col pm3 waves-light add_product_submit" type="submit" name="add_product_submit">Submit
						</button>
						<div class="pp-col pm4  padding1"></div>
					</div>
		</form>
	</div>
</div>
<script>
	$('.datepicker').pickadate({
selectMonths: true, // Creates a dropdown to control month
  min: new Date(),
    format:'dd-mm-yyyy',
selectYears: 2 // Creates a dropdown of 15 years to control year
});

	$("#add_coupen_form").on('submit', function(event) {
event.preventDefault();
$(".loadder").removeClass('hidden');
var datas= $(this).serialize();
$.post(base_url+'admin/coupman/addcoupen/add',  datas  , function(data, textStatus, xhr) {
	$(".loadder").addClass('hidden');
if(data.result == true){
	Materialize.toast('Coupen Add Successfully.', 4000);
	  // $('#add_coupen_form').reset();
$('#add_coupen_form').find('.pp-error-text').remove();
$('#add_coupen_form').find('.pp-text-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
    $('#add_coupen_form').find("input[type]").val("");
}else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#add_coupen_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#add_coupen_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#add_coupen_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');
});
</script>