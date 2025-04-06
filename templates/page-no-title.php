<?php 
/*
	Template Name:  Page (no title)
*/
?>
<?php get_header(); ?>
<div class="page-padding content-1">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if(have_posts()) :  ?>
		            <?php while(have_posts()) : ?>
			            <?php the_post(); ?>
			            <?php the_content(); ?>
		            <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>