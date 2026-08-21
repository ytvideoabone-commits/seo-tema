<?php
/**
 * 404 template.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="site-main content-page not-found-page">
	<div class="container">
		<h1>404</h1>
		<p><?php esc_html_e( 'Aradığınız sayfa bulunamadı.', 'seo-tema' ); ?></p>
		<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Ana sayfaya dön', 'seo-tema' ); ?></a>
	</div>
</main>
<?php
get_footer();
