<div class="c-row gmf black-text">
  <div class="grid white g8pt2 g8pb6 border3-1px g124 right">
    <div class="left h35 valign-wrapper">
      <div class="grid cp">
        <i class="material-icons vam">assessment</i> <span class="vam g8ml10 g8fs16 font-roboto_slab">Behaviour Report</span>
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
<div class="grid minimize-card bb0 green-card gpf">
      <div class="grid header-div gpf  g824">
      <!-- sml hover-text-primary pointer" data='get_top_search' data-type='Top Search' -->
         <h6 class="left  g8fs16 g8m0  font-scope_one g8fw600 sml hover-text-primary pointer" data='get_top_search' data-type='Top Search'><i class="material-icons vam g8mr10">search</i><span class="vam">Top Search</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid  g116">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Keyword</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600">Total</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600">Result</h6>
            </div>
          </div>
        </div>
        <?php
foreach ($top_search as $key => $value) {
	?>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g116">
            <h6 class="g8fs12 font-capitalize wsn oh toe"><a class="hover-text-primary grey-text-new" target="_blank" href="<?php echo base_url('search?filter_name=' . $value->search); ?>"><?php echo $value->search; ?></a></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php echo $value->total; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php echo $value->product_show; ?></h6>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
<div class="grid minimize-card bb0 teal-card gpf">
      <div class="grid header-div gpf  g824">
         <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">assignment</i><span class="vam">Page Report</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid  g116">
              <h6 class="g8fs13 wsn oh g8fw600 toe">Page</h6>
            </div>
            <div class="grid gpf center g18">
              <h6 class="g8fs13 g8fw600">Total Reach</h6>
            </div>
          </div>
        </div>
        <?php
foreach ($page_report as $key => $value) {
	?>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g116">
          <!-- prmt hover-text-primary pointer -->
            <h6 class="g8fs12 font-capitalize prmt hover-text-primary pointer   wsn oh toe" page='<?php echo $value->page; ?>'><?php echo $value->page; ?></h6>
          </div>
          <div class="grid gpf center g18">
            <h6 class="g8fs12"><?php echo $value->total_reach; ?></h6>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </section>
  <section class="second-row-section grid g16 gpf">
   <div class="grid minimize-card gmf g8mt7 bb0 red-card gpf">
      <div class="grid header-div gpf  g824">
      <!--  sml hover-text-primary pointer" data='get_top_search_with_few_result' data-type='Top Search With Few Result' -->
      <h6 class="left g8fs16 g8m0  font-scope_one g8fw600 sml hover-text-primary pointer" data='get_top_search_with_few_result' data-type='Top Search With Few Result'><i class="material-icons vam g8mr10">trending_down</i><span class="vam">Top Search With Zero Result</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid  g116">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Keyword</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600">Total</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600">Result</h6>
            </div>
          </div>
        </div>
        <?php
foreach ($top_search_with_few_result as $key => $value) {
	?>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g116">
            <h6 class="g8fs12 font-capitalize wsn oh toe"><a class="hover-text-primary grey-text-new" target="_blank" href="<?php echo base_url('search?filter_name=' . $value->search); ?>"><?php echo $value->search; ?></a></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php echo $value->total; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php echo $value->product_show; ?></h6>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </section>
  <section class="third-row-section grid g112 gpf">
    <div class="grid minimize-card bb0 blue-card gpf">
      <div class="grid header-div gpf  g124">
      <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">timeline</i><span class="vam">Top Search</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container  g8pt0 font-karla grid g124 gpf">

        <canvas id="sales_graph" class=" g8p5" width="100%"></canvas>
      </div>
    </div>
    <div class="grid minimize-card bb0 red-card gpf">
      <div class="grid header-div gpf  g824">
      <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">shopping_basket</i><span class="vam">Customers With Fill Cart</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
          <div class="grid   g18">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Name</h6>
            </div>
          <div class="grid   g18">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Email Id</h6>
            </div>

            <div class="grid gpf center g14">
              <h6 class="g8fs13  wsn oh g8fw600 toe tooltipped" data-position="top" data-tooltip="Total Item In Cart">Total Product</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600 tooltipped" data-position="top" data-tooltip="Last Item Insert Date">Date</h6>
            </div>
          </div>
        </div>
        <?php
foreach ($customer_with_fill_cart as $key => $value) {?>
<div class="grid gpf search-row g8plr10 g8ptb2 g824">
<div class="grid  g18">
            <h6 class="g8fs12 font-capitalize wsn oh toe"><?php echo $value->first_name . ' ' . $value->last_name; ?></h6>
          </div>
          <div class="grid  g18">
            <h6 class="g8fs12 wsn oh toe"><?php echo $value->email_id; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php echo $value->total_product; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12 "><?php echo $value->insert_date; ?></h6>
          </div>
        </div>
<?php }
?>

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
<?php
$keyword           = '';
$total_search_time = '';
foreach ($top_search as $key => $value) {
	$keyword .= '"' . ucfirst($value->search) . '",';
	$total_search_time .= $value->total . ',';
}
?>
var keyword = [<?php echo $keyword ?>];
var delivered_date = [<?php echo $total_search_time ?>];
var visitor_graph = document.getElementById("sales_graph");
var config = {
type: 'bar',
data: {
labels: keyword,
datasets: [{
label: "Top Search",
data: delivered_date,
backgroundColor: "rgba(0,166,90,0.4)",
borderColor: "rgba(0,166,90,1)",
}]
},
options: {
responsive: true,
scales: {
yAxes: [{
ticks: {
beginAtZero: false,
userCallback: function(label, index, labels) {
// when the floored value is the same as the value we have a whole number
if (Math.floor(label) === label) {
return label;
}
},
}
}],
},
}
};
var myChart = new Chart(visitor_graph, config);
});
</script>