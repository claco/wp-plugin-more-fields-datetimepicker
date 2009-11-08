<?php
/*
Plugin Name: More Fields: DateTime picker field type
Plugin URI: http://github.com/claco/wp-plugin-more-fields-datetimepicker/
Description: Adds a datetime picker to the available field types
Version: 0.1
Author: Christopher H. Laco, Henrik Melin
*/

function mf_datepicker_init($types) {
		$language = ($a = substr(WPLANG, 0, 2)) ? $a : 'en';
		$select->title = 'Datepicker';
		$select->html_before = "
		  <script>
			jQuery(document).ready(function(){
				jQuery.datepicker.setDefaults(jQuery.datepicker.regional['" . $language . "']);
    			jQuery('#%key%').datepicker();
				jQuery('#%key%_image').bind('click', function(e){
	  				jQuery('#%key%').focus();
					
				});
  			});
  			</script>
		";
		$select->html_item = "<input id='%key%' name='%key%' value='%value%' class=%class% style='width: 160px;'> &nbsp; <img id='%key%_image' src='images/date-button.gif'>";
		$select->html_after = '';
		$select->html_selected = '';
		$select->values = false;		
		$types[]  = $select;
		return $types;
}
add_filter('more_fields_field_types', 'mf_datepicker_init');

// Include the JQuery UI and load the CSS for the datepicker.
function mf_datepicker_head() {
	// Pre-2.6 compatibility
	if ( !defined('WP_CONTENT_URL') )
		define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
	$plugin_url = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__));
	echo "<script type='text/javascript' src='" . $plugin_url . "/jquery-ui/jquery-ui-personalized-1.6rc2.min.js'></script>\n";
	echo "<link rel='stylesheet' href='" . $plugin_url . "/ui.datepicker.more-fields.css' type='text/css' media='all' />";

}
add_action('admin_head', 'mf_datepicker_head');

?>