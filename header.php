<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/Blog">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<header id="header">
		<div class="header-container">
			<div class="header-top">
				<div class="header-menu-btn">
					<i class="fa fa-bars"></i>
				</div>
				<?php ( is_front_page() && is_home() ) ? $para = 'h1' : $para = 'p'; ?>
				<<?php echo $para; ?> class="header-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="logo" rel="home"><img src="<?php header_image(); ?>" alt="<?php echo get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' ); ?>"></a>
				</<?php echo $para; ?>>
				<div class="search-box" role="search">
					<form method="get" class="fa fa-search search-form" action="<?php echo home_url('/'); ?>">
						<input type="search" placeholder="SEARCH..." value="" name="s" class="search-field" />
						<input type="submit" value="Search" />
					</form>
				</div>
			</div>
			<nav role="navigation">
				<?php wp_nav_menu(array ('theme_location' => 'primary-menu', 'container' => false, 'container_class' => '', 'menu_class' => 'header-menu', 'fallback_cb' => 'wp_page_menu') ); ?>
			</nav>
		</div>
	</header>