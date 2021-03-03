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
		$good_to_go = true;
		$good_for_cookie = true;
		$data_id = 0;
		$query_string = $_SERVER['QUERY_STRING'];

		global $wpdb;
		$table = $wpdb->prefix.'fire_capture_table';
		$all_result = $wpdb->get_results("SELECT * FROM $table");
		//print_r($all_result);
		$conact_result = "";
		if( !empty($all_result)):
			foreach($all_result as $r):
				if($r->params == $query_string):
					$good_to_go = false;
					$data_id = $r->id;
				endif;
			endforeach;
		endif;

		//print_r($conact_result);

		//get query string or utm parameters

		if($query_string != null && !is_admin()):
			$referer = (isset($_SERVER['HTTP_REFERER'])) ? '&fire_cook_ref='.$_SERVER['HTTP_REFERER'] : null;

			if($good_to_go):
				global $wpdb;
				$table = $wpdb->prefix.'fire_capture_table';
				$data = array('name' => "data",
								'params' => $query_string,
								'ref' => "rr",
								'page' => "page");
				echo (!$wpdb->insert($table,$data))? 'Please dont duplicate name' : 'Sucessfully inserted';
				$data_id = $wpdb->insert_id;
			endif;
			if(!isset($_COOKIE[$cookie_name])){

				$cookie_val = $query_string;

				$cookie_val .= '&fire_data_id='.$data_id;

				$cookie_val .= $referer;

				setcookie($cookie_name,$cookie_val,time() + (86400 * 30), "/");
			}else{
				$cookie_val = $_COOKIE['_fire_capture_cookie'];
				$arr = explode(";;",$cookie_val);

				$current_value = $query_string .'&fire_data_id='.$data_id . $referer;
				foreach($arr as $a){
					$inner_arr = explode("&fire_cook_ref",$a);
					if($inner_arr[0] == $current_value)
						$good_for_cookie = false;
				}
				if($good_for_cookie){
					$value = $cookie_val . ";;" . $current_value;
					echo (setcookie($cookie_name,$value,time() + (86400 * 30), "/")) ? "yes" : "no";
				}
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