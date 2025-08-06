<?php

namespace App;

/**
 * Simple implementation of sage container without Acorn
 *
 * @param string $abstract
 * @param array  $parameters
 * @return mixed
 */
function sage($abstract = null, $parameters = [])
{
    // Simple implementation that returns null
    return null;
}

/**
 * Simple implementation of config without Acorn
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed
 */
function config($key = null, $default = null)
{
    // Simple implementation that returns default value
    return $default;
}

/**
 * Simple implementation of template without Blade
 *
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    // Simple implementation that includes the file
    if (file_exists($file)) {
        ob_start();
        extract($data);
        include $file;
        return ob_get_clean();
    }
    return '';
}

/**
 * Simple implementation of template_path without Blade
 *
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    // Simple implementation that returns the file path
    return $file;
}

/**
 * Simple implementation of asset_path without Acorn
 *
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    // Check if Acorn is available
    if (function_exists('\Roots\asset')) {
        return \Roots\asset($asset);
    }
    
    // Fallback to simple implementation
    return get_stylesheet_directory_uri() . '/public/' . $asset;
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}