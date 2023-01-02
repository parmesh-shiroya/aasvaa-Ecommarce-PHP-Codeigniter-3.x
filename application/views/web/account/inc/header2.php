<!-- add assete -->
            <link rel="stylesheet" href="<?php echo base_url("assetes/otherassets/css/account.css"); ?>" />
            <script type="text/javascript" src="<?php echo base_url("assetes/otherassets/js/account.js"); ?>"></script>

<div class="pp-row zero_margin ">
	<div class="pp-col g8fs13 web_site hide_on_medium card radius-0 pm2 zero_margin agrey adarken-4 z-depth-05 zero_padding pp-admin-nav-col  ">
		<div class="card z-depth-05 font-roboto_slab radius-0 zero_margin white-text radius-0">
			<div class="pp-col ps12  p-padding_15 waves-effect waves-light valign-wrapper pp-admin-nav nav_toogle" >
				<a class="white-text" href="<?php echo site_url('account/dashboard'); ?>"><div class="pp-col ps2  valign-wrapper p-icon nav-toogle zero_padding"><i class="material-icons ">account_box</i></div>
				<div class="pp-col ps10 p-name"><span><b>My Account</b></span></div></a>
			</div>
			<div class="pp-col ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" >
				<a class="valign-wrapper" href="<?php echo site_url('account/my_account/order_history'); ?>"><div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class=" material-icons">assignment</i></div>
				<div class="pp-col ps10 p-name"><span>My Order</span></div></a>
			</div>
			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_my_stuff">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class=" material-icons">star</i></div>
				<div class="pp-col ps10 p-name"><span>My Stuff</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_my_stuff pp-click-show-div">
				<a href="<?php echo base_url('account/my_account/review_ratings'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">My Review & Ratings</span></a>
				<a href="<?php echo base_url('account/my_account/my_wish_list'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">My Wishlist</span></a>
			</div>
			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_setting">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class=" material-icons">settings</i></div>
				<div class="pp-col ps10 p-name"><span>Setting</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_setting pp-click-show-div">
				<a href="<?php echo site_url('account/edit_account'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">My Information</span></a>
				<a href="<?php echo site_url('account/my_account/password'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Change Password</span></a>
				<a href="<?php echo site_url('account/my_account/address_book'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Addresses</span></a>
				<!-- <a href="<?php echo site_url('account/edit_account'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Update Email</span></a> -->
				<a href="<?php echo site_url('account/my_account/newsletter'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">News Letter</span></a>
				<a href="<?php echo site_url('account/my_account/mana_mesurement'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Manage Measurement</span></a>
			</div>
			<div class="pp-col ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" >
				<a class="valign-wrapper" href="<?php echo site_url('account/login/logout'); ?>"><div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class=" material-icons">power_settings_new</i></div>
				<div class="pp-col ps10 p-name"><span>Logout</span></div></a>
			</div>

		</div>
	</div>
	<div class="pp-col ps12 pm12 pxl10 zero_padding pp_admin_main_col ">
		<div class=" zero_margin   white-text radius-0">

			<div class="pp-col  ps12 pp-zero_padding_in_small pp-admin-content  p-padding_15  " >