</div>
</div>
</div>
<style>
.account-dashbord-nav li{
padding: 10px 15px;
border-bottom: 1px solid #ccc;
 align-items: center;
    display: flex;
    transition: all .40s;
}
.account-dashbord-nav li:hover{
background-color:#eee;
    color: rgb(0,150,136);
}
.account-dashbord-nav li i{
margin-right: 10px;
}
</style>
<script>
$(document).ready(function() {
   get_cart_data_from_db();
function get_cart_data_from_db(){
   $.post(base_url+'api/cart_api', {method: 'get_cart_data_from_db_ci'}, function(data, textStatus, xhr) {
      console.log(data);

  //     $.each(data,function(index, el) {
  //        add_to_cart_data(el.id,el.product_id,el.required_stock);
		// if(el.single_data != null && el.single_data != ""){
  //        add_data_to_single_session(el.product_id,el.single_data);
  //        }
  //     });
   },"json");
}

function add_to_cart_data(cart_id,product_idds,stock){
   $.post(base_url+'api/cart_api',{ method:'add_to_cart',for_refresh:'for_refresh',require_stock:stock,cart_id:cart_id,product_id:product_idds}, function(data, textStatus, xhr) {
   },'json');
}

function add_data_to_single_session(product_id,single_session_data){
$.post(base_url+'api/cart_api',{ method:'add_data_to_single_session',produc_id:product_id,single_data:single_session_data}, function(data, textStatus, xhr) {
	console.log(data);
   });
}
});
</script>