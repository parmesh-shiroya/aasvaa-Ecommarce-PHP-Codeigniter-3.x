<?php
if (isset($message) && (!empty($message['title']) || !empty($message['message']))) {?>
<div class="pp-container">
<div class="pp-row zero_margin">
<div class="pp-col pp-zero_margin_in_small white border-1px zero_padding ps12">
<div class="pp-col pheight_100  height_auto_in_sm valign-wrapper center zero_padding primary-light white-text ps12 pxl2 pm3">
<div class="pwidth_100 p-padding_tb_3 "><h6 class="font16 font-600 font-open_sans pwidth_100 center"><?php echo $message['title']; ?></h6></div>
</div>
<?php if (!empty($message['message'])) {?>
<div class="pp-col  ps12 white pxl10  pm9">
<h6 class="pp-padding-l-15  p-padding_tb_3 font14 grey-text text-darken-2">                                                                            <?php echo $message['message']; ?></h6>
</div>
<?php }?>
</div>
</div>
</div>
<?php }?>