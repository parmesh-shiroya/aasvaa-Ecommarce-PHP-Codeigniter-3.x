<div class="pp-row pp-center">
<div class="pp-col card ps12 pl5">
	<div class="pp-col p-padding_10 ps12">
		<h6 class="title  font18">Newsletter Subscription</h6>
	</div>
	<div class="pp-col ps12 ">
		<div class="pp-col pp-margin-tb-7 zero_padding ps12">
			<form id="update_newsletter" class=" pp-form">
				<div class="pp-col p-padding_10 pm12">
					<div class="pp-col pp-text-field ps12">
					<label class="font-500">Email Newsletter : </label>
						<input						       <?php echo (isset($account->newsletter) && $account->newsletter == 1) ? "checked" : ""; ?> name="newsletter" value="1" type="radio" id="yes"  />
						<label for="yes">Yes</label>
						<input name="newsletter"						                         <?php echo (isset($account->newsletter) && $account->newsletter != 1) ? "checked" : ""; ?> type="radio" value="0" id="no"  />
						<label for="no">No</label>
					</div>
					<br>
					<br>
					<div class="pp-col pp-text-field ps12">
					<label class="font-500">SMS Newsletter : </label>
						<input						       <?php echo (isset($account->sms_newsletter) && $account->sms_newsletter == 1) ? "checked" : ""; ?> name="newsletter_sms" value="1" type="radio" id="yes1"  />
						<label for="yes1">Yes</label>
						<input name="newsletter_sms"						                             <?php echo (isset($account->sms_newsletter) && $account->sms_newsletter != 1) ? "checked" : ""; ?> type="radio" value="0" id="no1"  />
						<label for="no1">No</label>
					</div>
				</div>
				<div class="pp-col center p-padding_10 ps12 pm10 pl10">
					<button type="submit" class="btn waves-effect waves-light primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<script>
	$("#update_newsletter").on('submit', function(event) {
		event.preventDefault();
		var datas = $(this).serialize();
		$.post(base_url+'account/my_account_ajax/update_newsletter',datas , function(data, textStatus, xhr) {
			if(data.result == true){
$('#update_newsletter').find('.pp-error-text').remove();
$('#update_newsletter').find('.pp-text-field').removeClass('pp-error');
Materialize.toast('Update Successfully.', 4000);
}
		},"json");
	});
</script>