<?php 
/*
	Template Name:  Page (no container)
*/
?>
<?php get_header(); ?>
<div>
	<?php if( have_posts() ) :  ?>
		<?php while( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>