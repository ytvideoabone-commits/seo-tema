<?php
/**
 * Pricing section.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$packages = array(
	'bronze' => array( 'color' => 'primary' ),
	'silver' => array( 'color' => 'secondary', 'badge' => __( 'EN POPÜLER', 'seo-tema' ) ),
	'gold'   => array( 'color' => 'tertiary' ),
);
?>
<section id="paketler" class="pricing-section">
	<div class="container">
		<div class="section-heading">
			<h2><?php esc_html_e( 'Uzman Backlink Paketleri', 'seo-tema' ); ?></h2>
			<p><?php esc_html_e( 'İhtiyacınıza uygun, yüksek otoriteli ve organik büyümeyi hedefleyen SEO paketlerimiz.', 'seo-tema' ); ?></p>
		</div>
		<div class="pricing-grid">
			<?php foreach ( $packages as $slug => $meta ) : ?>
				<?php
				$is_featured = (bool) seo_tema_get_option( $slug . '_featured' );
				$features    = preg_split( '/\r\n|\r|\n/', (string) seo_tema_get_option( $slug . '_features' ) );
				?>
				<article class="pricing-card <?php echo $is_featured ? 'is-featured' : ''; ?>">
					<?php if ( $is_featured && ! empty( $meta['badge'] ) ) : ?>
						<span class="badge"><?php echo esc_html( $meta['badge'] ); ?></span>
					<?php endif; ?>
					<h3><?php echo esc_html( seo_tema_get_option( $slug . '_name' ) ); ?></h3>
					<div class="price text-<?php echo esc_attr( $meta['color'] ); ?>">
						<?php echo esc_html( seo_tema_get_option( $slug . '_price' ) ); ?>
						<span><?php echo esc_html( seo_tema_get_option( $slug . '_period' ) ); ?></span>
					</div>
					<ul>
						<?php foreach ( $features as $feature ) : ?>
							<?php if ( trim( (string) $feature ) ) : ?>
								<li><span class="material-symbols-outlined" aria-hidden="true">check_circle</span><?php echo wp_kses_post( $feature ); ?></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
					<a class="btn <?php echo $is_featured ? '' : 'btn-outline'; ?>" href="<?php echo esc_url( seo_tema_get_option( $slug . '_button_url' ) ); ?>"><?php echo esc_html( seo_tema_get_option( $slug . '_button_text' ) ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
