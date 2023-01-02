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
			<li class="tab pp-col ps2"><a href="#del_excep_order_div">Delivery Exception</a></li>
			<li class="tab pp-col ps2"><a class="active" href="#return_req_order_div">Return Request</a></li>
			<li class="tab pp-col ps2"><a  href="#ret_confirm_order_div">Confirm</a></li>
			<li class="tab pp-col ps2"><a  href="#ret_intran_order_div">In Transit</a></li>
			<li class="tab pp-col ps2"><a href="#ret_deli_order_div">Delivered</a></li>
			<li class="tab pp-col ps2"><a href="#ret_com_order_div">Complete</a></li>

		</ul>
	</div>

	<div id="del_excep_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(9);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
		<div id="return_req_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(11);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
	<div id="ret_confirm_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(12);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
	<div id="ret_intran_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(13);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
	<div id="ret_deli_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(14);
$this->view('admin/order_man/contents/order_man_details', $status_array);?>
	</div>
	<div id="ret_com_order_div" class="pp-col ps12">
		<?php
$status_array['status_array'] = array(15);
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
</style>