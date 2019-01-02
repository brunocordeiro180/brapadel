<?php get_header();

	  $page_id = get_option('page_for_posts');
	  if($page_id > 0) {

		  dt_theme_slider_section($page_id);

		  #Getting meta values...
		  $meta_set = get_post_meta($page_id, '_tpl_default_settings', true);
		  if($GLOBALS['force_enable'] == true)
			$page_layout = $GLOBALS['page_layout'];
		  else
			$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];

	  } else {
		  $page_layout = dt_theme_option('specialty', 'post-archives-layout');
	  }

	  #Breadcrump section...
      if(!is_front_page()):?>
		  <!-- breadcrumb starts here -->
		  <div class="breadcrumb-wrapper <?php if(dt_theme_option('general','header-top-bar') == "true") echo esc_attr('notop'); ?>">
			  <div class="container">
				  <h1><?php echo get_the_title($page_id); ?></h1><?php
				  #Check breadcrumb enable...
				  if(dt_theme_option('general', 'disable-breadcrumb') != "on")
					new dt_theme_breadcrumb; ?>
			  </div>
		  </div><!-- breadcrumb ends here --><?php
      endif;?>

      <div id="main">
          <!-- main-content starts here -->
          <div id="main-content">
              <div class="container">
                  <div class="dt-sc-hr-invisible"></div>
                  <div class="dt-sc-hr-invisible"></div>
  
                  <?php if($page_layout == 'with-left-sidebar'): ?>
                      <section class="secondary-sidebar secondary-has-left-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section>
                  <?php elseif($page_layout == 'with-both-sidebar'): ?>
                      <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section>
                  <?php endif; ?>
  
                  <?php if($page_layout != 'content-full-width'): ?>
                        <section id="primary" class="page-with-sidebar page-<?php echo esc_attr($page_layout); ?>">
                  <?php else: ?>
                        <section id="primary" class="content-full-width">
                  <?php endif; ?>
  
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
                        #Performing archive layout...
                        get_template_part('includes/archive-post-layout'); ?>
                    </article>
                  </section>
  
                  <?php if($page_layout == 'with-right-sidebar'): ?>
                    <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
                  <?php elseif($page_layout == 'with-both-sidebar'): ?>
                    <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
                  <?php endif; ?>

              </div>
			  <div class="dt-sc-hr-invisible-large"></div>
          </div>
      </div>

<?php get_footer(); ?>