<?php

// Template Name: Research

 get_header();

?>

<section class="header-nav research">
	<div class="wrapper group">
		<h1 class="page-title">
			<?php //the_title(); ?>
		</h1>
	</div>
</section>
<article class="page-wrapper group">
	<div class="content">
    <div class="group bottom-nav" id="learn_more_link">
        <?php echo dbdb_prev_page_link(); ?><?php echo dbdb_next_page_link(); ?>
    </div>

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div class="post group">

			<?php the_content(); ?>
		</div>

		<?php endwhile; ?>

		<div class="group bottom-nav" id="learn_more_link"><?php echo dbdb_prev_page_link(); ?><?php echo dbdb_next_page_link(); ?></div>
	</div>

    <!-- aside class=group starts -->

	<aside class="group">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-research') ) ?>
		</aside>
</article>


    <!-- Banner -->

    <div class="research-talk-banner">
    <h2>Talk to us about franchising with closet factory  <span><a href="tel:555-555-5555">call 555-555-5555</a></span></h2>
    </div>



<section id="req-form" class="group">
	<div class="split-content darkform">
		    <?php gravity_form(4, true, true, false, '', true, 12); ?>
	</div>
</section>

<section id="featured-posts">
    <div class="wrapper group">
        <h2>Recent Franchise Articles</h2>
        <p>Lorem ipsum dolor sit amet, vel at brute aeque epicuri Lorem ipsum dolor sit amet</p>
        <div class="col-container">
            <?php
            // WP_Query arguments -- order by post title ascending order
            // may want to change this to most recent featured by data --sf

            $args = array ('posts_per_page' => 3, 'category_name' => 'featured', 'orderby' => 'title', 'order' => 'ASC');

            // The Query
            $query = new WP_Query( $args );
            // The Loop
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>

                    <div class="group-container">
                        <div class="featured-thumb"> <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
                                <?php if ( has_post_thumbnail() )
                                {
                                    the_post_thumbnail('default-post-footer');
                                } else
                                {
                                    ?>
                                    <img src="<?php bloginfo('template_directory'); ?>/images/default-post-footer.jpg" >
                                <?php
                                }
                                ?>
                            </a>
                        </div>

                        <!-- featured-thumb -->
                        <div class="featured-title"> <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a> </div>

                        <!-- featured-title -->
                        <div class="description">
                            <?php wpe_excerpt('wpe_excerptlength_small', 'wpe_excerptmore'); ?>
                        </div>
                        <!-- learn more button -->

                        <div class="learn_more_link">
                            <a href="<?php the_permalink()?>">Learn More <i class="fa fa-angle-right"></i></a>
                        </div>

                    </div>
                <?php }
            }
            // Restore original Post Data
            wp_reset_postdata();

            ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
