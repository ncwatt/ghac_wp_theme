<?php 
/*
	Template Name: About Section
*/
?>
<?php get_header(); ?>
<div class="page-padding content-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : ?>
                        <h1><?php the_title(); ?></h1>
                        <?php the_post(); ?>
                        <?php the_content(); ?>
		            <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3">
                <?php 
					wp_nav_menu (
						array ( 
							'theme_location'	=> 'about-section',
							'container'			=> 'li',
							'container_class'	=> '',
							'menu_class'		=> 'useful-links-ul',
							'add_li_class'		=> ''
						)
					); 
				?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>