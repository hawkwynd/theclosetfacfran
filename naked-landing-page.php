<?php //Template Name: Naked Landing Page ?>

<!doctype html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->

<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->

<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->

<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>

	<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<!-- Use the .htaccess and remove these lines to avoid edge case issues. More info: h5bp.com/i/378 -->

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- Set the viewport width to device width for mobile -->

	<link rel="shortcut icon" href="<?php bloginfo('template_url');?>/favicon.ico"/>

	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_url');?>/apple-touch-icon.png" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

	<!-- Included CSS Files (Compressed) -->

	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/reset.css">

	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/boilerplate.css">

	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/main.css">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,600,700' rel='stylesheet' type='text/css'>

	<!-- LESS JS STUFF, COMMENT ALWAYS EXCEPT WHEN WORKING ON THE SERVER

		<link rel="stylesheet/less" type="text/css" href="<?php bloginfo('template_url');?>/LESS/main.less" />

		<script src="<?php bloginfo('template_url');?>/js/less-1.3.3.min.js" type="text/javascript"></script>

	-->

	<?php wp_head(); ?>

	<!-- All JavaScript at the bottom, except this Modernizr build. Modernizr enables HTML5 elements & feature detects for optimal performance. Create your own custom Modernizr build: www.modernizr.com/download/ -->

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/modernizr.custom.55071.js"></script>

</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-N69L3K"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N69L3K');</script>
<!-- End Google Tag Manager -->


	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6. chromium.org/developers/how-tos/chrome-frame-getting-started -->

	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->





<!--HEADER ABOVE-->



<article class="page-wrapper">
<img src="<?php bloginfo('template_url');?>/img/logo-main.png" alt="logo" class="naked-logo">

<div class="group">

<div class="content">

<h1 class="page-title"><?php the_title(); ?></h1>

<?php if (have_posts()): while (have_posts()): the_post(); ?>

	<?php the_content(); ?>

	<?php gravity_form(1, true, true, false, '', false); ?>

<?php endwhile; endif; ?>

</div>

<aside class="group">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('naked-landing') ) ?>
</aside>

</div>

</article>




<!--FOOTER BELLOW-->

	<div class="group copyright">&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved. <a href="/privacy/">Privacy Policy</a>.</div>


	<?php wp_footer(); ?>

	<!-- JavaScript at the bottom for fast page loading -->

	<!-- scripts concatenated and minified via build script -->

	<script src="<?php bloginfo('template_url');?>/js/clearit.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url');?>/js/youtubefix.js" type="text/javascript"></script>

	<!-- end scripts -->

</body>

</html>
