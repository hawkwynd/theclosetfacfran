<?php 

/* TABLE OF CONTENTS */
/*

:: THUMBNAILS
:: WIDGET AREAS
:: MENUS
:: ADD SLUG TO BODY TAG
:: REMOVE IMAGES FROM P TAG
:: LOAD JQUERY PROPERLY
:: GOOGLE HTML5 SHIM
:: LOAD FONT AWESOME
:: COMMENTS
:: WP GALLERY 
:: EXCERPTS

*/

/* THUMBNAILS */

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(200, 200, true); // Normal post thumbnails

// Create custom sizes
// This is then pulled through to your theme useing the_post_thumbnail('custombig');
if ( function_exists( 'add_image_size' ) ) {
	add_image_size('featured', 1200, 300, true); //narrow column
	add_image_size('custombig', 400, 500, true); //wide column
	add_image_size('blog-featured', 200, 200, true); // blog post
	add_image_size('footer-featured-image', 125, 125, true); // blog post
}


/* WIDGETS */

// Sidebar Home
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Sidebar Home',
	'id' => 'sidebar-home',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title">',
	'after_title' => '</div>',	
));

// Sidebar Research
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Sidebar Research',
	'id' => 'sidebar-research',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title">',
	'after_title' => '</div>',	
));

// Sidebar Blog
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Sidebar Blog',
	'id' => 'sidebar-blog',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title">',
	'after_title' => '</div>',	
));

// Featured Footer Posts
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Featured Footer Posts',
	'id' => 'featured-footer-posts',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="footer-title">',
	'after_title' => '</div>',	
));

// Footer Navigation
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Footer Navigation',
	'id' => 'footer-navigation',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="footer-title">',
	'after_title' => '</div>',	
));

// Research Landing Page
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Header Socials',
	'id' => 'header-socials',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title">',
	'after_title' => '</div>',	
));

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

/* MENUS */


// Add custom menus
register_nav_menus( array(
	'header' => __( 'Header Navigation', 'wpfme' ),
) );



/* ADD SLUG TO BODY TAG */

function wpfme_has_sidebar($classes) {
    if (is_active_sidebar('sidebar')) {
        // add 'class-name' to the $classes array
        $classes[] = 'has_sidebar';
    }
    // return the $classes array
    return $classes;
}
add_filter('body_class','wpfme_has_sidebar');


/* REMOVE IMAGES FROM P TAG */

function wpfme_remove_img_ptags($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'wpfme_remove_img_ptags');


/* LOAD JQUERY PROPERLY */

// Call the google CDN version of jQuery for the frontend
// Make sure you use this with wp_enqueue_script('jquery'); in your header
function wpfme_jquery_enqueue() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", false, null);
	wp_enqueue_script('jquery');
}
if (!is_admin()) add_action("wp_enqueue_scripts", "wpfme_jquery_enqueue", 11);


/* GOOGLE HTML5 SHIM */

function wpfme_IEhtml5_shim () {
	global $is_IE;
	if ($is_IE)
	echo '<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';
}
add_action('wp_head', 'wpfme_IEhtml5_shim');



/**
 * Load Font Awesome
 */
function load_FontAwsome() {

	wp_enqueue_style( 'nsfs_fran-fa-1', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

}
add_action( 'wp_enqueue_scripts', 'load_FontAwsome' );



/* COMMENTS */
/*
* @return void
* @author Keir Whitaker
*/

function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; 
	?>
	<?php if ( $comment->comment_approved == '1' ): ?>	
	<li>
		<article id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment ); ?>
			<h4><?php comment_author_link() ?></h4>
			<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
			<?php comment_text() ?>
		</article>
	<?php endif; ?>
	</li>
	<?php 
}

/* WP GALLERY */

//deactivate WordPress function
remove_shortcode('gallery', 'gallery_shortcode');
//activate own function
add_shortcode('gallery', 'nsfs_gallery_shortcode');
//the own renamed function
function nsfs_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'dl';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'dd';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'dt';

	$columns = intval($columns);
	
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	
	
	$output = apply_filters('gallery_style', "
    <div id='$selector' class='gallery group galleryid-{$id}'>");

$i = 0;
foreach ( $attachments as $id => $attachment ) {
    $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, false, false);

    $output .= "<{$itemtag} class='gallery-item'>";
    $output .= "
        <{$icontag} class='gallery-icon'>
            $link
        </{$icontag}>";
    if ( $captiontag && trim($attachment->post_excerpt) ) {
        $output .= "
            <{$captiontag} class='gallery-caption'>
            " . wptexturize($attachment->post_excerpt) . "
            </{$captiontag}>";
    }
    $output .= "</{$itemtag}>";
    if ( $columns > 0 && ++$i % $columns == 0 )
        $output .= '';
}

$output .= "</div>\n";

return $output;
}


/* EXCERPTS */
// made all blogs 75 excerpt size.

function wpe_excerptlength_big( $length ) {
    return 75;
}
function wpe_excerptlength_small( $length ) {
    return 75;
}
function wpe_excerptmore( $more ) {
    return ' ...';
}

function wpe_excerpt( $length_callback = '', $more_callback = '' ) {
    
    if ( function_exists( $length_callback ) )
        add_filter( 'excerpt_length', $length_callback );
    
    if ( function_exists( $more_callback ) )
        add_filter( 'excerpt_more', $more_callback );
    
    $output = get_the_excerpt();
    $output = apply_filters( 'wptexturize', $output );
    $output = apply_filters( 'convert_chars', $output );
    $output = '<p>' . $output . '</p>'; // maybe wpautop( $foo, $br )
    echo $output;
}

add_filter('gform_notification', 'change_notification_format', 10, 3);
function change_notification_format( $notification, $form, $entry ) {

    //There is no concept of admin notifications anymore, so we will need to target notifications based on other criteria, such as name
    if($notification["name"] == "Admin Notification") {
    
    // change notification format to text from the default html
    $notification['message_format'] = "text";

    }

    return $notification;

}
?>