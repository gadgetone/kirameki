<?php

/* 最新JQueryへ置き換え */
function kirameki_jquery_load() {
    if ( !is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), '2.2.4', false );
    }
}
add_action( 'wp_enqueue_scripts', 'kirameki_jquery_load' );

/* 各種スクリプトのロード */
function kirameki_styles_load() {
    wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), null, 'all' );
    wp_enqueue_style( 'normalize', get_stylesheet_directory_uri() . '/asset/css/normalize.css', array(), null, 'all' );
    wp_enqueue_style( 'magnific-popup-css', get_stylesheet_directory_uri() . '/asset/css/magnific-popup.css', array(), null, 'all' );
    wp_enqueue_style( 'highlight-css', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/styles/solarized-light.min.css', array(), null, 'all' );
    wp_enqueue_script( 'jquery-magnific-popup-js', get_template_directory_uri() . '/asset/js/jquery.magnific-popup.min.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'jquery-inline-scripts', get_template_directory_uri() . '/asset/js/script.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'highlight-js', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js', array(), null, false );
}
add_action( 'wp_enqueue_scripts', 'kirameki_styles_load' );

/* JSの非同期ロード設定 */
if ( !is_admin() ) {
    function kirameki_script_load_async( $tag, $handle ) {
        if ( strpos( $handle, 'jquery' ) !== false ) {
            return str_replace( "type='text/javascript'", 'defer', $tag );
        }
        return str_replace( "type='text/javascript'", 'async', $tag );
    }
	add_filter( 'script_loader_tag', 'kirameki_script_load_async', 10, 3 );
}

include_once( 'widgets/widget-social-follow.php' );

function kirameki_setup() {
	register_nav_menu( 'primary-menu', 'ヘッダーのナビゲージョン' );
	add_theme_support( 'post-thumbnails' );

	$header_picture = array( 'flex-width' => true, 'width' => '250','flex-height' => true, 'height' => '80', 'default-image' => get_template_directory_uri() . '/logo.png', 'uploads' => true) ;
	add_theme_support( 'custom-header', $header_picture );
	add_theme_support( 'automatic-feed-links' );

	if ( ! isset($content_width) ) {
		$content_width = 760;
	}
	
	add_theme_support ( 'title-tag' );
	add_editor_style();
}
add_filter( 'after_setup_theme', 'kirameki_setup' );

function kirameki_widgets_init() {
    register_sidebar( array( 'name' => 'サイドバー', 'id' => 'sidebar-1', 'description' => '右サイドバーのウィジェット', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array('name' => 'フッター', 'id' => 'footer-1', 'description' => 'ふぉったーのウィジェット', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>') );
}
add_action( 'widgets_init', 'kirameki_widgets_init' );

function kirameki_popup_pics( $html ) {
    $class = 'lightbox';
    return str_replace( '<a ', '<a class="'. $class. '" ', $html );
}
add_filter( 'image_send_to_editor', 'kirameki_popup_pics' );

add_filter( 'comment_form_defaults', 'comment_form_custom' );
function comment_form_custom($defaults) {
    $defaults['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="コメントを入力"></textarea></p>';
    return $defaults;
}

function kirameki_setup_customizer($wp_customize) {
    $wp_customize->add_section( 'social_settings_section', array( 'title' => 'ソーシャルボタン設定', 'priority' => 90, 'description' => '記事前後にソーシャルボタンを設置できます。' ) );
    
    $wp_customize->add_setting( 'social_button_head', array( 'default' => true, 'sanitize_callback' => 'sanitize_checkbox' ) );
    $wp_customize->add_control( 'social_button_head_control', array( 'section' => 'social_settings_section', 'settings' => 'social_button_head', 'label' => '記事本文上部にソーシャルボタンを表示する', 'type' => 'checkbox', 'priority' => 10 ) );
	
	
	$wp_customize->add_section( 'footer_copyright_section', array('title' => 'コピーライト設定', 'priority' => 80, 'description' => 'フッターのコピーライト表記を設定します。' ) );
	
	$wp_customize->add_setting( 'footer_copyright', array( 'default' => 'Copyright © 2016 ' . get_bloginfo('name') . ', Powered by WordPress, Theme by gadgetone.', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'footer_copyright_control', array( 'section' => 'footer_copyright_section', 'settings' => 'footer_copyright', 'label' => 'フッターに表示するコピーライト表記:', 'type' => 'text', 'priority' => 10 ) );
}
add_action( 'customize_register', 'kirameki_setup_customizer' );

function is_social_button_visible() {
    return get_theme_mod( 'social_button_head', 'default' ) == 'default';
}
add_action( 'customize_register', 'is_social_button_visible' );

function get_footer_copyright() {
    $copyright_blogtitle = get_bloginfo( 'name' );
    return get_theme_mod( 'footer_copyright', 'Copyright © 2016 ' . $copyright_blogtitle . ', Powered by WordPress, Theme by gadgetone.' );
}
add_action( 'customize_register', 'get_footer_copyright' );

function sanitize_checkbox($input) {
    if ( true == $input) {
        return true;
    } else {
        return false;
	}
}

function half_one_func ($atts, $content = null) {
    $content = do_shortcode( shortcode_unautop( $content ) );
    return '<div class="article-half"><div class="half-one">' . $content . '</div>';
}
add_shortcode( 'half_one', 'half_one_func' );

function half_two_func ($atts, $content = null) {
    $content = do_shortcode( shortcode_unautop( $content ) );
    return '<div class="half-two">' . $content . '</div></div>';
}
add_shortcode( 'half_two', 'half_two_func' );

function syntax_highlight_code ($atts, $content = null) {
    $atts = shortcode_atts( array( 'class' => 'html' ), $atts, 'code' );
    return '<pre><code class="' . $atts['class'] . '">' . $content . '</code></pre>';
}
add_shortcode( 'code', 'syntax_highlight_code' );

function cc_mime_types ( $mimes )  { 
  $mimes [ 'svg' ]  =  'image/svg+xml' ; 
  return $mimes ; 
}
add_filter ( 'upload_mimes' ,  'cc_mime_types' ) ;

function fix_svg_thumb_display() {
  echo '
    td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
      width: 100% !important; 
      height: auto !important; 
    }
  ';
}