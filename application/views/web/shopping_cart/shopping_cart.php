<div class="pp-container">
  <div class="pp-row">
    <?php if ($this->cart->total_items() != "0") {
	?>
    <div class="pp-col g8fs14 font-karla ps12" style="overflow-x: scroll;">
      <table class="bordered">
        <?php
?>
        <thead>
          <tr>
            <th data-field="id">Product</th>
            <th data-field="name">Description</th>
            <th data-field="price">Unit</th>
            <th data-field="price">Unit Price</th>
            <th data-field="price">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
foreach ($this->cart->contents() as $items) {
		$product_url = base_url('product/' . ${"product_data_" . $items['id']}->cat_name . '/' . str_replace(" ", "-", ${"product_data_" . $items['id']}->sub_cat_name) . '/' . ${"product_data_" . $items['id']}->product_sku . '/' . ${"product_data_" . $items['id']}->product_id . '/' . str_replace(" ", "-", ${"product_data_" . $items['id']}->product_name));
		?>
          <tr>
            <td><img class="responsive-img br4" src="<?php echo base_url('uploads/pro_image/94_130/' . $items['image']); ?>" /></td>
            <td style="vertical-align:top;">
              <div>
                <a href="<?php echo $product_url; ?>"><span class="hover-text-primary grey-text text-darken-2 font-600"><?php echo $items['name']; ?></span></a></div>
                <?php
$add_standard_price_array  = array();
		$add_customize_price_array = array();
		if ($this->cart->has_options($items['rowid'])) {
//		print_r($this->cart->product_options($items['rowid']));
			if (!isset($this->cart->product_options($items['rowid'])['single']) || !$this->cart->product_options($items['rowid'])['single']) {

				foreach ($this->cart->product_options($items['rowid']) as $keysingle => $valuesingle) {

					echo ($valuesingle[str_replace(' ', '_', $keysingle) . 'radio'] == 'customize') ?
					"<div><a href='" . site_url('item_mesurement/' . $items['rowid']) . "' ><span class='font-capitalize font13 hover-text-primary grey-text text-darken-3 font-500'>Stitching Type : " . $valuesingle[str_replace(' ', '_', $keysingle) . 'radio'] . " " .
					$keysingle . " </span></a></div>" : "<div><span class='font-capitalize font13 grey-text text-darken-3 font-600'>" .
						$valuesingle[str_replace(' ', '_', $keysingle) . 'radio'] . " " . $keysingle . " </span></div>";
					echo ($valuesingle[str_replace(' ', '_', $keysingle) . 'radio'] == 'customize' && isset(${'customize_mesuare_data_' . $items['id']})) ? "<span class='font-capitalize font12 grey-text text-darken-3'> Stitching Type : " . ${'customize_mesuare_data_' . $items['id']}->name . "</span>" : "";
					if ($valuesingle[str_replace(' ', '_', $keysingle) . 'radio'] == 'standard') {
						$standard_size_for = explode("#", $valuesingle[str_replace(' ', '_', $keysingle) . '_standard_sizes_name']);
						array_pop($standard_size_for);
						array_push($add_standard_price_array, $keysingle);
						foreach ($standard_size_for as $standard_size_for_key => $standard_size_for_value) {
							// print_r($standard_size_for_value);
							//   print_r($keysingle.str_replace(" ","_",$valuesingle));
							echo "<div><span class='font13 grey-text text-darken-2 font-capitalize'> Stitching Type :  " . $standard_size_for_value . " : " . $valuesingle[str_replace(' ', '_', $keysingle) . str_replace(" ", "_", $standard_size_for_value)] . "</span></div>";
						}
					} else if ($valuesingle[str_replace(' ', '_', $keysingle) . 'radio'] == 'customize') {
						array_push($add_customize_price_array, $keysingle);
					}
				}
			}
		}
		?>
              <span class='font-capitalize font13  font-bold'><a class="hover-text-primary grey-text text-darken-3" href="<?php echo site_url('shopping_cart?remove=' . $items['rowid']); ?>"><u>Delete Product</u></a></span>
            </td>
            <td width="140"><div class="pp-col zero_padding margin_top_4per ps12">
              <div class="pp-col gpf center zero_padding g8mtb15">
                <div class="grid gpf g8plr4 g9f  border3-1px  valign-wrapper">
                  <div rowid="<?php echo $items['rowid']; ?>" product-id="<?php echo $items['id']; ?>" class="g8fw500 g8ptb7 g8plr9 pointer stock_minus_button">
                    <center>
                    <span>-</span></center>
                  </div>
                  <div class="g8p0 grid g48">
                    <span rowid="<?php echo $items['rowid']; ?>" product-id="<?php echo $items['id']; ?>" type="text" value="1" class="stock_counter-textbox only-number width_100 pheight_100"><?php echo $items['qty']; ?></span>
                  </div>
                  <div rowid="<?php echo $items['rowid']; ?>" product-id="<?php echo $items['id']; ?>" class="g8fw500 g8ptb7 g8plr9 pointer stock_plus_button ">
                    <center>
                    <span>+</span></center>
                  </div>
                </div>
              </div>
            </div></td>
            <td><span class="unit_price" product-id="<?php echo $items['id']; ?>" price="<?php echo $items['price']; ?>"><?php echo str_replace('Rs', '&#8377; ', $this->ccr->cc('INR', $_SESSION['currency_choose'], $items['price'])); ?></span><?php ?></td>
            <td> <div><span class='grey-text text-darken-2 font13'>
            </span>
            <span product-id="<?php echo $items['id']; ?>" shipping-price="<?php echo $items['ship_charge']; ?>" inter-shipping-charge="<?php echo $items['inter_ship_charge']; ?>" class="total_price"></span></div>
            <?php
if (isset($add_standard_price_array) && !empty($add_standard_price_array)) {
			if (isset(${"standard_data_" . $items['id']})) {
				foreach ($add_standard_price_array as $standard_price_key => $standard_price_value) {
					foreach (${"standard_data_" . $items['id']} as $standard_data_key => $standard_data_value) {
						if ($standard_data_value['name'] == $standard_price_value) {
							echo "<div><span class='grey-text text-darken-2 font13'>" . $standard_price_value . " : </span><span class=' other_service_price' product-id='" . $items['id'] . "' price='" . $standard_data_value['standard_price'] . "'>" . $this->ccr->cc('INR', $_SESSION['currency_choose'], $standard_data_value['standard_price']) . "</span></div>";
						}
					}
				}
			}
		}
		if (isset($add_customize_price_array) && !empty($add_customize_price_array)) {
			if (isset(${"customize_data_" . $items['id']})) {
				foreach ($add_customize_price_array as $standard_price_key => $standard_price_value) {
					foreach (${"customize_data_" . $items['id']} as $customize_data_key => $customize_data_value) {
						if ($customize_data_value['name'] == $standard_price_value) {
							echo "<div><span class='grey-text  text-darken-2 font13'>" . $standard_price_value . " : </span><span class=' other_service_price' product-id='" . $items['id'] . "' price='" . $customize_data_value['customize_price'] . "'>" . $this->ccr->cc('INR', $_SESSION['currency_choose'], $customize_data_value['customize_price']) . "</span></div>";
						}
					}
				}
			}
		}
		?>
          </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
  <div class="pp-col ps12">
    <div class="pp-col ps12 valign-wrapper z-depth-0 border2-1px p-padding_10 card">
      <div class="pp-col ps12 pm12 pl6">
        <form id="add_coupen_code_form" class="pp-form valign-wrapper">
          <div class="pp-col pp-text-field ps11 pm6">
            <input value="<?php echo (isset($_SESSION['cart_coupen_data'])) ? $_SESSION['cart_coupen_data']->code : ''; ?>" placeholder="Enter Coupen" name="coupen_code_text" required type="text" class=" ">
            <input  name="selected_country" value="india" required type="hidden" class="selected_country display_none">
          </div>
          <div class="pp-col pp-text-field ">
            <button class="c-btna g8plr15 width_100 waves-effect waves-light add_product_submit" type="submit" name="add_product_submit">Redeem
            </button>
          </div>
        </form>
		  <?php if (isset($_SESSION['cart_coupen_data'])) {?>
		  <span class="g8fs12 green-text font-karla font-capitalize g8ml11"><?php echo "'" . $_SESSION['cart_coupen_data']->code . "' Coupen Applied."; ?></span>
		  <?php }?>
		<span class="g8fs12 hidden coupen_message_span font-karla font-capitalize g8ml11"></span>
      </div>
      <!--   <div class="pp-col ps12 pm12 pl6">
        <form class="pp-form valign-wrapper">
          <div class="pp-col pp-text-field ps8 pm6">
            <select class="browser-default shipping-country">
              <?php foreach ($countrys as $key => $value) {
		$selected = ($value->name == 'India') ? 'selected' : '';
		echo '<option ' . $selected . ' value="' . strtolower($value->name) . '" >' . $value->name . '</option>';
	}?>
            </select>
          </div>
        </form>
      </div> -->
    </div>
    <div class="pp-col font-karla ps12 p-padding_10 z-depth-0 border2-1px card">
      <div class="pp-col ps6 pm6 pl9 "><span class="right font15">Sub Total:</span></div>
      <div class="pp-col ps6 pm6 pl3 "><span class="right sub_total_price font15">Sub Total:</span></div>
      <?php if (isset($_SESSION['cart_coupen_data'])) {
		if ($_SESSION['cart_coupen_data']->discount_type == 0) {
			$sub_total = $_SESSION['cart_coupen_data']->dis_percet_rs;
		} else if ($_SESSION['cart_coupen_data']->discount_type == 1) {
			$sub_total = ($_SESSION['cart_coupen_data']->dis_percet_rs * $this->cart->total()) / 100;
		}
		?>
      <div class="pp-col ps6 pm6 pl9 "><span class="right font15">Coupen Discount<?php echo ($_SESSION['cart_coupen_data']->discount_type == 1) ? $_SESSION['cart_coupen_data']->dis_percet_rs . '%' : ''; ?>:</span></div>
      <div class="pp-col ps6 pm6 pl3 "><span dis-percet-rs="<?php echo $_SESSION['cart_coupen_data']->dis_percet_rs; ?>" type="<?php echo $_SESSION['cart_coupen_data']->discount_type; ?>" class="right discount_price font15"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $sub_total); ?></span></div>
      <?php }?>
      <div class="pp-col ps6 pm6 pl9"><span class="right font15">Shipping Charge:</span></div>
      <div class="pp-col ps6 pm6 pl3"><span class="right shipping-charge-total font15">Sub Total:</span></div>
      <div class="pp-col ps6 pm6 pl9"><span class="right g8fs20">Total:</span></div>
      <div class="pp-col ps6 pm6 pl3"><span con-format="<?php echo $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']); ?>" con-cor="<?php echo $this->ccr->cc2('INR', $_SESSION['currency_choose'], '1', 1, 1, 0); ?>" class="right total-price-text g8fs20">Sub Total:</span></div>
    </div>
    <div class="pp-col ps12 p-padding_10 z-depth-0 border2-1px card">
      <div class="pp-col ps6"><a href="<?php echo site_url(); ?>" class="btn primary-light">Continue Shopping</a></div>
      <div class="pp-col  ps6">
        <?php
if ($this->pp_login_varified->customer_varified()) {?>
        <a href="<?php echo site_url('checkout'); ?>" class="btn  primary-light right">Proceed to Checkout</a>
        <?php } else {?>
        <button class="btn login_model_call_button primary-light right">Proceed to Checkout</button>
        <?php }
	?>
      </div>
    </div>
  </div>
  <?php } else {?>
  <div class="pp-col p-padding_10 ps12 z-depth-0 border2-1px card">
    <div class="pp-col pp-margin-tb-25 pp-padres ps12">
      <center><span class="g8fs20 font-raleway grey-text font-500 text-darken-2">Your Shopping Cart Is Empty</span></center>
    </div>
    <div class=" p-padding_10 pp-col ps12"><center><img src="<?php echo base_url('assetes/img/cart.png'); ?>" width="150px" class="responsive-img p-padding_10 cart-img" /></center></div>
  </div>
  <?php }?>
</div>
</div>
<style>
.stock_counter-textbox{
padding: 7px;
text-align: center;
}
.stock_button{
padding: 0px 12px !important;
}
.cart-img{
max-width: 200px !important;
}
table{
min-width: 600px;
}
</style>
<script>
$(".stock_minus_button").on('click', function(event) {
event.preventDefault();
var values = parseInt($(".stock_counter-textbox[rowid='"+$(this).attr('rowid')+"']").text()) - 1;
if(values >= 1){
$(".stock_counter-textbox[rowid='"+$(this).attr('rowid')+"']").text(values);
update_to_cart($(this).attr('rowid'),values);
refresh_price();
}
});
$(".stock_plus_button").on('click', function(event) {
event.preventDefault();
var values =  parseInt($(".stock_counter-textbox[rowid='"+$(this).attr('rowid')+"']").text()) + 1;
if(values <= 10){
$(".stock_counter-textbox[rowid='"+$(this).attr('rowid')+"']").text(values);
update_to_cart($(this).attr('rowid'),values);
refresh_price();
}
});
function update_to_cart(rowid,values){
$.post(base_url+'api/cart_api/', {method: 'update_cart_qty',rowids : rowid,qty :values}, function(data, textStatus, xhr) {
console.log(data);
});
}
$(document).ready(function() {
refresh_price();
});
function refresh_price(){
$(".unit_price").each(function(index, el) {
var pro_id  = $(this).attr('product-id');
var price = parseInt($(this).attr('price'));
var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
var unit = parseInt($(".stock_counter-textbox[product-id='"+pro_id+"']").text());
$(".other_service_price[product-id='"+pro_id+"']").each(function(index, el) {
var other_price = $(this).attr('price');
$(this).attr('final-price', unit*other_price);
$(this).html(con_format+(((unit*other_price)*con_cor).toFixed(2)));
});
var aa1 = parseInt($(".total_price[product-id='"+pro_id+"']").attr('shipping-price'));
var aa2 = parseInt($(".total_price[product-id='"+pro_id+"']").attr('inter-shipping-charge'));
$(".total_price[product-id='"+pro_id+"']").attr('new-shipping-price',aa1*unit);
$(".total_price[product-id='"+pro_id+"']").attr('new-inter-shipping-charge',aa2*unit);
$(".total_price[product-id='"+pro_id+"']").attr("final-price",unit*price);
$(".total_price[product-id='"+pro_id+"']").html(con_format+(((unit*price)*con_cor).toFixed(2)));
});
refresh_total_price();
}
function refresh_total_price(){
var final_price = 0;
$("[final-price]").each(function(index, el) {
final_price += parseInt($(this).attr('final-price'));
});
var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
$(".sub_total_price").html(con_format+((final_price*con_cor).toFixed(2)));
if ($(".discount_price").attr('dis-percet-rs') != undefined) {
var discount_per_rs= $(".discount_price").attr('dis-percet-rs');
var discount_type = $(".discount_price").attr('type');
if (discount_type == 0) {
var sub_total = discount_per_rs;
}
else if(discount_type == 1){
var sub_total = (discount_per_rs * final_price) / 100;
}
var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
$(".discount_price").html(con_format+((sub_total*con_cor).toFixed(2)));
$(".discount_price").attr('discount-prices',sub_total);
}
$(".sub_total_price").attr('total-pricess',final_price);
// refresh_totalss_price();
refresh_shipping_price();
}
// $(".shipping-country").on('change', function(event) {
// event.preventDefault();
// $(".selected_country").val($(this).val());
// refresh_shipping_price();
// });
function refresh_shipping_price(){
var ship_country = "<?php echo $_SESSION['ip_country']; ?>";
var charge =  0;
if(ship_country != "IN"){
$("[new-inter-shipping-charge]").each(function(index, el) {
charge += parseInt($(this).attr('new-inter-shipping-charge'));
});
}else if(ship_country == "IN"){
$("[new-shipping-price]").each(function(index, el) {
charge += parseInt($(this).attr('new-shipping-price'));
});
}
$(".shipping-charge-total").attr("total-pricess",charge);
var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
$(".shipping-charge-total").html(con_format+((charge*con_cor).toFixed(2)));
refresh_totalss_price();
}
function refresh_totalss_price(){
var price = 0;
var price2 = parseInt($(".sub_total_price").attr('total-pricess'));
var price1 = parseInt($(".shipping-charge-total").attr("total-pricess"));
if ($(".discount_price").attr('dis-percet-rs') != undefined) {
var discount_price =$(".discount_price").attr('discount-prices');
price = (price1-discount_price)+price2;
}else{
price = price1+price2;
}
var con_cor = $('.total-price-text').attr('con-cor');
var con_format = $('.total-price-text').attr('con-format');
// con_format = con_format.slice(0,-4);
$(".total-price-text").html(con_format+((price*con_cor).toFixed(2)));
}
$("#add_coupen_code_form").on('submit', function(event) {
event.preventDefault();
$(".coupen_message_span").addClass("hidden");
var datas = $(this).serialize();
$.post(base_url+'shopping_cart/add_coupen_code', datas, function(data, textStatus, xhr) {
console.log(data);
$(".coupen_message_span").removeClass("hidden");
if (data == 'done') {

	$(".coupen_message_span").removeClass("red-text");
	$(".coupen_message_span").addClass("green-text");
	$(".coupen_message_span").text("Coupen add Successfully.");
Materialize.toast("Coupen add Successfully.", 3000);
location.reload();
location.href = base_url+'shopping_cart?mes=ca';
}else{
	$(".coupen_message_span").removeClass("green-text");
	$(".coupen_message_span").addClass("red-text");
	$(".coupen_message_span").text(data);
Materialize.toast(data, 3000);
}
});
});
</script>