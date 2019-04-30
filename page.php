<?php get_header(); ?>


<article class="page-wrapper">

<div class="group">

<div class="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<h1 class="page-title"><?php the_title(); ?></h1>
<div class="divider"><img src="<?php bloginfo('template_url'); ?>/img/divider.png"></div>

<div class="post group">
	<?php the_content(); ?>
</div>
<?php endwhile; ?>

</div>


<aside class="group">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-research') ) ?>
</aside>

</div>

</article>

<?php get_footer(); ?>
