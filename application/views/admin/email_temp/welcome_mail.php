<div class="c-row gmf  grey-text text-darken-3">


		<div class="grid zero_padding g824 card">
			<div class="grid center font-roboto_slab p-padding_tb_7 teal g824 ">
				<h6 class="white-text g8fs16">Welcome Mail</h6>
			</div>
			<div class="c-row c-center">
<div class="grid g810 center">
<div class="file-field pp-form input-field">
      <div class="btn">
        <span>File</span>
        <input id="image_file_button_2"  name="imagesFile[]" class="image_file_button_2" type="file">
      </div>
      <div class="file-path-wrapper pp-text-field">
        <input  placeholder="600*274"  class="file-path  validate" type="text">
      </div>
    </div>
</div>
<div class="c-row c-center">
<div class="grid g810 center">
    <img src="<?php echo base_url('uploads/banner/email_banner/small/' . $banner_img); ?>" class="responsive-img banner-img">
    <input type="hidden" value="<?php echo $banner_img; ?>" class="banner-image_name">
  </div>
  </div>
</div>
			<div class="grid g824 gpf g8p15">
				<form action="" method="post" id="terms_and_condition_form">
					<textarea name="editor1" id="editor1" rows="10" cols="80">
					<?php if (isset($main_content)) {
	echo $main_content;
}?>
					</textarea>
					<div class="grid g824 g8mt12 center">
					<button type="submit" class="btn">Save File</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
jQuery(document).ready(function($) {
	$("#terms_and_condition_form").on('submit', function(event) {
		event.preventDefault();

	});
CKEDITOR.replace( 'editor1' );
$("#terms_and_condition_form").on('submit', function(event) {
	event.preventDefault();
	var data = CKEDITOR.instances.editor1.getData()
	var banner_img_name= $(".banner-image_name").val();
	$.post(base_url+'admin/emailtemp/email_temp/welcome_mail_update', {data: data,banner_img:banner_img_name}, function(data, textStatus, xhr) {
		console.log(data);
if (data.result == true) {
Lobibox.notify('success', {
    msg: 'Update Successfully.'
});

}
	},"json");
});




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
url: base_url + '/admin/adminapi/upload_email_banner_image_with_ajax', // point to server-side PHP script
dataType: 'json', // what to expect back from the PHP script, if anything
cache: false,
contentType: false,
processData: false,
data: form_data,
type: 'post',
success: function(data) {
if (data.response == 'done') {
	var image_path = base_url + 'uploads/banner/email_banner/small/' + data.image_names[0];
$(".banner-img").attr('src', image_path);
$(".banner-image_name").val(data.image_names[0]);
}
}
});
});

});
</script>