<?php 
/*
	Template Name: Page - Blank
*/
?>
<?php get_header(); ?>
<div>
	<?php
		if(have_posts()) : 
            while(have_posts()) : 
                the_post();
			    the_content();
		    endwhile; 
        endif;
	?>
</div>
<?php get_footer(); ?>