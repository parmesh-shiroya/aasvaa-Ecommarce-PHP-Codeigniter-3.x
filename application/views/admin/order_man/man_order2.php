<!-- <pre class="black-text"> -->
<?php
// foreach ($order_mst as $key) {
// print_r(unserialize(base64_decode($key->trn_c_data)));
// print_r(unserialize(base64_decode($paypal_data['or_' . $key->id]->datas)));
// print_r($ccavenue_data['or_' . $key->id]->datas);
// print_r(unserialize(base64_decode($ccavenue_data['or_' . $key->id]->datas)));
// }
?>
<!-- </pre> -->
<div class="pp-row">
	<div class="pp-col ps12">
		<ul class="tabs font-roboto_slab g8fs12 z-depth-1">
			<li class="tab pp-col ps2"><a class="active" href="#pending_order_div">New</a></li>
			<li class="tab pp-col ps2"><a  href="#confirm_order_div">Confirm</a></li>
			<li class="tab pp-col ps2"><a  href="#on_hold_order_div">On Hold & Customize</a></li>
			<!-- <li class="tab pp-col ps2"><a  href="#customize_work_order_div">Customize Work</a></li> -->
			<li class="tab pp-col ps2"><a href="#ready_to_ship_order_div">Ready To Ship</a></li>
			<li class="tab pp-col ps2"><a href="#shipped_order_div">In Transit</a></li>
			<li class="tab pp-col ps2"><a href="#delivered_order_div">Delivered</a></li>
		</ul>
	</div>

	<div id="pending_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(0);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
		<div id="confirm_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(6);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
	<div id="on_hold_order_div" class="pp-col ps12">

	<div class="pp-col zero_padding ps12">
		<ul class="tabs second_tabs z-depth-05 border-1px font-roboto_slab g8fs12 z-depth-1">
			<li class="tab pp-col ps2"><a  href="#on_hold_second_div">On Hold</a></li>
			<li class="tab pp-col ps2"><a href="#customize_second_div">Customize</a></li>
		</ul>
	</div>

	<div id="on_hold_second_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(5);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
		<div id="customize_second_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(1);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>

		<?php /*
$status_array['status_array'] = array(5, 1);
$this->view('admin/order_man/contents/order_man_details', $status_array);? */?>
	</div>
	<div id="ready_to_ship_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(2);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
	<div id="shipped_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(3, 8);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
	<div id="delivered_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(4, 16);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
</div>
<style type="text/css" media="screen">
.indicator{
	/* display: none; */
}
table thead th{
	font-weight: 500;
}
.second_tabs .indicator{
	display: none;
}
</style>