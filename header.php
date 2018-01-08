<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EnterpriseWP
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'enterprisewp' ); ?></a>

	<header id="masthead" class="site-header">

		<div class="container">
			<div class="row between align-center">
				<div class="col-8 col-xs-auto site-branding">
					<div class="site-logo">
						<?php if ( enterprisewp_logo() ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo esc_url( enterprisewp_get_logo() ); ?>" alt="<?php echo get_bloginfo( 'name' ) . ' logo.'; ?>" />
							</a>
						<?php else : ?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
							<?php $description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php endif; ?>
						<?php endif; ?>
					</div><!-- .site-logo -->
				</div><!-- .site-branding -->
				<nav id="primary-navigation" class="col-4 site-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'enterprisewp' ); ?></button>
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary-navigation',
							'container'		 => 'false',
							'menu_id'        => 'primary-menu',
							'menu_class'	 => 'nav-menu'
						) );
					?>
				</nav><!-- #site-navigation -->
			</div><!-- .row -->
		</div><!-- .container -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
