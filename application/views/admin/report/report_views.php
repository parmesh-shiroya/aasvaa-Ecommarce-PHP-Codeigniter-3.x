<div class="c-row gmf black-text">
  <div class="grid white g8pt2 g8pb6 border3-1px g124 right">
    <div class="left h35 valign-wrapper">
      <div class="grid cp">
        <i class="material-icons vam">assessment</i> <span class="vam g8ml10 g8fs16 font-roboto_slab">Reports</span>
      </div>
    </div>
    <div class="right">
      <form action="" class="date-range-selector-form pp-form " id="report_date_form" method="post" accept-charset="utf-8">
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
<div class="c-row c-equalspace gmf">
<div class="grid g718 g620 g816">
  <div class="grid g812">
    <div class="grid gpf g824 card z-depth-05 g8p20">
      <h6 class="cp font-roboto_slab gg8fs20">Sales Report</h6>
      <div class="grid gpf g8pt10 g8fs13 font-karla g824 black-text">
        <table class="mini-table">
          <tbody>
            <tr>
              <td><a href="<?php echo site_url('admin/report/sales_report/sales_by_month'); ?>">Sales By Month</a></td>
              <td></td>
            </tr>
            <tr>
              <td><a href="<?php echo site_url('admin/report/sales_report/sales_by_product'); ?>">Sales By Products</a></td>
              <td class="right sales_product"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="grid g812">
    <div class="grid gpf g824 card z-depth-05 g8p20">
      <h6 class="cp font-roboto_slab gg8fs20">Visitors Report</h6>
      <div class="grid gpf g8pt10 g8fs13 font-karla g824 black-text">
        <table class="mini-table">
          <tbody>
            <tr>
              <td><a href="<?php echo site_url('admin/report/Visitor_report/visitor_over_time'); ?>">Visitor Over Time</a></td>
              <td class="right visitor_over_time"></td>
            </tr>
            <tr>
              <td><a href="<?php echo site_url('admin/report/Visitor_report/visitor_by_country'); ?>">Visitors by location</a></td>
              <td class="right visitor_by_location"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="grid g812">
    <div class="grid gpf g824 card z-depth-05 g8p20">
      <h6 class="cp font-roboto_slab gg8fs20">Behaviour Report</h6>
      <div class="grid gpf g8pt10 g8fs13 font-karla g824 black-text">
        <table class="mini-table">
          <tbody>
            <tr>
              <td><a href="<?php echo site_url('admin/report/Behavior_report/top_search_report'); ?>">Top searches</a></td>
              <td class="right top_searches"></td>
            </tr>
            <tr>
              <td><a href="<?php echo site_url('admin/report/Behavior_report/top_search_wzp_report'); ?>">Top searches with zero result</a></td>
              <td class="right top_searches_with_zero_res"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="grid g812">
    <div class="grid gpf g824 card z-depth-05 g8p20">
      <h6 class="cp font-roboto_slab gg8fs20">Customers Report</h6>
      <div class="grid gpf g8pt10 g8fs13 font-karla g824 black-text">
        <table class="mini-table">
          <tbody>
            <tr>
              <td><a href="<?php echo site_url('admin/report/Customer_report/customer_by_countries'); ?>">Customer by countries</a></td>
              <td class="right customers_by_countries"></td>
            </tr>
            <tr>
              <td><a href="<?php echo site_url('admin/report/Customer_report/customer_over_time'); ?>">Customer over time</a></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="grid g812">
    <div class="grid gpf g824 card z-depth-05 g8p20">
      <h6 class="cp font-roboto_slab gg8fs20">Finance Report</h6>
      <div class="grid gpf g8pt10 g8fs13 font-karla g824 black-text">
        <table class="mini-table">
          <tbody>
            <tr>
              <td><a href="<?php echo site_url('admin/report/Finance_report/'); ?>">Finance Report</a></td>
            </tr>
            <tr>
              <td><a href="<?php echo site_url('admin/report/Finance_report/transaction_report'); ?>">Transaction Report</a></td>
            </tr>
            <tr>
              <td><a href="<?php echo site_url('admin/report/Single_order_report/'); ?>">Single Order Report</a></td>
            </tr>
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
.mini-table tr{
  border-bottom: 1px solid rgba(0, 0, 0, 0.08);
}
.mini-table tr:last-child{
  border-bottom: 0px;
}
.mini-table tr td{
padding: 10px 3px;
}
</style>


<script>
  $(document).ready(function() {
$("#report_date_form").on('submit', function(event) {
      event.preventDefault();
get_report_data();
    });
get_report_data();
  function get_report_data(){
    $(".report_loading_div").removeClass('hidden');
    var from = $("#form_date").val();
    var to =$("#to_date").val();
$.get(base_url+'admin/report/report?data=get_report_page_data&from='+from+'&to='+to, function(datas) {
$.each(datas, function(index, val) {
   $("."+index).html(val);
   $(".report_loading_div").addClass('hidden');
});
  },'json');
  }
  });
</script>