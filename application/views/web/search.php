<div class="pp-container">
  <div class="pp-row">
    <div class="pp-col pm12 pl12 pxl12">

      <div class="pp-col valgn-wrapper ps12 zero_padding">
        <div class="pp-col valign-wrapper pm12 pl4 grey-text text-darken-1">
          <span class="primary-text font22 font-roboto_slab font-capitalize"><?php echo $this->input->get('filter_name');
?></span>
        </div>
        <div class="pp-col ps12 pm12 pl8 right grey-text text-darken-1">
          <span class="right custom_filter_div"><a class="hover-text-primary
            <?php if (isset($_GET['cust']) && $_GET['cust'] == "phtl") {
	echo "teal-text";
} else {
	echo "grey-text text-darken-1";
}?>
          " href="<?php echo $current_url . "&cust=phtl"; ?>">Price High to Low</a></span>
          <span class=" right custom_filter_div"><a class="hover-text-primary
            <?php if (isset($_GET['cust']) && $_GET['cust'] == "plth") {
	echo "teal-text";
} else {
	echo "grey-text text-darken-1";
}?>
          " href="<?php echo $current_url . "&cust=plth"; ?>">Price Low to High</a></span>
          <span class=" right custom_filter_div"><a class="hover-text-primary
            <?php if (isset($_GET['cust']) && $_GET['cust'] == "l") {
	echo "teal-text";
} else {
	echo "grey-text text-darken-1";
}?>" href="<?php echo $current_url . "&cust=l"; ?>">Latest</a></span>
        </div>
      </div>
       </div>
    </div>
  </div>
      <div class="pp-col ps12 zero_padding product_card_container product-box-1-main">
        <?php
if (!empty($product)) {
	$datas['product'] = $product;
	$this->view('web/contents/product_boxes/product_box_2', $datas);
} else {?>
<center><h6 class="font21 teal-text">No Product Found.</h6></center>
            <?php }?>
        </div>

  <style type="text/css" media="screen">
  .custom_filter_div{
  border-right: 1px solid #bbb;
  padding-right: 10px;
  padding-left: 10px;
  margin-top: 10px;
  margin-bottom: 10px;
  }
  .product_card_container>div>.white.border2-1px.bt0{
background: transparent !important;
border: 0px solid #fff;
  }
  </style>