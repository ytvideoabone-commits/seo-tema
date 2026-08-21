<?php
/**
 * Footer template.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$footer_description = seo_tema_get_option( 'footer_description' );
$copyright          = seo_tema_get_option( 'footer_copyright' );
$site_name          = get_bloginfo( 'name' );
?>
<footer class="site-footer">
	<div class="container footer-inner">
		<div class="footer-brand">
			<h2><?php echo esc_html( $site_name ); ?></h2>
			<?php if ( $footer_description ) : ?>
				<p><?php echo wp_kses_post( $footer_description ); ?></p>
			<?php endif; ?>
		</div>
		<nav aria-label="<?php esc_attr_e( 'Footer Menu', 'seo-tema' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'menu menu-footer',
					'fallback_cb'    => 'seo_tema_footer_menu_fallback',
				)
			);
			?>
		</nav>
		<div class="footer-copy">
			<?php echo wp_kses_post( $copyright ? $copyright : '© ' . gmdate( 'Y' ) . ' ' . $site_name ); ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
