<div class="pp-row">
<div class="pp-col card p-padding_15 ps12">
  <table id="customer_table" class="black-text g8fs13 font-karla striped">
        <thead>
          <tr>
              <th class="center " data-field="no">No <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>

              <th class="center"  data-field="name">Name <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
              <!-- <th data-field="cat">Category</th> -->
              <th class="center"  data-field="email">Email Id<img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
              <th class="center"  data-field="mobile_no">Mobile No<img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
              <th class="center">Login With</th>
              <th class="center" data-field="last_login">Last Login</th>
              <th class="center">Action</th>
          </tr>
        </thead>

        <tbody>
        <?php
$a = 1;
foreach ($customers as $key => $value) {
	?>
          <tr>
            <td class="center"><?php echo $a; ?></td>
            <td class="font-capitalize"><?php echo $value['first_name'] . " " . $value['last_name']; ?></td>
             <td class="center "><?php echo $value['email_id']; ?></td>
            <td class="center"><?php echo $value['mobileno']; ?></td>
            <td class="center"><?php
switch ($value['login_with']) {
	case 'web':
		echo '<i class="fa teal-text font21 fa-globe" aria-hidden="true"></i>';
		break;
	case 'google':
		echo '<i class="fa red-text font21 text-lighten-1 fa-google" aria-hidden="true"></i>';
		break;

	case 'facebook':
		echo '<i style="color:#3B5998;" class="fa font21 fa-facebook" aria-hidden="true"></i>';

		break;
	case 'guest_login':
		echo '<i style="color:#333;" class="fa font21 fa-user" aria-hidden="true"></i>';
		break;
	}
	?></td>
            <td class="center"><?php echo $value['last_login']; ?></td>
<td class="center"><button class="c-btnp customer_login" cust-id = "<?php echo $value['id']; ?>"><i class="material-icons vam">vpn_key</i></button></td>
          </tr>
          <?php $a++;}?>
        </tbody>
      </table>
</div>

</div>
<style type="text/css">
  input[type="search"]{
margin-top: 5px;
    border-radius:3px ;
    color:#888;
    border:1px solid #DCDCDC;

    font-size:16px ;
    height: 35px ;
    line-height:30px ;
width: auto !important;
    padding: 10px ;
    text-transform: capitalize;
        -webkit-transition: all .25s ;
           -moz-transition: all .25s ;
            -ms-transition: all .25s ;
             -o-transition: all .25s ;
                transition: all .25s ;
  }
</style>
<script type="text/javascript">
  $(document).ready(function(){
    $('#customer_table').DataTable({
      "pageLength": 50
    });
    $(".customer_login").on('click', function(event) {
      event.preventDefault();
      var cust_id  = $(this).attr('cust-id');
      $.post(base_url+'admin/customers/man_customers/login_customer', {cust_ids: cust_id}, function(data, textStatus, xhr) {
        console.log(data);
if (data.result == true) {
window.open(base_url+"account/dashboard");
}else{
  Materialize.toast('Something Wrong.', 3000);
}
      },"json");
    });
});
</script>