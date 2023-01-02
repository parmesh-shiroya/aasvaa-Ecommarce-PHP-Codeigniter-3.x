

<div class="slider">
<div class="white-text pp-hide-small-min valign-wrapper waves-effect waves-light slider-ctr-btn" onclick="prev_sli_image()" style="position: absolute; z-index: 10; top: 42%;"><i class="material-icons white-text" style="font-size: 50px;">keyboard_arrow_left</i></div>
<div class="white-text pp-hide-small-min valign-wrapper waves-effect waves-light slider-ctr-btn" onclick="next_sli_image()" style="position: absolute; z-index: 10; top: 42%; right: 0px;"><i class="material-icons white-text" style="font-size: 50px;">keyboard_arrow_right</i></div>
  <ul class="slides">
  <?php if (isset($home_slider)) {
	// $links = unserialize($home_slider['links']);
	$a = 1;
	foreach ($home_slider as $key => $value) {
		if (!empty($value->b_values)) {

			?>
    <li>
    <a href="<?php echo $value->link; ?>">
      <img src="<?php echo base_url('uploads/banner/1600_520/' . $value->b_values); ?>" class="responsive-img" >
      </a>
    </li>
	<?php $a++;}}
}?>
  </ul>
</div>
<style>
.slider-ctr-btn{
  display: flex !important;
}
.slider-ctr-btn:hover{
  cursor: pointer;
  background: rgba(255, 255, 255, 0.3) none repeat scroll 0 0;
}
@media only screen and (max-width : 610px) {
.slider-ctr-btn{
  display: none !important;
}
  }
</style>

<script type="text/javascript">
function next_sli_image(){
        $('.slider').slider('next');
}
function prev_sli_image(){
        $('.slider').slider('prev');
}

    $(document).ready(function(){


      // alert(($( window ).width()*670)/1920);
      $('.slider').slider({full_width: true,indicators:false ,height:($( window ).width()*670)/1920});
    });
</script>
