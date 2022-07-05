<?php
/**
Create Short Code For QR Code Sale Quantity Show
**/
function partner_sales_perches_avg_shortcode( ) {
	if (is_user_logged_in()):
	$id = get_current_user_id();
	 ?>
<div class="container">
	<div class="responsive-table">
		<div class="responsive-table-wrapper">
		    <div class="et_pb_module et_pb_text et_pb_text_0  et_pb_text_align_left et_pb_bg_layout_light">
				<div class="et_pb_text_inner"><h2 style="text-align: center;">QR CODES &amp; SALES</h2></div>
			</div>
			<table id="saleReport">
				<thead>
					<tr>
						<th>Entry Position</th>
						<th>Code Number</th>
						<th>Purchase # With Code</th>
					</tr>
				</thead>
		<tbody>
<?php
	$options = array();
	if ( have_rows( 'location_code', 'user_'.$id ) ) :
	while ( have_rows( 'location_code', 'user_'.$id ) ) : the_row();
		$search_criteria_request = get_sub_field( 'location_qr_code' );
		$search_criteria = array(
					'status'        => 'active',
					'field_filters' => array(
				array(
					'key'   => '9',
					'value' => $search_criteria_request
				),
			)
		);
		$paging  = array( 'offset' => 0, 'page_size' => 200 );
		$itemss = GFAPI::get_entries( 2, $search_criteria, null, $paging);
		$options[] = get_sub_field( 'location_qr_code' );
 ?>
		 <tr>
		 	<td></td>
		 	<td><?php the_sub_field( 'location_qr_code' ); ?></td>
		 	<td><?=($itemss)? count($itemss) : "0"?></td>
		 </tr>
		<?php 
		endwhile;
		endif;
		?>
			<datalist id="qrcodesorting"><!-- Create Data list for Data Table Drop Down -->
				<?php
				foreach ($options as $key => $value) {
					echo  "<option value='".$value."'>".$value."</option>";
				}
				 ?>
            </datalist>
		</tbody>
		</table>
</div><!--/responsive-table-wrapper-->
<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
</div><!--/responsive-table-->
</div><!--/container-->
<?php
endif;
}
/**
Create Short Code For lead Details Table
**/
 add_shortcode( 'total_sales_avg', 'partner_sales_perches_avg_shortcode' );
function partner_sales( ) {
if (is_user_logged_in()):
$id = get_current_user_id();
$search_criteria_request = array();
if ( have_rows( 'location_code', 'user_'.$id ) ) : 
	while ( have_rows( 'location_code', 'user_'.$id ) ) : the_row();
		$search_criteria_request[] = get_sub_field( 'location_qr_code' );
	endwhile;
endif;

	$search_criteria = array(
			'status'        => 'active',
			'field_filters' => array(
				array(
					'key'   => '9',
					'operator' => 'in',
					'value' => $search_criteria_request
				),
			)
		);
		$paging  = array( 'offset' => 0, 'page_size' => 200 );
		$itemss = GFAPI::get_entries( 2, $search_criteria, null, $paging);
	$items = "";
    $no_of_certificates = count($itemss);
    $items .= 
    '<h4>Total Number Purchased:<span style="font-size:40px; padding-left:10px;font-weight:bold;">'. $no_of_certificates.'</span></h4>
    <table id="detailpage">
          <thead>
            <th>Purchase Code</th>
            <th>Which Site</th>
            <th>Customer Name</th>
            <th>Printed Name</th>
            <th>Printed Date</th>
            <th>Language</th>
            <th>Date Purchased</th>
            <th>Time Purchased</th>
          </thead>
        <tbody>
    ';
    foreach($itemss as $result){
       $created_date =  $result['date_created'];
       $fdate = date("d F, Y", strtotime($created_date));
	// create a $dt object with the UTC timezone
	$dt = new DateTime($created_date, new DateTimeZone('UTC'));
	// change the timezone of the object without changing its time
	$dt->setTimezone(new DateTimeZone('America/Denver'));
	// format the datetime
	$ftime = $dt->format("h:i:s A");
 $items .= '<tr><td>'.$result[9].'</td><td>'.$result[40].'</td><td>'.$result['1.3'].' '. $result['1.6'].'</td><td>'.$result[4].'</td><td>'.$result[6].'</td><td>'.$result['11'].'</td><td>'.$fdate.'</td><td>'.$ftime.'</td></tr>';
      } 
     $items .= '</tbody></table>';  
    return $items;
   endif;
}
add_shortcode( 'total_sales', 'partner_sales' );

add_action('wp_footer', 'javascript_embed_in_footer');
function javascript_embed_in_footer()
{
 ?>
 <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
 <script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript">
 jQuery(document).ready(function($) {
 	jQuery('#saleReport').DataTable({
 	    "pageLength": 50,
        order: [[2, 'desc']],
        "paging": true,
     "fnRowCallback" : function(nRow, aData, iDisplayIndex){
		$("td:first", nRow).html(iDisplayIndex +1);
			return nRow;
	},
    });
  //
  jQuery('#detailpage').DataTable({
      "pageLength": 50
  });
 jQuery.fn.existsWithValue = function() { 
    return this.length && this.val().length; 
}
  if (jQuery('#input_2_9').existsWithValue()) {
        jQuery("#input_2_9").attr('readonly', true);
}
if($("#saleReport_filter").length){
     document.querySelector("#saleReport_filter > label > input[type=search]").setAttribute('list', 'qrcodesorting	');
}

 });
 </script>
 <?php }
 /* Custom Script Add for ACF Feild Validatins */
 add_action( 'admin_enqueue_scripts', function() {
 	/*ACF User Repater Feild validation file*/
    wp_enqueue_script( 'custom_js_code', get_stylesheet_directory_uri(). '/js/custom_acf.js' );
   /*ACF User Repater Feild validation alert Style*/
    wp_enqueue_style( 'custom_js_code', get_stylesheet_directory_uri(). '/css/custom_acf.css' );
} );
 /*ACF Pro Include in Theme*/
define('CERTIFIEDADVENTURES_ACF_PATH',get_stylesheet_directory().'/includes/acf-pro/');
define('CERTIFIEDADVENTURES_ACF_URL', get_stylesheet_directory_uri().'/includes/acf-pro/');
require_once CERTIFIEDADVENTURES_ACF_PATH . 'acf.php';
add_filter('acf/settings/url','csm_settings_url');
function csm_settings_url($url){
	return CERTIFIEDADVENTURES_ACF_URL;
}

/*** Option with advance custom feild ***/
require get_stylesheet_directory() . '/includes/acf.php';

/*hide acf menu from dashboard*/
add_filter('acf/settings/show_admin', '__return_false');

/*validation of vendeor code start replace key with your field key*/
add_filter('acf/validate_value/key=field_62a8560647cbd', 'acf_unique_value_field', 10, 4);
function acf_unique_value_field($valid, $value, $field, $input) {
	$useridfromurl = $_REQUEST['user_id'];
 // Bail early if value is already invalid.
	$users = get_users( array( 'fields' => array( 'ID' ) ) );
	$exclude_current_usre_id = array();
	$unique_barcode_data = array();
	$unique_barcode_value = array();
	foreach ($users as $key => $users_value) {
		$exclude_current_usre_id[] = $users_value->ID;
	}
	if (($key = array_search($useridfromurl, $exclude_current_usre_id)) !== false) {
    unset($exclude_current_usre_id[$key]);
}
	foreach($exclude_current_usre_id as $userkey => $user){
	$vender_code = get_user_meta($user);
		if (isset($vender_code["vender_code"])) {
			$unique_barcode_data[] = $vender_code["vender_code"];
		}
	}
	foreach ($unique_barcode_data as $key => $value) {
		$unique_barcode_value[] = $value[0];
	}

	if( $valid !== true ) {
		return $valid;
	}
	$current_barcode_value = $_POST['acf']['field_62a8560647cbd'];
	if (in_array($current_barcode_value, $unique_barcode_value) || $value == "") {
		return "This Code already use";
	}
	return $valid;
	
	
}
/* ACF Feild QR Code duplicate validation in user porfile */
add_filter('acf/validate_value/key=field_62a85e3fbcfd5', 'acf_unique_value_field_repeter', 10, 4);
function acf_unique_value_field_repeter($valid, $value, $field, $input) {
	$useridfromurl = $_REQUEST['user_id'];
			if( $valid !== true ) {
		return $valid;
	}
 // Bail early if value is already invalid.
	$users = get_users( array( 'fields' => array( 'ID' ) ) );
	$exclude_current_usre_id = array();
	$alllocation = array();
	$alllocationvaluedata = array();
	foreach ($users as $key => $users_value) {
		$exclude_current_usre_id[] = $users_value->ID;
	}
	if (($key = array_search($useridfromurl, $exclude_current_usre_id)) !== false) {
    	unset($exclude_current_usre_id[$key]);
	}
	foreach($exclude_current_usre_id as $userkey => $user){
		$vender_code = get_user_meta($user);
		if (isset($vender_code["location_code"])) {
			$vender_code_count = $vender_code["location_code"];
			for ($i=0; $i < $vender_code_count[0]; $i++) { 
				$alllocation[] = $vender_code["location_code_{$i}_location_qr_code"];
			}
		}
	}
	foreach ($alllocation as $key => $alllocationvalue) {
		$alllocationvaluedata[] = $alllocationvalue[0];
	}
	/* ACF Feild Validation custom alert massage*/
	if (in_array($value, $alllocationvaluedata, true) || $value == "") {
		return "This location code already use";
	}

	return $valid;
}
/*end validatin*/