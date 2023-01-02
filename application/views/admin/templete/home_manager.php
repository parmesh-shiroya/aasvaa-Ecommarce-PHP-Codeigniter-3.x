
<div class="pp-row pp-equalspace">
	<div class="pp-col card z-depth-0 border3-1px pp-padres ps12">
		<h6 class="title p-padding_tb_7 center font18">Messages</h6>
		<div class="pp-col ps12">
			<form class="pp-form pp-margin-t-12" id="message_form" action="" method="post" accept-charset="utf-8">
				<div class="pp-col pp-text-field ps12">
					<label>Top Message</label>
					<input placeholder="Any Message" value="<?php echo $top_message_1['message']; ?>" name="top_message_1"  type="text" class=" ">
				</div>
				<div class="pp-col pp-text-field ps3">
					<label>Title</label>
					<input placeholder="Title" value="<?php echo $message_1['title']; ?>" name="message_title_1"  type="text" class=" ">
				</div>
				<div class="pp-col pp-text-field ps7">
					<label>Message</label>
					<input placeholder="Any Message" value="<?php echo $message_1['message']; ?>" name="message_1"  type="text" class=" ">
				</div>
				<div class="pp-col pp-text-field ps3">
					<label>Title</label>
					<input placeholder="Title" value="<?php echo $message_2['title']; ?>" name="message_title_2"  type="text" class=" ">
				</div>
				<div class="pp-col pp-text-field ps7">
					<label>Message</label>
					<input placeholder="Message" value="<?php echo $message_2['message']; ?>" name="message_2"  type="text" class=" ">
				</div>
				<div class="pp-col pp-padres ps5 center">
					<button name="message_update" value="Submit" type="submit" class="btn primary-light">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<div class="pp-col card  z-depth-0 border3-1px  product_slidet_setting pp-padres ps5">
		<h6 class="title p-padding_tb_7 center font18">Product Slider 1 Setting</h6>
		<div class="pp-col ps12">
			<form class="pp-form pp-margin-t-12" id="slider_setting_form" action="" method="post" accept-charset="utf-8">
				<div class="pp-col pp-text-field pm6 ps12 pl10 pxl10">
					<label>Max Product Show : </label>
					<input placeholder="15" value="<?php echo $home_product_slider['max']; ?>" require class="only-number" name="max_product"  type="text">
				</div>
				<div class="pp-col p-padding_tb_7 pp-text-field ps12">
					<div class="pp-col pm6 ps12 pl6 pxl6 zero_padding">
						<label>Show (?) Product : </label>
						<select name="show_product" class="browser-default show_product_select grey-text text-darken-2">
							<option							        <?php echo ($home_product_slider['show_product_by'] == 'random') ? 'selected' : ""; ?> value="random" selected>Random</option>
							<option							        <?php echo ($home_product_slider['show_product_by'] == 'new_product') ? 'selected' : ""; ?> value="new_product">New Product</option>
							<option							        <?php echo ($home_product_slider['show_product_by'] == 'old_product') ? 'selected' : ""; ?> value="old_product">Old Product (First Insert)</option>
							<option							        <?php echo ($home_product_slider['show_product_by'] == 'most_viewed') ? 'selected' : ""; ?> value="most_viewed">Most Viewed</option>
							<option							        <?php echo ($home_product_slider['show_product_by'] == 'most_sell') ? 'selected' : ""; ?> value="most_sell">Most Sell</option>
							<option							        <?php echo ($home_product_slider['show_product_by'] == 'low_price') ? 'selected' : ""; ?> value="low_price">Low Price</option>
							<option							        <?php echo ($home_product_slider['show_product_by'] == 'high_price') ? 'selected' : ""; ?> value="high_price">High  Price</option>
							<option							        <?php echo ($home_product_slider['show_product_by'] == 'ready_to_ship') ? 'selected' : ""; ?> value="ready_to_ship">Ready To Ship</option>
							<option							        <?php echo ($home_product_slider['show_product_by'] == 'catalogue') ? 'selected' : ""; ?> value="catalogue">Catalogue</option>
						</select>
					</div>
					<div class="pp-col catalog_div					                               <?php echo ($home_product_slider['show_product_by'] == 'catalogue') ? '' : 'hidden'; ?> ?> pm6 ps12 pl6 pxl6">
						<label>Catalogue Name : </label>
						<input placeholder="Name" value="<?php echo (isset($home_product_slider['catalogue'])) ? $home_product_slider['catalogue'] : ''; ?>" class="catalogue_name" name="catalogue_name"  type="text">
					</div>
				</div>
				<div class="pp-col pp-padres ps12 center">
					<button name="message_update" value="Submit" type="submit" class="btn primary-light">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<div class="pp-col card  z-depth-0 border3-1px  product_slidet_setting pp-padres ps5">
		<h6 class="title p-padding_tb_7 center font18">Product Slider 2 Setting</h6>
		<div class="pp-col ps12">
			<form class="pp-form pp-margin-t-12" id="slider_setting_form2" action="" method="post" accept-charset="utf-8">
				<div class="pp-col pp-text-field pm6 ps12 pl10 pxl10">
					<label>Max Product Show : </label>
					<input placeholder="15" value="<?php echo $home_product_slider2['max']; ?>" require class="only-number" name="max_product"  type="text">
				</div>
				<div class="pp-col p-padding_tb_7 pp-text-field ps12">
					<div class="pp-col pm6 ps12 pl6 pxl6 zero_padding">
						<label>Show (?) Product : </label>
						<select name="show_product" class="browser-default show_product_select grey-text text-darken-2">
							<option							        <?php echo ($home_product_slider2['show_product_by'] == 'random') ? 'selected' : ""; ?> value="random" selected>Random</option>
							<option							        <?php echo ($home_product_slider2['show_product_by'] == 'new_product') ? 'selected' : ""; ?> value="new_product">New Product</option>
							<option							        <?php echo ($home_product_slider2['show_product_by'] == 'old_product') ? 'selected' : ""; ?> value="old_product">Old Product (First Insert)</option>
							<option							        <?php echo ($home_product_slider2['show_product_by'] == 'most_viewed') ? 'selected' : ""; ?> value="most_viewed">Most Viewed</option>
							<option							        <?php echo ($home_product_slider2['show_product_by'] == 'most_sell') ? 'selected' : ""; ?> value="most_sell">Most Sell</option>
							<option							        <?php echo ($home_product_slider2['show_product_by'] == 'low_price') ? 'selected' : ""; ?> value="low_price">Low Price</option>
							<option							        <?php echo ($home_product_slider2['show_product_by'] == 'high_price') ? 'selected' : ""; ?> value="high_price">High  Price</option>
							<option							        <?php echo ($home_product_slider2['show_product_by'] == 'ready_to_ship') ? 'selected' : ""; ?> value="ready_to_ship">Ready To Ship</option>
							<option							        <?php echo ($home_product_slider2['show_product_by'] == 'catalogue') ? 'selected' : ""; ?> value="catalogue">Catalogue</option>
						</select>
					</div>
					<div class="pp-col catalog_div					                               <?php echo ($home_product_slider2['show_product_by'] == 'catalogue') ? '' : 'hidden'; ?> ?> pm6 ps12 pl6 pxl6">
						<label>Catalogue Name : </label>
						<input placeholder="Name" value="<?php echo (isset($home_product_slider2['catalogue'])) ? $home_product_slider2['catalogue'] : ''; ?>" class="catalogue_name" name="catalogue_name"  type="text">
					</div>
				</div>
				<div class="pp-col pp-padres ps12 center">
					<button name="message_update" value="Submit" type="submit" class="btn primary-light">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<div class="pp-col card other_prod_setting  z-depth-0 border3-1px  pp-padres ps5">
		<h6 class="title p-padding_tb_7 center font18">Other Product Setting</h6>
		<div class="pp-col ps12">
			<form class="pp-form pp-margin-t-12" id="other_product_setting" action="" method="post" accept-charset="utf-8">
				<div class="pp-col pp-text-field pm6 ps12 pl10 pxl10">
					<label>Max Product Show : </label>
					<input placeholder="15" value="<?php echo $home_other_product['max']; ?>" require class="only-number" name="max_product"  type="text">
				</div>
				<div class="pp-col p-padding_tb_7 pp-text-field ps12">
					<div class="pp-col pm6 ps12 pl6 pxl6 zero_padding">
						<label>Show (?) Product : </label>
						<select name="show_product" class="browser-default show_product_select grey-text text-darken-2">
							<option							        <?php echo ($home_other_product['show_product_by'] == 'random') ? 'selected' : ""; ?> value="random" selected>Random</option>
							<option							        <?php echo ($home_other_product['show_product_by'] == 'new_product') ? 'selected' : ""; ?> value="new_product">New Product</option>
							<option							        <?php echo ($home_other_product['show_product_by'] == 'old_product') ? 'selected' : ""; ?> value="old_product">Old Product (First Insert)</option>
							<option							        <?php echo ($home_other_product['show_product_by'] == 'most_viewed') ? 'selected' : ""; ?> value="most_viewed">Most Viewed</option>
							<option							        <?php echo ($home_other_product['show_product_by'] == 'most_sell') ? 'selected' : ""; ?> value="most_sell">Most Sell</option>
							<option							        <?php echo ($home_other_product['show_product_by'] == 'low_price') ? 'selected' : ""; ?> value="low_price">Low Price</option>
							<option							        <?php echo ($home_other_product['show_product_by'] == 'high_price') ? 'selected' : ""; ?> value="high_price">High  Price</option>
							<option							        <?php echo ($home_other_product['show_product_by'] == 'ready_to_ship') ? 'selected' : ""; ?> value="ready_to_ship">Ready To Ship</option>
							<option							        <?php echo ($home_other_product['show_product_by'] == 'catalogue') ? 'selected' : ""; ?> value="catalogue">Catalogue</option>
						</select>
					</div>
					<div class="pp-col catalog_div					                               <?php echo ($home_other_product['show_product_by'] == 'catalogue') ? '' : 'hidden'; ?> ?> pm6 ps12 pl6 pxl6">
						<label>Catalogue Name : </label>
						<input placeholder="Name" value="<?php echo (isset($home_other_product['catalogue'])) ? $home_other_product['catalogue'] : ''; ?>" class="catalogue_name" name="catalogue_name"  type="text">
					</div>
				</div>
				<div class="pp-col pp-padres ps12 center">
					<button name="message_update" value="Submit" type="submit" class="btn primary-light">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<div class="pp-col card z-depth-0 border3-1px pp-padres ps12">
		<h6 class="title p-padding_tb_7 center font18">Service Message</h6>
		<div class="pp-col zero_padding ps12">
			<form class="pp-form  pp-row pp-center"  action="<?php echo base_url('admin/theme/home_manager/update_service_message'); ?>" enctype="multipart/form-data" method="post">
			<?php for ($i = 0; $i < 4; $i++) {
	$plus = $i + 1;
	?>
				<div class="pp-col pp-margin-t-12 pl5 pxl5">
					<h6 class="center grey-text-new font14 font-500">Message					                                                         <?php echo $i + 1; ?></h6>
					<div class="pp-col zero_padding ps12 center">
<img width="50" src="<?php echo base_url('uploads/banner/service_message/120_120/' . ${'service_message' . $plus}['img']); ?>">
					</div>
					<div class="file-field input-field">
						<div class="btn accent_color opacity8">
							<span>Select</span>
							<input type="file" class="image_file_button" name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<input class="file-path validate"  type="text" placeholder="Resolution: 130*130">
						</div>
					</div>
					<div class="pp-text-field">
						<input placeholder="Title" value="<?php echo ${'service_message' . $plus}['title']; ?>" name="title_<?php echo $i; ?>"  type="text">
					</div>
					<div class="pp-text-field">
						<textarea  placeholder="Message" value=""  name="message_<?php echo $i; ?>"  type="text"><?php echo ${'service_message' . $plus}['message']; ?></textarea>
					</div>
				</div>
			<?php }?>
			<div class="pp-col pp-margin-t-12 valign-wrapper center ps12">
			<div class="pp-text-field pp-col ps2">
  <p>
      <input type="checkbox" class="filled-in"                                               <?php echo (!empty($service_color['in_container'])) ? "checked" : ""; ?>  name="in_container" id="filled-in-box" />
      <label for="filled-in-box">In Container</label>
    </p>
			</div>
<div class="pp-text-field pp-col ps3">
<label>Background Color</label>
						<input placeholder="#fff" value="<?php echo $service_color['bg']; ?>" name="service_bg" class="text-tran_none" type="text">
					</div>
					<div class="pp-text-field pp-col ps3">
					<label>Title Color</label>
						<input placeholder="#000" value="<?php echo $service_color['title']; ?>" class="text-tran_none" name="service_title"  type="text">
					</div>
					<div class="pp-text-field pp-col ps3">
					<label>Message Color</label>
						<input placeholder="#999" value="<?php echo $service_color['message']; ?>" class="text-tran_none" name="service_message"  type="text">
					</div>
			</div>
<div class="pp-col pp-margin-t-20 center ps12">
<button type="submit" class="btn primary-light" name="update_service_message" value="data">Submit</button>
</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("#message_form").on('submit', function(event) {
			event.preventDefault();
			var data= $(this).serialize();
			$.post(base_url+'admin/theme/home_manager/update_message', data, function(data, textStatus, xhr) {
				console.log(data);
				if(data.result == true){
					Materialize.toast("Message Update.",4000);
				}
			},'json');
		});
		$("#slider_setting_form").on('submit', function(event) {
			event.preventDefault();
			var data = $(this).serialize();
			$.post(base_url+'admin/theme/home_manager/update_slider', data, function(data, textStatus, xhr) {
				console.log(data);
				if(data.result == true){
					Materialize.toast("Data Update.",4000);
				}
			},'json');
		});
		$("#slider_setting_form2").on('submit', function(event) {
			event.preventDefault();
			var data = $(this).serialize();
			$.post(base_url+'admin/theme/home_manager/update_slider2', data, function(data, textStatus, xhr) {
				console.log(data);
				if(data.result == true){
					Materialize.toast("Data Update.",4000);
				}
			},'json');
		});
$("#other_product_setting").on('submit', function(event) {
			event.preventDefault();
			var data = $(this).serialize();
			console.log(data);
			$.post(base_url+'admin/theme/home_manager/update_home_bot_product', data, function(data, textStatus, xhr) {
				console.log(data);
				if(data.result == true){
					Materialize.toast("Data Update.",4000);
				}
			},'json');
		});
		$(".product_slidet_setting .show_product_select").on('change', function(event) {
			event.preventDefault();
			if($(this).val() == 'catalogue'){
$(".product_slidet_setting .catalog_div").removeClass('hidden');
$(".product_slidet_setting .catalog_div .catalogue_name").attr('required', 'required');
			}else{
				$(".product_slidet_setting .catalog_div").addClass('hidden');
				$(".product_slidet_setting .catalog_div .catalogue_name").removeAttr('required');
			}
		});
		$(".other_prod_setting .show_product_select").on('change', function(event) {
			event.preventDefault();
			if($(this).val() == 'catalogue'){
$(".other_prod_setting .catalog_div").removeClass('hidden');
$(".other_prod_setting .catalog_div .catalogue_name").attr('required', 'required');
			}else{
				$(".other_prod_setting .catalog_div").addClass('hidden');
				$(".other_prod_setting .catalog_div .catalogue_name").removeAttr('required');
			}
		});
	});
</script>