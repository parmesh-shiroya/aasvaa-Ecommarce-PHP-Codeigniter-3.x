<div class="pp-container product_card_container product-box-1-main">
    <div class="pp-row pp-center">
        <?php
foreach ($product->result_array() as $key => $value) {
	$product_url = base_url('product/' . $value['cat_name'] . '/' . str_replace(" ", "-", $value['sub_cat_name']) . '/' . $value['product_sku'] . '/' . $value['product_id'] . '/' . str_replace(" ", "-", $value['product_name']));
	?>
   <div class="pp-col ps6 pm4 pl3 ">
            <div class="card product-card hoverable " card-id="<?php echo $value['product_id']; ?>">
                <div class="card-image waves-effect waves-block waves-light href" href="<?php echo $product_url; ?>">
                    <img src="<?php echo base_url('uploads/pro_image/400_470/' . $value['pro_img']); ?>" class="responsive-img " >
                    <div class="quick_view_button  valign-wrapper ">
                        <div class="valign hide-on-small-only quick_button center-align">
                            <a class="btn btn-raised p-padding_lr_1rem  animated quick_button_btn quick_button_btn_<?php echo $value['product_id']; ?>
                            waves-effect waves-light white-trans-btn btn-small tooltipped" prod-id="<?php echo $value['product_id']; ?>" data-position="top" data-delay="50" data-tooltip="Quick View">Quick View</a>
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
                           <div  class="new-tag"">NEW</div>
                            <?php }?>
                    </div>
                </div>
                <div class="card-content lar_padding_13 esml_padding_10">
                    <div class="pp-row zero_margin content-row">
                        <div class="pp-col zero_padding ps12">
                            <a href="<?php echo $product_url; ?>"><h6 class="font-responsive-title zero_margin font-500 grey-text text-darken-2"><?php echo $value['product_name'] ?></h6></a>
                        </div>

                    </div>
                </div>
                <div class="card-action lar_padding_13 esml_padding_10">
                    <div class="pp-row valign-wrapper zero_margin">
                        <div class="pp-col padding_lr_responsive ps14 pm8 pl8"><?php if (!empty($value['mrp']) && $value != 0) {?><span  class="orange-text  text-lighten-2 old-price" price="<?php echo $value['mrp']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value['mrp']); ?></span><?php }?> <span class="orange-text   new-price" price="<?php echo $value['sell_price']; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value['sell_price']); ?></span>
                        </div>
                        <div class="pp-col padding_lr_responsive ps4 pm2 pl2  btn_like tooltipped waves-effect" data-position="bottom"  product-id="<?php echo $value['product_id']; ?>" data-delay="50" data-tooltip="Like"><i  class=" material-icons">thumb_up</i></div>
<?php /*                        <div class="pp-col padding_lr_responsive ps4 pm2 pl2 btn_add_to_cart tooltipped waves-effect" product-id="<?php echo $value['product_id']; ?>"  data-position="bottom" data-delay="50" data-tooltip="Add To Cart"><i class=" material-icons ">shopping_cart</i></div> */?>
                        <div class="pp-col padding_lr_responsive ps4 pm2 pl2 waves-effect tooltipped"  data-position="bottom" data-delay="50" data-tooltip="Add To Compare"><i class=" material-icons ">swap_horiz</i></div>
                    </div>
                </div>

            </div>
        </div>
        <?php
}
?>
    </div>
</div>
<!-- add assete -->
