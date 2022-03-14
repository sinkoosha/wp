<?php
/**
* Plugin Name: Persian Font realhomes
* Plugin URI: https://ariawp.com
* Description: Add persian font to realhomes theme, developed by AriaWordPress
* Version: 1.2
* Author: AriaWP
* Author URI: https://ariawp.com
* Text Domain: ariawp-realhomes
*/

if ( ! defined( 'ABSPATH' ) ) exit;


include('inc/panel.php');
$optionsms = get_option('ariafontrealhomes_font_settings');
$i = 1;
$activate = 0;
while ($i < 5){
	$fontnamecount = 'fontname' . $i;
	if(!empty($optionsms[$fontnamecount])){
		$activate = $i;
	}
	if ($activate == 1) {
	function ariafontrealhomes_fa_scripts1() {
		global $optionsms;
    	wp_enqueue_style( 'ariawp-font1', plugins_url( 'assets/css/' . esc_html( $optionsms['fontname1'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontrealhomes_fa_scripts1', 999999);
	}
	if ($activate == 2) {
	function ariafontrealhomes_fa_scripts2() {
		global $optionsms;
    	wp_enqueue_style( 'ariawp-font2', plugins_url( 'assets/css/' . esc_html( $optionsms['fontname2'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontrealhomes_fa_scripts2', 999998);
	}
	if ($activate == 3) {
	function ariafontrealhomes_fa_scripts3() {
		global $optionsms;
    	wp_enqueue_style( 'ariawp-font3', plugins_url( 'assets/css/' . esc_html( $optionsms['fontname3'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontrealhomes_fa_scripts3', 999997);
	}
	if ($activate == 4) {
	function ariafontrealhomes_fa_scripts4() {
		global $optionsms;
    	wp_enqueue_style( 'ariawp-font4', plugins_url( 'assets/css/' . esc_html( $optionsms['fontname4'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontrealhomes_fa_scripts4', 999996);
	}
	$i++;
	$activate = 0;
}

	
add_action('wp_head', 'realhomes_add_css');	
function realhomes_add_css(){
global $optionsms;
?>
    <style type="text/css">
    	<?php if(!empty($optionsms['bodyfontname'])) { ?>
        body, h1, h2, h3, h4, h5, h6, .main-menu ul li a, .advance-search, #footer .widget .title, #footer .widget .wp-block-group__inner-container>h2, #footer .widget .wp-block-search__label, .widget, #footer-bottom, .slide-description span, input[type=number], input[type=date], input[type=number], input[type=tel], input[type=url], input[type=email], input[type=text], input[type=password], textarea, input, button, select, textarea, .widget .title, .widget .wp-block-group__inner-container>h2, .widget .wp-block-search__label, #overview, #overview .property-item .price, #overview .share-label, #overview .common-label, #overview .video-label, #overview .virtual-tour-label, #overview .walkscore-label, #overview .yelp-label, #overview .attachments-label, #overview .map-label, #overview .floor-plans .floor-plans-label, .floor-plans #overview .floor-plans-label, .detail .list-container h3, #footer .widget ul.featured-properties li h4, #footer .widget ul.featured-properties li .property-item h4 a, .property-item h4 #footer .widget ul.featured-properties li a, ul.featured-properties li h4, ul.featured-properties li .property-item h4 a, .property-item h4 ul.featured-properties li a, .listing-layout h4, .listing-layout .property-item h4 a, .property-item h4 .listing-layout a, .widget .enquiry-form .agent-form-title, .page-head .page-title, .leaflet-container, .contact-page, .form-heading, #contact-form, #respond, .about-agent .contacts-list{
            font-family: <?php esc_attr_e($optionsms['bodyfontname']); ?>;
        }
        <?php } ?>
        <?php if(!empty($optionsms['hfontname'])) { ?>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6{
            font-family: <?php esc_attr_e($optionsms['hfontname']); ?>;
        }
        <?php } ?>
        <?php if(!empty($optionsms['menufontname'])) { ?>
        .rh_menu, .main-menu ul li a { font-family: <?php esc_attr_e($optionsms['menufontname']); ?> !important; }
        <?php } ?>

    </style>
    <?php
}

?>