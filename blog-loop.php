<?php 
	$x=1;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
	query_posts('posts_per_page=3&post_type=post&paged='.$paged);
	
	if ( have_posts() ) : while ( have_posts() ) : the_post();

		// is this a full post or a half post? Check to see if we've done two itinerations.
		if ($x>2){ 
			$class = "blog-big";
		} else { 
			$class="blog-big"; 
		}
	
		// toss in some logic using the mod operator to determine how and when to output rows.
	//	if ($x<=2 OR ($x>2 AND $x%2!=0)) {
    //			echo '<div class="post group">';
    //		}
		
?>
		
<div class="<?php echo $class;?> group">

	<div class="blog-image">
		<a href="<?php the_permalink();?>">
        <?php
			
			if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
			the_post_thumbnail('blog-featured');
			} else { ?>
			    <!-- nothing else matters -->
			<?php }?>
		</a>
		
	</div>
	
	<div class="blog-content">
		<div class="time"><?php the_time('F jS, Y') ?></div>
		<h2 class="home-h2">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </h2>
				
		<?php
			
        // show social networking only if we're doing full posts
        echo $class === 'blog-big' ? '<div class="group blog-listing-socials">'. site_socials() . '</div>' : '';
        // show excerpt 1 for big
        if ($class=='blog-big') wpe_excerpt('wpe_excerptlength_big', 'wpe_excerptmore');
        // show excerpt 1 for big
        if ($class=='blog-small') wpe_excerpt('wpe_excerptlength_small', 'wpe_excerptmore'); ?>

        <div class="learn_more_link">
            <a  href="<?php the_permalink();?>">read more <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
	
<?php
	endwhile;
    endif;

    if(function_exists('wp_paginate')) {
        wp_paginate();
    }

?>