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
		<div class="site-header-inner">
			<div class="container">
				<div class="row main-container between align-center nowrap-md">
					<div class="col-8 col-md site-branding">
						<div class="site-logo<?php echo ! enterprisewp_logo() ? ' is-text' : ''; ?>">
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
					<nav id="primary-navigation" class="col-4 col-md site-navigation">
						<button class="btn btn-primary menu-toggle" aria-controls="primary-menu" aria-expanded="false">
							<span class="icon icon-menu"></span>
							<span><?php esc_html_e( 'Menu', 'enterprisewp' ); ?></span>
						</button>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary-navigation',
								'container'		 => 'false',
								'menu_id'        => 'primary-menu',
								'menu_class'	 => 'nav-menu'
							) );
						?>
					</nav><!-- #site-navigation -->
					<div class="col featured-button">
						<a href="" class="btn">
							<span class="featured-button-title">Call us now</span>
							<span class="featured-button-subtitle">555-555-5555</span>
						</a>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-header-inner -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
