<?php get_header(); ?>

<section class="header-nav research">
	<div class="wrapper group"></div>
</section>

<article class="page-wrapper">

<div class="group">

<div class="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="group blog-listing-socials"><?php site_socials();?></div>

<div class="post group">
	<?php the_content(); ?>
	
</div>
<?php comments_template( '', true ); ?>
<?php endwhile; ?>

</div>


<aside class="group">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog') ) ?>
</aside>

</div>

</article>

<?php get_footer(); ?>
