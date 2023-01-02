<div class="pp-container">
	<input type="text" name="product_id" class="display_none product_id_text" value="<?php echo $product_data->product_id; ?>">
	<div class="pp-row">
		<div class="pp-col ps12 pm12 pl4">
		<?php
$images = unserialize($product_data->pro_imgs);
if (sizeof($images) > 1) {
	?>
			<div class="pp-col zero_padding ps12 pm2 pl2 ">
				<div id="product-image_gal1" class="pp-row  zero_margin">
				<?php
foreach ($images as $key => $value) {
		?>
					<div  class="pp-col zero_padding ps2 pm10 pl11">
						<a href="#" data-image="<?php echo base_url("uploads/pro_image/900_1200/" . $value); ?>" data-zoom-image="<?php echo base_url("uploads/pro_image/orignal/" . $value); ?>">
							<img id="product_image_mains" class="responsive-img p-padding_2  zero_margin card" src="<?php echo base_url("uploads/pro_image/900_1200/" . $value); ?>" />
						</a>
					</div>
					<?php
}
	?>
				</div>
			</div>
			<?php }?>
			<div class="pp-col zero_padding ps12 pm9 pl10">
				<img id="product_image_main" class="responsive-img product_image_main p-padding_1 z-depth-1 zero_margin card width_100" src="<?php echo base_url("uploads/pro_image/900_1200/" . $product_data->pro_img); ?>" data-zoom-image="<?php echo base_url("uploads/pro_image/orignal/" . $product_data->pro_img); ?>"/>
			</div>

		</div>
		<div class="pp-col product_description ps12 pm12 pl8">
			<div class="pp-col ps12">
				<div class="divider opacity0"></div>
				<h5 class="primary-light-text font-responsive-big-title"><?php echo $product_data->product_name; ?></h5>
				<span class="grey-text text-darken-2"><?php echo $product_data->product_desc; ?></span>
				<div class="divider  opacity0"></div>
			</div>

			<div class="pp-col pp-margin-tb-15 ps12">
				<div class="divider  opacity0"></div>
				<div class="pp-col  ps12 pm4 zero_padding">
					<span class=" font21-responsive">
					<?php if (!empty($product_data->mrp) && $product_data->mrp != 0) {?>
					<span class="old-price primary-light-text opacity7 text-lighten-2 " price="<?php echo $product_data->mrp; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $product_data->mrp); ?></span> -<?php }?><span class="new-price main_price primary-light-text " price="<?php echo $product_data->sell_price; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $product_data->sell_price); ?></span></span>
				</div>
				<div class="pp-col font15 font-bold ps12 pm4 time-to-ship-div valign-wrapper zero_padding">
					<span class="valign-wrapper"><i class="material-icons grey-text text-darken-2">av_timer</i></span><span class="grey-text text-darken-2">Time to Ship: </span><span class="primary-light-text"><?php echo $product_data->ship_time; ?> </span>
				</div>
				<div class="divider"></div>
			</div>
			<div class="pp-col   pp-margin-tb-25 ps12">

<div class="pp-col ps3 pl2 pm2 zero_padding  pxl1 font-500">Delivery : </div>
<div class="pp-col ps9 pm6 pl6 pxl4 pincode_div  "><input maxlength="6" placeholder="Enter Delivery Pincode" class="pincode_txb pp-col ps9 only-number" type="text"><span class="font-500 pointer hover-text-primary check_pincode font13">CHECK</span></div>
<div class="pp-col pl12 pxl6 pincode_status  ">
<div class="font13 font-500">Delivery : </div>
</div>
			</div>
			<?php $standard_names = "";
if (!empty($product_data->standard_size_show_in)) {
	?>
			<div class="pp-col pp-margin-tb-15 ps12">
				<?php

	foreach (unserialize(base64_decode($product_data->standard_size_show_in)) as $key => $value0) {
		$standard_data = $standard_sizes[$value0['name']];
		$standard_names .= $standard_data->size_for . "#";
		?>
<form class="size_chart_form">

<div class="zero_padding pp-col  ps12 pm6 pl6">
	<span class="font21-responsive"><?php echo $standard_data->size_for; ?></span>
	<div class="pp-col zero_padding ps12">
		<p>
			<input class="with-gap size_chart_radio" name="<?php echo $standard_data->size_for . "radio"; ?>" this-price="0" checked="checked" value="unstitched" type="radio" id="<?php echo $standard_data->size_for . "0"; ?>" />
			<label for="<?php echo $standard_data->size_for . "0"; ?>">Unstitched<?php echo $standard_data->size_for; ?> Fabric  : <span class="  font-bold grey-text text-darken-2" price="0"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], '0'); ?></span></label>
		</p>
		<p>
			<input class="with-gap size_chart_radio" name="<?php echo $standard_data->size_for . "radio"; ?>" this-price="<?php echo $value0['standard_price']; ?>" value="standard" type="radio" id="<?php echo $standard_data->size_for . "1"; ?>" />
			<label for="<?php echo $standard_data->size_for . "1"; ?>">Standard<?php echo $standard_data->size_for; ?> : <span class=" font-bold grey-text text-darken-2" price="<?php echo $value0['standard_price']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value0['standard_price']); ?></span></label>
		</p>
		<div class="pp-col zero_padding ps12">

				<?php
$standard_size_namesss = "";
		foreach (unserialize(base64_decode($standard_data->fields)) as $key => $value) {
			$standard_size_namesss .= $key . "#";?>

<div class="pp-col ps12 pm8 zero_margin">
					<select name="<?php echo $standard_data->size_for . $key; ?>" class="browser-default<?php echo $standard_data->size_for . "_standard_select"; ?> pp-margin-tb-2 ">
						<option value="none" disabled selected>Select						                                              <?php echo $key; ?></option>
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

		<p>
			<input class="with-gap size_chart_radio" name="<?php echo $standard_data->size_for . "radio"; ?>" this-price="<?php echo $value4['customize_price']; ?>" value="customize" type="radio" id="<?php echo $standard_data->size_for . "2"; ?>"  />
			<label for="<?php echo $standard_data->size_for . "2"; ?>">Customize<?php echo $value4['name']; ?> : <span class=" font-bold grey-text text-darken-2" price="<?php echo $value4['customize_price']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value4['customize_price']); ?></span> </label><br>
			<span class="grey-text font-bold pp-col font12 zero_padding ps8 text-darken-1">Measurement will be ask after click on add to cart button. | Customize stitching will take 4 to 5 days extra.</span>
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
			<div class="pp-col p-padding_10 card ps12">
				<div class="pp-col pp-margin-tb-15 ps12 pm4">
					<span class="font17">Product Price:</span>
					<span con-format="<?php echo $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']); ?>" con-cor="<?php echo $this->ccr->cc2('INR', $_SESSION['currency_choose'], '1', 1, 1, 0); ?>" class="primary-light-text total_price_text  font22" price="<?php echo $product_data->sell_price; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $product_data->sell_price); ?></span>
				</div>
				<div class="pp-col pp-margin-tb-15 ps12 pm3">
					<div class="zero_padding pp-col ps3">
					<center>
						<button class="btn p-padding_2 primary-light stock_minus_button stock_button">-</button></center>
					</div>
					<div class="zero_padding pp-col ps4">
					<input type="text" value="1"  class="stock_counter-textbox only-number width_100 pheight_100" />
				</div>
				<div class="zero_padding pp-col ps3">
					<center>

					<button class="btn p-padding_2 primary-light stock_plus_button stock_button">+</button></center>
				</div>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-15 ps8 pm3">
					<button product-id="<?php echo $product_data->product_id; ?>" class="waves-effect waves-light product_add_to_cart_btn pp-padding-r-15 primary-light btn"><i class="material-icons white-text right">shopping_cart</i>Add To Cart</button>
				</div>

				<div class="pp-col valign-wrapper pp-margin-tb-15  ps3 pm2">
					<button product-id="<?php echo $product_data->product_id; ?>" class="waves-effect btn_like p-padding_lr_1rem waves-light primary-light btn"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
				</div>
				<!-- <div class="pp-col valign-wrapper margin_top_4per  ps3 pm1">
					<a class="waves-effect p-padding_lr_1rem waves-light primary btn"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
				</div>
				<div class="pp-col valign-wrapper margin_top_4per  ps3 pm1">
					<a class="waves-effect p-padding_lr_1rem waves-light primary btn"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div> -->
			</div>
		</div>
	</div>
</div>
<!-- <script type="text/javascript" src="<?php echo base_url("assetes/otherassets/js/jquery.elevatezoom.js"); ?>"></script> -->
<style type="text/css">
.active img{border:2px solid rgb(0,150,136) !important;}
.product_description .old-price{
	text-decoration: line-through;
	margin-right: 10px;
}
.product_description .new-price{
	margin-left: 10px;
	}
	.time-to-ship-div span{
		margin-right: 10px;
	}
	.stock_counter-textbox{
		padding: 7px;
text-align: center;
	}
	.stock_button{
		padding: 0px 12px !important;
	}
	.active_prod_icon{
		color:#333;
	}
	.zoomContainer{
		z-index: 50;
		display: unset;
	}
	.pincode_div{
		padding: 0px 3px;
		border-bottom: 1px solid #B0314F;
	}
	.pincode_txb::-webkit-input-placeholder{
		color: #000;
	}
.pincode_txb::-moz-placeholder{
color: #000;
}
	.pincode_txb {
		background: rgba(0,0,0,0) ;
  display: inline-block;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  padding: 3px 0px;
  border: 0 solid #b7b7b7;
  border-bottom: 0px solid #B0314F;
  font: normal 15px/normal "Comic Sans MS", cursive, sans-serif;
  color: rgba(0,0,0,1);
  -o-text-overflow: clip;
  text-overflow: clip;
  text-shadow: 1px 1px 0 rgba(255,255,255,0.66) ;
  -webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
  -moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
  -o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
  transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
}
	@media only screen and (max-width : 970px) {
	.zoomContainer{
		display: none;
	}
}
</style>

<script type="text/javascript">
var total_forms = 0;
var form_return = 0;
$(document).ready(function(){
	////////// Image Zoom Lense///////
	$("#product_image_main").elevateZoom({responsive:true,imageCrossfade:false,lensFadeIn:true,lensFadeOut:true,zoomWindowFadeIn:true,zoomWindowFadeOut:true,easing:true,gallery:'product-image_gal1', cursor: 'pointer', galleryActiveClass: 'active',zoomWindowWidth:500,zoomWindowHeight:550,borderSize:2,lensOpacity:0.4, lensSize:100,loadingIcon: '',});
	////////// End Image Zoom Lense///////
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
	Materialize.toast("Product Add In Cart.",4000);
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
$html = '<h6 class="g8mt20 font-karla g8fs20">Cart Is Empty</h6><img class="responsive-img" width="70px" src="'+base_url+'assetes/img/cart.png"><div class="divider g8mb10"></div>';
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
	$(".total_price_text").html(con_format+((main_price*con_cor).toFixed(2)));
}

});
</script>
