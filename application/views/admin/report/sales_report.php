<div class="c-row gmf black-text">
  <div class="grid white g8pt2 g8pb6 border3-1px g124 right">
    <div class="left h35 valign-wrapper">
      <div class="grid cp">
        <i class="material-icons vam">assessment</i> <span class="vam g8ml10 g8fs16 font-roboto_slab">Sale Report</span>
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
          <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">trending_up</i><span class="vam">Total Sales</span></h6>
          <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
        </div>
        <div class="minimize-container table-view g124 font-karla grid gpf">
         <?php
$cod_sales     = $cod_orders     = 0;
$prepaid_sales = $prepaid_orders = 0;
foreach ($get_order_codAndPrepaid_profit as $key => $value) {
	if ($value->payment_from == 'cod') {
		$cod_sales  = $cod_sales + $value->total_sale;
		$cod_orders = $cod_orders + $value->total_orders;
	} else if ($value->payment_from == 'paypal' || $value->payment_from == 'ccavenue') {
		$prepaid_sales  = $prepaid_sales + $value->total_sale;
		$prepaid_orders = $prepaid_orders + $value->total_orders;
	}
}
?>
        <!--   <div class="grid gpf bborder-1px g8p10 g112">
            <span class="g8fs14 g124  g8mb7 g8fw600 grid gpf "><i class="material-icons vam g8mr7">credit_card</i><span class="vam">Prepaid Sale</span></span>
            <span class="g8fs23 g8fw600 grey-text g8pl4 text-darken-2 price" price="<?php echo $prepaid_sales; ?>"></span>
          </div> -->
    <!--       <div class="grid gpf bborder-1px g8p10 g112">
            <span class="g8fs14 g124  g8mb7 g8fw600 grid gpf "><i class="material-icons vam g8mr7">attach_money</i><span class="vam">Cod Sale</span></span>
            <span class="g8fs23 g8fw600 grey-text  g8pl4 text-darken-2 price" price="<?php echo $cod_sales; ?>"></span>
          </div> -->
          <div class="grid gpf g8p10 g112">
            <span class="g8fs14 g124  g8mb7 g8fw600 grid gpf ">Prepaid Orders</span>
            <span class="g8fs23 g8fw600 grey-text g8pl4 text-darken-2"><?php echo $prepaid_orders; ?></span>
          </div>
          <div class="grid gpf g8p10 g112">
            <span class="g8fs14 g124  g8mb7 g8fw600 grid gpf ">Cod Orders</span>
            <span class="g8fs23 g8fw600 grey-text  g8pl4 text-darken-2"><?php echo $cod_orders; ?></span>
          </div>
        </div>
      </div>
    </div>
    <div class="grid minimize-card bb0 purple-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 font-scope_one g8fw600">Most Selling Sku</h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
          <div class="grid   g116">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Sku</h6>
            </div>
            <div class="grid gpf center g18">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Total Order</h6>
            </div>


          </div>
        </div>
        <?php
foreach ($varient_sku as $key => $value) {?>
<div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g116">
            <h6 class="g8fs12 font-capitalize  wsn g8ls5 oh toe"><a target="_blank" class="hover-text-primary grey-text-new" href="<?php echo base_url('product/aasvaa/aasvaa/' . $value->pro_sku . '/' . $value->product_id . '/aasvaa'); ?>"><?php echo $value->pro_sku; ?></a></h6>
          </div>
          <div class="grid gpf center g18">
            <h6 class="g8fs12"><?php echo $value->total_qty; ?></h6>
          </div>
        </div>
<?php }
?>

      </div>
    </div>
  </section>
  <section class="second-row-section grid g16 gpf">
   <div class="grid minimize-card gmf g8mtb7 bb0 yellow-card gpf">
      <div class="grid header-div gpf  g824">
        <h6 class="left g8fs16 font-scope_one g8fw600">Order Status</h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid gpf center g118">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Status</h6>
            </div>
            <div class="grid gpf center g16">
              <h6 class="g8fs13 g8fw600">Total</h6>
            </div>
          </div>
        </div>
        <?php
$t_delivered = $t_cancel = $t_return = $t_others = 0;
foreach ($order_count_data as $order_count_data_key => $order_count_data_value) {
	switch ($order_count_data_value->status) {
	case '4':
	case '16':
	case '11':
		$t_delivered = $t_delivered + $order_count_data_value->total;
		break;
	case '7':
		$t_cancel = $t_cancel + $order_count_data_value->total;
		break;
	case '12':
	case '13':
	case '14':
	case '15':
		$t_return = $t_return + $order_count_data_value->total;
		break;
	case '1':
	case '2':
	case '3':
	case '5':
	case '6':
	case '8':
	case '18':
		$t_others = $t_others + $order_count_data_value->total;
		break;
	default:
		# code...
		break;
	}

}
?>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g118">
            <h6 class="g8fs12 font-capitalize wsn oh toe">Delivered</h6>
          </div>
          <div class="grid gpf center g16">
            <h6 class="g8fs12"><?php echo $t_delivered; ?></h6>
          </div>
        </div>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g118">
            <h6 class="g8fs12 font-capitalize wsn oh toe">Return Orders</h6>
          </div>
          <div class="grid gpf center g16">
            <h6 class="g8fs12"><?php echo $t_return; ?></h6>
          </div>
        </div>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g118">
            <h6 class="g8fs12 font-capitalize wsn oh toe">Cancel Order</h6>
          </div>
          <div class="grid gpf center g16">
            <h6 class="g8fs12"><?php echo $t_cancel; ?></h6>
          </div>
        </div>
        <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g118">
            <h6 class="g8fs12 font-capitalize wsn oh toe">New Orders</h6>
          </div>
          <div class="grid gpf center g16">
            <h6 class="g8fs12"><?php echo $t_others; ?></h6>
          </div>
        </div>
      </div>
    </div>
<div class="grid minimize-card  gmf g8mtb7 bb0 teal-card gpf">
      <div class="grid header-div gpf  g824">
      <!-- prmt hover-text-primary pointer -->
        <h6 class="left g8fs16 prmt hover-text-primary pointer font-scope_one g8fw600" page="valuablecustomers">Valuable Customers</h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
            <div class="grid   g118">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Email Id</h6>
            </div>
            <div class="grid gpf center g16">
              <h6 class="g8fs13 g8fw600 tooltipped" data-position="left" data-tooltip="Total Product Buy">Products</h6>
            </div>
          </div>
        </div>
<!-- In>Email>Shown>H6 prmt hover-text-primary pointer -->
        <?php
foreach ($customer_WBS as $key => $value) {?>
  <div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g118">
            <h6 class="g8fs12 prmt hover-text-primary pointer font-capitalize wsn oh toe" page='orders' ids='<?php echo $value->customer_id; ?>'><?php echo $value->email_id ?></h6>
          </div>
          <div class="grid gpf center g16">
            <h6 class="g8fs12 tooltipped"  data-position="left" data-tooltip="<?php echo 'Rs.' . round($this->ccr->cc2("INR", "INR", $value->total_bill_amount)); ?>"><?php echo $value->total_products; ?></h6>
          </div>
        </div>
<?php }
?>
      </div>
    </div>
  </section>
  <section class="third-row-section grid g112 gpf">
    <div class="grid minimize-card bb0 blue-card gpf">
      <div class="grid header-div gpf  g124">
      <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">timeline</i><span class="vam">Total Sales</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container  g8pt0 font-karla grid g124 gpf">
        <div class="g8mlr15 ">
          <label>Select Status</label>
          <select class="browser-default select-status-for-chart">
            <option selected value="1">Delivered</option>
            <option value="2">Return (Confirmed, Complete)</option>
            <option value="3">Cancel Orders</option>
          </select>
        </div>
        <canvas id="sales_graph" class="mh270 g8p5" width="100%"></canvas>
      </div>
    </div>
<div class="grid minimize-card bb0 red-card gpf">
      <div class="grid header-div gpf  g824">
      <h6 class="left g8fs16 g8m0  font-scope_one g8fw600"><i class="material-icons vam g8mr10">today</i><span class="vam">Monthly Report</span></h6>
        <h6 class="right pointer minimize-btn g8m0"><i class="material-icons">remove</i></h6>
      </div>
      <div class="minimize-container g124 table-view font-karla grid gpf">
        <div class="grid grey-text   text-darken-2 gpf search-row g8plr10 g8pb4 g824">
          <div class="grid gpf g824">
          <div class="grid gpf center g18">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Month</h6>
            </div>
            <div class="grid gpf center g14">
              <h6 class="g8fs13  wsn oh g8fw600 toe">Total Order</h6>
            </div>
            <div class="grid gpf center g13">
              <h6 class="g8fs13 g8fw600">Delivered</h6>
            </div>
            <div class="grid gpf center g13">
              <h6 class="g8fs13 g8fw600">Return</h6>
            </div>
            <div class="grid gpf center g13">
              <h6 class="g8fs13 g8fw600">Cancel</h6>
            </div>
<div class="grid gpf center g13">
              <h6 class="g8fs13 g8fw600">New orders</h6>
            </div>
          </div>
        </div>
        <?php
foreach ($total_sales_price_by_month as $key => $value) {?>
<div class="grid gpf search-row g8plr10 g8ptb2 g824">
          <div class="grid  g18">
            <h6 class="g8fs12 font-capitalize wsn oh toe"><?php echo $value['order_month']; ?></h6>
          </div>
          <div class="grid gpf center g14">
            <h6 class="g8fs12 tooltipped" data-position="left" data-tooltip="<?php echo $value['total_orders']; ?>"><?php echo 'Rs.' . round($this->ccr->cc2("INR", "INR", $value['total_sale'])); ?></h6>
          </div>
          <div class="grid gpf center g13">
            <h6 class="g8fs12 tooltipped" data-position="left" data-tooltip="<?php echo $value['s_delivered']; ?>"><?php echo 'Rs.' . round($this->ccr->cc2("INR", "INR", $value['ta_delivered'])); ?></h6>
          </div>
          <div class="grid gpf center g13">
            <h6 class="g8fs12 tooltipped" data-position="left" data-tooltip="<?php echo $value['s_return']; ?>"><?php echo 'Rs.' . round($this->ccr->cc2("INR", "INR", $value['ta_return'])); ?></h6>
          </div>
          <div class="grid gpf center g13">
            <h6 class="g8fs12 tooltipped" data-position="left" data-tooltip="<?php echo $value['s_cancel']; ?>"><?php echo 'Rs.' . round($this->ccr->cc2("INR", "INR", $value['ta_cancel'])); ?></h6>
          </div>
           <div class="grid gpf center g13">
            <h6 class="g8fs12 tooltipped" data-position="left" data-tooltip="<?php echo $value['s_other']; ?>"><?php echo 'Rs.' . round($this->ccr->cc2("INR", "INR", $value['ta_other'])); ?></h6>
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
      <h6 class="center g8fw500 font-open_sans model-title g8fs19 cp">Valuable Customers</h6>
<div class="c-row gmf c-center g8p20 ">
<div class="spinner g8mtb0 hidden page_report_loader ">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
          </div>
          <div class="grid gpf g124 table_heading"></div>
<table class="bordered page_report_model_table border-1px g8fs13 grey-text text-darken-1">
<thead>
  <tr>
    <td>Name</td>
    <td>Email</td>
    <td class="center">Total Products</td>
    <td class="center">Total Orders</td>
    <td class="center">Delivered</td>
    <td class="center">Return</td>
    <td class="center">Cancel</td>
    <td class="center">Other</td>
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



$("#page_report_model").on('click', '.prmt', function(event) {
  event.preventDefault();
  var page = $(this).attr('page');
  var ids = $(this).attr('ids');
get_customer_orders_report_data(ids);
});

$(".prmt").on('click', function(event) {
    event.preventDefault();
    var page = $(this).attr('page');

    if (page == 'valuablecustomers') {
get_page_report_data('get_customer_WBS');
    }
    else if(page == 'orders'){
var ids = $(this).attr('ids');
get_customer_orders_report_data(ids);
    }

  });


function get_customer_orders_report_data(ids){
  $("#page_report_model").openModal();
  $("#page_report_model .model-title").text('Valuable Customers');
  $("#page_report_model .page_report_loader").removeClass('hidden');
  $("#page_report_model .page_report_model_table").addClass('hidden');
  $.post(base_url+'admin/report/sales_report/get_all_data', {get_data: 'get_customer_orders',pass_data:ids}, function(data, textStatus, xhr) {
    var html = '<thead><tr><td class="center">Order Id</td><td class="center">Payment Type</td><td class="center">Total Products</td><td class="center">Bill Amount</td><td class="center">Status</td><td class="center">Date</td></tr></thead><tbody class="font-karla">';
var heading ='';
$.each(data, function(index, val) {
  heading = '<div class="grid g112 font-karla  g8fw600 border-1px valign-wrapper bb0 g8ptb11 "><div class="grid font-capitalize g112">'+val.first_name+' '+val.last_name+'</div><div class="grid g112">'+val.email_id+'</div></div>';
html += '<td class="center">'+val.order_order_id+'</td>';
html += '<td class="center">'+val.payment_from+'</td>';
html += '<td class="center">'+val.total_products+'</td>';
html += '<td class="center">Rs. '+price_seprate(val.bill_amount)+'</td>';
html += '<td class="center">'+val.order_status+'</td>';
html += '<td class="center">'+val.order_date+'</td>';
html +='</tr>';
});
html += "</tbody>";
$("#page_report_model .page_report_loader").addClass('hidden');
$("#page_report_model .page_report_model_table").removeClass('hidden');
$(".table_heading").removeClass('hidden');
$(".table_heading").html(heading);
$("#page_report_model .page_report_model_table").html(html);
  },'json');
}



function get_page_report_data(page){
  $("#page_report_model").openModal();
  $(".table_heading").addClass('hidden');
  $("#page_report_model .model-title").text('Valuable Customers');
  $("#page_report_model .page_report_loader").removeClass('hidden');
  $("#page_report_model .page_report_model_table").addClass('hidden');
  $.post(base_url+'admin/report/sales_report/get_all_data', {get_data: page}, function(data, textStatus, xhr) {
    var html = '<thead><tr><td>Name</td><td>Email</td><td class="center">Total Products</td><td class="center">Total Orders</td><td class="center">Delivered</td><td class="center">Return</td><td class="center">Cancel</td><td class="center">New Orders</td></tr></thead><tbody class="font-karla">';
$.each(data, function(index, val) {

html += '<tr><td class="prmt hover-text-primary pointer"  page="orders" ids="'+val.customer_id+'">'+val.first_name+' '+val.last_name+'</td><td  page="orders" ids="'+val.customer_id+'" class="prmt hover-text-primary pointer">'+val.email_id+'</td>';
html += '<td class="center tooltipped" data-position="left" data-tooltip="'+val.total_products+'">Rs.'+price_seprate(val.total_bill_amount)+'</td>';
html += '<td class="center tooltipped" data-position="left" data-tooltip="'+val.total_orders+'">Rs.'+price_seprate(val.total_bill_amount)+'</td>';
html += '<td class="center tooltipped" data-position="left" data-tooltip="'+val.s_delivered+'">Rs.'+price_seprate(val.ta_delivered)+'</td>';
html += '<td class="center tooltipped" data-position="left" data-tooltip="'+val.s_return+'">Rs.'+price_seprate(val.ta_return)+'</td>';
html += '<td class="center tooltipped" data-position="left" data-tooltip="'+val.s_cancel+'">Rs.'+price_seprate(val.ta_cancel)+'</td>';
html += '<td class="center tooltipped" data-position="left" data-tooltip="'+val.s_other+'">Rs.'+price_seprate(val.ta_other)+'</td>';
html +='</tr>';
});
html += "</tbody>";
$("#page_report_model .page_report_loader").addClass('hidden');
$("#page_report_model .page_report_model_table").removeClass('hidden');
$("#page_report_model .page_report_model_table").html(html);
  $('.tooltipped').tooltip({delay: 50});
  },'json');
}


});
</script>
<script>
$(document).ready(function() {
<?php
$delivered_date = $return_o_date = $cancel_date = $delivered_size = $return_o_size = $cancel_size = "";
foreach ($total_sales_price_by_month as $key => $value) {
	if ($value['s_delivered'] != 0) {
		$delivered_date .= '"' . substr($value['date'], 0, -5) . '",';
		$delivered_size .= $value['ta_delivered'] . ',';
	}
	if ($value['s_return'] != 0) {
		$return_o_date .= '"' . substr($value['date'], 0, -5) . '",';
		$return_o_size .= $value['ta_return'] . ',';
	}
	if ($value['s_cancel'] != 0) {
		$cancel_date .= '"' . substr($value['date'], 0, -5) . '",';
		$cancel_size .= $value['ta_cancel'] . ',';
	}
}
?>
var delivered_size = [<?php echo $delivered_size ?>];
var delivered_date = [<?php echo $delivered_date ?>];
var return_o_size = [<?php echo $return_o_size ?>];
var return_o_date = [<?php echo $return_o_date ?>];
var cancel_size = [<?php echo $cancel_size ?>];
var cancel_date = [<?php echo $cancel_date ?>];
var visitor_graph = document.getElementById("sales_graph");
var config = {
type: 'line',
data: {
labels: delivered_date,
datasets: [{
label: "Total Sales",
data: delivered_size,
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
$(".select-status-for-chart").on('change', function(event) {
event.preventDefault();
if ($(this).val() == 1) {
myChart.data.labels = delivered_date;
myChart.data.datasets[0].label = 'Total Sales';
myChart.data.datasets[0].data = delivered_size;
myChart.data.datasets[0].backgroundColor = "rgba(0,166,90,0.4)";
myChart.data.datasets[0].borderColor = "rgba(0,166,90,1)";
myChart.update();
}else if($(this).val() == 2){
myChart.data.labels = return_o_date;
myChart.data.datasets[0].label = 'Total Return';
myChart.data.datasets[0].data = return_o_size;
myChart.data.datasets[0].backgroundColor = "rgba(221,75,57,0.4)";
myChart.data.datasets[0].borderColor = "rgba(221,75,57,1)";
myChart.update();
}else if($(this).val() == 3){
myChart.data.labels = cancel_date;
myChart.data.datasets[0].label = 'Cancel';
myChart.data.datasets[0].data = cancel_size;
myChart.data.datasets[0].backgroundColor = "rgba(243,156,18,0.4)";
myChart.data.datasets[0].borderColor = "rgba(243,156,18,1)";
myChart.update();
}
});
});
</script>