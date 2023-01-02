<!DOCTYPE html>
<html>
    <head>
        <title>Aasvaa</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <?php
$dirjs = glob('assetes/js/*.js');
foreach ($dirjs as $key) {
	echo '<script type="text/javascript" src="' . base_url() . $key . '"></script>';
}
$dircss = glob('assetes/css/*.css');
foreach ($dircss as $key) {
	echo '<link rel="stylesheet" href="' . base_url() . $key . '" />';
}
if (isset($javascript)) {
	foreach ($javascript as $key => $value) {
		echo '<script type="text/javascript" src="' . base_url($value) . '"></script>';
	}
}
if (isset($css)) {
	foreach ($css as $key => $value) {
		echo '<link rel="stylesheet" href="' . base_url($value) . '" />';
	}
}
?>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
     <!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4ebspwLnktOwh9iDQqLWb4egrj7YGmmy";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->

    </head>
    <body>
        <div class="fixed-action-btn pp-hide-small-min">
            <button class="btn-floating scroll-to-top btn-p-large opacity8 waves-effect pink darken-3">
            <i style="line-height: 41px;" class="large font20 fa fa-arrow-up"></i>
            </button>
        </div>
        <!-- Modal Structure -->

        <!-- ///////////////// Login Model //////////////////// -->
        <div id="quick_login_model" class="modal">
            <div class="modal-content zero_padding dark-white-1">
                <div class="pp-row zero_margin">
                    <div style="background-image: url('<?php echo base_url('/assetes/img/login_back.png'); ?>'); background-size: auto 500px;" class="pp-col pp-hide-small-min zero_padding ps6">
                        <div style="position: relative; background: black none repeat scroll 0% 0%; height: 100%; width: 100%; opacity: 0.5;"></div>
                        <div class="pp-col white-text zero_padding ps12" style="position: absolute; top: 0px; width: 50%;">
                            <div class="pp-row zero_margin pp-center">
                                <div class="pp-col  pp-margin-t-20 ps12 center">
                                    <h6 class="font21  font-roboto_slab">Guest User</h6>
                                </div>
                                <div class="pp-col pl12 pxl10">
                                    <form class="pp-form" id="guest_user_login_form">
                                        <div class="pp-col p-padding_10  pm12">
                                            <div class="pp-col pp-text-field ps12">
                                                <label class="white-text">Email Address</label>
                                                <input placeholder="Email id" name="guest_login_email" required type="email" class="style_type1 login_password_txb">
                                            </div>
                                        </div>
                                        <center><button type="submit" class="btn pp-margin-t-12 amber btn-round btn-raised waves-effect waves-light ">Continue</button></center>
                                    </form>
                                </div>
                                <div class="divider opacity4 pp-marres"></div>
                                <div class="pp-col ps12 center">
                                    <h6 class="font17 font-roboto_slab">Connect With</h6>
                                </div>
                                <div class="pp-col ps12 center">
                                    <button class="btn-floating google-login-btn btn-p-large white btn-raised pp-marres waves-effect "><i class="fa fa-google font20 red-text " aria-hidden="true"></i></button> - OR -
                                    <button class="btn-floating facebook-login-btn btn-p-large white btn-raised pp-marres waves-effect "><i class="fa fa-facebook font20 indigo-text text-darken-2 " aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pp-col  pp-padres ps12 pm6 pl6">
                        <div class="pp-row pp-center">

<div class="pp-col hide-on-medium-max pl12 pxl10">
                                <div class="pp-col  pp-margin-t-12 ps12 center">
                                    <h6 class="font21  font-roboto_slab">Guest User</h6>
                                </div>

                                <form class="pp-form" id="guest_user_login_form">
                                        <div class="pp-col p-padding_10  pm12">
                                            <div class="pp-col pp-text-field ps12">
                                                <label>Email Address</label>
                                                <input placeholder="Email id" name="guest_login_email" required type="email" class="style_type1 login_password_txb">
                                            </div>
                                        </div>
                                        <center><button type="submit" class="btn pp-margin-t-12 amber btn-round btn-raised waves-effect waves-light ">Continue</button></center>
                                    </form>
                                     <div class="divider opacity4 pp-marres"></div>
                                <div class="pp-col ps12 center">
                                    <h6 class="font17 font-roboto_slab">Connect With</h6>
                                </div>
                                <div class="pp-col ps12 center">
                                    <button class="btn-floating google-login-btn btn-p-large white btn-raised pp-marres waves-effect "><i class="fa fa-google font20 red-text " aria-hidden="true"></i></button> - OR -
                                    <button class="btn-floating facebook-login-btn btn-p-large white btn-raised pp-marres waves-effect "><i class="fa fa-facebook font20 indigo-text text-darken-2 " aria-hidden="true"></i></button>
                                </div>
                                 <div class="pp-col pp-margin-tb-15 ps12 center  font13" ><a class="grey-text font-roboto_slab text-darken-2 hover-text-primary" href="<?php echo site_url('account/login/'); ?>">Login</a> <span class="p-padding_lr_1rem">|</span> <a class="grey-text font-roboto_slab text-darken-2 hover-text-primary" href="<?php echo site_url('account/login/'); ?>">Sign Up</a></div>
                            </div>



                            <div class="pp-col pl12 pp-hide-small-min pxl10">
                                <div class="pp-col  pp-margin-t-12 ps12 center">
                                    <h6 class="font21  font-roboto_slab">Login</h6>
                                </div>
                                <form class="pp-form " id="customer_login_form_header" method="post">
                                    <div class="pp-col p-padding_10 pp-margin-t-12 pm12">
                                        <div class="pp-col pp-text-field ps12">
                                            <label>Email Id</label>
                                            <input placeholder="Email Id" name="login_email" required type="email" class="style_type1 login_email_id_txb">
                                        </div>
                                    </div>
                                    <div class="pp-col p-padding_10  pm12">
                                        <div class="pp-col pp-text-field ps12">
                                            <label>Password</label>
                                            <input placeholder="Password" name="login_password" required type="password" class="style_type1 login_password_txb">
                                        </div>
                                    </div>
                                    <div class="pp-col pp-padres pm12">
                                        <div class="pp-col pp-margin-t-7 pm12">
                                            <div class="pp-col ps2 pm4  padding1"></div>
                                            <button class="btn btn-round amber button waves-effect pp-col ps8 pm4 waves-light " type="submit" name="">Login
                                            <i class="material-icons white-text hide_on_medium left">vpn_key</i>
                                            </button>
                                            <div class="pp-col ps2 pm4  padding1"></div>
                                            <div class="pp-col ps12 center pp-margin-t-12 font13" ><a class="grey-text font-roboto_slab text-darken-2 hover-text-primary" href="<?php echo site_url('account/login/forgot_password'); ?>">Forgot Password?</a> <span class="p-padding_lr_1rem">|</span> <a class="grey-text font-roboto_slab text-darken-2 hover-text-primary" href="<?php echo site_url('account/login/'); ?>">Sign Up</a></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ///////////////// Login Model End //////////////////// -->
        <!-- <div class="preloader">
            <center><img src="<?php echo base_url('assetes/img/load.gif'); ?>"/></center>
        </div> -->
        <header>

        <?php
if (isset($this->header) && !empty($this->header['message'])) {
	?>
        <div style="background: #E3E8EC;"><div class="pp-container">
    <div class="c-row c-equaldist g8m0">
  <div class="grid font-source_sance g8fs13 g8plr30 g8ptb6 gpf"><?php echo $this->header['message']; ?></div>
  <div class="grid g8mt5 right">
 <select  id="currency_select" class="currency_select browser-default grey-text text-darken-1 " >
                                <?php
$currencys = array('USD', 'INR', 'EUR', 'GBP', 'AUD', 'CAD', 'SGD', 'NZD', 'FJD', 'ZAR', 'MYR', 'AED', 'MUR', 'LKR');
	foreach ($currencys as $key => $value) {
		echo ($_SESSION['currency_choose'] == $value) ? "<option selected value='" . $value . "'>" . $value . "</option>" : "<option value='" . $value . "'>" . $value . "</option>";
	}
	?>
                            </select>
  </div>
    </div>
  </div>
</div>
<?php }?>
            <nav class="grey z-depth-0 lighten-5 ">
                <div class="nav-wrapper g8plr30 pp-container ">
                    <a href="<?php echo base_url(); ?>" class=" esml_margin_t_7 g8ml15 black-text brand-logo"><img src="<?php echo base_url() . "assetes/img/small/logo.png" ?>" width="280px" class="responsive-img"></a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right nav-menu hide-on-med-and-down">
                        <!-- <li class="valign-wrapper currency_select_li">
                            <select  id="currency_select" class="currency_select browser-default grey-text text-darken-1 " >
                                <?php
$currencys = array('USD', 'INR', 'EUR', 'GBP', 'AUD', 'CAD', 'SGD', 'NZD', 'FJD', 'ZAR', 'MYR', 'AED', 'MUR', 'LKR');
foreach ($currencys as $key => $value) {
	echo ($_SESSION['currency_choose'] == $value) ? "<option selected value='" . $value . "'>" . $value . "</option>" : "<option value='" . $value . "'>" . $value . "</option>";
}
?>
                            </select>
                        </li> -->
                        <li>
                            <form action="<?php echo site_url('search'); ?>" class="pp-form" method="get">
                                <div class="pp-text-field zero_margin pp-col ps10">
                                    <input id="search" not_req="true" name="filter_name" class="browser-default width_350p search-textbox-main black-text" type="text" value="<?php echo ($this->input->get('filter_name')) ? $this->input->get('filter_name') : ''; ?>" required>
                                    <button style="padding: 0px 10px; position: relative; height: 40px; top: -3px; left: -47px;" type="submit" class="btn transparent"><i class="material-icons black-text" style="font-size: 22px; height: 23px;  margin-top: -30px;">search</i></button>
                                </div>
                            </form>
                        </li>
                        <li><a href="<?php echo site_url('account/login'); ?>" class="nav_button waves-effect <?php echo ($this->pp_login_varified->customer_varified()) ? '' : 'login_model_call_button'; ?> tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo ($this->pp_login_varified->customer_varified()) ? ucfirst($this->session->userdata('customer_data')['firstname']) : 'Login / Register'; ?>"><span class="material-icons"><?php echo ($this->pp_login_varified->customer_varified()) ? 'lock_open' : 'lock'; ?> </span></a></li>
                        <li><a href="<?php echo site_url('wishlist'); ?>" class="nav_button waves-effect    tooltipped" data-position="bottom" data-delay="50" data-tooltip="Like Products"><span class="material-icons">favorite</span></a></li>
                        <li class="cart_button"><a href="<?php echo site_url('shopping_cart'); ?>" class="nav_button waves-effect nav_shopping waves-effect "><span class="material-icons ">shopping_cart</span></a></li>
                        <li class="cart_button"> <a href="<?php echo site_url('shopping_cart'); ?>" class="shoping_badge waves-effect "><span class="cart_size_span badge font14" data-badge-caption="Item(s)">0</span></a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li class="teal close_side_nav"><span class="white-text font-bold" >Close Menu</span></li>
                        <?php
if (isset($mobile_nav_menu)) {
	$links = json_decode(stripslashes($mobile_nav_menu['links']));
	$names = json_decode(stripslashes($mobile_nav_menu['names']));
	foreach ($mobile_nav_menu['position'] as $key => $value) {
		if (isset($value['children'])) {
			;?>
                        <li><a style="width:80%; float:left;" href="<?php echo (filter_var($links->$value['id'], FILTER_VALIDATE_URL)) ? $links->$value['id'] : site_url($links->$value['id']); ?>"><?php echo $names->$value['id']; ?></a><div  style="width:20%; float:left;" href=""><span class="right"><span pp-action="show_sub_cat" style="position: relative;" class="new badge pp-click-show2 font18 teal">+</span></span></div></li>
                        <?php
echo '<div style="width:100%; float: left;"  class="pp-click-show-div mobile_nav_sub_menu show_sub_cat">';
			foreach ($value['children'] as $key1 => $value1) { ?>
                            <li><a style="width:100%; float: left;" href="<?php echo (filter_var($links->$value1['id'], FILTER_VALIDATE_URL)) ? $links->$value1['id'] : site_url($links->$value1['id']); ?>"><?php echo $names->$value1['id']; ?></a></li>
                            <?php }
			echo '</div>';
		} else {?>
                        <li><a style="width:100%; float: left;" href="<?php echo (filter_var($links->$value['id'], FILTER_VALIDATE_URL)) ? $links->$value['id'] : site_url($links->$value['id']); ?>"><?php echo $names->$value['id']; ?></a></li>
                        <?php }}}?>
                    </ul>
                </div>
            </nav>
            <div class="pp-row hide-on-large-only card grey lighten-5 zero_margin z-depth-1">
                <div class="pp-col  pm6 ps12">
                    <form action="<?php echo site_url('search'); ?>" class="pp-form valign-wrapper" method="get">
                        <div class="pp-text-field  pp-col ps12">
                            <input id="search" not_req="true" name="filter_name" class="browser-default search-textbox-main black-text" required="" type="text">
                        </div>
                        <button type="submit" style="padding: 0px 10px; position: relative; height: 40px; top: 2px; left: -43px;" class="btn transparent  "><i class="material-icons black-text">search</i></button>
                    </form>
                </div>
               <!--  <div class="pp-col pp-padres ps2  pxs3">
                    <select id="currency_select" class="currency_select browser-default grey-text text-darken-1 " >
                        <?php
$currencys = array('USD', 'INR', 'EUR', 'GBP', 'AUD', 'CAD', 'SGD', 'NZD', 'FJD', 'ZAR', 'MYR', 'AED', 'MUR', 'LKR');
foreach ($currencys as $key => $value) {
	echo ($_SESSION['currency_choose'] == $value) ? "<option selected value='" . $value . "'>" . $value . "</option>" : "<option value='" . $value . "'>" . $value . "</option>";
}
?>
                    </select>
                </div> -->
                <div class="pp-col pp-padres ps5 pm4 pxs9">
                    <a href="<?php echo site_url('account/login'); ?>" class="nav_button <?php echo ($this->pp_login_varified->customer_varified()) ? '' : 'login_model_call_button'; ?> waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Login / Register"><span class="material-icons pp-margin-t-20 " style=""><?php echo ($this->pp_login_varified->customer_varified()) ? 'lock_open' : 'lock'; ?></span></a>
<a href="<?php echo site_url('wishlist'); ?>" data-position="bottom" data-delay="50" data-tooltip="Like Product" class="nav_button tooltipped  waves-effect waves-light"><span class="material-icons pp-margin-t-20 ">favorite</span></a>
                    <a href="<?php echo site_url('shopping_cart'); ?>" data-position="bottom" data-delay="50" data-tooltip="Shopping Cart" class="nav_button nav_shopping tooltipped waves-effect waves-light"><span class="material-icons pp-margin-t-20 ">shopping_cart</span></a>
                    <a href="<?php echo site_url('shopping_cart'); ?>" class=" pp-margin-t-20"><span class="cart_size_span font14 badge pp-margin-t-7 " data-badge-caption="Item(s)">0</span></a>
                </div>
            </div>
        </header>
        <div class="cart-absolute-div hide-on-med-and-down">
            <div class="center-align pp-container ">
                <div class="c-row gmf c-end">
                    <div id="cart-div-main" class=" card  zero_margin zero_padding  font-roboto grid g710 g88 right z-depth-1">
                    <div id="cart-div-main-sub">
<h6 class="g8mt20 font-karla g8fs20">Cart Is Empty</h6>
  <img class="responsive-img" width="45px" src="<?php echo base_url('assetes/img/cart.png'); ?>">
  <div class="divider g8mb10"></div>
                    </div>
                      <div class="cart-div-total_cart  g8mb10 c-row gmf">
                            <div class="right grid g8fs12 g124 grey-text  text-darken-4 "><span class="right"><span class="g8ls3 g8fw600 grey-text-new g8fs12">Shipping Charges :</span> <span class="pp-padding-l-15 shipping_charges  g8fw500 g8ls10">0</span></span></div><br>
                            <div class="right grid g8fs14 g8mt8 g124 grey-text  text-darken-4 "><span class="right"><span class="g8fw500 g8ls4 g8fs18"> Total :</span> <span class="pp-padding-l-15  g8fw500 g8ls10 total_prices">0</span></span></div>
                            <div class="grid g8mt10 g124"><a href="<?php echo site_url('shopping_cart'); ?>"><button class="c-btna g8plr25 right">Buy Now</button></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main" style="min-height: 58.9vh;">
            <!-- add assete -->
            <link rel="stylesheet" href="<?php echo base_url("assetes/otherassets/css/header_view.css"); ?>" />
            <script type="text/javascript" src="<?php echo base_url("assetes/otherassets/js/header_view1.js"); ?>"></script>
            <script type="text/javascript">
            $(".button-collapse").sideNav({  draggable: true});
            $(".close_side_nav").on('click', function(event) {
            event.preventDefault();
            $('.button-collapse').sideNav('hide');
            });
            $(document).ready(function() {
            // $('.currency_select').material_select();
            $("#currency_select").on('change', function(event) {
            event.preventDefault();
            var select_cur = $(this).val();
            $.post(base_url+'api/web_api', {method: 'change_cur',select_cur:select_cur}, function(data, textStatus, xhr) {
            location.reload();
            // console.log(data);
            });
            });
            });
            </script>
            <style>
            .close_side_nav{
            padding-left:20px;
            }
            .currency_select_li{
            margin:-5px 12px;
            }
            #currency_select{
            padding: 0px; font-size: 12px; height: 19px;
            }
            .mobile_nav_sub_menu{
                background: #eee;
            }
            </style>

