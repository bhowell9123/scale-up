<?php

namespace App;

/**
 * Register GoHighLevel API endpoints
 */
add_action('rest_api_init', function () {
    register_rest_route('ghl/v1', '/form-submission', [
        'methods' => 'POST',
        'callback' => __NAMESPACE__ . '\\handle_ghl_form_submission',
        'permission_callback' => __NAMESPACE__ . '\\verify_ghl_webhook'
    ]);

    register_rest_route('ghl/v1', '/appointment', [
        'methods' => 'POST',
        'callback' => __NAMESPACE__ . '\\handle_ghl_appointment',
        'permission_callback' => __NAMESPACE__ . '\\verify_ghl_webhook'
    ]);
});

/**
 * Verify GoHighLevel webhook request
 * 
 * @param \WP_REST_Request $request The request object
 * @return bool Whether the request is valid
 */
function verify_ghl_webhook($request)
{
    // Verify webhook signature or API key
    $api_key = $request->get_header('X-GHL-API-Key');
    $webhook_secret = get_field('ghl_webhook_secret', 'option');

    // If no webhook secret is set, allow in development mode
    if (defined('WP_ENV') && WP_ENV === 'development' && empty($webhook_secret)) {
        return true;
    }

    // If no webhook secret is set in options, use the default one
    if (empty($webhook_secret)) {
        $webhook_secret = '7DUwt2e161ox8kn5pDDU';
    }

    return $api_key === $webhook_secret;
}

/**
 * Handle GoHighLevel form submission webhook
 * 
 * @param \WP_REST_Request $request The request object
 * @return \WP_REST_Response The response object
 */
function handle_ghl_form_submission($request)
{
    $data = $request->get_json_params();

    // Process the webhook data
    $contact_id = isset($data['contact']['id']) ? $data['contact']['id'] : '';
    $email = isset($data['contact']['email']) ? $data['contact']['email'] : '';
    $source = isset($data['contact']['source']) ? $data['contact']['source'] : '';

    // Log the submission
    error_log('GHL Form Submission: ' . json_encode($data));

    // Store the submission in a custom post type
    $post_id = wp_insert_post([
        'post_title' => 'Form Submission: ' . $email,
        'post_type' => 'form_submission',
        'post_status' => 'publish',
        'meta_input' => [
            'ghl_contact_id' => $contact_id,
            'ghl_contact_email' => $email,
            'ghl_contact_source' => $source,
            'ghl_submission_data' => $data,
        ],
    ]);

    // Trigger additional actions
    do_action('ghl_form_submitted', $data, $post_id);

    return new \WP_REST_Response(['status' => 'success', 'post_id' => $post_id], 200);
}

/**
 * Handle GoHighLevel appointment webhook
 * 
 * @param \WP_REST_Request $request The request object
 * @return \WP_REST_Response The response object
 */
function handle_ghl_appointment($request)
{
    $data = $request->get_json_params();

    // Process the webhook data
    $appointment_id = isset($data['appointment']['id']) ? $data['appointment']['id'] : '';
    $contact_id = isset($data['contact']['id']) ? $data['contact']['id'] : '';
    $status = isset($data['appointment']['status']) ? $data['appointment']['status'] : '';

    // Log the appointment
    error_log('GHL Appointment: ' . json_encode($data));

    // Store the appointment in a custom post type
    $post_id = wp_insert_post([
        'post_title' => 'Appointment: ' . $appointment_id,
        'post_type' => 'appointment',
        'post_status' => 'publish',
        'meta_input' => [
            'ghl_appointment_id' => $appointment_id,
            'ghl_contact_id' => $contact_id,
            'ghl_appointment_status' => $status,
            'ghl_appointment_data' => $data,
        ],
    ]);

    // Trigger additional actions
    do_action('ghl_appointment_' . $status, $data, $post_id);

    return new \WP_REST_Response(['status' => 'success', 'post_id' => $post_id], 200);
}

/**
 * Register custom post types for GoHighLevel data
 */
add_action('init', function () {
    // Form Submissions
    register_post_type('form_submission', [
        'labels' => [
            'name' => __('Form Submissions', 'sage'),
            'singular_name' => __('Form Submission', 'sage'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-feedback',
        'supports' => ['title'],
        'capabilities' => [
            'create_posts' => 'do_not_allow',
        ],
        'map_meta_cap' => true,
    ]);

    // Appointments
    register_post_type('appointment', [
        'labels' => [
            'name' => __('Appointments', 'sage'),
            'singular_name' => __('Appointment', 'sage'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => ['title'],
        'capabilities' => [
            'create_posts' => 'do_not_allow',
        ],
        'map_meta_cap' => true,
    ]);
});

/**
 * Add GoHighLevel webhook secret field to options page
 */
add_action('acf/init', function () {
    if (function_exists('acf_add_local_field')) {
        acf_add_local_field([
            'key' => 'field_ghl_webhook_secret',
            'label' => 'GoHighLevel Webhook Secret',
            'name' => 'ghl_webhook_secret',
            'type' => 'text',
            'parent' => 'group_theme_settings',
            'instructions' => 'Enter your GoHighLevel webhook secret for API authentication',
        ]);
    }
});

/**
 * Add meta boxes for GoHighLevel data
 */
add_action('add_meta_boxes', function () {
    // Form Submission Data
    add_meta_box(
        'ghl_form_submission_data',
        __('Form Submission Data', 'sage'),
        __NAMESPACE__ . '\\render_form_submission_data',
        'form_submission',
        'normal',
        'high'
    );

    // Appointment Data
    add_meta_box(
        'ghl_appointment_data',
        __('Appointment Data', 'sage'),
        __NAMESPACE__ . '\\render_appointment_data',
        'appointment',
        'normal',
        'high'
    );
});

/**
 * Render form submission data meta box
 * 
 * @param \WP_Post $post The post object
 */
function render_form_submission_data($post)
{
    $data = get_post_meta($post->ID, 'ghl_submission_data', true);

    echo '<div class="ghl-data">';

    if (empty($data)) {
        echo '<p>No submission data found.</p>';
    } else {
        echo '<table class="widefat">';
        echo '<thead><tr><th>Field</th><th>Value</th></tr></thead>';
        echo '<tbody>';

        // Contact info
        if (isset($data['contact'])) {
            foreach ($data['contact'] as $key => $value) {
                if (is_array($value)) {
                    $value = json_encode($value);
                }

                echo '<tr>';
                echo '<td><strong>' . esc_html($key) . '</strong></td>';
                echo '<td>' . esc_html($value) . '</td>';
                echo '</tr>';
            }
        }

        // Form data
        if (isset($data['form'])) {
            foreach ($data['form'] as $key => $value) {
                if (is_array($value)) {
                    $value = json_encode($value);
                }

                echo '<tr>';
                echo '<td><strong>' . esc_html($key) . '</strong></td>';
                echo '<td>' . esc_html($value) . '</td>';
                echo '</tr>';
            }
        }

        echo '</tbody></table>';
    }

    echo '</div>';
}

/**
 * Render appointment data meta box
 * 
 * @param \WP_Post $post The post object
 */
function render_appointment_data($post)
{
    $data = get_post_meta($post->ID, 'ghl_appointment_data', true);

    echo '<div class="ghl-data">';

    if (empty($data)) {
        echo '<p>No appointment data found.</p>';
    } else {
        echo '<table class="widefat">';
        echo '<thead><tr><th>Field</th><th>Value</th></tr></thead>';
        echo '<tbody>';

        // Appointment info
        if (isset($data['appointment'])) {
            foreach ($data['appointment'] as $key => $value) {
                if (is_array($value)) {
                    $value = json_encode($value);
                }

                echo '<tr>';
                echo '<td><strong>' . esc_html($key) . '</strong></td>';
                echo '<td>' . esc_html($value) . '</td>';
                echo '</tr>';
            }
        }

        // Contact info
        if (isset($data['contact'])) {
            foreach ($data['contact'] as $key => $value) {
                if (is_array($value)) {
                    $value = json_encode($value);
                }

                echo '<tr>';
                echo '<td><strong>' . esc_html($key) . '</strong></td>';
                echo '<td>' . esc_html($value) . '</td>';
                echo '</tr>';
            }
        }

        echo '</tbody></table>';
    }

    echo '</div>';
}