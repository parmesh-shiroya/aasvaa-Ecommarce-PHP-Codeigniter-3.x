 <div class="pp-row g8fs14">
    <div class="pp-col ps12">
      <ul class="tabs border3-1px">
        <li class="tab pp-col ps4"><a  class="active" href="#pen_rev">Pending</a></li>
        <li class="tab pp-col ps4"><a href="#app_rev">Approved</a></li>
        <li class="tab pp-col ps4"><a href="#dec_rev">Decline</a></li>
      </ul>
    </div>
    <div id="pen_rev" class="pp-col ps12">
<div class="pp-row g8m0">
  <div class="pp-col card p-padding_15 ps12">
    <table id="pen_review_table" class="black-text g8fs13">
      <thead>
        <tr>
          <th class="center" data-field="no">No <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="sky">Customer Name <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="sub_cat">Product id <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="sub_cat">Review <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="name">Star <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th class="center" data-field="stock">Date</th>
          <th class="center" >Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
$a = 1;
foreach ($result as $key => $value) {
	if ($value['status'] == 0) {
		?>
        <tr>
          <td class="center">
<?php echo $a; ?></td>
          <td class="font-capitalize"><?php echo $value['first_name'] . ' ' . $value['last_name']; ?></td>
          <td><?php echo $value['prod_id']; ?></td>
          <td><?php echo $value['review']; ?></td>
          <td class="center "><?php echo $value['star']; ?></td>
          <td class="center"><?php echo $value['re_date'] ?></td>
       <td class="center">
       	<button rev-id="<?php echo $value['id']; ?>"  class="c-btnp green app_btn">Approved</button>
       	<button  rev-id="<?php echo $value['id']; ?>"  class="c-btnp red dec_btn">Decline</button>
       </td>
        </tr>
        <?php $a++;}}?>
      </tbody>
    </table>
  </div>
</div>
    </div>
    <div id="app_rev" class="pp-col ps12">
    <div class="pp-row g8m0">
  <div class="pp-col card p-padding_15 ps12">
    <table id="app_review_table" class="black-text ">
      <thead>
        <tr>
          <th class="center" data-field="no">No <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="sky">Customer Name <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="sub_cat">Product id <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="sub_cat">Review <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="name">Star <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th class="center" data-field="stock">Date</th>
          <th class="center" >Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
$a = 1;
foreach ($result as $key => $value) {
	if ($value['status'] == 1) {?>
        <tr>
          <td class="center">
<?php echo $a; ?></td>
          <td class="font-capitalize"><?php echo $value['first_name'] . ' ' . $value['last_name']; ?></td>
          <td><?php echo $value['prod_id']; ?></td>
          <td><?php echo $value['review']; ?></td>
          <td class="center "><?php echo $value['star']; ?></td>
          <td class="center"><?php echo $value['re_date'] ?></td>
       <td class="center">
       	<button  rev-id="<?php echo $value['id']; ?>"  class="c-btnp red dec_btn">Decline</button>
       </td>
        </tr>
        <?php $a++;}}?>
      </tbody>
    </table>
  </div>
</div>
</div>
    <div id="dec_rev" class="pp-col ps12">
    	<div class="pp-row g8m0">
  <div class="pp-col card p-padding_15 ps12">
    <table id="dec_review_table" class="black-text ">
      <thead>
        <tr>
          <th class="center" data-field="no">No <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="sky">Customer Name <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="sub_cat">Product id <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="sub_cat">Review <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th data-field="name">Star <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
          <th class="center" data-field="stock">Date</th>
          <th class="center" >Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
$a = 1;
foreach ($result as $key => $value) {
	if ($value['status'] == 2) {?>
        <tr>
          <td class="center">
<?php echo $a; ?></td>
          <td class="font-capitalize"><?php echo $value['first_name'] . ' ' . $value['last_name']; ?></td>
          <td><?php echo $value['prod_id']; ?></td>
          <td><?php echo $value['review']; ?></td>
          <td class="center "><?php echo $value['star']; ?></td>
          <td class="center"><?php echo $value['re_date'] ?></td>
       <td class="center"><button  rev-id="<?php echo $value['id']; ?>"  class="c-btnp app_btn green">Approved</button></td>
        </tr>
        <?php $a++;}}?>
      </tbody>
    </table>
  </div>
</div>
    </div>
  </div>


<style type="text/css">
table tr td{
  border-bottom: 1px solid #eee;
}
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
$('#pen_review_table').DataTable({
"pageLength": 50
});
$('#app_review_table').DataTable({
"pageLength": 50
});
$('#dec_review_table').DataTable({
"pageLength": 50
});

$(".app_btn").on('click', function(event) {
	event.preventDefault();
	var rev_id = $(this).attr('rev-id');
	$.post(base_url+'admin/prodman/reviewmanager/change_status', {rev_id: rev_id,status:"1"}, function(data, textStatus, xhr) {
		if (data.result == true) {
 Lobibox.notify('default', {
 	position:'bottom center',
    msg: 'Status Update Successfully.'
});
		}

	},'json');
});


$(".dec_btn").on('click', function(event) {
	event.preventDefault();
	var rev_id = $(this).attr('rev-id');
	$.post(base_url+'admin/prodman/reviewmanager/change_status', {rev_id: rev_id,status:"2"}, function(data, textStatus, xhr) {
		if (data.result == true) {
 Lobibox.notify('default', {
 	position:'bottom center',
    msg: 'Status Update Successfully.'
});
		}

	},'json');
});
});
</script>