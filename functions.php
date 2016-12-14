<?php
/*
 *  GLOBAL VARIABLES
 */
define('THEME_DIR', get_stylesheet_directory());
define('THEME_URL', get_stylesheet_directory_uri());

/*
 *  INCLUDED FILES
 */

$file_includes = [
    'inc/theme-assets.php',       // Style and JS
    'inc/theme-setup.php',        // General theme setting
    'inc/acf-options.php',        // ACF Option page
    'inc/theme-shortcode.php',    // Theme Shortcode
    'inc/class-bootstrap_navwalker.php'     // Bootrap Menu Class Walker
];

foreach ($file_includes as $file) {
    if ( !$filePath = locate_template($file) ) {
        trigger_error(sprintf(__('Missing included file'), $file), E_USER_ERROR);
    }

    require_once $filePath;
}

unset($file, $filePath);
 
/**
* Add body data to help identify current page
*/
if ( ! function_exists( 'kd_body_data' ) ) {
  function kd_body_data() {
    $type = '';
    $class = '';
    if ( is_front_page() || is_home() ) {
      $type = 'frontPage';
      $class = 'front-page';
    }
    echo 'class="' . $class . '" data-type="' . $type . '"';
  }
}
add_action( 'add_body_data', 'kd_body_data', 5 );

/**
* Get local image
*/
function get_image( $image ) {
  return get_template_directory_uri() . '/assets/images/' . $image;
}

/**
* Get image url by post ID
*/
function get_image_featured_url( $id, $size = 'full' ) {
  return wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size )[0];
}

function wp_ajax_get_skills() {
  $return = array();

  $args = array(
    'post_type'         => 'skills',
    'posts_per_page'    => -1
  );
  $query = new WP_Query( $args );

  if ( $query->have_posts() ):
    while ( $query->have_posts() ) : $query->the_post();
      $title  = get_the_title();
      $result = get_field( 'result', get_the_id() );
      array_push( $return, array("skill"=>$title,"result"=>$result) );
    endwhile;
    wp_reset_postdata();
  endif;

  wp_send_json(array_reverse($return));
}

add_action( 'wp_ajax_nopriv_get_skills', 'wp_ajax_get_skills' );
add_action( 'wp_ajax_get_skills', 'wp_ajax_get_skills' );
?>