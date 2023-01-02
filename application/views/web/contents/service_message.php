<div class="p-padding_tb_12" style="background-color:<?php echo $service_color['bg']; ?>">
<?php echo (!empty($service_color['in_container'])) ? '<div class="pp-container">' : ""; ?>
<div class="pp-row g8mlr0 pp-equalspace">
<?php
for ($i = 0; $i < 4; $i++) {
	$a = $i + 1;
	if (!empty(${'service_message' . $a}['title']) && !empty(${'service_message' . $a}['message'])) {?>
<div class="pp-col p-padding_tb_7 valin-wrapper ps1105 pm505  pl205">

<div class="pp-col zero_padding g8mt15 ps2 pm2 pl305 pxl205">
<img width="75%" src="<?php echo base_url('uploads/banner/service_message/120_120/' . ${'service_message' . $a}['img']); ?>" class="responsive-img">
</div>
<div class="pp-col ps10 pm10 pl805 pxl905">
<h6 style="color:<?php echo $service_color['title']; ?>" class=" font16 font-open_sans"><?php echo ${'service_message' . $a}['title']; ?></h6>
<pre style="color:<?php echo $service_color['message']; ?>" class="font12 g8mtb7 font-open_sans"><?php echo ${'service_message' . $a}['message']; ?></pre>

</div>
</div>
	<?php }
}
?>
</div>
<?php echo (!empty($service_color['in_container'])) ? '</div>' : ""; ?>
</div>