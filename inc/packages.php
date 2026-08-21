<?php
/**
 * Package post type, editor fields, list table and legacy migration.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Register the package post type. */
function seo_tema_register_package_post_type() {
	register_post_type(
		'seo_package',
		array(
			'labels' => array(
				'name'          => __( 'Paketler', 'seo-tema' ),
				'singular_name' => __( 'Paket', 'seo-tema' ),
				'menu_name'     => __( 'Paketler', 'seo-tema' ),
				'all_items'     => __( 'Tüm Paketler', 'seo-tema' ),
				'add_new'       => __( 'Yeni Paket Ekle', 'seo-tema' ),
				'add_new_item'  => __( 'Yeni Paket Ekle', 'seo-tema' ),
				'edit_item'     => __( 'Paketi Düzenle', 'seo-tema' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-cart',
			'supports'     => array( 'title' ),
			'map_meta_cap' => true,
		)
	);
}
add_action( 'init', 'seo_tema_register_package_post_type' );

/** Add package details box. */
function seo_tema_add_package_meta_box() {
	add_meta_box( 'seo-tema-package-details', __( 'Paket Detayları', 'seo-tema' ), 'seo_tema_render_package_meta_box', 'seo_package', 'normal', 'high' );
}
add_action( 'add_meta_boxes_seo_package', 'seo_tema_add_package_meta_box' );

/** Render package details box. */
function seo_tema_render_package_meta_box( $post ) {
	$features = get_post_meta( $post->ID, '_seo_package_features', true );
	$features = is_array( $features ) ? $features : array();
	wp_nonce_field( 'seo_tema_save_package', 'seo_tema_package_nonce' );
	?>
	<div class="seo-package-fields">
		<p><label for="seo-package-price"><strong><?php esc_html_e( 'Fiyat', 'seo-tema' ); ?></strong></label><input id="seo-package-price" class="widefat" type="text" name="seo_package_price" value="<?php echo esc_attr( get_post_meta( $post->ID, '_seo_package_price', true ) ); ?>"></p>
		<p><label for="seo-package-period"><strong><?php esc_html_e( 'Fiyat periyodu', 'seo-tema' ); ?></strong></label><input id="seo-package-period" class="widefat" type="text" name="seo_package_period" value="<?php echo esc_attr( get_post_meta( $post->ID, '_seo_package_period', true ) ); ?>" placeholder="/ay"></p>
		<div class="seo-package-features"><strong><?php esc_html_e( 'Özellikler', 'seo-tema' ); ?></strong><div id="seo-package-feature-list">
			<?php foreach ( $features as $feature ) : ?>
				<div class="seo-package-feature"><input class="widefat" type="text" name="seo_package_features[]" value="<?php echo esc_attr( $feature ); ?>"><button type="button" class="button-link-delete seo-package-remove-feature"><?php esc_html_e( 'Sil', 'seo-tema' ); ?></button></div>
			<?php endforeach; ?>
		</div><button type="button" class="button seo-package-add-feature"><?php esc_html_e( '+ Özellik Ekle', 'seo-tema' ); ?></button></div>
		<div class="seo-package-columns">
			<p><label for="seo-package-button-text"><strong><?php esc_html_e( 'Buton yazısı', 'seo-tema' ); ?></strong></label><input id="seo-package-button-text" class="widefat" type="text" name="seo_package_button_text" value="<?php echo esc_attr( get_post_meta( $post->ID, '_seo_package_button_text', true ) ); ?>"></p>
			<p><label for="seo-package-button-url"><strong><?php esc_html_e( 'Buton URL', 'seo-tema' ); ?></strong></label><input id="seo-package-button-url" class="widefat" type="url" name="seo_package_button_url" value="<?php echo esc_attr( get_post_meta( $post->ID, '_seo_package_button_url', true ) ); ?>"></p>
			<p><label for="seo-package-badge"><strong><?php esc_html_e( 'Öne çıkan etiketi', 'seo-tema' ); ?></strong></label><input id="seo-package-badge" class="widefat" type="text" name="seo_package_badge" value="<?php echo esc_attr( get_post_meta( $post->ID, '_seo_package_badge', true ) ?: __( 'EN POPÜLER', 'seo-tema' ) ); ?>"></p>
			<p><label for="seo-package-order"><strong><?php esc_html_e( 'Paket sırası', 'seo-tema' ); ?></strong></label><input id="seo-package-order" class="small-text" type="number" min="0" name="seo_package_order" value="<?php echo esc_attr( absint( get_post_meta( $post->ID, '_seo_package_order', true ) ) ); ?>"></p>
		</div>
		<p><label><input type="checkbox" name="seo_package_featured" value="1" <?php checked( (bool) get_post_meta( $post->ID, '_seo_package_featured', true ) ); ?>> <strong><?php esc_html_e( 'Öne çıkan paket', 'seo-tema' ); ?></strong></label></p>
	</div>
	<?php
}

/** Save package details securely. */
function seo_tema_save_package_meta( $post_id ) {
	if ( ! isset( $_POST['seo_tema_package_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['seo_tema_package_nonce'] ) ), 'seo_tema_save_package' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$text_fields = array(
		'_seo_package_price'       => 'seo_package_price',
		'_seo_package_period'      => 'seo_package_period',
		'_seo_package_button_text' => 'seo_package_button_text',
		'_seo_package_badge'       => 'seo_package_badge',
	);
	foreach ( $text_fields as $meta_key => $field_name ) {
		$value = isset( $_POST[ $field_name ] ) ? sanitize_text_field( wp_unslash( $_POST[ $field_name ] ) ) : '';
		update_post_meta( $post_id, $meta_key, $value );
	}
	$url = isset( $_POST['seo_package_button_url'] ) ? esc_url_raw( wp_unslash( $_POST['seo_package_button_url'] ) ) : '';
	update_post_meta( $post_id, '_seo_package_button_url', $url );
	update_post_meta( $post_id, '_seo_package_featured', isset( $_POST['seo_package_featured'] ) ? 1 : 0 );
	update_post_meta( $post_id, '_seo_package_order', isset( $_POST['seo_package_order'] ) ? absint( $_POST['seo_package_order'] ) : 0 );

	$features = isset( $_POST['seo_package_features'] ) && is_array( $_POST['seo_package_features'] ) ? wp_unslash( $_POST['seo_package_features'] ) : array();
	$features = array_values( array_filter( array_map( 'sanitize_text_field', $features ) ) );
	update_post_meta( $post_id, '_seo_package_features', $features );
}
add_action( 'save_post_seo_package', 'seo_tema_save_package_meta' );

/** Load the repeater assets only on package editor screens. */
function seo_tema_enqueue_package_admin_assets( $hook ) {
	$screen = get_current_screen();
	if ( ! $screen || 'seo_package' !== $screen->post_type || ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	$version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'seo-tema-packages-admin', get_template_directory_uri() . '/assets/css/packages-admin.css', array(), $version );
	wp_enqueue_script( 'seo-tema-packages-admin', get_template_directory_uri() . '/assets/js/packages-admin.js', array(), $version, true );
}
add_action( 'admin_enqueue_scripts', 'seo_tema_enqueue_package_admin_assets' );

/** Customize package list columns. */
function seo_tema_package_columns( $columns ) {
	return array(
		'cb'               => $columns['cb'],
		'title'            => __( 'Paket', 'seo-tema' ),
		'package_price'    => __( 'Fiyat', 'seo-tema' ),
		'package_period'   => __( 'Periyot', 'seo-tema' ),
		'package_featured' => __( 'Öne Çıkan', 'seo-tema' ),
		'package_order'    => __( 'Sıra', 'seo-tema' ),
		'package_status'   => __( 'Durum', 'seo-tema' ),
		'date'             => $columns['date'],
	);
}
add_filter( 'manage_seo_package_posts_columns', 'seo_tema_package_columns' );

/** Output package list values. */
function seo_tema_package_column_content( $column, $post_id ) {
	$map = array( 'package_price' => '_seo_package_price', 'package_period' => '_seo_package_period', 'package_order' => '_seo_package_order' );
	if ( isset( $map[ $column ] ) ) {
		echo esc_html( get_post_meta( $post_id, $map[ $column ], true ) );
	} elseif ( 'package_featured' === $column ) {
		echo get_post_meta( $post_id, '_seo_package_featured', true ) ? esc_html__( 'Evet', 'seo-tema' ) : '&mdash;';
	} elseif ( 'package_status' === $column ) {
		echo esc_html( get_post_status_object( get_post_status( $post_id ) )->label );
	}
}
add_action( 'manage_seo_package_posts_custom_column', 'seo_tema_package_column_content', 10, 2 );

/** Migrate the three legacy theme-option packages once. */
function seo_tema_migrate_legacy_packages() {
	if ( get_option( 'seo_tema_packages_migrated' ) ) {
		return;
	}
	$existing_packages = get_posts(
		array(
			'post_type'      => 'seo_package',
			'post_status'    => array( 'publish', 'pending', 'draft', 'future', 'private', 'trash' ),
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);
	if ( $existing_packages ) {
		update_option( 'seo_tema_packages_migrated', 1, false );
		return;
	}

	$options = seo_tema_get_options();
	$legacy  = array( 'bronze', 'silver', 'gold' );
	$created = array();
	foreach ( $legacy as $index => $slug ) {
		$post_id = wp_insert_post( array( 'post_type' => 'seo_package', 'post_status' => 'publish', 'post_title' => sanitize_text_field( $options[ $slug . '_name' ] ) ), true );
		if ( is_wp_error( $post_id ) ) {
			foreach ( $created as $created_post_id ) {
				wp_delete_post( $created_post_id, true );
			}
			return;
		}
		$created[] = $post_id;
		$features = preg_split( '/\r\n|\r|\n/', (string) $options[ $slug . '_features' ] );
		$features = array_values( array_filter( array_map( 'sanitize_text_field', $features ) ) );
		update_post_meta( $post_id, '_seo_package_price', sanitize_text_field( $options[ $slug . '_price' ] ) );
		update_post_meta( $post_id, '_seo_package_period', sanitize_text_field( $options[ $slug . '_period' ] ) );
		update_post_meta( $post_id, '_seo_package_features', $features );
		update_post_meta( $post_id, '_seo_package_button_text', sanitize_text_field( $options[ $slug . '_button_text' ] ) );
		update_post_meta( $post_id, '_seo_package_button_url', esc_url_raw( $options[ $slug . '_button_url' ] ) );
		update_post_meta( $post_id, '_seo_package_featured', empty( $options[ $slug . '_featured' ] ) ? 0 : 1 );
		update_post_meta( $post_id, '_seo_package_badge', 'silver' === $slug ? __( 'EN POPÜLER', 'seo-tema' ) : '' );
		update_post_meta( $post_id, '_seo_package_order', $index + 1 );
	}
	update_option( 'seo_tema_packages_migrated', 1, false );
}
add_action( 'init', 'seo_tema_migrate_legacy_packages', 20 );
