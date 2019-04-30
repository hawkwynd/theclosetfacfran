<?php //Template Name: Blog ?>

<?php get_header(); ?>

<section class="header-nav research">
    <div class="wrapper group"></div>
</section>

<section class="page-wrapper">
    <div class="group">
        <article class="blog content">
            <?php if (have_posts()): ?>

                <?php if (is_category()):  ?>
                   <h2><?php echo single_cat_title( '', false ); ?> posts</h2>

                <?php endif;?>

                <?php while (have_posts()): the_post(); ?>

                    <div class="post group">

                        <div class="blog-big group">

                            <div class="blog-image">
                                <a href="<?php the_permalink();?>">
                                    <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
                                        the_post_thumbnail('blog-featured');
                                        }?>
                                </a>

                            </div>

                            <div class="blog-content">
                                <div class="time"><?php the_time('F jS, Y') ?></div>
                                <h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                <?php wpe_excerpt('wpe_excerptlength_big', 'wpe_excerptmore'); ?>

                                <div class="learn_more_link">
                                    <a href="<?php the_permalink()?>">Learn More <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div><!--content-->

                        </div><!--blog-bog-->

                    </div><!--post-->

                <?php endwhile;?>

            <?php else : ?>

                <p class="b i">Sorry, "<?php echo get_search_query(); ?>" triggered no results.</p>

            <?php endif; ?>

            <?php if(function_exists('wp_paginate')) {wp_paginate();} ?>
        </article>

        <aside class="group">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog') ) ?>
        </aside>

    </div>

</section>

<?php get_footer(); ?>
