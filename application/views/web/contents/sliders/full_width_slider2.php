
  <div class="carousel carousel-slider center" data-indicators="true">
    <div class="carousel-fixed-item center">
      <a class="btn waves-effect white grey-text darken-text-2">button</a>
    </div>
      <?php if (isset($home_slider)) {
	// $links = unserialize($home_slider['links']);
	$a = 1;
	foreach ($home_slider as $key => $value) {
		if (!empty($value->b_values)) {

			?>
<a class="carousel-item red white-text" href="<?php echo $value->link; ?>">

   <img src="<?php echo base_url('uploads/banner/1600_520/' . $value->b_values); ?>" class="responsive-img" >
</a>


  <?php $a++;}}
}?>


  </div>


<script>
  $(document).ready(function() {
 $('.carousel.carousel-slider').carousel({fullWidth: true,height:($( window ).width()*670)/1920});
  });

</script>