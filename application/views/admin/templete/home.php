<div class="">
	<!-- <pre>
		<?php
			// print_r(unserialize(base64_decode($row->fields)));
			// echo base64_encode(serialize($standard_kurtis));
			print_r($data);
			print_r($_SESSION['newcart']['services_expenses']);
			print_r($_SESSION['newcart']['shipping_charge']);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, 'http://api.fixer.io/latest?base=INR');
			$result = curl_exec($ch);
			curl_close($ch);
			$obj = json_decode($result);
			print_r($obj->rates->USD);
			foreach ($this->cart->contents() as $items) {
				$service_charge = 0;
				$shoping_charge = 0;
				if (isset($_SESSION['newcart']['services_expenses'][$items['rowid']])) {
					$service_charge = $_SESSION['newcart']['services_expenses'][$items['rowid']] * $items['qty'];
				}
				if (isset($_SESSION['newcart']['shipping_charge'][$items['rowid']])) {
					$shoping_charge = $_SESSION['newcart']['shipping_charge'][$items['rowid']] * $items['qty'];
				}
				echo "<br>";
				echo $item_value = ($items['subtotal'] + $shoping_charge + $service_charge) * $obj->rates->USD;
				echo "<br>";
			}
		?>
	</pre> -->
	<div class="pp-row zero_margin grey-text text-darken-3">
		<div class="pp-col zero_padding ps12 card">
			<div class="pp-col center font-roboto_slab p-padding_tb_7 teal ps12 ">
				<h6 class="white-text font20">Tearms & Condition</h6>
			</div>
			<div class="pp-col ps12 pp-padres">
				<form>
					<textarea name="editor1" id="editor1" rows="10" cols="80">
					Write Here.
					</textarea>
					<div class="pp-col ps12 pp-margin-t-12 center">
					<button type="submit" class="btn">Save File</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
jQuery(document).ready(function($) {
CKEDITOR.replace( 'editor1' );
$(".submit").on('click', function(event) {
	event.preventDefault();
	var data = CKEDITOR.instances.editor1.getData()
	alert(data);
});
});
</script>