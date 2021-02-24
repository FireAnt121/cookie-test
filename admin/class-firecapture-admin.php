<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       tenish.pb.design
 * @since      1.0.0
 *
 * @package    Firecapture
 * @subpackage Firecapture/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Firecapture
 * @subpackage Firecapture/admin
 * @author     FireAnt <shresthatenish121@gmail.com>
 */
class Firecapture_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action( 'admin_menu', array($this,'capture_fire') ); 
		add_shortcode('FireCapture', array($this,'get_from_cookie'));
	}

	function get_from_cookie($atts){
		$a = shortcode_atts( array(
			'name' => 'caption',
		), $atts );

		$cookie_val = $_COOKIE['_fire_capture_cookie'];

		parse_str($cookie_val,$cookie_arr);

		return esc_attr($cookie_arr[$a['name']]);
	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Firecapture_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Firecapture_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/firecapture-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Firecapture_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Firecapture_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/firecapture-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * 
	 * Adding menu for the admin
	 * 
	 * 
	 */
	public function capture_fire(){    
		$page_title = 'Fire Capture';   
		$menu_title = 'Fire Capture';   
		$capability = 'manage_options';   
		$menu_slug  = 'fire-captures';   
		$function   = array($this,'captureDashboard');   
		$icon_url   = 'dashicons-media-code';   
		$position   = 4;    
		add_menu_page( $page_title,$menu_title,$capability,$menu_slug,$function,$icon_url,$position ); 
	}
	/***
	 * 
	 * call back function of the main menu Fire Capture
	 * 
	 */

	public function captureDashboard(){
		require_once plugin_dir_path( dirname(__FILE__) ) .'/admin/partials/firecapture-dashboard.php';
	}

}