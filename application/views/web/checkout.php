<div class="pp-container">
	<div class="pp-row">
		<div class="pp-col zero_padding ps12">
			<div class="pp-col zero_padding ps12 card">
				<div class="pp-col  zero_padding ps12">
					<ul class="tabs primary-light">
						<li class="tab pp-col ps3 "><a class="active tabs_link"  href="#billing_div">Billing Details</a></li>
						<li class="tab pp-col ps3 "><a class="tabs_link" href="#shipping_div">Shipping Details</a></li>
						<li class="tab pp-col ps3 "><a class="tabs_link" href="#payment_method">Payment Method</a></li>
						<li class="tab pp-col ps3 "><a class="tabs_link" href="#order_review">Order Review</a></li>
					</ul>
				</div>
				<div id="billing_div" class="pp-col ps12">
					<div class="pp-col p-padding_15 ps12">
						<div><span class=" font24">Billing Details</span></div>
						<?php if (!empty($customer_address)) {?>
						<div class="pp-margin-tb-7"> <input class="with-gap one action-radio" open-div='exist_address_div' name="billing_option" type="radio" id="my_address"
							<?php echo (!empty($customer_address)) ? "checked" : ""; ?>
							/> <label for="my_address">I want to use an existing address</label></div>
							<div class="one action-div pp-margin-tb-7
								<?php echo (!empty($customer_address)) ? "activated" : ""; ?>
								exist_address_div">
								<div class="pp-col ps12 pm12 pl6">
									<select id="exist_address_opt" class="font-capitalize browser-default">
										<?php if (!empty($customer_address)) {foreach ($customer_address as $key => $value) {?>
										<option value="<?php echo $value->id; ?>"><?php echo $value->name . ', ' . $value->address1 . ', ' . $value->address2 . ', ' . $value->city . '-' . $value->post_code . ', ' . $value->state . ', ' . $value->country; ?></option>
										<?php }}?>
									</select>
								</div>
							</div>
							<?php }?>
							<div class="pp-col pp-margin-tb-7 zero_padding ps12">
								<input id="new_address_for_billing_radio" class="with-gap one action-radio"
								name="billing_option" open-div='new_address_div' type="radio"  />
								<label for="new_address_for_billing_radio">I want to use new address</label>
								<div class="one action-div
									pp-margin-tb-7 new_address_div">
									<form id="billing_new_add_form" class="pp-form">
										<div class="pp-col ps12 pm12 pl10">
											<div class="pp-text-field pp-col ps12 pm6">
												<label>First Name:</label>
												<input type="text" required placeholder="First Name" name="first_name">
											</div>
											<div class="pp-text-field  pp-col ps12 pm6">
												<label>Last Name:</label>
												<input type="text" required placeholder="Last Name" name="last_name">
											</div>
											<div class="pp-text-field  pp-col ps12 pm12">
												<label>Address:</label>
												<input type="text" required placeholder="Address" name="address">
											</div>
											<div class="pp-text-field  pp-col ps12 pm12">
												<label>Address 2:</label>
												<input type="text"  placeholder="Address 2" name="address2">
											</div>
											<div class="pp-text-field  pp-col ps12 pm6">
												<label>City:</label>
												<input type="text" required placeholder="City" name="city">
											</div>
											<div class="pp-text-field  pp-col ps12 pm6">
												<label>Post Code:</label>
												<input type="text" class="only-number" required placeholder="Post Code" name="post_code">
											</div>
											<div class="pp-text-field  pp-col ps12 pm6">
												<label>Mobile no:</label>
												<input type="text" required class="only-number" maxlength="10" placeholder="Mobile no" name="mobile_no">
											</div>
											<div class="pp-text-field pp-col ps12 zero_padding">
												<div class="pp-col ps12 pm6">
													<label>Country</label>
													<select name="country" id="country1_select" class="browser-default ">
													<option disabled>Select</option>
														 <?php foreach ($countrys as $key => $value) {
	$selected = ($value->name == 'India') ? 'selected' : '';

	echo '<option id="' . $value->id . '" ' . $selected . ' value="' . strtolower($value->name) . '" >' . $value->name . '</option>';
}?>
													</select>
												</div>
												<div class="pp-col ps12 pm6">
													<label>State</label>
													<select name="state" id="state1_select" class="browser-default">
														<option value="" disabled selected>Choose your option</option>
													</select>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="pp-col pp-margin-tb-25 ps12">
									<button id="continue1" class="btn primary-light">Continue</button>
								</div>
							</div>
						</div>
					</div>
					<div id="shipping_div" class="pp-col ps12">
						<div class="pp-col p-padding_15 ps12">
							<div><span class=" font24">Shipping Details</span></div>

							<div class="pp-margin-tb-7"> <input class="two with-gap action-radio" open-div='exist_shi_address_div' name="shipping_option" type="radio" id="my_shi_address" checked /> <label for="my_shi_address">I want to use an existing address</label></div>
								<div class="two action-div pp-margin-tb-7 activated
									exist_shi_address_div">
									<div class="pp-col ps12 pm12 pl6">
										<select id="exist_shipping_address_opt" class="font-capitalize browser-default">
											<?php if (!empty($customer_address)) {foreach ($customer_address as $key => $value) {?>
											<option value="<?php echo $value->id; ?>"><?php echo $value->name . ', ' . $value->address1 . ', ' . $value->address2 . ', ' . $value->city . '-' . $value->post_code . ', ' . $value->state . ', ' . $value->country; ?></option>
											<?php }}?>
										</select>
									</div>
								</div>

								<div class="pp-col pp-margin-tb-7 zero_padding ps12">
									<input id="new_address_for_shipping_radio" class="two with-gap action-radio"
									name="shipping_option" open-div='new_shi_address_div' type="radio"  />
									<label for="new_address_for_shipping_radio">I want to use new address</label>
									<div class="two action-div
										pp-margin-tb-7 new_shi_address_div">
										<form id="shipping_new_add_form" class="pp-form">
											<div class="pp-col ps12 pm12 pl10">
												<div class="pp-text-field pp-col ps12 pm6">
													<label>First Name:</label>
													<input type="text" required placeholder="First Name" name="first_name">
												</div>
												<div class="pp-text-field  pp-col ps12 pm6">
													<label>Last Name:</label>
													<input type="text" required placeholder="Last Name" name="last_name">
												</div>
												<div class="pp-text-field  pp-col ps12 pm12">
													<label>Address:</label>
													<input type="text" required placeholder="Address" name="address">
												</div>
												<div class="pp-text-field  pp-col ps12 pm12">
													<label>Address 2:</label>
													<input type="text"  placeholder="Address 2" name="address2">
												</div>
												<div class="pp-text-field  pp-col ps12 pm6">
													<label>City:</label>
													<input type="text" required placeholder="City" name="city">
												</div>
												<div class="pp-text-field  pp-col ps12 pm6">
													<label>Post Code:</label>
													<input type="text" required class="only-number" placeholder="Post Code" name="post_code">
												</div>
												<div class="pp-text-field  pp-col ps12 pm6">
													<label>Mobile no:</label>
													<input type="text" required class="only-number" maxlength="10" placeholder="Mobile no" name="mobile_no">
												</div>
												<div class="pp-text-field pp-col ps12 zero_padding">
													<div class="pp-col ps12 pm6">
														<label>Country</label>
														<select name="country" id="country2_select" class="browser-default">
														<option disabled>Select</option>
															 <?php foreach ($countrys as $key => $value) {
	$selected = ($value->name == 'India') ? 'selected' : '';

	echo '<option id="' . $value->id . '" ' . $selected . ' value="' . strtolower($value->name) . '" >' . $value->name . '</option>';
}?>
														</select>
													</div>
													<div class="pp-col ps12 pm6">
														<label>State</label>
														<select name="state" id="state2_select" class="browser-default">
														<option value="" disabled selected>Choose your option</option>
														</select>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="pp-col pp-margin-tb-25 ps12">
										<button id="continue2" class="btn primary-light">Continue</button>
									</div>
								</div>
							</div>
						</div>
						<div id="payment_method" class="pp-col ps12">
							<div class="pp-col p-padding_15 ps12">
							<div><span class=" font24">Payment Method</span></div>
								<div><span class=" font18 grey-text text-darken-1">Please select the preferred payment method to use on this order.</span></div>
								<form id="payment_option_form" class="pp-form">
								<div class="pp-col pp-margin-tb-7 ps12">
									<input checked id="payment_option_visa" class="with-gap"
									name="payment_option" value="visa_paypal" type="radio"  />
									<label class="payment_option_visa black-text font-500 font14" for="payment_option_visa">Paypal</label>

								</div>

								<div  class="pp-col  pp-margin-tb-7 ps12">
	<input id="payment_option_cc_avenue" class="with-gap"
									name="payment_option" value="cc_avenue_payment" type="radio"  />
									<label class="payment_option_cc_avenue black-text  font-500 font14" for="payment_option_cc_avenue">CC Avenue</label>
								</div>
								<div id="cod_button_div" class="pp-col cod_button_div pp-margin-tb-7 ps12">
	<input id="payment_option_cod" class="with-gap"
									name="payment_option" value="cod_payment" type="radio"  />
									<label class="payment_option_cod black-text  font-500 font14" for="payment_option_cod">Cash on Delivery</label>
								</div>
								<div class="pp-col  pp-margin-tb-7 ps12">
						<div class="pp-col pp-text-field ps12">
							<label>Additional Comments</label>
							<textarea placeholder="Comments" name="additional_comments" rows="5" type="text" class=""></textarea>
						</div>
								</div>
								<div class="pp-col pp-margin-tb-7 ps12">
									 <input type="checkbox"  id="terms_and_condition" />
      <label for="terms_and_condition">I have read and agree to the<a class="hover-text-primary font-500" href="<?php echo site_url('terms_and_conditions'); ?>"> Terms & Conditions </a></label>
      <h6 class="g8mtb0 red-text hidden tearms-condition_error font-karla g8fs12 g8ls4 g8ml30">*Read Terms &amp; Conditions First.</h6>
								</div>
								<div class="pp-col pp-margin-tb-25 ps12">
										<button type="submit" id="continue3" class="btn primary-light">Continue</button>
								</div>
								</form>
							</div>
						</div>
						<div id="order_review" class="pp-col ps12">
							<div class="pp-col order_review_card p-padding_15 ps12">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<style type="text/css" media="screen">
			ul.tabs li{
				/* background-color: rgb(43,187,173); */
			}
			ul.tabs li a{
				color: #fff !important;
			}
			.action-div{
				display: none;
			}
			.action-div.activated{
				display: unset !important;
			}
			.pp-form .pp-text-field{
				margin-top: 10px;
				margin-bottom: 10px;
			}
			.payment_option_visa{
				background-image: url("assetes/img/pp_standard_icon.png");
    background-position: 30px 0;
    background-repeat: no-repeat;
    line-height: 30px;
    color: #000;

    padding-left: 110px !important;
    width: 100%;
			}
			.payment_option_cc_avenue{
			background-image: url("assetes/img/ccavekb_icon.png");
    background-position: 30px 0;
    background-repeat: no-repeat;
    line-height: 30px;
    width: 100%;
    color: #000;
    padding-left: 320px !important;
			}
			.indicator{
				background: rgba(0,0,0,0) !important;
				height: 0px !important;
			}
			.tab.pp-col.ps3{
padding: 0px !important;
			}
			.tabs_link.active{
background: #c1506b none repeat scroll 0 0;
			}
		</style>
		<script>
			jQuery(document).ready(function ($) {
	    $(".one.action-radio").on('click', function (event) {
	        $(".one.action-div").removeClass('activated')
	        var get_class = $(this).attr('open-div');
	        $("." + get_class).addClass('activated');
	        $(this).attr('checked', '')
	    });
	    $(".two.action-radio").on('click', function (event) {
	        $(".two.action-div").removeClass('activated')
	        var get_class = $(this).attr('open-div');
	        $("." + get_class).addClass('activated');
	        $(this).attr('checked', '')
	    });
	    $("#continue1").on('click', function (event) {
	        event.preventDefault();
	        if ($("#new_address_for_billing_radio").is(':checked')) {
	            $("#billing_new_add_form").submit();
	        } else {
	            var selected_address_id = $("#exist_address_opt").val();
	            $.post(base_url + 'api/web_api/', {
	                method: 'set_billing_address_from_exist',
	                address_id: selected_address_id
	            }, function (data, textStatus, xhr) {

	                if (data.result == "true") {
	                    $.post(base_url + 'api/web_api', {
	                        method: 'get_user_addresss'
	                    }, function (data, textStatus, xhr) {
	                        var html = "";
	                        $.each(data, function (index, el) {
	                            html += "<option value='" + el.id + "'>" + el.name + ', ' + el.address1 + ', ' + el.address2 + ', ' + el.city + '-' + el.post_code + ', ' + el.state + ', ' + el.country + "</option>";
	                        });
	                        $("#exist_shipping_address_opt").html(html);
	                        release_tabs();
	                        $('.tabs').tabs('select_tab', 'shipping_div');
	                    }, "json");
	                }
	            }, "json");
	        }
	    });
	    $("#billing_new_add_form").on('submit', function (event) {
	        event.preventDefault();
	        var datas = $(this).serialize();
	        $.post(base_url+'account/dashboard/check_guest_user_data', datas, function(data, textStatus, xhr) {
	        	/*optional stuff to do after success */
	        });
	        $.post(base_url + 'api/web_api/add_new_customer_address', datas, function (data, textStatus, xhr) {

	            if (data.result == true) {
	                $('#billing_new_add_form').find('.pp-error-text').remove();
	                $('#billing_new_add_form').find('.pp-text-field').removeClass('pp-error');
	                $.post(base_url + 'api/web_api', {
	                    method: 'get_user_addresss'
	                }, function (data, textStatus, xhr) {
	                    var html = "";
	                    $.each(data, function (index, el) {
	                        html += "<option value='" + el.id + "'>" + el.name + ', ' + el.address1 + ', ' + el.address2 + ', ' + el.city + '-' + el.post_code + ', ' + el.state + ', ' + el.country + "</option>";
	                    });
	                    $("#exist_shipping_address_opt").html(html);
	                    release_tabs();
	                    $('.tabs').tabs('select_tab', 'shipping_div');
	                }, "json");
	            } else {
	                Materialize.toast('Form Data Not Valid', 4000);
	                $.each(data.errorsdata, function (index, el) {
	                    $("#billing_new_add_form [name='" + index + "']").parent('.pp-text-field').addClass('pp-error');
	                    $("#billing_new_add_form [name='" + index + "']").parent('.pp-text-field').children('span.pp-error-text').remove();
	                    $("#billing_new_add_form [name='" + index + "']").parent('.pp-text-field').append('<span class="pp-error-text ">' + el + '</span>');
	                });
	            }
	        }, 'json');
	    });
	    $("#continue2").on('click', function (event) {
	        event.preventDefault();
	        if ($("#new_address_for_shipping_radio").is(':checked')) {
	            $("#shipping_new_add_form").submit();
	        } else {
	            var selected_address_id = $("#exist_shipping_address_opt").val();
	            $.post(base_url + 'api/web_api/', {
	                method: 'set_shipping_address_from_exist',
	                address_id: selected_address_id
	            }, function (data, textStatus, xhr) {

	                if (data.result == "true") {
	                    release_tabs();
	                    if (data.con != 'india') {
	                    	$("#cod_button_div").remove();
	                    }
	                    $('.tabs').tabs('select_tab', 'payment_method');
	                }
	            }, "json");
	        }
	    });
	    $("#shipping_new_add_form").on('submit', function (event) {
	        event.preventDefault();
	        var datas = $(this).serialize();
	        $.post(base_url + 'api/web_api/add_new_customer_address_for_shipping', datas, function (data, textStatus, xhr) {

	            if (data.result == true) {
	                $('#shipping_new_add_form').find('.pp-error-text').remove();
	                $('#shipping_new_add_form').find('.pp-text-field').removeClass('pp-error');
	                release_tabs();
	                 if (data.con != 'india') {
	                    	$("#cod_button_div").remove();
	                    }
	                $('.tabs').tabs('select_tab', 'payment_method');
	            } else {
	                Materialize.toast('Form Data Not Valid', 4000);
	                $.each(data.errorsdata, function (index, el) {
	                    $("#shipping_new_add_form [name='" + index + "']").parent('.pp-text-field').addClass('pp-error');
	                    $("#shipping_new_add_form [name='" + index + "']").parent('.pp-text-field').children('span.pp-error-text').remove();
	                    $("#shipping_new_add_form [name='" + index + "']").parent('.pp-text-field').append('<span class="pp-error-text ">' + el + '</span>');
	                });
	            }
	        }, 'json');
	    });
	    $("#payment_option_form").on('submit', function (event) {
	        event.preventDefault();
	        var serialize_payment = $(this).serialize();
	        $(".order_review_card").html('');
	        if ($('#terms_and_condition').is(':checked')) {
	        $.post(base_url + 'api/web_api/payment_method_select', serialize_payment, function (data, textStatus, xhr) {

	            if (data.result == 'true') {
	                $.post(base_url + 'api/web_api/order_reivew_checkout', {
	                    datass: 'value1'
	                }, function (data, textStatus, xhr) {

	                    $(".order_review_card").html(data);
	                    $(".price").each(function (index, el) {
	                        var x = $(this).attr('price');
	                        $(this).html("&#8377;" + price_seprate(x));
	                    });
	                });
	                release_tabs();
	                $('.tabs').tabs('select_tab', 'order_review');
	            }
	        }, "json");
	}else{
		$(".tearms-condition_error").removeClass('hidden');
	}
	    });
	    $(".order_review_card").on('click', '.edit_billing_add_button', function (event) {
	        event.preventDefault();
	        release_tabs();
	        $('.tabs').tabs('select_tab', 'billing_div');
	    });
	    $(".order_review_card").on('click', '.edit_shipping_add_button', function (event) {
	        event.preventDefault();
	        release_tabs();
	        $('.tabs').tabs('select_tab', 'shipping_div');
	    });

	    function release_tabs() {
	        $(".tabs_link").each(function (index, el) {
	            $(this).parent('li').removeClass('disabled');
	        });
	    }
	    manage_tabs_activation();

	    function manage_tabs_activation() {
	        switch ($(".tabs_link.active").attr('href')) {
	        case '#billing_div':
	            $("[href='#shipping_div']").parent('li').addClass('disabled');
	            $("[href='#payment_method']").parent('li').addClass('disabled');
	            $("[href='#order_review']").parent('li').addClass('disabled');
	            break;
	        case '#shipping_div':
	            $("[href='#payment_method']").parent('li').addClass('disabled');
	            $("[href='#order_review']").parent('li').addClass('disabled');
	            break;
	        case '#payment_method':
	            $("[href='#order_review']").parent('li').addClass('disabled');
	            break;
	        case '#order_review':
	            break;
	        }
	    }
	    $(".tabs").tabs({
	        onShow: function (tab) {
	            manage_tabs_activation();
	        }
	    });
	    get_state_by_country1();
	    get_state_by_country2();
	    $("#country1_select").on('change', function (event) {
	        event.preventDefault();
	        get_state_by_country1();
	    });

	    function get_state_by_country1() {
	    	$("#state1_select").html("<option disabled>Select</option>");
	        var value = $("#country1_select").val();
	        var id = $("#country1_select option[value='" + value + "']").attr('id');
	        $.post(base_url + '/checkout/state_list', {
	            ids: id
	        }, function (data, textStatus, xhr) {

	            var html = "";
	            $.each(data, function (index, el) {
	                html += "<option value='" + el.name.toLowerCase() + "' id='" + el.id + "'>" + el.name + "</option>";
	            });
	            $("#state1_select").html(html);
	        }, "json");
	    }
	    $("#country2_select").on('change', function (event) {
	        event.preventDefault();
	        get_state_by_country2();
	    });

	    function get_state_by_country2() {
	    	$("#state2_select").html("<option disabled>Select</option>");
	        var value = $("#country2_select").val();
	        var id = $("#country2_select option[value='" + value + "']").attr('id');
	        $.post(base_url + '/checkout/state_list', {
	            ids: id
	        }, function (data, textStatus, xhr) {

	            var html = "";
	            $.each(data, function (index, el) {
	                html += "<option value='" + el.name.toLowerCase() + "' id='" + el.id + "'>" + el.name + "</option>";
	            });
	            $("#state2_select").html(html);
	        }, "json");
	    }
	});
		</script>