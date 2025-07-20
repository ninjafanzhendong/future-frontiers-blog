<?php
/**
 * Future Frontiers HQ Theme Functions
 * 
 * @package Future_Frontiers_HQ
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function ffhq_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo', array(
        'height' => 40,
        'width' => 40,
        'flex-height' => true,
        'flex-width' => true,
    ));
    
    // Add image sizes
    add_image_size('ffhq-featured', 800, 400, true);
    add_image_size('ffhq-card', 600, 400, true);
    add_image_size('ffhq-thumbnail', 150, 150, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'future-frontiers-hq'),
        'footer' => __('Footer Menu', 'future-frontiers-hq'),
    ));
    
    // Add theme support for post formats
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
    ));
}
add_action('after_setup_theme', 'ffhq_setup');

/**
 * Enqueue scripts and styles
 */
function ffhq_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('ffhq-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap', array(), null);
    
    // Enqueue theme styles
    wp_enqueue_style('ffhq-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue theme scripts
    wp_enqueue_script('ffhq-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('ffhq-script', 'ffhq_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ffhq_nonce'),
    ));
    
    // Enqueue comments script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ffhq_scripts');

/**
 * Register widget areas
 */
function ffhq_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'future-frontiers-hq'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'future-frontiers-hq'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer 1', 'future-frontiers-hq'),
        'id' => 'footer-1',
        'description' => __('Add footer widgets here.', 'future-frontiers-hq'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer 2', 'future-frontiers-hq'),
        'id' => 'footer-2',
        'description' => __('Add footer widgets here.', 'future-frontiers-hq'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer 3', 'future-frontiers-hq'),
        'id' => 'footer-3',
        'description' => __('Add footer widgets here.', 'future-frontiers-hq'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'ffhq_widgets_init');

/**
 * Custom excerpt length
 */
function ffhq_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'ffhq_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function ffhq_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ffhq_excerpt_more');

/**
 * Add category class to post
 */
function ffhq_add_category_class($classes) {
    global $post;
    foreach ((get_the_category($post->ID)) as $category) {
        $classes[] = 'category-' . $category->category_nicename;
    }
    return $classes;
}
add_filter('post_class', 'ffhq_add_category_class');

/**
 * Custom pagination
 */
function ffhq_pagination() {
    the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => __('Previous', 'future-frontiers-hq'),
        'next_text' => __('Next', 'future-frontiers-hq'),
    ));
}

/**
 * Get post category with color
 */
function ffhq_get_post_category() {
    $categories = get_the_category();
    if (!empty($categories)) {
        $category = $categories[0];
        $color = ffhq_get_category_color($category->term_id);
        return '<span class="post-category" style="background-color: ' . esc_attr($color) . '">' . esc_html($category->name) . '</span>';
    }
    return '';
}

/**
 * Get category color
 */
function ffhq_get_category_color($category_id) {
    $colors = array(
        'space-exploration' => '#3B82F6',
        'ai-robotics' => '#8B5CF6',
        'future-tech' => '#10B981',
        'innovation' => '#F59E0B',
        'neurotech' => '#6366F1',
        'climate-solutions' => '#14B8A6',
    );
    
    $category = get_category($category_id);
    $slug = $category->slug;
    
    return isset($colors[$slug]) ? $colors[$slug] : '#6B7280';
}

/**
 * Customizer settings
 */
function ffhq_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => __('Hero Section', 'future-frontiers-hq'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default' => 'The Future is Now',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'future-frontiers-hq'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Discover groundbreaking innovations, space exploration breakthroughs, and AI advancements shaping our tomorrow.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'future-frontiers-hq'),
        'section' => 'hero_section',
        'type' => 'textarea',
    ));
    
    // Newsletter Section
    $wp_customize->add_section('newsletter_section', array(
        'title' => __('Newsletter Section', 'future-frontiers-hq'),
        'priority' => 31,
    ));
    
    $wp_customize->add_setting('newsletter_title', array(
        'default' => 'Stay Ahead of the Future',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('newsletter_title', array(
        'label' => __('Newsletter Title', 'future-frontiers-hq'),
        'section' => 'newsletter_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('newsletter_subtitle', array(
        'default' => 'Get the latest breakthroughs in science and technology delivered to your inbox weekly.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('newsletter_subtitle', array(
        'label' => __('Newsletter Subtitle', 'future-frontiers-hq'),
        'section' => 'newsletter_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'ffhq_customize_register');

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Add async/defer attributes to enqueued scripts
 */
function ffhq_add_async_defer($tag, $handle, $src) {
    if ('ffhq-script' === $handle) {
        $tag = str_replace('<script', '<script defer', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'ffhq_add_async_defer', 10, 3);

/**
 * Add custom body classes
 */
function ffhq_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    if (is_home()) {
        $classes[] = 'blog-page';
    }
    return $classes;
}
add_filter('body_class', 'ffhq_body_classes');
