<div class="pp-container">
<div class="pp-row">
<div class="pp-col zero_padding ps12"><h5 class="teal-text margin-l-20">FAQs</h5></div>


<?php
	$a = 0;
foreach ($questions as $key => $value) {$a++;?>

	<div class="pp-col  g8fs16 font-karla ps12"><span class="g8mr10 g8fw500"><?php echo $a . ". "; ?></span> <?php echo $value->que; ?></div>
<div class="pp-col ps12 g8mb30 g8mt4 grey-text text-darken-1"><?php echo $value->ans; ?></div>
 <?php }?>




</div>


</div>
  <script>
     $(document).ready(function(){
    $('.collapsible').collapsible();
  });
  </script>