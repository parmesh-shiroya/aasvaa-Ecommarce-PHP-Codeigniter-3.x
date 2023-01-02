</div>
<footer class="page-footer zero_margin grey darken-3">
<div class="pp-container">
  <div class="pp-row g8plr30 pp-zero_padding_in_small  pp-equaldist">
    <div class="pp-col">
      <p class="white-text footer-title font21">Get to Know Us</p>
      <p><a href="<?php echo site_url('contact_us'); ?>"  class=" ">Contact Us</a></p>
      <p><a href="<?php echo site_url('about_us'); ?>"  class="">About Us</a></p>
      <p><a href="<?php echo site_url(); ?>"  class="">Gift Card</a></p>
      <p><a href="<?php echo site_url('testimony/index'); ?>"  class="">Testimonials</a></p>
      <p><a href="<?php echo site_url('payment_option'); ?>"  class=" ">Payment Options</a></p>

    </div>
    <div class="pp-col">
      <p class="white-text footer-title font21">Our Policies</p>
      <p><a href="<?php echo site_url('terms_and_conditions'); ?>"  class=" ">Terms & Conditions</a></p>
      <p><a href="<?php echo site_url('policy/privacy_policy'); ?>"  class=" ">Privacy Policy</a></p>
      <p><a href="<?php echo site_url('policy/shipping_policy'); ?>"  class=" ">Shipping Policy</a></p>
      <p><a href="<?php echo site_url('policy/return_policy'); ?>"  class="">Return Policy</a></p>
    </div>
    <div class="pp-col">
      <p class="white-text footer-title font21">Let Us Help You</p>
      <p><a href="<?php echo site_url('account/dashboard'); ?>"  class=" ">Your Account</a></p>
      <p><a href="<?php echo site_url('account/my_account/my_wish_list'); ?>"  class=" ">Wish List</a></p>
      <p><a href="<?php echo site_url('account/my_account/order_history'); ?>"  class=" ">Track Order</a></p>
      <p><a href="<?php echo site_url('faq'); ?>"  class=" ">FAQs</a></p>
      <p><a href="<?php echo site_url('size_guide'); ?>"  class=" ">Size Guide</a></p>
    </div>

  </div>
  <div class="divider g8mlr30 pp-zero_margin_in_small grey darken-2 g8mtb30"></div><div class="pp-row pp-zero_padding_in_small g8plr30  pp-equaldist">
    <div class="pp-col g8pl25">
      <p class="white-text footer-title font21">Shipping Partners</p>
      <img class="responsive-img" src="<?php echo base_url('assetes/img/shipping_partners.jpg'); ?>" width="370px">

      <p class="white-text footer-title font21">We Accept</p>
      <img class="responsive-img" src="<?php echo base_url('assetes/img/paypal.png'); ?>" width="">
    </div>
  <div class="pp-col">
  <?php $adm_data = $this->pp_loader_helper->get_adm_prof_data();?>
      <p class="white-text footer-title font21">Contact us</p>

      <h6 class="font-karla g8mtb10 white-text valign-wrapper g8ls4"><i class="material-icons grey darken-2 white-text margin_r_10 p-padding_5">place</i><span  style="max-width: 300px;" class="g8fs12"><?php echo $adm_data['shop_add']; ?></span></h6>
<h6 class="font-karla g8mtb10 white-text valign-wrapper g8ls4"><i class="material-icons grey darken-2 white-text margin_r_10 p-padding_5">call</i><span class="g8fs12">Phone: +91 <?php echo $adm_data['mobile_no']; ?></span></h6>
<h6 class="font-karla g8mtb10 white-text valign-wrapper g8ls4"><i class="material-icons grey darken-2 white-text margin_r_10 p-padding_5">email</i><span class="g8fs12">Email: <?php echo $adm_data['customer_support_email']; ?></span></h6>

    </div>
<div class="pp-col">
     <div >
     <form class="pp-form" id="subscribe_form" action="<?php echo site_url(); ?>" method="post">
  <p class="white-text footer-title g8pt15 font21">Subscribe Here</p>
       <div class="pp-text-field white">

         <input name="email_id" placeholder="Email Address" class="sub_email_input news-letter-txb white-text zero_margin" style="max-width: 73%; width: 300px;" type="text">
         <button type="submit" class="c-btna g8plr12  white black-text">Submit</button>
       </div>
       </form>
  </div>
  <p class="white-text footer-title g8pt15 font21">Follow Us On</p>
      <div class="pp-row zero_margin ">
            <div class="pp-col g8mr15 center fb share-button ps4"><a href=""><i class="fa fa-facebook white-text font18" aria-hidden="true"></i></a></div>
            <div class="pp-col g8mr15 share-button go center ps4"><a href=""><i class="fa fa-google-plus white-text font18" aria-hidden="true"></i></a></div>
        <div class="pp-col g8mr15 share-button go center ps4"><a href=""><i class="fa fa-instagram white-text font18" aria-hidden="true"></i></a></div>
            <div class="pp-col g8mr15 share-button pi center ps4"><a href=""><i class="fa fa-pinterest-p white-text font18" aria-hidden="true"></i></a></div>
          </div>
    </div>
  </div>
</div>
<div class="footer-copyright grey darken-4">
  <div class="container font-rubik">
    © <?php echo date('Y'); ?>Copyright Text
    <a class="grey-text text-lighten-4 right" href="http://color9infotech.com">More Links</a>
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
.page-footer  .news-letter-txb{
  max-width: 77%;
  width: 300px;
  background: #424242 !important;
  font-size: 14px !important;
}
.page-footer  .news-letter-txb:focus{
    background: #424242 !important;
  box-shadow: 0 0 4px #dcdcdc !important;
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


<script src="https://www.gstatic.com/firebasejs/3.7.0/firebase.js"></script>
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


<script>
  $(document).ready(function() {
$("#subscribe_form").on('submit', function(event) {
  event.preventDefault();
  var email_ids = $("#subscribe_form .sub_email_input").val();
  $.post(base_url+'api/web_api', {method: 'subscribe_cust',email_id:email_ids }, function(data, textStatus, xhr) {
    if (data.result == "0") {
         Lobibox.notify('default', {
    msg: data.errorsdata.email_id,
});

      // $("#subscribe_form .sub_email_input").val("");
    }else if(data.result == "1"){
       Lobibox.notify('default', {
    msg: 'Successfully Subscribed!.'
});

      $("#subscribe_form .sub_email_input").val("");
    }
  },"json");
});
  });
</script>