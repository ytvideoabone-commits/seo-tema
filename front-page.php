<?php
/**
 * Front page template.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="primary" class="site-main landing-page">
	<?php get_template_part( 'template-parts/hero' ); ?>
	<?php get_template_part( 'template-parts/pricing' ); ?>
	<?php get_template_part( 'template-parts/references' ); ?>
	<?php get_template_part( 'template-parts/contact' ); ?>
	<section class="cta-strip">
		<div class="container cta-strip-inner">
			<h2><?php esc_html_e( 'Rakiplerinizin Önüne Geçmeye Hazır mısınız?', 'seo-tema' ); ?></h2>
			<a class="btn" href="<?php echo esc_url( seo_tema_get_option( 'header_cta_url' ) ); ?>"><?php echo esc_html( seo_tema_get_option( 'header_cta_text' ) ); ?></a>
		</div>
	</section>
</main>
<?php
get_footer();
