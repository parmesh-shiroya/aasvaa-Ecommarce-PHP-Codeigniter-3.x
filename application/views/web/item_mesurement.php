<div class="pp-container">
	<div class="pp-row">
		<div class="pp-col p-padding_10 card ps12">
			<div class="pp-col zero_padding ps12 pm3">
				<div class="pp-col zero_padding ps12">
					<img class="responsive-img" src="<?php echo base_url('uploads/pro_image/300_375/' . $this->cart->contents($method)[$method]['image']); ?>">
				</div>
				<div class="pp-col  ps12 font14 grey-text text-darken-1">
					<div class="pp-margin-tb-7">
						<span class="font21"><b>Important Notes:</b></span><br>
						All measurements are in inches only.<br><br>
						If possible, ask someone to take your body measurement.<br><br>
						We need your body measurements please do not add extra allowances in body measurements. <br><br>Generally we add 2 inches to 3 inches allowances as per tailoring principles.<br><br>
						Fill all measurements accurately as per products.<br><br>
						Your size and style selections &amp; instructions are subject to fabric pattern and limitations.
					</div>
				</div>
			</div>
			<div style="border-left: 1px solid #ddd;" class="pp-col ps12 pm9">
<div class="pp-col zero_padding ps12">
<div class="pp-col pp-margin-tb-10 zero_padding ps12 pm6 pl5  ">
								<label class="font14 grey-text text-darken-1">Select Exist Mesurement</label>
								<select value="null" name="selected mesurement" class="browser-default mesuremenst_select">
									<option value="" disabled selected>Select</option>
									<?php foreach ($cust_exist_mesurement as $cust_mesure_key => $cust_mesure_value) {?>
									<option value="<?php echo $cust_mesure_value->id; ?>"><?php echo $cust_mesure_value->name . ' (' . $cust_mesure_value->no . ')'; ?></option>
									<?php }?>
								</select>

							</div>
</div>
				<form id="measurement_form" class="pp-form submit_mesurement" action="<?php echo $current_url; ?>" method="post">
					<div class="pp-text-field">
						<div class="space10px"></div><label>Measurement Name *:<br>(Give some name to save measurement for future use.)</label>
						<br>
						<input style="max-width: 400px;" placeholder="Enter Measurement Name" required id="cus_measurement_name" size="30" name="cus_measurement_name" type="text">
					</div>
					<div class="pp-col pp-margin-tb-15 zero_padding  ps12">
						<?php
if (isset($customize_sizes) && !empty($customize_sizes)) {
	// print_r($customize_sizes);
	$keyss = "";
	foreach ($customize_sizes as $key => $value) {
		$keyss .= $key . "#";
		?>
						<div><span class="font21 pp-margin-tb-15 teal-text"><?php echo $key; ?></span></div>
						<div class="pp-col ps12 zero_padding ">
							<?php foreach (unserialize(base64_decode($value->fields)) as $key1 => $value1) {
			?>
							<div class="pp-col pp-margin-tb-10 ps12 pm6 pl4 ">
								<label class="font14 grey-text text-darken-1"><?php echo $key1; ?></label>
								<select value="null" name="<?php echo $key . "#" . $key1; ?>" class="browser-default mesure_select">
									<option value="" disabled selected>Select</option>
									<?php foreach ($value1['sizes'] as $key2 => $value2) {?>
									<option value="<?php echo $value2; ?>"><?php echo $value2; ?></option>
									<?php }?>
								</select>
								<?php if (!empty($value1['images'])) {

				?>
				<div class="mesure_image" ><img class="br4 pp-col ps12 zero_padding" src="<?php echo base_url($value1['images']); ?>"></div>

								<?php }?>
							</div>
							<?php }
		?>
						</div>
						<?php if (!empty($value->images_select)) {
			?>
						<div class="pp-col <?php echo ($value->name == 'Blouse') ? "blouse_images_div" : ""; ?> pp-margin-tb-15 ps12 zero_padding ">
						<div class="c-row gmf">
							<?php foreach (unserialize(base64_decode($value->images_select)) as $key4 => $value4) {
				?>
							<div class="grid g124  g8mtb10"><label class="font14  grey-text text-darken-1"><?php echo $key4; ?> : </label></div>
							<?php $a = 0;foreach ($value4 as $key5 => $value5) {
					?>
							<div div-for="<?php echo str_replace(" ", "_", $key4); ?>" value="<?php echo $key5; ?>" class="grid g58 g66 g8mb10 g48 g74 <?php echo ($a == 0) ? '' : ''; ?> select_image">
								<center><label class="pointer" for="id_<?php echo str_replace(" ", "_", $key5); ?>" ><img   src="<?php echo $value5; ?>" class="responsive-img"></label></center>
								<center  class="h20"><input <?php echo ($a == 0) ? 'checked="checked"' : ''; ?> name="<?php echo $key . "#" . str_replace(" ", "_", $key4); ?>" value="<?php echo $value5; ?>" id="id_<?php echo str_replace(" ", "_", $key5); ?>" class="with-gap" type="radio"><label class="g8ml10" for="id_<?php echo str_replace(" ", "_", $key5); ?>"></label></center>
								<center><span class="grey-text font-karla   text-darken-0 g8fs12"><?php echo $key5; ?></span></center>
							</div>
							<?php $a++;}?>
							<?php }?>
						</div> </div>
						<?php
}}
	?>
						<input type="hidden" value="<?php echo $keyss; ?>" class="display_none " name="keysss"/>
<?php
}
?>

					</div>
					<div class="pp-col pp-margin-tb-15 pp-text-field zero_padding  ps12">
					<label>Other Instruction :- </label>
<textarea name="other_instruction" rows="3"></textarea>
<input type="hidden" value="<?php echo $method; ?>" class="display_none " name="method"/>
					</div>
					<div class="pp-col ps12">
						<button name="register_mesurement" class="waves-effect waves-light btn">Submit Mesurement</button>
					</div>
				</form>
				<?php
if (isset($subited_data)) {
	foreach ($subited_data as $key => $value) {?>
<input type="hidden" class="hidden submited_data_id" value="<?php echo $value; ?>">
	<?php }
}

?>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
.select_image{
	cursor: pointer;
}
.select_image img{
	border: 1px solid #aaa;
}
.select_image.activated img{
border: 2px solid rgb(0,150,150);
	}
	.mesure_image{
		display: none;
		background: rgb(255, 255, 255) none repeat scroll 0 0;
    border: 1px solid rgb(51, 51, 51);
    border-radius: 20px;
    margin-left: 110px;
    margin-top: -214px;
    max-width: 200px;
    padding: 10px;
    position: absolute;
    z-index: 2;
	}
	.mesure_select:hover + .mesure_image { display: unset; }
	.mesure_image:hover { display: unset; }
</style>
<script>
	jQuery(document).ready(function($) {
		$(".submit_mesurement").on('submit', function(event) {
event.preventDefault();
			$result = 0;

			$("#measurement_form select").each(function(index, el) {
			if($(this).val() == null){
				$result = 1;
			}
		});


			if($result == 1){
			event.preventDefault();
			Materialize.toast('Fill All Data', 3000);
		}else{
		var datas = $(this).serialize();
		$.post(base_url+'api/cart_api/set_mesurement_data_to_cart_2',datas , function(data, textStatus, xhr) {
// console.log(data);
if (data == 'done') {
	Materialize.toast('Mesurement Submit Successfully.',4000);
	 location.href = base_url+"shopping_cart";
}else if(data == 'error'){
Materialize.toast('Mesurement Name Already Exist.',4000);
}
		});
		}
		});
		$("select[name='Blouse#Blouse Style*']").on('change', function(event) {
			event.preventDefault();
show_image_box();
		});
show_image_box();
		function show_image_box(){
if ($("select[name='Blouse#Blouse Style*']").val() == "Make as per following style") {
$(".blouse_images_div").removeClass('hidden');
}else{
	$(".blouse_images_div").addClass('hidden');
}
		}
// 		$(".select_image").on('click', function(event) {
// 			event.preventDefault();
// var value = $(this).attr('value');
// var for_div = $(this).attr('div-for');
// $("."+for_div+"_value").val(value);
// $(".select_image").removeClass('activated');
// $(this).addClass('activated');
// 		});
$(".submited_data_id").each(function(index, el) {
get_item_data($(this).val());
});

		function get_item_data(id){
$.post(base_url+'item_mesurement/get_item_size_data', {id: id}, function(data, textStatus, xhr) {
	// console.log(data);
	$("[name='other_instruction']").val(data.instruction);
	$("#cus_measurement_name").val(data.name);
	$.each(data.data,function(index, el) {
		// alert('[name="'+index.replace(/\_/g," ")+'"]');
		$('[name="'+index.replace(/\_/g," ")+'"]').val(el);
$('[name="'+index.replace(/\_/g," ")+'"]').find('option[value="'+el+'"]').attr('selected', 'true');
	});
	show_image_box();
},"json");
		}


		$(".mesuremenst_select").on('change', function(event) {
			event.preventDefault();
var values = $(this).val();
// alert(values);
get_item_data(values);

		});
	});
</script>