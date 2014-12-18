<?php
class DC_Edd_Discounts_By_Time {

	public $plugin_url;

	public $plugin_path;

	public $version;

	public $token;
	
	public $text_domain;
	
	public $admin;

	private $file;
	
	public $span;
	
	public $validate;
	
	public function __construct($file) {

		$this->file = $file;
		$this->plugin_url = trailingslashit(plugins_url('', $plugin = $file));
		$this->plugin_path = trailingslashit(dirname($file));
		$this->token = DC_EDD_DISCOUNTS_BY_TIME_PLUGIN_TOKEN;
		$this->text_domain = DC_EDD_DISCOUNTS_BY_TIME_TEXT_DOMAIN;
		$this->version = DC_EDD_DISCOUNTS_BY_TIME_PLUGIN_VERSION;
		
		add_action('init', array(&$this, 'init'), 0);
	}
	
	/**
	 * initilize plugin on WP init
	 */
	function init() {
		
		// Init Text Domain
		$this->load_plugin_textdomain();

    $this->load_class('validate');
    $this->validate = new  DC_Edd_Discounts_By_Time_Validate();

		if (is_admin()) {
			$this->load_class('admin');
			$this->admin = new DC_Edd_Discounts_By_Time_Admin();
		}
		
		$this->load_class('span');
    $this->span = new  DC_Edd_Discounts_By_Time_Span();
	}
	
	/**
   * Load Localisation files.
   *
   * Note: the first-loaded translation file overrides any following ones if the same translation is present
   *
   * @access public
   * @return void
   */
  public function load_plugin_textdomain() {
    $locale = apply_filters( 'plugin_locale', get_locale(), $this->token );

    load_textdomain( $this->text_domain, WP_LANG_DIR . "/dc-edd-discounts-by-time/dc-edd-discounts-by-time-$locale.mo" );
    load_textdomain( $this->text_domain, $this->plugin_path . "/languages/dc-edd-discounts-by-time-$locale.mo" );
  }

	public function load_class($class_name = '') {
		if ('' != $class_name && '' != $this->token) {
			require_once ('class-' . esc_attr($this->token) . '-' . esc_attr($class_name) . '.php');
		} // End If Statement
	}// End load_class()
	
	/** Cache Helpers *********************************************************/

	/**
	 * Sets a constant preventing some caching plugins from caching a page. Used on dynamic pages
	 *
	 * @access public
	 * @return void
	 */
	function nocache() {
		if (!defined('DONOTCACHEPAGE'))
			define('DONOTCACHEPAGE', 'true');
		// WP Super Cache constant
	}
}
