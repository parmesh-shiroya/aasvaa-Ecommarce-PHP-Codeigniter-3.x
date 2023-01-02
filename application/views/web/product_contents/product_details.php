<div class="pp-container">
	<div class="pp-row">
		<div class="pp-col ps12">
			<ul class="tabs pp-tabs z-depth-1" >
				<li class="tab pp-col ps12 pm3"><a class="active" href="#product_details" >Product Details</a></li>
				<li class="tab pp-col ps12 pm3"><a href="#know_your_product">Know Your Products</a></li>
				<li class="tab pp-col ps12 pm3"><a href="#product_faq">Product FAQ</a></li>
				<li class="tab pp-col ps12 pm3"><a href="#review">Review</a></li>
			</ul>
		</div>
		<div id="product_details" class="pp-col ps12">
			<div class="pp-col ps12 p-padding_15 zero_margin card">
				<table class="table-default pp-col ps12 pm12 pl6">
					<tbody class="prod-details">
						<?php
$product_detail = unserialize($product_data->product_details);
foreach ($product_detail as $key => $value) {
	if (!empty($value['value'])) {?>
	<tr>
		<td ><b><?php echo $value['key']; ?></b></td>
		<td class="font-capitalize">:		                              <?php $lasteelement = end($value['value']);foreach ($value['value'] as $keys => $values) {echo $values;if ($values != $lasteelement) {echo ', ';}}?></td>
	</tr>
<?php }}?>
</tbody>
				</table>
			</div>
		</div>
		<div id="know_your_product" class="pp-col ps12">
			<div class="pp-col ps12 font13 p-padding_15 zero_margin card">
				<pre><?php echo $product_data->know_product; ?></pre>
			</div>
		</div>
		<div id="product_faq" class="pp-col ps12">
			<div class="pp-col ps12 font13 p-padding_15 zero_margin card">
				<pre><?php echo $product_data->product_faq; ?></pre>
			</div>
		</div>
		<div id="review" class="pp-col ps12">
			<div class="pp-col ps12 p-padding_15 zero_margin card">
				<form id="product_review_forms" class="pp-form">
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12 pm6">
							<label class="active">Name</label>
							<input placeholder="Name" name="review_name" required="" class=" review_name" type="text">
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
						<button class="btn primary waves-effect pp-col ps8 pm2 waves-light add_product_submit" type="submit" name="add_product_submit">Submit

						</button>

					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
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
			console.log(data);
			if (data == '1') {
Materialize.toast('Thanks For Your Review.', 3000);
$("#product_review_forms .review_name").val("");
$("#product_review_forms .review_review").val("");
			}

			if(data == 'login'){

				Lobibox.notify('default', {
			title:false,
			size: 'mini',
			rounded: false,
position: 'center top',

    continueDelayOnInactiveTab: false,
    msg: 'Please Login First.'
});
			}
		});
	});
	});
	</script>
