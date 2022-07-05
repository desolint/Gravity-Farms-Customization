<?php 
add_action( 'wp_footer', 'lenses_order_creat' );
function lenses_order_creat()
{
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			function loadtableleft() {
				if ($('#input_11_25 option').length <= 1) {
					$("#field_11_25").hide()
				}else if($('#input_11_25 option').length > 1){
					$("#field_11_25").show()
				}
				if ($('#input_11_26 option').length <= 1) {
					$("#field_11_26").hide()
				}else if($('#input_11_26 option').length > 1){
					$("#field_11_26").show()
				}	
				if ($('#input_11_28 option').length <= 1) {
					$("#field_11_28").hide()
				}else if($('#input_11_28 option').length > 1){
					$("#field_11_28").show()
				}
				if ($('#input_11_29 option').length <= 1) {
					$("#field_11_29").hide()
				}else if($('#input_11_29 option').length > 1){
					$("#field_11_29").show()
				}
				if ($('#input_11_30 option').length <= 1) {
					$("#field_11_30").hide()
				}else if($('#input_11_30 option').length > 1){
					$("#field_11_30").show()
				}
			}
			function loadtableright(){
				if ($('#input_11_38 option').length <= 1) {
					$("#field_11_38").hide()
				}else if($('#input_11_25 option').length > 1){
					$("#field_11_38").show()
				}
				if ($('#input_11_39 option').length <= 1) {
					$("#field_11_39").hide()
				}else if($('#input_11_39 option').length > 1){
					$("#field_11_39").show()
				}	
				if ($('#input_11_40 option').length <= 1) {
					$("#field_11_40").hide()
				}else if($('#input_11_40 option').length > 1){
					$("#field_11_40").show()
				}
				if ($('#input_11_41 option').length <= 1) {
					$("#field_11_41").hide()
				}else if($('#input_11_41 option').length > 1){
					$("#field_11_41").show()
				}
				if ($('#input_11_42 option').length <= 1) {
					$("#field_11_42").hide()
				}else if($('#input_11_42 option').length > 1){
					$("#field_11_42").show()
				}
			}
			$("#autocomplete").on("input", function(e){
				e.preventDefault();
				var itemnumber = this.value;
				if (itemnumber.length > 1 && itemnumber.length < 5) {
					jQuery.ajax( {
						url: '<?php echo admin_url('admin-ajax.php'); ?>',
						type: 'POST', 
						dataType:"json",
						data: { action: 'lenses_item_fetch', itemnumber:itemnumber},
						success: function(data) {
							$.each(data, function(index, val) {
								$("#input_11_20").val(val.vendor).change();
								setTimeout(function(){
									$("#input_11_21").val(val.product).change();
								},1500);
							});	
						}
					});
				}
			});
			$("#autocomplete1").on("input", function(e){
				e.preventDefault();
				var itemnumber = this.value;
				if (itemnumber.length > 1 && itemnumber.length < 5) {
					jQuery.ajax( {
						url: '<?php echo admin_url('admin-ajax.php'); ?>',
						type: 'POST', 
						dataType:"json",
						data: { action: 'lenses_item_fetch', itemnumber:itemnumber},
						success: function(data) {
					$.each(data, function(index, val) {
						$("#input_11_36").val(val.vendor).change();
						setTimeout(function(){
							$("#input_11_37").val(val.product).change();
						},1500);
					});	
				}
			});
				}
			});
			/*Product load acording to vender name */
			$('#input_11_20').change(function(e) {
				e.preventDefault();
				var vendorname = this.value;
				jQuery.ajax( {
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'POST', 
					dataType:"json",
					data: { action: 'lenses_product_fetch', vendorname:vendorname},
					success: function(data) {
						$("#input_11_21").html(`<option value="">Select Product</option>`);
						$.each(data, function(index, val) {
							$("#input_11_21").append(`<option value="${val.product}">${val.product}</option>`);
						});		
					}
				});
			});	
		/*
			loaded vendor append in right eye section
			*/
			$('#input_11_36').change(function(e) {
				e.preventDefault();
				var vendorname = this.value;
				jQuery.ajax( {
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'POST', 
					dataType:"json",
					data: { action: 'lenses_product_fetch', vendorname:vendorname},
					success: function(data) {
						$("#input_11_37").html(`<option value="">Select Product</option>`);
						$.each(data, function(index, val) {
							$("#input_11_37").append(`<option value="${val.product}">${val.product}</option>`);
						});		
					}
				});
			});
			/*
			load all attributs according to product left eye section
			*/
			$('#input_11_21').change(function(e) {
				e.preventDefault();
				var productname = this.value;
				jQuery.ajax( {
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'POST', 
					dataType:"json",
					data: { action: 'lenses_corve_fetch', productname:productname},
					success: function(response) {
						$.each(response, function(a, data) {
							$("#input_11_22").html(`<option value="">Select Base Curve</option>`);
							$.each(data[0], function(b, curve) {
								$("#input_11_22").append(`<option value="${curve.base_curve}">${curve.base_curve}</option>`);
							});
							$("#input_11_23").html(`<option value="">Select Diameter</option>`);
							$.each(data[1], function(c, diameter) {
								$("#input_11_23").append(`<option value="${diameter.diameter}">${diameter.diameter}</option>`);
							});
							$("#input_11_24").html(`<option value="">Select Power</option>`);
							$.each(data[2], function(d, power) {
								$("#input_11_24").append(`<option value="${power.power}">${power.power}</option>`);
							});
							$("#input_11_25").html(`<option value="">Select Cylinder</option>`);
							$.each(data[3], function(e, cylinder) {
								$("#input_11_25").append(`<option value="${cylinder.cylinder}">${cylinder.cylinder}</option>`);
							});
							$("#input_11_26").html(`<option value="">Select Axis</option>`);
							$.each(data[4], function(f, axis) {
								$("#input_11_26").append(`<option value="${axis.axis}">${axis.axis}</option>`);
							});	
							$("#input_11_28").html(`<option value="">Select Color</option>`);
							$.each(data[5], function(g, color) {
								$("#input_11_28").append(`<option value="${color.color}">${color.color}</option>`);
							});
							$("#input_11_29").html(`<option value="">Select Add On</option>`);
							$.each(data[6], function(h, addon) {
								$("#input_11_29").append(`<option value="${add_on.addon}">${add_on.addon}</option>`);
							});	
							$("#input_11_30").html(`<option value="">Select Distant Or Near</option>`);
							$.each(data[7], function(h, distantnear) {
								$("#input_11_30").append(`<option value="${distantnear.distant_near}">${distantnear.distant_near}</option>`);
							});
							$("#input_11_56").html(`<option value="">$0.00</option>`);
							$.each(data[8], function(i, price) {
								var valueselectedl = "left_eye_price|" + price.price;
								$("#input_11_56").append(`<option value="${valueselectedl}">${price.price}</option>`);
								$('select[name=input_56]').val(valueselectedl).change();
								$('#leftprice').text(price.price)
							});
						});
						loadtableleft();
					},
				});
			});	
			/*
			load all attributs according to product right eye section
			*/
			$('#input_11_37').change(function(e) {
				e.preventDefault();
				var productname = this.value;
				jQuery.ajax( {
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'POST', 
					dataType:"json",
					data: { action: 'lenses_corve_fetch', productname:productname},
					success: function(response) {
						$.each(response, function(a, data) {
							$("#input_11_33").html(`<option value="">Select Base Curve</option>`);
							$.each(data[0], function(b, curve) {
								$("#input_11_33").append(`<option value="${curve.base_curve}">${curve.base_curve}</option>`);
							});
							$("#input_11_34").html(`<option value="">Select Diameter</option>`);
							$.each(data[1], function(c, diameter) {
								$("#input_11_34").append(`<option value="${diameter.diameter}">${diameter.diameter}</option>`);
							});
							$("#input_11_35").html(`<option value="">Select Power</option>`);
							$.each(data[2], function(d, power) {
								$("#input_11_35").append(`<option value="${power.power}">${power.power}</option>`);
							});
							$("#input_11_38").html(`<option value="">Select Cylinder</option>`);
							$.each(data[3], function(e, cylinder) {
								$("#input_11_38").append(`<option value="${cylinder.cylinder}">${cylinder.cylinder}</option>`);
							});
							$("#input_11_39").html(`<option value="">Select Axis</option>`);
							$.each(data[4], function(f, axis) {
								$("#input_11_39").append(`<option value="${axis.axis}">${axis.axis}</option>`);
							});	
							$("#input_11_40").html(`<option value="">Select Color</option>`);
							$.each(data[5], function(g, color) {
								$("#input_11_40").append(`<option value="${color.color}">${color.color}</option>`);
							});
							$("#input_11_41").html(`<option value="">Select Add On</option>`);
							$.each(data[6], function(h, addon) {
								$("#input_11_41").append(`<option value="${add_on.addon}">${add_on.addon}</option>`);
							});
							$("#input_11_42").html(`<option value="">Select Distant Or Near</option>`);
							$.each(data[7], function(h, distantnear) {
								$("#input_11_42").append(`<option value="${distantnear.distant_near}">${distantnear.distant_near}</option>`);
							});
							$("#input_11_62").html(`<option value="">$0.00</option>`);
							$.each(data[8], function(i, price) {
								var valueselectedl = "left_eye_price|" + price.price;
								$("#input_11_62").append(`<option value="${valueselectedl}">${price.price}</option>`);
								$('select[name=input_62]').val(valueselectedl).change();
							});
						});
						loadtableright();
					},
				});
			});
			$("input[name='input_64']").click(function(){
				var radioValue = $("input[name='input_64']:checked").val();
				if(radioValue == 'left')
				{
					loadtableleft();
					var selectedvanderhtml = $("#input_11_20").html()
					var selectedvanderval = $("#input_11_20").val()
					var selectedproducthtml = $("#input_11_21").html()
					var selectedproductval = $("#input_11_21").val()
					var selectedcurvehtml = $("#input_11_22").html()
					var selectedcurveval = $("#input_11_22").val()
					var selecteddiameterhtml = $("#input_11_23").html()
					var selecteddiameterval = $("#input_11_23").val()
					var selectedpowerhtml = $("#input_11_24").html()
					var selectedpowerval = $("#input_11_24").val()
					var selectedcylinderhtml = $("#input_11_25").html()
					var selectedcylinderval = $("#input_11_25").val()
					var selectedAxishtml = $("#input_11_26").html()
					var selectedAxisval = $("#input_11_26").val()
					var selectedColorhtml = $("#input_11_28").html()
					var selectedColorval = $("#input_11_28").val()
					var selectedaddonhtml = $("#input_11_29").html()
					var selectedadonval = $("#input_11_29").val()
					var selecteddistantnearhtml = $("#input_11_30").html()
					var selecteddistantnearval = $("#input_11_30").val()
					var  hidden_patient =  $("#input_11_46").val();	
        				if(hidden_patient == ''){
        				    var	patient = $("#input_11_44").val();	
        				}else{
        				    var  patient = $("#input_11_46").val();	
        				}
					var selectedpricehtml = $("#input_11_56").html()
					var selectedpriceval = $("#input_11_56").val()
					var selectedquntityeval = $("#input_11_58").val()
					$("#input_11_36").html(selectedvanderhtml)
					$("#input_11_36").val(selectedvanderval)
					$("#input_11_37").html(selectedproducthtml)
					$("#input_11_37").val(selectedproductval).change();
					setTimeout(function(){
						$("#input_11_33").html(selectedcurvehtml)
						$("#input_11_33").val(selectedcurveval)
						$("#input_11_34").html(selecteddiameterhtml)
						$("#input_11_34").val(selecteddiameterval)
						$("#input_11_35").html(selectedpowerhtml)
						$("#input_11_35").val(selectedpowerval)
						$("#input_11_38").html(selectedcylinderhtml)
						$("#input_11_38").val(selectedcylinderval)
						$("#input_11_39").html(selectedAxishtml)
						$("#input_11_39").val(selectedAxisval)
						$("#input_11_40").html(selectedColorhtml)
						$("#input_11_40").val(selectedColorval)
						$("#input_11_41").html(selectedaddonhtml)
						$("#input_11_41").val(selectedadonval)
						$("#input_11_42").html(selecteddistantnearhtml)
						$("#input_11_42").val(selecteddistantnearval)
						$("#field_11_45 .bootstrap-tagsinput .label-info").remove();
					    $("#input_11_45,#input_11_53,#field_11_45 .bootstrap-tagsinput input").val(patient);
						$("#input_11_62").html(selectedpricehtml)
						$("#input_11_62").val(selectedpriceval).change()
						$("#input_11_63").val(selectedquntityeval)
					},1700);
				}else if(radioValue == 'right'){
					loadtableright();
					var selectedvanderhtml = $("#input_11_36").html()
					var selectedvanderval = $("#input_11_36").val()
					var selectedproducthtml = $("#input_11_37").html()
					var selectedproductval = $("#input_11_37").val()
					var selectedcurvehtml = $("#input_11_33").html()
					var selectedcurveval = $("#input_11_33").val()
					var selecteddiameterhtml = $("#input_11_34").html()
					var selecteddiameterval = $("#input_11_34").val()
					var selectedpowerhtml = $("#input_11_35").html()
					var selectedpowerval = $("#input_11_35").val()
					var selectedcylinderhtml = $("#input_11_38").html()
					var selectedcylinderval = $("#input_11_38").val()
					var selectedAxishtml = $("#input_11_39").html()
					var selectedAxisval = $("#input_11_39").val()
					var selectedColorhtml = $("#input_11_40").html()
					var selectedColorval = $("#input_11_40").val()
					var selectedaddonhtml = $("#input_11_41").html()
					var selectedadonval = $("#input_11_41").val()
					var selecteddistantnearhtml = $("#input_11_42").html()
					var selecteddistantnearval = $("#input_11_42").val()
					var hidden_patient =  $("#input_11_53").val();	
			        if(hidden_patient == ''){
					  var patient = $("#input_11_45").val();	
				    }else{
					    var patient = $("#input_11_53").val();	
				    }
					var selectedPatientval = $("#input_11_45").val()
					var selectedpricehtml = $("#input_11_62").html()
					var selectedpriceval = $("#input_11_62").val()
					var selectedquntityeval = $("#input_11_63").val()
					$("#input_11_20").html(selectedvanderhtml)
					$("#input_11_20").val(selectedvanderval)
					$("#input_11_21").html(selectedproducthtml)
					$("#input_11_21").val(selectedproductval).change();
					setTimeout(function(){
						$("#input_11_22").html(selectedcurvehtml)
						$("#input_11_22").val(selectedcurveval)
						$("#input_11_23").html(selecteddiameterhtml)
						$("#input_11_23").val(selecteddiameterval)
						$("#input_11_24").html(selectedpowerhtml)
						$("#input_11_24").val(selectedpowerval)
						$("#input_11_25").html(selectedcylinderhtml)
						$("#input_11_25").val(selectedcylinderval)
						$("#input_11_26").html(selectedAxishtml)
						$("#input_11_26").val(selectedAxisval)
						$("#input_11_28").html(selectedColorhtml)
						$("#input_11_28").val(selectedColorval)
						$("#input_11_29").html(selectedaddonhtml)
						$("#input_11_29").val(selectedadonval)
						$("#input_11_30").html(selecteddistantnearhtml)
						$("#input_11_30").val(selecteddistantnearval)
						$("#field_11_44 .bootstrap-tagsinput .label-info").remove();
					$("#input_11_44,#input_11_46,#field_11_44 .bootstrap-tagsinput input").val(patient);
						$("#input_11_56").html(selectedpricehtml)
						$("#input_11_56").val(selectedpriceval).change()
						$("#input_11_58").val(selectedquntityeval)
					},1700)
				}
			});
$(".carteditor").click(function(e) {
	e.preventDefault();
	/* Act on the event */
	var orderkey = 	$(this).data('id')
	window.location = '<?php echo get_site_url(); ?>/product/soft-contact-lens/?key=' + orderkey;
});
function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
	});
	return vars;
}
var key = getUrlVars()["key"];
var wc_gforms_cart_item_key = getUrlVars()["wc_gforms_cart_item_key"];
if (key != undefined && key != null) {
	$(document).on('click', '#gform_update_button_11', function(e) {
		e.preventDefault();
		jQuery.ajax( {
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'POST', 
            dataType:"json",
			data: { action: 'lense_cart_item_remove', remove_item:key},
			success: function(data) {
				if (data == 0) {
					$("#gform_submit_button_11").click();
				}	
			}
		});
	});
	$("#gform_submit_button_11").hide().after(`<button type="submit" name="add-to-cart" value="206" id='gform_update_button_11' class='single_add_to_cart_button button alt gform_button'>Update</button>`);
	jQuery.ajax( {
		url: '<?php echo admin_url('admin-ajax.php'); ?>',
		type: 'POST', 
        dataType:"json",
		data: { action: 'lenses_cart_edit', orderkey:key},
		success: function(editresponse) {
			$(`#input_11_20`).val(editresponse[20]).change();
			$(`#input_11_36`).val(editresponse[36]).change();
			setTimeout(function(){
				$(`#input_11_21`).val(editresponse[21]).change();
				$(`#input_11_37`).val(editresponse[37]).change();
				setTimeout(function(){
					$(`#input_11_22`).val(editresponse[22])
					$(`#input_11_23`).val(editresponse[23])
					$(`#input_11_24`).val(editresponse[24])
					$(`#input_11_25`).val(editresponse[25])
					$(`#input_11_26`).val(editresponse[26])
					$(`#input_11_28`).val(editresponse[28])
					$(`#input_11_29`).val(editresponse[29])
					$(`#input_11_30`).val(editresponse[30])
					$(`#input_11_44`).val(editresponse[44])
					$("#input_7_56").val(editresponse[56]).change();
					$("#input_7_58").val(editresponse[58])
					$(`#input_11_33`).val(editresponse[33])
					$(`#input_11_34`).val(editresponse[34])
					$(`#input_11_35`).val(editresponse[35])
					$(`#input_11_38`).val(editresponse[38])
					$(`#input_11_39`).val(editresponse[39])
					$(`#input_11_40`).val(editresponse[40])
					$(`#input_11_41`).val(editresponse[41])
					$(`#input_11_42`).val(editresponse[42])
					$("#input_11_44, #field_11_44 .bootstrap-tagsinput input").val(editresponse[44]);
					$("#input_11_44, #field_11_44 .bootstrap-tagsinput input").blur();
					$("#input_11_45, #field_11_45 .bootstrap-tagsinput input").val(editresponse[45]);
					$("#input_11_45, #field_11_45 .bootstrap-tagsinput input").blur();

					$("#input_7_62").val(editresponse[62]).change();
					$("#input_7_63").val(editresponse[63])
				},1700);
			},2000);
		},
	});
}else if(wc_gforms_cart_item_key != undefined && wc_gforms_cart_item_key != null){
	$("#gform_submit_button_2").hide().after(`<button type="submit" name="add-to-cart" id='gform_update_button_2' class='single_add_to_cart_button button alt gform_button'>Update</button>`);
	jQuery.ajax( {
		url: '<?php echo admin_url('admin-ajax.php'); ?>',
		type: 'POST', 
dataType:"json",
		data: { action: 'lenses_cart_edit', orderkey:wc_gforms_cart_item_key},
		success: function(editresponse) {
			$(`#input_11_20`).val(editresponse[20]).change();
			$(`#input_11_36`).val(editresponse[36]).change();
			setTimeout(function(){
				$(`#input_11_21`).val(editresponse[21]).change();
				$(`#input_11_37`).val(editresponse[37]).change();
				setTimeout(function(){
					$(`#input_11_22`).val(editresponse[22])
					$(`#input_11_23`).val(editresponse[23])
					$(`#input_11_24`).val(editresponse[24])
					$(`#input_11_25`).val(editresponse[25])
					$(`#input_11_26`).val(editresponse[26])
					$(`#input_11_28`).val(editresponse[28])
					$(`#input_11_29`).val(editresponse[29])
					$(`#input_11_30`).val(editresponse[30])
					$(`#input_11_44`).val(editresponse[44])
					$("#input_7_56").val(editresponse[56]).change();
					$("#input_7_58").val(editresponse[58])
					$(`#input_11_33`).val(editresponse[33])
					$(`#input_11_34`).val(editresponse[34])
					$(`#input_11_35`).val(editresponse[35])
					$(`#input_11_38`).val(editresponse[38])
					$(`#input_11_39`).val(editresponse[39])
					$(`#input_11_40`).val(editresponse[40])
					$(`#input_11_41`).val(editresponse[41])
					$(`#input_11_42`).val(editresponse[42])
					//$(`#input_11_45`).val(editresponse[45])
					$(`#input_11_42`).val(editresponse[42])
					$("#input_11_44, #field_11_44 .bootstrap-tagsinput input").val(editresponse[44]);
					$("#input_11_44, #field_11_44 .bootstrap-tagsinput input").blur();
					$("#input_11_45, #field_11_45 .bootstrap-tagsinput input").val(editresponse[45]);
					$("#input_11_45, #field_11_45 .bootstrap-tagsinput input").blur();
					$("#input_7_62").val(editresponse[62]).change();
					$("#input_7_63").val(editresponse[63])
				},1700);
			},2000);
		},
	});
}
});
</script>
<?php
}
add_action('wp_ajax_lenses_product_fetch' , 'lenses_product_data');
add_action('wp_ajax_nopriv_lenses_product_fetch','lenses_product_data');
function lenses_product_data() 
{
	$vendorname = $_REQUEST['vendorname'];
	global $wpdb;
	$prefix = $wpdb->prefix;
	$results = $wpdb->get_results(
		'SELECT product FROM soft_lenses WHERE vendor = "'.$vendorname.'" GROUP BY product'
	);
	wp_send_json($results);
}

add_action('wp_ajax_lenses_corve_fetch' , 'lenses_corve_data');
add_action('wp_ajax_nopriv_lenses_corve_fetch','lenses_corve_data');
function lenses_corve_data() 
{
	$alldata = array();
	$productname = $_REQUEST['productname'];
	global $wpdb;
	$prefix = $wpdb->prefix;
	$curve = $wpdb->get_results(
		'SELECT base_curve FROM soft_lenses WHERE product = "'.$productname.'" and trim(base_curve) != "" GROUP BY base_curve'
	);
	$diameter = $wpdb->get_results(
		'SELECT diameter FROM soft_lenses WHERE product = "'.$productname.'" GROUP BY diameter'
	);
	$power = $wpdb->get_results(
		'SELECT power FROM soft_lenses WHERE product = "'.$productname.'"  and trim(power) != "" GROUP BY power'
	);
	$cylinder = $wpdb->get_results(
		'SELECT cylinder FROM soft_lenses WHERE product = "'.$productname.'"  and trim(cylinder) != "" GROUP BY cylinder'
	);
	$axis = $wpdb->get_results(
		'SELECT axis FROM soft_lenses WHERE product = "'.$productname.'"  and trim(axis) != "" GROUP BY axis'
	);
	$color = $wpdb->get_results(
		'SELECT color FROM soft_lenses WHERE product = "'.$productname.'"  and trim(color) != "" GROUP BY color'
	);
	$distant_near = $wpdb->get_results(
		'SELECT distant_near FROM soft_lenses WHERE product = "'.$productname.'"  and trim(distant_near) != "" GROUP BY distant_near'
	);
	$add_on = $wpdb->get_results(
		'SELECT add_on FROM soft_lenses WHERE product = "'.$productname.'"  and trim(add_on) != "" GROUP BY add_on'
	);
	$price = $wpdb->get_results(
		'SELECT price FROM soft_lenses WHERE product = "'.$productname.'" GROUP BY price'
	);
	$alldata[] = [$curve, $diameter, $power, $cylinder, $axis, $color, $add_on, $distant_near, $price];
	wp_send_json($alldata);
}
add_action('wp_ajax_lenses_cart_edit' , 'lense_cart_edit');
add_action('wp_ajax_nopriv_lenses_cart_edit','lense_cart_edit');

function lense_cart_edit()
{
	$orderkey = $_POST["orderkey"];
	$products = WC()->cart->get_cart_item($orderkey);
	$edit_data = $products["_gravity_form_lead"];
	wp_send_json($edit_data);
}
add_action('wp_ajax_lense_cart_item_remove' , 'lense_cart_item_remove');
add_action('wp_ajax_nopriv_lense_cart_item_remove','lense_cart_item_remove');
function lense_cart_item_remove()
{
	$cart_item_key = $_REQUEST['remove_item'];
	if ( $cart_item_key ) {
		$delete =  WC()->cart->remove_cart_item( $cart_item_key );
		wp_send_json($delete);
	}
}
add_action('wp_ajax_lenses_item_fetch' , 'lenses_item_fetch');
add_action('wp_ajax_nopriv_lenses_item_fetch','lenses_item_fetch');
function lenses_item_fetch()
{
	$itemnumber = $_REQUEST['itemnumber'];
	global $wpdb;
	$prefix = $wpdb->prefix;
	$results = $wpdb->get_results(
		'SELECT product , vendor FROM soft_lenses WHERE item_no = "'.$itemnumber.'"'
	);
	wp_send_json($results);
}
// Script to move all Head scripts to the Footer
/*function remove_head_scripts() {
	remove_action('wp_head', 'wp_print_scripts');
	remove_action('wp_head', 'wp_print_head_scripts', 9);
	remove_action('wp_head', 'wp_enqueue_scripts', 1);
	add_action('wp_footer', 'wp_print_scripts', 5);
	add_action('wp_footer', 'wp_enqueue_scripts', 5);
	add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('wp_enqueue_scripts', 'remove_head_scripts');
//Remove JQuery migrate
function remove_jquery_migrate($scripts) {
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$script = $scripts->registered['jquery'];
		if ($script->deps) {
// Check whether the script has any dependencies
			$script->deps = array_diff($script->deps, array('jquery-migrate'));
		}
	}
}
add_action('wp_default_scripts', 'remove_jquery_migrate');*/
?>