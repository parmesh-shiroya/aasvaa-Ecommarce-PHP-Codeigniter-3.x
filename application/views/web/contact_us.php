<div class="contact_main_div">
	<div class="pp-container">
		<div class="pp-row pp-center">
			<div class="pp-col pm12 hoverable  primary-light pl10 zero_padding card">
				<div class="pp-col  white-text  ps12 pl4">
					<div class="pp-col ps12">
						<br>
						<div class="pp-col ps12 center pp-margin-tb-4 white-text font24 "><span>Contact Us</span></div><br><br>
						<div class="divider"></div>
						<br>  <div class="pp-col ps12 center pp-margin-tb-7 font-overlock   font22 "><span>AASVAA</span></div>
						<br>  <div class="pp-col ps12 pp-margin-tb-7 font-raleway opacity8   "><span><span class="font-600">Shop no:</span>						                                                                                                                    <?php echo (isset($shop_add)) ? $shop_add : ""; ?></span></div><br><br>
						<br>  <div class="pp-col ps12 font-raleway opacity8   "><span><span class="font-600">Phone no:</span>						                                                                                                      <?php echo (isset($mobile_no)) ? $mobile_no : ""; ?></span></div>
						<br>  <div class="pp-col ps12 pp-margin-tb-7 font-raleway opacity8   "><span><span class="font-600">Email Id:</span>						                                                                                                                     <?php echo (isset($customer_support_email)) ? $customer_support_email : ""; ?></span></div>
					</div>
				</div>
				<div class="pp-col white ps12 pl8">
					<form id="contact_us_form" class="pp-form">
<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Name</label>
							<input placeholder="Name" name="con_name" required type="text" class=" ">
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Phone</label>
							<input placeholder="Phone" name="con_phone" required type="text" class="only-number">
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Email</label>
							<input placeholder="Email" name="con_email" required type="text" class="text-tran_none">
						</div>
					</div>
						<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Description</label>
							<textarea placeholder="Description" rows="5" required name="con_message" type="text" class=""></textarea>
						</div>
					</div>
					<div class="pp-col  pp-padres center ps12">
<button class="btn waves-effect primary-light waves-light add_product_submit" type="submit" name="add_product_submit">Send Message
						<i class="material-icons right">send</i>
						</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.contact_main_div{
	background: rgba(0, 0, 0, 0) linear-gradient(9deg, rgba(0, 0, 0, 0) 50%, rgba(0,0,0,0.71) 50%) repeat scroll 0 0;
}
</style>

<script>
	$(document).ready(function() {
		$("#contact_us_form").on('submit', function(event) {
		event.preventDefault();
		var datas = $(this).serialize();
		$.post(base_url+'contact_us/send_message',datas , function(data, textStatus, xhr) {
			console.log(data);
			if(data.result == true){
$('#contact_us_form').find('.pp-error-text').remove();
$('#contact_us_form').find('.pp-text-field').removeClass('pp-error');
Materialize.toast('Message Send Successfully.', 4000);
// location.href = base_url+'account/dashboard';
}
else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#contact_us_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#contact_us_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#contact_us_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
		},"json");
	});
	});
</script>