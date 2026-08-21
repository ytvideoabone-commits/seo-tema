<?php
/**
 * Header template.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$header_cta_text = seo_tema_get_option( 'header_cta_text' );
$header_cta_url  = seo_tema_get_option( 'header_cta_url' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<nav class="top-nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'seo-tema' ); ?>">
		<div class="container nav-inner">
			<div class="branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php elseif ( seo_tema_get_option( 'logo_url' ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link"><img src="<?php echo esc_url( seo_tema_get_option( 'logo_url' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" loading="lazy" /></a>
				<?php else : ?>
					<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
			</div>
			<button class="mobile-menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-menu">
				<span class="material-symbols-outlined" aria-hidden="true">menu</span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menüyü aç', 'seo-tema' ); ?></span>
			</button>
			<div class="desktop-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'menu menu-primary',
						'fallback_cb'    => 'seo_tema_primary_menu_fallback',
					)
				);
				?>
			</div>
			<?php if ( $header_cta_text ) : ?>
				<a href="<?php echo esc_url( $header_cta_url ); ?>" class="btn btn-header-cta"><?php echo esc_html( $header_cta_text ); ?></a>
			<?php endif; ?>
		</div>
		<div id="mobile-menu" class="mobile-menu" hidden>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'menu menu-mobile',
					'fallback_cb'    => 'seo_tema_primary_menu_fallback',
				)
			);
			?>
			<?php if ( $header_cta_text ) : ?>
				<a href="<?php echo esc_url( $header_cta_url ); ?>" class="btn btn-header-cta mobile-cta"><?php echo esc_html( $header_cta_text ); ?></a>
			<?php endif; ?>
		</div>
	</nav>
</header>
