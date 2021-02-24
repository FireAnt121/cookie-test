<?php

    require_once plugin_dir_path( dirname(__FILE__) ). 'partials/table_template/table_helpers.php';
    $cookie_val = $_COOKIE['_fire_capture_cookie'];

    parse_str($cookie_val,$cookie_arr);

    inittable();
    //creation of table with shortcode
    foreach($cookie_arr as $key => $v):
        insertInTable($key,$v);
    endforeach;

    closeTable();
?>