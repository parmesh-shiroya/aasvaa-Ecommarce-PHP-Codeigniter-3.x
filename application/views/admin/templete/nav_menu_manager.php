<div class="pp-row">
	<div class="pp-col  black-text p-padding_15 ps12">
		<div class="pp-col ps4">
			<div class="pp-col card ps12">
				<ul class="collapsible" data-collapsible="accordion">
					<li>
						<div class="collapsible-header teal-text font-bold">Main Category</div>
						<div class="collapsible-body">
							<?php
foreach ($main_cate as $cat) {?>
							<div><span class="font-bold"><?php echo $cat->cat_name; ?></span><span name="<?php echo $cat->cat_name; ?>" add-id="main_cat#<?php echo $cat->main_cat_id; ?>" link="cate/m_cat/<?php echo $cat->main_cat_id . '/' . $cat->cat_name; ?>" class="hover-text-primary add_button right">Add</span></div>
							<?php }?>
						</div>
					</li>
					<li>
						<div class="collapsible-header  teal-text font-bold">Sub Category</div>
						<div class="collapsible-body ">
							<?php
foreach ($sub_cate as $cat) {?>
							<div><span class="font-bold"><?php echo $cat->cat_name . ' (' . $cat->main_cat_name . ')'; ?></span><span name="<?php echo $cat->cat_name; ?>" add-id="sub_cat#<?php echo $cat->sub_cat_id; ?>" link="cate/s_cat/<?php echo $cat->sub_cat_id . '/' . $cat->cat_name; ?>" class="hover-text-primary add_button right">Add</span></div>
							<?php }?>
						</div>
					</li>
					<li>
						<div class="collapsible-header teal-text font-bold">Custom</div>
						<div class="collapsible-body"><form id="add_mobile_nav_link" class="pp-form">
							<div class="border-none pp-text-field">
					<label>Name</label>
					<input placeholder="Name" id="name_link" name="name_link"  type="text" class=" ">
				</div>
				<div class="border-none pp-text-field">
					<label>Link</label>
					<input placeholder="https://www.google.co.in" id="link_link" name="link_link"  type="text" class=" ">
				</div>

				<button class="btn waves-effect waves-light " type="submit" name="add_product_submit">Add
						</button>
						</form></div>
					</li>
				</ul>
			</div>
		</div>
		<div class="pp-col  ps8">
			<div class="pp-col card p-padding_15 ps12">
				<div class="dd dragable_div">
					<ol class="dd-list dd-main-list">
						<?php
$links = json_decode(stripslashes($mobile_nav_menu['links']));
$names = json_decode(stripslashes($mobile_nav_menu['names']));
foreach ($mobile_nav_menu['position'] as $key => $value) {
	;?>

						<li class="dd-item" link="<?php echo $links->$value['id']; ?>" name="<?php echo $names->$value['id']; ?>" data-id="<?php echo $value['id']; ?>">
							<div class="dd-handle dd3-handle"></div>
							<div class="dd-content"><?php echo $names->$value['id']; ?><span class="right delete-span"><i class="material-icons font18">clear</i></span></div>
							<?php if (isset($value['children'])) {
		echo '<ol class="dd-list">';
		foreach ($value['children'] as $key1 => $value1) {?>


								<li class="dd-item" name="<?php echo $names->$value1['id']; ?>" link="<?php echo $links->$value1['id']; ?>" data-id="<?php echo $value1['id']; ?>">
									<div class="dd-handle dd3-handle"></div>
									<div class="dd-content"><?php echo $names->$value1['id']; ?><span class="right delete-span"><i class="material-icons font18">clear</i></span></div>
								</li>

		<?php }
		echo '</ol>';
	}?>

						</li>

						<?php }?>
					</ol>
				</div>
			</div>
			<div class="pp-col p-padding_15 card ps12">
				<div class="pp-col pm4  padding1"></div>
				<button class="btn waves-effect pp-col pm3 waves-light add_product_submit" id="mob_nav_save_button">Save
				</button>
				<div class="pp-col pm4  padding1"></div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
$('.dd').nestable({maxDepth:2});
$('.dd').on('change', function() {
	var arrays = {};
	console.log($('.dragable_div').nestable('serialize'));
	$("li[data-id]").each(function(index, el) {
		console.log();
		var id = $(this).attr('data-id');
		var link = $(this).attr('link');
		arrays[id] = link;
	});
	console.log(arrays);
	// $.each($('.dragable_div').nestable('serialize'),function(index, el) {
			// 	console.log(el);
			// 	if(typeof(el.children) != "undefined" && el.children !== null) {
					// 		$.each(el.children,function(index, el) {
					// 		console.log(el);
			// 	});
	// }
	// });
});
$("#mob_nav_save_button").on('click', function(event) {
	event.preventDefault();
	var position = $('.dragable_div').nestable('serialize');
	var arrays = {};
	var name_arrays = {};
	console.log($('.dragable_div').nestable('serialize'));
	$("li[data-id]").each(function(index, el) {
		console.log();
		var id = $(this).attr('data-id');
		var link = $(this).attr('link');
		var name = $(this).attr('name');
		arrays[id] = link;
		name_arrays[id] = name;
	});
	console.log(arrays);
$.post(base_url+'admin/theme/nav_menu_manager/save_mobile_nav_menu', {positions: position,links:JSON.stringify(arrays),names:JSON.stringify(name_arrays)}, function(data, textStatus, xhr) {
	console.log(data);
	if (data == 1) {
		Materialize.toast('Save Successfully.', 4000);
	}
});
});
$(".dragable_div").on('click', '.delete-span', function(event) {
event.preventDefault();
$(this).parent(".dd-content").parent(".dd-item").remove();
});
$(".add_button").on('click', function(event) {
	event.preventDefault();
	var name = $(this).attr('name');
	var drag_id = $(this).attr('add-id');
	var link = $(this).attr('link');
			var html = '<li class="dd-item" name="'+name+'" link="'+link+'" data-id="'+drag_id+'">	<div class="dd-handle dd3-handle"></div><div class="dd-content">'+name+'<span class="right delete-span"><i class="material-icons font18">clear</i></span></div></li>';
$(".dragable_div .dd-main-list").append(html);
});

$("#add_mobile_nav_link").on('submit', function(event) {
	event.preventDefault();
	var name = $("#add_mobile_nav_link #name_link").val();
	var link = $("#add_mobile_nav_link #link_link").val();
	var drag_id = $.now();
	if ($.trim(name) != '' && $.trim(link) != "") {
			var html = '<li class="dd-item" name="'+name+'" link="'+link+'" data-id="'+drag_id+'">	<div class="dd-handle dd3-handle"></div><div class="dd-content">'+name+' ('+link+')<span class="right delete-span"><i class="material-icons font18">clear</i></span></div></li>';
$(".dragable_div .dd-main-list").append(html);
	var name = $("#add_mobile_nav_link #name_link").val("");
	var link = $("#add_mobile_nav_link #link_link").val("");
	}
});
});
</script>
<style>
.collapsible-body{
	padding: 10px;
}
.collapsible-body .add_button{
	cursor: pointer;
}
.delete-span:hover{
cursor: pointer;
color: rgb(234,67,53);
}
.collapsible-body div{
padding: 5px 10px;
margin: 3px 0px;
border: 1px solid #ddd;
}
.collapsible-body .border-none{
	border: 0px solid !important;
}
</style>