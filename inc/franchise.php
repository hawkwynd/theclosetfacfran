<?php 

/* ==============================================
ENQUEUE SCRIPTS

============================================== */



function franchise_scripts() {

    wp_register_script('twitter', 'http://platform.twitter.com/widgets.js');
    wp_enqueue_script('twitter');

    wp_register_script('google', 'https://apis.google.com/js/plusone.js');
    wp_enqueue_script('google');

    wp_register_script('linkedin', 'http://platform.linkedin.com/in.js');
    wp_enqueue_script('linkedin');

    
    wp_enqueue_script( 'nsfs_fgformcollapse', get_template_directory_uri() . '/js/gform-collapse.js', array(), '20130115', true );


    wp_enqueue_style( 'nsfs_franchise_styles', THEMEROOT . '/css/franchise.css' );

}    

add_action('wp_enqueue_scripts', 'franchise_scripts');


/* ==============================================

SET GRAVITY FORMS OUTPUT TO TEXT

============================================== */



add_action("gform_notification_format", "set_notification_format", 10, 4);

function set_notification_format($format, $notification_type, $form, $lead){



    if($notification_type == "admin")

        return "text"; //setting admin notifications as text

    else   

        return "html"; //setting user notifications as text

}





/* ==============================================

OUTPUT SITE SOCIALS

============================================== */



function site_socials($type=''){	

	global $post;

	

	if ($type=='site') {

		$url = get_bloginfo('url');

		$txt = get_bloginfo('description');

	} else { 

		$url = get_permalink();

		$txt = get_the_title();

	}

?>

<ul class="social-links">

<li class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-text="<?php echo $txt?>" data-url="<?php echo $url?>" data-count="horizontal">Tweet</a></li>

<li class="facebook"><iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $url?>&amp;send=false&amp;layout=button_count&amp;width=85&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=trebuchet+ms&amp;height=21&amp;appId=267573989932748" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe></li>

<li class="google"><g:plusone size="medium" href="<?php echo $url?>"></g:plusone></li>

<li class="linkedin"><script type="in/share" data-url="<?php echo $url?>" data-counter="right"></script></li>

</ul>

<?php

}





/* ==============================================

GENERATE NEXT/PREVIOUS LINKS FOR RESEARCH PAGES

============================================== */



function relative_value_array($array, $current_val = '', $offset = 1) {

    $values = array_values($array);

    $current_val_index = array_search($current_val, $values);

 

    if( isset($values[$current_val_index + $offset]) ) {

        return $values[$current_val_index + $offset];

    }



    return false;

};



// previous page link function

function dbdb_prev_page_link($place) {

    global $post;

    if (isset($post->post_parent) && $post->post_parent > 0 ) {

        $children = get_pages('&sort_column=menu_order&sort_order=asc&child_of='.$post->post_parent.'&parent='.$post->post_parent);

    };



    // throw the children ids into an array
    

    foreach( $children as $child ) { $child_id_array[] = $child->ID; }



    $prev_page_id = relative_value_array($child_id_array, $post->ID, -1);



    $output = '';



    if( '' != $prev_page_id ) {

        if ($place == 'top') {
            $prev = 'previous-step-top';
        } else {
            $prev = 'previous-step-bottom';
        }

        $output .= '<div class="previous-step"><i class="fa fa-angle-left"></i><a href="' . get_page_link($prev_page_id) . '" class="button ' . $prev . '">Previous</a></div>';



    }

    return $output;

};



//next page link function



function dbdb_next_page_link($place) {

    global $post;

    if (isset($post->post_parent) && $post->post_parent != 0 ) {

        $children = get_pages('&sort_column=menu_order&sort_order=asc&child_of='.$post->post_parent.'&parent='.$post->post_parent);



    // throw the children ids into an array

    foreach( $children as $child ) { $child_id_array[] = $child->ID; }

    $next_page_id = relative_value_array($child_id_array, $post->ID, 1);

    $output = '';

    if ($place == 'top') {
        $next = 'next-step-top';
    } else {
        $next = 'next-step-bottom';
    }



    if( '' != $next_page_id ) {
        $output .= '<div class="next-step"><a href="' . get_page_link($next_page_id) . '" class="button ' . $next . '">Next Step <i class="da fa-chevron-right"></i></a></div>';
    } else { 
		$output .='<div class="next-step"><a href="/request-franchise-information" class="button ' . $next . '">Next Step <i class="da fa-chevron-right"></i></a></div>';
	}
    return $output;
    }
}





/* ==============================================

GLOBAL ANALYTICS ADMIN PANEL

============================================== */



add_action( 'admin_init', 'theme_options_init' );

add_action( 'admin_menu', 'theme_options_add_page' ); 



function theme_options_init(){

 register_setting( 'sample_options', 'sample_theme_options');

} 



function theme_options_add_page() {

	add_menu_page('Analytics Options', 'Analytics', 'administrator', 'theme_options', 'theme_options_do_page', '', '200');	

} 



function theme_options_do_page() { 

global $select_options; 

if ( ! isset( $_REQUEST['settings-updated'] ) ) $_REQUEST['settings-updated'] = false; 

?>



<div class="wrap">

<h2>Analytics</h2>

<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>

<div>

<p><strong><?php _e( 'Options saved', 'customtheme' ); ?></strong></p></div>

<?php endif; ?> 





<form method="post" action="options.php">

<?php settings_fields( 'sample_options' ); ?>  

<?php $options = get_option( 'sample_theme_options' ); ?>



<table class="form-table">



<tr><th><label>Site-Wide Analytics Code (header)</label></th>

<td>

<textarea id="sample_theme_options[sitewide-header]" cols="70" rows="8" name="sample_theme_options[sitewide-header]"><?php echo esc_textarea( $options['sitewide-header'] ); ?></textarea>

</td>

</tr>



</table>



<p class="submit">

<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />

</p>

</form>

</div>

<?php } 





/* ==============================================

PER-PAGE ANALYTICS CUSTOM FIELD

============================================== */



add_action('wp_insert_post', 'set_default_custom_field');

 

function set_default_custom_field($post_id) {

    if ( $_GET['post_type'] == 'page' ) {

		add_post_meta($post_id, 'analytics', '', true);

 	}

 

    return true;

}





/* ==============================================

GLOBAL AND PER PAGE ANALYTICS OUTPUT

============================================== */



add_action('wp_footer', 'output_analytics');



function output_analytics() {


	//output global analytics

	if (is_page()) {

		global $wp_query;

		$postid = $wp_query->post->ID;

		$analytics=get_post_meta($postid, 'analytics', true);

		if (!empty($analytics)) { 

            echo $analytics; 

        } else {

	        //output sitewide analytics

            $options = get_option('sample_theme_options');

            echo $options['sitewide-header'];

        }

	}



}



/* ==============================================

SHOW CHILDREN PAGES WIDGET

============================================== */



class ChildPageWidget extends WP_Widget {

	function ChildPageWidget() {

    	$widget_ops = array('classname' => 'ChildPageWidget', 'description' => 'Displays children pages' );

    	$this->WP_Widget('ChildPageWidget', 'Child Pages', $widget_ops);

  	}

 

	function form($instance) {

    	$instance = wp_parse_args( (array) $instance, array( 'title' => '','parent'=> '' ) );

    	$title = $instance['title'];

    	$parent = $instance['parent'];

	?>

  	<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

  	<p><label for="<?php echo $this->get_field_id('parent'); ?>">Parent Page: <input size="3" id="<?php echo $this->get_field_id('parent'); ?>" name="<?php echo $this->get_field_name('parent'); ?>" type="text" value="<?php echo attribute_escape($parent); ?>" /></label></p>

	<?php

  	}

 

  	function update($new_instance, $old_instance) {

    	$instance = $old_instance;

    	$instance['title'] = $new_instance['title'];

    	$instance['parent']=$new_instance['parent'];

    	return $instance;

  	}

 

	function widget($args, $instance) {

    	extract($args, EXTR_SKIP);

 

		

	ob_start(); 

	
	$image = get_bloginfo('template_url').'/images/research-headline.png';
	
	
	?>
	
	

	<? echo ob_get_clean(); 

		

    	echo $before_widget;

    	$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

    	$parent = $instance['parent'];

     

    	if (!empty($title))

			echo $before_title . $title . $after_title;;

 

		// WIDGET CODE GOES HERE

        $walker = new Walker_SB_Nav_Menu;

        $args = array(
            'order_by'      => 'menu_order',
            'order'         => 'asc',
            'title_li'      => '',
            'child_of'      => $parent,
            'echo'          => 0,
            'walker'        => $walker
        );

  		$children = wp_list_pages($args);

  		if ($children) { ?>
       <!-- <img class="research-headline" src="<?php //echo $image;?>" alt="research-headline" width="121" height="121" />-->


  			<ul>

  			<?php echo $children; ?>

  			</ul>

  		<?php }

 

    	echo $after_widget;

  	}

}

add_action( 'widgets_init', create_function('', 'return register_widget("ChildPageWidget");') );





/* ==============================================

FEATURED POSTS WIDGET

============================================== */



class FeaturedPostWidget extends WP_Widget {

	function FeaturedPostWidget() {

    	$widget_ops = array('classname' => 'FeaturedPostWidget', 'description' => 'Displays posts from the "featured" category' );

    	$this->WP_Widget('FeaturedPostWidget', 'Featured Posts', $widget_ops);

  	}

 

	function form($instance) {

    	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'num' ) );

    	$title = $instance['title'];

		$num = $instance['num'];

	?>

  	<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

	<?php

  	}

 

  	function update($new_instance, $old_instance) {

    	$instance = $old_instance;

    	$instance['title'] = $new_instance['title'];

    	return $instance;

  	}

 

	function widget($args, $instance) {

    	extract($args, EXTR_SKIP);

 

    	echo $before_widget;

    	$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);



    	if (!empty($title))

			echo $before_title . $title . $after_title;;

 

		// WIDGET CODE GOES HERE
		$args = array('posts_per_page' => 6,
					  'category_name' => 'featured',
					 );


		$featured_posts = new WP_Query( $args );
		
		echo '<div class="list-container"><div class="module"><ul>';
		
		if ($featured_posts->have_posts() ) {
			while ( $featured_posts->have_posts() ) { 
				$featured_posts->the_post();
                        
				?>
	
				<li><div class="featured-thumb">
					<a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail('footer-featured-image'); } else {
	   					echo '<img src="http://placehold.it/500x500">';					
					  } ?></a></div>
	
				<div class="featured-title">
				<a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				<div class="readmore"><a href="<?php the_permalink()?>">Read More</a></div>
	
				</div></li>

				<?php 
			}
		}
		echo '</ul></div></div>';

    	echo $after_widget;

  	}

}

add_action( 'widgets_init', create_function('', 'return register_widget("FeaturedPostWidget");') );
