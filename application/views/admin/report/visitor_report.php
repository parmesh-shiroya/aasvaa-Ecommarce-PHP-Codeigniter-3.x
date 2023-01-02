
<?php
$total_visitor = $total_spend_time = 0;
$chart_date    = $chart_visitors    = $chart_spend_time    = '';

foreach (array_reverse($date_visitor) as $key => $value) {
	$total_visitor += $value->total_visitor;
	$total_spend_time += $value->total_time_spend;
	$chart_date .= '"' . substr($value->date, 0, -5) . '",';
	$chart_visitors .= $value->total_visitor . ',';
	$chart_spend_time .= $value->total_time_spend . ',';
}

/**
 * @param  $seconds
 * @return mixed
 */
function secondsToTime($seconds) {
	$dtF    = new \DateTime('@0');
	$dtT    = new \DateTime("@$seconds");
	$days   = $dtF->diff($dtT)->format('%a');
	$hours  = $dtF->diff($dtT)->format('%h');
	$mins   = $dtF->diff($dtT)->format('%i');
	$return = '1 Min';
	if ($mins != 0) {
		$return = $mins . ' Min';
	}
	if ($hours != 0) {
		$return = $hours . ' Hr, ' . $mins . ' Min';
	}
	if ($days != 0) {
		$return = $days . ' Days, ' . $hours . ' Hr, ' . $mins . ' Min';
	}
	return $return;
}
?>

<div class="c-row gmf black-text">
  <div class="grid white g8pt2 g8pb6 border3-1px g124 right">
    <div class="left h35 valign-wrapper">
      <div class="grid cp">
        <i class="material-icons vam">assessment</i> <span class="vam g8ml10 g8fs16 font-roboto_slab">Visitor Report</span>
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
  <div class="grid gpf g124">
      <div class="grid minimize-card bb0 green-card gpf">
        <div class="grid header-div gpf  g824">
          <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">group</i><span class="vam">Total Visitor</span></h6>
          <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
        </div>
        <div class="minimize-container table-view g124 font-karla grid gpf">
          <div class="grid gpf bborder-1px g8p10 g124">
            <span class="g8fs14 g124  g8mb7 g8fw600 grid gpf "><i class="material-icons vam g8mr7">face</i><span class="vam">Total Visitors</span></span>
            <span class="g8fs23 g8fw600 grey-text g8pl4 text-darken-2 num-comma" numbers="<?php echo $total_visitor; ?>"></span>
          </div>
          <div class="grid gpf bborder-1px g8p10 g124">
            <span class="g8fs14 g124  g8mb7 g8fw600 grid gpf "><i class="material-icons vam g8mr7">timelapse</i><span class="vam">Total Spend Time</span></span>
            <span class="g8fs19 g8fw600 grey-text  g8pl4 text-darken-2"><?php echo secondsToTime($total_spend_time * 60); ?></span>
          </div>

        </div>
      </div>
    </div>
<div class="grid minimize-card bb0 purple-card gpf">
      <div class="grid header-div gpf  g824">
       <!--  sml hover-text-primary pointer" data='get_top_search_with_few_result' data-type='Top Search With Few Result' -->
         <h6 data='most_visited_ips' data-type='Most Visited IP'  class="left sml hover-text-primary pointer g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">assignment</i><span class="vam">Most Visited IP</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid  g114">
              <h6 class="g8fs13 wsn oh g8fw600 toe">Ip</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 tooltipped g8fw600" data-position="top" data-tooltip="Total Visited Days">Visit</h6>
            </div>
            <div class="grid gpf center g16">
            <h6 class="g8fs13 g8fw600 tooltipped" data-position="top" data-tooltip="Total Spend Time">Time</h6>
            </div>

          </div>
        </div>
        <?php
foreach ($most_visited_ips as $key => $value) {
	?>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g114">

            <h6 class="g8fs12 font-capitalize   wsn oh toe"><?php echo $value->ip; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php echo $value->total_time_visit; ?></h6>
          </div>
          <div class="grid gpf center g16">
            <h6 class="g8fs12"><?php echo secondsToTime($value->total_spend_time * 60); ?></h6>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </section>
  <section class="second-row-section grid g16 gpf">
  <div class="grid minimize-card gmf g8mtb7 bb0 purple-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">language</i><span class="vam">Browser</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <canvas id="browser_graph" width="100%"></canvas>
      </div>
    </div>
    <div class="grid minimize-card gmf g8mtb7 bb0 yellow-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">important_devices</i><span class="vam">Devices</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <canvas id="device_graph" width="100%"></canvas>
      </div>
    </div>
  </section>
  <section class="third-row-section grid g112 gpf">
  <div class="grid minimize-card bb0 blue-card gpf">
      <div class="grid header-div gpf  g124">
      <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">timeline</i><span class="vam">Total Spend Time</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container  g8pt0 font-karla grid g124 gpf">

        <canvas id="spend_time_graph" class=" g8p5" width="100%"></canvas>
      </div>
    </div>
    <div class="grid minimize-card bb0 green-card gpf">
      <div class="grid header-div gpf  g124">
      <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">timeline</i><span class="vam">Total Visitors</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container  g8pt0 font-karla grid g124 gpf">

        <canvas id="sales_graph" class=" g8p5" width="100%"></canvas>
      </div>
    </div>
    <div class="grid minimize-card bb0 red-card gpf">
      <div class="grid header-div gpf  g824">
      <!-- mtsc hover-text-primary pointer -->
      <h6 class="left g8fs16 g8m0 mtsc hover-text-primary pointer font-scope_one g8fw600"><i class="material-icons vam g8mr10">person</i><span class="vam">Most Visited Customers</span></h6>
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
              <h6 class="g8fs13  wsn oh g8fw600 toe tooltipped" data-position="top" data-tooltip="Total Visited Days">Visits</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600 tooltipped" data-position="top" data-tooltip="Total Spend Time">Spend Time</h6>
            </div>
          </div>
        </div>
        <?php
foreach ($mtsc as $key => $value) {?>
<div class="grid gpf search-row g8plr10 g8ptb2 g824">
<div class="grid  g18">
            <h6 class="g8fs12 font-capitalize wsn oh toe"><?php echo $value->first_name . ' ' . $value->last_name; ?></h6>
          </div>
          <div class="grid  g18">
            <h6 class="g8fs12 wsn oh toe"><?php echo $value->email_id; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php echo $value->visited_days; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12 "><?php echo secondsToTime($value->stay_time * 60); ?></h6>
          </div>
        </div>
<?php }
?>

      </div>
    </div>
    <div class="grid minimize-card bb0 teal-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">place</i><span class="vam">Countries</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <canvas id="country_graph" width="100%"></canvas>
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
    <td class="center">Days</td>
    <td class="center">Spend Time</td>
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
<div class="c-row gmf c-center g8ptb20 ">
<div class="spinner g8mtb0 hidden small_model_loader ">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
          </div>
<table class="bordered small_model_table border-1px g8fs13 grey-text text-darken-1">
<thead>
  <tr>
  <td>Ip</td>
  <td class="center">Days</td>
  <td class="center">Time</td>
  <td class="center">Country</td>
  <td class="center">Region</td>
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
html += '<tr><td>'+val.ip+'</td><td class="center">'+val.total_time_visit+'</td>';
html += '<td class="center">'+sformat(val.total_spend_time*60)+'</td><td class="center">'+val.country+'</td><td class="center">'+val.region+'</td></tr>';
});
   $("#small_model .small_model_loader").addClass('hidden');
  $("#small_model .small_model_table").removeClass('hidden');
  $("#small_model .small_model_table tbody").html(html);
console.log(data);
},'json');
}

  $(".mtsc").on('click', function(event) {
    event.preventDefault();
get_most_visited_customer('get_mostTimeSpendCustomer');
  });


    function sformat(s) {
      var ss_days = Math.floor(s / 60 / 60 / 24);
      var ss_hour = Math.floor(s / 60 / 60) % 24;
      var ss_mins = Math.floor(s / 60) % 60;
      var ss_return = '1 Min';
      if (ss_mins != 0) {
    ss_return = ss_mins + ' Min';
  }
  if (ss_hour != 0) {
    ss_return = ss_hour + ' Hr, ' + ss_mins + ' Min';
  }
  if (ss_days != 0) {
    ss_return = ss_days + ' Days, ' + ss_hour + ' Hr, ' + ss_mins + ' Min';
  }
          return ss_return;
    }
function get_most_visited_customer(page){
  $("#page_report_model").openModal();
  $("#page_report_model .model-title").text('Most Visited Customers');
  $("#page_report_model .page_report_loader").removeClass('hidden');
  $("#page_report_model .page_report_model_table").addClass('hidden');
  $.post(base_url+'admin/report/visitor_report/get_all_data', {get_data: page}, function(data, textStatus, xhr) {
    var html = "";
$.each(data, function(index, val) {
html += '<tr><td>'+val.first_name+' '+val.last_name+'</td><td>'+val.email_id+'</td>';
html += '<td class="center">'+val.visited_days+'</td>';
html += '<td class="center">'+sformat(val.stay_time * 60)+'</td></tr>';
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

var keyword = [<?php echo $chart_date ?>];
var delivered_date = [<?php echo $chart_visitors ?>];
var visitor_graph = document.getElementById("sales_graph");
var config = {
type: 'line',
data: {
labels: keyword,
datasets: [{
label: "Visitors",
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
//////////////////////////////////////////////////////
///
var keyword = [<?php echo $chart_date; ?>];
var chart_spend_time = [<?php echo $chart_spend_time; ?>];
var visitor_graph = document.getElementById("spend_time_graph");
var config = {
type: 'line',
data: {
labels: keyword,
datasets: [{
label: "Minutes",
data: chart_spend_time,
backgroundColor: "rgba(0,192,239,0.4)",
borderColor: "rgba(0,192,239,1)",
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

////////////////////////////////////////////////////
$(document).ready(function() {
<?php
$browsers = "";
$size     = "";
foreach ($browser_data as $key => $value) {
	$browsers .= '"' . $value->browser . '",';
	$size .= $value->total . ',';
}
?>
var browser_graph = document.getElementById("browser_graph");
var myChart = new Chart(browser_graph, {
type: 'doughnut',
data: {
labels: [<?php echo $browsers; ?>],
datasets: [{
label: '# of Votes',
data: [<?php echo $size; ?>],
backgroundColor: [
'rgb(245,105,84)',
'rgb(0,166,90)',
'rgb(0,192,239)',
'rgb(243,156,18)',
'rgb(60,141,188)',
'rgb(80,80,80)',
'rgb(103,65,140)'
],
}]
},
options: {
}
});
});
/////////////////////////////////////////////////////////////
$(document).ready(function() {
<?php
$platform = "";
$size     = "";
foreach ($platform_data as $key => $value) {
	$platform .= '"' . $value->platform . '",';
	$size .= $value->total . ',';
}
?>
var device_graph = document.getElementById("device_graph");
var myChart = new Chart(device_graph, {
type: 'doughnut',
data: {
labels: [<?php echo $platform; ?>],
datasets: [{
label: '# of Votes',
data: [<?php echo $size; ?>],
backgroundColor: [
'rgb(53,123,188)',
'rgb(255,88,113)',
'rgb(74,74,74)',
'rgb(243,156,18)',
'rgb(0,166,90)',
'rgb(80,80,80)',
'rgb(255,126,126)'
],
}]
},
options: {
}
});
});
/////////////////////////////////////////////////////
$(document).ready(function() {
<?php
$country = "";
$size    = "";
foreach ($country_data as $key => $value) {
	$country .= '"' . $value->country_name . '",';
	$size .= $value->total . ',';
}
?>
var country_graph = document.getElementById("country_graph");
var myChart = new Chart(country_graph, {
type: 'bar',
data: {
labels: [<?php echo $country; ?>],
datasets: [{
label: 'Users',
data: [<?php echo $size; ?>],
backgroundColor: [
'rgb(255,88,113)',
'rgb(243,156,18)',
'rgb(74,74,74)',
'rgb(0,166,90)',
'rgb(53,123,188)',
'rgb(80,80,80)',
'rgb(255,126,126)'
],
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero:true,
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
</script>