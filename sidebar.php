<?php
/**
 * Blog sidebar template.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'blog-sidebar' ) ) {
	return;
}
?>
<aside id="secondary" class="blog-sidebar" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'seo-tema' ); ?>">
	<?php dynamic_sidebar( 'blog-sidebar' ); ?>
</aside>
