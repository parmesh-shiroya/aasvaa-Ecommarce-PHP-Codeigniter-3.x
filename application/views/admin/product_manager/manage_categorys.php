<div class="pp-row ">
	<div class="pp-col loadder hidden  pm12">
		<div class="pp-col pm2  padding1"></div>
		<div class="pp-col pm8">
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
		</div>
		<div class="pp-col pm2"></div>
	</div>
	<div class="pp-col ps4 ">
		<div class="pp-col ps12 card">
			<form id="main_cate_add_form" class="pp-form">
				<div class="pp-col pm12">
					<h6 class="title font18 center-align">Add Main Category</h6>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Category Name</label>
						<input placeholder="Category Name" name="main_cat_name" required type="text" class="">
					</div>
				</div>
				<div class="pp-col pp-padres ps12 center">
					<button type="submit" class="btn primary-light">Add</button>
				</div>
			</form>
		</div>
	</div>
	<div class="pp-col ps4 ">
		<div class="pp-col ps12 card">
			<form id="sub_cate_add_form" class="pp-form">
				<div class="pp-col pm12">
					<h6 class="title font18 center-align">Add Sub Category</h6>
				</div>
				<div class="pp-col pp-text-field pp-padres ps12">
					<label>Main Category</label>
					<select required name="main_cat_id" id="main_cate_select" class="browser-default grey-text text-darken-2">
						<option value="" disabled selected>Select</option>
					</select>
				</div>
				<div class="pp-col pp-text-field pp-padres pm12">
					<label>Category Name</label>
					<input placeholder="Category Name" name="sub_cat_name" required type="text" class="">
				</div>
				<div class="pp-col pp-padres ps12 center">
					<button type="submit" class="btn primary-light">Add</button>
				</div>
			</form>
		</div>
	</div>
	<div class="pp-col ps4 ">
		<div class="pp-col black-text ps12 center">

		<h6 class="title font18 center-align">Default Image</h6>
		<span>Image size :- 1300 * 250</span><br>
		<div class="p-padding_lr_12 p-padding_tb_12 font14"><div class="font-capitalize grey-text text-darken-1"><input id="image_file_button_2" type="file" style="width: 100%; height: 100%; position: relative; left: 0; top: 0; " main-cat-id="0" class="image_file_button_2"  name="imagesFile[]" ></div></div>
			<div class=" p-padding_lr_12"><div class="font-capitalize grey-text image_div_0 text-darken-1">
			<?php
foreach ($images as $key3 => $value3) {
	if ($value3->b_keys == "main_cat_0") {?>
<img src="<?php echo base_url('uploads/banner/main_cat_banner/1300_250/' . $value3->b_values); ?>" class="responsive-img">
	<?php }
}
?>
			</div>
			</div>




			<!-- <form id="main_cate_add_form" class="pp-form">
				<div class="pp-col pm12">
					<h5 class="grey-text center-align">Add Main Category</h5>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Category Name</label>
						<input placeholder="Category Name" name="main_cat_name" required type="text" class="">
					</div>
				</div>
				<div class="pp-col pp-padres ps12 center">
					<button type="submit" class="btn primary-light">Add</button>
				</div>
			</form> -->
		</div>
	</div>
</div>
<hr class="white-text">
<div class="pp-row black-text">
	<?php
foreach ($main_cats as $key => $value) {
	?>
	<div class="pp-col ps3">
		<ul class="collection with-header">
			<li class="collection-header font-roboto_slab opacity9 primary-light"><span class="font16 white-text font-capitalize"><?php echo $value->cat_name; ?></span></li>
			<li class="collection-item p-padding_lr_12"><div class="font-capitalize grey-text text-darken-1"><input id="image_file_button_2" type="file" style="width: 100%; height: 100%; position: relative; left: 0; top: 0; " main-cat-id="<?php echo $value->main_cat_id; ?>" class="image_file_button_2"  name="imagesFile[]" ></div></li>
			<li class="collection-item p-padding_lr_12"><div class="font-capitalize grey-text image_div_<?php echo $value->main_cat_id; ?> text-darken-1">
			<?php
foreach ($images as $key3 => $value3) {
		if ($value3->b_keys == "main_cat_" . $value->main_cat_id) {?>
<img src="<?php echo base_url('uploads/banner/main_cat_banner/1300_250/' . $value3->b_values); ?>" class="responsive-img">
	<?php }
	}
	?>

			</div></li>
			<?php foreach ($sub_cats as $key1 => $value1) {
		if ($value1->main_cat_id == $value->main_cat_id) {?>
			<li class="collection-item"><div class="font-capitalize grey-text font14 text-darken-1"><?php echo $value1->cat_name; ?><!-- <a href="#!" class="secondary-content"><i class="material-icons">send</i></a> --></div></li>
			<?php }
	}?>
		</ul>
	</div>
	<?php
}
?>
</div>
<script>
	$(document).ready(function() {
$("#main_cate_add_form").on('submit', function(event) {
event.preventDefault();
$(".loadder").removeClass('hidden');
var datas= $(this).serialize();
$.post(base_url+'admin/prodman/managecategory/add_main',  datas  , function(data, textStatus, xhr) {
if(data.result == true){
	Materialize.toast('Category Add Successfully.', 4000);
$('#main_cate_add_form').find('.pp-error-text').remove();
$('#main_cate_add_form').find('.pp-text-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
$('#main_cate_add_form').find("input[type]").val("");
get_main_cates();
}else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#main_cate_add_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#main_cate_add_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#main_cate_add_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');
});
$("#sub_cate_add_form").on('submit', function(event) {
event.preventDefault();
$(".loadder").removeClass('hidden');
var datas= $(this).serialize();
$.post(base_url+'admin/prodman/managecategory/add_sub',  datas  , function(data, textStatus, xhr) {
	$(".loadder").addClass('hidden');
if(data.result == true){
	Materialize.toast('Category Add Successfully.', 4000);
$('#sub_cate_add_form').find('.pp-error-text').remove();
$('#sub_cate_add_form').find('.pp-text-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
$('#sub_cate_add_form').find("input[type]").val("");
}else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#sub_cate_add_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#sub_cate_add_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#sub_cate_add_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');
});
get_main_cates();
function get_main_cates(){
$.post(base_url+'admin/prodman/managecategory/main_cats', {datas: 'value1'}, function(data, textStatus, xhr) {
	console.log(data);
	$(".loadder").addClass('hidden');
	var html = "";
	$.each(data,function(index, el) {
		html += "<option value='"+el.main_cat_id+"'>"+el.cat_name+"</option>";
	});
	$("#main_cate_select").html(html);
},"json");
}



$(".image_file_button_2").on('change', function(event) {
var file_data = $(this).prop('files')[0];
var main_cat_id = $(this).attr('main-cat-id');
var form_data = new FormData();
for (var i = 0; i < event.target.files.length; i++) {
var file = event.target.files[i];
if (!file.type.match('image.*')) {
// Check for File type. the 'type' property is a string, it facilitates usage if match() function to do the matching
error = 1;
Materialize.toast("File Is Not Image",3000);
} else if (file.size > 5048576) {
error = 1;
Materialize.toast("Image Size Is To Large",3000);
} else {
// If all goes well, append the up-loadable file to FormData object
form_data.append('imagesFile[]', file, file.name);
// Comparing it to a standard form submission the 'image' will be name of input
}
}
// alert(form_data);
$.ajax({
url: base_url + '/admin/adminapi/upload_main_cat_banner_image_with_ajax', // point to server-side PHP script
dataType: 'json', // what to expect back from the PHP script, if anything
cache: false,
contentType: false,
processData: false,
data: form_data,
type: 'post',
success: function(data) {
if (data.response == 'done') {
	var image_path = base_url + 'uploads/banner/main_cat_banner/1300_250/' + data.image_names[0];
	$.post(base_url+'admin/prodman/managecategory/insert_banner_data', {main_cat_id: main_cat_id,imgs:data.image_names[0]}, function(data, textStatus, xhr) {

var time = $.now();
$(".image_div_"+main_cat_id).html('<img src="' + image_path + '" img-key="' + time + '" class="responsive-img">');
	});
}
}
});
});


	});
</script>