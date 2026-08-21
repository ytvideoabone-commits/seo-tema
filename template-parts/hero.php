<?php
/**
 * Hero section.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_image = seo_tema_get_option( 'hero_image' );
if ( ! $hero_image ) {
	$hero_image = get_template_directory_uri() . '/assets/images/hero-default.svg';
}
?>
<section class="hero-section">
	<div class="hero-bg" aria-hidden="true">
		<div class="orb orb-primary"></div>
		<div class="orb orb-secondary"></div>
	</div>
	<div class="container hero-grid">
		<div class="hero-content">
			<div class="hero-kicker"><?php echo esc_html( seo_tema_get_option( 'hero_kicker' ) ); ?></div>
			<h1>
				<span class="text-gradient"><?php echo esc_html( seo_tema_get_option( 'hero_gradient_title' ) ); ?></span>
				<?php echo esc_html( seo_tema_get_option( 'hero_title' ) ); ?>
			</h1>
			<p><?php echo wp_kses_post( seo_tema_get_option( 'hero_description' ) ); ?></p>
			<div class="hero-actions">
				<a class="btn" href="<?php echo esc_url( seo_tema_get_option( 'hero_button_1_url' ) ); ?>"><?php echo esc_html( seo_tema_get_option( 'hero_button_1_text' ) ); ?></a>
				<a class="btn btn-outline" href="<?php echo esc_url( seo_tema_get_option( 'hero_button_2_url' ) ); ?>"><?php echo esc_html( seo_tema_get_option( 'hero_button_2_text' ) ); ?></a>
			</div>
		</div>
		<div class="hero-image-wrap">
			<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'SEO başarı görseli', 'seo-tema' ); ?>" loading="lazy" />
		</div>
	</div>
</section>
