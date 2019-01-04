<?php
if (! defined ( 'FITNESSZONE_BASE_URL' )) {
	define ( 'FITNESSZONE_BASE_URL', get_template_directory_uri () . '/' );
}
define ( 'FITNESSZONE_FW_URL', FITNESSZONE_BASE_URL . 'framework/' );
define ( 'FITNESSZONE_FW', get_template_directory() . '/framework/' );
define ( 'FITNESSZONE_CORE_PLUGIN', WP_PLUGIN_DIR.'/designthemes-core-features' );
define ( 'FITNESSZONE_THEME_SETTINGS', 'mytheme' );

/*
 * Define FITNESSZONE_THEME_NAME Objective: Used to show theme name where ever needed( eg: in widgets title ar the back-end).
 */
// get themedata version wp 3.4+
if (function_exists ( 'wp_get_theme' )) :
	$theme_data = wp_get_theme ();
	define ( 'FITNESSZONE_THEME_NAME', $theme_data->get ( 'Name' ) );
	define ( 'FITNESSZONE_THEME_FOLDER_NAME', $theme_data->template );
	define ( 'FITNESSZONE_THEME_VERSION', ( float ) $theme_data->get ( 'Version' ) );
endif;

define ( 'FITNESSZONE_SAMPLE_FONT', __ ( 'The quick brown fox jumps over the lazy dog', 'fitnesszone' ) );

if (! isset ( $content_width ))
	$content_width = 1170;

// BACKEND DETAILS WILL BE IN include.php
require_once (get_template_directory () . '/framework/include.php');
$page_layout = dt_theme_option('specialty', 'global-page-layout');
$GLOBALS['page_layout'] = !empty($page_layout) ? $page_layout : 'content-full-width';
$GLOBALS['force_enable'] = dt_theme_option('specialty', 'force-enable-global-layout'); 

function create_posttype_reservab() {

    $labels = array(
        'name' => 'Reservas Brapadel',
        'singular_name' => 'Reserva Brapadel',
        'add_new_item' => 'Adiconar nova Reserva',
        'edit_item' => 'Editar Reserva',
        'new_item' => 'Nova Reserva',
        'all_items' => 'Todas as Reservas'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-cart'
    );
 
    register_post_type( 'reservab', $args);
}

add_action( 'init', 'create_posttype_reservab' );




?>