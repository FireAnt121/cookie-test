<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       tenish.pb.design
 * @since      1.0.0
 *
 * @package    Firecapture
 * @subpackage Firecapture/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Firecapture
 * @subpackage Firecapture/public
 * @author     FireAnt <shresthatenish121@gmail.com>
 */
class Firecapture_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('init',array($this,'capture_from_http'));
	}


	public function capture_from_http(){

		//cookie parameters
		$cookie_name = "_fire_capture_cookie";
		$cookie_val = ""; 

		//get query string or utm parameters
		$query_string = $_SERVER['QUERY_STRING'];
		if($query_string != null):
			if(!isset($_COOKIE[$cookie_name])){

				$cookie_val = $query_string;

				$cookie_val .= (isset($_SERVER['HTTP_REFERER'])) ? '&ref='.$_SERVER['HTTP_REFERER'] : null;

				setcookie($cookie_name,$cookie_val,time() + (86400 * 30), "/");
			}
		endif;
			// $query_string = $_SERVER['QUERY_STRING'];

			// if($query_string != null):

			// 	$referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : null;


			// 	 parse_str($query_string, $capture_array);


			// 	 print_r($capture_array);
			// 	 echo $referer;
			// 	 print_r($_SESSION);
			// endif;
	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/firecapture-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/firecapture-public.js', array( 'jquery' ), $this->version, false );

	}

}