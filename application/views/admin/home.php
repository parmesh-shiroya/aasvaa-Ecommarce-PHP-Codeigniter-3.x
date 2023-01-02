
<section>
	<div class="c-row c-center g8mtb10 gmf black-text">
		<div class="grid data-card  z-depth-05 card  gpf g16">
			<div class="grid g16 black-text icon-side center red lighten-1">
				<i class="material-icons white-text">view_module</i>
			</div>
			<div class="grid g118 gpf body-side center">
				<div class="grid g8fs14 gpf g112"><h6 class="g8m4 g8fs14 g8ls10 g8fw500">In Stock</h6><?php echo $stock['instock']; ?></div>
				<div class="grid g8fs14 gpf g112"><h6 class="g8m4 g8fs14 g8ls10 g8fw500">Out Stock</h6><?php echo $stock['outstock']; ?></div>
			</div>
		</div>
		<div class="grid data-card card z-depth-05 gpf g16">
			<div class="grid g16 black-text icon-side center  yellow darken-3">
				<i class="material-icons white-text">people</i>
			</div>
			<div class="grid g118 gpf body-side center">
				<div class="grid g8fs14 gpf g124"><h6 class="g8m4 g8fs14 g8ls10 g8fw500">Total Customer</h6><?php echo $total_customer; ?></div>
			</div>
		</div>
		<div class="grid   data-card card z-depth-05  gpf g16">
			<div class="grid g16 black-text icon-side center  green lighten-1">
				<i class="material-icons white-text">mms</i>
			</div>
			<div class="grid g118 gpf body-side center">
				<div class="grid g8fs14 gpf g124"><h6 class="g8m4 g8fs14 g8ls10 g8fw500">Bulk Sms</h6><?php echo $this->pp_loader_helper->get_bulksms_balance(); ?></div>
			</div>
		</div>
	</div>
</section>
<div class="c-row gmf  black-text">
  <section class="first-row-section grid g16 gpf">
    <div class="grid minimize-card bb0 green-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 font-scope_one g8fw600">Order Status</h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid gpf center g120">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Status</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600">Total</h6>
            </div>
          </div>
        </div>
        <?php
$title_array  = array('New Orders', 'On Hold', 'Confirmed', 'Customize', 'Ready to Ship', 'In Transit', 'Out For Delivery', 'Delivered', 'Cancel Order');
$status_array = array(0, 5, 6, 1, 2, 3, 8, 4, 7);
foreach ($title_array as $key => $value) {
	?>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g120">
            <h6 class="g8fs12 font-capitalize wsn oh toe"><?php echo $value; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php
$match = false;
	foreach ($order_count_data as $order_count_data_key => $order_count_data_value) {
		if ($order_count_data_value->status == $status_array[$key]) {
			$match = true;
			echo $order_count_data_value->total;
			break;
		}
	}
	if (!$match) {
		echo 0;
	}
	?></h6>
          </div>
        </div>
        <?php }?>
      </div>
    </div>

  </section>
  <section class="first-row-section grid g16 gpf">
    <div class="grid minimize-card bb0 red-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 font-scope_one g8fw600">Return Order Status</h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container table-view font-karla grid gpf">
        <div class="grid grey-text  text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid gpf center g120">
              <h6 class="g8fs13 wsn g8fw600 oh toe">Status</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600 ">Total</h6>
            </div>
          </div>
        </div>
        <?php
$title_array  = array('Return Request', 'Request Refused', 'Return Confirmed', 'In Transit', 'Delivered', 'Return Complete');
$status_array = array(11, 16, 12, 13, 14, 15);
foreach ($title_array as $key => $value) {
	?>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g120">
            <h6 class="g8fs12 font-capitalize wsn oh toe"><?php echo $value; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php
$match = false;
	foreach ($order_count_data as $order_count_data_key => $order_count_data_value) {
		if ($order_count_data_value->status == $status_array[$key]) {
			$match = true;
			echo $order_count_data_value->total;
			break;
		}
	}
	if (!$match) {
		echo 0;
	}
	?></h6>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
<div class="grid minimize-card bb0 purple-card  gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 font-scope_one g8fw600">Top Search</h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid  g120">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Keyword</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13 g8fw600">Total</h6>
            </div>
          </div>
        </div>
        <?php
foreach ($top_search as $key => $value) {
	?>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g120">
            <h6 class="g8fs12 font-capitalize wsn oh toe"><?php echo $value->search; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12"><?php echo $value->total; ?></h6>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </section>
  <section class="first-row-section grid g16 gpf">
    <div class="grid minimize-card bb0 yellow-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 font-scope_one g8fw600">Browser</h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <canvas id="browser_graph" width="100%"></canvas>
      </div>
    </div>
    <div class="grid minimize-card bb0 purple-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 font-scope_one g8fw600">Countries</h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <canvas id="country_graph" width="100%"></canvas>
      </div>
    </div>
  </section>
    <section class="first-row-section grid g16 gpf">
    <div class="grid minimize-card bb0 teal-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 font-scope_one g8fw600">Devices</h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <canvas id="device_graph" width="100%"></canvas>
      </div>
    </div>
  </section>
</div>
<section class="three ">
	<div class="c-row gmf c-equaldist g8mtb10 black-text">
		<div class="grid yellow-card g8m7 z-depth-05 card g8p10 gpf g111">
			<canvas id="visitor_graph" width="100%"></canvas>
		</div>
	</div>
</section>
<style>
section.three .search-row,.table-view .search-row{
border-bottom: 1px solid #ddd;
}
.order_data_card .div-row{
border-bottom: 1px solid #ddd;
}
</style>
<script>
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
</script>
<script>
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
</script>
<script>
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
label: 'Visitors',
data: [<?php echo $size; ?>],
backgroundColor: [
'rgb(74,74,74)',
'rgb(255,88,113)',
'rgb(243,156,18)',
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
<script>
$(document).ready(function() {
<?php
$date = "";
$size = "";
foreach (array_reverse($visitor_data) as $key => $value) {
	$date .= '"' . substr($value['date'], 0, -5) . '",';
	$size .= $value['total'] . ',';
}
?>
var visitor_graph = document.getElementById("visitor_graph");
var myChart = new Chart(visitor_graph, {
type: 'bar',
data: {
labels: [<?php echo $date; ?>],
datasets: [{
	label: "Visitors",
data: [<?php echo $size; ?>],
backgroundColor: "rgba(102,187,106,0.4)",
borderColor: "rgba(102,187,106,1)",
}]
},
options: {
title: {
display: true,
fontSize:15,
fontStyle:'bold',
fontFamily:"'Scope One', serif",
text: 'Visitors',
},
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
</script>

<!-- <script>
	$(document).ready(function() {
		get_order_manage_data();
	function get_order_manage_data(){
		$.post(base_url+'admin/adminapi', {method: 'get_order_data'}, function(data, textStatus, xhr) {
			console.log(data);
			$.each(data, function(index, val) {
				var new_orders;
				var on_hold;
				var return_request;
			});
		},'json');
	}
	});
</script> -->