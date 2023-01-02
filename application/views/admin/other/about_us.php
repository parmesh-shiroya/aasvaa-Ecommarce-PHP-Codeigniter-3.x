<div class="pp-row zero_margin grey-text text-darken-3">
		<div class="pp-col zero_padding ps12 card">
			<div class="pp-col center font-roboto_slab p-padding_tb_7 teal ps12 ">
				<h6 class="white-text font20">About Us</h6>
			</div>
			<div class="pp-col ps12 pp-padres">
				<form action="" method="post" id="about_us_form">
					<textarea name="editor1" id="editor1" rows="10" cols="80">
					<?php if (isset($about_us_html)) {
							echo $about_us_html;
					}?>
					</textarea>
					<div class="pp-col ps12 pp-margin-t-12 center">
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

CKEDITOR.replace( 'editor1' );
$("#about_us_form").on('submit', function(event) {
	event.preventDefault();
	var data = CKEDITOR.instances.editor1.getData()
	$.post(base_url+'admin/other/Pages/about_us_update', {data: data}, function(data, textStatus, xhr) {
		console.log(data);
if (data.result == true) {
	Materialize.toast('Update Successfully', 4000);
}
	},"json");
});
});
</script>