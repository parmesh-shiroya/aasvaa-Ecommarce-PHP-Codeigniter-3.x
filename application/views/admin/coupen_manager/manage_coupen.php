<div class="pp-row">
<div class="pp-col card p-padding_15 ps12">
  <table id="product_table" class="black-text striped">
        <thead>
          <tr>
              <th class="center " data-field="no">No <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
              <th class="center"  data-field="code">Code <img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
              <!-- <th data-field="cat">Category</th> -->
              <th class="center"  data-field="area">Area<img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
              <th class="center"  data-field="valid_from">Valid_from<img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
              <th class="center" data-field="valid_to">Valid to<i class="material-icon"></i><img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
              <th class="center" data-field="use_time">Use time</th>
              <th  class="center" data-field="discount">discount<img width="10" src="<?php echo base_url('assetes/img/sort_icon.png'); ?>"></th>
              <th class="center" data-field="minimum mrp">Minimum Mrp</th>
              <!-- <th class="center" data-field="Edit">Edit</th> -->
              <th class="center" data-field="status">Status</th>
          </tr>
        </thead>

        <tbody>
        <?php
        	$a = 1;
        	foreach ($result as $key => $value) {
        	?>
          <tr>
            <td class="center"><?php echo $a; ?></td>
            <td class="center"><?php echo $value['code']; ?></td>
             <td class="center font-capitalize"><?php echo $value['area']; ?></td>
            <td class="center"><?php echo $value['valid_from']; ?></td>
            <td class="center"><?php echo $value['valid_to']; ?></td>
            <td class="center"><?php echo $value['use_count'] . "/" . $value['use_time']; ?></td>
            <td class="center"><?php switch ($value['discount_type']) {
                               		case '0':
                               			echo "Rs. " . $value['dis_percet_rs'];
                               			break;
                               		case '1':
                               			echo $value['dis_percet_rs'] . "%";
                               		break;
                               	};?></td>
            <td class="center"><span class="price" price="<?php echo $value['min_mrp_cond']; ?>"></span></td>
            <!-- <td class="center"><button coupen-id="<?php echo $value['id']; ?>" class="edit_coupen_btn btn-floating"><i class="white-text material-icons">mode_edit</i></button></td> -->

            <td class="center"><div class="switch"><label>Off<input  coupen-id="<?php echo $value['id']; ?>" class="status_checkbox"<?php echo ($value['status'] == 'on') ? 'checked' : ''; ?> type="checkbox"><span class="lever"></span>On</label></div></td>
          </tr>
          <?php $a++;}?>
        </tbody>
      </table>

</div>

</div>


<!-- Modal Structure -->
  <div id="edit_coupen_model" class="modal black-text">
    <div class="modal-content">
      <form id="update_coupen_form" class="pp-form">
     <div class="pp-col pp-padres pm12">
        <div class="pp-col pp-text-field ps5">
          <label>Coupen Code</label>
          <input placeholder="Coupen Code" disabled required type="text" class="coupen_code">
          <input placeholder="Coupen Code" name="coupen_code" required type="hidden" class="display_none coupen_code">
        </div>
        <div class="pp-col ps5">
          <label>Coupen Area</label>
          <select required name="coupen_area" class="browser-default coupen_area grey-text text-darken-2">
            <option value="india">India</option>
            <option value="other_country">Other Country</option>
            <option value="all_country">All Country</option>
          </select>
        </div>
      </div>
      <div class="pp-col pp-padres pm12">
        <div class="pp-col pp-text-field ps5">
          <label>Valid from:</label>
          <input type="date" name="coupen_valid_from" required class="datepicker coupen_valid_from">
        </div>
        <div class="pp-col pp-text-field ps5">
          <label>Valid to:</label>
          <input type="date" name="coupen_valid_to" required class="datepicker coupen_valid_to">
        </div>
      </div>
      <div class="pp-col pp-padres pm12">
        <div class="pp-col pp-text-field ps5">
          <label>Use Coupen For</label>
          <input placeholder="5 time" name="coupen_use_for" required type="text" class="only-number coupen_use_for">
        </div>
        <div class="pp-col pp-text-field ps5">
          <label>Minimum Rs Condition:</label>
          <input placeholder="2500" name="coupen_minimum_mrp" required type="text" class="only-number coupen_minimum_mrp">
        </div>
      </div>
      <div class="pp-col pp-padres pm12">
        <div class="pp-col ps5">
          <label>Discount Type</label>
          <select required name="coupen_discount_type" class="browser-default grey-text text-darken-2 coupen_discount_type">
            <option value="0">Rs Discount</option>
            <option value="1">Percentage</option>
          </select>
        </div>
        <div class="pp-col pp-text-field ps5">
          <label>Discount (Rs/%)</label>
          <input placeholder="50" name="discount_rs" required type="text" class="only-number discount_rs">
        </div>
      </div>
      <div class="pp-col pp-padres pm6">
            <div class="pp-col pm4  padding1"></div>
            <button class="btn waves-effect pp-col pm3 waves-light add_product_submit" type="submit" name="add_product_submit">Update
            </button>
            <div class="pp-col pm4  padding1"></div>
          </div>
          <input type="hidden" name="coupen_id_text" required class="datepicker display_none coupen_id_text">
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

    $(".edit_coupen_btn").on('click', function(event) {
      event.preventDefault();

      var coupen_ids = $(this).attr('coupen-id');
      $.post(base_url+'admin/coupman/managecoupen/get_coupen_data', {coupen_id: coupen_ids}, function(data, textStatus, xhr) {
        console.log(data);
        $("#edit_coupen_model .coupen_code").val(data.code);

        $("#edit_coupen_model .coupen_area").find('[value="'+data.area+'"]').attr('selected','selected');
        $("#edit_coupen_model .coupen_valid_from").val(data.valid_from);
        $("#edit_coupen_model .coupen_valid_to").val(data.valid_to);
        $("#edit_coupen_model .coupen_use_for").val(data.use_time);
        $("#edit_coupen_model .coupen_minimum_mrp").val(data.min_mrp_cond);
        $("#edit_coupen_model .coupen_id_text").val(data.id);
        $("#edit_coupen_model .coupen_discount_type").find('[value="'+data.discount_type+'"]').attr('selected','selected');
        $("#edit_coupen_model .discount_rs").val(data.dis_percet_rs);
        $('#edit_coupen_model').openModal();
      },"json");
    });

    $(".status_checkbox").on('change', function(event) {
      event.preventDefault();
      if(this.checked) {
        $.post(base_url + '/admin/adminapi', {method: 'change_coupen_status',coupen_id: $(this).attr('coupen-id'),coupen_status:"on"}, function(data, textStatus, xhr) {

          if(data == "1"){
Materialize.toast('Status Change Successfully', 3000);
          }
        });
    }else{
$.post(base_url + '/admin/adminapi', {method: 'change_coupen_status',coupen_id: $(this).attr('coupen-id'),coupen_status:"off"}, function(data, textStatus, xhr) {

          if(data == "1"){
Materialize.toast('Status Change Successfully', 3000);
          }
        });
    }
    });

      $('.datepicker').pickadate({
selectMonths: true, // Creates a dropdown to control month
  min: new Date(),
    format:'dd-mm-yyyy',
selectYears: 2 // Creates a dropdown of 15 years to control year
});



$("#update_coupen_form").on('submit', function(event) {
event.preventDefault();
var datas= $(this).serialize();
$.post(base_url+'admin/coupman/managecoupen/update_coupen',  datas  , function(data, textStatus, xhr) {
if(data.result == true){
  location.reload();
  Materialize.toast('Coupen Update Successfully.', 4000);
$('#update_coupen_form').find('.pp-error-text').remove();
$('#update_coupen_form').find('.pp-text-field').removeClass('pp-error');
// location.href = base_url+'account/dashboard';
}else{
Materialize.toast('Form Data Not Valid', 4000);
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#update_coupen_form [name='"+index+"']").parent('.pp-text-field').addClass('pp-error');
$("#update_coupen_form [name='"+index+"']").parent('.pp-text-field').children('span.pp-error-text').remove();
$("#update_coupen_form [name='"+index+"']").parent('.pp-text-field').append('<span class="pp-error-text ">'+el+'</span>');
});
}
},'json');
});
});
</script>