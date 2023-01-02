<div class="pp-row width_100 zero_margin">
  <img src="<?php echo base_url('uploads/banner/main_cat_banner/1300_250/' . $banner_link->b_values); ?>" width="100%">
</div>
<div class="pp-container full_on_large_and_small">
  <div class="pp-row">
    <div class="pp-col hide_on_large zero_padding pl2">
      <div class=" radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
        <div class=" radius-0  zero_margin p-padding_5 pp-col ps12">
          <span class="font-16 ">Price</span>
        </div>
        <div style="overflow-y:hidden;" class=" filter-card radius-0 p-padding_10 zero_margin pp-col ps12">
        <!-- $this->ccr->cc('INR', $_SESSION['currency_choose'], ) -->
          <div style="margin:0px 0px 10px 0px;" class="pp-col zero_padding ps12">
            <span class="font12 grey-text text-darken-1">Price range: <span class="min-price-span"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $select_min_price); ?></span> -  <span class="max-price-span"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $select_max_price); ?></span></span>
          </div>
          <div class="pp-col zero_padding ps12"  style="margin-left: 7px;">
            <div type="range" con-format="<?php echo $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']); ?>" con-cor="<?php echo $this->ccr->cc2('INR', $_SESSION['currency_choose'], '1', 1, 1, 0); ?>" select-min="<?php echo $select_min_price; ?>" select-max="<?php echo $select_max_price; ?>" mini="<?php echo $min_price; ?>" maximum="<?php echo $max_price; ?>" id="price_ranger"></div>
          </div>
        </div>
      </div>
      <?php if (!empty($filter_data['fabric_array'])) {
	?>
      <div class=" radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
        <div class=" radius-0  zero_margin p-padding_5 pp-col ps12">
          <span class="font-16 " >Fabric</span>
        </div>
        <div class=" filter-card radius-0 zero_padding zero_margin pp-col ps12">
          <ul class="zero_margin font-roboto_slab filter_options_ul">
            <?php foreach ($filter_data['fabric_array'] as $key => $value) {
		?>
            <li><input type="checkbox"
              <?php
if (isset($_SESSION['filter']['Fabric']) && in_array($value, $_SESSION['filter']['Fabric'])) {
			echo " checked='checked' ";
		}
		?>
              key="Fabric" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="fabric-box_<?php echo $key; ?>"  />
              <label class="font13 font-capitalize" for="fabric-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
              <?php }?>
            </ul>
          </div>
        </div>
        <?php }if (!empty($filter_data['color_array'])) {
	?>
        <div class=" radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
          <div class=" radius-0  zero_margin p-padding_5 pp-col ps12">
            <span class="font-16 ">Color</span>
          </div>
          <div class=" filter-card radius-0 zero_padding zero_margin pp-col ps12">
            <ul class="zero_margin font-roboto_slab filter_options_ul">
              <?php foreach ($filter_data['color_array'] as $key => $value) {
		?>
              <li><input type="checkbox"
                <?php
if (isset($_SESSION['filter']['Color']) && in_array($value, $_SESSION['filter']['Color'])) {
			echo " checked='checked' ";
		}
		?> key="Color" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="color-box_<?php echo $key; ?>"  />
                <label class="font13 font-capitalize" for="color-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                <?php }?>
              </ul>
            </div>
          </div>
          <?php }
if (!empty($filter_data['celebrity_array'])) {
	?>
          <div class=" radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
            <div class=" radius-0  zero_margin p-padding_5 pp-col ps12">
              <span class="font-16 " >Celebrity</span>
            </div>
            <div class=" filter-card radius-0 zero_padding zero_margin pp-col ps12">
              <ul class="zero_margin font-roboto_slab filter_options_ul">
                <?php foreach ($filter_data['celebrity_array'] as $key => $value) {
		?>
                <li><input<?php
if (isset($_SESSION['filter']['Celebrity']) && in_array($value, $_SESSION['filter']['Celebrity'])) {
			echo " checked='checked' ";
		}
		?> type="checkbox" key="Celebrity" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="celebrity-box_<?php echo $key; ?>"  />
                  <label class="font13 font-capitalize" for="celebrity-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                  <?php }?>
                </ul>
              </div>
            </div>
            <?php }if (!empty($filter_data['occasion_array'])) {
	?>
            <div class=" radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
              <div class=" radius-0  zero_margin p-padding_5 pp-col ps12">
                <span class="font-16 " >Occasion</span>
              </div>
              <div class=" filter-card radius-0 zero_padding zero_margin pp-col ps12">
                <ul class="zero_margin font-roboto_slab filter_options_ul">
                  <?php foreach ($filter_data['occasion_array'] as $key => $value) {
		?>
                  <li><input<?php
if (isset($_SESSION['filter']['Occasion']) && in_array($value, $_SESSION['filter']['Occasion'])) {
			echo " checked='checked' ";
		}
		?> type="checkbox" key="Occasion" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="occasion-box_<?php echo $key; ?>"  />
                    <label class="font13 font-capitalize" for="occasion-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                    <?php }?>
                  </ul>
                </div>
              </div>
              <?php }if (!empty($filter_data['style_array'])) {
	?>
              <div class=" radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
                <div class=" radius-0  zero_margin p-padding_5 pp-col ps12">
                  <span class="font-16 " >Style</span>
                </div>
                <div class=" filter-card radius-0 zero_padding zero_margin pp-col ps12">
                  <ul class="zero_margin font-roboto_slab filter_options_ul">
                    <?php foreach ($filter_data['style_array'] as $key => $value) {
		?>
                    <li><input<?php
if (isset($_SESSION['filter']['Style']) && in_array($value, $_SESSION['filter']['Style'])) {
			echo " checked='checked' ";
		}
		?> type="checkbox" key="Style" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="style-box_<?php echo $key; ?>"  />
                      <label class="font13 font-capitalize" for="style-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                      <?php }?>
                    </ul>
                  </div>
                </div>
                <?php }if (!empty($filter_data['work_array'])) {
	?>
                <div class=" radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
                  <div class=" radius-0  zero_margin p-padding_5 pp-col ps12">
                    <span class="font-16 " >Work</span>
                  </div>
                  <div class=" filter-card radius-0 zero_padding zero_margin pp-col ps12">
                    <ul class="zero_margin font-roboto_slab filter_options_ul">
                      <?php foreach ($filter_data['work_array'] as $key => $value) {
		?>
                      <li><input<?php
if (isset($_SESSION['filter']['Work']) && in_array($value, $_SESSION['filter']['Work'])) {
			echo " checked='checked' ";
		}
		?> type="checkbox" key="Work" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="work-box_<?php echo $key; ?>"  />
                        <label class="font13 font-capitalize" for="work-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                        <?php }?>
                      </ul>
                    </div>
                  </div>
                  <?php }if (!empty($shipp_time_filter)) {
	?>
                <div class=" radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
                  <div class=" radius-0  zero_margin p-padding_5 pp-col ps12">
                    <span class="font-16 " >Shipping Time</span>
                  </div>
                  <div class=" filter-card radius-0 zero_padding zero_margin pp-col ps12">
                    <ul class="zero_margin font-roboto_slab filter_options_ul">
                      <?php foreach ($shipp_time_filter as $key => $value) {
		?>
                      <li><input<?php
if (isset($_SESSION['single_filter']['Shipping_time']) && in_array($value['ship_time'], $_SESSION['single_filter']['Shipping_time'])) {
			echo " checked='checked' ";
		}
		?> type="checkbox" key="Shipping_time" vals="<?php echo $value['ship_time']; ?>" class="filled-n shipping-filter-checkbox" id="shipping-time-box_<?php echo $key; ?>"  />
                        <label class="font13 font-capitalize" for="shipping-time-box_<?php echo $key; ?>"><?php echo $value['ship_time']; ?></label></li>
                        <?php }?>
                      </ul>
                    </div>
                  </div>
                  <?php }if (!empty($filter_data['catalog_array'])) {
	?>
                  <div class=" hidden radius-0 z-depth-0 filter_card_main zero_padding pp-col ps12">
                    <div class=" radius-0  zero_margin p-padding_5 pp-col ps12">
                      <span class="font-16 " >Catalog</span>
                    </div>
                    <div class=" filter-card radius-0 zero_padding zero_margin pp-col ps12">
                      <ul class="zero_margin font-roboto_slab filter_options_ul">
                        <?php foreach ($filter_data['catalog_array'] as $key => $value) {
		?>
                        <li><input<?php
if (isset($_SESSION['filter']['CatalogName']) && in_array($value, $_SESSION['filter']['CatalogName'])) {
			echo " checked='checked' ";
		}
		?> type="checkbox" key="CatalogName" vals="<?php echo $value; ?>" class="filled-n filter-checkbox" id="catalog-box_<?php echo $key; ?>"  />
                          <label class="font13 font-capitalize" for="catalog-box_<?php echo $key; ?>"><?php echo $value; ?></label></li>
                          <?php }?>
                        </ul>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <div class="pp-col pm12 pl12 pxl10">
                  <div class="pp-col valgn-wrapper ps12 zero_padding">
                  <div class="pp-col valign-wrapper pm12 pl4 grey-text text-darken-1">
<span class="primary-text font24 font-roboto_slab font-capitalize"><?php echo (isset($category_name) ? str_replace("%20", " ", $category_name) : ""); ?></span>
                  </div>
                  <div class="pp-col ps12 pm12 pl8 right grey-text text-darken-1">
                  <span class="right custom_filter_div"><a class="hover-text-primary
<?php if (isset($_GET['cust']) && $_GET['cust'] == "phtl") {
	echo "primary-text";
} else {
	echo "grey-text text-darken-1";
}?>
" href="<?php echo $current_url . "?cust=phtl"; ?>">Price High to Low</a></span>
                  <span class=" right custom_filter_div"><a class="hover-text-primary
<?php if (isset($_GET['cust']) && $_GET['cust'] == "plth") {
	echo "primary-text";
} else {
	echo "grey-text text-darken-1";
}?>
                   " href="<?php echo $current_url . "?cust=plth"; ?>">Price Low to High</a></span>
                  <span class=" right custom_filter_div"><a class="hover-text-primary
<?php if (isset($_GET['cust']) && $_GET['cust'] == "l") {
	echo "primary-text";
} else {
	echo "grey-text text-darken-1";
}?>" href="<?php echo $current_url . "?cust=l"; ?>">Latest</a></span>
                  </div>
                  </div>
                  <div class="pp-col ps12 zero_padding product_card_container product-box-1-main produc-box-2-main">
                    <?php
if (empty($product)) {?>
                      <div class="pp-col center pp-margin-tb-25 pp-padres ps12 "><h6 class="font24 font-raleway grey-text text-darken-2 ">Sorry No Product Found.</h6></div>
                    <?php }
foreach ($product as $key => $value) {
	$product_url = base_url('product/' . $value->cat_name . '/' . str_replace(" ", "-", $value->sub_cat_name) . '/' . $value->product_sku . '/' . $value->product_id . '/' . str_replace(" ", "-", $value->product_name));
	?>
                    <div class="pp-col ps6 pm4 pl3 pxl3 same_height_main min_height_495 product_boxssss" same-class="product_boxssss">
                      <div class="card product-card border-1px z-depth-0 " card-id="<?php echo $value->product_id; ?>">
                        <div class="card-image waves-effect waves-block waves-light href" href="<?php echo $product_url; ?>">
                          <img src="<?php echo base_url('uploads/pro_image/400_470/' . $value->pro_img); ?>" class="responsive-img ">
                          <div class="quick_view_button  valign-wrapper ">
                            <div class="valign hide-on-small-only quick_button center-align">
                              <a class="btn  p-padding_lr_1rem btn-raised btn-small animated quick_button_btn quick_button_btn_<?php echo $value->product_id; ?> waves-effect waves-light white-trans-btn  fadeOut" prod-id="<?php echo $value->product_id; ?>" >Quick View</a>
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
                           <div class="new-tag">NEW</div>
                            <?php }?>
                          </div>
                        </div>
                        <div class="card-content p-padding_10 esml_padding_10">
                          <div class="pp-row zero_margin content-row">
                            <div class="pp-col zero_padding ps12">
                              <a href="<?php echo $product_url; ?>"><h6 style=" overflow-y:hidden;" class="font-responsive-title wsn oh toe zero_margin font-500 product-name grey-text text-darken-2"><?php echo $value->product_name; ?></h6></a>
                            </div>
                          </div>
                        </div>
                        <div class="card-action p-padding_10 esml_padding_10">
                          <div class="pp-row valign-wrapper zero_margin">
                            <div class="pp-col p-padding_2 ps10 pm10 pl10">
                            <?php if (!empty($value->mrp) && $value->mrp != 0) {?> <span class="accent-text opacity5  old-price" price="<?php echo $value->mrp; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value->mrp); ?></span><?php }?> <span class="accent-text opacity9   new-price" price="<?php echo $value->sell_price; ?>"><?php echo $this->ccr->cc('INR', $_SESSION['currency_choose'], $value->sell_price); ?></span></div>
                            <div class="pp-col p-padding_2 ps4 pm2 pl2 btn_like tooltipped" data-position="bottom" product-id="<?php echo $value->product_id; ?>" data-delay="50" data-tooltip="Like"><i class="material-icons">favorite_border</i></div>
                         <?php /*   <div product-id="<?php echo $value->product_id; ?>" class="pp-col pp-hide-small-min btn_add_to_cart p-padding_2 tooltipped ps4 pm2 pl2" data-position="bottom" data-delay="50" data-tooltip="Add To Cart"><i class="material-icons">shopping_cart</i></div> */?>
                            <!-- <div class="pp-col p-padding_2 pp-hide-small-min ps4 pm2 pl2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Add To Compare"><i class="material-icons">swap_horiz</i></div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                </div>
              </div>
              </div>
              <style type="text/css" media="screen">
.product_boxssss .product-card{
    transition: all .10s;
}
.product_boxssss .product-card:hover{
    border: solid 2px rgb(152,25,55);
}

</style>
              <style>
              .main{
                background: #fff;
              }
              .filter_options_ul>li{
              padding: 5px 13px;
              border-bottom: solid 1px #fff;
              }
              .filter_options_ul>li label{
              color: #888;
              transition: all .40s;
              }
              .filter_options_ul>li label:hover{
              color: rgb(152,25,55);
              }
              .filter-card{
              max-height: 220px;
              overflow-y: auto;
              }
              .noUi-target{
              height: 10px !important;
              }
              .noUi-handle{
              border-radius: 52px !important;
              height: 20px !important;
              width: 20px !important;
              }
              .filter_card_main{
              margin: 10px 0px;
              }
              .filter_card_main>div>span{
                color: rgb(152,25,55);
                font-weight: 500;
              }
              .min_height_495{
                /* min-height: 495px; */
              }
              .max_height_480{
                max-height: 480px;
              }
              .custom_filter_div{
                border-right: 1px solid #bbb;
                padding-right: 10px;
                padding-left: 10px;
                margin-top: 10px;
                margin-bottom: 10px;
              }

              .product-box-2-main .product-card{
  transition: all .40s;
}
.product-box-2-main .product-card:hover{
  border: solid 1px rgb(152,25,55);
}
              </style>
              <script>
              $(document).ready(function() {
              $(".filter-checkbox").on('change', function(event) {
              event.preventDefault();
              var key = $(this).attr('key');
              var valuess = $(this).attr('vals');
              if(this.checked){
              $.post(base_url+'api/cate_filter',{method:'add_filter_data',keys:key,value:valuess},function(data, textStatus, xhr) {
              location.href = "<?php echo $current_url ?>";
              });
              }else{
              $.post(base_url+'api/cate_filter',{method:'remove_filter_data',keys:key,value:valuess},function(data, textStatus, xhr) {
              location.href = "<?php echo $current_url ?>";
              });
              }
              });

                   $(".shipping-filter-checkbox").on('change', function(event) {
              event.preventDefault();
              var key = $(this).attr('key');
              var valuess = $(this).attr('vals');
              if(this.checked){
              $.post(base_url+'api/cate_filter',{method:'add_ship_time_filter',keys:key,value:valuess},function(data, textStatus, xhr) {
              location.href = "<?php echo $current_url ?>";
              });
              }else{
              $.post(base_url+'api/cate_filter',{method:'remove_ship_time_filter',keys:key,value:valuess},function(data, textStatus, xhr) {
              location.href = "<?php echo $current_url ?>";
              });
              }
              });
              var minimum_range = parseInt($("#price_ranger").attr('mini'));
              var max_range = parseInt($("#price_ranger").attr('maximum'));
              var slider = document.getElementById('price_ranger');
              var select_min = parseInt($("#price_ranger").attr("select-min"));
              var select_max = parseInt($("#price_ranger").attr("select-max"));
                  var con_cor = $('#price_ranger').attr('con-cor');
var con_format = $('#price_ranger').attr('con-format');
// con_format = con_format.slice(0,-4);

              noUiSlider.create(slider, {
              start: [(select_min*con_cor), (select_max*con_cor)],
              connect: true,
              step: 1,
              range: {
                  'min': (minimum_range*con_cor),
              'max': (max_range*con_cor)
              },format: {
                to: function ( value ) {
                  return value + '';
                },
                from: function ( value ) {
                  return value.replace('', '');
                }
                }
              });



slider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
              if ( handle ) {
              $(".max-price-span").html("<?php echo $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']); ?> "+Math.round(values[handle]));

                } else {
              $(".min-price-span").html("<?php echo $this->ccr->get_country_currency_symbol($_SESSION['currency_choose']); ?> "+Math.round(values[handle]));

                }
});




              slider.noUiSlider.on('change', function(values, handle){
              if ( handle ) {
              $(".max-price-span").html(values[handle]);
              $.post(base_url+'api/cate_filter',{method:'add_filter_price',keys:"high_price",value:values[handle]},function(data, textStatus, xhr) {
              location.href = "<?php echo $current_url ?>";
              });
                } else {
              $(".min-price-span").html(values[handle]);
              $.post(base_url+'api/cate_filter',{method:'add_filter_price',keys:"min_price",value:values[handle]},function(data, textStatus, xhr) {
              location.href = "<?php echo $current_url ?>";
              });
                }
              });
              function get_product_data_by_filter(){
              $.post(base_url+'api/cate_filter',{method:'get_product_by_filter'},function(data, textStatus, xhr) {
              // console.log(data);
              // $(".product-box-1-main").html(data);
              });
              }




              //////// Second Price Filter ///////
              var slider2 = document.getElementById('price_ranger2');
               noUiSlider.create(slider2, {
              start: [select_min, select_max],
              connect: true,
              step: 1,
              range: {
              'min': minimum_range,
              'max': max_range
              },format: {
                to: function ( value ) {
                  return value + '';
                },
                from: function ( value ) {
                  return value.replace('', '');
                }
                }
              });
              slider2.noUiSlider.on('change', function(values, handle){
              if ( handle ) {
              $(".max-price-span").html(values[handle]);
              $.post(base_url+'api/cate_filter',{method:'add_filter_price',keys:"high_price",value:values[handle]},function(data, textStatus, xhr) {
              location.reload();
              });
                } else {
              $(".min-price-span").html(values[handle]);
              $.post(base_url+'api/cate_filter',{method:'add_filter_price',keys:"min_price",value:values[handle]},function(data, textStatus, xhr) {
              location.reload();
              });
                }
              });
              });
              </script>

              <script>

var b_width = $( window ).width();
if (b_width <= 1300 && b_width >= 490) {
    $(".product_boxssss .product-name").each(function(index, el) {
        var name = $(this).text();
        if (name.length > 45) {
            $(this).text(name.substring(0, 45)+"...");
        }
    });
    }
    if (b_width <= 490) {
    $(".product_boxssss .product-name").each(function(index, el) {
        var name = $(this).text();
        if (name.length > 30) {
            $(this).text(name.substring(0, 30)+"...");
        }
    });
    }
</script>