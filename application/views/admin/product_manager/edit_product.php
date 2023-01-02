<div class="pp-row">
<?php
if (isset($add_status) && $add_status == true) {?>
<div class="pp-col center ps12"><span class="center font21 teal-text">Product Update Successfully.</span></div>
<?php
}?>
	<form class="pp-form" id="add_product_form" action="<?php echo base_url('admin/prodman/editproduct/update_product/' . $pro_det->product_id); ?>" enctype="multipart/form-data" method="post">
		<div class="pp-col pm12">
			<div class="card">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h6 class="title font18 center-align">Add Product</h6>
					</div>
					<div class="pp-col pp-padres pm5">
						<div class="pp-col pp-text-field ps12">
							<label>Product SKU</label>
							<input placeholder="Product SKU" value="<?php echo $pro_det->product_sku; ?>" name="name_prod_sku" required type="text" class=" ">
						</div>
					</div>
					<div class="pp-col pp-padres pm5">
						<div class="pp-col pp-text-field ps12">
							<label>Catalog Name</label>
							<input placeholder="Catalog Name" value="<?php echo $pro_det->catalogue_name; ?>" name="name_catalog_name" required type="text" class=" ">
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Product Name</label>
							<input placeholder="Product Name"  value="<?php echo $pro_det->product_name; ?>"  name="name_prod_name" required type="text" class=" ">
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Description</label>
							<textarea placeholder="Description" value="" name="name_prod_description" type="text" class=""><?php echo $pro_det->product_desc; ?></textarea>
						</div>
					</div>
					<div class="pp-col pp-padres pm5">
						<div class="pp-col pp-text-field ps12">
							<label>Retail Price. &#8377;</label>
							<input placeholder="Retail Price (Rs.)" value="<?php echo $pro_det->mrp; ?>" name="name_prod_retailprice"  type="text" class="only-number input_retail_price">
						</div>
					</div>
					<div class="pp-col pp-padres pm5">
						<div class="pp-col pp-text-field ps12">
							<label>Selling Price. &#8377; <span class="selling_price_label pp_math_text" first=".input_retail_price" second=".input_sell_price" math="%"></span></label>
							<input placeholder="Selling Price (Rs.)" value="<?php echo $pro_det->sell_price; ?>" required name="name_prod_sellingprice"  type="text" class="only-number input_sell_price">
						</div>
					</div>
					</div>
					</div>

			<div class="card image_upload">
				<div class="pp-row pp-padres pp-center">
					<div class="pp-col pm12">
						<h6 class="title font18 center-align">Image Upload</h6>
						<?php
$image_value = "";
foreach (unserialize($pro_det->pro_imgs) as $key => $value) {
	$image_value .= $value . "#";
}
?>
						<input type="hidden" name="images" required value="<?php echo $image_value; ?>" class="hidden images_names">
					</div>
						<div class="pp-col ps3"></div>
					<div class="pp-col img_loader_div ps6"></div>
					<div class="pp-col ps3"></div>
<div class="pp-col  pp-margin-t-7 ps3">
						  <!-- <div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div> -->
					</div>

					<div id="sortable" class="pp-col image-upload-box pp-margin-t-7 ps6">
					<div  class="pp-col					                   					                   					                   					                    <?php echo (sizeof(unserialize($pro_det->pro_imgs)) < 5) ?: "hidden"; ?> margin-lr-7 zero_padding image-select-button pointer add-image-button center valign-center ps2">
					<input id="image_file_button_2" type="file"  style="width: 100%; height: 100%; position: relative; left: 0; top: 0; " class="image_file_button_2 opacity0"  class="image_file_button_2 hidden"  name="imagesFile[]" >
<span style="    position: relative;    top: -44px;"  class="font12 grey-text text-darken-1">Add Image</span>

</div>
<?php
foreach (unserialize($pro_det->pro_imgs) as $key => $value) {?>
	<div id="<?php echo $value; ?>" class="pp-col margin-lr-7 zero_padding img-box ps2"><img src="<?php echo base_url("uploads/pro_image/94_130/" . $value); ?>" img-key="<?php echo $random = rand(); ?>" class="responsive-img pp-col ps12 zero_padding "><span class="pp-col  center ps12"><i class="material-icons pointer rem-img-btn pp-margin-t-7 grey-text hover-text-primary text-darkne-1" img-name="<?php echo $value; ?>" img-key="<?php echo $random; ?>" >delete_forever</i></span></div>

<?php }?>


					</div>
					<div class="pp-col  pp-margin-t-7 ps3">
					</div>
				</div>
			</div>

			<div class="card hidden product-sizechart">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h6 class="title font18 center-align">Size Chart</h6>
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
		<div class="pp-col pm12">
			<div class="card  product-details">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h6 class="title font18 center-align">Product Details</h6>
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
						<div class="pp-col input-field ps4">
							<select class="grey-text main-cat-select material-select text-darken-2" name="name_prod_maincategory" required>
								<option value="" disabled selected>Choose your option</option>
								<?php if (isset($main_categories)) {
	foreach ($main_categories as $value) {?>
								<option<?php echo ($value->main_cat_id == $pro_det->main_cat_id) ? ' selected ' : ""; ?> value="<?php echo $value->main_cat_id; ?>"><?php echo $value->cat_name; ?></option>
								<?php	}}?>
							</select>
							<label>Main Category</label>
						</div>
						<div class="pp-col input-field ps4">
							<select class=" sub-cat-select grey-text material-select text-darken-2" name="name_prod_subcategory" required>
							<option value="" disabled selected>Choose your option</option>
							<?php if (isset($sub_categories)) {
	foreach ($sub_categories as $value) {?>
								<option<?php echo ($value->sub_cat_id == $pro_det->sub_cat_id) ? ' selected ' : ""; ?> value="<?php echo $value->sub_cat_id; ?>"><?php echo $value->cat_name; ?></option>
								<?php	}}?>
							</select>
							<label class="black-text">Sub Category</label>
						</div>
					</div>
					<div class="pp-col add-product-details-div pp-padres pm12">
						<!-- Here Some Fied Add by jquery -->

					</div>
				</div>
			</div>
			<div class="card product-description">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h6 class="title font18 center-align">Product Descriptions</h6>
					</div>
					<div class="pp-col pp-pades pm12">
						<div class="pp-col  pp-text-field  ps12">
							<label>Know Your Product</label>
							<textarea placeholder="Know Your Product" name="name_prod_knowyourproduct" type="text" rows="4" class="know_your_product"><?php echo $pro_det->know_product; ?></textarea>
						</div>
					</div>
					<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Product FAQ</label>
							<textarea placeholder="Product FAQ" type="text" name="name_prod_productfaq" rows="4" class="faq"><?php echo $pro_det->product_faq; ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="card ">
				<div class="pp-row">
					<div class="pp-col pp-padres pm12">
						<h6 class="title font18 center-align">Other Details</h6>
					</div>
					<div class="pp-col pp-padres pm6">
<div class="pp-col pp-text-field pm4">
							<label>Product Status:-</label>
						</div>
						<div class="pp-col pm6">
							<div class="switch">
								<label>
									Off
									<input type="checkbox"									                      									                      									                      									                       <?php echo ($pro_det->status == 'on') ? "checked" : ""; ?> name="name_prod_product_status_checkbox" checked class="customize_checkbox ">
									<span class="lever"></span>
									Live
								</label>
							</div>
						</div>
					</div>
					<div class="pp-col pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>Weight (Kg).</label>

							  <select required name="name_prod_weight" class="browser-default grey-text text-darken-1">
    <option                                             <?php echo ($pro_det->weight == "0.5") ? ' selected ' : ''; ?> value="0.5">0.5 Kg</option>
    <option                                             <?php echo ($pro_det->weight == "1") ? ' selected ' : ''; ?> value="1">1 Kg</option>
    <option                                             <?php echo ($pro_det->weight == "1.5") ? ' selected ' : ''; ?> value="1.5">1.5 Kg</option>
    <option                                             <?php echo ($pro_det->weight == "2") ? ' selected ' : ''; ?> value="2">2 Kg</option>
    <option                                              <?php echo ($pro_det->weight == "2.5") ? ' selected ' : ''; ?> value="2.5">2.5 Kg</option>
  </select>
						</div>
					</div>
					<div class="pp-col pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>Stock.</label>
							<input placeholder="Stock" required type="text" name="name_prod_stock" value="<?php echo $pro_det->stock; ?>" class="only-number">
						</div>
					</div>
						<div class="pp-col pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>Shipping Time.</label>
							<!-- <input placeholder="Shipping Time" required type="text" name="name_prod_shippingtime" value="<?php echo $default_value['shipping_time']; ?>" class="only-number"> -->
  <select required name="name_prod_shippingtime" class="browser-default grey-text text-darken-1">
    <option                                             <?php echo ($pro_det->ship_time == "Ready To Ship") ? ' selected ' : ''; ?> value="Ready To Ship">Ready To Ship</option>
    <option                                             <?php echo ($pro_det->ship_time == "1-2 Working Days") ? ' selected ' : ''; ?> value="1-2 Working Days">1-2 Working Days</option>
    <option                                             <?php echo ($pro_det->ship_time == "2-3 Working Days") ? ' selected ' : ''; ?> value="2-3 Working Days">2-3 Working Days</option>
    <option                                             <?php echo ($pro_det->ship_time == "3-4 Working Days") ? ' selected ' : ''; ?> value="3-4 Working Days">3-4 Working Days</option>
    <option                                              <?php echo ($pro_det->ship_time == "10-12 Working Days") ? ' selected ' : ''; ?> value="10-12 Working Days">10-12 Working Days</option>
  </select>

						</div>
					</div>
					<div class="pp-col hidden pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>Shipping Charge. &#8377;</label>
							<input placeholder="Shipping Charge" required type="text" name="name_prod_shippingcharge" value="<?php echo $pro_det->shipping_charge; ?>" class="only-number">
						</div>
					</div>
					<div class="pp-col hidden pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>International Shipping Charge. &#8377;</label>
							<input placeholder="Shipping Charge" required type="text" name="name_prod_intshippingcharge" value="<?php echo $pro_det->international_shipping_charge; ?>" class="only-number">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pp-col pm12">
			<div class="card  product-details">
				<div class="pp-row">
					<div class="pp-col pp-padres center pm12">

						<button class="btn waves-effect  waves-light add_product_submit" type="submit" name="add_product_submit">Submit
						<i class="material-icons right">send</i>
						</button>

					</div>
				</div>
			</div>
		</div>
	</form>
</div>

 <!-- Modal Structure -->
  <div id="add_detail_data_model" class="modal transparent z-depth-0 grey-text text-darken-2">
    <div class="modal-content">
		<div class="pp-row pp-center">
<div class="pp-col ps12 pl6 card z-depth-2 pp-padres pxl5">
<div class="pp-col p-padding_tb_7 pm12">
						<h6 class="title nae font18 center-align">Other Details</h6>
					</div>
<form class="pp-form" id="add_detail_values">
<input placeholder="Value" required type="hidden" name="value" value="" class="hidden det_name">
<div class="pp-col pp-text-field ps12">
							<label class="nae">Add Value</label>
							<input placeholder="Value" required type="text" name="det_value" value="" class="det_value">
						</div>
						<div class="pp-col margin_t_13 center ps12">

						<button class="btn waves-effect primary waves-light" type="submit" name="add_product_submit">Add
						</button>

					</div>
</form>
</div>
		</div>
    </div>
  </div>
<style type="text/css">
	.product-details .add-product-details-div div{
		padding: 2px 0px;
	}
	.add-product-details-div .detail-select ul li{
		min-height: 37px;
	}
	.add-product-details-div .detail-select ul li span{
		padding: 7px 16px;
	}
	.image_upload .image-select-button{
height: 80px;

width: 65px;
background: #eee;
border: 1px solid #999;
	}
	.image_upload .image-upload-box{
		padding: 1rem;
		-webkit-box-shadow: inset 0px 0px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: inset 0px 0px 5px 0px rgba(0,0,0,0.75);
box-shadow: inset 0px 0px 5px 0px rgba(0,0,0,0.75);
	}
</style>
<script type="text/javascript">
function imagePerformClick(elemId) {
   var elem = document.getElementById(elemId);
   if(elem && document.createEvent) {
      var evt = document.createEvent("MouseEvents");
      evt.initEvent("click", true, false);
      elem.dispatchEvent(evt);
   }
}
</script>
<script>
	$(document).ready(function() {
	  $( "#sortable" ).sortable({
	update: function( event, ui ) {
var sorteds = $( "#sortable" ).sortable("toArray");

var htmlss = "";
$.each(sorteds, function(index, val) {
	if (val != "") {
		htmlss += val+"#";
	 console.log(val);
	 }
});
$(".images_names").val(htmlss);
}
});
    $( "#sortable" ).disableSelection();
	});
</script>
<script type="text/javascript">
$("#add_detail_values").on('submit', function(event) {
	event.preventDefault();
	var data = $(this).serialize();
	var det_id = $('#add_detail_values .det_name').val();
	var value_name = toUpperCase($('#add_detail_values .det_value').val());
	$.post(base_url+'admin/prodman/addproduct2/add_detail_values', data, function(data, textStatus, xhr) {
		if(data.result == true){
// det-data-id="'+el.det_data_id+'"
  $("select[det-data-id='"+det_id+"']").material_select('destroy');
  $("select[det-data-id='"+det_id+"']").find('option[value="add_new_detail"]').prop('selected',false);
$("select[det-data-id='"+det_id+"']").prepend('<option selected value="'+value_name+'">'+value_name+'</option>');
$("select[det-data-id='"+det_id+"']").material_select();
$('#add_detail_data_model').closeModal();
$('#add_detail_values .det_value').val("");
$('#add_detail_values .det_name').val("");
		}
	},"json");
});


	//==================== Get Sub categories When  Main cat Change ==============////
// $($('.product-details select.sub-cat-select').parent('div')).css('visibility', 'hidden');
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
                select_names += index.replace(/ /g, '') + '#';
                htmls += '<div class=" pp-col ps6"><div class="pp-col input-field  ps12"><select name="name_prod_customselect_' + index.replace(/ /g, '') + '" index="custom_' + index.replace(/ /g, '') + '" class="grey-text ' + index.replace(/ /g, '') + ' customize_size_chart_select material-select">';
                $.each(el, function(indexs, els) {
                    htmls += '<option ct-price="' + els.price + '" value="' + els.id + '">' + els.name + '</option>';
                });
                htmls += '</select><label>Select ' + index + ' Size Chart</label></div>';
                htmls += '<div class="pp-col pp-text-field ps12"><label>Customize ' + index + ' Price. &#8377;</label><input placeholder="Price" name="name_prod_custompricebox_' + index.replace(/ /g, '') + '" type="text" class="only-number only-number custom_' + index.replace(/ /g, '') + '_text_field"></div></div>';
            });

            htmls += '<input type="text" name="name_prod_customizesizenames" class="display_none" value="' + select_names + '">';
            $(".customize_size_div").html(htmls);
            //// Set Value In Price Textbox /////
            $(".customize_size_div .customize_size_chart_select").each(function(index, el) {
                $(this).find("option:first").attr("selected", true);

                $("." + $(this).attr('index') + "_text_field").val($('option:selected', this).attr('ct-price'));
            });
            $('.customize_size_div .customize_size_chart_select').material_select();
            $(".customize_size_div").on('change', '.customize_size_chart_select', function(event) {
                $("." + $(this).attr('index') + "_text_field").val($('option:selected', this).attr('ct-price'));
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
                select_names += index.replace(/ /g, '') + '#';
                html += '<div class=" pp-col ps6"><div class="pp-col p-padding_5 card z-depth-1 ps12"><div class="pp-col input-field  ps12"><select name="name_prod_standardselect_' + index.replace(/ /g, '') + '" index="standard_' + index.replace(/ /g, '') + '" class="grey-text ' + index.replace(/ /g, '') + ' standard_size_chart_select material-select">';
                $.each(el, function(indexs, els) {


                    html += '<option st-price="' + els.price + '" value="' + els.id + '">' + els.name + '</option>';
                });
                html += '</select><label>Select ' + index + ' Size Chart</label></div>';
                html += '<div class="pp-col pp-text-field ps12"><label>Standard ' + index + ' Price. &#8377;</label><input placeholder="Price" name="name_prod_standardpricebox_' + index.replace(/ /g, '') + '" type="text" class="only-number standard_' + index.replace(/ /g, '') + '_text_field"></div></div></div>';
            });
            html += '<input type="text" name="name_prod_standardsizenames" class="display_none" value="' + select_names + '">';
            $(".standard_size_div").html(html);
            //// Set Value In Price Textbox /////
            $(".standard_size_div .standard_size_chart_select").each(function(index, el) {
                $(this).find("option:first").attr("selected", true);
                $("." + $(this).attr('index') + "_text_field").val($('option:selected', this).attr('st-price'));
            });
            $('.standard_size_div .standard_size_chart_select').material_select();
            $(".standard_size_div").on('change', '.standard_size_chart_select', function(event) {
                $("." + $(this).attr('index') + "_text_field").val($('option:selected', this).attr('st-price'));
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
$(".product-details .add-product-details-div").on('change', '.detail-select', function(event) {
	event.preventDefault();
	console.log($(this).val());
	if(jQuery.inArray('add_new_detail',$(this).val()) != -1){
var dat_name = $(this).attr('det-name');
var det_data_id = $(this).attr('det-data-id');
$("#add_detail_data_model .nae").text("Add "+dat_name);
$("#add_detail_data_model .det_name").val(det_data_id);
$('#add_detail_data_model').openModal();
	}
});
get_details_field($(".product-details select.main-cat-select").val(),<?php echo json_encode(unserialize($pro_det->product_details)); ?>);
function get_details_field(subcatid,datass = "") {
	console.log(datass);
    $('select.material_select').material_select('destroy');
    $(".product-details .loadder").removeClass('hidden');
    $.post(base_url + '/admin/adminapi', {
        method: 'get_details_field_2',
        sub_cat_id: subcatid
    }, function(data, textStatus, xhr) {
        console.log(data);
        var detail_html = "";
        var input_names = "";
        var required = "";
        $.each(data.fielddata, function(index, el) {
        	var selected_data = [];
if(datass != ""){
$.each(datass,function(index_datas, el_datas) {
if (el_datas.key == el.det_name) {
selected_data = el_datas.value;
}
});
}

            input_names += el.det_name.replace(/ /g, '') + "#";
            detail_html += '<div class="input-field pp-lr-padres pp-col ps3">';

            if (el.type == 'selectmulti') {
                detail_html += '<select det-data-id="'+el.det_data_id+'" det-name="'+el.det_name+'" class="material_select detail-select grey-text text-darken-3 " multiple ';
            }
            if (el.type == 'selectsingle') {
                detail_html += '<select det-data-id="'+el.det_data_id+'" det-name="'+el.det_name+'" class="material_select detail-select grey-text text-darken-3 pp-col ps12" ';
            }
            if (el.req == "1") {
                detail_html += ' required ';
            }
            detail_html += ' name="name_prod_' + el.det_name + '_details[]" ';
            detail_html += ' > ';
            if (el.datas.length != 0 && (el.type == 'selectsingle' || el.type == 'selectmulti')) {
                detail_html += '<option value="" disabled selected>Select</option>';
                $.each(el.datas, function(index1, val) {
detail_html += "<option ";
if(jQuery.inArray(val,selected_data) != -1){
detail_html += " selected ";
	}
               detail_html += "value='" + val + "'>" + val + "</option>";
                });
                detail_html += "<option value='add_new_detail' det-name='"+el.det_name+"'>Add New</option>";
                detail_html += "</select>";
            }
            detail_html += '<label>' + el.det_name + '</label>';
            detail_html += "</div>";
        });
        detail_html += '<input type="text" name="name_prod_detailsnames" class="display_none" value="' + input_names + '">';
        $(".product-details .add-product-details-div").html(detail_html);
        $(".product-details .loadder").addClass('hidden');
        $('select.material_select').material_select();
    }, "json");
    '<option value="1">Option 1</option></select><label>Materialize Multiple Select</label></div>';
}
/////==================== End Get Which detail Fill When  sub cat Change ==============////
/////----------------- Upload Image With Ajax  -----------------------////

// $(".image-upload-box").on('click', '.add-image-button', function(event) {
// 	event.preventDefault();
// 	$(".image-upload-box .image_file_button_2").click();
// });
$(".image_file_button_2").on('change', function(event) {
	var random_time = $.now();
$(".img_loader_div").append('<div class="progress a'+random_time+'"><div class="determinate" style="width: 0%"></div></div>');
    var file_data = $(this).prop('files')[0];
    var form_data = new FormData();
    for (var i = 0; i < event.target.files.length; i++) {
        var file = event.target.files[i];
        if (!file.type.match('image.*')) {
            // Check for File type. the 'type' property is a string, it facilitates usage if match() function to do the matching

            error = 1;
            $(".a"+random_time).remove();
            Materialize.toast("File Is Not Image",3000);
        } else if (file.size > 5048576) {
            error = 1;
            $(".a"+random_time).remove();
            Materialize.toast("Image Size Is To Large",3000);
        } else {
            // If all goes well, append the up-loadable file to FormData object
            form_data.append('imagesFile[]', file, file.name);
            // Comparing it to a standard form submission the 'image' will be name of input
        }
    }

    // alert(form_data);
    $.ajax({
        url: base_url + '/admin/adminapi/upload_image_with_ajax', // point to server-side PHP script
        dataType: 'json', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        xhr: function()
  {
    var xhr = new window.XMLHttpRequest();
    //Upload progress
    xhr.upload.addEventListener("progress", function(event){
      if (event.lengthComputable) {
      var percent = 0;

                var position = event.loaded || event.total;
                var total = event.total;
                if (event.lengthComputable) {
                    percent = Math.ceil(position / total * 100);
                }

                // update progressbar
                $(".a"+random_time +" .determinate").css("width", + percent +"%");
                // $(random_time + " .status").text(percent +"%");
      }
    }, false);
    //Download progress
    xhr.addEventListener("progress", function(event){
      if (event.lengthComputable) {
        var percent = 0;

                var position = event.loaded || event.total;
                var total = event.total;
                if (event.lengthComputable) {
                    percent = Math.ceil(position / total * 100);
                }

                // update progressbar
                $(".a"+random_time +" .determinate").css("width", + percent +"%");
                // $(random_time + " .status").text(percent +"%");
      }
    }, false);
    return xhr;
  },
        success: function(data) {
            console.log(data);
            if (data.response == 'done') {
                var image_path = base_url + 'uploads/pro_image/94_130/' + data.image_names[0];
                var time = $.now();
                var images = $(".images_names").val().split('#');
                images.splice(-1, 1)
                console.log(images.length);
                $(".a"+random_time).remove();
                $(".image-upload-box").append('<div id="'+data.image_names[0]+'" class="pp-col margin-lr-7 zero_padding img-box ps2"><img src="' + image_path + '" img-key="' + time + '" class="responsive-img pp-col ps12 zero_padding "><span class="pp-col  center ps12"><i class="material-icons pointer rem-img-btn pp-margin-t-7 grey-text hover-text-primary text-darkne-1" img-name="'+data.image_names[0]+'" img-key="' + time + '" >delete_forever</i></span></div>');
                var old_value = $(".images_names").val();
                $(".images_names").val(old_value + data.image_names[0] + '#');

                var images = $(".images_names").val().split('#');
                images.splice(-1, 1)

                console.log(images.length);
                if (images.length >= 5) {
                    $(".image-select-button").addClass('hidden');
                } else {
                    $(".image-select-button").removeClass('hidden');
                }
            }
        }
    });
});

$(".image-upload-box").on('click', '.rem-img-btn', function(event) {
    event.preventDefault();
    var img_key = $(this).attr('img-key');
    var img_name = $(this).attr('img-name');
    $(".image-upload-box img[img-key='" + img_key + "']").parent('.img-box').remove();
    var images = $(".images_names").val().split('#');
    images.splice(-1, 1)
    var containe_key = 99;
    // images.splice(img_key, 1);
    $.each(images, function(index, val) {

        if (val == img_name) {
containe_key = index;
        }
    });
    images.splice(containe_key, 1);
    var value = "";
    $.each(images, function(index, val) {
        value += val + "#";
    });
    $(".images_names").val(value);
    console.log($(".images_names").val());
    images = $(".images_names").val().split('#');
    images.splice(-1, 1);
    if (images.length >= 5) {
        $(".image-select-button").addClass('hidden');
    } else {
        $(".image-select-button").removeClass('hidden');
    }
});
/////----------------- End Upload Image With Ajax  -----------------------////
/////====================== On Form Submit =====================////
$('.add_product_submit').on('click', function(event) {
    $("#add_product_form [required]").each(function(index, el) {
        if ($(this).val() === 'undefined' || $(this).val() === "" || !$.trim($(this).val())) {
            var value = $(this).attr('placeholder');
            if (typeof value != 'undefined') {
            	console.log($(this).attr('name'));
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
