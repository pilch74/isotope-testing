<?php

add_action('after_setup_theme', 'colloquium_theme_setup');

function colloquium_theme_setup() {

    /* Uses the custom color set in Stargazer within BBPress */
    add_action('wp_head', 'colloquium_bbpress_custom_color');
}

function colloquium_bbpress_custom_color() {

    $style = '';
    $hex = get_theme_mod('color_primary', '');
    $rgb = join(', ', hybrid_hex_to_rgb($hex));
    $style .= "li.bbp-topic-title .font-headlines a.bbp-topic-permalink:hover, a.bbp-forum-title.entry-title:hover { color: #{$hex}; } ";
    $style .= "span.bbp-admin-links a.bbp-reply-to-link, span.bbp-admin-links a.bbp-topic-reply-link { background-color: rgba( {$rgb}, 0.8 ); } ";
    $style .= "#bbpress-forums li.bbp-header, #bbpress-forums fieldset.bbp-form legend, span.bbp-admin-links a.bbp-reply-to-link:hover, span.bbp-admin-links a.bbp-topic-reply-link:hover { background-color: #{$hex}; }";
    $style .= " { border-top-color: #{$hex}; } ";
    $style = "\n" . '<style type="text/css" id="bbpress-custom-color">' . trim($style) . '</style>' . "\n";
    echo $style;
}

function rhtuts_add_isotope_wp() {
    wp_register_script('isotope-wp', ( get_stylesheet_directory_uri() ) . '/js/jquery.isotope.min.js', array('jquery'), true);
    wp_register_script('isotope-init-wp', ( get_stylesheet_directory_uri() ) . '/js/isotope.js', array('jquery', 'isotope-wp'), true);
    wp_register_style('isotope-css-wp', get_stylesheet_directory_uri() . '/css/isotope.css');

    wp_enqueue_script('isotope-init-wp');
    wp_enqueue_style('isotope-css-wp');
}

add_action('wp_enqueue_scripts', 'rhtuts_add_isotope_wp');

function rhtuts_add_isotope_hchtml() {
    wp_register_script('isotope-html', ( get_stylesheet_directory_uri() ) . '/js/jquery.isotope.min.js', array('jquery'), true);
    wp_register_script('isotope-init-html', ( get_stylesheet_directory_uri() ) . '/js/isotope_1.js', array('jquery', 'isotope-html'), true);
    wp_register_style('isotope-css-html', get_stylesheet_directory_uri() . '/css/isotope_1.css');

    wp_enqueue_script('isotope-init-html');
    wp_enqueue_style('isotope-css-html');
}

add_action('wp_enqueue_scripts', 'rhtuts_add_isotope_hchtml');
?>