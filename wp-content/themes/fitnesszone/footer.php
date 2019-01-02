		<?php global $dt_allowed_html_tags; ?>
        <!-- footer starts here -->
        <footer id="footer">
            <div class="footer-widgets-wrapper">
				<?php if(dt_theme_option('general','show-footer') != ''): ?>
                    <div class="container">
                        <?php dt_theme_show_footer_widgetarea(dt_theme_option('general','footer-columns')); ?>
                    </div>
                <?php endif; ?>
                <?php if(dt_theme_option('general','footer-bottom-bar') != "true"): ?>
                    <div class="social-media-container">
                        <div class="social-media">
                            <div class="container">
                                <div class="dt-sc-contact-info dt-phone">
                                    <p><i class="fa fa-phone"></i> <span><?php echo wp_kses(dt_theme_option('general', 'bottom-phoneno-content'), $dt_allowed_html_tags); ?></span> </p>
                                </div><?php
								if(dt_theme_option('general','show-sociables') != ''):
									#Listing social icons...
									$dt_theme_options = get_option(FITNESSZONE_THEME_SETTINGS);
									if(is_array($dt_theme_options['social'])): ?>
										<ul class="dt-sc-social-icons"><?php
											#Perform elements...
											foreach($dt_theme_options['social'] as $social):
												$link = esc_url($social['link']);
												$icon = esc_attr($social['icon']);
												echo "<li class='".substr($icon, 3)."'>";
												echo "<a class='fa {$icon}' href='{$link}'></a>";
												echo "</li>";
											endforeach; ?>
										</ul><?php
									endif;
								endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>


	</div><!-- **Inner Wrapper - End** -->
</div><!-- **Wrapper - End** -->
<?php if(dt_theme_option('integration', 'enable-body-code') != '') echo '<script type="text/javascript">'.wp_kses(stripslashes(dt_theme_option('integration', 'body-code')), $dt_allowed_html_tags).'</script>';
wp_footer(); ?>



<script src="https://www.gstatic.com/firebasejs/5.5.6/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBjE-fgHvPfDBjchzkhImrrQH7UTi-kkI4",
    authDomain: "brapadel-221012.firebaseapp.com",
    databaseURL: "https://brapadel-221012-4a46a.firebaseio.com/",
    projectId: "brapadel-221012",
    storageBucket: "",
    messagingSenderId: "598052612572"
  };
  firebase.initializeApp(config);
</script>
</body>
</html>
