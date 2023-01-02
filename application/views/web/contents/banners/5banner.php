<?php if (isset($home_5banner) && !empty($home_5banner)) {
	$image = false;
	foreach ($home_5banner as $key => $value) {
		if (!empty($value->b_values)) {
			$image = true;
		}
	}
	if ($image == true) {

		?>
<!-- <div class="pp-container"> -->
	<div class="pp-row g8mlr0 pp-equalspace pp-vert-center">


			<div class="pp-col ps3">

				<div class="pp-col zero_padding valign-wrapper pp-margin-tb-7 pm12">
				<?php echo (!empty($home_5banner[0]->link)) ? '<a class="wid_100" href="' . $home_5banner[0]->link . '">' : ''; ?>
					<img width="100%" class="responsive-img  zero_padding" src="<?php echo (!empty($home_5banner[0]->b_values)) ? base_url('uploads/banner/5banner/400_0/' . $home_5banner[0]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($home_5banner[0]->link)) ? '</a>' : ''; ?>
				</div>
				<div class="pp-col zero_padding valign-wrapper pp-margin-tb-7 pm12">
				<?php echo (!empty($home_5banner[1]->link)) ? '<a class="wid_100" href="' . $home_5banner[1]->link . '">' : ''; ?>
					<img width="100%"  class="responsive-img  zero_padding" src="<?php echo (!empty($home_5banner[1]->b_values)) ? base_url('uploads/banner/5banner/400_0/' . $home_5banner[1]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
				<?php echo (!empty($home_5banner[1]->link)) ? '</a>' : ''; ?>
				</div>
			</div>
				<div class="pp-col ps6">
				<div class="pp-col zero_padding valign-wrapper pp-margin-tb-7 pm12">
				<?php echo (!empty($home_5banner[2]->link)) ? '<a class="wid_100" href="' . $home_5banner[2]->link . '">' : ''; ?>
					<img width="100%"  class="responsive-img  zero_padding" src="<?php echo (!empty($home_5banner[2]->b_values)) ? base_url('uploads/banner/5banner/800_0/' . $home_5banner[2]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
				<?php echo (!empty($home_5banner[2]->link)) ? '</a>' : ''; ?>
				</div>
				<div class="pp-col zero_padding valign-wrapper pp-margin-tb-7 pm12">
				<?php echo (!empty($home_5banner[3]->link)) ? '<a class="wid_100" href="' . $home_5banner[3]->link . '">' : ''; ?>
					<img  width="100%" class="responsive-img  zero_padding" src="<?php echo (!empty($home_5banner[3]->b_values)) ? base_url('uploads/banner/5banner/800_0/' . $home_5banner[3]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
				<?php echo (!empty($home_5banner[3]->link)) ? '</a>' : ''; ?>
				</div>
			</div>
				<div class="pp-col ps3">

				<div class="pp-col zero_padding valign-wrapper pp-margin-tb-7 pm12">
				<?php echo (!empty($home_5banner[4]->link)) ? '<a class="wid_100" href="' . $home_5banner[4]->link . '">' : ''; ?>
					<img  width="100%" class="responsive-img  zero_padding" src="<?php echo (!empty($home_5banner[4]->b_values)) ? base_url('uploads/banner/5banner/400_0/' . $home_5banner[4]->b_values) : base_url('uploads/banner/no_image.png'); ?>">

					<?php echo (!empty($home_5banner[4]->link)) ? '</a>' : ''; ?>
				</div>
				</div>
			</div>



	</div>
<!-- </div> -->
<?php }}?>
