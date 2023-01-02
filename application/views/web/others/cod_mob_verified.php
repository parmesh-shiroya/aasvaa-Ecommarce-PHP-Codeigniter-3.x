<div class="pp-container">
<div class="pp-row pp-center">
<div class="pp-col ps12 pm10 pl6 pxl5">
<?php if ($message == "wrong_otp") {?>
	<h6 class="font-17 wrong_otp_label center red white-text br5 lighten-1 g8ptb9 pp-margin-t-12 font-karla font-500">Typed OTP Is Wrong. Try Again.</h6>
<?php }?>
<h6 class="font-17 center amber white-text br5 g8ptb9 font-karla hidden mob_error pp-margin-t-12 font-500">Enter Valid Mobile no.</h6>
<h6 class="font-17 center mob_ar_error light-blue br5  font-karla white-text pp-margin-t-12 font-500 p-padding_tb_7 hidden ">Message Already Send.</h6>
</div>
</div>
<div class="pp-row pp-center">
<div class="pp-col ps12 pp-padres pm10 pl6 pxl5 card z-depth-0 border3-1px">
<h6 class="font-18 center font-roboto_slab primary-light-text">Customer Verification</h6>
<h6 class="g8fs13 g8mt16 pleaseprovide-text center font-karla">Please provide your Mobile Number for varification.</h6>
<h6 class="g8fs13 g8mt16 green-text success-resend g8fw500 g8ptb8 br10 center hidden font-karla">We have resend a 4 digit code(OTP) to your mobile number.</h6>
<div class="pp-col mobile_no_div pp-margin-tb-7 ps12">
<form id="mob_en_form" class="pp-form ">
<!-- <h6 class="center font15 font-500 primary-light-text ">Enter OTP For Place Order.</h6> -->
<div class="pp-col pp-padres ps12">
	<div class="pp-col pp-text-field ps12">
		<label>Enter Mobile no</label>
		<input placeholder="Mobile no" name="num_mobile" value="<?php echo (isset($_SESSION['checkout']['billing_address']['mobile_no'])) ? $_SESSION['checkout']['billing_address']['mobile_no'] : ""; ?>" maxlength="10" type="text" class="only-number">
	</div>
	<div class="pp-col pp-margin-t-12 center ps12">
	<button type="submit" disabled class="c-btnp g8plr15 primary-light send-otp-btn">Send Otp</button>
	</div>
</div>
</form>
</div>
<div class="pp-col otp_div hidden pp-margin-tb-7 ps12">
<form id="otp_en_form" method="post" action="<?php echo base_url('checkout/codverified'); ?>" class="pp-form ">
<!-- <h6 class="center font14 font-500 grey-text text-darken-3 ">OTP Send On </h6> -->
<div class="pp-col center pp-padres ps12">
	<div class="pp-col pp-text-field ps12">
		<label>Enter OTP</label>
		<input placeholder="0000" name="num_otp" maxlength="4" type="text" class="only-number center">
	</div>
	<div class="pp-col g8mt15 center ps12">
	<span type="submit" class="g8plr15 resend-link g8fs13 grey-text  font-karla">Resend OTP ( 00:30 )</span>
	</div>
	<div class="pp-col pp-margin-t-12 center ps12">
	<button type="submit" class="c-btnp g8plr15 ">Submit</button>
	</div>
</div>
</form>
</div>
</div>
</div>
</div>


<script>
	$(document).ready(function() {
$(".send-otp-btn").removeAttr('disabled');


function countdown_start(){
var counter = 30;
var interval = setInterval(function() {
    counter--;
    $(".resend-link").text('Resend OTP ( 00:'+counter+' )');
    if (counter == 0) {
        $(".resend-link").text('Resend OTP');

        $(".resend-link").addClass('resend-link-active g8fw600 pointer light-blue-text');
        $(".resend-link").removeClass('grey-text');
        clearInterval(interval);
    }
}, 1000);
}

$("#otp_en_form").on('click', '.resend-link-active', function(event) {
	event.preventDefault();
	var data = $("#mob_en_form").serialize();
	if ($('[name="num_mobile"]').val().length == 10) {
	$.post(base_url+'checkout/codverified', data, function(data, textStatus, xhr) {
console.log(data);
if (data.status == 'success') {
	$(".success-resend").removeClass('hidden');
        $(".resend-link").removeClass('resend-link-active g8fw600 pointer light-blue-text');
        $(".resend-link").addClass('grey-text');
		countdown_start();
}
	},'json');
}
});


		$(".otp_div").addClass('hidden');

	$("#mob_en_form").on('submit', function(event) {
		event.preventDefault();
		$(".mob_error").addClass('hidden');
		$(".wrong_otp_label").addClass('hidden');
		// $(".mob_alr_error").removeClass('hidden');
	var data = $(this).serialize();
	if ($('[name="num_mobile"]').val().length == 10) {
	$.post(base_url+'checkout/codverified', data, function(data, textStatus, xhr) {
console.log(data);
if (data.status == 'success') {
	$(".pleaseprovide-text").addClass('hidden');
	$(".mobile_no_div").addClass('hidden');
	$(".otp_div").removeClass('hidden');
	countdown_start();
}else if(data.status == 'wait'){
$(".mob_alr_error").removeClass('hidden');
$(".mobile_no_div").addClass('hidden');
$(".pleaseprovide-text").addClass('hidden');
$(".otp_div").removeClass('hidden');
}
	},'json');
	}else{
$(".mob_error").removeClass('hidden');
	}
	});

	});
</script>