<?php
/* Template Name: Full Page */
?>

<?php get_header(); ?>
<section class="header-nav research">
	<div class="wrapper group">
		<h1 class="page-title">
			<?php //the_title(); ?>
		</h1>
	</div>
</section>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<article class="page-wrapper">
<div class="group">
	<?php the_content(); ?>
</div>

</article>
<?php endwhile; ?>

    <section id="req-form" class="group">
        <div class="split-content darkform">

            <?php gravity_form(3, true, true, false, '', true, 12); ?>

        </div>
    </section>


<?php get_footer(); ?>