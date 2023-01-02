<?php if (isset($home_2big_banner) && !empty($home_2big_banner)) {
		$image = false;
		foreach ($home_2big_banner as $key => $value) {
			if (!empty($value->b_values)) {
				$image = true;
			}
		}
		if ($image == true) {
		?>
<div class="pp-container">
	<div class="pp-row">
	<?php
		$a = 1;
			foreach ($home_2big_banner as $key => $value) {?>
<div class="pp-col ps6">
					<?php echo (!empty($value->link)) ? '<a href="' . $value->link . '">' : ''; ?>
					<img width="100%" src="<?php echo base_url('uploads/banner/2bigbanner/950_550/' . $value->b_values); ?>" class="responsive-img">
					<?php echo (!empty($value->link)) ? '</a>' : ''; ?>
		</div>

	<?php $a++;}
			?>
	</div>
</div>
<?php }}?>
