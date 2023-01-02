<div class="pp-row zero_margin min_width_1300">
	<div class="pp-col pm2 grey darken-4 z-depth-1 zero_padding pp-admin-nav-col  ">
		<div class="card transparent z-depth-0 zero_margin   pheight_100vh zero_padding white-text radius-0">
			<div class="pp-col ps12  p-padding_15 waves-effect waves-light valign-wrapper pp-admin-nav nav_toogle" >
				<div class="pp-col ps2  valign-wrapper p-icon nav-toogle zero_padding"><i class="material-icons white-text">view_list</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span><b>Aasvaa Fashion</b></span></div>
			</div>
			<div class="pp-col ps12 waves-effect waves-light p-padding_15 pp-admin-nav main">
				<a class="valign-wrapper" href="<?php echo base_url('admin'); ?>"><div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">dashboard</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Dashboard</span></div></a>
			</div>
			<div class="pp-col ps12 waves-effect waves-light p-padding_15 pp-admin-nav main">
				<a class="valign-wrapper" href="<?php echo base_url('admin/report/report_views/index/'); ?>"><div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">assessment</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Reports</span></div></a>
			</div>
		<!-- 	<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_report_manager">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">assessment</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Reports</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_report_manager pp-click-show-div">
				<a href="<?php echo base_url('admin/report/Sales_report'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Sales Report</span></a>
				<a href="<?php echo base_url('admin/report/Behavior_report'); ?>"><span class="pp-col ps12 waves-effect waves-light subs p-padding_10">Behaviour Report</span></a>
				<a href="<?php echo base_url('admin/report/Visitor_report'); ?>"><span class="pp-col ps12 waves-effect waves-light subs p-padding_10">Visitor Report</span></a>
			</div> -->
			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_prod_manager">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">shopping_basket</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Product Manager</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_prod_manager pp-click-show-div">
				<a href="<?php echo base_url('admin/prodman/addproduct2'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Add Product</span></a>
				<a href="<?php echo base_url('admin/prodman/manageproduct'); ?>"><span class="pp-col ps12 waves-effect waves-light subs p-padding_10">Manage Product</span></a>
				<a href="<?php echo base_url('admin/prodman/managecategory'); ?>"><span class="pp-col ps12 waves-effect waves-light subs p-padding_10">Manage Categories</span></a>
				<a href="<?php echo base_url('admin/prodman/charges'); ?>"><span class="pp-col ps12 waves-effect waves-light subs p-padding_10">Shipping Charges</span></a>
				<a href="<?php echo base_url('admin/prodman/reviewmanager'); ?>"><span class="pp-col ps12 waves-effect waves-light subs p-padding_10">Reviews</span></a>
			</div>
			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_order_manager">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">add_shopping_cart</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Order Manager</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_order_manager pp-click-show-div">
				<!-- <a href="<?php echo base_url('admin/order_man/active_order'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Active</span></a> -->
				<a href="<?php echo base_url('admin/order_man/order_manager/upcoming_orders'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Upcoming Orders</span></a>
				<a href="<?php echo base_url('admin/order_man/order_manager'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Order Manager</span></a>
				<a href="<?php echo base_url('admin/order_man/order_manager/return_order'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Return Orders</span></a>
				<a href="<?php echo base_url('admin/order_man/order_manager/cancel_orders'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Cancel Orders</span></a>
			</div>
			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_customer_manager">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">people</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Customer Manager</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_customer_manager pp-click-show-div">
				<a href="<?php echo base_url('admin/customers/man_customers'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Manage Customer</span></a>
			</div>
			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_coup_manager">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">loyalty</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Coupen Manager</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_coup_manager pp-click-show-div">
				<a href="<?php echo base_url('admin/coupman/addcoupen'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Add Coupen</span></a>
				<a href="<?php echo base_url('admin/coupman/managecoupen'); ?>"><span class="pp-col ps12 waves-effect waves-light subs p-padding_10">Manage Coupen</span></a>
			</div>
			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_cu_query_manager">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">question_answer</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Customer Querys</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_cu_query_manager pp-click-show-div">
			<a href="<?php echo base_url('admin/contactus/contact/index/0'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Product Enquiry</span></a>
			<a href="<?php echo base_url('admin/contactus/contact/index/1'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Order Enquiry</span></a>
			<a href="<?php echo base_url('admin/contactus/contact/index/2'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">General Enquiry</span></a>
			<a href="<?php echo base_url('admin/contactus/contact/index/3'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Enquiry for Custom made product</span></a>
			<a href="<?php echo base_url('admin/contactus/contact/index/4'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Wholesale Enquiry</span></a>
			<a href="<?php echo base_url('admin/contactus/contact/index/5'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Suggestions & feedbacks</span></a>
			<a href="<?php echo base_url('admin/contactus/contact/index/6'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Others</span></a>
			</div>
			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_theme_manager">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">view_compact</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Theme Manager</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_theme_manager pp-click-show-div">
			<a href="<?php echo base_url('admin/theme/nav_menu_manager/main_menu'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Nav Menu</span></a>
				<a href="<?php echo base_url('admin/theme/nav_menu_manager'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Mobile Nav Menu</span></a>
				<a href="<?php echo base_url('admin/theme/banner_manager'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Banner Manager</span></a>
				<a href="<?php echo base_url('admin/theme/home_manager'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Home Page</span></a>
				<a href="<?php echo base_url('admin/theme/single_product_page'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Single Product</span></a>
			</div>
			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_admin">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">people</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Admin</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_admin pp-click-show-div">
				<a href="<?php echo base_url('admin/admin/login_log'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Login Log</span></a>
			</div>

<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_policys">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">security</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Policy</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_policys pp-click-show-div">

				<a href="<?php echo base_url('admin/other/pages/payment_option'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Payment Option</span></a>
				<a href="<?php echo base_url('admin/other/pages/privacy_policy'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Privacy Policy</span></a>
				<a href="<?php echo base_url('admin/other/pages/return_policy'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Return Policy</span></a>
				<a href="<?php echo base_url('admin/other/pages/shipping_policy'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Shipping Policy</span></a>
				<a href="<?php echo base_url('admin/other/pages/tearms_and_condition'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Tearms And Condition</span></a>
			</div>


			<div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_others">
				<div class="pp-col ps2 valign-wrapper p-icon zero_padding"><i class="white-text material-icons">menu</i></div>
				<div class="pp-col ps10 p-name zero_padding"><span>Other</span></div>
			</div>
			<div class="pp-col  pp-admin-nav sub ps12 zero_padding show_others pp-click-show-div">
			<a href="<?php echo base_url('admin/other/sale_page/'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Sale Page</span></a>

				<a href="<?php echo base_url('admin/other/pages/about_us'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">About Us</span></a>
				<a href="<?php echo base_url('admin/other/faq'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">FAQ</span></a>
				<a href="<?php echo base_url('admin/other/pages/size_guide'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">Size Guide</span></a>

			</div>
		</div>
	</div>
	<div class="pp-col ps10 zero_padding pp_admin_main_col pheight_100vh">
		<div class=" zero_margin  pheight_100vh white-text radius-0">
			<div class="pp-row zero_margin z-depth-1 ps12 pp-admin-header  p-padding_10 valign-wrapper ">
				<div class="pp-col ps2 valign-wrapper zero_padding"><i class="white-text material-icons">view_list</i></div>
				<div class="pp-col ps2 zero_padding"><span><b>Aasvaa Fashion</b></span></div>
				<div class="pp-col ps8 right"><span class="right">
				<button hover="true" data-activates='adm_setting_dropdown' class="adm_setting_drp-button btn-flat white-text font-bold">Account</button>
					<!-- Dropdown Structure -->
					<ul id='adm_setting_dropdown' class='dropdown-content'>
						<li><a href="<?php echo site_url('admin/profile/Preferences'); ?>">Preferences</a></li>
						<li><a href="<?php echo site_url('admin/profile'); ?>">Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('admin/login/logout'); ?>">Logout</a></li>
					</ul>
				</span></div>
			</div>
			<div class="pp-col  ps12 pp-admin-content  p-padding_15  " >