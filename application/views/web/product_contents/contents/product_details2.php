
	<div class="pp-row zero_margin">
		<div class="pp-col zero_padding ps12">
			<ul class="tabs detail-tabs radius-0 pp-tabs z-depth-0  border2-ltr-1px transparent border2-1px" >
				<li class="tab pp-col ps6 pm3"><a class="font14 text-tran_none active" href="#product_details" >Product Details</a></li>
				<li class="tab pp-col ps6 pm3"><a class="font14 text-tran_none" href="#know_your_product">Know Your Products</a></li>
				<li class="tab pp-col ps6 pm3"><a class="font14 text-tran_none"  href="#review">Review</a></li>
				<li class="tab pp-col ps6 pm3"><a  class="font14 text-tran_none" href="#product_faq">Product FAQ</a></li>

			</ul>
		</div>
		<div id="product_details" class="pp-col zero_padding ps12">
			<div class="pp-col ps12 radius-0 transparent p-padding_15 zero_margin z-depth-0 border2-1px card">
				<table class="table-default  font14 pp-col ps12 pm12 pl6">
					<tbody class="prod-details">
						<?php
$product_detail = unserialize($product_data->product_details);
foreach ($product_detail as $key => $value) {
	if (!empty($value['value'])) {?>
	<tr>
		<td class="grey-text-new font-400" ><?php echo $value['key']; ?></b></td>
		<td class="font-capitalize letter-space-1px black-text">:		                                                          <?php $lasteelement = end($value['value']);foreach ($value['value'] as $keys => $values) {echo $values;if ($values != $lasteelement) {echo ', ';}}?></td>
	</tr>
<?php }}?>
</tbody>
				</table>
			</div>
		</div>
		<div id="know_your_product" class="pp-col zero_padding ps12">
			<div class="pp-col ps12 radius-0 transparent p-padding_15 zero_margin z-depth-0 border2-1px card">
				<pre><?php echo $product_data->know_product; ?></pre>
			</div>
		</div>
		<div id="product_faq" class="pp-col zero_padding ps12">
			<div class="pp-col ps12 radius-0 transparent p-padding_15 zero_margin z-depth-0 border2-1px card">
				<pre><?php echo $product_data->product_faq; ?></pre>
			</div>
		</div>
		<div id="review" class="pp-col zero_padding ps12">
			<div class="pp-col ps12 radius-0 transparent p-padding_15 zero_margin z-depth-0 border2-1px card">
				<form id="product_review_forms" class="pp-form">
					<div class="pp-col pp-padres pm12">
						<div class="pp-col ps12 pm6">
<div class="stars grid">

    <input class="star star-5" value="5" id="star-5" type="radio" name="star"/>
    <label class="star star-5" for="star-5"></label>
    <input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
    <label class="star star-1" for="star-1"></label>

</div>
						</div>
						<input placeholder="Name" name="product_id" value="<?php echo $product_data->product_id; ?>" class="display_none" type="hidden">
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col  pp-text-field ps12 pm8">
							<label class="active">Review</label>
							<textarea placeholder="Review" name="review_review" type="text" required="" rows="4" class="review_review"></textarea>
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pm2  padding1"></div>
						<button class="c-btna waves-effect pp-col ps8 pm2 waves-light add_product_submit" type="submit" name="add_product_submit">Submit

						</button>

					</div>
					</form>
				</div>
			</div>
		</div>
<style>
.detail-tabs li{
	height: 37px !important;
}
.detail-tabs li a{
position: relative;
top: -6px;
	color: #212121  !important;
}
.detail-tabs li a.active{
	font-weight: 500 !important;
	color: #b0314f !important;
}
.indicator{
	background-color: #b0314f !important;
}
div.stars {
  /* width: 200px; */
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 13px !important;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}
label.star:after {
	content: none;
  float: right;
  padding: 10px !important;
  font-size: 36px;
  color: #444;
  transition: all .2s;
  border: none !important;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #F57C00;
  font-size: 20px;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #F57C00;
  /* text-shadow: 0 0 20px #952; */
  border: none !important;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-size: 20px;
  font-family: FontAwesome;
  border: none !important;
}
</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$('ul.tabs').tabs('select_tab', 'product_details');
	// $(".pp-tabs").on('click', 'li>a', function(event) {
				// 	event.preventDefault();
				// 	var div_class = $($(this).parent('.pp-tabs')).attr('pp-tab-div');
				// 	;
				// 	$("."+div_class).css('display', 'none');
	// $("."+div_class+$(this).attr('href')).css('display', 'block');
	// });
	$("#product_review_forms").on('submit', function(event) {
		event.preventDefault();
		var datas = $(this).serialize();
		$.post(base_url+'api/web_api/product_review', datas, function(data, textStatus, xhr) {
			if (data == '1') {
		Lobibox.notify('default', {
			title:false,
			size: 'mini',
			rounded: false,
position: 'center top',

    continueDelayOnInactiveTab: true,
    msg: 'Thanks For Your Review.'
});

$("#product_review_forms .review_name").val("");
$("#product_review_forms .review_review").val("");
			}
			if(data == 'login'){
				Lobibox.notify('default', {
			title:false,
			size: 'mini',
			rounded: false,
position: 'center top',

    continueDelayOnInactiveTab: true,
    msg: 'Please Login First.'
});
			}
		});
	});
	});
	</script>
