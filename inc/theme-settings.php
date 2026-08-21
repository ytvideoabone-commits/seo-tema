<?php
/**
 * Theme settings page.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return fallback defaults.
 *
 * @return array<string, mixed>
 */
function seo_tema_default_options() {
	return array(
		'logo_url'                => '',
		'header_cta_text'         => 'Hemen Başla',
		'header_cta_url'          => '#paketler',
		'hero_kicker'             => 'Google Rank Experts',
		'hero_title'              => 'Rise to #1 with Authority Backlinks',
		'hero_gradient_title'     => 'Dominate Google Search:',
		'hero_description'        => 'Kaliteli backlink paketlerimizle web site otoritenizi ve organik trafiğinizi artırın. Teknik SEO uzmanlığımızla rakiplerinizi geride bırakın.',
		'hero_button_1_text'      => 'Paketleri İncele',
		'hero_button_1_url'       => '#paketler',
		'hero_button_2_text'      => 'Başarı Hikayeleri',
		'hero_button_2_url'       => '#referanslar',
		'hero_image'              => '',
		'bronze_name'             => 'Bronze Paket',
		'bronze_price'            => '4,999 TL',
		'bronze_period'           => '/ay',
		'bronze_features'         => "DA 40+ Sitelerden Link\n15 Adet Tanıtım Yazısı\n100% Özgün İçerik\nHızlı İndekslenme",
		'bronze_button_text'      => 'Satın Al',
		'bronze_button_url'       => '#iletisim',
		'bronze_featured'         => 0,
		'silver_name'             => 'Gümüş Paket',
		'silver_price'            => '9,999 TL',
		'silver_period'           => '/ay',
		'silver_features'         => "DA 60+ Sitelerden Link\n30 Adet Tanıtım Yazısı\nEdu & Gov Link Desteği\nPremium İçerik Kalitesi\nDetaylı Raporlama",
		'silver_button_text'      => 'Satın Al',
		'silver_button_url'       => '#iletisim',
		'silver_featured'         => 1,
		'gold_name'               => 'Altın Paket',
		'gold_price'              => '19,999 TL',
		'gold_period'             => '/ay',
		'gold_features'           => "DA 80+ Sitelerden Link\nSınırsız Tanıtım Ağı\nÖzel Outreach Stratejisi\nUluslararası Linkler",
		'gold_button_text'        => 'Satın Al',
		'gold_button_url'         => '#iletisim',
		'gold_featured'           => 0,
		'contact_email'           => 'info@example.com',
		'contact_phone'           => '+90 555 555 55 55',
		'contact_whatsapp'        => '+90 555 555 55 55',
		'contact_title'           => 'SEO Büyümesini Hemen Başlatın',
		'contact_description'     => 'Markanıza özel backlink stratejisi için bizimle iletişime geçin.',
		'facebook_url'            => '',
		'instagram_url'           => '',
		'x_url'                   => '',
		'linkedin_url'            => '',
		'youtube_url'             => '',
		'footer_description'      => 'Gerçek veriler, gerçek sonuçlar.',
		'footer_copyright'        => '© 2024 Google Rank Experts. Tüm hakları saklıdır.',
	);
}

/**
 * Get all options merged with defaults.
 *
 * @return array<string, mixed>
 */
function seo_tema_get_options() {
	$defaults = seo_tema_default_options();
	$saved    = get_option( 'seo_tema_options', array() );
	if ( ! is_array( $saved ) ) {
		$saved = array();
	}
	return wp_parse_args( $saved, $defaults );
}

/**
 * Read one option value.
 *
 * @param string $key Option key.
 * @return mixed
 */
function seo_tema_get_option( $key ) {
	$options = seo_tema_get_options();
	return $options[ $key ] ?? '';
}

/**
 * Register settings UI.
 */
function seo_tema_register_settings_page() {
	add_theme_page(
		esc_html__( 'Tema Ayarları', 'seo-tema' ),
		esc_html__( 'Tema Ayarları', 'seo-tema' ),
		'edit_theme_options',
		'seo-tema-settings',
		'seo_tema_render_settings_page'
	);
}
add_action( 'admin_menu', 'seo_tema_register_settings_page' );

/**
 * Register setting fields.
 */
function seo_tema_register_settings() {
	register_setting( 'seo_tema_settings_group', 'seo_tema_options', 'seo_tema_sanitize_options' );

	$sections = array(
		'general'   => __( 'Genel', 'seo-tema' ),
		'hero'      => __( 'Hero', 'seo-tema' ),
		'packages'  => __( 'Paketler', 'seo-tema' ),
		'contact'   => __( 'İletişim', 'seo-tema' ),
		'social'    => __( 'Sosyal Medya', 'seo-tema' ),
		'footer'    => __( 'Footer', 'seo-tema' ),
	);

	foreach ( $sections as $id => $label ) {
		add_settings_section( 'seo_tema_section_' . $id, $label, '__return_false', 'seo-tema-settings' );
	}

	$fields = seo_tema_fields();
	foreach ( $fields as $key => $field ) {
		add_settings_field(
			$key,
			$field['label'],
			'seo_tema_render_field',
			'seo-tema-settings',
			'seo_tema_section_' . $field['section'],
			array(
				'key'  => $key,
				'type' => $field['type'],
			)
		);
	}
}
add_action( 'admin_init', 'seo_tema_register_settings' );

/**
 * Field definitions.
 *
 * @return array<string, array<string, string>>
 */
function seo_tema_fields() {
	return array(
		'logo_url'            => array( 'label' => __( 'Logo URL', 'seo-tema' ), 'type' => 'url', 'section' => 'general' ),
		'header_cta_text'     => array( 'label' => __( 'Header CTA Buton Yazısı', 'seo-tema' ), 'type' => 'text', 'section' => 'general' ),
		'header_cta_url'      => array( 'label' => __( 'Header CTA URL', 'seo-tema' ), 'type' => 'url', 'section' => 'general' ),
		'hero_kicker'         => array( 'label' => __( 'Hero Küçük Başlık', 'seo-tema' ), 'type' => 'text', 'section' => 'hero' ),
		'hero_gradient_title' => array( 'label' => __( 'Hero Gradient Başlık Bölümü', 'seo-tema' ), 'type' => 'text', 'section' => 'hero' ),
		'hero_title'          => array( 'label' => __( 'Hero Ana Başlık', 'seo-tema' ), 'type' => 'text', 'section' => 'hero' ),
		'hero_description'    => array( 'label' => __( 'Hero Açıklama', 'seo-tema' ), 'type' => 'textarea', 'section' => 'hero' ),
		'hero_button_1_text'  => array( 'label' => __( 'Hero 1. Buton Metni', 'seo-tema' ), 'type' => 'text', 'section' => 'hero' ),
		'hero_button_1_url'   => array( 'label' => __( 'Hero 1. Buton URL', 'seo-tema' ), 'type' => 'url', 'section' => 'hero' ),
		'hero_button_2_text'  => array( 'label' => __( 'Hero 2. Buton Metni', 'seo-tema' ), 'type' => 'text', 'section' => 'hero' ),
		'hero_button_2_url'   => array( 'label' => __( 'Hero 2. Buton URL', 'seo-tema' ), 'type' => 'url', 'section' => 'hero' ),
		'hero_image'          => array( 'label' => __( 'Hero Görsel URL', 'seo-tema' ), 'type' => 'url', 'section' => 'hero' ),
		'bronze_name'         => array( 'label' => __( 'Bronze Paket Adı', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'bronze_price'        => array( 'label' => __( 'Bronze Fiyat', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'bronze_period'       => array( 'label' => __( 'Bronze Fiyat Periyodu', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'bronze_features'     => array( 'label' => __( 'Bronze Özellik Listesi (satır satır)', 'seo-tema' ), 'type' => 'textarea', 'section' => 'packages' ),
		'bronze_button_text'  => array( 'label' => __( 'Bronze Buton Yazısı', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'bronze_button_url'   => array( 'label' => __( 'Bronze Buton URL', 'seo-tema' ), 'type' => 'url', 'section' => 'packages' ),
		'bronze_featured'     => array( 'label' => __( 'Bronze Öne Çıkan Paket', 'seo-tema' ), 'type' => 'checkbox', 'section' => 'packages' ),
		'silver_name'         => array( 'label' => __( 'Gümüş Paket Adı', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'silver_price'        => array( 'label' => __( 'Gümüş Fiyat', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'silver_period'       => array( 'label' => __( 'Gümüş Fiyat Periyodu', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'silver_features'     => array( 'label' => __( 'Gümüş Özellik Listesi (satır satır)', 'seo-tema' ), 'type' => 'textarea', 'section' => 'packages' ),
		'silver_button_text'  => array( 'label' => __( 'Gümüş Buton Yazısı', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'silver_button_url'   => array( 'label' => __( 'Gümüş Buton URL', 'seo-tema' ), 'type' => 'url', 'section' => 'packages' ),
		'silver_featured'     => array( 'label' => __( 'Gümüş Öne Çıkan Paket', 'seo-tema' ), 'type' => 'checkbox', 'section' => 'packages' ),
		'gold_name'           => array( 'label' => __( 'Altın Paket Adı', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'gold_price'          => array( 'label' => __( 'Altın Fiyat', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'gold_period'         => array( 'label' => __( 'Altın Fiyat Periyodu', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'gold_features'       => array( 'label' => __( 'Altın Özellik Listesi (satır satır)', 'seo-tema' ), 'type' => 'textarea', 'section' => 'packages' ),
		'gold_button_text'    => array( 'label' => __( 'Altın Buton Yazısı', 'seo-tema' ), 'type' => 'text', 'section' => 'packages' ),
		'gold_button_url'     => array( 'label' => __( 'Altın Buton URL', 'seo-tema' ), 'type' => 'url', 'section' => 'packages' ),
		'gold_featured'       => array( 'label' => __( 'Altın Öne Çıkan Paket', 'seo-tema' ), 'type' => 'checkbox', 'section' => 'packages' ),
		'contact_email'       => array( 'label' => __( 'E-posta', 'seo-tema' ), 'type' => 'email', 'section' => 'contact' ),
		'contact_phone'       => array( 'label' => __( 'Telefon', 'seo-tema' ), 'type' => 'text', 'section' => 'contact' ),
		'contact_whatsapp'    => array( 'label' => __( 'WhatsApp', 'seo-tema' ), 'type' => 'text', 'section' => 'contact' ),
		'contact_title'       => array( 'label' => __( 'İletişim Başlığı', 'seo-tema' ), 'type' => 'text', 'section' => 'contact' ),
		'contact_description' => array( 'label' => __( 'İletişim Açıklaması', 'seo-tema' ), 'type' => 'textarea', 'section' => 'contact' ),
		'facebook_url'        => array( 'label' => __( 'Facebook URL', 'seo-tema' ), 'type' => 'url', 'section' => 'social' ),
		'instagram_url'       => array( 'label' => __( 'Instagram URL', 'seo-tema' ), 'type' => 'url', 'section' => 'social' ),
		'x_url'               => array( 'label' => __( 'X/Twitter URL', 'seo-tema' ), 'type' => 'url', 'section' => 'social' ),
		'linkedin_url'        => array( 'label' => __( 'LinkedIn URL', 'seo-tema' ), 'type' => 'url', 'section' => 'social' ),
		'youtube_url'         => array( 'label' => __( 'YouTube URL', 'seo-tema' ), 'type' => 'url', 'section' => 'social' ),
		'footer_description'  => array( 'label' => __( 'Footer Açıklaması', 'seo-tema' ), 'type' => 'textarea', 'section' => 'footer' ),
		'footer_copyright'    => array( 'label' => __( 'Copyright Metni', 'seo-tema' ), 'type' => 'textarea', 'section' => 'footer' ),
	);
}

/**
 * Render input field.
 *
 * @param array<string, string> $args Field args.
 */
function seo_tema_render_field( $args ) {
	$key     = $args['key'];
	$type    = $args['type'];
	$options = seo_tema_get_options();
	$value   = $options[ $key ] ?? '';
	$name    = 'seo_tema_options[' . $key . ']';

	if ( 'textarea' === $type ) {
		echo '<textarea class="large-text" rows="4" name="' . esc_attr( $name ) . '">' . esc_textarea( (string) $value ) . '</textarea>';
		return;
	}

	if ( 'checkbox' === $type ) {
		echo '<label><input type="checkbox" value="1" name="' . esc_attr( $name ) . '" ' . checked( ! empty( $value ), true, false ) . ' /> ' . esc_html__( 'Evet', 'seo-tema' ) . '</label>';
		return;
	}

	$input_type = in_array( $type, array( 'email', 'url', 'text' ), true ) ? $type : 'text';
	echo '<input class="regular-text" type="' . esc_attr( $input_type ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( (string) $value ) . '" />';
}

/**
 * Sanitize settings values.
 *
 * @param array<string, mixed> $input Raw input.
 * @return array<string, mixed>
 */
function seo_tema_sanitize_options( $input ) {
	$defaults = seo_tema_default_options();
	$fields   = seo_tema_fields();
	$output   = array();

	if ( ! is_array( $input ) ) {
		$input = array();
	}

	foreach ( $fields as $key => $field ) {
		$value = $input[ $key ] ?? null;

		switch ( $field['type'] ) {
			case 'checkbox':
				$output[ $key ] = ! empty( $value ) ? 1 : 0;
				break;
			case 'email':
				$output[ $key ] = sanitize_email( (string) $value );
				break;
			case 'url':
				$output[ $key ] = esc_url_raw( (string) $value );
				break;
			case 'textarea':
				$output[ $key ] = wp_kses_post( (string) $value );
				break;
			default:
				$output[ $key ] = sanitize_text_field( (string) $value );
				break;
		}
	}

	return wp_parse_args( $output, $defaults );
}

/**
 * Render settings page.
 */
function seo_tema_render_settings_page() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Tema Ayarları', 'seo-tema' ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'seo_tema_settings_group' );
			do_settings_sections( 'seo-tema-settings' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}
