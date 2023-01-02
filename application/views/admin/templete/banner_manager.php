<div class="pp-row pp-center">
	<?php
if (isset($add_status) && $add_status == true) {?>
	<div class="pp-col center ps12"><span class="center title font21 teal-text">Action Update Successfully.</span></div>
	<?php
}?>
	<div class="pp-col  z-depth-0 border3-1px  black-text p-padding_15 ps12 card">
		<form class="pp-form" action="<?php echo base_url('admin/theme/banner_manager/home_slider_image_update'); ?>" enctype="multipart/form-data" method="post">
			<div class="pp-col pp-padres pm12">
				<h6 class="title font20 center-align">Home Slider Images</h6>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='1' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Slider Images 1:</label>
							<input class="file-path validate" type="text"  placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='2' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Slider Images 2:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='3' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Slider Images 3:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='4' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Slider Images 4:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='5' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Slider Images 5:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 1600*500">
						</div>
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 1 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_1_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 2 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_2_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 3 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_3_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 4 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_4_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 5 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_5_link" disabled type="text" class=" ">
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($slider_banner[0]->b_values)) ? base_url('uploads/banner/1600_520/' . $slider_banner[0]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($slider_banner[0]->b_values)) ? '<span banner-id="' . $slider_banner[0]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($slider_banner[1]->b_values)) ? base_url('uploads/banner/1600_520/' . $slider_banner[1]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($slider_banner[1]->b_values)) ? '<span banner-id="' . $slider_banner[1]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($slider_banner[2]->b_values)) ? base_url('uploads/banner/1600_520/' . $slider_banner[2]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($slider_banner[2]->b_values)) ? '<span banner-id="' . $slider_banner[2]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($slider_banner[3]->b_values)) ? base_url('uploads/banner/1600_520/' . $slider_banner[3]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($slider_banner[3]->b_values)) ? '<span banner-id="' . $slider_banner[3]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pp-padres pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($slider_banner[4]->b_values)) ? base_url('uploads/banner/1600_520/' . $slider_banner[4]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($slider_banner[4]->b_values)) ? '<span banner-id="' . $slider_banner[4]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
			</div>
			<div class="pp-col ps10 center">
				<button class="btn waves-effect primary-light waves-light add_product_submit" type="submit" name="add_banner_image_submit">Submit
			</button></div>
		</form>
	</div>
	<div class="pp-col  black-text  z-depth-0 border3-1px  p-padding_15 pps12 card">
		<form class="pp-form pp-row pp-vert-center" action="<?php echo base_url('admin/theme/banner_manager/home_5_banner_image_update'); ?>" enctype="multipart/form-data" method="post">
			<div class="pp-col pp-padres pm12">
				<h6 class="title font20 center-align">Home 5 Banner</h6>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col  pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='1' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 1:</label>
							<input class="file-path validate" type="text"  placeholder="Resolution: 400*400">
						</div>
					</div>
				</div>
				<div class="pp-col  pm12">
					<div class=" pp-text-field">
						<label>Banner 1 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_1_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-margin-t-12 pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='2' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 2:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 400*400">
						</div>
					</div>
				</div>
				<div class="pp-col  pm12">
					<div class=" pp-text-field">
						<label>Banner 2 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_2_link" disabled type="text" class=" ">
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col  pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='3' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 3:</label>
							<input class="file-path validate" type="text"  placeholder="Resolution: 800*390">
						</div>
					</div>
				</div>
				<div class="pp-col  pm12">
					<div class=" pp-text-field">
						<label>Banner 3 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_3_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col  pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='4' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 4:</label>
							<input class="file-path validate" type="text"  placeholder="Resolution: 800*390">
						</div>
					</div>
				</div>
				<div class="pp-col  pm12">
					<div class=" pp-text-field">
						<label>Banner 4 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_4_link" disabled type="text" class=" ">
					</div>
				</div>
			</div>
			<div class="pp-col ps4">

				<div class="pp-col pp-margin-t-12 pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='5' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 5:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 400*800">
						</div>
					</div>
				</div>
				<div class="pp-col  pm12">
					<div class=" pp-text-field">
						<label>Banner 5 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_5_link" disabled type="text" class=" ">
					</div>
				</div>
			</div>
			<div class="pp-col ps3">

				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_5[0]->b_values)) ? base_url('uploads/banner/5banner/400_0/' . $banner_5[0]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_5[0]->b_values)) ? '<span banner-id="' . $banner_5[0]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_5[1]->b_values)) ? base_url('uploads/banner/5banner/400_0/' . $banner_5[1]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_5[1]->b_values)) ? '<span banner-id="' . $banner_5[1]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
			</div>
				<div class="pp-col ps6">
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_5[2]->b_values)) ? base_url('uploads/banner/5banner/800_0/' . $banner_5[2]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_5[2]->b_values)) ? '<span banner-id="' . $banner_5[2]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_5[3]->b_values)) ? base_url('uploads/banner/5banner/800_0/' . $banner_5[3]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_5[3]->b_values)) ? '<span banner-id="' . $banner_5[3]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
			</div>
				<div class="pp-col ps3">

				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_5[4]->b_values)) ? base_url('uploads/banner/5banner/400_0/' . $banner_5[4]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_5[4]->b_values)) ? '<span banner-id="' . $banner_5[4]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
			</div>
			<div class="pp-col ps10 center">
				<button class="btn primary-light waves-effect waves-light add_product_submit" type="submit" name="add_banner_image_submit">Submit
			</button></div>
		</form>
	</div>
	<div class="pp-col  black-text  z-depth-0 border3-1px  p-padding_15 pps12 card">
		<form class="pp-form" action="<?php echo base_url('admin/theme/banner_manager/home_2big_banner_image_update'); ?>" enctype="multipart/form-data" method="post">
			<div class="pp-col pp-padres pm12">
				<h6 class="title font20 center-align">Big 2 Banner</h6>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='1' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 1:</label>
							<input class="file-path validate" type="text"  placeholder="Resolution: 950*550">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='2' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 2:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 950*550">
						</div>
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 1 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_1_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 2 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_2_link" disabled type="text" class=" ">
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_2big[0]->b_values)) ? base_url('uploads/banner/2bigbanner/950_550/' . $banner_2big[0]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_2big[0]->b_values)) ? '<span banner-id="' . $banner_2big[0]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_2big[1]->b_values)) ? base_url('uploads/banner/2bigbanner/950_550/' . $banner_2big[1]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_2big[1]->b_values)) ? '<span banner-id="' . $banner_2big[1]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
			</div>
			<div class="pp-col ps10 center">
				<button class="btn primary-light waves-effect waves-light add_product_submit" type="submit" name="add_banner_image_submit">Submit
			</button></div>
		</form>
	</div>
	<div class="pp-col  black-text p-padding_15 pps12 z-depth-0 border3-1px  card">
		<form class="pp-form" action="<?php echo base_url('admin/theme/banner_manager/home_3banner_image_update'); ?>" enctype="multipart/form-data" method="post">
			<div class="pp-col pp-padres pm12">
				<h6 class="title font20 center-align">Home 3 Banner</h6>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='1' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 1:</label>
							<input class="file-path validate" type="text"  placeholder="Resolution: 366*141">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='2' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 2:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 366*141">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='3' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 3:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 366*141">
						</div>
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 1 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_1_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 2 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_2_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 3 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_3_link" disabled type="text" class=" ">
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_3[0]->b_values)) ? base_url('uploads/banner/3banner/366_141/' . $banner_3[0]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_3[0]->b_values)) ? '<span banner-id="' . $banner_3[0]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_3[1]->b_values)) ? base_url('uploads/banner/3banner/366_141/' . $banner_3[1]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_3[1]->b_values)) ? '<span banner-id="' . $banner_3[1]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_3[2]->b_values)) ? base_url('uploads/banner/3banner/366_141/' . $banner_3[2]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_3[2]->b_values)) ? '<span banner-id="' . $banner_3[2]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
			</div>
			<div class="pp-col ps10 center">
				<button class="btn primary-light waves-effect waves-light add_product_submit" type="submit" name="add_banner_image_submit">Submit
			</button></div>
		</form>
	</div>
	<div class="pp-col  black-text p-padding_15 pps12 z-depth-0 border3-1px  card">
		<form class="pp-form" action="<?php echo base_url('admin/theme/banner_manager/home_2banner_image_update'); ?>" enctype="multipart/form-data" method="post">
			<div class="pp-col pp-padres pm12">
				<h6 class="title font20 center-align">Home 2 Banner</h6>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='1' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 1:</label>
							<input class="file-path validate" type="text"  placeholder="Resolution: 574*150">
						</div>
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="file-field input-field">
						<div class="btn ">
							<span>Select</span>
							<input type="file" class="image_file_button" url-input-field='2' name="imagesFile[]" >
						</div>
						<div class="file-path-wrapper pp-text-field">
							<label>Banner Images 2:</label>
							<input class="file-path validate" type="text" placeholder="Resolution: 574*150">
						</div>
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 1 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_1_link" disabled type="text" class=" ">
					</div>
				</div>
				<div class="pp-col pp-padres pm12">
					<div class="pp-col pp-text-field ps12">
						<label>Banner 2 Link</label>
						<input placeholder="<?php echo base_url(); ?>" name="banner_2_link" disabled type="text" class=" ">
					</div>
				</div>
			</div>
			<div class="pp-col ps4">
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_2[0]->b_values)) ? base_url('uploads/banner/2banner/574_150/' . $banner_2[0]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_2[0]->b_values)) ? '<span banner-id="' . $banner_2[0]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
				<div class="pp-col valign-wrapper pp-margin-tb-7 pm12">
					<img class="responsive-img pp-col ps9 zero_padding" src="<?php echo (!empty($banner_2[1]->b_values)) ? base_url('uploads/banner/2banner/574_150/' . $banner_2[1]->b_values) : base_url('uploads/banner/no_image.png'); ?>">
					<?php echo (!empty($banner_2[1]->b_values)) ? '<span banner-id="' . $banner_2[1]->id . '" class="pp-col delete_slide_banner_button ps1 pointer zero_padding"><i class="material-icons">delete_forever</i></span>' : ''; ?>
				</div>
			</div>
			<div class="pp-col ps10 center">
				<button class="btn primary-light waves-effect waves-light add_product_submit" type="submit" name="add_banner_image_submit">Submit
			</button></div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
	$(".delete_slide_banner_button").on('click', function(event) {
		event.preventDefault();
		var banner_id = $(this).attr('banner-id');
		$.post(base_url+'admin/theme/banner_manager/delete_banner_image', {banner_id: banner_id}, function(data, textStatus, xhr) {
if (data.result == true) {
$('span[banner-id="'+banner_id+'"]').parent('div.pp-col').children('img').attr('src',base_url+'uploads/banner/no_image.png');
}
$('span[banner-id="'+banner_id+'"]').remove();
		},'json');
	});

	$("input[type='file']").on('change', function(event) {
		event.preventDefault();
		  var fileName = $(this).val();
var get_input_field = $(this).attr('url-input-field');
    if(fileName) { // returns true if the string is not empty

		$(this).parents('.pp-form').find('[name="banner_'+get_input_field+'_link"]').removeAttr('disabled');
    } else { // no file was selected
    	alert(get_input_field+"nos");
        $(this).parents('.pp-form').find('[name="banner_'+get_input_field+'_link"]').addAttr('disabled');
    }

	});
	});
</script>