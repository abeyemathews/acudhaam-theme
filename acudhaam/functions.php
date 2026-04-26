<?php
/**
 * Acudhaam Theme Functions
 *
 * @package Acudhaam
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ==================================================
 * THEME SETUP
 * ==================================================
 */

/**
 * Theme setup function
 */
function acudhaam_setup() {
    // Add support for featured images
    add_theme_support('post-thumbnails');
    
    // Add support for title tag
    add_theme_support('title-tag');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Add support for HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Add support for custom header
    add_theme_support('custom-header', array(
        'default-image' => '',
        'width'         => 1920,
        'height'        => 1080,
        'flex-height'   => true,
    ));
    
    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'f8f5f0',
    ));
    
    // Add support for widgets refresh
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add support for align wide
    add_theme_support('align-wide');
    
    // Add support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'acudhaam'),
        'footer'  => __('Footer Menu', 'acudhaam'),
        'mobile'  => __('Mobile Menu', 'acudhaam'),
    ));
    
    // Set default content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'acudhaam_setup');

/**
 * ==================================================
 * ENQUEUE SCRIPTS AND STYLES
 * ==================================================
 */

/**
 * Enqueue scripts and styles
 */
function acudhaam_scripts() {
    // Get template directory URI
    $template_uri = get_template_directory_uri();
    
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Montserrat:wght@300;400;500;600&display=swap', array(), null);
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Enqueue main theme stylesheet
    wp_enqueue_style('acudhaam-main', $template_uri . '/assets/css/main.css', array(), '1.0.0');
    
    // Enqueue style.css as fallback
    wp_enqueue_style('acudhaam-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue jQuery
    wp_enqueue_script('jquery');
    
    // Enqueue main JavaScript
    wp_enqueue_script('acudhaam-main', $template_uri . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('acudhaam-main', 'acudhaam_ajax', array(
        'ajax_url'      => admin_url('admin-ajax.php'),
        'nonce'         => wp_create_nonce('acudhaam_nonce'),
        'template_url'  => $template_uri,
        'is_home'       => is_front_page() ? 'yes' : 'no',
    ));
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'acudhaam_scripts');

/**
 * ==================================================
 * WIDGET AREAS
 * ==================================================
 */

/**
 * Register Widget Areas
 */
function acudhaam_widgets_init() {
    // Sidebar
    register_sidebar(array(
        'name'          => __('Sidebar', 'acudhaam'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'acudhaam'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Footer Column 1
    register_sidebar(array(
        'name'          => __('Footer Column 1', 'acudhaam'),
        'id'            => 'footer-1',
        'description'   => __('Footer first column', 'acudhaam'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    // Footer Column 2
    register_sidebar(array(
        'name'          => __('Footer Column 2', 'acudhaam'),
        'id'            => 'footer-2',
        'description'   => __('Footer second column', 'acudhaam'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    // Footer Column 3
    register_sidebar(array(
        'name'          => __('Footer Column 3', 'acudhaam'),
        'id'            => 'footer-3',
        'description'   => __('Footer third column', 'acudhaam'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    // Footer Column 4
    register_sidebar(array(
        'name'          => __('Footer Column 4', 'acudhaam'),
        'id'            => 'footer-4',
        'description'   => __('Footer fourth column', 'acudhaam'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    // Banner Widget Area (for complex banners)
    register_sidebar(array(
        'name'          => __('Banner Area', 'acudhaam'),
        'id'            => 'banner-widget',
        'description'   => __('Add widgets to display in the banner area.', 'acudhaam'),
        'before_widget' => '<div id="%1$s" class="banner-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="banner-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'acudhaam_widgets_init');

/**
 * ==================================================
 * COMPLETE CUSTOMIZER SETTINGS WITH BANNER MANAGEMENT
 * ==================================================
 */

/**
 * Customizer settings
 */
function acudhaam_customize_register($wp_customize) {
    
    // ===== HERO SECTION =====
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Hero Section', 'acudhaam'),
        'priority' => 30,
        'description' => __('Customize the hero carousel content.', 'acudhaam'),
    ));
    
    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Acudhaam Pvt. Ltd.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'    => __('Hero Title', 'acudhaam'),
        'section'  => 'hero_section',
        'type'     => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'WHERE WELL‑BEING MEETS TRANQUILITY',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'    => __('Hero Subtitle', 'acudhaam'),
        'section'  => 'hero_section',
        'type'     => 'text',
    ));
    
    // Hero Background Image (for first slide)
    $wp_customize->add_setting('hero_background', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background', array(
        'label'    => __('Hero Background Image', 'acudhaam'),
        'description' => __('Background image for the first hero slide.', 'acudhaam'),
        'section'  => 'hero_section',
        'settings' => 'hero_background',
    )));
    
    // Hero Button Text
    $wp_customize->add_setting('hero_button_text', array(
        'default'           => 'Explore More',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_button_text', array(
        'label'    => __('Hero Button Text', 'acudhaam'),
        'section'  => 'hero_section',
        'type'     => 'text',
    ));
    
    // Hero Button URL
    $wp_customize->add_setting('hero_button_url', array(
        'default'           => '#about',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_button_url', array(
        'label'    => __('Hero Button URL', 'acudhaam'),
        'section'  => 'hero_section',
        'type'     => 'url',
    ));
    
    // ===== BANNER MANAGEMENT SECTION (COMPLETE) =====
    $wp_customize->add_section('banner_section', array(
        'title'    => __('Banner Management', 'acudhaam'),
        'priority' => 35,
        'description' => __('Manage all banners across the site. You can enable/disable banners, change text, upload images, and customize colors.', 'acudhaam'),
    ));
    
    // ===== CLINIC BANNER SETTINGS =====
    
    // Enable/Disable Clinic Banner
    $wp_customize->add_setting('clinic_banner_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('clinic_banner_enabled', array(
        'label'    => __('Enable Clinic Banner', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ));
    
    // Banner Type
    $wp_customize->add_setting('clinic_banner_type', array(
        'default'           => 'text',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('clinic_banner_type', array(
        'label'    => __('Banner Type', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'radio',
        'choices'  => array(
            'text'  => __('Text Banner (Gradient Background)', 'acudhaam'),
            'image' => __('Image Banner (Upload Image)', 'acudhaam'),
        ),
        'priority' => 20,
    ));
    
    // Banner Image
    $wp_customize->add_setting('clinic_banner_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'clinic_banner_image', array(
        'label'    => __('Banner Image', 'acudhaam'),
        'description' => __('Upload an image for the banner (recommended size: 1920x300px)', 'acudhaam'),
        'section'  => 'banner_section',
        'settings' => 'clinic_banner_image',
        'priority' => 30,
    )));
    
    // Banner Title
    $wp_customize->add_setting('clinic_banner_title', array(
        'default'           => 'INDIAN CLASSICAL ACUPUNCTURE CLINIC',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('clinic_banner_title', array(
        'label'    => __('Banner Title', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'text',
        'priority' => 40,
    ));
    
    // Banner Subtitle (Tamil)
    $wp_customize->add_setting('clinic_banner_subtitle_tamil', array(
        'default'           => 'குழித்தி ஊழியன், மாலணில், விஜயமணபூர்வ',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('clinic_banner_subtitle_tamil', array(
        'label'    => __('Banner Subtitle (Tamil)', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'text',
        'priority' => 50,
    ));
    
    // Banner Address
    $wp_customize->add_setting('clinic_banner_address', array(
        'default'           => 'Kurishadi Junction, Nalanchira, Thiruvananthapuram',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('clinic_banner_address', array(
        'label'    => __('Banner Address', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'text',
        'priority' => 60,
    ));
    
    // ===== BANNER STYLING =====
    
    // Banner Background Color/Gradient
    $wp_customize->add_setting('clinic_banner_bg_color', array(
        'default'           => 'linear-gradient(90deg, #222051, #1e3556, #02565f, #15465c, #232353)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('clinic_banner_bg_color', array(
        'label'    => __('Banner Background Color/Gradient', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'text',
        'description' => __('Use CSS gradient or color value (e.g., #ff0000 or linear-gradient(...))', 'acudhaam'),
        'priority' => 70,
    ));
    
    // Banner Text Color
    $wp_customize->add_setting('clinic_banner_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'clinic_banner_text_color', array(
        'label'    => __('Banner Text Color', 'acudhaam'),
        'section'  => 'banner_section',
        'settings' => 'clinic_banner_text_color',
        'priority' => 80,
    )));
    
    // Banner Title Color
    $wp_customize->add_setting('clinic_banner_title_color', array(
        'default'           => '#d4af37',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'clinic_banner_title_color', array(
        'label'    => __('Banner Title Color', 'acudhaam'),
        'section'  => 'banner_section',
        'settings' => 'clinic_banner_title_color',
        'priority' => 90,
    )));
    
    // ===== BANNER BUTTON SETTINGS =====
    
    // Enable Banner Button
    $wp_customize->add_setting('clinic_banner_button_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('clinic_banner_button_enabled', array(
        'label'    => __('Enable Banner Button', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'checkbox',
        'priority' => 100,
    ));
    
    // Button Text
    $wp_customize->add_setting('clinic_banner_button_text', array(
        'default'           => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('clinic_banner_button_text', array(
        'label'    => __('Banner Button Text', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'text',
        'priority' => 110,
    ));
    
    // Button URL
    $wp_customize->add_setting('clinic_banner_button_url', array(
        'default'           => '#clinics',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('clinic_banner_button_url', array(
        'label'    => __('Banner Button URL', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'url',
        'priority' => 120,
    ));
    
    // Button Text Color
    $wp_customize->add_setting('clinic_banner_button_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'clinic_banner_button_color', array(
        'label'    => __('Button Text Color', 'acudhaam'),
        'section'  => 'banner_section',
        'settings' => 'clinic_banner_button_color',
        'priority' => 130,
    )));
    
    // Button Border Color
    $wp_customize->add_setting('clinic_banner_button_border_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'clinic_banner_button_border_color', array(
        'label'    => __('Button Border Color', 'acudhaam'),
        'section'  => 'banner_section',
        'settings' => 'clinic_banner_button_border_color',
        'priority' => 140,
    )));
    
    // ===== SECONDARY PROMOTION BANNER =====
    
    // Enable Secondary Banner
    $wp_customize->add_setting('secondary_banner_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('secondary_banner_enabled', array(
        'label'    => __('Enable Secondary Promotion Banner', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'checkbox',
        'priority' => 200,
    ));
    
    // Secondary Banner Text
    $wp_customize->add_setting('secondary_banner_text', array(
        'default'           => 'Special Offer: 20% off on first consultation',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('secondary_banner_text', array(
        'label'    => __('Promotion Banner Text', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'text',
        'priority' => 210,
    ));
    
    // Secondary Banner Link
    $wp_customize->add_setting('secondary_banner_link', array(
        'default'           => '#contact-section',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('secondary_banner_link', array(
        'label'    => __('Promotion Banner Link', 'acudhaam'),
        'section'  => 'banner_section',
        'type'     => 'url',
        'priority' => 220,
    ));
    
    // Secondary Banner Background Color
    $wp_customize->add_setting('secondary_banner_bg_color', array(
        'default'           => '#d4af37',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_banner_bg_color', array(
        'label'    => __('Promotion Banner Background', 'acudhaam'),
        'section'  => 'banner_section',
        'settings' => 'secondary_banner_bg_color',
        'priority' => 230,
    )));
    
    // ===== CONTACT SECTION =====
    $wp_customize->add_section('contact_section', array(
        'title'    => __('Contact Information', 'acudhaam'),
        'priority' => 40,
        'description' => __('Set your contact details and social media links.', 'acudhaam'),
    ));
    
    // Contact Phone
    $wp_customize->add_setting('contact_phone', array(
        'default'           => '+91 77366 85613',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label'    => __('Phone Number', 'acudhaam'),
        'section'  => 'contact_section',
        'type'     => 'text',
    ));
    
    // Contact Email
    $wp_customize->add_setting('contact_email', array(
        'default'           => 'enquiry@acudhaam.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'    => __('Email Address', 'acudhaam'),
        'section'  => 'contact_section',
        'type'     => 'email',
    ));
    
    // Contact Address
    $wp_customize->add_setting('contact_address', array(
        'default'           => 'Acudhaam House, Kurishadi Junction, Nalanchira, Thiruvananthapuram - 695015',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label'    => __('Address', 'acudhaam'),
        'section'  => 'contact_section',
        'type'     => 'textarea',
    ));
    
    // Social Media Links
    $wp_customize->add_setting('facebook_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('facebook_url', array(
        'label'    => __('Facebook URL', 'acudhaam'),
        'section'  => 'contact_section',
        'type'     => 'url',
    ));
    
    $wp_customize->add_setting('twitter_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('twitter_url', array(
        'label'    => __('Twitter/X URL', 'acudhaam'),
        'section'  => 'contact_section',
        'type'     => 'url',
    ));
    
    $wp_customize->add_setting('instagram_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('instagram_url', array(
        'label'    => __('Instagram URL', 'acudhaam'),
        'section'  => 'contact_section',
        'type'     => 'url',
    ));
    
    $wp_customize->add_setting('youtube_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('youtube_url', array(
        'label'    => __('YouTube URL', 'acudhaam'),
        'section'  => 'contact_section',
        'type'     => 'url',
    ));
    
    $wp_customize->add_setting('linkedin_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkedin_url', array(
        'label'    => __('LinkedIn URL', 'acudhaam'),
        'section'  => 'contact_section',
        'type'     => 'url',
    ));
    
    // ===== COLORS SECTION =====
    $wp_customize->add_section('colors_section', array(
        'title'    => __('Theme Colors', 'acudhaam'),
        'priority' => 50,
    ));
    
    // Accent Gold Color
    $wp_customize->add_setting('accent_gold_color', array(
        'default'           => '#d4af37',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_gold_color', array(
        'label'    => __('Accent Gold Color', 'acudhaam'),
        'section'  => 'colors_section',
        'settings' => 'accent_gold_color',
    )));
    
    // Gradient Color 1
    $wp_customize->add_setting('gradient_color_1', array(
        'default'           => '#222051',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gradient_color_1', array(
        'label'    => __('Gradient Color 1', 'acudhaam'),
        'section'  => 'colors_section',
        'settings' => 'gradient_color_1',
    )));
    
    // Gradient Color 2
    $wp_customize->add_setting('gradient_color_2', array(
        'default'           => '#02565f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gradient_color_2', array(
        'label'    => __('Gradient Color 2', 'acudhaam'),
        'section'  => 'colors_section',
        'settings' => 'gradient_color_2',
    )));
    
    // ===== SELECTIVE REFRESH =====
    if (isset($wp_customize->selective_refresh)) {
        // Hero Title
        $wp_customize->selective_refresh->add_partial('hero_title', array(
            'selector' => '.slide-content h1',
            'render_callback' => function() {
                return get_theme_mod('hero_title', 'Acudhaam Pvt. Ltd.');
            }
        ));
        
        // Hero Subtitle
        $wp_customize->selective_refresh->add_partial('hero_subtitle', array(
            'selector' => '.slide-subtitle',
            'render_callback' => function() {
                return get_theme_mod('hero_subtitle', 'WHERE WELL‑BEING MEETS TRANQUILITY');
            }
        ));
        
        // Banner Title
        $wp_customize->selective_refresh->add_partial('clinic_banner_title', array(
            'selector' => '.clinic-title',
            'render_callback' => function() {
                return get_theme_mod('clinic_banner_title', 'INDIAN CLASSICAL ACUPUNCTURE CLINIC');
            }
        ));
        
        // Banner Subtitle (Tamil)
        $wp_customize->selective_refresh->add_partial('clinic_banner_subtitle_tamil', array(
            'selector' => '.clinic-address-tamil',
            'render_callback' => function() {
                return get_theme_mod('clinic_banner_subtitle_tamil', 'குழித்தி ஊழியன், மாலணில், விஜயமணபூர்வ');
            }
        ));
        
        // Banner Address
        $wp_customize->selective_refresh->add_partial('clinic_banner_address', array(
            'selector' => '.clinic-address',
            'render_callback' => function() {
                return get_theme_mod('clinic_banner_address', 'Kurishadi Junction, Nalanchira, Thiruvananthapuram');
            }
        ));
        
        // Contact Phone
        $wp_customize->selective_refresh->add_partial('contact_phone', array(
            'selector' => '.contact-info-top a[href^="tel"] span, .contact-detail .phone-number',
            'render_callback' => function() {
                return get_theme_mod('contact_phone', '+91 77366 85613');
            }
        ));
        
        // Contact Email
        $wp_customize->selective_refresh->add_partial('contact_email', array(
            'selector' => '.contact-info-top a[href^="mailto"] span, .contact-detail .email-address',
            'render_callback' => function() {
                return get_theme_mod('contact_email', 'enquiry@acudhaam.com');
            }
        ));
    }
}
add_action('customize_register', 'acudhaam_customize_register');

/**
 * Customizer CSS output with banner styles
 */
function acudhaam_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            <?php if (get_theme_mod('accent_gold_color')) : ?>
            --accent-gold: <?php echo esc_attr(get_theme_mod('accent_gold_color')); ?>;
            <?php endif; ?>
            
            <?php if (get_theme_mod('gradient_color_1')) : ?>
            --gradient-color1: <?php echo esc_attr(get_theme_mod('gradient_color_1')); ?>;
            <?php endif; ?>
            
            <?php if (get_theme_mod('gradient_color_2')) : ?>
            --gradient-color3: <?php echo esc_attr(get_theme_mod('gradient_color_2')); ?>;
            <?php endif; ?>
        }
        
        /* Clinic Banner Styles */
        .clinic-banner {
            background: <?php echo esc_attr(get_theme_mod('clinic_banner_bg_color', 'linear-gradient(90deg, #222051, #1e3556, #02565f, #15465c, #232353)')); ?>;
            color: <?php echo esc_attr(get_theme_mod('clinic_banner_text_color', '#ffffff')); ?>;
        }
        
        .clinic-banner.image-banner {
            <?php if (get_theme_mod('clinic_banner_type') == 'image' && get_theme_mod('clinic_banner_image')) : ?>
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?php echo esc_url(get_theme_mod('clinic_banner_image')); ?>') !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            <?php endif; ?>
        }
        
        .clinic-title {
            color: <?php echo esc_attr(get_theme_mod('clinic_banner_title_color', '#d4af37')); ?>;
        }
        
        .clinic-address-tamil,
        .clinic-address {
            color: <?php echo esc_attr(get_theme_mod('clinic_banner_text_color', '#ffffff')); ?>;
        }
        
        .banner-button .btn-secondary {
            color: <?php echo esc_attr(get_theme_mod('clinic_banner_button_color', '#ffffff')); ?>;
            border-color: <?php echo esc_attr(get_theme_mod('clinic_banner_button_border_color', '#ffffff')); ?>;
        }
        
        .banner-button .btn-secondary:hover {
            background: <?php echo esc_attr(get_theme_mod('clinic_banner_button_color', '#ffffff')); ?>;
            color: <?php echo esc_attr(get_theme_mod('clinic_banner_bg_color', '#222051')); ?>;
        }
        
        /* Secondary Banner */
        .secondary-banner {
            background: <?php echo esc_attr(get_theme_mod('secondary_banner_bg_color', '#d4af37')); ?>;
            display: <?php echo get_theme_mod('secondary_banner_enabled', false) ? 'block' : 'none'; ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'acudhaam_customizer_css');

/**
 * Custom function to get hero background
 */
function acudhaam_get_hero_background() {
    $hero_bg = get_theme_mod('hero_background');
    if ($hero_bg) {
        return esc_url($hero_bg);
    }
    return esc_url(get_template_directory_uri() . '/assets/images/a04.jpg');
}

/**
 * ==================================================
 * BANNER HELPER FUNCTIONS
 * ==================================================
 */

/**
 * Check if clinic banner should display
 */
function acudhaam_display_clinic_banner() {
    $display = false;
    
    if (is_front_page() && get_theme_mod('clinic_banner_enabled', true)) {
        $display = true;
    }
    
    return apply_filters('acudhaam_display_clinic_banner', $display);
}

/**
 * Get clinic banner classes
 */
function acudhaam_clinic_banner_classes() {
    $classes = array('clinic-banner');
    
    if (get_theme_mod('clinic_banner_button_enabled', false)) {
        $classes[] = 'has-button';
    }
    
    if (get_theme_mod('clinic_banner_type') == 'image') {
        $classes[] = 'image-banner';
    }
    
    echo esc_attr(implode(' ', $classes));
}

/**
 * ==================================================
 * CUSTOM POST TYPES
 * ==================================================
 */

/**
 * Register Custom Post Types
 */
function acudhaam_register_cpt() {
    
    // ===== Clinics CPT =====
    $clinic_labels = array(
        'name'               => __('Clinics', 'acudhaam'),
        'singular_name'      => __('Clinic', 'acudhaam'),
        'add_new'            => __('Add New Clinic', 'acudhaam'),
        'add_new_item'       => __('Add New Clinic', 'acudhaam'),
        'edit_item'          => __('Edit Clinic', 'acudhaam'),
        'new_item'           => __('New Clinic', 'acudhaam'),
        'view_item'          => __('View Clinic', 'acudhaam'),
        'search_items'       => __('Search Clinics', 'acudhaam'),
        'not_found'          => __('No clinics found', 'acudhaam'),
        'not_found_in_trash' => __('No clinics found in trash', 'acudhaam'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Clinics', 'acudhaam'),
    );
    
    $clinic_args = array(
        'labels'             => $clinic_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'clinic'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-location',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );
    register_post_type('clinic', $clinic_args);
    
    // ===== Testimonials CPT =====
    $testimonial_labels = array(
        'name'               => __('Testimonials', 'acudhaam'),
        'singular_name'      => __('Testimonial', 'acudhaam'),
        'add_new'            => __('Add New Testimonial', 'acudhaam'),
        'add_new_item'       => __('Add New Testimonial', 'acudhaam'),
        'edit_item'          => __('Edit Testimonial', 'acudhaam'),
        'new_item'           => __('New Testimonial', 'acudhaam'),
        'view_item'          => __('View Testimonial', 'acudhaam'),
        'search_items'       => __('Search Testimonials', 'acudhaam'),
        'not_found'          => __('No testimonials found', 'acudhaam'),
        'not_found_in_trash' => __('No testimonials found in trash', 'acudhaam'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Testimonials', 'acudhaam'),
    );
    
    $testimonial_args = array(
        'labels'             => $testimonial_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonial'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_rest'       => true,
    );
    register_post_type('testimonial', $testimonial_args);
    
    // ===== Team Members CPT =====
    $team_labels = array(
        'name'               => __('Team', 'acudhaam'),
        'singular_name'      => __('Team Member', 'acudhaam'),
        'add_new'            => __('Add New Member', 'acudhaam'),
        'add_new_item'       => __('Add New Team Member', 'acudhaam'),
        'edit_item'          => __('Edit Team Member', 'acudhaam'),
        'new_item'           => __('New Team Member', 'acudhaam'),
        'view_item'          => __('View Team Member', 'acudhaam'),
        'search_items'       => __('Search Team', 'acudhaam'),
        'not_found'          => __('No team members found', 'acudhaam'),
        'not_found_in_trash' => __('No team members found in trash', 'acudhaam'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Team', 'acudhaam'),
    );
    
    $team_args = array(
        'labels'             => $team_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'team-member'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 22,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );
    register_post_type('team_member', $team_args);
    
    // ===== Courses CPT =====
    $course_labels = array(
        'name'               => __('Courses', 'acudhaam'),
        'singular_name'      => __('Course', 'acudhaam'),
        'add_new'            => __('Add New Course', 'acudhaam'),
        'add_new_item'       => __('Add New Course', 'acudhaam'),
        'edit_item'          => __('Edit Course', 'acudhaam'),
        'new_item'           => __('New Course', 'acudhaam'),
        'view_item'          => __('View Course', 'acudhaam'),
        'search_items'       => __('Search Courses', 'acudhaam'),
        'not_found'          => __('No courses found', 'acudhaam'),
        'not_found_in_trash' => __('No courses found in trash', 'acudhaam'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Courses', 'acudhaam'),
    );
    
    $course_args = array(
        'labels'             => $course_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'course'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 23,
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );
    register_post_type('course', $course_args);
}
add_action('init', 'acudhaam_register_cpt');

/* ------------------------------------------------------------------------ */
/*  DYNAMIC HERO SLIDES (Custom Post Type)
/* ------------------------------------------------------------------------ */

/**
 * Register Hero Slide CPT
 */
function acudhaam_register_hero_slide_cpt() {
    $labels = array(
        'name'               => __('Hero Slides', 'acudhaam'),
        'singular_name'      => __('Hero Slide', 'acudhaam'),
        'add_new'            => __('Add New Slide', 'acudhaam'),
        'add_new_item'       => __('Add New Hero Slide', 'acudhaam'),
        'edit_item'          => __('Edit Hero Slide', 'acudhaam'),
        'new_item'           => __('New Hero Slide', 'acudhaam'),
        'view_item'          => __('View Hero Slide', 'acudhaam'),
        'search_items'       => __('Search Hero Slides', 'acudhaam'),
        'not_found'          => __('No slides found', 'acudhaam'),
        'not_found_in_trash' => __('No slides found in trash', 'acudhaam'),
        'menu_name'          => __('Hero Slides', 'acudhaam'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => false,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 20, // after other CPTs
        'menu_icon'           => 'dashicons-slides',
        'supports'            => array('title', 'thumbnail', 'page-attributes'),
        'show_in_rest'        => true,
    );

    register_post_type('hero_slide', $args);
}
add_action('init', 'acudhaam_register_hero_slide_cpt');

/**
 * Add Meta Box for hero slide fields
 */
function acudhaam_hero_slide_meta_boxes() {
    add_meta_box(
        'hero_slide_details',
        __('Slide Content', 'acudhaam'),
        'acudhaam_hero_slide_meta_box',
        'hero_slide',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'acudhaam_hero_slide_meta_boxes');

/**
 * Meta Box Callback for hero slides
 */
function acudhaam_hero_slide_meta_box($post) {
    wp_nonce_field('acudhaam_hero_slide_meta', 'acudhaam_hero_slide_meta_nonce');

    $subtitle      = get_post_meta($post->ID, '_hero_slide_subtitle', true);
    $description   = get_post_meta($post->ID, '_hero_slide_description', true);
    $button_text   = get_post_meta($post->ID, '_hero_slide_button_text', true);
    $button_url    = get_post_meta($post->ID, '_hero_slide_button_url', true);
    $overlay_opacity = get_post_meta($post->ID, '_hero_slide_overlay_opacity', true);
    ?>
    <p>
        <label for="hero_slide_subtitle"><?php _e('Subtitle', 'acudhaam'); ?></label><br>
        <input type="text" id="hero_slide_subtitle" name="hero_slide_subtitle" value="<?php echo esc_attr($subtitle); ?>" style="width:100%;">
    </p>
    <p>
        <label for="hero_slide_description"><?php _e('Description', 'acudhaam'); ?></label><br>
        <textarea id="hero_slide_description" name="hero_slide_description" rows="3" style="width:100%;"><?php echo esc_textarea($description); ?></textarea>
    </p>
    <p>
        <label for="hero_slide_button_text"><?php _e('Button Text', 'acudhaam'); ?></label><br>
        <input type="text" id="hero_slide_button_text" name="hero_slide_button_text" value="<?php echo esc_attr($button_text); ?>" style="width:100%;">
    </p>
    <p>
        <label for="hero_slide_button_url"><?php _e('Button URL', 'acudhaam'); ?></label><br>
        <input type="url" id="hero_slide_button_url" name="hero_slide_button_url" value="<?php echo esc_url($button_url); ?>" style="width:100%;">
    </p>
    <p>
        <label for="hero_slide_overlay_opacity"><?php _e('Overlay Opacity (0-1)', 'acudhaam'); ?></label><br>
        <input type="number" id="hero_slide_overlay_opacity" name="hero_slide_overlay_opacity" value="<?php echo esc_attr($overlay_opacity ?: '0.65'); ?>" step="0.05" min="0" max="1" style="width:100px;">
    </p>
    <?php
}

/**
 * Save hero slide meta data
 */
function acudhaam_save_hero_slide_meta($post_id) {
    if (!isset($_POST['acudhaam_hero_slide_meta_nonce']) || !wp_verify_nonce($_POST['acudhaam_hero_slide_meta_nonce'], 'acudhaam_hero_slide_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'hero_slide_subtitle'    => 'sanitize_text_field',
        'hero_slide_description' => 'sanitize_textarea_field',
        'hero_slide_button_text' => 'sanitize_text_field',
        'hero_slide_button_url'  => 'esc_url_raw',
        'hero_slide_overlay_opacity' => 'sanitize_text_field',
    );

    foreach ($fields as $field => $sanitize_callback) {
        if (isset($_POST[$field])) {
            $value = call_user_func($sanitize_callback, $_POST[$field]);
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
}
add_action('save_post', 'acudhaam_save_hero_slide_meta');

/**
 * Helper function to get hero slides
 */
function acudhaam_get_hero_slides() {
    $slides = new WP_Query(array(
        'post_type'      => 'hero_slide',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ));
    return $slides;
}

/* ==================================================
   META BOXES (existing for clinics, team, testimonials, courses)
   ================================================== */

/**
 * Add meta boxes for CPTs
 */
function acudhaam_add_meta_boxes() {
    // Clinic meta box
    add_meta_box(
        'clinic_details',
        __('Clinic Details', 'acudhaam'),
        'acudhaam_clinic_meta_box',
        'clinic',
        'normal',
        'high'
    );
    
    // Team member meta box
    add_meta_box(
        'team_member_details',
        __('Team Member Details', 'acudhaam'),
        'acudhaam_team_meta_box',
        'team_member',
        'normal',
        'high'
    );
    
    // Testimonial meta box
    add_meta_box(
        'testimonial_details',
        __('Testimonial Details', 'acudhaam'),
        'acudhaam_testimonial_meta_box',
        'testimonial',
        'normal',
        'high'
    );
    
    // Course meta box
    add_meta_box(
        'course_details',
        __('Course Details', 'acudhaam'),
        'acudhaam_course_meta_box',
        'course',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'acudhaam_add_meta_boxes');

/**
 * Clinic meta box callback
 */
function acudhaam_clinic_meta_box($post) {
    wp_nonce_field('acudhaam_save_meta', 'acudhaam_meta_nonce');
    
    $phone = get_post_meta($post->ID, 'clinic_phone', true);
    $email = get_post_meta($post->ID, 'clinic_email', true);
    $address = get_post_meta($post->ID, 'clinic_address', true);
    $city = get_post_meta($post->ID, 'clinic_city', true);
    ?>
    <p>
        <label for="clinic_phone"><?php _e('Phone Number:', 'acudhaam'); ?></label>
        <input type="text" id="clinic_phone" name="clinic_phone" value="<?php echo esc_attr($phone); ?>" class="widefat">
    </p>
    <p>
        <label for="clinic_email"><?php _e('Email:', 'acudhaam'); ?></label>
        <input type="email" id="clinic_email" name="clinic_email" value="<?php echo esc_attr($email); ?>" class="widefat">
    </p>
    <p>
        <label for="clinic_address"><?php _e('Address:', 'acudhaam'); ?></label>
        <textarea id="clinic_address" name="clinic_address" class="widefat" rows="3"><?php echo esc_textarea($address); ?></textarea>
    </p>
    <p>
        <label for="clinic_city"><?php _e('City:', 'acudhaam'); ?></label>
        <input type="text" id="clinic_city" name="clinic_city" value="<?php echo esc_attr($city); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Team member meta box callback
 */
function acudhaam_team_meta_box($post) {
    wp_nonce_field('acudhaam_save_meta', 'acudhaam_meta_nonce');
    
    $position = get_post_meta($post->ID, 'position', true);
    $linkedin = get_post_meta($post->ID, 'linkedin', true);
    $twitter = get_post_meta($post->ID, 'twitter', true);
    ?>
    <p>
        <label for="position"><?php _e('Position/Title:', 'acudhaam'); ?></label>
        <input type="text" id="position" name="position" value="<?php echo esc_attr($position); ?>" class="widefat">
    </p>
    <p>
        <label for="linkedin"><?php _e('LinkedIn URL:', 'acudhaam'); ?></label>
        <input type="url" id="linkedin" name="linkedin" value="<?php echo esc_attr($linkedin); ?>" class="widefat">
    </p>
    <p>
        <label for="twitter"><?php _e('Twitter URL:', 'acudhaam'); ?></label>
        <input type="url" id="twitter" name="twitter" value="<?php echo esc_attr($twitter); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Testimonial meta box callback
 */
function acudhaam_testimonial_meta_box($post) {
    wp_nonce_field('acudhaam_save_meta', 'acudhaam_meta_nonce');
    
    $location = get_post_meta($post->ID, 'location', true);
    $rating = get_post_meta($post->ID, 'rating', true);
    ?>
    <p>
        <label for="location"><?php _e('Location:', 'acudhaam'); ?></label>
        <input type="text" id="location" name="location" value="<?php echo esc_attr($location); ?>" class="widefat">
    </p>
    <p>
        <label for="rating"><?php _e('Rating (1-5):', 'acudhaam'); ?></label>
        <input type="number" id="rating" name="rating" value="<?php echo esc_attr($rating); ?>" min="1" max="5" class="widefat">
    </p>
    <?php
}

/**
 * Course meta box callback
 */
function acudhaam_course_meta_box($post) {
    wp_nonce_field('acudhaam_save_meta', 'acudhaam_meta_nonce');
    
    $duration = get_post_meta($post->ID, 'course_duration', true);
    $level = get_post_meta($post->ID, 'course_level', true);
    $price = get_post_meta($post->ID, 'course_price', true);
    ?>
    <p>
        <label for="course_duration"><?php _e('Duration:', 'acudhaam'); ?></label>
        <input type="text" id="course_duration" name="course_duration" value="<?php echo esc_attr($duration); ?>" class="widefat" placeholder="e.g., 3 years">
    </p>
    <p>
        <label for="course_level"><?php _e('Level:', 'acudhaam'); ?></label>
        <select id="course_level" name="course_level" class="widefat">
            <option value=""><?php _e('Select Level', 'acudhaam'); ?></option>
            <option value="Beginner" <?php selected($level, 'Beginner'); ?>><?php _e('Beginner', 'acudhaam'); ?></option>
            <option value="Intermediate" <?php selected($level, 'Intermediate'); ?>><?php _e('Intermediate', 'acudhaam'); ?></option>
            <option value="Advanced" <?php selected($level, 'Advanced'); ?>><?php _e('Advanced', 'acudhaam'); ?></option>
            <option value="Professional" <?php selected($level, 'Professional'); ?>><?php _e('Professional', 'acudhaam'); ?></option>
        </select>
    </p>
    <p>
        <label for="course_price"><?php _e('Price:', 'acudhaam'); ?></label>
        <input type="text" id="course_price" name="course_price" value="<?php echo esc_attr($price); ?>" class="widefat" placeholder="e.g., ₹50,000">
    </p>
    <?php
}

/**
 * Save meta box data for clinics, team, testimonials, courses
 */
function acudhaam_save_meta_box($post_id) {
    // Check nonce
    if (!isset($_POST['acudhaam_meta_nonce']) || !wp_verify_nonce($_POST['acudhaam_meta_nonce'], 'acudhaam_save_meta')) {
        return;
    }
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save clinic fields
    if (isset($_POST['clinic_phone'])) {
        update_post_meta($post_id, 'clinic_phone', sanitize_text_field($_POST['clinic_phone']));
    }
    if (isset($_POST['clinic_email'])) {
        update_post_meta($post_id, 'clinic_email', sanitize_email($_POST['clinic_email']));
    }
    if (isset($_POST['clinic_address'])) {
        update_post_meta($post_id, 'clinic_address', sanitize_textarea_field($_POST['clinic_address']));
    }
    if (isset($_POST['clinic_city'])) {
        update_post_meta($post_id, 'clinic_city', sanitize_text_field($_POST['clinic_city']));
    }
    
    // Save team fields
    if (isset($_POST['position'])) {
        update_post_meta($post_id, 'position', sanitize_text_field($_POST['position']));
    }
    if (isset($_POST['linkedin'])) {
        update_post_meta($post_id, 'linkedin', esc_url_raw($_POST['linkedin']));
    }
    if (isset($_POST['twitter'])) {
        update_post_meta($post_id, 'twitter', esc_url_raw($_POST['twitter']));
    }
    
    // Save testimonial fields
    if (isset($_POST['location'])) {
        update_post_meta($post_id, 'location', sanitize_text_field($_POST['location']));
    }
    if (isset($_POST['rating'])) {
        update_post_meta($post_id, 'rating', intval($_POST['rating']));
    }
    
    // Save course fields
    if (isset($_POST['course_duration'])) {
        update_post_meta($post_id, 'course_duration', sanitize_text_field($_POST['course_duration']));
    }
    if (isset($_POST['course_level'])) {
        update_post_meta($post_id, 'course_level', sanitize_text_field($_POST['course_level']));
    }
    if (isset($_POST['course_price'])) {
        update_post_meta($post_id, 'course_price', sanitize_text_field($_POST['course_price']));
    }
}
add_action('save_post', 'acudhaam_save_meta_box');

/**
 * ==================================================
 * IMAGE SIZES
 * ==================================================
 */

/**
 * Add custom image sizes
 */
function acudhaam_add_image_sizes() {
    add_image_size('clinic-thumb', 800, 600, true);
    add_image_size('team-square', 300, 300, true);
    add_image_size('testimonial-small', 100, 100, true);
    add_image_size('hero-slide', 1920, 1080, true);
    add_image_size('course-thumb', 600, 400, true);
    add_image_size('banner-image', 1920, 300, true);
}
add_action('after_setup_theme', 'acudhaam_add_image_sizes');

/**
 * ==================================================
 * MENU FALLBACKS
 * ==================================================
 */

/**
 * Footer menu fallback
 */
function acudhaam_footer_menu_fallback() {
    ?>
    <a href="#about"><i class="fas fa-chevron-right"></i> <?php _e('About Us', 'acudhaam'); ?></a>
    <a href="#clinics"><i class="fas fa-chevron-right"></i> <?php _e('Clinics', 'acudhaam'); ?></a>
    <a href="#institute-detailed"><i class="fas fa-chevron-right"></i> <?php _e('Institute', 'acudhaam'); ?></a>
    <a href="#organics-detailed"><i class="fas fa-chevron-right"></i> <?php _e('Organics', 'acudhaam'); ?></a>
    <a href="#testimonials"><i class="fas fa-chevron-right"></i> <?php _e('Testimonials', 'acudhaam'); ?></a>
    <?php
}

/**
 * Mobile menu fallback
 */
function acudhaam_mobile_menu_fallback() {
    ?>
    <a href="#home" class="mobile-menu-link"><i class="fas fa-home"></i><span><?php _e('Home', 'acudhaam'); ?></span></a>
    <a href="#about" class="mobile-menu-link"><i class="fas fa-info-circle"></i><span><?php _e('About', 'acudhaam'); ?></span></a>
    <a href="#clinics" class="mobile-menu-link"><i class="fas fa-map-marker-alt"></i><span><?php _e('Clinics', 'acudhaam'); ?></span></a>
    <a href="#institute-detailed" class="mobile-menu-link"><i class="fas fa-graduation-cap"></i><span><?php _e('Institute', 'acudhaam'); ?></span></a>
    <a href="#organics-detailed" class="mobile-menu-link"><i class="fas fa-leaf"></i><span><?php _e('Organics', 'acudhaam'); ?></span></a>
    <a href="#testimonials" class="mobile-menu-link"><i class="fas fa-star"></i><span><?php _e('Testimonials', 'acudhaam'); ?></span></a>
    <a href="#team" class="mobile-menu-link"><i class="fas fa-users"></i><span><?php _e('Our Team', 'acudhaam'); ?></span></a>
    <a href="#contact-section" class="mobile-menu-link"><i class="fas fa-envelope"></i><span><?php _e('Contact', 'acudhaam'); ?></span></a>
    <?php
}

/**
 * ==================================================
 * CONTACT FORM HANDLER
 * ==================================================
 */

/**
 * Handle contact form submission
 */
function acudhaam_handle_contact() {
    // Verify nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'acudhaam_contact')) {
        wp_send_json_error('Invalid security token');
    }
    
    // Get and sanitize form data
    $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email   = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone   = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error('Please fill in all required fields');
    }
    
    if (!is_email($email)) {
        wp_send_json_error('Please enter a valid email address');
    }
    
    // Prepare email
    $to = get_theme_mod('contact_email', 'enquiry@acudhaam.com');
    $subject = sprintf(__('New Contact Form Submission from %s', 'acudhaam'), $name);
    
    $body = sprintf(__("Name: %s\n", 'acudhaam'), $name);
    $body .= sprintf(__("Email: %s\n", 'acudhaam'), $email);
    $body .= sprintf(__("Phone: %s\n\n", 'acudhaam'), $phone);
    $body .= sprintf(__("Message:\n%s\n", 'acudhaam'), $message);
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );
    
    // Send email
    $sent = wp_mail($to, $subject, $body, $headers);
    
    if ($sent) {
        wp_send_json_success(__('Thank you! Your message has been sent.', 'acudhaam'));
    } else {
        wp_send_json_error(__('Sorry, there was an error sending your message. Please try again later.', 'acudhaam'));
    }
}
add_action('wp_ajax_acudhaam_contact', 'acudhaam_handle_contact');
add_action('wp_ajax_nopriv_acudhaam_contact', 'acudhaam_handle_contact');

/**
 * ==================================================
 * DISPLAY FALLBACK FUNCTIONS
 * ==================================================
 */

/**
 * Display fallback clinics
 */
function acudhaam_display_fallback_clinics() {
    ?>
    <div class="location-card">
        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e('Thiruvananthapuram Clinic', 'acudhaam'); ?>" class="location-img" loading="lazy">
        <div class="location-content">
            <div class="location-icon"><i class="fas fa-map-marker-alt"></i></div>
            <h3><?php _e('Thiruvananthapuram', 'acudhaam'); ?></h3>
            <p class="location-address"><?php _e('Kurishadi Junction, Nalanchira<br>Thiruvananthapuram - 695015', 'acudhaam'); ?></p>
            <a href="tel:+914712345678" class="location-phone"><i class="fas fa-phone-alt"></i> +91 471 234 5678</a>
        </div>
    </div>
    
    <div class="location-card">
        <img src="https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e('Kochi Clinic', 'acudhaam'); ?>" class="location-img" loading="lazy">
        <div class="location-content">
            <div class="location-icon"><i class="fas fa-map-marker-alt"></i></div>
            <h3><?php _e('Kochi', 'acudhaam'); ?></h3>
            <p class="location-address"><?php _e('MG Road, Near Jos Junction<br>Kochi - 682016', 'acudhaam'); ?></p>
            <a href="tel:+914842345678" class="location-phone"><i class="fas fa-phone-alt"></i> +91 484 234 5678</a>
        </div>
    </div>
    
    <div class="location-card">
        <img src="https://images.unsplash.com/photo-1559334413-ef9ee10db534?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e('Bangalore Clinic', 'acudhaam'); ?>" class="location-img" loading="lazy">
        <div class="location-content">
            <div class="location-icon"><i class="fas fa-map-marker-alt"></i></div>
            <h3><?php _e('Bangalore', 'acudhaam'); ?></h3>
            <p class="location-address"><?php _e('Indiranagar, 100ft Road<br>Bangalore - 560038', 'acudhaam'); ?></p>
            <a href="tel:+918023456789" class="location-phone"><i class="fas fa-phone-alt"></i> +91 80 2345 6789</a>
        </div>
    </div>
    
    <div class="location-card">
        <img src="https://images.unsplash.com/photo-1586374579358-9d19d632b6df?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e('Chennai Clinic', 'acudhaam'); ?>" class="location-img" loading="lazy">
        <div class="location-content">
            <div class="location-icon"><i class="fas fa-map-marker-alt"></i></div>
            <h3><?php _e('Chennai', 'acudhaam'); ?></h3>
            <p class="location-address"><?php _e('Adyar, LB Road<br>Chennai - 600020', 'acudhaam'); ?></p>
            <a href="tel:+914423456789" class="location-phone"><i class="fas fa-phone-alt"></i> +91 44 2345 6789</a>
        </div>
    </div>
    <?php
}

/**
 * Display fallback testimonials
 */
function acudhaam_display_fallback_testimonials() {
    ?>
    <div class="testimonial-card">
        <i class="fas fa-quote-left"></i>
        <p class="testimonial-text"><?php _e('"After years of chronic pain, Indian Classical Acupuncture at Acudhaam gave me my life back. The holistic approach and genuine care are unmatched."', 'acudhaam'); ?></p>
        <div class="testimonial-author">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="<?php esc_attr_e('Patient', 'acudhaam'); ?>" class="author-img">
            <div class="author-info">
                <h5><?php _e('Lakshmi Nair', 'acudhaam'); ?></h5>
                <p><?php _e('Thiruvananthapuram', 'acudhaam'); ?></p>
            </div>
        </div>
    </div>
    
    <div class="testimonial-card">
        <i class="fas fa-quote-left"></i>
        <p class="testimonial-text"><?php _e('"The B.Voc program at Acudhaam Institute is exceptional. The blend of theory and practical training prepared me to start my own clinic with confidence."', 'acudhaam'); ?></p>
        <div class="testimonial-author">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="<?php esc_attr_e('Student', 'acudhaam'); ?>" class="author-img">
            <div class="author-info">
                <h5><?php _e('Arun Kumar', 'acudhaam'); ?></h5>
                <p><?php _e('Alumnus, Batch 2023', 'acudhaam'); ?></p>
            </div>
        </div>
    </div>
    
    <div class="testimonial-card">
        <i class="fas fa-quote-left"></i>
        <p class="testimonial-text"><?php _e('"Green Raw Organics has changed the way our family eats. The freshness and taste of their vegetables remind me of my grandmother\'s garden."', 'acudhaam'); ?></p>
        <div class="testimonial-author">
            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="<?php esc_attr_e('Customer', 'acudhaam'); ?>" class="author-img">
            <div class="author-info">
                <h5><?php _e('Priya Menon', 'acudhaam'); ?></h5>
                <p><?php _e('Regular Customer', 'acudhaam'); ?></p>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Display fallback team members
 */
function acudhaam_display_fallback_team() {
    ?>
    <div class="team-member">
        <img src="https://randomuser.me/api/portraits/men/62.jpg" alt="<?php esc_attr_e('Dr. Tomichan C', 'acudhaam'); ?>" class="member-img">
        <h4><?php _e('Tomichan C', 'acudhaam'); ?></h4>
        <div class="position"><?php _e('Founder & Chief Acupuncturist', 'acudhaam'); ?></div>
        <p><?php _e('25+ years of experience in Indian Classical Acupuncture. Pioneer in integrating traditional wisdom with modern wellness.', 'acudhaam'); ?></p>
        <div class="member-social">
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
    
    <div class="team-member">
        <img src="https://randomuser.me/api/portraits/women/90.jpg" alt="<?php esc_attr_e('Dr. Meera N', 'acudhaam'); ?>" class="member-img">
        <h4><?php _e('Dr. Meera N', 'acudhaam'); ?></h4>
        <div class="position"><?php _e('Director, Acudhaam Institute', 'acudhaam'); ?></div>
        <p><?php _e('PhD in Acupuncture, dedicated to curriculum development and training the next generation of healers.', 'acudhaam'); ?></p>
        <div class="member-social">
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
    
    <div class="team-member">
        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="<?php esc_attr_e('Dr. Suresh P', 'acudhaam'); ?>" class="member-img">
        <h4><?php _e('Dr. Suresh P', 'acudhaam'); ?></h4>
        <div class="position"><?php _e('Senior Acupuncturist', 'acudhaam'); ?></div>
        <p><?php _e('Specialist in pain management and sports injuries. Leads our Bangalore clinic.', 'acudhaam'); ?></p>
        <div class="member-social">
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
    
    <div class="team-member">
        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="<?php esc_attr_e('Dr. Anitha R', 'acudhaam'); ?>" class="member-img">
        <h4><?php _e('Dr. Anitha R', 'acudhaam'); ?></h4>
        <div class="position"><?php _e('Head of Organic Division', 'acudhaam'); ?></div>
        <p><?php _e('Agricultural scientist ensuring our farms produce the purest organic yields.', 'acudhaam'); ?></p>
        <div class="member-social">
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
    <?php
}

/**
 * ==================================================
 * QUERY FUNCTIONS
 * ==================================================
 */

/**
 * Get clinics for front page
 */
function acudhaam_get_featured_clinics($count = 4) {
    $clinics = new WP_Query(array(
        'post_type'      => 'clinic',
        'posts_per_page' => $count,
        'meta_key'       => '_thumbnail_id',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
    
    return $clinics;
}

/**
 * Get testimonials for front page
 */
function acudhaam_get_featured_testimonials($count = 3) {
    $testimonials = new WP_Query(array(
        'post_type'      => 'testimonial',
        'posts_per_page' => $count,
        'orderby'        => 'rand',
    ));
    
    return $testimonials;
}

/**
 * Get team members for front page
 */
function acudhaam_get_featured_team($count = 4) {
    $team = new WP_Query(array(
        'post_type'      => 'team_member',
        'posts_per_page' => $count,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ));
    
    return $team;
}

/**
 * Get courses for front page
 */
function acudhaam_get_featured_courses($count = 4) {
    $courses = new WP_Query(array(
        'post_type'      => 'course',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
    
    return $courses;
}

/**
 * ==================================================
 * BLOG FUNCTIONS
 * ==================================================
 */

/**
 * Filter excerpt length
 */
function acudhaam_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'acudhaam_excerpt_length');

/**
 * Filter excerpt more
 */
function acudhaam_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'acudhaam_excerpt_more');

/**
 * Add body classes
 */
function acudhaam_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    
    if (is_singular('clinic')) {
        $classes[] = 'clinic-single';
    }
    
    if (is_singular('team_member')) {
        $classes[] = 'team-single';
    }
    
    if (is_singular('testimonial')) {
        $classes[] = 'testimonial-single';
    }
    
    if (is_singular('course')) {
        $classes[] = 'course-single';
    }
    
    return $classes;
}
add_filter('body_class', 'acudhaam_body_classes');

/**
 * Add custom mime types
 */
function acudhaam_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'acudhaam_mime_types');

/**
 * Add custom classes to menu items
 */
function acudhaam_nav_menu_classes($classes, $item, $args) {
    if ($args->theme_location == 'primary') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'acudhaam_nav_menu_classes', 10, 3);

/**
 * ==================================================
 * PAGINATION
 * ==================================================
 */

/**
 * Pagination function
 */
function acudhaam_pagination() {
    global $wp_query;
    
    $big = 999999999;
    
    $pages = paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'type'      => 'array',
        'prev_text' => '<i class="fas fa-chevron-left"></i>',
        'next_text' => '<i class="fas fa-chevron-right"></i>',
    ));
    
    if (is_array($pages)) {
        echo '<div class="pagination">';
        foreach ($pages as $page) {
            echo $page;
        }
        echo '</div>';
    }
}

/**
 * ==================================================
 * COMMENT CALLBACK
 * ==================================================
 */

/**
 * Custom comment callback
 */
function acudhaam_comment_callback($comment, $args, $depth) {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                    <?php printf('<b class="fn">%s</b>', get_comment_author_link()); ?>
                </div>
                
                <div class="comment-metadata">
                    <a href="<?php echo esc_url(get_comment_link($comment->comment_ID, $args)); ?>">
                        <time datetime="<?php comment_time('c'); ?>">
                            <?php
                            printf(
                                esc_html__('%1$s at %2$s', 'acudhaam'),
                                get_comment_date(),
                                get_comment_time()
                            );
                            ?>
                        </time>
                    </a>
                    <?php edit_comment_link(esc_html__('Edit', 'acudhaam'), '<span class="edit-link">', '</span>'); ?>
                </div>
                
                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'acudhaam'); ?></p>
                <?php endif; ?>
            </footer>
            
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            
            <div class="reply">
                <?php
                comment_reply_link(array_merge($args, array(
                    'add_below' => 'div-comment',
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<i class="fas fa-reply"></i> ',
                )));
                ?>
            </div>
            
        </article>
    <?php
}

/**
 * ==================================================
 * THEME ACTIVATION
 * ==================================================
 */

/**
 * Theme activation hook
 */
function acudhaam_theme_activation() {
    // Flush rewrite rules on activation
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'acudhaam_theme_activation');

/**
 * Theme deactivation hook
 */
function acudhaam_theme_deactivation() {
    // Flush rewrite rules on deactivation
    flush_rewrite_rules();
}
add_action('switch_theme', 'acudhaam_theme_deactivation');

/**
 * ==================================================
 * WOOCOMMERCE SUPPORT
 * ==================================================
 */

/**
 * Add WooCommerce support
 */
function acudhaam_woocommerce_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'acudhaam_woocommerce_support');

/**
 * ==================================================
 * DEBUG FUNCTIONS (Remove in production)
 * ==================================================
 */

/**
 * Debug function to check if CSS is loading
 */
function acudhaam_debug_css() {
    // Only show to admins
    if (!current_user_can('administrator')) {
        return;
    }
    
    $template_uri = get_template_directory_uri();
    $template_dir = get_template_directory();
    $css_path = $template_dir . '/assets/css/main.css';
    $css_exists = file_exists($css_path) ? 'YES' : 'NO';
    $css_url = $template_uri . '/assets/css/main.css';
    
    echo '<div style="background: #f0f0f0; padding: 20px; margin: 20px; border: 2px solid #d4af37; border-radius: 10px; font-family: monospace;">';
    echo '<h3 style="color: #222051; margin-top: 0;">🔍 Acudhaam Theme Debug Info</h3>';
    echo '<table style="width: 100%; border-collapse: collapse;">';
    echo '<tr><th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Setting</th><th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Value</th></tr>';
    echo '<tr><td style="padding: 8px;">Template URI</td><td style="padding: 8px;">' . $template_uri . '</td></tr>';
    echo '<tr><td style="padding: 8px;">Template Directory</td><td style="padding: 8px;">' . $template_dir . '</td></tr>';
    echo '<tr><td style="padding: 8px;">CSS File Path</td><td style="padding: 8px;">' . $css_path . '</td></tr>';
    echo '<tr><td style="padding: 8px;">CSS File Exists</td><td style="padding: 8px; font-weight: bold; color: ' . ($css_exists == 'YES' ? 'green' : 'red') . ';">' . $css_exists . '</td></tr>';
    echo '<tr><td style="padding: 8px;">CSS URL</td><td style="padding: 8px;">' . $css_url . '</td></tr>';
    echo '<tr><td style="padding: 8px;">WordPress Version</td><td style="padding: 8px;">' . get_bloginfo('version') . '</td></tr>';
    echo '<tr><td style="padding: 8px;">PHP Version</td><td style="padding: 8px;">' . phpversion() . '</td></tr>';
    echo '</table>';
    
    // Test if CSS is enqueued
    global $wp_styles;
    $css_enqueued = false;
    foreach ($wp_styles->queue as $style) {
        if ($style == 'acudhaam-main') {
            $css_enqueued = true;
            break;
        }
    }
    echo '<p style="margin-top: 15px;">CSS Enqueued: <strong style="color: ' . ($css_enqueued ? 'green' : 'red') . ';">' . ($css_enqueued ? 'YES' : 'NO') . '</strong></p>';
    
    echo '</div>';
}
// Uncomment the line below to enable debug output
// add_action('wp_footer', 'acudhaam_debug_css');
?>