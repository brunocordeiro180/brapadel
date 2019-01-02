<?php
/** dt_theme_options_page()
  * Objective:
  *		To create thme option page at back end.
**/
function dt_theme_options_page(){ ?>
<!-- wrapper -->
<div id="wrapper">

	<!-- Result -->
    <div id="bpanel-message" style="display:none;"></div>
    <div id="ajax-feedback" style="display:none;"><img src="<?php echo FITNESSZONE_FW_URL.'theme_options/images/loading.png';?>" alt="" title=""/> </div>
    <!-- Result -->

	<!-- panel-wrap -->
	<div id="panel-wrap">
    
       	<!-- bpanel-wrapper -->
        <div id="bpanel-wrapper">
        
           	<!-- bpanel -->
           	<div id="bpanel">
            
                	<!-- bpanel-left -->
                	<div id="bpanel-left">
                    	<div id="logo"> 
                        <?php $logo =  FITNESSZONE_FW_URL.'theme_options/images/logo.png';
							  $advance = dt_theme_option('advance');
							  if(isset($advance['buddhapanel-logo-url']) && isset( $advance['enable-buddhapanel-logo-url'])):
							  	$logo = $advance['buddhapanel-logo-url'];
							  endif;?>
                        <img src="<?php echo $logo;?>" width="186" height="101" alt="" title="" /> </div>                        
                        <?php $status = dt_theme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')|| dt_theme_is_plugin_active('wordpress-seo/wp-seo.php');
							  $tabs = NULL;
							  if(!$status):
								$tabs = array(
									array('id'=>'general' , 'name'=>__('General','fitnesszone')),
									array('id'=>'appearance', 'name'=>__('Appearance','fitnesszone')),
									array('id'=>'skin', 'name'=>__('Skins','fitnesszone')),
									array('id'=>'integration', 'name'=>__('Integration','fitnesszone')),
									array('id'=>'seo', 'name'=>__('SEO','fitnesszone')),																		
									array('id'=>'specialty-pages', 'name'=>__('Speciality Pages','fitnesszone')),
									array('id'=>'theme-footer', 'name'=>__('Footer','fitnesszone')),
									array('id'=>'widgetarea', 'name'=>__('Widget Area','fitnesszone')),
									array('id'=>'woocommerce', 'name'=>__('WooCommerce','fitnesszone')),
									array('id'=>'pagebuilder', 'name'=>__('Page Builder','fitnesszone')),
									array('id'=>'events', 'name'=>__('Events','fitnesszone')),
									array('id'=>'mobile', 'name'=>__('Responsive &amp; Mobile','fitnesszone')),
									array('id'=>'import', 'name'=>__('Importer','fitnesszone')),
									array('id'=>'branding', 'name'=>__('Branding','fitnesszone')),
									array('id'=>'backup', 'name'=>__('Backup','fitnesszone'))
								);
							  else:
								$tabs = array(
									array('id'=>'general' , 'name'=>__('General','fitnesszone')),
									array('id'=>'appearance', 'name'=>__('Appearance','fitnesszone')),
									array('id'=>'skin', 'name'=>__('Skins','fitnesszone')),
									array('id'=>'integration', 'name'=>__('Integration','fitnesszone')),
									array('id'=>'specialty-pages', 'name'=>__('Speciality Pages','fitnesszone')),
									array('id'=>'theme-footer', 'name'=>__('Footer','fitnesszone')),																		
									array('id'=>'widgetarea', 'name'=>__('Widget Area','fitnesszone')),
									array('id'=>'woocommerce', 'name'=>__('WooCommerce','fitnesszone')),
									array('id'=>'pagebuilder', 'name'=>__('Page Builder','fitnesszone')),
									array('id'=>'events', 'name'=>__('Events','fitnesszone')),
									array('id'=>'mobile', 'name'=>__('Responsive &amp; Mobile','fitnesszone')),
									array('id'=>'branding', 'name'=>__('Branding','fitnesszone')),
									array('id'=>'import', 'name'=>__('Importer','fitnesszone')),
									array('id'=>'backup', 'name'=>__('Backup','fitnesszone')),
								);
							  endif;

							  if(!class_exists('DTCorePlugin')):
							  	  unset($tabs[12]);
							  endif;

							  $output = "<!-- bpanel-mainmenu -->\n\t\t\t\t\t\t<ul id='bpanel-mainmenu'>\n";
									foreach($tabs as $tab ):
									$output .= "\t\t\t\t\t\t\t\t<li><a href='#{$tab['id']}' title='{$tab['name']}'><span class='{$tab['id']}'></span>{$tab['name']}</a></li>\n";
									endforeach;
							  $output .= "\t\t\t\t\t\t</ul><!-- #bpanel-mainmenu -->\n";
							  echo $output;?>
                    </div><!-- #bpanel-left  end-->
                    
                    <form id="mytheme_options_form" name="mytheme_options_form" method="post" action="options.php">
		                <?php settings_fields(FITNESSZONE_THEME_SETTINGS);?>
                        <input type="hidden" id="mytheme-full-submit" name="mytheme-full-submit" value="0" />
                        <input type="hidden" name="dt_theme_admin_wpnonce" value="<?php echo wp_create_nonce(FITNESSZONE_THEME_SETTINGS.'_wpnonce');?>" />

                    	<?php locate_template( 'framework/theme_options/general.php', true);?>
                        <?php locate_template( 'framework/theme_options/appearance.php', true);?>
                        <?php locate_template( 'framework/theme_options/integration.php', true);?>
                        <?php locate_template( 'framework/theme_options/specialty-pages.php', true);?>
                        <?php locate_template( 'framework/theme_options/footer.php', true);?>
                        <?php locate_template( 'framework/theme_options/widgetarea.php', true);?>
                        <?php locate_template( 'framework/theme_options/woocommerce.php', true);?>
                        <?php locate_template( 'framework/theme_options/pagebuilder.php', true);?>
                        <?php locate_template( 'framework/theme_options/events.php', true);?>
                        <?php locate_template( 'framework/theme_options/responsive.php', true);?>
                        <?php locate_template( 'framework/theme_options/branding.php', true);?>
                        <?php locate_template( 'framework/theme_options/skins.php', true);?>
                        <?php $status = dt_theme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')|| dt_theme_is_plugin_active('wordpress-seo/wp-seo.php');
							  if(!$status):
							  	locate_template( 'framework/theme_options/seo.php', true);
							  endif;
							  // importer
							  if(class_exists('DTCorePlugin')):
							  	locate_template( 'framework/theme_options/import.php', true);
							  endif;
							  locate_template( 'framework/theme_options/backup.php', true);?>
						<!-- #bpanel-bottom -->
                        <div id="bpanel-bottom">
                           <input type="submit" value="<?php _e('Reset All','fitnesszone');?>" class="save-reset mytheme-reset-button bpanel-button white-btn" name="mytheme[reset]" />
						   <input type="submit" value="<?php _e('Save All','fitnesszone');?>" name="submit"  class="save-reset mytheme-footer-submit bpanel-button white-btn" />
                        </div><!-- #bpanel-bottom end-->        
                    </form>

            </div><!-- #bpanel -->

        </div><!-- #bpanel-wrapper -->
    </div><!-- #panel-wrap end -->
</div><!-- #wrapper end-->
<?php
}
### --- ****  dt_theme_options_page() *** --- ###
?>