<div class="pp-container">
<div class="c-row gmf g8mlr20">
<div class="grid g124">
<h6 class=" g8pl30 font-courgette g8ptb10 g8fs18 cp">Testimonials</h6>
<div class="grid gpf g8plr20  right g124">
<?php echo $this->pagination->create_links(); ?>
</div>
<ul class="grid main_rev_list g124">
<?php
foreach ($reviews as $key => $value) {?>
	<li class="grid g124">
	<h6 class="g8fs13 rev"><?php echo $value->review; ?></h6>
		<h6 class=" name "><?php echo $value->first_name . " " . $value->last_name; ?> - <?php echo $value->region; ?></h6>
	</li>
<?php }
?>

</ul>
</div>
</div>

</div>

<style>
.main_rev_list li{
	border: 1px solid  #eee;
	background: #f5f5f5;
	padding: 10px;
	margin: 10px;
	line-height: 18px;
}
.main_rev_list li .rev{
color: #565656;
	font-size: 13px;
}
.main_rev_list li .name{
	text-transform: capitalize;
	font-weight: bold;
	font-size: 12px;
	font-style: italic;

}
</style>