<?php //Template Name: Research Landing Page ?>

<?php get_header(); ?>

<section class="header-nav research group">
<div class="wrapper group">
	<div class="title">Learn About Franchise</div>
	<div class="featured-image"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('featured'); } ?></div>
</div>
</section>

<article class="page-wrapper">

<div class="group">

<div class="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<h1 class="page-title"><?php the_title(); ?></h1>
<div class="divider"><img src="<?php bloginfo('template_url'); ?>/img/divider.png"></div>

<div class="group">
	<?php the_content(); ?>
</div>
<?php endwhile; ?>

</div>


<aside class="group">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('research-landing') ) ?>
</aside>

</div>

<div class="group"><?php include 'logos.php'; ?></div>

</article>

<?php get_footer(); ?>
