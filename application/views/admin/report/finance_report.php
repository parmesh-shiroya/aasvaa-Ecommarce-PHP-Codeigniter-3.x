
<div class="c-row c-equalspace	 gmf black-text">
<div class="c-row gmf black-text">
  <div class="grid white g8pt2 g8pb6 border3-1px g124 right">
    <div class="left h35 valign-wrapper">
      <div class="grid g8pt5  cp">
        <i class="material-icons vam">assessment</i> <span class="vam g8ml10 g8fs16 font-roboto_slab">Finance Report</span>
      </div>
      <div class="spinner g8mtb0 g8ml20 h25 report_loading_div hidden ">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
          </div>
    </div>
    <div class="right">
      <form action="" id="report_date_form" class="date-range-selector-form pp-form" method="post" accept-charset="utf-8">
        <div class="pp-text-field grid">
          <input id="form_date" placeholder="Start Date" value="<?php echo $_SESSION['adm']['report_data']['start_date']; ?>" required name="report_start_date" type="text" class="select_date_start">
        </div>
        <div class="left valign-wrapper h34">~</div>
        <div class="pp-text-field grid">
          <input id="to_date" value="<?php echo $_SESSION['adm']['report_data']['end_date']; ?>" placeholder="End Date" required name="report_end_date" type="text" class="select_date_end">
        </div>
        <div class="grid gpf">
          <button class="c-btna g8mt7 g8plr14 h27">Get</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="grid g810">
<div class="card z-depth-05 grid gpf g8p20 g124">
<h5 class="cp g8m0  g8pb17 font-roboto_slab g8fs20">Sales</h5>
  <div class="grid g124 gpf ">
    <div class="g124 font-karla grid gpf">
                   <div class="grid gpf bborder-1px g8p g112">
            <span class="g8fs14 g124  g8mb7 g8fw600 grid gpf "><i class="material-icons vam g8mr7">credit_card</i><span class="vam">Prepaid Sale</span></span>
            <span class="g8fs23 g8fw600 grey-text g8pl4 text-darken-2 prepaid_sales">₹0</span>
          </div>
          <div class="grid gpf bborder-1px g8p g112">
            <span class="g8fs14 g124  g8mb7 g8fw600 grid gpf "><i class="material-icons vam g8mr7">attach_money</i><span class="vam">Cod Sale</span></span>
            <span class="g8fs23 g8fw600 grey-text  g8pl4 text-darken-2 cod_sales">₹0</span>
          </div>
        </div>
        <div class="g124 font-karla g8pt13 grid gpf">
        <table class="mini-table">
  <tbody>
    <tr><td>Gross sales</td><td class="right gross_sales">Rs. 0.00</td></tr>
    <tr><td>Discounts</td><td class="right discount">Rs. 0.00</td></tr>
    <tr class="bborder-1px"><td>Returns</td><td class="right return">Rs. 0.00</td></tr>
    <tr><td>Net sales</td><td class="right net_sales">Rs. 0.00</td></tr>
    <tr><td>Shipping</td><td class="right shipping">Rs. 0.00</td></tr>
    <tr class="bborder-1px"><td>Taxes</td><td class="right taxes">Rs. 0.00</td></tr>
    <tr><td>Total sales</td><td class="right total_sales">Rs. 0.00</td></tr>
  </tbody>
</table>
</div>
  </div>
</div>
</div>
</div>




<style>
.pp-admin-content{
padding: 0px !important;
}

.mini-table tr td{
padding: 10px 3px;
}
</style>

<script>
	$(document).ready(function() {
$("#report_date_form").on('submit', function(event) {
			event.preventDefault();
get_finace_report();
		});
get_finace_report();
	function get_finace_report(){
		$(".report_loading_div").removeClass('hidden');
		var from = $("#form_date").val();
		var to =$("#to_date").val();
$.get(base_url+'admin/report/report?data=get_finace_report&from='+from+'&to='+to, function(datas) {
$.each(datas, function(index, val) {
	 $("."+index).html(val);
	 $(".report_loading_div").addClass('hidden');
});
	},'json');
	}
	});
</script>