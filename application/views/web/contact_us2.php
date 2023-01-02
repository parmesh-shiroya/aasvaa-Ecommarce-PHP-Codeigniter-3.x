<div class="contact_main_div">
<div class="c-container">
<div class="c-row gmf  c-center">
<div class="grid g524 g8p18 gpf white border3-1px g8mtb10 g712 g811">
<h6 class="g8fs18  g8fw600 center font-open_sans cp">CONTACT US</h6>
<div class="grid g8p15 g524 g724">
<form id="contact_us_form" class="pp-form">
	<div class="pp-text-field g8ptb10">
<label>Name</label>
<input required type="text" name="con_name" placeholder="Name">
	</div>
	<div class="pp-text-field g8ptb10">
<label>Email</label>
<input required type="text" class="text-tran_none" name="con_email" placeholder="Email">
	</div>
	<div class="pp-text-field g8ptb10">
<label>Mobile No</label>
<input required type="text" class="text-tran_none only-number" name="con_mobile" placeholder="Mobile No">
	</div>
	<div class="pp-text-field g8ptb10">
<label>Subject</label>
  <select name="subject" class="browser-default">
    <option value="0">Product Enquiry</option>
    <option value="1">Order Enquiry</option>
    <option value="2">General Enquiry</option>
    <option value="3">Enquiry for Custom made product</option>
    <option value="4">Wholesale Enquiry</option>
    <option value="5">Suggestions &amp; feedbacks</option>
    <option value="6">Others</option>
  </select>
	</div>
	<div class="pp-text-field g8ptb10">
<label>Description</label>
<textarea required rows="4" name="description" placeholder="Description"></textarea>
	</div>
	<div class="center">
<button type="submit" class="c-btna g8plr24">Submit</button>
<button type="reset"  class="c-btna g8plr28">Reset</button>
	</div>
</form>
</div>
</div>
<div id="map-div" class="grid g8p18 g524 gpf white border3-1px g8mtb10 g712 g811">

</div>
</div>
</div>
</div>
<style>
.contact_main_div{
	/* background: rgba(0, 0, 0, 0) linear-gradient(9deg, rgba(0, 0, 0, 0) 50%, rgba(0,0,0,0.71) 50%) repeat scroll 0 0; */
}
#map-div{
	min-height: 250px;
}
</style>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9DFfT4BqK8JGYJciYAh3_-S-S7GoKbbQ&callback=initMap">
    </script>
<script>
function initMap() {
        var uluru = {lat: 21.224722, lng: 72.844908};
        var map = new google.maps.Map(document.getElementById('map-div'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }

	$(document).ready(function() {

function reset_form(){
	$('#contact_us_form').find('.pp-error-text').remove();
$('#contact_us_form').find('.pp-text-field input[type="text"]').val("");
$('#contact_us_form').find('.pp-text-field').removeClass('pp-error');
}


		$("#contact_us_form").on('submit', function(event) {
		event.preventDefault();
		var datas = $(this).serialize();
		$.post(base_url+'contact_us/send_message',datas , function(data, textStatus, xhr) {
			console.log(data);
			if(data.result == true){
reset_form();
Lobibox.notify('default', {
			title:false,
			size: 'mini',
			rounded: false,
position: 'center top',

    continueDelayOnInactiveTab: false,
    msg: 'Message Recived Successfully. We Send You Replay In Your E-Mail.'
});
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