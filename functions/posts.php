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
    return $readTime > 1 ? $readTime . ' minutes' : $readTime . ' minute';
}

function ghac_posts_list_post( $col_class, $col_class_notlast, $thumb_class, $post_class, $link, $title, $thumbnail, $post_time, $excerpt, $author, $comments, $readtime ) {
    // String to hold the HTML markup to return
    $htmlOutput = "";
    // String to hold the closing tags
    $htmlClosing = "";
    // Add the column to hold the post
    $htmlOutput .= "<div class=\"" . $col_class . ( $col_class_notlast != "" ? " " : "" ) . $col_class_notlast . "\">";
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
    $htmlClosing = "</div>" . $htmlClosing;
    // Wrap the post data in an anchor tag
    $htmlOutput .= "<a href=\"" . $link . "\">";
    // Display the title of the post, date/time and the excerpt
    $htmlOutput .= "<h3>" . $title . "</h3><p class=\"post-datetime\">" . $post_time . " | Read Time: " . $readtime . "</p><p>" . $excerpt . "</p>";
    // Close the anchor tag
    $htmlOutput .= "</a>";
    // Display some post meta data
    $htmlOutput .= "<ul class=\"postdetails\">";
    $htmlOutput .= "<li><i class=\"bi bi-person-circle\"></i> " . $author . " |&nbsp;</li>";
    $htmlOutput .= "<li><i class=\"bi bi-chat\"></i> " . $comments . " comments</li>";
    $htmlOutput .= "</ul>";
    // Return the HTML markup
    return $htmlOutput . $htmlClosing;
}

function ghac_posts_list( $attributes, $content = null, $shortcode = null, $query = null ) {
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
            'col_class_notlast' => "",
            'thumbnail_class' => "",
            'post_class' => "",
            'show_latest' => "false",
            'latest_container_class' => "",
            'latest_featured' => "false",
            'latest_heading' => "",
            'latest_heading_featured' => "",
            'latest_col_class' => "",
            'latest_thumbnail_class' => "",
            'latest_post_class' => "",
            'show_all_posts_button' => "false",
            'all_posts_button_text' => "View all posts",
            'all_posts_button_link' => "",
            'all_posts_button_class' => "",
            'show_pagination' => "false",
            "pagination_class" => ""
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
            // Determine if the posts have been passed as parameter (e.g. from acrhive.php)
            if ( is_null( $query ) ) {
                // Query and return the posts
                $posts = new WP_Query( array(
                    'posts_per_page' => esc_attr( $atts['posts'] ),
                    'post__not_in' => $postsDisplayed,
                    'ignore_sticky_posts' => true,
                    'paged' => ( get_query_var('paged') ) ? get_query_var('paged') : 1
                ) ); 
            } else {
                $posts = $query;
            }
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
                // Increment the postCount
                $postCount++;
                // Get the post
                $posts -> the_post();
                // Add the post to $postsDisplayed
                $postsDisplayed[] = get_the_ID();
                // If the column count is zero then let's add a bootstrap row
                if ( $colCount == 0 ) {
                    $htmlOutput .= "<div class=\"row post-list\">";
                    //$htmlClosing = "</div>" . $htmlClosing; - CoPilot said to ignore this line
                }
                // Add the post
                //esc_attr( $atts['posts'] )
                $htmlOutput .= ghac_posts_list_post( 
                    $section == 0 ? esc_attr( $atts[ 'latest_col_class'] ) : esc_attr( $atts[ 'col_class'] ),
                    ( ( $section == 1 ) && ( $postCount < $posts->post_count ) ) ? esc_attr( $atts[ 'col_class_notlast'] ) : "" ,
                    $section == 0 ? esc_attr( $atts[ 'latest_thumbnail_class'] ) : esc_attr( $atts[ 'thumbnail_class'] ) ,
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

                if ( ( $colCount == esc_attr( $atts['cols'] ) ) || ( $postCount ==  $posts->post_count ) || ( $section == 0 ) ) {
                    // Reset the column count
                    $colCount = 0;
                    // Close the bootstrap row
                    $htmlOutput .= "</div>";
                }
            }
        }
        if ( ( esc_attr( $atts['show_all_posts_button'] ) == "true" ) && ( $section == 1 ) && ( esc_attr( $atts['all_posts_button_link'] ) != "" ) ) {
            $htmlOutput .= "<div class=\"row\"><div class=\"col\"><a href=\"" . esc_url( $atts['all_posts_button_link'] ) . "\" class=\"" . esc_attr( $atts['all_posts_button_class'] ) . "\">" . esc_html( $atts['all_posts_button_text'] ) . "</a></div></div>";
        }
        if ( ( esc_attr( $atts['show_pagination'] ) == "true" ) && ( $section == 1 ) ) {
            // Add pagination
            $htmlOutput .= "<div class=\"row\"><div class=\"col\">";
            // Pagination links
            $pagination = paginate_links( array(
                'current' => max( 1, get_query_var( 'paged' ) ),
                'total'   => $posts->max_num_pages,
                'type'    => 'array'
            ) );
            if ( is_array( $pagination ) ) {
                $htmlOutput .= "<nav aria-label=\"Page navigation\"><ul class=\"pagination justify-content-center pt-3\">";
                foreach ( $pagination as $pageLink ) {
                    $activePage = strpos( $pageLink, 'current' ) !== false ? " active" : "";
                    $htmlOutput .= "<li class=\"page-item " . $activePage . "\">" . str_replace( "page-numbers", "page-link", $pageLink ) . "</li>";
                }
                $htmlOutput .= "</ul></nav>";
            }
            $htmlOutput .= "</div></div>";
        }
        // Concat the closing HTML markup to the output
        $htmlOutput .= $htmlClosing;
        // Increment the section value
        $section++;
    }
    return $htmlOutput;
}