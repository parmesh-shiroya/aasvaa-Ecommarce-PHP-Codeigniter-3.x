
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
						<div class="collapsible-header teal-text font-bold">Custom Link</div>
						<div class="collapsible-body"><form id="add_mobile_nav_link" class="pp-form">
							<div class="border-none pp-text-field">
								<label>Name</label>
								<input placeholder="Name" id="name_link" name="name_link"  type="text" class=" ">
							</div>
							<div class="border-none pp-text-field">
								<label>Link</label>
								<input placeholder="https://www.google.co.in" id="link_link" name="link_link"  type="text" class=" ">
							</div>
							<button class="btn waves-effect waves-light margin-l-20" type="submit" name="add_product_submit">Add
							</button>
						</form></div>
					</li>
					<li>
						<div class="collapsible-header teal-text font-bold">Section</div>
						<div class="collapsible-body"><form id="add_nav_section" class="pp-form">
							<div class="border-none pp-text-field">
								<label>Name</label>
								<input placeholder="Name" id="name_link" name="name_link"  type="text" class=" ">
							</div>
							<button class="btn waves-effect waves-light margin-l-20" type="submit" name="add_product_submit">Add
							</button>
						</form></div>
					</li>
					<li>
						<div class="collapsible-header teal-text font-bold">Title</div>
						<div class="collapsible-body"><form id="add_nav_section_title" class="pp-form">
							<div class="border-none pp-text-field">
								<label>Name</label>
								<input placeholder="Name" id="name_link" name="name_link"  type="text" class=" ">
							</div>
							<button class="btn waves-effect waves-light margin-l-20" type="submit" name="add_product_submit">Add
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
							$positions = $main_nav_menu['position'];
							$links     = json_decode(stripslashes($main_nav_menu['links']));
							$names     = json_decode(stripslashes($main_nav_menu['names']));
							$types     = json_decode(stripslashes($main_nav_menu['types']));
							foreach ($positions as $key => $value) {
							;?>

						<li class="dd-item" link="<?php echo (isset($links->$value['id'])) ? $links->$value['id'] : ''; ?>" type="<?php echo $types->$value['id']; ?>" name="<?php echo $names->$value['id']; ?>" data-id="<?php echo $value['id']; ?>">
						<!-- 	<button data-action="collapse" type="button">Collapse</button>
		<button data-action="expand" type="button" style="display: none;">Expand</button> -->
							<div class="dd-handle dd3-handle"></div>
							<div class=" dd-content"><?php echo $names->$value['id'];
							                         		echo ($types->$value['id'] == 'section') ? ' (Section)' : '';
							                         	echo ($types->$value['id'] == 'title') ? ' (Title)' : '';
							                         	echo ($types->$value['id'] == 'link') ? ' (' . $links->$value['id'] . ')' : ''; ?><span class="right delete-span"><i class="material-icons font18">clear</i></span></div>
							<?php if (isset($value['children'])) {
										echo '<ol class="dd-list">';
										foreach ($value['children'] as $key1 => $value1) {
										?>


								<li class="dd-item" type="<?php echo $types->$value1['id']; ?>" name="<?php echo $names->$value1['id']; ?>" link="<?php echo (isset($links->$value1['id'])) ? $links->$value1['id'] : ''; ?>" data-id="<?php echo $value1['id']; ?>">
								<!-- 	<button data-action="collapse" type="button">Collapse</button>
		<button data-action="expand" type="button" style="display: none;">Expand</button> -->
									<div class="dd-handle dd3-handle"></div>
							<div class=" dd-content"><?php echo $names->$value1['id'];
							                         				echo ($types->$value1['id'] == 'section') ? ' (Section)' : '';
							                         			echo ($types->$value1['id'] == 'link') ? ' (' . $links->$value['id'] . ')' : '';
							                         			echo ($types->$value1['id'] == 'title') ? ' (Title)' : ''; ?><span class="right delete-span"><i class="material-icons font18">clear</i></span></div>
									<?php if (isset($value1['children'])) {
														echo '<ol class="dd-list">';
														foreach ($value1['children'] as $key2 => $value2) {
														?>


								<li class="dd-item" type="<?php echo $types->$value2['id']; ?>" name="<?php echo $names->$value2['id']; ?>" link="<?php echo (isset($links->$value2['id'])) ? $links->$value2['id'] : ''; ?>" data-id="<?php echo $value2['id']; ?>">
									<div class="dd-handle dd3-handle"></div>
									<div class=" dd-content"><?php echo $names->$value2['id'];
									                         						echo ($types->$value2['id'] == 'section') ? ' (Section)' : '';
									                         					echo ($types->$value2['id'] == 'link') ? ' (' . $links->$value['id'] . ')' : '';
									                         					echo ($types->$value2['id'] == 'title') ? ' (Title)' : ''; ?><span class="right delete-span"><i class="material-icons font18">clear</i></span></div>
								</li>

		<?php }
							echo '</ol>';
					}?>
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
$('.dd').nestable({maxDepth:3});
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
	var type_array = {};
	console.log($('.dragable_div').nestable('serialize'));
	$("li[data-id]").each(function(index, el) {
		console.log();
		var id = $(this).attr('data-id');
		var link = $(this).attr('link');
		var name = $(this).attr('name');
		var type = $(this).attr('type');
		arrays[id] = link;
		name_arrays[id] = name;
		type_array[id] = type;
	});
	console.log(position);
	console.log(arrays);
	console.log(name_arrays);
	console.log(type_array);
$.post(base_url+'admin/theme/nav_menu_manager/save_main_nav_menu', {positions: position,links:JSON.stringify(arrays),names:JSON.stringify(name_arrays),types:JSON.stringify(type_array)}, function(data, textStatus, xhr) {
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
					var html = '<li class="dd-item" name="'+name+'" type="cate" link="'+link+'" data-id="'+drag_id+'"><div class="dd-handle dd3-handle"></div><div class="dd-content">'+name+'<span class="right delete-span"><i class="material-icons font18">clear</i></span></div></li>';
$(".dragable_div .dd-main-list").append(html);
});
$("#add_mobile_nav_link").on('submit', function(event) {
	event.preventDefault();
	var name = $("#add_mobile_nav_link #name_link").val();
	var link = $("#add_mobile_nav_link #link_link").val();
	var drag_id = $.now();
	if ($.trim(name) != '' && $.trim(link) != "") {
					var html = '<li class="dd-item" name="'+name+'" type="link" link="'+link+'" data-id="'+drag_id+'"><div class="dd-handle dd3-handle"></div><div class="dd-content">'+name+' ('+link+')<span class="right delete-span"><i class="material-icons font18">clear</i></span></div></li>';
$(".dragable_div .dd-main-list").append(html);
	var name = $("#add_mobile_nav_link #name_link").val("");
	var link = $("#add_mobile_nav_link #link_link").val("");
	}
});
$("#add_nav_section_title").on('submit', function(event) {
	event.preventDefault();
	var name = $("#add_nav_section_title #name_link").val();
	var drag_id = $.now();
	if ($.trim(name) != '') {
					var html = '<li class="dd-item" name="'+name+'" type="title" data-id="'+drag_id+'"><div class="dd-handle dd3-handle"></div><div class="dd-content">'+name+ ' (Title)<span class="right delete-span"><i class="material-icons font18">clear</i></span></div></li>';
$(".dragable_div .dd-main-list").append(html);
	var name = $("#add_nav_section_title #name_link").val("");
	}
});

$("#add_nav_section").on('submit', function(event) {
	event.preventDefault();
	var name = $("#add_nav_section #name_link").val();
	var drag_id = $.now();
	if ($.trim(name) != '') {
					var html = '<li class="dd-item" name="'+name+'" type="section" data-id="'+drag_id+'"><div class="dd-handle dd3-handle"></div><div class="dd-content">'+name+ ' (Section)<span class="right delete-span"><i class="material-icons font18">clear</i></span></div></li>';
$(".dragable_div .dd-main-list").append(html);
	var name = $("#add_nav_section #name_link").val("");
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