<?php
/**
 * References section.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = array(
	array(
		'keyword' => seo_tema_get_option( 'ref_1_keyword' ),
		'old'     => seo_tema_get_option( 'ref_1_old_rank' ),
		'new'     => seo_tema_get_option( 'ref_1_new_rank' ),
		'growth'  => seo_tema_get_option( 'ref_1_growth' ),
	),
	array(
		'keyword' => seo_tema_get_option( 'ref_2_keyword' ),
		'old'     => seo_tema_get_option( 'ref_2_old_rank' ),
		'new'     => seo_tema_get_option( 'ref_2_new_rank' ),
		'growth'  => seo_tema_get_option( 'ref_2_growth' ),
	),
	array(
		'keyword' => seo_tema_get_option( 'ref_3_keyword' ),
		'old'     => seo_tema_get_option( 'ref_3_old_rank' ),
		'new'     => seo_tema_get_option( 'ref_3_new_rank' ),
		'growth'  => seo_tema_get_option( 'ref_3_growth' ),
	),
);
?>
<section id="referanslar" class="references-section">
	<div class="container">
		<div class="section-heading">
			<h2><?php esc_html_e( 'SERP Domination', 'seo-tema' ); ?></h2>
			<p><?php esc_html_e( 'Müşterilerimizin başarılarına ortak oluyoruz. Gerçek veriler, gerçek sonuçlar.', 'seo-tema' ); ?></p>
		</div>
		<div class="references-grid">
			<?php foreach ( $items as $item ) : ?>
				<article class="reference-card">
					<div class="tag"><?php echo esc_html( __( 'Keyword: ', 'seo-tema' ) . $item['keyword'] ); ?></div>
					<div class="stats">
						<div><small><?php esc_html_e( 'Eski Sıra', 'seo-tema' ); ?></small><strong><?php echo esc_html( $item['old'] ); ?></strong></div>
						<div><small><?php esc_html_e( 'Yeni Sıra', 'seo-tema' ); ?></small><strong class="text-secondary"><?php echo esc_html( $item['new'] ); ?></strong></div>
					</div>
					<p class="growth"><?php echo esc_html( $item['growth'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
