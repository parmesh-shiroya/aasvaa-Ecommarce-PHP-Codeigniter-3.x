
<div class="pp-col z-depth-0 transparent card ps12">
<div class="pp-col p-padding_10 ps12">
<h6 class="title  font18">My Account</h6>
</div>
<div class="pp-col ps12">
<div class="pp-col pp-margin-tb-7 zero_padding ps12">
<span class="grey-text font-capitalize font12 text-darken-1">
  Welcome          <?php echo (isset($user_data->first_name)) ? $user_data->first_name . " " . $user_data->last_name : ""; ?>,</span>
</div>
<div class="pp-col pp-margin-tb-2 zero_padding ps12">
<span class="grey-text font12 text-darken-1"> Here you can access your account information like Order History, Manage Measurement, Add Billing & Shipping Addresses, WishList Items, Refund and Returns request, Subscribe / UnSubscribe to our Newsletters & Change your Login Passwords</span>
</div>
</div>
<div class="divider"></div>
<div class="pp-col pp-margin-tb-15 ps12">
<div class="pp-col zero_padding ps6">
<span><a class="grey-text font13 hover-text-primary font-bold text-darken-2" href="<?php echo site_url('account/edit_account'); ?>">Contact Information</a></span><br>
<div class="block-text">
<span class="grey-text font-capitalize text-darken-1 font-12"><?php echo (isset($user_data->first_name)) ? $user_data->first_name . " " . $user_data->last_name : ""; ?></span><br>
<span class="grey-text  text-darken-1 font-12"><?php echo (isset($user_data->email_id)) ? $user_data->email_id : ""; ?></span>
</div>
</div>
<div class="pp-col zero_padding ps6">
<span class="grey-text font13 hover-text-primary font-bold text-darken-2"><a class="hover-text-primary grey-text text-darken-2" href="<?php echo site_url('account/my_account/order_history'); ?>">Order History</a></span><br>
</div>
</div>
<div class="pp-col pp-margin-tb-7 ps12">
<span><a class="grey-text font13 hover-text-primary font-bold text-darken-2" href="<?php echo site_url('account/my_account/password'); ?>">Change Password</a></span>
</div>
<div class="pp-col pp-margin-tb-15 ps12">
<div class="pp-col zero_padding ps6">
<span><a class="grey-text font13 hover-text-primary font-bold text-darken-2" href="<?php echo site_url('account/my_account/address_book'); ?>">Manage Address Book</a></span><br>
<!-- <div class="block-text">
<span class="grey-text  text-darken-1 font-12">Pamresh shiroya</span><br> -->
<!-- <span class="grey-text  text-darken-1 font-12">17,nandanvan soc, katargam soc<br>surat-395006</span><br> -->
<!-- <span class="grey-text  text-darken-1 font-12"><a class="hover-text-primary grey-text text-darken-2" href="">Edit</a></span> -->
<!-- </div> -->
</div>
<div class="pp-col zero_padding ps6">
<span  class="grey-text font13 hover-text-primary font-bold text-darken-2" ><a class="hover-text-primary grey-text text-darken-2" href="<?php echo site_url('account/my_account/mana_mesurement'); ?>">Measurements</a></span><br>
</div>
</div>
</div>
