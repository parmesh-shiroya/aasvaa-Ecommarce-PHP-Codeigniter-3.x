<div class="pp-row">
	<div class="pp-col loadder hidden  pm12">
		<div class="pp-col pm2  padding1"></div>
		<div class="pp-col pm8">
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
		</div>
		<div class="pp-col pm2"></div>
	</div>
	<div class="pp-col card p-padding_15 ps12">
		<form id="add_coupen_form" method="post" action="<?php echo base_url('admin/offerdeal/create_deal/add_offer'); ?>" class="pp-form">
			<div class="pp-col pp-padres pm12">
				<div class="pp-col pp-text-field ps4">
					<label>Deal Name</label>
					<input placeholder="Deal Name" name="deal_name" required type="text" class=" ">
				</div>
				<div class="pp-col pp-text-field ps4">
					<label>Title</label>
					<input placeholder="Title" name="deal_title" required type="text" class=" ">
				</div>
			</div>
			<div class="pp-col pp-padres pm12">
				<div class="pp-col pp-text-field ps4">
					<label>Valid Date:</label>
					<input type="date" name="deal_valid_from" required class="datepicker">
				</div>
				<div class="pp-col pp-text-field ps4">
					<label>Valid to:</label>
					<input type="date" name="deal_valid_to" required class="datepicker">
				</div>
			</div>

			<div class="pp-col pp-padres pm12">
				<div class="pp-col ps4">
					<label>Discount Type</label>
					<select required name="coupen_discount_type" class="browser-default grey-text text-darken-2">
						<option value="0">Rs Discount</option>
						<option value="1">Percentage</option>
					</select>
				</div>
				<div class="pp-col pp-text-field ps4">
					<label>Discount (Rs/%)</label>
					<input placeholder="50" name="discount_rs" required type="text" class="only-number">
				</div>
			</div>
			<div class="pp-col pp-padres pm12">
			<div class="pp-col pp-text-field ps4">
					<label>Coupen Code Use ?:</label>
					<div class="switch">
						<label>
							No
							<input name="coupe_code_use" type="checkbox">
							<span class="lever"></span>
							Yes
						</label>
					</div>
				</div>
				<div class="file-field pp-col ps4 input-field">
					<div class="btn">
						<span>Select</span>
						<input type="file" class="image_file_button" name="imagesFile[]" >

					</div>
					<div class="file-path-wrapper pp-text-field">
						<label>Banner Images :</label>
						<input class="file-path validate" type="text" required placeholder="Banner Size 1600*500">
					</div>
				</div>
				<input type="hidden" class="hidden banner_img_name_txb" name="banner_img_name" >
				<div class="pp-col ps4 img-preview">

				</div>

			</div>
			<div class="pp-col center pp-padres pm6">

				<button class="btn waves-effect  waves-light add_product_submit" type="submit" value="offer" name="add_offer_submit">Submit
				</button>
			</div>
		</form>
	</div>


	<div class="pp-col ps12">

<table id="table_id" class="display card grey-text text-darken-1">
    <thead class="grey-text text-darken-3">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Add</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><img class="responsive-img" src="<?php echo base_url('uploads/pro_image/94_130/0bda89b96d2b49856c591301c5ca8f1b8d61dbdeb715557b9bb3f451a70c3766c5940275247cf5fdb040211ab1c107ce0e2f55f7b5a54039a38a87019e27a796captivating-faux-chiffon-hot-pink-classic-designer-saree-38176-800x1100.jpg'); ?>"></td>
            <td><div class="pp-row font14 grey-text text-darken-1">
<div class="pp-col ps12">
<span class="title font17 primary-light-text">Gorgonize Faux Chiffon Navy Blue Designer Traditional Sarees</span>
</div>
<div class="pp-col ps12">
<span class="">Sku : aasvaa1000</span>
<span class="pp-padding-l-15">Qty : aasvaa1000</span>
</div>
<div class="pp-col ps12">
<span class="">Sku : aasvaa1000</span>
</div>
            </div></td>
            td
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table>
	</div>
</div>
<script>

	$('.datepicker').pickadate({
selectMonths: true, // Creates a dropdown to control month
min: new Date(),
format:'dd-mm-yyyy',
selectYears: 2 // Creates a dropdown of 15 years to control year
});



	/////----------------- Upload Image With Ajax  -----------------------////

// $(".image-upload-box").on('click', '.add-image-button', function(event) {
// 	event.preventDefault();
// 	$(".image-upload-box .image_file_button_2").click();
// });
$(".image_file_button").on('change', function(event) {

    var file_data = $(this).prop('files')[0];
    var form_data = new FormData();
    for (var i = 0; i < event.target.files.length; i++) {
        var file = event.target.files[i];
        if (!file.type.match('image.*')) {
            // Check for File type. the 'type' property is a string, it facilitates usage if match() function to do the matching

            error = 1;
            Materialize.toast("File Is Not Image",3000);
        } else if (file.size > 1048576) {
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
        url: base_url + '/admin/adminapi/upload_banner_image_with_ajax', // point to server-side PHP script
        dataType: 'json', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(data) {
            console.log(data);
            if (data.response == 'done') {
                var image_path = base_url + 'uploads/banner/deal_offer/ori/' + data.image_names[0];
                console.log(image_path);
                $(".img-preview").html('<img style="max-height:100px" src="'+image_path+'" class="responsive-img">');
                $(".banner_img_name_txb").val(data.image_names[0]);
            }
        }
    });
});


/////----------------- End Upload Image With Ajax  -----------------------////
</script>




