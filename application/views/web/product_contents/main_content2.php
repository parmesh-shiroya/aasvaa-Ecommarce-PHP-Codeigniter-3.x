
<div class="pp-container">
	<div class="pp-row zero_margin padding-10px ">
		<div class="pp-col  ps12 pm12 pl4">
			<div class="pp-col zero_padding ps12 sticky1">
				<?php
$images = unserialize($product_data->pro_imgs);
if (sizeof($images) > 1) {
	?>
				<div class="pp-col  padding-1px border2-1px zero_padding ps12 pm2 pl2 ">
					<div id="product-image_gal1" class="pp-row  zero_margin">
						<?php
foreach ($images as $key => $value) {
		?>
						<div  class="pp-col border2-1px ps2 pm10 pl12 padding-3px">
							<a href="#" data-image="<?php echo base_url("uploads/pro_image/900_1200/" . $value); ?>" data-zoom-image="<?php echo base_url("uploads/pro_image/orignal/" . $value); ?>">
								<img id="product_image_mains" class="responsive-img   zero_margin card z-depth-0 " src="<?php echo base_url("uploads/pro_image/900_1200/" . $value); ?>" />
							</a>
						</div>
						<?php
}
	?>
					</div>
				</div>
				<?php }?>
				<div class="pp-col zero_padding  ps12 pm9 pl10">
					<div class="pp-col ps12 zero_padding">
						<img id="product_image_main" class="responsive-img product_image_main p-padding_1 z-depth-0 zero_margin card width_100" src="<?php echo base_url("uploads/pro_image/900_1200/" . $product_data->pro_img); ?>" data-zoom-image="<?php echo base_url("uploads/pro_image/orignal/" . $product_data->pro_img); ?>"/>
					</div>
					<div class="pp-col valign-wrapper ps12 pp-margin-t-12 zero_padding">
						<span class="pp-col ps4 zero_padding left grey-text-new font-500 font14"><?php echo $product_data->views; ?> Views</span>
						<div class="left pp-col ps4 pp-padding-l-15 font19">
							<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
						</div>
						<div class="right pp-col ps4">
							<i product-id="<?php echo $product_data->product_id; ?>" class="material-icons sing_prod btn_like hover-text-primary pointer right">favorite_border</i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pp-col zero_padding pp-margin-tb-6 pm12 pl8">
			<div class="pp-row product-side-det zero_margin">
				<div class="pp-col  zero_padding ps12">
					<?php
$bread_cumbs['data'] = array('Home' => site_url(),
	$product_data->cat_name             => base_url('cate/m_cat/' . $product_data->main_cat_id . '/' . $product_data->cat_name),
	$product_data->product_sku          => "");
$this->view('web/product_contents/breadcumbs', $bread_cumbs);?>
				</div>
				<div class="pp-col pp-margin-t-7 ps12">
					<h6 class="font18 line-height1-4 zero_margin"><?php echo $product_data->product_name; ?></h6>
				</div>
				<div class="pp-col pp-margin-t-12 ps12">
					<!-- <div class="data-title pp-col ps105 zero_padding left">Description</div> -->
					<div class="pp-col zero_padding ps12 zero_padding data-desc"><?php echo $product_data->product_desc; ?></div>
				</div>
				<div class="pp-col pp-margin-t-12 ps12">
					<div class="pp-col zero_padding  ps12 pm6 pl605 pxl5">
						<span class="font-500 new-price main_price font24" price="<?php echo $product_data->sell_price; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $product_data->sell_price); ?></span>
						<?php if (!empty($product_data->mrp) && $product_data->mrp != 0) {?>
						<span class="pp-padding-l-12 old-price font16" price="<?php echo $product_data->mrp; ?>"><del><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $product_data->mrp); ?></del></span>
						<?php }?>
						<span class="pp-padding-l-12 font-500 second-accent-color  font16"><?php echo abs(round((($product_data->sell_price * 100) / $product_data->mrp) - 100)); ?>% Off</span>
					</div>
					<div class="pp-col zero_padding valign-wrapper pp-margin-t-7 ps12 pm6 pl505 pxl6">
						<span class="font-500 font14 grey-text">Time to ship :</span> <span class="pp-padding-l-12 font14"><?php echo $product_data->ship_time; ?></span>
					</div>
				</div>
				<div class="pp-col pp-margin-t-12 ps12">
					<div class="pp-col valign-wrapper zero_padding ps12">
						<i class="material-icons second-accent-color">loyalty</i> <span class="font-500 font14 pp-padding-l-12">Coupen offer </span><span class="pp-padding-l-7 font14"> Use Coupen Code (Top100) and get 20% off.</span>
					</div>
					<?php if ($_SESSION['ip_country'] == "IN" && $shipping_charge->domestic_type == "0" && $shipping_charge->domestic_shipping == "0") {?>
					<div class="pp-col margin_t_7 valign-wrapper zero_padding ps12">
						<i class="material-icons second-accent-color">local_shipping</i> <span class="font-500 font14 pp-padding-l-12">Free Shipping</span><span class="pp-padding-l-7 font14">Free Shipping In All India.</span>
					</div>

					<?php }?>
				</div>
				<?Php
if ($_SESSION['ip_country'] == "IN") {
	?>
				<div class="pp-col valign-wrapper pp-margin-t-12 ps12">
					<div class="pp-col valign-wrapper ps12 zero_padding">
						<div class="pp-col ps3 pl105 zero_padding">
							<span class="font-500 font14 grey-text-new">Delivery</span>
						</div>
						<div class="pp-col pl12 pxl10 zero_padding">
							<span class="">
								<input  maxlength="6" placeholder="Enter Delivery Pincode" class="pincode_txb font-fire_sans font15 pp-col ps705 pl4 pxl3 font14 " type="text">
							</span>
							<span shipping_charge_type="<?php echo $shipping_charge->domestic_type; ?>" shipping_charge="<?php echo $shipping_charge->domestic_shipping; ?>" weight="<?php echo $product_data->weight; ?>" class="pp-padding-l-7 center accent_color waves-effect waves-light pincode-check-btn check-button white-text p-padding_tb_7 pointer font11 pp-col ps305 pl105 font-11">Check</span>
							<span class="font14 pp-col ps12 pm6 top-4 pp-padding-l-12 pincode-message font-500"></span>
						</div>
					</div>
				</div>
				<?php }?>
				<div class="pp-col pp-margin-t-7 ps12">
					<?php $standard_names = "";
if (!empty($product_data->standard_size_show_in)) {
	?>
					<div class="pp-col zero_padding pp-margin-tb-15 ps12">
						<?php

	foreach (unserialize(base64_decode($product_data->standard_size_show_in)) as $key => $value0) {
		$standard_data = $standard_sizes[$value0['name']];
		$standard_names .= $standard_data->size_for . "#";
		?>
						<form class="size_chart_form">
							<div class="zero_padding pp-col  ps12 pm6 pl6">

								<span class="font14 grey-text text-darken-2"><?php echo $standard_data->size_for; ?> Stiching</span>
								<div class="pp-col zero_padding ps12">
									<p class="pp-margin-tb-7">
										<input class="with-gap size-radio size_chart_radio" name="<?php echo $standard_data->size_for . "radio"; ?>" this-price="0" checked="checked" value="unstitched" type="radio" id="<?php echo $standard_data->size_for . "0"; ?>" />
										<label for="<?php echo $standard_data->size_for . "0"; ?>"><span class="font13 font-fire_sans grey-text text-darken-1">Unstitched <?php echo $standard_data->size_for; ?> Fabric  : </span><span class="    font-600 font13 grey-text text-darken-1" price="0"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], '0'); ?></span></label>
									</p>
									<p class="pp-margin-tb-7">
										<input class="with-gap size-radio standard-size-radio size_chart_radio" div-class="std-<?php echo str_replace(" ", "_", $standard_data->size_for); ?>" name="<?php echo $standard_data->size_for . "radio"; ?>" this-price="<?php echo $value0['standard_price']; ?>" value="standard" type="radio" id="<?php echo $standard_data->size_for . "1"; ?>" />
										<label for="<?php echo $standard_data->size_for . "1"; ?>"><span class="font13 font-fire_sans grey-text text-darken-1">Standard <?php echo $standard_data->size_for; ?> : </span><span class="   font-600 font13  grey-text text-darken-1" price="<?php echo $value0['standard_price']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value0['standard_price']); ?></span></label>
									</p>
									<div class="pp-col stiching-div std-<?php echo str_replace(" ", "_", $standard_data->size_for); ?> zero_padding ps12">
<?php
$standard_size_namesss = "";

		foreach (unserialize(base64_decode($standard_data->fields)) as $key => $value) {
			$standard_size_namesss .= $key . "#";?>
										<div class="pp-col ps12 pm8 zero_margin">
											<select name="<?php echo $standard_data->size_for . $key; ?>" class="p-padding_tb_0 browser-default pheight_30px zero_padding grey-text text-darken-2  font13<?php echo $standard_data->size_for . "_standard_select"; ?> pp-margin-tb-2 ">
												<option value="none" disabled selected>Select <?php echo $key; ?></option>
												<?php
foreach ($value as $key1 => $value2) {?>
												<option value='<?php echo $value2; ?>'><?php echo $value2; ?></option>
												<?php }
			?>
											</select></div>
											<?php }
		;
		?>
											<input type="text" class="display_none" name="<?php echo $standard_data->size_for . '_standard_sizes_name'; ?>" value="<?php echo $standard_size_namesss; ?>"/>
										</div>
										<?php
$customize_size_name = "";
		if (!empty($product_data->customize_show_in)) {
			foreach (unserialize(base64_decode($product_data->customize_show_in)) as $key4 => $value4) {
				if ($value4['name'] == $value0['name']) {
					$customize_size_name .= $value4['name'];
					?>
										<p class="pp-margin-tb-7">
											<input class="with-gap size-radio size_chart_radio"  name="<?php echo $standard_data->size_for . "radio"; ?>" this-price="<?php echo $value4['customize_price']; ?>" value="customize" type="radio" id="<?php echo $standard_data->size_for . "2"; ?>"  />
											<label for="<?php echo $standard_data->size_for . "2"; ?>"><span class="font13 font-fire_sans grey-text text-darken-1">Customize <?php echo $value4['name']; ?> : </span><span class="font-600 font13  grey-text text-darken-1" price="<?php echo $value4['customize_price']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value4['customize_price']); ?></span> </label><br>
											<span class="grey-text margin_t_7 pp-col font12 zero_padding ps8">Measurement will be ask after click on add to cart button. | Customize stitching will take 4 to 5 days extra.</span>
										</p>
										<?php }}
		}
		?>
									</div>
								</div>
								<input type="text" class="display_none" name="customize_names" value="<?php echo $customize_size_name; ?>"/>
								<input type="text" class="display_none" name="form_for" value="<?php echo $standard_data->size_for; ?>"/>
								<input type="text" name="product_id" class="display_none product_id_text" value="<?php echo $product_data->product_id; ?>">
							</form>
							<?php }?>
						</div>
						<?php }?>
						<input type="text" name="name" class="display_none" id="standad_size_names_textbox" value="<?php echo $standard_names; ?>">
					</div>
					<div class="pp-col pp-margin-t-12 ps12">
						<div class="pp-col p-padding_10 border2-1px card z-depth-0 ps12">
							<div class="pp-col pp-margin-tb-15 ps6 pl4 pxl3">
								<span class="font17 grey-text-new pxs-font13 text-ver-mid">You Pay : </span>
								<span con-format="<?php echo $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']); ?>" con-cor="<?php echo $this->ccr->cc2('INR', $_SESSION['currency_choose'], '1', 1, 1, 0); ?>" class="font-500 total_price_text text-ver-mid font22 pxs-font18" price="<?php echo $product_data->sell_price; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $product_data->sell_price); ?></span>
							</div>
							<div class="pp-col pp-margin-tb-15 ps6 pm3">
								<div class="zero_padding pp-col ps3">
									<center>
									<button class="btn p-padding_2 waves-effect waves-light accent_color font-500 stock_minus_button stock_button">-</button></center>
								</div>
								<div class="zero_padding pp-col ps4">
									<input type="text" value="1"  class="stock_counter-textbox only-number width_100 pheight_100" />
								</div>
								<div class="zero_padding pp-col ps3">
									<center>
									<button class="btn p-padding_2 waves-effect waves-light accent_color font-500 stock_plus_button stock_button">+</button></center>
								</div>
							</div>
							<div class="pp-col center pp-margin-tb-15 ps6 pm205 pxl205">
								<button buynow="0" product-id="<?php echo $product_data->product_id; ?>" class="waves-effect pp-col ps12 waves-light font13 font-500 p-padding_lr_105rem product_add_to_cart_btn  accent_color btn"><i class="material-icons hide_on_large white-text right">shopping_cart</i>Add To Cart</button>
							</div>
							<div class="pp-col center pp-margin-tb-15 ps6 pm205 pxl205">
								<button buynow="true" product-id="<?php echo $product_data->product_id; ?>" class="waves-effect pp-col ps12 waves-light font13 font-500 p-padding_lr_105rem product_add_to_cart_btn  primary-light btn"><i class="white-text hide_on_large right material-icons">shopping_basket</i>Buy Now</button>
							</div>
							<!-- <div class="pp-col valign-wrapper margin_top_4per  ps3 pm1">
													<a class="waves-effect p-padding_lr_1rem waves-light primary btn"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
							</div>
							<div class="pp-col valign-wrapper margin_top_4per  ps3 pm1">
													<a class="waves-effect p-padding_lr_1rem waves-light primary btn"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
							</div> -->
						</div>
					</div>
					<div class="pp-col pp-margin-t-12  ps12">
						<?php
$data['product_data'] = $product_data;
$this->view('web/product_contents/contents/product_details2', $data);?>
					</div>
					<div class="pp-col ps12">
						<div class="pp-col border2-lrb-1px p-padding_tb_12 zero_margin center ps12"><span class="font16 grey-text-new "><i class="material-icons top-4">https</i><span class="pp-padding-l-12">Safe & Secure Payment. Easy Return. 100% Quality Product.</span></span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css" media="screen">
	.active img{border:2px solid #B0314F !important;}
	.product-side-det .data-title{
		width: 110px;
		font-size: 14px;
		color: #878787;
		font-weight: 500;
		font-family: Roboto,Arial,sans-serif;
	}
	.stock_counter-textbox{
			padding: 7px;
	text-align: center;
		}
		.stock_button{
			padding: 0px 12px !important;
		}
		.zoomContainer{
			z-index: 50;
			display: unset;
		}
		@media only screen and (max-width : 970px) {
		.zoomContainer{
			display: none;
		}
	}
	.product-side-det .data-desc{
	font-size: 14px;
	line-height: 1.5em;
	color: #888;
	font-size: 12px;
	}
	.product-side-det .old-price{
		color: #878787;
	}
	.pincode_txb::-webkit-input-placeholder{
			color: #000;
		}
	.pincode_txb::-moz-placeholder{
	color: #000;
	}
		.pincode_txb {
		display: inline-block;
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	padding: 5px 8px !important;
	border: 1px solid #b7b7b7;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	color: rgba(38,38,38,1);
	-o-text-overflow: clip;
	text-overflow: clip;
	text-shadow: 1px 1px 0 rgba(255,255,255,0.66) ;
	-webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
	-moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
	-o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
	transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
	}
	.check-button:hover{
	transition: all .40s;
	background: #3F3F3F;
	}
	.stiching-div{
		display: none;
	}
	.stiching-div.active{
		display: unset;
	}
	.rating {
	unicode-bidi: bidi-override;
	direction: rtl;
	}
	.rating > span {
	display: inline-block;
	position: relative;
	width: 1.1em;
	}
	</style>
	<script>
	var total_forms = 0;
	var form_return = 0;
	var buynow = '0';
		$(document).ready(function() {
			////////// Image Zoom Lense///////
		$("#product_image_main").elevateZoom({responsive:true,imageCrossfade:false,lensFadeIn:true,lensFadeOut:true,zoomWindowFadeIn:true,zoomWindowFadeOut:true,easing:true,gallery:'product-image_gal1', cursor: 'pointer', galleryActiveClass: 'active',zoomWindowWidth:500,zoomWindowHeight:550,borderSize:2,lensOpacity:0.4, lensSize:100,loadingIcon: '',});
		////////// End Image Zoom Lense///////
		$(".size-radio").on('change', function(event) {
			check_standard_tadio();
		});
	function check_standard_tadio(){
		$(".standard-size-radio").each(function(index, el) {
			var classs = $(this).attr('div-class');
	if($(this).is(':checked')) {
	$("."+classs).addClass('active');
	}else{
				$("."+classs).removeClass('active');
			}
		});
	}
		////// Price Seprate
	$(".stock_minus_button").on('click', function(event) {
		event.preventDefault();
		var values = parseInt($(".stock_counter-textbox").val()) - 1;
		if(values >= 1){
			$(".stock_counter-textbox").val(values);
		}
	});
	$(".stock_plus_button").on('click', function(event) {
		event.preventDefault();
		var values =  parseInt($(".stock_counter-textbox").val()) + 1;
		if(values <= 10){
			$(".stock_counter-textbox").val(values);
		}
	});
	$(".product_add_to_cart_btn").on('click', function(event) {
	event.preventDefault();
		//
		buynow = $(this).attr('buynow');
	var standard_size_name_for = $("#standad_size_names_textbox").val();
	var names =  standard_size_name_for.split('#');
		names.splice(-1,1);
	var problem = 0;
	$.each(names,function(index, el) {
				if($("[name='"+el+"radio']:checked").val() == 'standard'){
					$("."+el+"_standard_select").each(function(index, els) {
					if($(this).val() !== null && $(this).val() !== "none"){
					}else{
						problem = 1;
						Materialize.toast($(this).children('option[disabled]').text(),3000);
					}
					});
				}
	});
		if(problem !== 1){
			$.post(base_url+'api/cart_api',{method: 'add_to_cart2',single:'true',product_id:$(".product_id_text").val(),require_stock:$(".stock_counter-textbox").val()}, function(data, textStatus, xhr) {
				console.log(data);
				$(".size_chart_form").append('<input type="hidden" name="cart_row_id" value="'+data.cart_row_id+'">')
				$(".size_chart_form").submit();
				total_forms = $('.size_chart_form').length;
			},"json");
		}
	var require_stock = $(".stock_counter-textbox").val();
	});
	$(".size_chart_form").on('submit', function(event) {
	event.preventDefault();
	var datas = $(this).serialize();
		$.post(base_url+'api/cart_api/add_to_cart_single_product_ci',datas, function(data, textStatus, xhr) {
			console.log(data);
	form_return++;
	if (form_return == total_forms) {
		// location.href = base_url+"shopping_cart";
		if(buynow == 0){
		Materialize.toast("Product Add In Cart.",4000);
	}else{
	location.href=base_url+'shopping_cart';
	}
		get_cart_data();
	}
		});
	});
	$(".size_chart_radio").on('change', function(event) {
		event.preventDefault();
		reffresh_price();
	});
	///============ Get cart Date ===========///
	function get_cart_data(){
	$.post(base_url+'api/cart_api', {method: 'get_cart_ci'}, function(data, textStatus, xhr) {
	if(data !== "" && data !== undefined && data !== null){
	$html = "";
	$.each(data.datas,function(index, el) {
$html += '<div class="c-row gmf z-depth-0 cart-div card hoverable"><div class="grid gpf g124"><div class="grid gpf g13"><img style="width:48px;" class="br3" src="'+base_url+'uploads/pro_image/94_130/'+el.image+'"> </div> <div class="grid gpf g111"> <p class="cart-pro-name wsn oh toe g8ls4 font12">'+el.name+'</p> </div><div class="grid center valign-wraper gf g14"><div class="grid gpf white border-1px center"><div product-id="'+el.id+'" rowid="'+el.rowid+'" class="g8ptb2 font-roboto qty-minus g8fw900 pointer g8fs14 g8plr7 left">-</div><p  rowid="'+el.rowid+'"  product-id="'+el.id+'" class="g8ptb3  stock_counter-div font-roboto g8fw300 g8fs14 g8plr4 cart-pro-name left">'+el.qty+'</p><div product-id="'+el.id+'" rowid="'+el.rowid+'" class="g8ptb2 qty-plus pointer font-roboto g8fw900 g8fs14 g8plr7 left">+</div></div></div> <div class="grid gpf g14"> <p class="cart-pro-name  g8fw500 g8ls10">'+ el.total_price+'</p> </div> <div class="grid gpf g11 valign-wraper"> <p class="cart-pro-name valign"> <i product-id="'+el.id+'" cart-id="'+index+'" class="material-icons g8fs14 grey-text icon-delete">clear</i></p> </div> </div> </div>';
         });
	$(".cart_size_span").text(data.size);
	  $("#cart-div-main .shipping_charges").html(data.shipping_charges);
         $("#cart-div-main .total_prices").html(data.total_price);
         if($html == ""){
$html = '<h6 class="g8mt20 font-karla g8fs20">Cart Is Empty</h6><img class="responsive-img" width="45px" src="'+base_url+'assetes/img/cart.png"><div class="divider g8mb10"></div>';
         }
	$("#cart-div-main-sub").html($html);
	}
	},'json');
	///============ End Get cart Date ===========///
	}
	///////// End Add To Cart //////////////
	function reffresh_price(){
		var standard_size_name_for = $("#standad_size_names_textbox").val();
	var names =  standard_size_name_for.split('#');
		names.splice(-1,1);
	var main_price = parseInt($(".main_price").attr('price'));
	var con_cor = $('.total_price_text').attr('con-cor');
	var con_format = $('.total_price_text').attr('con-format');
	// con_format = con_format.slice(0,-4);
	$.each(names,function(index, el) {
				main_price += parseInt($("[name='"+el+"radio']:checked").attr('this-price'));
	});
		$(".total_price_text").attr('price', 'value');
		$(".total_price_text").html(con_format+" "+((main_price*con_cor).toFixed(2)));
	}
	///// PIncode Check ////
	$(".pincode-check-btn").on('click', function(event) {
		event.preventDefault();
		var shipping_charge_type = $(this).attr('shipping_charge_type');
		var shipping_charge1 = $(this).attr('shipping_charge');
		var pincode = $(".pincode_txb").val();
		var weight = $(this).attr('weight');
		$(".pincode_txb").css('border', '1px solid #b7b7b7');
		$(".pincode-message").css('color', '#212121');
		$(".pincode-message").html("<span class='color-animate-me'>Loading...</span>");
		if (pincode.length <6) {
			$(".pincode_txb").css('border', '1px solid #EA4335');
			$(".pincode-message").css('color', '#EA4335');
			$(".pincode-message").text('Pincode Checking System Is Only For India.')
		}else{
			$.post(base_url+'/zepo/zepo/get_rates_by_pincode/'+pincode+'/'+weight, {param1: 'value1'}, function(data, textStatus, xhr) {
				console.log(data);
				if (data.success == false) {
			$(".pincode_txb").css('border', '1px solid #EA4335');
			$(".pincode-message").css('color', '#EA4335');
			$(".pincode-message").text('Pincode Checking System Is Only For India.')
				}
				if (data[0] != undefined) {
				if (data[0].success == "true") {
					var shipping_charge = "";
		if (shipping_charge_type != '0') {
shipping_charge = ' (&#8377;'+data[0].total_charge+')';
}else if(shipping_charge_type == '0' && shipping_charge1 != "0"){
shipping_charge = ' (&#8377;'+shipping_charge1+')';
}
	if (data[0].expected_delivery_days <= 5) {
	$(".pincode_txb").css('border', '1px solid #b7b7b7');
		$(".pincode-message").css('color', '#212121');

		$(".pincode-message").html('Delivered In 3-4 Days.'+shipping_charge);
	}else if(data[0].expected_delivery_days > 5 && data[0].expected_delivery_days <= 10){
	$(".pincode_txb").css('border', '1px solid #b7b7b7');
		$(".pincode-message").css('color', '#212121');
		$(".pincode-message").html('Delivered In 7-8 Days.'+free_shipping);
	}else{
	$(".pincode_txb").css('border', '1px solid #b7b7b7');
		$(".pincode-message").css('color', '#212121');
		$(".pincode-message").html('Delivered In '+data[0].expected_delivery_days+' Days.'+free_shipping);
	}
				}
				}
			},'json');
		}
	});
	});
	</script>
	<style>
	/* The sticky */
	.sidebar {
	position: -webkit-sticky;
	position: sticky;
	top: 0;
	}
	</style>
	<script>
	$(document).ready(function() {
		$(".sticky1").stick_in_parent();
	});
	</script>