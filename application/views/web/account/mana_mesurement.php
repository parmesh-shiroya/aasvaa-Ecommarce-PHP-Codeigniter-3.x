<div class="pp-col pp-padres card ps12">
	<div class="pp-col p-padding_10 ps12">
		<h6 class="title  font18">Manage Measurement</h6>
	</div>
	<div class="pp-col ps12">

      <table class="size_table border-1px font14 grey-text text-darken-1 bordered">
        <tbody>
        <?php foreach ($mesurements as $value) {?>
<tr>
            <td class="pp-padding-l-15 font-capitalize"><?php echo $value->name . " (" . $value->no . ")"; ?></td>
            <td class="right pp-padding-r-15"> <button class='pointer btn open_model ' data-target='custom_size_model_<?php echo $value->id; ?>'><i class="right material-icons">search</i> View</button></td>
          </tr>

        <?php }?>
        </tbody>
      </table>

	</div>
</div>

<?php
	foreach ($mesurements as $key => $value) {
		// echo $value->id;
		// print_r(unserialize(base64_decode($value->data)));
	?>
<div id="custom_size_model_<?php echo $value->id; ?>" class="modal grey-text text-darken-4">
	<div class="modal-content">
		<h6 class="font18 font-capitalize teal-text"><?php echo $value->name . ' (' . $value->no . ')'; ?></h6>
		<div class="pp-row">
			<?php
				$for_name_keys = explode("#", $value->for_name);
					array_pop($for_name_keys);
					foreach ($for_name_keys as $for_name_keys_key => $for_name_keys_value) {
					?>
			<div class="pp-col ps6">
				<h6 class="font16 teal-text font-500 font-capitalize pp-margin-tb-15"><?php echo $for_name_keys_value; ?></h6>
				<table class="bordered size_table border-1px font14 grey-text text-darken-1">
					<tbody>
						<?php foreach (unserialize(base64_decode($value->data)) as $custom_size_data_key => $custom_size_data_value) {
										// echo $for_name_keys_key;
									if (strpos($custom_size_data_key, $for_name_keys_value . "#") !== false) {?>
						<tr>
							<td class="font14 grey-text text-darken-4"><?php echo str_replace($for_name_keys_value . "#", "", $custom_size_data_key); ?></td>
							<td><?php echo $custom_size_data_value; ?></td>
						</tr>
						<?php } else if (strpos($custom_size_data_key, $for_name_keys_value) !== false) {?>
<tr>
							<td class="font14 grey-text text-darken-4"><?php echo $custom_size_data_key; ?></td>
							<td><?php echo $custom_size_data_value; ?></td>
						</tr>
<?php	}

			}
		?>
					</tbody>
				</table>
			</div>
			<?php }
				?>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
	</div>
</div>
<?php }
?>
<style type="text/css" media="screen">
			.size_table	tr td{
		padding: 10px 7px;
	}
	</style>

<script>
$(document).ready(function() {
$(".open_model").on('click', function(event) {
			event.preventDefault();
			var mo_id = $(this).attr('data-target');
	$('#'+mo_id).openModal();
		});
});
</script>