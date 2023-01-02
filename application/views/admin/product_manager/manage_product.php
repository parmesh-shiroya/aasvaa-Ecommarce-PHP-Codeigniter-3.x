<div id="update_product_model" class="modal small_model2">
    <div class="modal-content">
      <h6 class="center font-roboto_slab cp g8fs18">Update Product</h6>
      <div class="divider g8mt10"></div>
<form class="pp-form g8mt25">
<div class="message"></div>
<div class="progress exc_file_upload_progress hidden g8mb30">
      <div class="determinate" style="width: 0%"></div>
  </div>
  <blockquote class="black-text">
  Download Update Sheet <a target="_blank" href="<?php echo base_url('uploads/Aasvaa Product Update.xlsm'); ?>">Here</a>.
    </blockquote>
<div class="file-field input-field">
            <div class="btn c-btna g8plr10">
              <span>Select</span>
              <input type="file" class="csv_file_button excel_upload_file" url-input-field='1' name="csvFile[]" >
            </div>
            <div class="file-path-wrapper pp-text-field">
              <label>Upload CSV File.</label>
              <input class="file-path validate" type="text"  placeholder="Resolution: 1600*500">
            </div>
          </div>
</form>
    </div>
    <div class="modal-footer">
      <button class=" modal-action right g8plr13 modal-close waves-effect c-btnf">Close</button>
    </div>
  </div>




<div class="pp-row">
  <div class="pp-col card p-padding_15 ps12">
  <div class="col ps12 right g8mb10"><button class="c-btna btn_update_stock">Update Stock</button></div>
    <table id="product_table" class="black-text g8fs13 font-karla striped">
      <thead>
        <tr>
          <th class="center" data-field="no">Image </th>
          <th data-field="sky">Product SKU </th>
          <!-- <th data-field="cat">Category</th> -->
          <th data-field="sub_cat">Sub Category </th>
          <th data-field="name">Name </th>
          <th class="center" data-field="stock">Stock </th>
          <th class="center" >Edit</th>
          <!-- <th class="center" data-field="image">View</th> -->
          <th  class="center" data-field="sell_price">Sell Price </th>
          <th class="center" data-field="status">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
$a = 1;
foreach ($result as $key => $value) {?>
        <tr>
          <td class="center">
<img class="responsive-img br4" src="<?php echo base_url('uploads/pro_image/94_130/' . $value['pro_img']); ?>">

          <td><?php echo $value['product_sku']; ?></td>
          <!-- <td><?php echo $value['cat_name']; ?></td> -->
          <td><?php echo $value['sub_cat_name']; ?></td>
          <td width="30%"><a target="_blank" class="black-text hover-text-primary" href="<?php echo base_url('product/quick/' . $value['sub_cat_name'] . '/' . $value['product_sku'] . '/' . $value['product_id'] . '/' . $value['product_name']); ?>"><?php echo $value['product_name']; ?></a></td>
          <td class="center "><?php echo $value['stock']; ?></td>
          <td class="center"><a href="<?php echo site_url('admin/prodman/Editproduct/index/' . $value['product_id']); ?>"><button product-id="<?php echo $value['product_id']; ?>" class="  blue btn-floating"><i class="white-text material-icons">mode_edit</i></button></a></td>
         <!--  <td class="center quick_view_btn_table"><button prod-id="<?php echo $value['product_id']; ?>" class="btn-floating waves-effect waves-light quick_button_btn"><i class="material-icons">visibility</i></button></td> -->
          <td class="center"><span class="price" price="<?php echo $value['sell_price']; ?>"></span></td>
          <td class="center"><div class="switch"><label>Off<input  prod-id="<?php echo $value['product_id']; ?>" class="status_checkbox"<?php echo ($value['status'] == 'on') ? 'checked' : ''; ?> type="checkbox"><span class="lever"></span>On</label></div></td>
        </tr>
        <?php $a++;}?>
      </tbody>
    </table>
  </div>
</div>
<!-- Modal Structure -->
<div id="edit_product_model" class="modal black-text">
  <div class="modal-content">
    <form id="update_product_form" class="pp-form">
      <div class="pp-col pp-padres pm12">
        <div class="pp-col pp-text-field ps5">
          <label>SKU</label>
          <input placeholder="SKU" name="product_sku" disabled required type="text" class="product_sku">
          <input placeholder="SKU" name="product_sku"  required type="hidden" class="hidden product_sku">
          <input placeholder="product_id" name="product_id" required type="hidden" class="display_none product_id">
        </div>
      </div>
      <div class="pp-col pp-padres pm12">
        <div class="pp-col pp-text-field ps10">
          <label>Name:</label>
          <input type="text" name="product_name" required class="product_name">
        </div>
      </div>
      <div class="pp-col pp-padres pm12">
        <div class="pp-col pp-text-field ps5">
          <label>Stock:</label>
          <input type="text" name="product_stock" required class="only-number product_stock">
        </div>
        <div class="pp-col hidden pp-text-field ps5">
          <label>Catalogue Name:</label>
          <input type="text" name="product_catalogue" required class="product_catalogue">
        </div>
      </div>
      <div class="pp-col pp-padres pm12">
        <div class="pp-col pp-text-field ps5">
          <label>Mrp</label>
          <input placeholder="" name="product_mrp"  type="text" class="only-number product_mrp">
        </div>
        <div class="pp-col pp-text-field ps5">
          <label>Sell Price:</label>
          <input placeholder="" name="product_sell_price" required type="text" class="only-number product_sell_price">
        </div>
      </div>
      <div class="pp-col pp-padres pm8 center">
        <button class="btn waves-effect waves-light add_product_submit" type="submit" name="add_product_submit">Update
        </button>
      </div>
    </form>
  </div>
</div>
<style type="text/css">
input[type="search"]{
margin-top: 5px;
border-radius:3px ;
color:#888;
border:1px solid #DCDCDC;
font-size:16px ;
height: 35px ;
line-height:30px ;
width: auto !important;
padding: 10px ;
text-transform: capitalize;
-webkit-transition: all .25s ;
-moz-transition: all .25s ;
-ms-transition: all .25s ;
-o-transition: all .25s ;
transition: all .25s ;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
$(".prod-addtocart").css('display', 'none');
$('#product_table').DataTable({
"pageLength": 50
});
$(".status_checkbox").on('change', function(event) {
event.preventDefault();
if(this.checked) {
$.post(base_url + '/admin/adminapi', {method: 'change_product_status',product_id: $(this).attr('prod-id'),product_status:"on"}, function(data, textStatus, xhr) {
if(data == "1"){
Materialize.toast('Status Change Successfully', 3000);
}
});
}else{
$.post(base_url + '/admin/adminapi', {method: 'change_product_status',product_id: $(this).attr('prod-id'),product_status:"off"}, function(data, textStatus, xhr) {
if(data == "1"){
Materialize.toast('Status Change Successfully', 3000);
}
});
}
});
$(".stock_update_button").on('click', function(event) {
event.preventDefault();
var product_id = $(this).attr('product-id');
$.post(base_url+'admin/adminapi', {method: 'get_product_data',product_ids:product_id}, function(data, textStatus, xhr) {
  console.log(data);
  $("#edit_product_model .product_sku").val(data.product_sku);
  $("#edit_product_model .product_id").val(data.product_id);
  $("#edit_product_model .product_name").val(data.product_name);
  $("#edit_product_model .product_stock").val(data.stock);
  $("#edit_product_model .product_catalogue").val(data.catalogue_name);
  $("#edit_product_model .product_mrp").val(data.mrp);
  $("#edit_product_model .product_sell_price").val(data.sell_price);
  $('#edit_product_model').openModal();
});


});


$("#update_product_form").on('submit', function(event) {
event.preventDefault();
var datas= $(this).serialize();
$.post(base_url+'admin/adminapi/update_product',  datas  , function(data, textStatus, xhr) {
if(data.result == true){
  // location.reload();
  Materialize.toast('Product Update Successfully.', 4000);

$('#update_product_form').find('.pp-error-text').remove();
$('#update_product_form').find('.pp-text-field').removeClass('pp-error');
$('#edit_product_model').closeModal();
// location.href = base_url+'account/dashboard';
}else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#update_product_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#update_product_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#update_product_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');
});
});
</script>

<script>
   $(document).ready(function() {

    $(".btn_update_stock").on('click', function(event) {
      event.preventDefault();
      $("#update_product_model").openModal();
    });
        // var base_url = "http://localhost/amazone/web/upload_excels";
    /////----------------- Upload Image With Ajax  -----------------------////
$(".excel_upload_file").on('change', function(event) {
$(".exc_file_upload_progress").removeClass('hidden');
$(".message").html("");
var file_data = $(this).prop('files')[0];
var form_data = new FormData();
for (var i = 0; i < event.target.files.length; i++) {
var file = event.target.files[i];
var csvMimeType = /text\/xls/;
var fileExtension = file.name.split('.').pop();

if (fileExtension != "csv") {
error = 1;
$(".exc_file_upload_progress").addClass('hidden');
$(".a"+random_time).remove();
alert("File Is Not Excel");
} else if (file.size > 5048576) {
error = 1;
$(".a"+random_time).remove();
$(".exc_file_upload_progress").addClass('hidden');
alert("File Size Is To Large");
} else {
form_data.append('imagesFile', file, file.name);
}
}
// alert(form_data);
$.ajax({
url: base_url + 'admin/prodman/manageproduct/upload_excel_file',
cache: false,
contentType: false,
processData: false,
data: form_data,
type: 'post',
 xhr: function()
  {
    var xhr = new window.XMLHttpRequest();
    //Upload progress
    xhr.upload.addEventListener("progress", function(event){
      if (event.lengthComputable) {
      var percent = 0;

                var position = event.loaded || event.total;
                var total = event.total;
                if (event.lengthComputable) {
                    percent = Math.ceil(position / total * 100);
                }

                // $(random_time + " .status").text(percent +"%");
                $(".exc_file_upload_progress .determinate").css("width", + percent +"%");
      }
    }, false);
    xhr.addEventListener("progress", function(event){
      if (event.lengthComputable) {
        var percent = 0;

                var position = event.loaded || event.total;
                var total = event.total;
                if (event.lengthComputable) {
                    percent = Math.ceil(position / total * 100);
                }
     $(".exc_file_upload_progress .determinate").css("width", + percent +"%");
      }
    }, false);
    return xhr;
  },
success: function(data) {
$(".exc_file_upload_progress").addClass('hidden');
if (data == 'done') {
$(".message").html('<h5 class="text-center error_message f-karla  g8mb30 g8fs13 green white-text lighten-2 br4 g8p8">Stock Update Successfully.</h5>');
location.reload();
}else{
    $(".message").html('<h5 class="text-center error_message  g8mb30 f-karla g8fs13 red white-text lighten-2 br4 g8p8">'+data+'</h5>');
}
}
});
});
    });
</script>