<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <?php wp_head(); ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() . '/assets/img/favicon' ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() . '/assets/img/favicon' ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() . '/assets/img/favicon' ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri() . '/assets/img/favicon' ?>/site.webmanifest">
    <!--<title><?php //echo wp_title('', true,'') . " | " . get_bloginfo('name'); ?></title> -->
</head>
<body <?php body_class(); ?>>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="<?php echo get_template_directory_uri() . '/assets/img/ghac_logo.png' ?>" alt="Gosforth Harriers & AC Logo" class="navbar-logo" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topMenu" aria-controls="topMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="topMenu" style="padding: 0 0 0 80px;">
                <?php
                    if ( is_user_in_role( 'administrator' ) ) {
                        wp_nav_menu( 
                            array(
                                'theme_location' => 'auth-menu',
                                'container' => false,
                                'menu_class' => '',
                                'fallback_cb' => '__return_false',
                                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                                'depth' => 2,
                                'walker' => new bootstrap_5_wp_nav_menu_walker()
                            )
                        );
                    } else {
                        wp_nav_menu( 
                            array(
                                'theme_location' => 'unauth-menu',
                                'container' => false,
                                'menu_class' => '',
                                'fallback_cb' => '__return_false',
                                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                                'depth' => 2,
                                'walker' => new bootstrap_5_wp_nav_menu_walker()
                            )
                        );
                    }
                ?>
                <div class="d-flex">
                    <?php echo do_blocks( '<!-- wp:woocommerce/mini-cart {"addToCartBehaviour":"open_drawer","productCountVisibility":"always"} /-->' ); ?>
                </div>
            </div>
        </div>
    </nav>
</header>