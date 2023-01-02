<div class="pp-col card ps12">
	<div class="pp-col p-padding_10 ps12">
		<h6 class="title  font18">My Address</h6>
	</div>
	<div class="pp-col ps12">
		<?php foreach ($addresses as $key => $value) {?>
		<div class="pp-col pp-margin-tb-7 address_div valign-wrapper zero_padding ps12">
			<div class="pp-col zero_padding ps7 grey-text text-darken-1 font13" >
				<span class="font-capitalize"><?php echo $value->name; ?></span><br>
				<span><?php echo $value->address1; ?></span><br>
				<span><?php echo $value->address2; ?></span><br>
				<span><?php echo $value->city . "-" . $value->post_code; ?></span><br>
				<span><?php echo $value->mobile_no; ?></span><br>
				<span><?php echo $value->state; ?></span>
			</div>
			<div class="pp-col zero_padding ps5 valign-wrapper grey-text text-darken-1 font13" >
				<span class=""><a href="<?php echo site_url('account/my_account/edit_address/' . $value->id); ?>" add-data="<?php echo $value->id; ?>" class="grey-text valign-wrapper grey-darken-2 hover-text-primary"><i class="material-icons p-padding_r_7">mode_edit</i> Edit</a></span>
				<span class="p-padding_l_20"><a add-data="<?php echo $value->id; ?>" class=" grey-text valign-wrapper delete_address grey-darken-2 hover-text-primary"><i class="material-icons p-padding_r_7">delete_forever</i> Delete</a></span>
			</div>
		</div>
		<?php }?>
	</div>
</div>
<style type="text/css" media="screen">
	.address_div{
		border-bottom: 1px #ddd solid;
	}
</style>

<script>
function show_confire_box(object){
	swal({
  title: "Are you sure?",
  text: 'You want to delete this address?',
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
function(){
delete_address(object);
});
}
function delete_address(objects){
		var addressid = $(objects).attr('add-data');

var object_div = $(objects).parents(".address_div");
		$.post(base_url+'account/My_account/delete_add', {add_id: addressid}, function(data, textStatus, xhr) {
			console.log(data);
			swal.close();
			if(data.result == true){
				 Lobibox.notify('default', {
    msg: 'Delete Address Successfully.'
});

object_div.remove();
			}else{
				Lobibox.notify('default', {
    msg: 'Error: Reload Page..'
});

				location.reload();
			}
		},"json");
	}
	$(".delete_address").on('click', function(event) {
		event.preventDefault();
		var objects = $(this);
		show_confire_box(objects);

	});
</script>