<?php

    require_once plugin_dir_path( dirname(__FILE__) ). 'partials/table_template/table_helpers.php';


    global $wpdb;
    $table_name = $wpdb->prefix .'fire_capture_table';
    $province_result = $wpdb->get_results("SELECT * FROM $table_name");

    foreach($province_result as $p){
        parse_str($p->params,$data_arr);

        inittable();
        //creation of table with shortcode
        foreach($data_arr as $key => $v):
            insertInTable($p->id,$key,$v);
        endforeach;
    
        closeTable();
    }
    //$cookie_val = $_COOKIE['_fire_capture_cookie'];

    // parse_str($cookie_val,$cookie_arr);

    // inittable();
    // //creation of table with shortcode
    // foreach($cookie_arr as $key => $v):
    //     insertInTable($key,$v);
    // endforeach;

    // closeTable();
?>