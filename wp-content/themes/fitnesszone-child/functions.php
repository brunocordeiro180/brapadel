<?php
 
 
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' ); 

add_action('init', 'start_session', 1);

function start_session() {
  if(!session_id()) {
  session_start();
  }
  }

function enqueue_parent_styles() {
  wp_enqueue_style('bootstrap', get_stylesheet_directory_uri().'/css/reservas/bootstrap.min.css'); 
  wp_enqueue_style('parent-style', get_stylesheet_directory_uri().'/css/reservas/jsCalendar.css'); 
  wp_enqueue_style( 'parent-style2', get_template_directory_uri().'/style.css' ); 
  wp_enqueue_style('parent-style3', get_stylesheet_directory_uri().'/css/reservas/pickaday.css');
  wp_enqueue_style('tt-reservas-style', get_stylesheet_directory_uri().'/css/reservas/reservas.1.css');
  wp_enqueue_style('tt-reservas-calendar', get_template_directory_uri().'/css/reservas/calendar.css');
}

add_action( 'wp_enqueue_scripts', 'theme_scripts_styles' );

function theme_scripts_styles() {

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/js/jquery-3.3.1.min.js', array());
    wp_enqueue_script( 'tt-reservas-calendar-script', get_stylesheet_directory_uri() . '/css/reservas/jsCalendar.js', array( ) );
    wp_enqueue_script( 'tt-reservas-calendar-script2', get_stylesheet_directory_uri() . '/css/reservas/jsCalendar.lang.pt.js', array( ) );
    wp_enqueue_script( 'tt-reservas-calendar-script3', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( ) );
}

function remove_acf_time_picker_seconds() { ?>
  <style>
    .ui_tpicker_second,
    .ui_tpicker_second::before {
      display: none !important;
    }
  </style>
<?php }
add_action('admin_head', 'remove_acf_time_picker_seconds');

add_filter('woocommerce_disable_admin_bar', '_wc_disable_admin_bar', 10, 1);
 
function _wc_disable_admin_bar($prevent_admin_access) {
    if (!current_user_can('gerente')) {
        return $prevent_admin_access;
    }
    return false;
}
 
add_filter('woocommerce_prevent_admin_access', '_wc_prevent_admin_access', 10, 1);
 
function _wc_prevent_admin_access($prevent_admin_access) {
    if (!current_user_can('gerente')) {
        return $prevent_admin_access;
    }
    return false;
}

function my_login_logo_one() { 
  ?> 
  <style type="text/css"> 
  body.login div#login h1 a {
   background-image: url(http://brapadel-com-br.umbler.net/wp-content/uploads/2019/01/brapadelLogoG-8.png);  //Add your own logo image in this url 
   height:1px;
		width:320px;
		background-size: 185px 180px;
		background-repeat: no-repeat;
    padding-bottom: 100px;
  } 

  #login{
    padding: 5% 0% 0% !important;
  }
  </style>
  
   <?php 
} add_action( 'login_enqueue_scripts', 'my_login_logo_one' );

?>