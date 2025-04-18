<?php
/**
 * Functions and definitions relating to posts
 * 
 * @package GHAC
 * @since GHAC 0.1
 * 
 */

// register shortcodes
add_shortcode('ghac_guess_the_name_of_the_bunny', 'ghac_guess_the_name_of_the_bunny');

function ghac_guess_the_name_of_the_bunny( $attributes, $content = null ) {
    // String to hold the HTML markup to return
    $htmlOutput = "<div id=\"bunny_stage_1\" style=\"text-align: center;\">";
    $htmlOutput .= "<img src=\"" . get_template_directory_uri() . '/assets/img/bunny-name-generator.png' . "\" class=\"mb-3 img-fluid\" />";
    $htmlOutput .= "<a href=\"#\" class=\"club-button club-button-center club-button-3\" style=\"max-width: 500px;\" onclick=\"ghac_guess_the_name_of_the_bunny()\">Click here to randomly select the lucky winner!</a>";
    $htmlOutput .= "</div>";
    $htmlOutput .= "<div id=\"bunny_stage_2\" style=\"text-align: center;\" class=\"d-none\">";
    $htmlOutput .= "<h4>Please wait while I hop to the warren. The first bunny I find there is the winner.....</h2>";
    $htmlOutput .= "<img src=\"" . get_template_directory_uri() . '/assets/img/running-bunny.gif' . "\" class=\"img-fluid\" />";
    $htmlOutput .= "</div>";
    $htmlOutput .= "<div id=\"bunny_stage_3\" style=\"text-align: center;\" class=\"d-none\">";
    $htmlOutput .= "<img src=\"" . get_template_directory_uri() . '/assets/img/bunny-winner.png' . "\" class=\"mb-3 img-fluid\" />";
    $htmlOutput .= "<h2>Winner: <span id=\"bunny_name\"></span></h2>";
    $htmlOutput .= "<h4>Congratulations to <span id=\"bunny_winner\"></span> on winning £150!</h4>";

    $htmlOutput .= "</div>";

    return $htmlOutput;
}