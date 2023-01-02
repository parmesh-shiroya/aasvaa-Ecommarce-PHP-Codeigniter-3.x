<div class="pp-row pp-center">
	<?php
	if (isset($add_status) && $add_status == true) {?>
	<div class="pp-col center ps12"><span class="center font21 teal-text">Action Update Successfully.</span></div>
	<?php
	}?>
	<div class="pp-col  black-text p-padding_15 ps10 card">
		<form class="pp-form" action="<?php echo base_url('admin/other/sale_page/offer_banner_image_update'); ?>" enctype="multipart/form-data" method="post">
		<div class="pp-col pp-padres pm12">
				<h6 class="title font20 center-align">Offer Page Title</h6>
			</div>
			<div class="pp-col ps12 pp-text-field">
							<input type="text" name="offer_page_title" value="<?php echo $offer_title; ?>" placeholder="Title" class="center  grey-text text-darken-4 font-500">
			</div>
			<div class="pp-col pp-padres pm12">
				<h6 class="title font17 opacity6 center-align">Offer Page Images</h6>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn">
							<span>Select</span>
							<input type="file" class="image_file_button " name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Images 1:</label>
							<input class="file-path validate" type="text"  placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn">
							<span>Select</span>
							<input type="file" class="image_file_button" name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Images 2:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn">
							<span>Select</span>
							<input type="file" class="image_file_button" name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Images 3:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn">
							<span>Select</span>
							<input type="file" class="image_file_button" name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Images 4:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn">
							<span>Select</span>
							<input type="file" class="image_file_button" name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Images 5:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 1 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_1_link"  type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 2 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_2_link"  type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 3 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_3_link"  type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 4 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_4_link"  type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 5 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_5_link"  type="text" class=" ">
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($offer_image[0]->b_values)) ? base_url('uploads/banner/offer_image/1600_520/' . $offer_image[0]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
<?php echo (!empty($offer_image[0]->b_values)) ? '<span banner-id="' . $offer_image[0]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($offer_image[1]->b_values)) ? base_url('uploads/banner/offer_image/1600_520/' . $offer_image[1]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
<?php echo (!empty($offer_image[1]->b_values)) ? '<span banner-id="' . $offer_image[1]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($offer_image[2]->b_values)) ? base_url('uploads/banner/offer_image/1600_520/' . $offer_image[2]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
<?php echo (!empty($offer_image[2]->b_values)) ? '<span banner-id="' . $offer_image[2]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($offer_image[3]->b_values)) ? base_url('uploads/banner/offer_image/1600_520/' . $offer_image[3]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
<?php echo (!empty($offer_image[3]->b_values)) ? '<span banner-id="' . $offer_image[3]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pp-padres pm12">
<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($offer_image[4]->b_values)) ? base_url('uploads/banner/offer_image/1600_520/' . $offer_image[4]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
<?php echo (!empty($offer_image[4]->b_values)) ? '<span banner-id="' . $offer_image[4]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
			</div>
			<div class="pp-col ps10 center">
				<button class="btn waves-effect waves-light add_product_submit" type="submit" name="add_banner_image_submit">Submit
			</button></div>
		</form>
	</div>

	</div>

<script>
	$(document).ready(function() {
	$(".delete_slide_banner_button").on('click', function(event) {
		event.preventDefault();
		var banner_id = $(this).attr('banner-id');
		$.post(base_url+'admin/other/sale_page/delete_banner_image', {banner_id: banner_id}, function(data, textStatus, xhr) {
if (data.result == true) {
$('span[banner-id="'+banner_id+'"]').parent('div.pp-col').children('img').attr('src',base_url+'uploads/banner/no_image.png');
}
$('span[banner-id="'+banner_id+'"]').remove();
		},'json');
	});
	});
</script>