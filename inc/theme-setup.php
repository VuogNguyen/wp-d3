<?php
function theme_setup()
{
  // Language loading
  // load_theme_text_domain('Theme Domain', trailingslashit( get_template_directory()).'languages' );

  // HTML5 support; mainly here to get rid of some nasty default styling that WordPress used to inject
  add_theme_support( 'html5', array( 'search-form', 'gallery' ) );

  // Automatic feed links
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );

  /*
   * Enable support for Post Formats.
   *
   * See: https://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
  ) );

  /*
   * Register Menus
   */
  register_nav_menu( 'main_menu', __( 'Main Menu', 'ROTheme' ) );

}
add_action( 'after_setup_theme', 'theme_setup', 11);

function limit_text($text, $limit) {

  if (str_word_count($text, 0) > $limit) {
    $words = str_word_count($text, 2);
    $pos = array_keys($words);
    $text = substr($text, 0, $pos[$limit]) . '...';
  }

  return $text;
}

// CUSTOM POST TYPES
function custom_post_type()
{
    $skills_post_type = 'skills';
    $skill_args = array(
        'labels'    => array(
        'name'          => __('Skills'),
        'singular_name' => __('Skill')
        ),
        'hirerarchical'     => true,
        'supports'          => array( 'title'),
        'public'            => true,
        'has_archive'       => true,
        'menu_position'     => 5,
        'rewrite'           => array( 'slug' => 'skills', 'with_front' => false )
    );

    register_post_type( $skills_post_type, $skill_args );
}

add_action( 'init', 'custom_post_type' );

?>