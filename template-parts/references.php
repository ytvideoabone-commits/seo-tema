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
	array( 'keyword' => 'şişme kamp çadırı', 'old' => '105', 'new' => '1', 'growth' => '+400% Organik Trafik Büyümesi' ),
	array( 'keyword' => 'endüstriyel dalgıçlık', 'old' => '84', 'new' => '1', 'growth' => '+250% Dönüşüm Artışı' ),
	array( 'keyword' => '185/65 R14 lastik', 'old' => 'Yeni Site', 'new' => '1', 'growth' => '50.000+ Aylık Yeni Ziyaretçi' ),
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
					<div class="tag"><?php echo esc_html( 'Keyword: ' . $item['keyword'] ); ?></div>
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
