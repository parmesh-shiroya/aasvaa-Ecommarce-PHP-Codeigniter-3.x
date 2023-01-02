<?php if (isset($home_3banner) && !empty($home_3banner)) {
		$image = false;
		foreach ($home_3banner as $key => $value) {
			if (!empty($value->b_values)) {
				$image = true;
			}
		}
		if ($image == true) {

		?>
<div class="pp-container">
	<div class="pp-row pp-equalspace">
	<?php
		$a = 1;
				foreach ($home_3banner as $key => $value) {
					if (!empty($value->b_values)) {
					?>
<div class="pp-col pm4 center ps12">
			<div class="card  hvr-grows hoverable">
				<div class="card-image">
					<?php echo (!empty($value->link)) ? '<a href="' . $value->link . '">' : ''; ?>
					<img src="<?php echo base_url('uploads/banner/3banner/366_141/' . $value->b_values); ?>" class="responsive-img">
					<?php echo (!empty($value->link)) ? '</a>' : ''; ?>
				</div>
			</div>
		</div>

	<?php }
					$a++;}
			?>
	</div>
</div>
<?php }}?>
