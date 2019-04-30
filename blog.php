<?php
    /* Template Name: Franchise Blog */

    get_header();
?>

<section class="header-nav research">
	<div class="wrapper group">
		 <!-- <h1 class="page-title">Discover the latest stories from our blog</h1> -->
	</div>
</section>


<section class="page-wrapper">
    <div class="group">
        <article class="blog content">
            <?php include 'blog-loop.php'; ?>
        </article>

        <aside class="group">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog') ) ?>
        </aside>

    </div><!-- group --->
</section><!-- section -->

<?php
    get_footer();
?>