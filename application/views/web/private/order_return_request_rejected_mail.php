<?php
$order_trn_data        = unserialize(base64_decode($order_mst->trn_c_data));
$order_trn_return_data = unserialize(base64_decode($order_mst->trn_return_data));
if (isset($ccavenue_data->datas)) {
	$ccavenue_data = unserialize(base64_decode($ccavenue_data->datas));
}
$company_data = $this->pp_loader_helper->get_adm_prof_data();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Order Placed Successfully</title>
</head>
<body>
<table style="border-collapse:collapse;table-layout:fixed;min-width:320px;width:100%;background-color:#fff" border="0">
  <tbody>
    <tr>
      <td width="100%">
      <div style="width:100%;">
      <div style="max-width:650px; border: 1px solid #ddd; margin:0 auto;">
      <table border="0"><tbody><tr>
      <td width="100%" height="83">
      <div style="float: left; margin-left: 15px;"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assetes/img/small/logo.png'); ?>" alt="AASVAA IMAGE" width="260" align="middle"/></a></div>
      <div style="float: right; margin-right: 15px; margin-top: 10px;">
      <img src="<?php echo base_url('assetes/img/small/mail_image1.png'); ?>" alt="" height="37" align="middle"/>
      <img src="<?php echo base_url('assetes/img/small/mail_image2.png'); ?>" alt="" height="37" align="middle"/>
      <img src="<?php echo base_url('assetes/img/small/mail_image3.png'); ?>" alt=""  height="37" align="middle"/>
      </div>
      </td>
    </tr>
    <tr>
    	<td>
    		<table width="100%" style="padding: 10px 0px; font-size: 13px; font-weight: 600; border-top: 2px solid #000; border-bottom: 2px solid #000;" border="0">
  <tbody >
    <tr>
      <td width="14%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Sarees</a></center></td>
      <td width="21%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Lehengha Choli</a></center></td>
      <td width="16%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Indowestern</a></center></td>
      <td width="21%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Salwar Kameez</a></center></td>
      <td width="14%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Accessories</a></center></td>
      <td width="14%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Sale</a></center></td>
    </tr>
  </tbody>
</table>

    	</td>
    </tr>
    <tr style="font-family:'roboto',sans-serif;">
      <td style="background: #FAFBFC" height="210"><div style="margin: 15px"><h4 style="text-transform: capitalize;">Hi <?php echo $customer_data->first_name . ' ' . $customer_data->last_name; ?>,</h4>
      <p style="font-size:14px; letter-spacing: 0.6px;">Your Request For return Order is Rejected. Because '<?php echo $order_status->message; ?>'.</p>

      <p>
        <center>
        <a href="<?php echo site_url('account/order_det/index/' . $order_mst->id); ?>"><button type="button" style="-webkit-border-radius: 2;  -moz-border-radius: 2; border-radius: 4px; border: 0px;  font-family: Georgia; cursor: pointer; color: #ffffff; font-size: 14px;  background: #333;  padding: 7px 20px 7px 20px; width: 140px;  text-decoration: none;" name="button" id="button" value="Track Order">Track Order</button></a></center>
    </p>
      </div></td>
    </tr>
    <tr  style="font-family:'roboto',sans-serif;">
      <td height="82"><div style="margin: 15px">
        <center><p style="font-size:14px; letter-spacing: 0.7px;">Please Find Below, the summary of your order <?php echo $order_mst->order_id; ?></p></center>
        <div style="height: 1px; background: #767676"></div>
        <div>
          <table style="font-size:13px" width="100%" border="0">
            <tbody>
             <tr style="font-weight:500;">
				 <td style="border-bottom: 1px solid #000;" width="94px"></td>
                <td style="border-bottom: 1px solid #000;" width="410" ><center>Product</center></td>
                <td style="border-bottom: 1px solid #000;" width="96"><center>Price</center></td>
                <td style="border-bottom: 1px solid #000;" width="54"><center>Qty</center></td>
                <td style="border-bottom: 1px solid #000;" width="91"><center>Sub Total</center></td>
              </tr>

              <?php
foreach ($order_trn_data['cart_contents'] as $key => $value) {
	if ($key != 'cart_total' && $key != 'total_items') {
		?>
        <tr>
           <td style="border-bottom: 1px solid #ddd;" width="94"><img style="border-radius: 4px;" src="<?php echo base_url('uploads/pro_image/94_130/' . $value['image']); ?>" width="100%" alt=""/></td>

                <td style="border-bottom: 1px solid #ddd;" width="410" ><center><?php echo $value['name']; ?></center></td>
                  <?php
$price = $value['price'];
		if (isset($order_trn_data['newcart']['services_expenses']) && isset($order_trn_data['newcart']['services_expenses'][$value['rowid']])) {
			$price = $price + $order_trn_data['newcart']['services_expenses'][$value['rowid']];
		}
		?>
                <td style="border-bottom: 1px solid #ddd;" width="96"><center><?php echo $this->ccr->cfa($order_trn_data['currency'], $price, $order_trn_data['currency_choose']); ?></center></td>
                <td style="border-bottom: 1px solid #ddd;" width="54"><center><?php echo $value['qty']; ?></center></td>
                <td style="border-bottom: 1px solid #ddd;" width="91"><center><?php $total_price = $price * $value['qty'];
		echo $this->ccr->cfa($order_trn_data['currency'], $total_price, $order_trn_data['currency_choose']);?></center></td>
              </tr>
  <?php }}?>
            </tbody>
          </table>
          </div>
          <div style="padding: 5px; background: #FAFBFC; font-size: 13px; margin-top: 5px;"><center>(+) Shipping : <?php echo $this->ccr->cfa($order_trn_data['currency'], $order_trn_data['newcart']['total_shipping_charges'], $order_trn_data['currency_choose']); ?></center></div>


<?php
if (isset($order_trn_data['cart_coupen_data'])) {
	if ($order_trn_data['cart_coupen_data']->discount_type == 0) {
		$title     = "Discount";
		$dis_total = $order_trn_data['cart_coupen_data']->dis_percet_rs;
	} elseif ($order_trn_data['cart_coupen_data']->discount_type == 1) {
		$title     = "Discount " . $order_trn_data['cart_coupen_data']->dis_percet_rs . "%";
		$dis_total = round(($order_trn_data['cart_contents']['cart_total'] + $order_trn_data['newcart']['total_service_charges']) * $order_trn_data['cart_coupen_data']->dis_percet_rs / 100);
	}
	?>
  <div style="padding: 5px; background: #FAFBFC; font-size: 13px; margin-top: 10px;"><center>(-) Offer :  <?php echo $this->ccr->cfa($order_trn_data['currency'], $dis_total, $order_trn_data['currency_choose']); ?></center></div>
          <?php }?>


        </div>
      </td>
    </tr>
    <tr>
      <td style="font-size: 14px; padding: 15px;">
      	<div style="padding-left: 4px;"><strong>Mail Us : </strong><?php echo $company_data['customer_support_email']; ?></div>
      	<div style="padding: 8px 4px;  border-bottom: 2px solid #000;"><strong>Customer care No : </strong>+91 <?php echo $company_data['mobile_no']; ?></div>
      	<div style="padding: 15px 0px;"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assetes/img/small/logo.png'); ?>" alt="AASVAA IMAGE" width="260" align="middle"/></a></div>
      	<div></div>
      </td>
    </tr>
  </tbody>
</table></div></div></td>

    </tr>
  </tbody>
</table>
</body>
</html>