<?php
/**
 * Functions and definitions relating to posts
 * 
 * @package GHAC
 * @since GHAC 0.1
 * 
 */

// register shortcodes
add_shortcode('ghac_posts_list', 'ghac_posts_list');

function ghac_estimated_read_time( $content ) {
    $wordCount = str_word_count( strip_tags( $content ) );
    $readingSpeed = 200; // Average reading speed in word per minute
    $readTime = ceil( $wordCount / $readingSpeed );
    return $readTime . ' minute read';
}

function ghac_posts_list_post( $col_class, $thumb_class, $post_class, $link, $title, $thumbnail, $post_time, $excerpt, $author, $comments, $readtime ) {
    // String to hold the HTML markup to return
    $htmlOutput = "";
    // String to hold the closing tags
    $htmlClosing = "";
    // Add the column to hold the post
    $htmlOutput .= "<div class=\"" . $col_class . "\">";
    $htmlClosing = "</div>" . $htmlClosing;
    // Add a row within the column
    $htmlOutput .= "<div class=\"row\">";
    $htmlClosing = "</div>" . $htmlClosing;
    // Add the thumbnail
    $htmlOutput .= "<div class=\"" . $thumb_class . "\">";
    $htmlOutput .= "<a href=\"" . $link . "\"><img src=\"" . $thumbnail . "\" class=\"img-fluid md-2 mb-md-0\" alt=\"" . $title . "\" loading=\"lazy\" /></a>";
    $htmlOutput .= "</div>";
    // Add the post column
    $htmlOutput .= "<div class=\"" . $post_class . "\">";
    // Wrap the post data in an anchor tag
    $htmlOutput .= "<a href=\"" . $link . "\">";
    // Display the title of the post, date/time and the excerpt
    $htmlOutput .= "<h3>" . $title . "</h3><p class=\"post-datetime\">" . $post_time . "</p><p>" . $excerpt . "</p>";
    // Close the anchor tag
    $htmlOutput .= "</a>";
    // Display some post meta data
    $htmlOutput .= "<ul class=\"postdetails\">";
    $htmlOutput .= "<li><i class=\"bi bi-person-circle\"></i> " . $author . " |&nbsp;</li>";
    $htmlOutput .= "<li><i class=\"bi bi-chat\"></i> " . $comments . " comments|&nbsp;</li>";
    $htmlOutput .= "<li><i class=\"bi bi-eyeglasses\"></i> " . $readtime . "</li>";
    $htmlOutput .= "</ul>";
    // Close the post column
    $htmlOutput .= "</div>";
    // Return the HTML markup
    return $htmlOutput . $htmlClosing;
}

function ghac_posts_list( $attributes, $content = null ) {
    // String to hold the HTML markup to return
    $htmlOutput = "";
    $atts = shortcode_atts(
        array(
            'posts' => 1,
            'cols' => 1,
            'add_container' => "false",
            'container_class' => "",
            'container_fluid' => "false",
            'heading' => "",
            'col_class' => "",
            'thumbnail_class' => "",
            'post_class' => "",
            'show_latest' => "false",
            'latest_container_class' => "",
            'latest_featured' => "false",
            'latest_heading' => "",
            'latest_heading_featured' => "",
            'latest_col_class' => "",
            'latest_thumbnail_class' => "",
            'latest_post_class' => ""
        ), $attributes
    );
    // Declare an array to hold the posts already displayed so that there's no duplication
    $postsDisplayed = array();
    // Declare the section counter
    $section = esc_attr( $atts['show_latest'] ) == "true" ? 0 : 1;
    // Loop through the sections
    while ( $section < 2 ) {
        // String to hold the closing HTML markup to append to htmlOutput
        $htmlClosing = "";
        // String to hold the heading (if applicable)
        if ( $section == 0 ) {
            // Add containers DIVs
            if ( esc_attr( $atts['add_container'] ) == "true" ) {
                // Add the wrapper div and apply the class names
                $htmlOutput .= "<div class=\"" . esc_attr( $atts['latest_container_class'] ) . "\">";
                $htmlClosing = "</div>" . $htmlClosing;
                // Add the container
                $htmlOutput .= "<div class=\"" . ( esc_attr( $atts['container_fluid'] ) == "true" ? "container-fluid" : "container" ) . "\">";
                $htmlClosing = "</div>" . $htmlClosing;
            }
            // Get the sticky posts (if latest_featured = true)
            $sticky = esc_attr( $atts['latest_featured'] ) == "true" ? get_option( "sticky_posts" ) : array();
            // Query and return the posts
            $posts = new WP_Query( array(
                'posts_per_page' => 1,
                'post__in' => $sticky,
                'ignore_sticky_posts' => true
            ) );
            // Get the heading text
            $heading = isset( $sticky[0] ) ? $atts['latest_heading_featured'] : $atts['latest_heading'];
        } else {
            // Add containers DIVs
            if ( esc_attr( $atts['add_container'] ) == "true" ) {
                // Add the wrapper div and apply the class names
                $htmlOutput .= "<div class=\"" . esc_attr( $atts['container_class'] ) . "\">";
                $htmlClosing = "</div>" . $htmlClosing;
                // Add the container
                $htmlOutput .= "<div class=\"" . ( esc_attr( $atts['container_fluid'] ) == "true" ? "container-fluid" : "container" ) . "\">";
                $htmlClosing = "</div>" . $htmlClosing;
            }
            $sticky = array();
            // Query and return the posts
            $posts = new WP_Query( array(
                'posts_per_page' => esc_attr( $atts['posts'] ),
                'post__not_in' => $postsDisplayed,
                'ignore_sticky_posts' => true
            ) );
            // Get the heading text
            $heading = $atts['heading'];
        }
        // Add the heading
        if ( $heading != "") {
            $htmlOutput .= $heading != "" ? "<div class=\"row\"><div class=\"col\"><h2>" . $heading . "</h2><hr /></div></div>" : "";
        }
        // Declare the column counter
        $colCount = 0;
        $postCount = 0;
        // Loop through the posts
        if ( $posts -> have_posts() ) {
            while ( $posts -> have_posts() ) {
                // Get the post
                $posts -> the_post();
                // Add the post to $postsDisplayed
                $postsDisplayed[] = get_the_ID();
                // If the column count is zero then let's add a bootstrap row
                if ( $colCount == 0 ) {
                    $htmlOutput .= "<div class=\"row post-list\">";
                    $htmlClosing = "</div>" . $htmlClosing;
                }
                // Add the post
                $htmlOutput .= ghac_posts_list_post( 
                    $section == 0 ? esc_attr( $atts[ 'latest_col_class'] ) : esc_attr( $atts[ 'col_class'] ),
                    $section == 0 ? esc_attr( $atts[ 'latest_thumbnail_class'] ) : esc_attr( $atts[ 'thumbnail_class'] ),
                    $section == 0 ? esc_attr( $atts[ 'latest_post_class'] ) : esc_attr( $atts[ 'post_class'] ),
                    get_the_permalink(),
                    get_the_title(),
                    has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . "/assets/img/default-post-image.jpg",
                    get_post_time( 'd M Y H:i' ),
                    get_the_excerpt(),
                    get_the_author_meta( 'display_name' ),
                    get_comments_number(),
                    ghac_estimated_read_time( get_the_content() )
                );
                // Increment colCount
                $colCount++;

                if ( ( $colCount == esc_attr( $atts['cols'] ) ) || ( $postCount ==  esc_attr( $atts['posts'] ) ) ) {
                    // Reset the column count
                    $colCount = 0;
                    // Close the bootstrap row
                    $htmlOutput .= "</div>";
                }
            }
        }
        // Concat the closing HTML markup to the output
        $htmlOutput .= $htmlClosing;
        // Increment the section value
        $section++;
    }
    return $htmlOutput;
}