<?php
/**
 * Theme setup and bootstrap.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_template_directory() . '/inc/theme-settings.php';
require get_template_directory() . '/inc/customizer.php';

if ( ! function_exists( 'seo_tema_setup' ) ) {
	/**
	 * Theme supports and menus.
	 */
	function seo_tema_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array( 'height' => 64, 'width' => 240, 'flex-height' => true, 'flex-width' => true ) );
		add_theme_support( 'responsive-embeds' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'seo-tema' ),
				'footer'  => esc_html__( 'Footer Menu', 'seo-tema' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'seo_tema_setup' );

/**
 * Enqueue styles and scripts.
 */
function seo_tema_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'seo-tema-style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_style( 'seo-tema-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&family=JetBrains+Mono:wght@500&family=Material+Symbols+Outlined:wght,FILL,GRAD,opsz@100..700,0..1,0,24&display=swap', array(), null );
	wp_enqueue_style( 'seo-tema-theme', get_template_directory_uri() . '/assets/css/theme.css', array( 'seo-tema-style' ), $theme_version );

	wp_enqueue_script( 'seo-tema-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'seo_tema_enqueue_assets' );

/**
 * Fallback primary menu.
 */
function seo_tema_primary_menu_fallback() {
	$items = array(
		array( 'title' => __( 'Ana Sayfa', 'seo-tema' ), 'url' => home_url( '/' ) ),
		array( 'title' => __( 'Paketler', 'seo-tema' ), 'url' => home_url( '/#paketler' ) ),
		array( 'title' => __( 'Referanslar', 'seo-tema' ), 'url' => home_url( '/#referanslar' ) ),
		array( 'title' => __( 'İletişim', 'seo-tema' ), 'url' => home_url( '/#iletisim' ) ),
	);
	echo '<ul class="menu menu-primary">';
	foreach ( $items as $item ) {
		echo '<li><a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['title'] ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Fallback footer menu.
 */
function seo_tema_footer_menu_fallback() {
	$items = array(
		array( 'title' => __( 'Gizlilik Politikası', 'seo-tema' ), 'url' => '#' ),
		array( 'title' => __( 'Kullanım Koşulları', 'seo-tema' ), 'url' => '#' ),
		array( 'title' => __( 'KVKK', 'seo-tema' ), 'url' => '#' ),
	);
	echo '<ul class="menu menu-footer">';
	foreach ( $items as $item ) {
		echo '<li><a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['title'] ) . '</a></li>';
	}
	echo '</ul>';
}
