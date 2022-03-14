<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function ariafontrealhomes_settings_page() {
include ('font-setting.php');
}

function ariafontrealhomes_font_settings_page() {
//Aria Font Setting Functions
}
function ariafontrealhomes_create_menu() {
add_menu_page( __("آریا فونت", 'awp'), __("آریا فونت", 'awp'), 'manage_options',"ariafontrealhomes-settings", "ariafontrealhomes_settings_page" ,'dashicons-admin-customizer' );
add_submenu_page("ariafontrealhomes-settings", __("فونت آنکد", 'awp'), __("فونت آنکد", 'awp'), 'manage_options', "ariafontrealhomes-settings","ariafontrealhomes_settings_page");
add_action('admin_init', 'register_ariafontrealhomes_settings');
}
add_action('admin_menu', 'ariafontrealhomes_create_menu');
function register_ariafontrealhomes_settings(){
// Register our settings
register_setting('ariafontrealhomes_font_settings', 'ariafontrealhomes_font_settings');
}



        



