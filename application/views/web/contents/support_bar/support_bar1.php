<!-- <div class="pp-container">
	<div class="pp-row ">
		<div  class="pp-col zero_padding ps12 pm12 pl4">
			<div class="card zero_margin primary-light ">
			<form id="subscribe_form" action="<?php echo site_url(); ?>" method="post">
				<div style="height:63px;" class="pp-row zero_margin valign-wrapper  pad_5">
				<div class="pp-col ps8">
				<input type="email" class="enjoy-css font-roboto grey-text text-darken-2 sub_email_input" required placeholder="Subscribe for lattest Offer">
				</div>
				<div class="pp-col center ps4">
<button class="waves-effect waves-light primary-light z-depth-2 -imp btn" type="submit" />GO</div>
				</div>
				</form>
			</div>
		</div>
		<div class="pp-col zero_padding ps12 pm12 pl4  ">
			<div class="card zero_margin ">
				<div style="height:63px;" class="pp-row pad_5 zero_margin  valign-wrapper">
				<div class="pp-col padding1 ps1"></div>
					<div class="pp-col valign-wrapper zero_padding center-align ps1">
						<i class="small valign-wrapper material-icons">stay_primary_portrait</i>
					</div>
					<div class="pp-col ps9">
						<div class="pp-col ps12">
							<span class="font-18 font-roboto_slab pink-text">Quick Support Number</span>
						</div>
						<div class="pp-col ps12">
							<span class="font-14 font-fire_sans grey-text">Call :							                                                      <?php echo (isset($mobile_no)) ? $mobile_no : ""; ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pp-col zero_padding ps12 pm12 pl4">
			<div class="card zero_margin primary-light ">
				<div style="height:63px;" class="pp-row zero_margin valign-wrapper  pad_5">
				<div class="pp-col ps1"></div>
					<div class="pp-col ps5"><span class="font-18 font-roboto_slab white-text">Follow us On. </span></div>
					<div class="pp-col ps5">
					<div class="pp-row pp-equaldist">
						<div  class="pp-col center fb share-button ps4"><a href=""><i class="fa fa-facebook white-text font18" aria-hidden="true"></i></a></div>
						<div   class="pp-col share-button go center ps4"><a href=""><i class="fa fa-google-plus white-text font18" aria-hidden="true"></i></a></div>
						<div  class="pp-col share-button pi center ps4"><a href=""><i class="fa fa-pinterest-p white-text font18" aria-hidden="true"></i></a></div>
					</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<style type="text/css">
	.enjoy-css {
  display: inline-block;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  padding: 10px 20px;
  border: 1px solid #b7b7b7;
  -webkit-border-radius: 3px;
  width: 87%;
  border-radius: 3px;
  /* font: normal 16px/normal "Times New Roman", Times, serif; */
  color: rgba(0,0,0,1);
  -o-text-overflow: clip;
  text-overflow: clip;
  background: rgba(252,252,252,1);
  -webkit-box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
  box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
  text-shadow: 1px 1px 0 rgba(255,255,255,0.66) ;
  -webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
  -moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
  -o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
  transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
}
</style>

<script>
	$(document).ready(function() {
$("#subscribe_form").on('submit', function(event) {
	event.preventDefault();
	var email_ids = $("#subscribe_form .sub_email_input").val();
	$.post(base_url+'api/web_api', {method: 'subscribe_cust',email_id:email_ids }, function(data, textStatus, xhr) {
		if (data.result == "0") {
			Materialize.toast(data.errorsdata.email_id, 4000);
			// $("#subscribe_form .sub_email_input").val("");
		}else if(data.result == "1"){
Materialize.toast('Successfully Subscribed!.', 4000);
			$("#subscribe_form .sub_email_input").val("");
		}
	},"json");
});
	});
</script> -->