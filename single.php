<?php ?>
<?php get_header(); ?>
<div class="page-padding content-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 single-post">
                <div class="row">
                    <div class="col">
                        <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : ?>
                                <?php the_post(); ?>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid featured-image" alt="<?php echo the_title(); ?>" />
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri() . "/assets/img/default-post-image.jpg" ?>" class="img-fluid featured-image" alt="<?php echo the_title(); ?>" />
                                <?php endif; ?>
                                <h1><?php the_title(); ?></h1>
                                <p class="post-datetime">Posted: <?php echo get_post_time('d M Y H:i'); ?> | Read Time: <?php echo ghac_estimated_read_time( get_the_content() ); ?></p>
                                <?php the_content(); ?>
		                    <?php endwhile; ?>
                            <div class="row">
                                <?php the_posts_navigation(); ?>
                                <div class="col-xs-12 col-md-6">
                                    <?php if ( get_previous_post_link() ) : ?>
                                        <?php previous_post_link(); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <?php if ( get_next_post_link() ) : ?>
                                        <?php next_post_link(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <?php dynamic_sidebar( 'posts-widget' ); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>