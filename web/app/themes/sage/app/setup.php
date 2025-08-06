<?php

namespace App;

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    // Theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style'
    ]);

    // Navigation menus
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage'),
    ]);
}, 20);

/**
 * Enqueue theme assets
 */
add_action('wp_enqueue_scripts', function () {
    // Enqueue theme styles and scripts
    wp_enqueue_style('sage/app.css', get_stylesheet_directory_uri() . '/public/styles/app.css', false, null);
    wp_enqueue_script('sage/app.js', get_stylesheet_directory_uri() . '/public/scripts/app.js', ['jquery'], null, true);
}, 100);

/**
 * GoHighLevel integration
 */
add_action('wp_head', function () {
    ?>
    <!-- GoHighLevel Tracking Code -->
    <script>
    (function() {
        // GHL Tracking Script
        var script = document.createElement('script');
        script.src = 'https://widgets.leadconnectorhq.com/loader.js';
        script.setAttribute('data-resources-url', 'https://widgets.leadconnectorhq.com/chat-widget/loader.js');
        script.setAttribute('data-widget-id', '7DUwt2e161ox8kn5pDDU');
        document.head.appendChild(script);
        
        // Custom tracking for ScaleUp Marketing
        window.ghlConfig = {
            locationId: '7DUwt2e161ox8kn5pDDU',
            source: 'website',
            campaign: 'smart_website_landing'
        };
        
        // Track page views
        if (typeof gtag !== 'undefined') {
            gtag('event', 'page_view', {
                page_title: document.title,
                page_location: window.location.href,
                custom_parameter: 'scaleup_marketing_site'
            });
        }
    })();
    </script>
    
    <!-- Additional Meta Tags for GHL -->
    <meta name="ghl-location-id" content="7DUwt2e161ox8kn5pDDU">
    <meta name="ghl-source" content="website">
    <?php
    
    // ACF code commented out until plugin is available
    // $tracking_code = \get_field('ghl_tracking_code', 'option');
    // if ($tracking_code) {
    //     echo $tracking_code;
    // }
});

/**
 * GoHighLevel Chat Widget
 */
add_action('wp_footer', function () {
    ?>
    <!-- GoHighLevel Chat Widget -->
    <script>
    (function() {
        // Chat widget configuration
        window.ghlChatConfig = {
            locationId: '7DUwt2e161ox8kn5pDDU',
            widgetId: '7DUwt2e161ox8kn5pDDU',
            customData: {
                source: 'website',
                page: window.location.pathname,
                campaign: 'smart_website_landing'
            }
        };
        
        // Load chat widget
        var chatScript = document.createElement('script');
        chatScript.src = 'https://widgets.leadconnectorhq.com/chat-widget/loader.js';
        chatScript.setAttribute('data-widget-id', window.ghlChatConfig.widgetId);
        chatScript.setAttribute('data-location-id', window.ghlChatConfig.locationId);
        document.body.appendChild(chatScript);
    })();
    </script>
    <?php
});

/**
 * Custom post types and fields
 */
add_action('init', function () {
    // Register custom post types
    register_post_type('testimonial', [
        'labels' => [
            'name' => __('Testimonials', 'sage'),
            'singular_name' => __('Testimonial', 'sage'),
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
    ]);
    
    register_post_type('case_study', [
        'labels' => [
            'name' => __('Case Studies', 'sage'),
            'singular_name' => __('Case Study', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
    ]);
    
    // Register custom taxonomies
    register_taxonomy('business_type', ['case_study'], [
        'labels' => [
            'name' => __('Business Types', 'sage'),
            'singular_name' => __('Business Type', 'sage'),
        ],
        'hierarchical' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
    ]);
    
    // ACF code commented out until plugin is available
    // if (function_exists('\acf_add_options_page')) {
    //     \acf_add_options_page([
    //         'page_title' => 'Theme Settings',
    //         'menu_title' => 'Theme Settings',
    //         'menu_slug' => 'theme-settings',
    //         'capability' => 'edit_posts',
    //     ]);
    //
    //     \acf_add_options_sub_page([
    //         'page_title' => 'GoHighLevel Integration',
    //         'menu_title' => 'GHL Integration',
    //         'parent_slug' => 'theme-settings',
    //     ]);
    //
    //     \acf_add_options_sub_page([
    //         'page_title' => 'Contact Information',
    //         'menu_title' => 'Contact Info',
    //         'parent_slug' => 'theme-settings',
    //     ]);
    // }
});

/**
 * Register ACF field groups
 */
// ACF code commented out until plugin is available
// add_action('acf/init', function () {
//     if (function_exists('\acf_add_local_field_group')) {
//         // Theme Settings Fields
//         \acf_add_local_field_group([
//             'key' => 'group_theme_settings',
//             'title' => 'Theme Settings',
//             'fields' => [
//                 [
//                     'key' => 'field_ghl_tracking_code',
//                     'label' => 'GoHighLevel Tracking Code',
//                     'name' => 'ghl_tracking_code',
//                     'type' => 'textarea',
//                     'instructions' => 'Paste your GoHighLevel tracking code here',
//                 ],
//                 [
//                     'key' => 'field_ghl_form_endpoint',
//                     'label' => 'GoHighLevel Form Endpoint',
//                     'name' => 'ghl_form_endpoint',
//                     'type' => 'text',
//                     'instructions' => 'Enter your GoHighLevel form webhook URL',
//                 ],
//                 [
//                     'key' => 'field_phone_number',
//                     'label' => 'Phone Number',
//                     'name' => 'phone_number',
//                     'type' => 'text',
//                 ],
//                 [
//                     'key' => 'field_email_address',
//                     'label' => 'Email Address',
//                     'name' => 'email_address',
//                     'type' => 'email',
//                 ],
//             ],
//             'location' => [
//                 [
//                     [
//                         'param' => 'options_page',
//                         'operator' => '==',
//                         'value' => 'theme-settings',
//                     ],
//                 ],
//             ],
//         ]);
//
//         // Testimonial Fields
//         \acf_add_local_field_group([
//             'key' => 'group_testimonial',
//             'title' => 'Testimonial Information',
//             'fields' => [
//                 [
//                     'key' => 'field_client_name',
//                     'label' => 'Client Name',
//                     'name' => 'client_name',
//                     'type' => 'text',
//                 ],
//                 [
//                     'key' => 'field_client_company',
//                     'label' => 'Client Company',
//                     'name' => 'client_company',
//                     'type' => 'text',
//                 ],
//                 [
//                     'key' => 'field_client_position',
//                     'label' => 'Client Position',
//                     'name' => 'client_position',
//                     'type' => 'text',
//                 ],
//                 [
//                     'key' => 'field_testimonial_rating',
//                     'label' => 'Rating',
//                     'name' => 'testimonial_rating',
//                     'type' => 'number',
//                     'min' => 1,
//                     'max' => 5,
//                 ],
//             ],
//             'location' => [
//                 [
//                     [
//                         'param' => 'post_type',
//                         'operator' => '==',
//                         'value' => 'testimonial',
//                     ],
//                 ],
//             ],
//         ]);
//
//         // Homepage Fields
//         \acf_add_local_field_group([
//             'key' => 'group_homepage',
//             'title' => 'Homepage Sections',
//             'fields' => [
//                 [
//                     'key' => 'field_hero_title',
//                     'label' => 'Hero Title',
//                     'name' => 'hero_title',
//                     'type' => 'text',
//                 ],
//                 [
//                     'key' => 'field_hero_subtitle',
//                     'label' => 'Hero Subtitle',
//                     'name' => 'hero_subtitle',
//                     'type' => 'textarea',
//                 ],
//                 [
//                     'key' => 'field_hero_image',
//                     'label' => 'Hero Image',
//                     'name' => 'hero_image',
//                     'type' => 'image',
//                     'return_format' => 'array',
//                 ],
//                 [
//                     'key' => 'field_hero_primary_button_text',
//                     'label' => 'Primary Button Text',
//                     'name' => 'hero_primary_button_text',
//                     'type' => 'text',
//                 ],
//                 [
//                     'key' => 'field_hero_primary_button_url',
//                     'label' => 'Primary Button URL',
//                     'name' => 'hero_primary_button_url',
//                     'type' => 'text',
//                 ],
//                 [
//                     'key' => 'field_hero_secondary_button_text',
//                     'label' => 'Secondary Button Text',
//                     'name' => 'hero_secondary_button_text',
//                     'type' => 'text',
//                 ],
//                 [
//                     'key' => 'field_hero_secondary_button_url',
//                     'label' => 'Secondary Button URL',
//                     'name' => 'hero_secondary_button_url',
//                     'type' => 'text',
//                 ],
//             ],
//             'location' => [
//                 [
//                     [
//                         'param' => 'page_template',
//                         'operator' => '==',
//                         'value' => 'default',
//                     ],
//                     [
//                         'param' => 'page_type',
//                         'operator' => '==',
//                         'value' => 'front_page',
//                     ],
//                 ],
//             ],
//         ]);
//     }
// });