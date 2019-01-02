<?php ob_start();
/** create_admin_menu()
  * Objective:
  *		Hook to create thme option page at back end.
**/
function create_admin_menu() {

	$role = get_role('administrator');
	if(!$role->has_cap('manage_theme')) $role->add_cap('manage_theme');

    if( function_exists('add_theme_page') ) 
		add_theme_page (FITNESSZONE_THEME_NAME.' - '.__('settings','fitnesszone'),FITNESSZONE_THEME_NAME.' '.__('Options', 'fitnesszone'),'manage_theme','parent','dt_theme_options_page', '', 25);

	if(function_exists('add_theme_page'))
	 	add_theme_page ('parent',FITNESSZONE_THEME_NAME.' - '.__("options",'fitnesszone'),__('Options','fitnesszone'),'manage_theme','parent','dt_theme_options_page');		

}
### --- ****  create_admin_menu() *** --- ###
add_action('admin_menu', 'create_admin_menu');
locate_template( 'framework/theme_options/settings.php', true);
#ob_flush();?>