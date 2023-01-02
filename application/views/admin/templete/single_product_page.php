<div class="pp-row pp-equalspace">
<div class="pp-col card product_slidet_setting pp-padres ps505">
		<h6 class="title p-padding_tb_7 center font18">Product Slider 1</h6>
		<div class="pp-col ps12">
			<form class="pp-form pp-margin-t-12" id="slider_setting_form" action="" method="post" accept-charset="utf-8">
			<input type="hidden" name="key" value="sin_pro_page_slider1" class="hidden">
				<div class="pp-col pp-text-field pm9 ps12 pl9 pxl9">
					<label>Max Product Show : </label>
					<input placeholder="15" value="<?php echo $slider_1['max']; ?>" require class="only-number" name="max_product"  type="text">
				</div>
				<div class="pp-col p-padding_tb_7 pp-text-field ps12">
					<div class="pp-col pm9 ps12 pl9 pxl9 zero_padding">
						<label>Show (?) Product : </label>
						<select name="show_product" class="browser-default show_product_select grey-text text-darken-2">
							<option							        <?php echo ($slider_1['show_product_by'] == 'random') ? 'selected' : ""; ?> value="random" selected>Random</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'similar_product') ? 'selected' : ""; ?> value="similar_product">Similar Product</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'intrested_in') ? 'selected' : ""; ?> value="intrested_in">Interested In</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'new_product') ? 'selected' : ""; ?> value="new_product">New Product</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'old_product') ? 'selected' : ""; ?> value="old_product">Old Product (First Insert)</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'most_viewed') ? 'selected' : ""; ?> value="most_viewed">Most Viewed</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'most_sell') ? 'selected' : ""; ?> value="most_sell">Most Sell</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'low_price') ? 'selected' : ""; ?> value="low_price">Low Price</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'high_price') ? 'selected' : ""; ?> value="high_price">High  Price</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'ready_to_ship') ? 'selected' : ""; ?> value="ready_to_ship">Ready To Ship</option>
							<option							        <?php echo ($slider_1['show_product_by'] == 'catalogue') ? 'selected' : ""; ?> value="catalogue">Catalogue</option>
						</select>
					</div>
					<div class="pp-col catalog_div					                               <?php echo ($slider_1['show_product_by'] == 'catalogue') ? '' : 'hidden'; ?> ?> pm9 zero_padding pp-margin-t-7 ps12 pl9 pxl9">
						<label>Catalogue Name : </label>
						<input placeholder="Name" value="<?php echo (isset($slider_1['catalogue'])) ? $slider_1['catalogue'] : ''; ?>" class="catalogue_name" name="catalogue_name"  type="text">
					</div>
				</div>
				<div class="pp-col pp-padres ps9 center">
					<button name="message_update" value="Submit" type="submit" class="btn primary-light">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<div class="pp-col card product_slidet_setting pp-padres ps505">
		<h6 class="title p-padding_tb_7 center font18">Product Slider 2</h6>
		<div class="pp-col ps12">
			<form class="pp-form pp-margin-t-12" id="slider_setting_form2" action="" method="post" accept-charset="utf-8">
			<input type="hidden" name="key" value="sin_pro_page_slider2" class="hidden">
				<div class="pp-col pp-text-field pm9 ps12 pl9 pxl9">
					<label>Max Product Show : </label>
					<input placeholder="15" value="<?php echo $slider_2['max']; ?>" require class="only-number" name="max_product"  type="text">
				</div>
				<div class="pp-col p-padding_tb_7 pp-text-field ps12">
					<div class="pp-col pm9 ps12 pl9 pxl9 zero_padding">
						<label>Show (?) Product : </label>
						<select name="show_product" class="browser-default show_product_select grey-text text-darken-2">

							<option							        <?php echo ($slider_2['show_product_by'] == 'random') ? 'selected' : ""; ?> value="random" selected>Random</option>
							<option							        <?php echo ($slider_2['show_product_by'] == 'similar_product') ? 'selected' : ""; ?> value="similar_product">Similar Product</option>
							<option							        <?php echo ($slider_2['show_product_by'] == 'intrested_in') ? 'selected' : ""; ?> value="intrested_in">Interested In</option>
							<option							        <?php echo ($slider_2['show_product_by'] == 'new_product') ? 'selected' : ""; ?> value="new_product">New Product</option>
							<option							        <?php echo ($slider_2['show_product_by'] == 'old_product') ? 'selected' : ""; ?> value="old_product">Old Product (First Insert)</option>
							<option							        <?php echo ($slider_2['show_product_by'] == 'most_viewed') ? 'selected' : ""; ?> value="most_viewed">Most Viewed</option>
							<option							        <?php echo ($slider_2['show_product_by'] == 'most_sell') ? 'selected' : ""; ?> value="most_sell">Most Sell</option>
							<option							        <?php echo ($slider_2['show_product_by'] == 'low_price') ? 'selected' : ""; ?> value="low_price">Low Price</option>
							<option							        <?php echo ($slider_2['show_product_by'] == 'high_price') ? 'selected' : ""; ?> value="high_price">High  Price</option>

							<option							        <?php echo ($slider_2['show_product_by'] == 'ready_to_ship') ? 'selected' : ""; ?> value="ready_to_ship">Ready To Ship</option>
							<option							        <?php echo ($slider_2['show_product_by'] == 'catalogue') ? 'selected' : ""; ?> value="catalogue">Catalogue</option>

						</select>
					</div>
					<div class="pp-col catalog_div					                               <?php echo ($slider_2['show_product_by'] == 'catalogue') ? '' : 'hidden'; ?> ?> pm9 zero_padding pp-margin-t-7 ps12 pl9 pxl9">
						<label>Catalogue Name : </label>
						<input placeholder="Name" value="<?php echo (isset($slider_2['catalogue'])) ? $slider_2['catalogue'] : ''; ?>" class="catalogue_name" name="catalogue_name"  type="text">
					</div>
				</div>
				<div class="pp-col pp-padres ps9 center">
					<button name="message_update" value="Submit" type="submit" class="btn primary-light">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
	$("#slider_setting_form,#slider_setting_form2").on('submit', function(event) {
			event.preventDefault();
			var data = $(this).serialize();
			$.post(base_url+'admin/theme/single_product_page/update_slider', data, function(data, textStatus, xhr) {
				console.log(data);
				if(data.result == true){
					Materialize.toast("Data Update.",4000);
				}
			},'json');
		});


	$("#slider_setting_form .show_product_select").on('change', function(event) {
			event.preventDefault();

			if($(this).val() == 'catalogue'){
$("#slider_setting_form  .catalog_div").removeClass('hidden');
$("#slider_setting_form  .catalog_div .catalogue_name").attr('required', 'required');
			}else{
				$("#slider_setting_form  .catalog_div").addClass('hidden');
				$("#slider_setting_form  .catalog_div .catalogue_name").removeAttr('required');
			}
		});
$("#slider_setting_form2 .show_product_select").on('change', function(event) {
			event.preventDefault();
			if($(this).val() == 'catalogue'){
$("#slider_setting_form2  .catalog_div").removeClass('hidden');
$("#slider_setting_form2  .catalog_div .catalogue_name").attr('required', 'required');
			}else{
				$("#slider_setting_form2  .catalog_div").addClass('hidden');
				$("#slider_setting_form2  .catalog_div .catalogue_name").removeAttr('required');
			}
		});


	});
</script>