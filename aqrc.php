<?php
/**
*Plugin Name: Advance-qr-code
*Plugin URI: https://alfanet.bd.org
*Description:This is the plugin which will be advance function then previous.
*Version: 1.2
*Author: Md. Omit Hasan
*Author URI: https://google.com
*License: GPLv2 or Later
*Text Domain: aqrc
*Domain Path:/langurages/
*/

function aqrc_load_textdomain(){
    load_plugin_textdomain( 'aqrc',false,dirname(__FILE__)."/languages");
};
add_action("plugins_loaded","aqrc_load_textdomain");

function aqrc_function($content){
    $aqrc_post_link = get_permalink();
    $aqrc_title = 'out put of the fuction';
    $aqrc_src = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=185x185&ecc=L&qzone=1&data=%s',$aqrc_post_link);
    $content .= sprintf("<img src='%s'>",$aqrc_src);
  //  $content .= sprintf('<h1>%s: %s</h1>',$aqrc_title,$aqrc_post_link);
   // $content .= sprintf($aqrc_post_link);
   // echo $aqrc_post_link;
    return $content;
}
add_filter( 'the_content', 'aqrc_function');

function aqrc_settings_init(){

    add_settings_field( 'aqrc_height', __('QR_code_Height','aqrc'),'aqrc_display_height','general');
    add_settings_field( 'aqrc_width', __('QR_code_Width','aqrc'),'aqrc_display_width','general');
    
    register_setting('general','pqrc_display_height',array('sanaitze_callback'=>'esc_attr'));
    register_setting('general','pqrc_display_width',array('sanaitze_callback'=>'esc_attr'));

}
function aqrc_display_height(){
    $height = get_option( 'aqrc_height');
    printf("<input type= 'text' id='%s' name='%s' value='%s'/>",'aqrc_height','aqrc_heith',$height);
};
function aqrc_display_width(){
    $width = get_option( 'aqrc_width');
    printf("<input type= 'text' id='%s' name='%s' value='%s'/>",'aqrc_width','aqrc_width',$width);
}

add_action("admin_init",'aqrc_settings_init');








?>
