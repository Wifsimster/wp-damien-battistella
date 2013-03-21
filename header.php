<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Wifsimster
 * @since Wifsimster 0.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' )?>">
	<title>
		<?php
			global $page, $paged;
			wp_title('|', true, 'right');
			bloginfo('name');
		?>
	</title>

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url') ?>">

	<!-- Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>

	<!-- jQuery & plugins -->
	<script src="<?php bloginfo('stylesheet_directory') ?>/javascripts/jquery-1.8.2.js"></script>
	<script src="<?php bloginfo('stylesheet_directory') ?>/javascripts/jquery-nivo-slider.js"></script>
	<script src="<?php bloginfo('stylesheet_directory') ?>/javascripts/jquery-lazyload.js"></script>

	<!-- Bootstrap & plugins -->		
	<script src="<?php bloginfo('stylesheet_directory') ?>/javascripts/bootstrap.js"></script>

	<?php
		wp_head();
	?>
</head>
<body <?php body_class(); ?>>
	<?php include_once('slider.php') ?>

	<script src="<?php bloginfo('template_directory') ?>/controllers/javascripts/user/bubble.js"></script>
	<script src="<?php bloginfo('template_directory') ?>/controllers/javascripts/user/avatar.js"></script>
	<script src="<?php bloginfo('template_directory') ?>/controllers/javascripts/news/ending-transition.js"></script>
	<script src="<?php bloginfo('template_directory') ?>/controllers/javascripts/news/opening-transition.js"></script>

	<div class="container">				
		<?php include_once('navbar.php') ?>
		<div id="welcome"></div>
		<div id="avatar">
			<div id="circle">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/avatars/avatar_02.png">
			</div>
		</div>
		<div id="bubble" class="left hide"><p>Yeah, tu peux cliquer sur ma photo pour me découvrir ;)</p></div>
		<div id="pageContent" class="hide">
			<section>
				<div class="timeline-header">&nbsp;</div>
			</section>
