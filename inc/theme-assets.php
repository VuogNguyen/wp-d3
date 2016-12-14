<?php

/*
 *  ENQUEUE SCRIPTS
 */

function theme_enqueue_script() {
  // Initialize variables
  $script_handle = 'wp-script';

  // Register vendor script
  $vender_file = THEME_DIR.'/assets/scripts-production/vendor.js';
  if (file_exists($vender_file)) {
    $vendor_handle = $script_handle.'-vendor';
    wp_register_script($vendor_handle, THEME_URL.'/assets/scripts-production/vendor.js', array(), false, true);
    wp_enqueue_script($vendor_handle);

    wp_localize_script( 
        'wp-script-vendor', 
        'ajax_skill_post', 
        array('ajaxurl'   => admin_url('admin-ajax.php'))
    );
  } else {
    var_dump('vendor file not exist!');
  }

  // Register project js files
  $js_files = glob(THEME_DIR.'/assets/scripts-production/*.js');
  foreach ($js_files as $file) {
    if (basename($file, '.js') != 'vendor') {
      $handle = $script_handle. '-' .basename($file, '.js');
      wp_register_script($handle, THEME_URL.'/assets/scripts-production/'.basename($file), array('jquery'), false, true);
      wp_enqueue_script($handle);
    }
  }
}

add_action('wp_enqueue_scripts', 'theme_enqueue_script');

/*
 *  ENQUEUE STYLES
 */

function theme_enqueue_styles() {
  // Initialize variables
  $script_handle = 'wp-style';

  // Register vendor style first
  $vendor_file = THEME_DIR.'/assets/css/vendor.css';
  if (file_exists($vendor_file)) {
    $vendor_handle = $script_handle.'-vendor';
    wp_register_style($vendor_handle, THEME_URL.'/assets/css/vendor.css', array(), false, false);
    wp_enqueue_style($vendor_handle);
  } else {
    var_dump('vendor file not exist!');
  }

  // Register main styles and other if defined
  $css_files = glob(THEME_DIR.'/assets/css/*.css');
  foreach ($css_files as $file) {
    if ( basename($file, '.css') != 'vendor' ) {
      $handle = $script_handle. '-' .basename($file, '.css');
      wp_register_style($handle, THEME_URL.'/assets/css/'.basename($file), array(), false, false);
      wp_enqueue_style($handle);
    }
  }
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
?>