<?php
$company_data = $this->pp_loader_helper->get_adm_prof_data();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Order Placed Successfully</title>
</head>
<body>
<table style="border-collapse:collapse;table-layout:fixed;min-width:320px;width:100%;background-color:#fff" border="0">
  <tbody>
    <tr>
      <td width="100%">
      <div style="width:100%;">
      <div style="max-width:650px; border: 1px solid #ddd; margin:0 auto;">
      <table width="100%" border="0"><tbody><tr>
      <td width="100%" height="83">
      <div style="float: left; margin-left: 15px;"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assetes/img/small/logo.png'); ?>" alt="AASVAA IMAGE" width="260" align="middle"/></a></div>
      <div style="float: right; margin-right: 15px; margin-top: 10px;">
      <img src="<?php echo base_url('assetes/img/small/mail_image1.png'); ?>" alt="" height="37" align="middle"/>
      <img src="<?php echo base_url('assetes/img/small/mail_image2.png'); ?>" alt="" height="37" align="middle"/>
      <img src="<?php echo base_url('assetes/img/small/mail_image3.png'); ?>" alt=""  height="37" align="middle"/>
      </div>
      </td>
    </tr>
    <tr>
    	<td>
    		<table width="100%" style="padding: 10px 0px; font-size: 13px; font-weight: 600; border-top: 2px solid #000; border-bottom: 2px solid #000;" border="0">
  <tbody >
    <tr>
      <td width="14%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Sarees</a></center></td>
      <td width="21%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Lehengha Choli</a></center></td>
      <td width="16%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Indowestern</a></center></td>
      <td width="21%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Salwar Kameez</a></center></td>
      <td width="14%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Accessories</a></center></td>
      <td width="14%"><center><a style="color: black;" href="<?php echo base_url(); ?>">Sale</a></center></td>
    </tr>
  </tbody>
</table>

    	</td>
    </tr>
    <tr style="font-family:'roboto',sans-serif;">
      <td style="background: #FAFBFC" height="210"><div style="margin: 15px"><h4>Hi <?php echo $form_data->name; ?>,</h4>
      <p style="font-size:14px; color:#A3A6A6; letter-spacing: 0.6px;">Your have query regarding <?php
switch ($form_data->subject) {
case '0':
	echo 'Product Enquiry';
	break;
case '1':
	echo 'Order Enquiry';
	break;
case '2':
	echo 'General Enquiry';
	break;
case '3':
	echo 'Enquiry for Custom made product';
	break;
case '4':
	echo 'Wholesale Enquiry';
	break;
case '5':
	echo 'Suggestions & feedbacks';
	break;
case '6':
	echo 'Others';
	break;

default:
	# code...
	break;
}
?>.</p>
      <p style="font-size:14px; font-style: bold; letter-spacing: 0.6px;">Que :- <?php echo $form_data->description; ?></p>
      <p style="font-size:14px; letter-spacing: 0.6px;">Replay :- <?php echo $form_data->response; ?></p>
      <p style="font-size:12px; color:#A3A6A6; letter-spacing: 0.4px;">If you have any question regarding us. Please contact us.</p>
      </div></td>
    </tr>
    <tr>
      <td style="font-size: 14px; padding: 15px;">
      	<div style="padding-left: 4px;"><strong>Mail Us : </strong><?php echo $company_data['customer_support_email']; ?></div>
      	<div style="padding: 8px 4px;  border-bottom: 2px solid #000;"><strong>Customer care No : </strong>+91 <?php echo $company_data['mobile_no']; ?></div>
      	<div style="padding: 15px 0px;"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assetes/img/small/logo.png'); ?>" alt="AASVAA IMAGE" width="260" align="middle"/></a></div>
      	<div></div>
      </td>
    </tr>
  </tbody>
</table></div></div></td>

    </tr>
  </tbody>
</table>
</body>
</html>