<div class="c-row gmf c-center">
	<div class="grid g610 g78">
		<div class="grid g124 g8p10 white z-depth-05">
			<h5 class="center g8fs18 font-fire_sans g8ls10 cp title">Order Transaction Data</h5>
			<form action="" method="post" class="get_order_transaction_data">
				<div class="grid input-field  g124">
					<label for="order_id_txb" class="g8fs13 font-karla">Product SKU</label>
					<input id='order_id_txb' name="name_prod_sku" required type="text" >
				</div>
				<center><button class="c-btna h30 g8fs10 g8plr15">Submit</button></center>
			</form>
		</div>
	</div>
</div>
<?php if (!empty($transaction_data)) {
	?>
<div class="c-row g8mt30 gmf c-equalspace">

	<div class="grid g77 g612    g8mt15 ">
	<div class="white border3-1px  g8p17 grid g824">
		<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
		<i class="material-icons font19 left">assignment</i>ORDER DETAILS</h6>
		<div class="grid grey-text-new g124 zeo_padding">
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span><?php echo $transaction_data->first_name . ' ' . $transaction_data->last_name; ?></span>
			</h6>
			<h6 class=" g8ls7 g8fs13 g8mtb10">
			<span><?php echo $transaction_data->email_id; ?></span>
			</h6>
			<div class="divider grey lighten-3"></div>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Order Id</span>
			<span class="right"><?php echo $transaction_data->order_order_id; ?></span>
			</h6>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Order Date</span>
			<span class="right "><?php echo $transaction_data->order_date; ?></span>
			</h6>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Order Type</span>
			<span class="right"><?php echo $transaction_data->payment_from; ?></span>
			</h6>
			<div class="divider grey lighten-3"></div>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Order Status</span>
			<span class="right"><?php echo $this->pp_loader_helper->set_order_status($transaction_data->status); ?></span>
			</h6>
			<a href="<?php echo site_url('admin/order_man/order_detail/index/' . $transaction_data->order_id . '/' . $transaction_data->order_order_id); ?>"><button class="c-btna g8fs11 grid g824 g8mt20 font-karla h30">Full Order Detail</button></a>
		</div>
	</div>
	</div>
	<div class="grid g77 g612  g8mt15 white border3-1px g8p17 ">
		<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
		<i class="material-icons font19 left">attach_money</i>ORDER TRANSACTION DETAILS</h6>
		<div class="grid grey-text-new g124 zeo_padding">
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Products Price</span>
			<span class="right price" price="<?php echo $transaction_data->product_price; ?>"></span>
			</h6>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>+ Service Price</span>
			<span class="right price" price="<?php echo $transaction_data->service_charge; ?>"></span>
			</h6>
			<div class="divider grey lighten-3"></div>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Gross Sales</span>
			<span class="right price" price="<?php echo $transaction_data->service_charge + $transaction_data->product_price; ?>"></span>
			</h6>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>- Discount</span>
			<span class="right price" price="<?php echo $transaction_data->discount; ?>"></span>
			</h6>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>+ Shipping Price</span>
			<span class="right price" price="<?php echo $transaction_data->shipping_charge; ?>"></span>
			</h6>
			<div class="divider grey lighten-3"></div>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Bill Amount</span>
			<span class="right price" price="<?php echo $transaction_data->bill_amount; ?>"></span>
			</h6>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>- Recived Amount</span>
			<?php
$recived_amount = (!empty($transaction_data->delivered_date)) ? $transaction_data->bill_amount : $transaction_data->recived;
	?>
			<span class="right price" price="<?php echo $recived_amount; ?>"></span>
			</h6>
			<div class="divider grey lighten-3"></div>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Remain amt</span>
			<span class="right price" price="<?php echo $transaction_data->bill_amount - $recived_amount; ?>"></span>
			</h6>
			<?php if ($transaction_data->status == 15) {?>

			<div class="divider grey lighten-3"></div>
			<div class="divider grey lighten-3"></div>
			<h6 class="grey-text text-darken-3 g8mtb15 valign-wrapper g8ls20 g8fw500 g8fs13">
		<i class="material-icons font19 left">local_shipping</i>RETURN ORDER TRANSACTION	</h6>
		<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Recived Amount</span>
			<span class="right price" price="<?php echo $recived_amount; ?>"></span>
			</h6>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>- Refunded Amount</span>
			<span class="right price" price="<?php echo $transaction_data->return_com_price; ?>"></span>
			</h6>
			<div class="divider grey lighten-3"></div>
			<h6 class=" g8ls7 font-capitalize g8fs13 g8mtb10">
			<span>Return Charges</span>
			<span class="right price" price="<?php echo $recived_amount - $transaction_data->return_com_price; ?>"></span>
			</h6>
			<?php }?>
		</div>
	</div>
</div>
<?php }?>
