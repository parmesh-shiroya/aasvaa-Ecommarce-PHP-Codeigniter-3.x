<?php if (isset($home_2banner) && !empty($home_2banner)) {
		$image = false;
		foreach ($home_2banner as $key => $value) {
			if (!empty($value->b_values)) {
				$image = true;
			}
		}
		if ($image == true) {

		?>
<div class="pp-container">
    <div class="pp-row pp-equalspace center-align">

<?php
	$a = 1;
			foreach ($home_2banner as $key => $value) {
				if (!empty($value->b_values)) {
				?>
        <div class="pp-col pm6 ps12">
            <div class="card i-block hoverable">
                <div class="card-image">
                <?php echo (!empty($value->link)) ? '<a href="' . $value->link . '">' : ''; ?>
                    <img src="<?php echo base_url('uploads/banner/2banner/574_150/' . $value->b_values); ?>" class="responsive-img">
                    </a>
                </div>
            </div>
        </div>
        <?php }
        				$a++;}
        		?>
    </div>
</div><?php }}?>
