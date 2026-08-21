<?php
/**
 * Contact section.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$socials = array(
	'facebook_url'  => 'Facebook',
	'instagram_url' => 'Instagram',
	'x_url'         => 'X/Twitter',
	'linkedin_url'  => 'LinkedIn',
	'youtube_url'   => 'YouTube',
);
?>
<section id="iletisim" class="contact-section">
	<div class="container contact-grid">
		<div>
			<h2><?php echo esc_html( seo_tema_get_option( 'contact_title' ) ); ?></h2>
			<p><?php echo wp_kses_post( seo_tema_get_option( 'contact_description' ) ); ?></p>
		</div>
		<div class="contact-card">
			<ul>
				<li><strong><?php esc_html_e( 'E-posta:', 'seo-tema' ); ?></strong> <a href="mailto:<?php echo antispambot( sanitize_email( seo_tema_get_option( 'contact_email' ) ) ); ?>"><?php echo esc_html( seo_tema_get_option( 'contact_email' ) ); ?></a></li>
				<li><strong><?php esc_html_e( 'Telefon:', 'seo-tema' ); ?></strong> <a href="tel:<?php echo esc_attr( preg_replace( '/[^\d\+]/', '', (string) seo_tema_get_option( 'contact_phone' ) ) ); ?>"><?php echo esc_html( seo_tema_get_option( 'contact_phone' ) ); ?></a></li>
				<li><strong><?php esc_html_e( 'WhatsApp:', 'seo-tema' ); ?></strong> <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D+/', '', (string) seo_tema_get_option( 'contact_whatsapp' ) ) ); ?>"><?php echo esc_html( seo_tema_get_option( 'contact_whatsapp' ) ); ?></a></li>
			</ul>
			<div class="social-links">
				<?php foreach ( $socials as $key => $label ) : ?>
					<?php $url = seo_tema_get_option( $key ); ?>
					<?php if ( $url ) : ?>
						<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
