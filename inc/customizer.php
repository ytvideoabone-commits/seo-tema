<?php
/**
 * Customizer integrations.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Lightweight customizer adjustments.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function seo_tema_customize_register( $wp_customize ) {
	if ( $wp_customize->get_setting( 'blogname' ) ) {
		$wp_customize->get_setting( 'blogname' )->transport = 'refresh';
	}
}
add_action( 'customize_register', 'seo_tema_customize_register' );
