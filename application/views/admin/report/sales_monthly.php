<?php

$report_title = $title;

$this->view('admin/report/content/report_title', array('report_title' => $report_title));
$this->view('admin/report/content/bar_graph');
$this->view('admin/report/content/grid_table');
?>

<style>
.pp-admin-content{
padding: 0px !important;
}
</style>
<script>
var myChart = "";
$(document).ready(function() {
 var ctx = document.getElementById("sales_graph");
ctx.height = "350px;"
  myChart= new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Loading..","Loading..","Loading..","Loading.."],
        datasets: [{
            label: '',
            data: [0,0,0,0],
            backgroundColor:'rgba(183, 98, 255, 0.2)',
            borderColor:'rgba(183, 98, 255, 1)',
            borderWidth: 1
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
        }
    }
});
});
</script>
<script>
	$(document).ready(function() {

		$("#report_date_form").on('submit', function(event) {
			event.preventDefault();
get_data('<?php echo $data_of; ?>');
		});
get_data('<?php echo $data_of; ?>');
function get_data(data_type){
	$(".report_loading_div").removeClass('hidden');
		var from = $("#form_date").val();
		var to =$("#to_date").val();

$.get(base_url+'admin/report/report?data='+data_type+'&from='+from+'&to='+to, function(datas) {
	console.log(datas);
	myChart.data.labels = datas.x_axis_data;
	myChart.data.datasets[0].label = datas.chart_label;
	myChart.data.datasets[0].data = datas.y_axis_data;
	myChart.update();
	var table_header = "";
	var table_body = "";

	$.each(datas.table_header, function(index, val) {
		 table_header += "<th>"+val+"</th>";
	});
	$.each(datas.table_data, function(index, val) {
		 table_body += "<tr>";
		 $.each(val, function(index1, val1) {
			table_body += "<td>"+val1+"</td>";
		 });
		 table_body += "</tr>";
	});
	$(".report_loading_div").addClass('hidden');
	$("#report-table thead tr").html(table_header);
	$("#report-table tbody").html(table_body);

},'json');
	}
	});
</script>


