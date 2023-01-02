<div class="pp-row">
<?php
if (isset($add_status) && $add_status == true) {?>
<div class="pp-col center ps12"><span class="center font21 teal-text">Product Add Successfully.</span></div>
<?php
}?>
	<form class="pp-form" id="add_product_form" action="<?php echo base_url('admin/prodman/addproduct/add_product'); ?>" enctype="multipart/form-data" method="post">
		<div class="pp-col pm6">
			<div class="card ">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h5 class="grey-text center-align">Add Product</h5>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Product SKU</label>
							<input placeholder="Product SKU" name="name_prod_sku" required type="text" class=" ">
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Product Name</label>
							<input placeholder="Product Name" name="name_prod_name" required type="text" class=" ">
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Description</label>
							<textarea placeholder="Description" name="name_prod_description" type="text" class=""></textarea>
						</div>
					</div>
					<div class="pp-col pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>Retail Price. &#8377;</label>
							<input placeholder="Retail Price (Rs.)" name="name_prod_retailprice"  type="text" class="only-number input_retail_price">
						</div>
					</div>
					<div class="pp-col pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>Selling Price. &#8377; <span class="selling_price_label pp_math_text" first=".input_retail_price" second=".input_sell_price" math="%"></span></label>
							<input placeholder="Selling Price (Rs.)" required name="name_prod_sellingprice"  type="text" class="only-number input_sell_price">
						</div>
					</div>
					</div>
					</div>
					<div class="card image_upload">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h5 class="grey-text center-align">Images</h5>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="file-field input-field">
							<div class="btn">
								<span>Select</span>
								<input type="file" class="image_file_button" name="imagesFile[]" >
							</div>
							<div class="file-path-wrapper pp-text-field">
								<label>Product Images 1:</label>
								<input class="file-path validate" type="text" required placeholder="Upload one or more files">
							</div>
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="file-field input-field">
							<div class="btn">
								<span>Select</span>
								<input type="file" class="image_file_button" name="imagesFile[]" >
							</div>
							<div class="file-path-wrapper pp-text-field">
								<label>Product Images 2:</label>
								<input class="file-path validate" type="text" placeholder="Upload one or more files">
							</div>
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="file-field input-field">
							<div class="btn">
								<span>Select</span>
								<input type="file" class="image_file_button" name="imagesFile[]" >
							</div>
							<div class="file-path-wrapper pp-text-field">
								<label>Product Images 3:</label>
								<input class="file-path validate" type="text" placeholder="Upload one or more files">
							</div>
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="file-field input-field">
							<div class="btn">
								<span>Select</span>
								<input type="file" class="image_file_button" name="imagesFile[]" >
							</div>
							<div class="file-path-wrapper pp-text-field">
								<label>Product Images 4:</label>
								<input class="file-path validate" type="text" placeholder="Upload one or more files">
							</div>
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="file-field input-field">
							<div class="btn">
								<span>Select</span>
								<input type="file" class="image_file_button" name="imagesFile[]" >
							</div>
							<div class="file-path-wrapper pp-text-field">
								<label>Product Images 5:</label>
								<input class="file-path validate" type="text" placeholder="Upload one or more files">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card product-description">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h5 class="grey-text center-align">Product Descriptions</h5>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col  pp-text-field  ps12">
							<label>Know Your Product</label>
							<textarea placeholder="Know Your Product" name="name_prod_knowyourproduct" type="text" rows="4" class="know_your_product"></textarea>
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Product FAQ</label>
							<textarea placeholder="Product FAQ" type="text" name="name_prod_productfaq" rows="4" class="faq"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="card product-sizechart">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h5 class="grey-text center-align">Size Chart</h5>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field pm4">
							<label>Standard Size:-</label>
						</div>
						<div class="pp-col pm6">
							<div class="switch">
								<label>
									Off
									<input type="checkbox" checked name="name_prod_standardsize_checkbox" class="standard_checkbox pp-show_div_on_check" pp-div_class="standard_size_div">
									<span class="lever"></span>
									On
								</label>
							</div>
						</div>
					</div>

					<div class="pp-col pp-padres pm12 pp_show_on_check_div standard_size_div">
						<div class="pp-text-field pp-col pp-error  ps12">
							<label>Select Category First</label>
						</div>
					</div>
<div class="divider"></div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field pm4">
							<label>Customize Size:-</label>
						</div>
						<div class="pp-col pm6">
							<div class="switch">
								<label>
									Off
									<input type="checkbox" name="name_prod_customizesize_checkbox" checked class="customize_checkbox pp-show_div_on_check" pp-div_class="customize_size_div">
									<span class="lever"></span>
									On
								</label>
							</div>
						</div>
					</div>
					<div class="pp-col pp-padres pm12 pp_show_on_check_div customize_size_div">
						<div class="pp-text-field pp-col pp-error  ps12">
							<label>Select Category First</label>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="pp-col pm6">
			<div class="card  product-details">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h5 class="grey-text center-align">Product Details</h5>
					</div>
					<div class="pp-col loadder hidden pm12">
						<div class="pp-col pm2  padding1"></div>
						<div class="pp-col pm8">
							<div class="progress">
								<div class="indeterminate"></div>
							</div>
						</div>
						<div class="pp-col pm2"></div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col input-field ps6">
							<select class="grey-text main-cat-select material-select text-darken-2" name="name_prod_maincategory" required>
								<option value="" disabled selected>Choose your option</option>
								<?php if (isset($main_categories)) {
									foreach ($main_categories as $value) {?>
								<option value="<?php echo $value->main_cat_id; ?>"><?php echo $value->cat_name; ?></option>
								<?php	}}?>
							</select>
							<label>Main Category</label>
						</div>
						<div class="pp-col input-field ps6">
							<select class=" sub-cat-select grey-text material-select text-darken-2" name="name_prod_subcategory" required>
							</select>
							<label class="black-text">Sub Category</label>
						</div>
					</div>
					<div class="pp-col add-product-details-div pp-padres pm12">
						<!-- Here Some Fied Add by jquery -->
					</div>
				</div>
			</div>
			<div class="card ">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h5 class="grey-text center-align">Other Details</h5>
					</div>
					<div class="pp-col pp-padres pm12">
<div class="pp-col pp-text-field pm4">
							<label>Product Status:-</label>
						</div>
						<div class="pp-col pm6">
							<div class="switch">
								<label>
									Off
									<input type="checkbox" name="name_prod_product_status_checkbox" checked class="customize_checkbox ">
									<span class="lever"></span>
									Live
								</label>
							</div>
						</div>
					</div>
					<div class="pp-col pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>Stock.</label>
							<input placeholder="Stock" required type="text" name="name_prod_stock" value="<?php echo $default_value['stock']; ?>" class="only-number">
						</div>
					</div>
						<div class="pp-col pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>Shipping Time.</label>
							<input placeholder="Shipping Time" required type="text" name="name_prod_shippingtime" value="<?php echo $default_value['shipping_time']; ?>" class="only-number">
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Shipping Charge. &#8377;</label>
							<input placeholder="Shipping Charge" required type="text" name="name_prod_shippingcharge" value="<?php echo $default_value['shipping_charge']; ?>" class="only-number">
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>International Shipping Charge. &#8377;</label>
							<input placeholder="Shipping Charge" required type="text" name="name_prod_intshippingcharge" value="<?php echo $default_value['international_shipping_charge']; ?>" class="only-number">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pp-col pm6">
			<div class="card  product-details">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pm4  padding1"></div>
						<button class="btn waves-effect pp-col pm4 waves-light add_product_submit" type="submit" name="add_product_submit">Submit
						<i class="material-icons right">send</i>
						</button>
						<div class="pp-col pm4  padding1"></div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<style type="text/css">
	.product-details .add-product-details-div div{
		padding: 2px 0px;
	}
</style>
<script type="text/javascript">
	//==================== Get Sub categories When  Main cat Change ==============////
$($('.product-details select.sub-cat-select').parent('div')).css('visibility', 'hidden');
$('.product-details select.main-cat-select').change(function(event) {
	get_details_field($(this).val());
get_sub_category_by_main_id($(this).val());
get_default_descriptions_by_main('main_cat', $(this).val());
get_standard_size_names('main_cat', $(this).val());
get_customize_size_names('main_cat', $(this).val());
});
function get_default_descriptions_by_main(by, main_id) {
$.post(base_url + '/admin/adminapi', {
method: 'get_default_desc_by_cat',
by: by,
main_cat_id: main_id
}, function(data, textStatus, xhr) {
console.log(data);
if (data === "" && by === "main_cat") {
$(".product-description .know_your_product").val("");
$(".product-description .faq").val("");
}
if (data !== "" && data !== null) {
$(".product-description .know_your_product").val(data.know_your_product);
$(".product-description .faq").val(data.faq);
}
});
}
function get_customize_size_names(by, main_id) {
$.post(base_url + '/admin/adminapi', {
method: 'get_customize_size_names',
by: by,
cat_id: main_id
}, function(data, textStatus, xhr) {
console.log(data);
if (data !== "" && data !== null) {
	var htmls = "";
	var select_names = "";
	$.each(data, function(index, el) {
select_names+=index.replace(/ /g,'')+'#';
htmls += '<div class=" pp-col ps6"><div class="pp-col input-field  ps12"><select name="name_prod_customselect_'+index.replace(/ /g,'')+'" index="custom_'+index.replace(/ /g,'')+'" class="grey-text ' + index.replace(/ /g,'') + ' customize_size_chart_select material-select">';
	$.each(el, function(indexs, els) {
	htmls += '<option ct-price="'+els.price+'" value="' + els.id + '">' + els.name + '</option>';
	});
	htmls += '</select><label>Select ' + index + ' Size Chart</label></div>';
	htmls += '<div class="pp-col pp-text-field ps12"><label>Customize '+index+' Price. &#8377;</label><input placeholder="Price" name="name_prod_custompricebox_'+index+'" type="text" class="only-number only-number custom_'+index.replace(/ /g,'')+'_text_field"></div></div>';
	});

	htmls += '<input type="text" name="name_prod_customizesizenames" class="display_none" value="'+select_names+'">';
	$(".customize_size_div").html(htmls);
	//// Set Value In Price Textbox /////
	$(".customize_size_div .customize_size_chart_select").each(function(index, el) {
		$(this).find("option:first").attr("selected", true);

	$("."+$(this).attr('index')+"_text_field").val($('option:selected', this).attr('ct-price'));
	});
	$('.customize_size_div .customize_size_chart_select').material_select();
	$(".customize_size_div").on('change', '.customize_size_chart_select', function(event) {
	$("."+$(this).attr('index')+"_text_field").val($('option:selected', this).attr('ct-price'));
	});
}
});
}
function get_standard_size_names(by, main_id) {
$.post(base_url + '/admin/adminapi', {
method: 'get_standard_size_names',
by: by,
cat_id: main_id
}, function(data, textStatus, xhr) {
console.log(data);
var html = "";
var select_names = "";
if (data !== "" && data !== null) {
$.each(data, function(index, el) {
	select_names+=index.replace(/ /g,'')+'#';
html += '<div class=" pp-col ps6"><div class="pp-col p-padding_5 card z-depth-1 ps12"><div class="pp-col input-field  ps12"><select name="name_prod_standardselect_'+index.replace(/ /g,'')+'" index="standard_'+index.replace(/ /g,'')+'" class="grey-text ' + index.replace(/ /g,'') + ' standard_size_chart_select material-select">';
	$.each(el, function(indexs, els) {


	html += '<option st-price="'+els.price+'" value="' + els.id + '">' + els.name + '</option>';
	});
	html += '</select><label>Select ' + index + ' Size Chart</label></div>';
	html += '<div class="pp-col pp-text-field ps12"><label>Standard '+index+' Price. &#8377;</label><input placeholder="Price" name="name_prod_standardpricebox_'+index+'" type="text" class="only-number standard_'+index.replace(/ /g,'')+'_text_field"></div></div></div>';
	});
html += '<input type="text" name="name_prod_standardsizenames" class="display_none" value="'+select_names+'">';
	$(".standard_size_div").html(html);
	//// Set Value In Price Textbox /////
	$(".standard_size_div .standard_size_chart_select").each(function(index, el) {
		$(this).find("option:first").attr("selected", true);
	$("."+$(this).attr('index')+"_text_field").val($('option:selected', this).attr('st-price'));
	});
	$('.standard_size_div .standard_size_chart_select').material_select();
	$(".standard_size_div").on('change', '.standard_size_chart_select', function(event) {
	$("."+$(this).attr('index')+"_text_field").val($('option:selected', this).attr('st-price'));
	});
	}
	});
	}
	function get_sub_category_by_main_id(main_id) {
	$(".product-details .loadder").removeClass('hidden');
	$.post(base_url + '/admin/adminapi', {
	method: 'get_sub_cat',
	main_cat_id: main_id
	}, function(data, textStatus, xhr) {
	var sub_cat = '<option value="" disabled selected>Choose your option</option>';
	$.each(data, function(index, el) {
	sub_cat += '<option value="' + el.sub_cat_id + '">' + el.cat_name + '</option>';
	});
	$(".product-details select.sub-cat-select").material_select('destroy');
	$(".product-details select.sub-cat-select").html(sub_cat);
	$($('.product-details select.sub-cat-select').parent('div')).css('visibility', 'visible');
	$(".product-details select.sub-cat-select").material_select();
	$(".product-details .loadder").addClass('hidden');
	});
	}
	//==================== End Get Sub categories When  Main cat Change ==============////
	////==================== Get Which detail Fill When  sub cat Change ==============////
	$(".product-details select.sub-cat-select").change(function(event) {
	// get_details_field($(this).val());
	});
	function get_details_field(subcatid) {
	$(".product-details .loadder").removeClass('hidden');
	$.post(base_url + '/admin/adminapi', {
	method: 'get_details_field',
	sub_cat_id: subcatid
	}, function(data, textStatus, xhr) {
	var detail_html = "";
	var input_names = "";
	var required = "";
	$.each(data.fielddata, function(index, el) {
	if (data.prod_det_id[el.det_id] == 1) {
	required = " required ";
	} else {
	required = "";
	}
	if (el.type == 'text') {

		input_names+=el.det_name.replace(/ /g,'')+"#";
	detail_html += "<div class='pp-col  pm12'><div class='pp-col pp-text-field ps12'><label>" + el.det_name + "</label><input name='name_prod_"+el.det_name.replace(/ /g,'')+"_details' placeholder='" + capitalize(el.det_name) + "'  type='text' " + required + "/></div></div>";
	} else if (el.type == 'number') {
		input_names+=el.det_name.replace(/ /g,'')+"#";
	detail_html += "<div class='pp-col  pm12'><div class='pp-col pp-text-field ps12'><label>" + el.det_name + "</label><input name='name_prod_"+el.det_name.replace(/ /g,'')+"_details' placeholder='" + capitalize(el.det_name) + "'  type='text' " + required + " class='only-number'/></div></div>";
	}
	});
	detail_html += '<input type="text" name="name_prod_detailsnames" class="display_none" value="'+input_names+'">';
	$(".product-details .add-product-details-div").html(detail_html);
	$(".product-details .loadder").addClass('hidden');
	});
	}
	/////==================== End Get Which detail Fill When  sub cat Change ==============////
// 	/////----------------- Upload Image With Ajax  -----------------------////
// 	$(".image_file_button").on('change', function(event) {

// var file_data = $(this).prop('files')[0];
//  var form_data = new FormData();
//  for (var i = 0; i < event.target.files.length; i++) {
//   var file = event.target.files[i];
//   if(!file.type.match('image.*')) {
//    // Check for File type. the 'type' property is a string, it facilitates usage if match() function to do the matching

//     error = 1;
//    }else if(file.size > 1048576){
//      error = 1;
//    }else{
//     // If all goes well, append the up-loadable file to FormData object
//     form_data.append('imagesFile[]', file, file.name);
//     // Comparing it to a standard form submission the 'image' will be name of input
//     }
//   }

//     alert(form_data);
//      $.ajax({
//                 url: base_url + '/admin/adminapi/upload_image_with_ajax', // point to server-side PHP script
//                 dataType: 'text',  // what to expect back from the PHP script, if anything
//                 cache: false,
//                 contentType: false,
//                 processData: false,
//                 data: form_data,
//                 type: 'post',
//                 success: function(php_script_response){
//                     alert(php_script_response); // display response from the PHP script, if any
//                 }
//      });
// 	});
// 	/////----------------- End Upload Image With Ajax  -----------------------////
	/////====================== On Form Submit =====================////
	$('.add_product_submit').on('click', function(event) {
	$("[required]").each(function(index, el) {
	if ($(this).val() === 'undefined' || $(this).val() === "" || !$.trim($(this).val())) {
	var value = $(this).attr('placeholder');
	if (typeof value != 'undefined') {
	Materialize.toast('Enter ' + value, 4000);
	} else if (typeof $(this).attr('name') != 'undefined') {
	Materialize.toast('Enters ' + $(this).attr('name'), 4000);
	} else {
	Materialize.toast('Enter All Required Fill.', 4000);
	}
	event.preventDefault();
	}
	});
	});
	</script>
