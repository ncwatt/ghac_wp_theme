<?php 
/*
	Template Name: Club Records
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
                        <hr />
                        <?php the_post(); ?>
                        <?php the_content(); ?>
		            <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 pt-4 pt-lg-0">
                <?php dynamic_sidebar( 'club-records-widget' ); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>