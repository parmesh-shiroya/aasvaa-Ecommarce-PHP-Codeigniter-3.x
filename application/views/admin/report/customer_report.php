<div class="c-row gmf black-text">
  <div class="grid white g8pt2 g8pb6 border3-1px g124 right">
    <div class="left h35 valign-wrapper">
      <div class="grid cp">
        <i class="material-icons vam">assessment</i> <span class="vam g8ml10 g8fs16 font-roboto_slab">Customers Report</span>
      </div>
    </div>
    <div class="right">
      <form action="" class="date-range-selector-form pp-form" method="post" accept-charset="utf-8">
        <div class="pp-text-field grid">
          <input id="first_name" placeholder="Start Date" value="<?php echo $_SESSION['adm']['report_data']['start_date']; ?>" required name="report_start_date" type="text" class="select_date_start">
        </div>
        <div class="left valign-wrapper h34">~</div>
        <div class="pp-text-field grid">
          <input id="first_name" value="<?php echo $_SESSION['adm']['report_data']['end_date']; ?>" placeholder="End Date" required name="report_end_date" type="text" class="select_date_end">
        </div>
        <div class="grid gpf">
          <button class="c-btna g8mt7 g8plr14 h27">Get</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="c-row gmf black-text">
  <section class="first-row-section grid g16 gpf">
<div class="grid minimize-card bb0 purple-card gpf">
      <div class="grid header-div gpf  g824">
         <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">place</i><span class="vam">Customers by Countries</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid  gpf g19">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Countries</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600">Male</h6>
            </div>
            <div class="grid gpf center g15">
              <h6 class="g8fs13 g8fw600">Female</h6>
            </div>
            <div class="grid gpf center g16">
              <h6 class="g8fs13 g8fw600">Total</h6>
            </div>
          </div>
        </div>
        <?php
$ch_size = $ch_country = "";
foreach ($customerby_con as $key => $value) {
	$ch_country .= '"' . $value->country_name . '",';
	$ch_size .= $value->total_customers . ',';
	?>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  gpf g19">
            <h6 class="g8fs12 font-capitalize wsn oh toe"><?php echo $value->country_name; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php echo $value->c_male; ?></h6>
          </div>
          <div class="grid gpf center g15">
            <h6 class="g8fs12"><?php echo $value->c_female; ?></h6>
          </div>
          <div class="grid gpf center g16">
            <h6 class="g8fs12"><?php echo $value->total_customers; ?></h6>
          </div>
        </div>
        <?php }?>
      </div>
    </div>

  </section>
  <section class="second-row-section grid g16 gpf">

  </section>
  <section class="third-row-section grid g112 gpf">
    <div class="grid minimize-card bb0 blue-card gpf">
      <div class="grid header-div gpf  g124">
      <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">timeline</i><span class="vam">Customers by Countries</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container  g8pt0 font-karla grid g124 gpf">

        <canvas id="country_graph" class=" g8p5" width="100%"></canvas>
      </div>
    </div>

  </section>
</div>


<!-- Page Report Model -->

 <div id="page_report_model" class="modal black-text">
    <div class="modal-content">
      <h6 class="center g8fw500 font-open_sans model-title g8fs19 cp">Page Report</h6>
<div class="c-row gmf c-center g8p20 ">
<div class="spinner g8mtb0 hidden page_report_loader ">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
          </div>
<table class="bordered page_report_model_table border-1px g8fs13 grey-text text-darken-1">
<thead>
  <tr>
    <td>Name</td>
    <td>Email</td>
    <td>Other Data</td>
    <td class="center">Date</td>
  </tr>
</thead>
          <tbody class="font-karla">
          </tbody>
        </table>
</div>
    </div>
    <div class="modal-footer">
      <button class=" modal-action modal-close waves-effect waves-green btn-flat">Close</button>
    </div>
  </div>


  <!-- Small Model -->

 <div id="small_model" class="modal small_model2 black-text ">
    <div class="modal-content">
      <h6 class="center g8fw500 font-open_sans model-title g8fs19 cp">Page Report</h6>
<div class="c-row gmf c-center g8p20 ">
<div class="spinner g8mtb0 hidden small_model_loader ">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
          </div>
<table class="bordered small_model_table border-1px g8fs13 grey-text text-darken-1">
<thead>
  <tr>
  <td>Keyword</td>
  <td class="center">Total</td>
  <td class="center">Result</td>
  </tr>
</thead>
          <tbody class="font-karla">
          </tbody>
        </table>
</div>
    </div>
    <div class="modal-footer">
      <button class=" modal-action modal-close waves-effect waves-red btn-flat">Close</button>
    </div>
  </div>

<style>
.date-range-selector-form .pp-text-field input[type]{
padding: 5px !important;
height: 30px !important;
font-size: 13px !important;
}
.pp-admin-content{
padding: 0px !important;
}
section.first .search-row ,.table-view .search-row{
border-bottom: 1px solid #ddd;
}
.mh270{
max-height: 270px;
}
</style>
<script>
$(document).ready(function() {


$(".sml").on('click', function(event) {
  event.preventDefault();
  var all_data = $(this).attr('data');
  var title = $(this).attr('data-type');
  get_all_data(all_data,title);
});

function get_all_data(get_data,title){
  $("#small_model").openModal();
  $("#small_model .model-title").text(title);
  $("#small_model .small_model_loader").removeClass('hidden');
  $("#small_model .small_model_table").addClass('hidden');
$.post(base_url+'admin/report/behavior_report/get_all_data/', {get_data: get_data}, function(data, textStatus, xhr) {
  var html = '';
 $.each(data, function(index, val) {
html += '<tr><td>'+val.search+'</td><td class="center">'+val.total+'</td>';
html += '<td class="center">'+val.product_show+'</td></tr>';
});
   $("#small_model .small_model_loader").addClass('hidden');
  $("#small_model .small_model_table").removeClass('hidden');
  $("#small_model .small_model_table tbody").html(html);
console.log(data);
},'json');
}

  $(".prmt").on('click', function(event) {
    event.preventDefault();
    var page = $(this).attr('page');
get_page_report_data(page);
  });

function get_page_report_data(page){
  $("#page_report_model").openModal();
  $("#page_report_model .model-title").text(page+' Page Report');
  $("#page_report_model .page_report_loader").removeClass('hidden');
  $("#page_report_model .page_report_model_table").addClass('hidden');
  $.post(base_url+'admin/report/behavior_report/get_page_report_by_page', {page_name: page}, function(data, textStatus, xhr) {
    var html = "";
$.each(data, function(index, val) {
html += '<tr><td>'+val.first_name+' '+val.last_name+'</td><td>'+val.email_id+'</td>';
if (val.other_data != null) {
html += '<td>'+val.other_data+'</td>';
}else{
  html += '<td></td>';
}
html += '<td class="center">'+val.date+'</td></tr>';
});
$("#page_report_model .page_report_loader").addClass('hidden');
$("#page_report_model .page_report_model_table").removeClass('hidden');
$("#page_report_model .page_report_model_table tbody").html(html);
  },'json');
}

});
</script>
<script>
$(document).ready(function() {
var country_graph = document.getElementById("country_graph");
var myChart = new Chart(country_graph, {
type: 'bar',
data: {
labels: [<?php echo $ch_country; ?>],
datasets: [{
label: 'Customers',
data: [<?php echo $ch_size; ?>],
backgroundColor: [
'rgba(255,88,113,0.7)',
'rgba(243,156,18,0.7)',
'rgba(74,74,74,0.7)',
'rgba(0,166,90,0.7)',
'rgba(53,123,188,0.7)',
'rgba(80,80,80,0.7)',
'rgba(255,126,126,0.7)',
getRandomColor(),
getRandomColor(),
getRandomColor(),
],
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero:false,
userCallback: function(label, index, labels) {
// when the floored value is the same as the value we have a whole number
if (Math.floor(label) === label) {
return label;
}
},
}
}]
},
}
});
});

function getRandomColor() {

    var hue = 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',0.7)';
    return hue;
}
</script>