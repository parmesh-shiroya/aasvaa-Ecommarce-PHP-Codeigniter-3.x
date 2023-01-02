<!-- Modal Structure -->
<div id="replay_model" class="modal">
  <div class="modal-content black-text">
    <h6 class="center g8fw500 font-open_sans g8fs19 cp">Replay Message</h6>
    <div class="center ajax_loader hidden">
  <center>
    <div class="spinner g8mt13 h25 center g8mb0 shipping_data_spinner">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
  </div></center></div>
    <div class="c-row customer_detail font-karla gmf c-center g8pt18  ">
      <div class="grid  border3-1px g8pb10 bt0 br0 bl0   g89">
        <h6 class="name_txt">From : Parmesh</h6>
        <h6 class="email_txt">Email : Parmeshshiroya@gmail.com</h6>
      </div>
      <div class="grid  border3-1px g8pb10 bt0 br0 bl0  g89">
        <h6 class="mobile_txt">Mobile no : 9924756555</h6>
                <h6 class="date_txt">Date :</h6>
      </div>
      <div class="grid g8ptb10 g818"><h6 class="query_txt">Query :- </h6></div>
    </div>
    <div class="c-row gmf c-center g8p10 ">
      <form id="replay_message_form" class="pp-form gpf grid g818">
        <input name="form_id" required="" class="hidden form_id" type="hidden">
           <input name="status" required="" class="hidden status" type="hidden">
        <div class="input-field grid gpf g824">
          <label class="font-karla" for="textarea1">Replay Answer</label>
          <textarea id="textarea1" name="replay_txb" class="materialize-textarea replay_txb"></textarea>
        </div>
        <div class="grid g824 g8mt10 center"><button class="c-btna ans_btn g8mr10 g8plr20">Answer Query</button><button class="c-btna g8ml10 clo_btn g8plr20">Close Query</button></div>
      </form>
    </div>
  </div>
</div>
<!-- End Model Structure -->
<!-- Modal Structure -->
<div id="replay_model_2" class="modal">
  <div class="modal-content black-text">
    <h6 class="center g8fw500 font-open_sans g8fs19 cp">Replay Message</h6>
    <div class="c-row customer_detail font-karla gmf c-center g8pt18  ">
      <div class="grid  border3-1px g8pb10 bt0 br0 bl0   g89">
        <h6 class="name_txt">From : Parmesh</h6>
        <h6 class="email_txt">Email : Parmeshshiroya@gmail.com</h6>
      </div>
      <div class="grid  border3-1px g8pb10 bt0 br0 bl0  g89">
        <h6 class="mobile_txt">Mobile no : 9924756555</h6>
                <h6 class="date_txt">Date :</h6>
      </div>
      <div class="grid g8ptb10 g818"><h6 class="query_txt">Query :- </h6></div>
    </div>
    <div class="c-row gmf c-center g8p10 ">
      <div id="replay_message_form" class="pp-form gpf grid g818">
        <div class="grid font-karla g8ptb10  g8plr4 gpf g824"><h6 class='grey-text g8fs10 replay_time'>23-02-2017 (17:00 am)</h6><h6 class="ans_txt">And :- </h6></div>
      </div>
    </div>
  </div>
</div>
<!-- End Model Structure -->
<div class="div">
<div class="c-row">
  <div class="grid  g124">
    <ul class="tabs border3-1px font-karla g8fs13">
      <li class="tab grid g13"><a class="active" href="#open_query">Open Query</a></li>
      <li class="tab grid g13"><a  href="#answer_query">Answer Query</a></li>
      <li class="tab grid g13"><a  href="#close_query">Close Query</a></li>
    </ul>
  </div>
</div>
<div id="open_query" class="c-row gmf g8pr20">
  <div class="c-row  gmf">
    <div class="grid blue-card card z-depth-0 border3-1px  p-padding_15 g124">
      <table id="customer_table" class="black-text g8fs13 font-karla striped">
        <thead>
          <tr>
            <th class="center" data-field="no">No</th>
            <th class="center" data-field="cust_name">Name</th>
            <th class="center"  data-field="desc">Description</th>
            <th class="center"  data-field="Date">Date</th>
            <th class="center" >Replay</th>
            <th class="center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
$a = 1;
foreach ($queries as $key => $value) {
	if ($value->status == '0') {
		?>
          <tr>
            <td class="center"><?php echo $a; ?></td>
            <td class="center font-capitalize"><?php echo $value->name; ?></td>
            <td class="center"><?php echo $value->description; ?></td>
            <td class="center "><?php echo $value->date . '(' . $value->time . ')'; ?></td>
            <td class="center"><button class="c-btnp replay_btn g8plr10" rev-id="<?php echo $value->id; ?>">Replay</button></td>
            <td class="center"><button class="c-btna close_btn g8plr10" rev-id="<?php echo $value->id; ?>">Close</button></td>
          </tr>
          <?php $a++;}}?>
        </tbody>
      </table>
    </div>
  </div></div>
  <div id="answer_query" class="c-row gmf g8pr20">
  <div class="c-row  gmf">
    <div class="grid yellow-card card z-depth-0 border3-1px  p-padding_15 g124">
      <table id="customer_table3" class="black-text g8fs13 font-karla striped">
        <thead>
          <tr>
            <th class="center" data-field="no">No</th>
            <th class="center" data-field="cust_name">Name</th>
            <th class="center"  data-field="desc">Description</th>
            <th class="center"  data-field="Date">Date</th>
            <th class="center" >Replay</th>
            <th class="center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
$a = 1;
foreach ($queries as $key => $value) {
	if ($value->status == '1') {
		?>
          <tr>
            <td class="center"><?php echo $a; ?></td>
            <td class="center font-capitalize"><?php echo $value->name; ?></td>
            <td class="center"><?php echo $value->description; ?></td>
            <td class="center "><?php echo $value->date . '(' . $value->time . ')'; ?></td>
            <td class="center"><button class="c-btnp replay_btn g8plr10" rev-id="<?php echo $value->id; ?>">Replay</button></td>
            <td class="center"><button class="c-btna close_btn g8plr10" rev-id="<?php echo $value->id; ?>">Close</button></td>
          </tr>
          <?php $a++;}}?>
        </tbody>
      </table>
    </div>
  </div></div>
  <div id="close_query" class="c-row gmf g8pr20">
    <div class="c-row gmf">
    <div class="grid green-card card z-depth-0 border3-1px  p-padding_15 g124">
      <table id="customer_table2" class="black-text g8fs13 font-karla striped">
        <thead>
          <tr>
            <th class="center" data-field="no">No</th>
            <th class="center" data-field="cust_name">Name</th>
            <th class="center"  data-field="desc">Description</th>
            <th class="center"  data-field="Date">Date</th>
            <th class="center" >Replay</th>
          </tr>
        </thead>
        <tbody>
          <?php
$a = 1;
foreach ($queries as $key => $value) {
	if ($value->status == '2') {
		?>
          <tr>
            <td class="center"><?php echo $a; ?></td>
            <td class="center font-capitalize"><?php echo $value->name; ?></td>
            <td class="center"><?php echo $value->description; ?></td>
            <td class="center "><?php echo $value->date . '(' . $value->time . ')'; ?></td>
            <td class="center"><button class="c-btnp replay_btn2 g8plr10" rev-id="<?php echo $value->id; ?>">View</button></td>
          </tr>
          <?php $a++;}}?>
        </tbody>
      </table>
    </div>
  </div>
  </div>

  </div>
  <style type="text/css">
  .indicator{
  display: none;
  }
  .customer_detail h6{
  font-size: 13px;
  }
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
  $('#customer_table').DataTable({
  "pageLength": 50
  });
    $('#customer_table2').DataTable({
  "pageLength": 50
  });
  $('#customer_table3').DataTable({
  "pageLength": 50
  });

  $(".div").on('click', '.replay_btn', function(event) {
    event.preventDefault();
    var form_id = $(this).attr('rev-id');
    $.post(base_url+'admin/contactus/contact/single_form', {form_id: form_id}, function(data, textStatus, xhr) {
      console.log(data);
      $("#replay_model .name_txt").text('From : '+data.name);
      $("#replay_model .email_txt").text('Email : '+data.email);
      $("#replay_model .mobile_txt").text('Mobile no : '+data.mobileno);
      $("#replay_model .date_txt").text('Date : '+data.date+'('+data.time+')');
      $("#replay_model .query_txt").text('Query : '+data.description);
      $("#replay_model .form_id").val(data.id);
if (data.response != null) {
      $("#replay_model .replay_txb").val(data.response);
      $('#replay_model .replay_txb').trigger('autoresize');
      }


      $("#replay_model").openModal();
    },'json');
  });

$(".ans_btn").on('click', function(event) {
  event.preventDefault();
     $("#replay_model .status").val('1');
     $("#replay_message_form").submit();
});

$(".clo_btn").on('click', function(event) {
  event.preventDefault();
     $("#replay_model .status").val('2');
     $("#replay_message_form").submit();
});

  $(".div").on('click', '.replay_btn2', function(event) {
    event.preventDefault();
    var form_id = $(this).attr('rev-id');
    $.post(base_url+'admin/contactus/contact/single_form', {form_id: form_id}, function(data, textStatus, xhr) {
      console.log(data);
      $("#replay_model_2 .name_txt").text('From : '+data.name);
      $("#replay_model_2 .email_txt").text('Email : '+data.email);
      $("#replay_model_2 .mobile_txt").text('Mobile no : '+data.mobileno);
      $("#replay_model_2 .date_txt").text('Date : '+data.date+'('+data.time+')');
      $("#replay_model_2 .query_txt").text('Query : '+data.description);
$("#replay_model_2 .ans_txt").text('Ans : '+data.response);
$("#replay_model_2 .replay_time").text(data.res_date+'('+data.res_time+')');
      $("#replay_model_2").openModal();
    },'json');
  });


  $("#replay_message_form").on('submit', function(event) {
event.preventDefault();
$(".ajax_loader").removeClass('hidden');
$(".loadder").removeClass('hidden');
var datas= $(this).serialize();
$.post(base_url+'admin/contactus/contact/replay_form',  datas  , function(data, textStatus, xhr) {
  $(".loadder").addClass('hidden');
if(data.result == true){
  Lobibox.notify('success', {
    msg: 'Replay Submit Successfully.'
});

  $("#replay_model").closeModal();
  $(".ajax_loader").addClass('hidden');
  $('#replay_message_form').find("input[type]").removeClass('invalid');
$('#replay_message_form').find('.pp-error-text').remove();
$('#replay_message_form').find('.input-field').removeClass('pp-error');
location.reload();
// location.href = base_url+'account/dashboard';
    // $('#replay_message_form').find("input[type]").val("");
}else{
   Lobibox.notify('error', {

    msg: 'Form Data Not Valid.'
});
$.each(data.errorsdata,function(index, el) {
// Materialize.toast(el, 3000,'rounded');
$("#replay_message_form [name='"+index+"']").addClass('invalid');
$("#replay_message_form [name='"+index+"']").parent('.input-field').addClass('pp-error');
$("#replay_message_form [name='"+index+"']").parent('.input-field').children('span.pp-error-text').remove();
$("#replay_message_form [name='"+index+"']").parent('.input-field').append('<span class="pp-error-text red-text g8fs13 font-karla font-capitalize">'+el+'</span>');
});
}
},'json');
});

  $(".close_btn").on('click', function(event) {
    event.preventDefault();
     var form_id = $(this).attr('rev-id');
     $.post(base_url+'admin/contactus/contact/close_form', {form_id: form_id}, function(data, textStatus, xhr) {
      if(data.result == true){
        Lobibox.notify('success', {
    msg: 'Query Close Successfully.'
});
        location.reload();
  }
     },'json');
  });
  });
  </script>