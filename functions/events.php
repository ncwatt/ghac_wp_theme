<?php
/**
 * Functions and definitions relating to the The Events Calendar plugin
 * 
 * @package GHAC
 * @since GHAC 0.1
 * 
 */

function ghac_responsive_embed($html, $url, $attr) {
    // Only run for iframes from your own site
    $parsed_url = parse_url( $url );

    if ( !empty( $parsed_url[ 'host' ] ) && ( $parsed_url[ 'host' ] !== $_SERVER[ 'SERVER_NAME' ] && $parsed_url[ 'host' ] !== 'gosforth-harriers.org' ) ) {
        return $html; // leave external embeds untouched
    }

    // Replace fixed width/height with fluid values
    $html = preg_replace('/width="\d+"/', 'width="100%"', $html);
    $html = preg_replace('/height="\d+"/', '', $html); // strip height

    // Wrap in a responsive container
    return "<div class=\"row\"><div class=\"col-xs-12 col-lg-6\">" . $html . "</div></div>";
    //return $html;
}
add_filter('embed_oembed_html', 'ghac_responsive_embed', 10, 3);