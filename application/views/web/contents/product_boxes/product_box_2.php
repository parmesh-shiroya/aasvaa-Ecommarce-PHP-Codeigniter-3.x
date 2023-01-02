<div class="pp-container product_card_container product-box-1-main product-box-2-main ">
    <div class="pp-row zero_margin pp-center">
    <?php if (isset($product_by) && !empty($product->result_array()) && !empty($product_by)) {
	switch ($product_by['show_product_by']) {
	case 'new_product':
	case 'most_viewed':
	case 'most_sell':
	case 'ready_to_ship':

		echo '<div class="pp-col zero_padding ps12 "><h6 class="centr g8mb0 primary-light-text primary-card g8pl21 font-open_sans whie-text white font20 border2-1px bb0 p-padding_tb_9">' . $this->pp_loader_helper->product_slider_title_writer($product_by['show_product_by']) . '</h6></div>';
		break;
	default:
		# code...
		break;
	}
}?>
<div class="white pp-row ps12 zero_margin border2-1px bt0">
<?php
foreach ($product->result_array() as $key => $value) {
	$product_url = base_url('product/' . $value['cat_name'] . '/' . str_replace(" ", "-", $value['sub_cat_name']) . '/' . $value['product_sku'] . '/' . $value['product_id'] . '/' . str_replace(" ", "-", $value['product_name']));
	?>


        <div class="pp-col ps6 pm4 pl3">
            <div class="card border-1px g8mt0 product-card z-depth-0 " card-id="<?php echo $value['product_id']; ?>">
                <div class="card-image waves-effect waves-block waves-light href" href="<?php echo $product_url; ?>">
                    <img src="<?php echo base_url('uploads/pro_image/400_470/' . $value['pro_img']); ?>" class="responsive-img " >
                    <div class="quick_view_button  valign-wrapper ">
                        <div class="valign hide-on-small-only quick_button center-align">
                            <a class="btn btn-raised p-padding_lr_1rem  animated quick_button_btn quick_button_btn_<?php echo $value['product_id']; ?>
                            waves-effect waves-light white-trans-btn btn-small " prod-id="<?php echo $value['product_id']; ?>">Quick View</a>
                        </div>
                         <?php if (!empty($value['mrp']) && $value['mrp'] != 0) {?>

	<div class="off-tag"><?php echo abs(round((($value['sell_price'] * 100) / $value['mrp']) - 100)); ?>% Off</div>
	<?php }?>
                            <?php
$now       = time();
	$your_date = strtotime(date('Y-m-d', strtotime($value['date'])));
	$datediff  = $now - $your_date;
	$diff_days = floor($datediff / (60 * 60 * 24));
	if ($diff_days <= 7) {?>
                           <div  class="new-tag">NEW</div>
                            <?php }?>
                    </div>
                </div>
                <div class="card-content lar_padding_13 esml_padding_10">
                    <div class="pp-row zero_margin content-row">
                        <div class="pp-col zero_padding ps12">
                            <a href="<?php echo $product_url; ?>"><h6 class="font-responsive-title zero_margin font-500 product-name wsn oh toe grey-text text-darken-2"><?php echo $value['product_name'] ?></h6></a>
                        </div>

                    </div>
                </div>
                <div class="card-action lar_padding_13 esml_padding_10">
                    <div class="pp-row valign-wrapper zero_margin">
                        <div class="pp-col padding_lr_responsive ps10 pm10 pl10"><?php if (!empty($value['mrp']) && $value != 0) {?><span  class="accent-text opacity5  old-price" price="<?php echo $value['mrp']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value['mrp']); ?></span><?php }?> <span class="accent-text opacity9  new-price" price="<?php echo $value['sell_price']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value['sell_price']); ?></span>
                        </div>
                        <?php if (!empty($value['mrp']) && $value['mrp'] != 0) {
		?>
                        <div product-id="<?php echo $value['product_id']; ?>" class="pp-col zero_padding hide-on-medium-max padding_lr_responsive ps4 pm2 pl2 ">
                        <span class='orange-text'>
<?php
echo (($value['sell_price'] * 100) / $value['mrp']) - 100;

		?>
        % Off</span>
                        </div>
                        <?php }?>
                        <div class="pp-col padding_lr_responsive ps4 pm2 pl2  btn_like "   product-id="<?php echo $value['product_id']; ?>" ><i  class=" material-icons">favorite_border</i></div>
 <?php /*                        <div class="pp-col pp-hide-small-min padding_lr_responsive ps4 pm2 pl2 btn_add_to_cart  " product-id="<?php echo $value['product_id']; ?>" ><i class=" material-icons ">shopping_cart</i></div> */?>
                        <!-- <div class="pp-col pp-hide-small-min padding_lr_responsive ps4 pm2 pl2 waves-effect tooltipped"  data-position="bottom" data-delay="50" data-tooltip="Add To Compare"><i class=" material-icons ">swap_horiz</i></div> -->
                    </div>
                </div>

            </div>
        </div>
        <?php
}
?>
</div>
    </div>

</div>
<!-- add assete -->

<style type="text/css" media="screen">
.product-box-2-main .product-card{
	transition: all .10s;
}
.product-box-2-main .product-card:hover{
	border: solid 2px rgb(152,25,55);
}

</style>

<script>

var b_width = $( window ).width();
if (b_width <= 1300 && b_width >= 490) {
    $(".product-box-2-main .product-name").each(function(index, el) {
        var name = $(this).text();
        if (name.length > 45) {
            $(this).text(name.substring(0, 45)+"...");
        }
    });
    }
    if (b_width <= 490) {
    $(".product-box-2-main .product-name").each(function(index, el) {
        var name = $(this).text();
        if (name.length > 30) {
            $(this).text(name.substring(0, 30)+"...");
        }
    });
    }
</script>