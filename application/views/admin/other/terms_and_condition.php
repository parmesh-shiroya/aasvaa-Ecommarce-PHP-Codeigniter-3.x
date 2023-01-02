<div class="pp-row zero_margin grey-text text-darken-3">
		<div class="pp-col zero_padding ps12 card">
			<div class="pp-col center font-roboto_slab p-padding_tb_7 teal ps12 ">
				<h6 class="white-text g8fs16">Tearms & Condition</h6>
			</div>
			<div class="pp-col ps12 pp-padres">
				<form action="" method="post" id="terms_and_condition_form">
					<textarea name="editor1" id="editor1" rows="10" cols="80">
					<?php if (isset($trm_html)) {
	echo $trm_html;
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
	$("#terms_and_condition_form").on('submit', function(event) {
		event.preventDefault();

	});
CKEDITOR.replace( 'editor1' );
$("#terms_and_condition_form").on('submit', function(event) {
	event.preventDefault();
	var data = CKEDITOR.instances.editor1.getData()
	$.post(base_url+'admin/other/Pages/tearms_and_condition_update', {data: data}, function(data, textStatus, xhr) {
		console.log(data);
if (data.result == true) {
	Materialize.toast('Update Successfully', 4000);
}
	},"json");
});
});
</script>