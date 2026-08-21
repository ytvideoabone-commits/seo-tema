<?php
/**
 * Pricing section.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! seo_tema_get_option( 'packages_visible' ) ) {
	return;
}

$maximum  = absint( seo_tema_get_option( 'packages_max_count' ) );
$packages = new WP_Query(
	array(
		'post_type'              => 'seo_package',
		'post_status'            => 'publish',
		'posts_per_page'         => 0 === $maximum ? -1 : $maximum,
		'meta_key'               => '_seo_package_order',
		'orderby'                => array( 'meta_value_num' => 'ASC', 'date' => 'ASC' ),
		'order'                  => 'ASC',
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
	)
);

if ( ! $packages->have_posts() ) {
	return;
}

$color_classes = array( 'text-primary', 'text-secondary', 'text-tertiary' );
$package_index = 0;
?>
<section id="paketler" class="pricing-section">
	<div class="container">
		<div class="section-heading">
			<h2><?php echo esc_html( seo_tema_get_option( 'packages_title' ) ); ?></h2>
			<p><?php echo wp_kses_post( seo_tema_get_option( 'packages_description' ) ); ?></p>
		</div>
		<div class="pricing-grid">
			<?php while ( $packages->have_posts() ) : ?>
				<?php
				$packages->the_post();
				$package_id = get_the_ID();
				$is_featured = (bool) get_post_meta( $package_id, '_seo_package_featured', true );
				$features = get_post_meta( $package_id, '_seo_package_features', true );
				$features = is_array( $features ) ? $features : array();
				$color_class = $color_classes[ $package_index % count( $color_classes ) ];
				$package_index++;
				?>
				<article class="pricing-card <?php echo $is_featured ? 'is-featured' : ''; ?>">
					<?php if ( $is_featured ) : ?>
						<span class="badge"><?php echo esc_html( get_post_meta( $package_id, '_seo_package_badge', true ) ?: __( 'EN POPÜLER', 'seo-tema' ) ); ?></span>
					<?php endif; ?>
					<h3><?php echo esc_html( get_the_title() ); ?></h3>
					<div class="price <?php echo esc_attr( $color_class ); ?>">
						<?php echo esc_html( get_post_meta( $package_id, '_seo_package_price', true ) ); ?>
						<span><?php echo esc_html( get_post_meta( $package_id, '_seo_package_period', true ) ); ?></span>
					</div>
					<ul>
						<?php foreach ( $features as $feature ) : ?>
							<li><span class="material-symbols-outlined" aria-hidden="true">check_circle</span><?php echo esc_html( $feature ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="btn <?php echo $is_featured ? '' : 'btn-outline'; ?>" href="<?php echo esc_url( get_post_meta( $package_id, '_seo_package_button_url', true ) ); ?>"><?php echo esc_html( get_post_meta( $package_id, '_seo_package_button_text', true ) ); ?></a>
				</article>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php wp_reset_postdata(); ?>
