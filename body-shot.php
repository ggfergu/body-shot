<?php
/**
 * Plugin Name: Body Shot
 * Description: Adds the full path (after the domain) as a dash-separated class to the body tag. Query strings excluded.
 * Version: 1.1
 * Author: Jerry Ferguson
 */

add_filter('body_class', 'body_shot_add_path_class');

function body_shot_add_path_class($classes) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Remove query strings
    $cleaned = trim($uri, '/'); // Remove leading/trailing slashes

    if ($cleaned === '') {
        $path_class = 'path-home';
    } else {
        // Replace slashes and special characters with dashes
        $slugified = preg_replace('/[^a-z0-9]+/i', '-', $cleaned);
        $slugified = trim($slugified, '-');
        $path_class = 'path-' . strtolower($slugified);
    }

    $classes[] = sanitize_html_class($path_class);
    return $classes;
}