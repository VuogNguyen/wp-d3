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

/**
* Get skill list CPT by wp_ajax
*/

function wp_ajax_get_skills() {
  $return = array();

  $args = array(
    'post_type'         => 'skills',
    'posts_per_page'    => -1
  );
  $query = new WP_Query( $args );

  if ( $query->have_posts() ):
    while ( $query->have_posts() ) : $query->the_post();
      $id = get_the_id();
      $title  = get_the_title();
      $result = get_field( 'result', get_the_id() );
      array_push( $return, array("skill"=>$title,"result"=>$result,"id"=>$id) );
    endwhile;
    wp_reset_postdata();
  endif;

  wp_send_json(array_reverse($return));
}

add_action( 'wp_ajax_nopriv_get_skills', 'wp_ajax_get_skills' );
add_action( 'wp_ajax_get_skills', 'wp_ajax_get_skills' );

function wp_ajax_get_avg_results() {
  $total = 0;
  $count = 0;

  $args = array(
    'post_type'         => 'skills',
    'posts_per_page'    => -1
  );
  $query = new WP_Query( $args );

  if ( $query->have_posts() ):
    while ( $query->have_posts() ) : $query->the_post();
      $total += get_field( 'result', get_the_id() );
      $count += 1;
    endwhile;
    wp_reset_postdata();
  endif;

  $num = (int)number_format($total/$count);
  $num2 = 100 - $num;
  
  $return = [$num, $num2];

  wp_send_json($return);
}

add_action( 'wp_ajax_nopriv_get_avg_results', 'wp_ajax_get_avg_results' );
add_action( 'wp_ajax_get_avg_results', 'wp_ajax_get_avg_results' );
 
function wp_ajax_update_skills() {
  $skillSet = $_POST['skillSet'];

  if (isset($skillSet)) {
    foreach ($skillSet as $skillPost) {
      $result = (int)$skillPost["result"];
      if ($result >= 0 && $result <= 100) {
        update_field( 'result', $result, $skillPost["id"] );
      }
    }
    $message = "Update Skills Successful";
    echo ($message);
  } else {
    $message = "Empty Skills Set";
    echo ($message);
  }
  die();
}

add_action( 'wp_ajax_nopriv_update_skills', 'wp_ajax_update_skills' );
add_action( 'wp_ajax_update_skills', 'wp_ajax_update_skills' );

/**
* Shortcode for Bar Chart
*/
function barchart_embedded() {
  $out = '<div class="js-bar-chart chart chart--bar"></div>';
  return $out;
}
add_shortcode('barchart', 'barchart_embedded');
/**
* Shortcode for Pie Chart
*/
function piechart_embedded() {
  $out = '<div class="js-pie-chart chart chart--pie"></div>';
  return $out;
}
add_shortcode('piechart', 'piechart_embedded');
?>