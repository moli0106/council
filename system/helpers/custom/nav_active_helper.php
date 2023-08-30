<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method')){
    function active($no = NULL, $segment_name){
        $ci=& get_instance();
        if($ci->uri->segment($no) == $segment_name){
            return 'class="nav_active"';
        }    
    }   
}