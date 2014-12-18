<?php
class DC_Edd_Discounts_By_Time_Admin {
  
	public function __construct() {
		//admin script and style
		add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_script'));
		
		//add_action('dc_edd_discounts_by_time_dualcube_admin_footer', array(&$this, 'dualcube_admin_footer_for_dc_edd_discounts_by_time'));
	}
	
	function dualcube_admin_footer_for_dc_edd_discounts_by_time() {
    global $DC_Edd_Discounts_By_Time;
    ?>
    <div style="clear: both"></div>
    <div id="dc_admin_footer">
      <?php _e('Powered by', $DC_Edd_Discounts_By_Time->text_domain); ?> <a href="http://dualcube.com" target="_blank"><img src="<?php echo $DC_Edd_Discounts_By_Time->plugin_url.'/assets/images/dualcube.png'; ?>"></a><?php _e('Dualcube', $DC_Edd_Discounts_By_Time->text_domain); ?> &copy; <?php echo date('Y');?>
    </div>
    <?php
	}

	/**
	 * Admin Scripts
	 */

	public function enqueue_admin_script() {
		global $DC_Edd_Discounts_By_Time;
		$screen = get_current_screen();
		
		// Enqueue admin script and stylesheet from here
		if (in_array( $screen->id, array( 'download_page_edd-discounts' ))) {   
		  wp_enqueue_script('edd_time_admin_js', $DC_Edd_Discounts_By_Time->plugin_url.'assets/admin/js/admin.js', array('jquery'), $DC_Edd_Discounts_By_Time->version, true);
		  wp_enqueue_style('edd_time_admin_css',  $DC_Edd_Discounts_By_Time->plugin_url.'assets/admin/css/admin.css', array(), $DC_Edd_Discounts_By_Time->version);
		  wp_enqueue_script('timepicker_js', $DC_Edd_Discounts_By_Time->plugin_url.'assets/admin/js/jquery.timepicker.min.js', array('jquery'), $DC_Edd_Discounts_By_Time->version, true);
		  wp_enqueue_style('timepicker_css',  $DC_Edd_Discounts_By_Time->plugin_url.'assets/admin/css/jquery.timepicker.css', array(), $DC_Edd_Discounts_By_Time->version);
	  }
	}
}