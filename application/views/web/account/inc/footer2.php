</div>
</div>
</div>
</div>

 <ul id="slide-out-account" class="side-nav">
    <li><div class="pp-col card radius-0 pm12 zero_margin agrey adarken-4  zero_padding pp-admin-nav-col  ">
    <div class="card z-depth-0 pp-row font-roboto_slab radius-0 zero_margin white-text radius-0">
      <div class="pp-col ps12  p-padding_15 waves-effect waves-light valign-wrapper pp-admin-nav nav_toogle" >
        <a class="white-text" href="href="<?php echo site_url('account/dashboard'); ?>"><div class="pp-col ps2  valign-wrapper p-icon nav-toogle "><i class="material-icons ">account_box</i></div>
        <div class="pp-col ps10 p-name"><span><b>My Account</b></span></div></a>
      </div>
      <div class="pp-col ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" >
        <a href="<?php echo site_url('account/my_account/order_history'); ?>"><div class="pp-col ps2 valign-wrapper p-icon "><i class=" material-icons">assignment</i></div>
        <div class="pp-col ps10 p-name"><span>My Order</span></div></a>
      </div>
      <div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_my_stuff">
        <div class="pp-col ps2 valign-wrapper p-icon "><i class=" material-icons">star</i></div>
        <div class="pp-col ps10 p-name"><span>My Stuff</span></div>
      </div>
      <div class="pp-col  pp-admin-nav sub ps12 zero_padding show_my_stuff pp-click-show-div">
        <a href="<?php echo base_url('account/my_account/'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">My Review & Ratings</span></a>
        <a href="<?php echo base_url('account/my_account/'); ?>"><span class="pp-col waves-effect waves-light ps12 subs p-padding_10">My Wishlist</span></a>
      </div>
      <div class="pp-col pp-click-show ps12 waves-effect waves-light p-padding_15 valign-wrapper pp-admin-nav main" pp-action="show_setting">
        <div class="pp-col ps2 valign-wrapper p-icon "><i class=" material-icons">settings</i></div>
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
        <a href="<?php echo site_url('account/login/logout'); ?>"><div class="pp-col ps2 valign-wrapper p-icon "><i class=" material-icons">power_settings_new</i></div>
        <div class="pp-col ps10 p-name"><span>Logout</span></div></a>
      </div>

    </div>
  </div></li>

  </ul>
  <a href="#" data-activates="slide-out-account" class="button-collapse-account center  hide-on-large-only side_filter_button"><i class="material-icons pp-margin-t-7">menu</i></a>
  <style>
  #slide-out-account.side-nav li  {
    line-height: unset;
  }
  #slide-out-account.side-nav a {
    line-height: unset;
    height: unset;
    padding:0px ;
  }
   #slide-out-account.side-nav  .p-icon {

    padding-left:0px 10px ;
  }

  .side_filter_button{
   background-color: #333;
    color: #fff;

    height: 40px;
    font-size: 23px;
    width: 40px;
    position: fixed;
    z-index: 400;
    right: 0;
    /* display: none; */
    top: 158px;
    }
    @media only screen and (max-width : 1300px) {

  /* .side_filter_button{
    display: block;
  } */
}
  </style>

<style type="text/css" media="screen">
  .filter_side_nav li{
line-height: 30px;
  }



</style>
<script>
$(document).ready(function() {
   $(".button-collapse-account").sideNav({
      menuWidth: 300, // Default is 240
      edge: 'right', // Choose the horizontal origin
      closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens
    });
     // $('.button-collapse-account').sideNav('show');
   get_cart_data_from_db();
function get_cart_data_from_db(){
   $.post(base_url+'api/cart_api', {method: 'get_cart_data_from_db_ci'}, function(data, textStatus, xhr) {
      console.log(data);

  //     $.each(data,function(index, el) {
  //        add_to_cart_data(el.id,el.product_id,el.required_stock);
		// if(el.single_data != null && el.single_data != ""){
  //        add_data_to_single_session(el.product_id,el.single_data);
  //        }
  //     });
   },"json");
}

function add_to_cart_data(cart_id,product_idds,stock){
   $.post(base_url+'api/cart_api',{ method:'add_to_cart',for_refresh:'for_refresh',require_stock:stock,cart_id:cart_id,product_id:product_idds}, function(data, textStatus, xhr) {
   },'json');
}

function add_data_to_single_session(product_id,single_session_data){
$.post(base_url+'api/cart_api',{ method:'add_data_to_single_session',produc_id:product_id,single_data:single_session_data}, function(data, textStatus, xhr) {
	console.log(data);
   });
}
});
</script>