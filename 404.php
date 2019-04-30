<?php get_header(); ?>

<article class="page-wrapper">

<div class="group">

<div class="content">


<h1 class="page-title">404 Not Found</h1>
<div class="group">
	<p>Sorry, the page you were looking for was not found.</p>
</div>
</div>

<aside class="group">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home_right_1') ) ?>
</aside>

</div>

</article>

<?php get_footer(); ?>
