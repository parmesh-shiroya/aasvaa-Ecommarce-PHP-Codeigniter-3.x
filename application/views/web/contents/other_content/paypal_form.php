<form method="post" id="submit_form" name="redirect" class="zero_margin" action="https://www.paypal.com/cgi-bin/webscr">
<input name="cmd" value="_cart" type="hidden">
  <input name="upload" value="1" type="hidden">
  <input name="business" value="aasvaaservices@gmail.com" type="hidden">
<?php
	$a = 1;
	foreach ($this->cart->contents() as $items) {
		$service_charge = 0;
		$shoping_charge = 0;
		if (isset($_SESSION['newcart']['services_expenses'][$items['rowid']])) {
			$service_charge = $_SESSION['newcart']['services_expenses'][$items['rowid']] * $items['qty'];
		}
		if (isset($_SESSION['newcart']['shipping_charge'][$items['rowid']])) {
			$shoping_charge = $_SESSION['newcart']['shipping_charge'][$items['rowid']] * $items['qty'];
		}
		$item_value = ($items['subtotal'] + $shoping_charge + $service_charge) * $data->rates->USD;
	?>
  <input name="item_name_<?php echo $a; ?>" value="<?php echo $items['name']; ?>" type="hidden">
  <input name="item_number_<?php echo $a; ?>" value="<?php echo $items['id']; ?>" type="hidden">
  <input name="amount_<?php echo $a; ?>" value="<?php echo $item_value; ?>" type="hidden">
  <input name="quantity_<?php echo $a; ?>" value="<?php echo $items['qty']; ?>" type="hidden">
  <input name="weight_<?php echo $a; ?>" value="1" type="hidden">
<?php $a++;}
?>
</form>