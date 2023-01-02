<div class="pp-col card ps12">
	<div class="pp-col p-padding_10 ps12">
		<h6 class="title  font18">Change Password</h6>
	</div>
	<div class="pp-col ps12">
		<div class="pp-col pp-margin-tb-7 zero_padding ps12">
			<form id="change_password" class=" pp-form">
				<div class="pp-col p-padding_10 pm12">
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span>Password</label>
						<input placeholder="Password" value="" name="acc_password" required type="password" class="">
					</div>
					<div class="pp-col pp-text-field ps12 pm6 pl5">
						<label><span class="red-text">*</span>Confirm Password</label>
						<input placeholder="Confirm Password" value="" name="acc_con_password" required type="password" class="">
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
	$("#change_password").on('submit', function(event) {
		event.preventDefault();
		var datas = $(this).serialize();
		$.post(base_url+'account/my_account_ajax/change_password',datas , function(data, textStatus, xhr) {
			console.log(data);
			if(data.result == true){
$('#change_password').find('.pp-error-text').remove();
$('#change_password').find('.pp-text-field').removeClass('pp-error');
Materialize.toast('Update Successfully.', 4000);
}
else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#change_password [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#change_password [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#change_password [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
		},"json");
	});
</script>