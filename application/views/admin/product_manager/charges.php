<div class="pp-row pp-center">
<div class="pp-col ps10 card border-1px z-depth-0 pp-padres">
<form action="" method="get" id="shipping_charge_api" accept-charset="utf-8" class="pp-form">
<div class="pp-row">
					<div class="pp-col pp-padres pm12">
					<h6 class="title font18 center-align">Shipping Charge</h6>
					</div>
					<div class="pp-col  valign-wrapper pm6">
					<div class="pp-col pp-text-field ">
							<label>Domestic Charge :- </label>
						</div>
						<div class="switch">
								<label>
									Manully
									<input type="checkbox"									                       <?php echo ($shipping_charges->domestic_type == 1) ? "checked" : ""; ?>  name="name_domestic_charge_type" class="domestic-charge ">
									<span class="lever"></span>
									Automatic
								</label>
							</div>
							</div>
					<div class="pp-col standard_size_div pm6">
						<div class="pp-col pp-text-field ps12">
							<label>Domestic Charge :- </label>
							<input placeholder="Catalog Name" value="<?php echo $shipping_charges->domestic_shipping; ?>" name="name_domestic_charge" required type="text" class=" name_domestic_charge">
						</div>
					</div>
<div class="divider g8mt20 g8mr20"></div>
					<div class="pp-col pp-padres pm6">
						<div class="pp-col pp-text-field ps12">
							<label>International Charge :-</label>
							<input value="<?php echo $shipping_charges->international_charge; ?>" placeholder="Catalog Name" name="name_inter_charge" required type="text" class=" ">
						</div>
					</div>
					<div class="pp-col ps12 center">
<button type="submit" class="btn primary-light">Change</button>
					</div>
				</div>
</form>
</div>
</div>

<script>
	$(document).ready(function() {
	$("#shipping_charge_api").on('submit', function(event) {
		event.preventDefault();
		var data = $(this).serialize();
		$.post(base_url+'admin/prodman/charges/add_new_charge', data, function(data, textStatus, xhr) {
			console.log(data);
			if (data.result == 'true') {
				Materialize.toast("Update Successfully",3000);
			}
		});
	});
	$(".domestic-charge").on('change', function(event) {
		event.preventDefault();
check_domestic_type();
	});
	check_domestic_type();
	function check_domestic_type(){
		if ($(".domestic-charge").prop('checked')) {
$(".name_domestic_charge").attr('disabled', 'disabled');
		}else{
$(".name_domestic_charge").removeAttr('disabled');
		}
	}
	});
</script>