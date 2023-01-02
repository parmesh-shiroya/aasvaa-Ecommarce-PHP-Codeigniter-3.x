</div>
<footer class="page-footer zero_margin grey darken-3">
<div class="pp-container">
  <div class="pp-row pp-equaldist">
    <div class="pp-col">
      <p class="white-text footer-title font21">INFORMATION</p>
      <p><a href="<?php echo site_url('payment_option'); ?>"  class=" ">Payment Options</a></p>
      <p><a href="<?php echo site_url('about_us'); ?>"  class="">About Us</a></p>
      <p><a href="<?php echo site_url('faq'); ?>"  class=" ">FAQs</a></p>
      <p><a href="<?php echo site_url('size_guide'); ?>"  class=" ">Size Guide</a></p>
    </div>
    <div class="pp-col">
      <p class="white-text footer-title font21">Shopping Policies</p>
      <p><a href="<?php echo site_url('policy/privacy_policy'); ?>"  class=" ">Privacy Policy</a></p>
      <p><a href="<?php echo site_url('policy/return_policy'); ?>"  class="">Return Policy</a></p>
      <p><a href="<?php echo site_url('policy/shipping_policy'); ?>"  class=" ">Shipping Policy</a></p>
      <p><a href="<?php echo site_url('terms_and_conditions'); ?>"  class=" ">Terms & Conditions</a></p>
      <p><a href="<?php echo site_url('contact_us'); ?>"  class=" ">Contact Us</a></p>
    </div>
    <div class="pp-col ">
      <p class="white-text footer-title font21">We Accept</p>
      <p><img src="<?php echo base_url('assetes/img/paypal.png'); ?>" class="responsive-img"></p>
      <p class="white-text footer-title font21">Our Shipping Partner</p>
      <p><img src="<?php echo base_url('assetes/img/shipping_partners.png'); ?>" class="responsive-img"></p>
    </div>
    <div class="pp-col contact-us white-text">
      <p class="white-text footer-title font21">Contact Us</p>
      <p class="valign-wrapper "><i class="material-icons grey darken-2 white-text margin_r_10 p-padding_5">place</i><span style="max-width: 280px;">Shop:                                                                                                                                                           <?php echo (isset($shop_add)) ? $shop_add : ""; ?></span></p>
         <p class="valign-wrapper "><i class="material-icons grey darken-2 white-text margin_r_10 p-padding_5">call</i><span>Phone:                                                                                                                                    <?php echo (isset($mobile_no)) ? $mobile_no : ""; ?></span></p>
            <p class="valign-wrapper "><i class="material-icons grey darken-2 white-text margin_r_10 p-padding_5">email</i><span>Email:                                                                                                                                        <?php echo (isset($customer_support_email)) ? $customer_support_email : ""; ?></span></p>
    </div>
  </div>
</div>
<div class="footer-copyright grey darken-4">
  <div class="container font-rubik">
    © 2014 Copyright Text
    <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
  </div>
</div>
</footer>
<style type="text/css" media="screen">
.page-footer p{
margin: 7px 0px;
font-size: 14px;
}
.page-footer .footer-title{
margin: 0px 0px 14px;
font-family: "Fira Sans",sans-serif;
}
.page-footer p a{
  font-family: "Dosis",sans-serif;
color: #9e9e9e;
padding-left: 6px;
font-size: 14px;
transition: all .30s;
}
.page-footer p a:hover{
color:#eee !important;
text-shadow: 3px 2px 3px #000;
}
.page-footer .contact-us p{
  color: #ddd;
  font-family: "Fira Sans",sans-serif;
margin: 10px 0px;
transition: all .40s;
}
.page-footer .contact-us p span{
transition: all .40s;
  }
.page-footer .contact-us p:hover span{
  color: rgb(41,177,164);
}
</style>
</body>
<?php
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

<script src="https://www.gstatic.com/firebasejs/3.6.8/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCOk0H_01exF9EksOErfijWiXldwxpWFrs",
    authDomain: "aasvaa-88cdc.firebaseapp.com",
    databaseURL: "https://aasvaa-88cdc.firebaseio.com",
    storageBucket: "aasvaa-88cdc.appspot.com",
    messagingSenderId: "451752208237"
  };
  firebase.initializeApp(config);
</script>
<?php $this->view('report');?>
</html>