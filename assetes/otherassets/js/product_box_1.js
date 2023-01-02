
$('.materialboxed').materialbox();

$(".product-card").hover(function() {
    var card_product_id = $(this).attr("card-id");

    $(".quick_button_btn_" + card_product_id).removeClass('fadeOut');
    $(".quick_button_btn_" + card_product_id).addClass('fadeIn');
}, function() {
    var card_product_id = $(this).attr("card-id");

    $(".quick_button_btn_" + card_product_id).removeClass('fadeIn');
    $(".quick_button_btn_" + card_product_id).addClass('fadeOut');
});
/// Price Seprate
$(".price").each(function(index, el) {
    var x = $(this).attr('price');
    $(this).html("&#8377;" + price_seprate(x));
});

///// For admin panel ///////////

$(".quick_view_btn_table").on('click', '.quick_button_btn', function(event) {
    event.preventDefault();

    $(".dialog-progress").css('display', 'block');
    $(".quick_view_model_row").css('opacity', '0');
    var prod_id = $(this).attr('prod-id');
    $.post(base_url + 'api', {
        method: 'singleproduct',
        product_id: prod_id
    }, function(data, textStatus, xhr) {
        // alert(data[0].product_id);
        console.log(data);
        $(".quick_product_model  .prod-img").attr('src', "");
        append_data(data);

    }, "json");
    $('#quick_product_model').openModal();
});

///// End Admin Panel ////////
$(".product_card_container, .product_slider_1_main_div").on('click', '.quick_button_btn', function(event) {
    event.preventDefault();
$("#materialbox-overlay").click();
    $(".materialboxed.prod-img.initialized.active").click();
    $(".dialog-progress").css('display', 'block');
    // $("#quick_product_model").addClass('transparent z-depth-0');
    $(".quick_view_model_row").css('opacity', '0');
    $(".quick_product_model .modal-content").addClass('opacity0');
    var prod_id = $(this).attr('prod-id');
    $.post(base_url + 'api', {
        method: 'singleproduct',
        product_id: prod_id
    }, function(data, textStatus, xhr) {
        // alert(data[0].product_id);
        console.log(data);
        $(".quick_product_model  .prod-img").attr('src', "");
        append_data(data);

    }, "json");
    $('#quick_product_model').openModal();
});

function append_data(data) {

    $(".quick_product_model  .prod-img").attr('src', base_url + 'uploads/pro_image/900_1200/' + data[0].pro_img);


    $(".quick_product_model .prod-name").text(data[0].product_name);
    if (data[0].mrp != null && data[0].mrp != "" && data[0].mrp != '0' && data[0].mrp != 0) {
        $(".quick_product_model .prod-mrp").css('display', '');
        $(".quick_product_model .prod-mrp").html(data[0].mrp);
    }else{
        $(".quick_product_model .prod-mrp").css('display', 'none');
    }
    $(".quick_product_model .prod-price").html(data[0].sell_price);
    $(".quick_product_model .prod-sku").text(data[0].product_sku);
    $(".quick_product_model .prod-desc").text(data[0].product_desc);
    $(".quick_product_model .prod-shiptime").text(data[0].ship_time);
    $(".quick_product_model .prod-addtocart").attr('prod-id', data[0].product_id);
    var prod_det = data[0].product_details;

    var prod_det_html = "";
    $.each(prod_det, function(index, el) {

        if(el.value !== "" && el.value !== undefined){
        if ($.isArray(el)) {
            prod_det_html += "<tr><td>" + el.key + "</td><td>: ";
            $.each(el.value, function(indexs, els) {
                if(els !== ""){
                prod_det_html += els + ", ";
                }
            });
            prod_det_html += "</td></tr>";
        } else {

            prod_det_html += "<tr><td><b>" + el.key + "</b></td><td>: " + el.value + "</td></tr>";

        }
        }
    });
    $(".quick_product_model .prod-details").html(prod_det_html);
    $(".quick_product_model .modal-content").removeClass('opacity0');
    $(".dialog-progress").css('display', 'none');
    $("#quick_product_model").removeClass('transparent z-depth-0');
    $(".quick_view_model_row").addClass('fadeIn');
}

function price_seprate(price) {
    var x = price;
    if (x != null) {
        x = x.toString();
        var lastThree = x.substring(x.length - 3);
        var otherNumbers = x.substring(0, x.length - 3);
        if (otherNumbers != '')
            lastThree = ',' + lastThree;
        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        return res;
    }

   //============ ADD To Cart Button Implement ===============//



   //============ End ADD To Cart Button Implement ===============//
}
