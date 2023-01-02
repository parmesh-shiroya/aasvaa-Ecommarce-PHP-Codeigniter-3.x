<?php
if (!empty($slider_product)) {
	$random = rand()
	?>

<div class="pp-container g8mtb30 product_slider_1_main_div">
   <div class="pp-row zero_margin">
   <?php if (isset($slider_product_by) && !empty($slider_product) && !empty($slider_product_by)) {
		switch ($slider_product_by['show_product_by']) {
		case 'new_product':
		case 'most_viewed':
		case 'most_sell':
		case 'ready_to_ship':

			echo '<div class="pp-col primary-light-text  white border2-1px primary-card zero_padding  ps12 "><h6 class="centr g8mtb0 font-open_sans left  g8pl21  whie-text  font20 p-padding_tb_9 ">' . $this->pp_loader_helper->product_slider_title_writer($slider_product_by['show_product_by']) . '</h6><div class="g8pt3 right valign-wrapper pointer g8pr21"><i class="fa fa-arrow-left ca prev_slider_' . $random . ' g8p10"></i><i class="ca fa fa-arrow-right pointer next_slider_' . $random . ' g8p10"></i></div></div>';
			break;
		default:
			# code...
			break;
		}
	}?>

      <div class="pp-col white border2-1px bt0 zero_padding ps12">
         <div id="product_slider_<?php echo $random; ?>" class="owl-carousel">
            <?php

	foreach ($slider_product as $key => $value) {
		$product_url = base_url('product/' . $value->cat_name . '/' . str_replace(" ", "-", $value->sub_cat_name) . '/' . $value->product_sku . '/' . $value->product_id . '/' . str_replace(" ", "-", $value->product_name));
		?>
<div>
               <div class="pp-col ps12 ">
            <div class="card product-card z-depth-0 border-1px " card-id="<?php echo $value->product_id; ?>">
                <div class="card-image waves-effect waves-block waves-light href" href="<?php echo $product_url; ?>">
                    <img src="<?php echo base_url('uploads/pro_image/400_470/' . $value->pro_img); ?>" class="responsive-img ">
                    <div class="quick_view_button valign-wrapper ">
                        <div class="valign hide-on-small-only  quick_button center-align">
                           <a class="btn btn-raised p-padding_lr_1rem  btn-small animated quick_button_btn quick_button_btn_<?php echo $value->product_id; ?> waves-effect waves-light white-trans-btn  fadeOut" prod-id="<?php echo $value->product_id; ?>">Quick View</a>
                        </div>
                         <?php if (!empty($value->mrp) && $value->mrp != 0) {?>

		<div class="off-tag"><?php echo abs(round((($value->sell_price * 100) / $value->mrp) - 100)); ?>% Off</div>
		<?php }?>
                            <?php
$now       = time();
		$your_date = strtotime(date('Y-m-d', strtotime($value->date)));
		$datediff  = $now - $your_date;
		$diff_days = floor($datediff / (60 * 60 * 24));
		if ($diff_days <= 7) {?>
                           <div  class="new-tag">NEW</div>
                            <?php }?>
                    </div>
                </div>
                <div class="card-content p-padding_10 esml_padding_10">
                    <div class="pp-row zero_margin content-row">
                        <div class="pp-col zero_padding ps12">
                            <a href="<?php echo $product_url; ?>"><h6 class="font13 wsn oh toe grey-text text-darken-2"><b><?php echo $value->product_name; ?></b></h6></a>
                        </div>

                    </div>
                </div>
                <div class="card-action p-padding_10 esml_padding_10">
                    <div class="pp-row valign-wrapper zero_margin">
                        <div class="pp-col p-padding_2 ps14 pm10 pl10">
                        <?php if (!empty($value->mrp) && $value->mrp != 0) {?>
                        <span class="accent-text opacity5 old-price" price="<?php echo $value->mrp; ?>">
                            <?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value->mrp); ?>
                        </span><?php }?> <span class="accent-text opacity9  new-price" price="<?php echo $value->sell_price; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value->sell_price); ?></span></div>
                        <div class="pp-col p-padding_2 ps4 pm2 pl2 btn_like "  product-id="<?php echo $value->product_id; ?>" ><i class="material-icons">favorite_border</i></div>
<?php /*                        <div product-id="<?php echo $value->product_id; ?>" class="pp-col btn_add_to_cart p-padding_2  ps4 pm2 pl2"><i class="material-icons">shopping_cart</i></div> */?>
                        <!-- <div class="pp-col p-padding_2 ps4 pm2 pl2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Add To Compare"><i class="material-icons">swap_horiz</i></div> -->
                    </div>
                </div>

            </div>
        </div></div>
        <?php }?>

</div>
</div>
</div>
</div>


<style type="text/css" media="screen">
.product_slider_1_main_div .product-card{
    transition: all .10s;
}
.product_slider_1_main_div .product-card:hover{
    border: solid 2px rgb(152,25,55);
}

</style>


<script>
$(document).ready(function() {
var owl = $("#product_slider_<?php echo $random; ?>");

owl.owlCarousel({autoPlay:3000,    responsiveClass:true,stopOnHover:true,navigation:false,pagination:false});
$('.next_slider_<?php echo $random; ?>').on('click', function(event) {
owl.trigger('owl.next');
});
$('.prev_slider_<?php echo $random; ?>').on('click', function(event) {
owl.trigger('owl.prev');
});

});
</script>
<?php }?>