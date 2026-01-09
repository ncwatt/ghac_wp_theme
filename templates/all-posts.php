<?php 
/*
	Template Name: All Posts
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
            <div class="col-lg-3 pt-5 pt-lg-0">
                <div class="row">
                    <div class="col">
                        <?php dynamic_sidebar( 'posts-widget' ); ?>
                    </div>
                    <div class="col">
                        <div class="advert-before">Advert</div>
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3066787831298040" crossorigin="anonymous"></script>
                            <!-- GHAC Responsive Ad -->
                            <ins class="adsbygoogle"
                                style="display:block"
                                data-ad-client="ca-pub-3066787831298040"
                                data-ad-slot="8378213731"
                                data-ad-format="auto"
                                data-full-width-responsive="true">
                            </ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            <div class="advert-after"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>