<?php
/**
 * Single template.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$has_sidebar = is_active_sidebar( 'blog-sidebar' );
?>
<main class="site-main content-page">
	<div class="container blog-layout <?php echo $has_sidebar ? 'has-sidebar' : ''; ?>">
		<div class="blog-main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			$post_categories = get_the_category_list( ', ' );
			$post_tags       = get_the_tag_list( '', ', ' );
			?>
			<article <?php post_class( 'single-post' ); ?>>
				<?php if ( function_exists( 'bcn_display' ) ) : ?>
					<nav class="blog-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'seo-tema' ); ?>">
						<?php bcn_display(); ?>
					</nav>
				<?php endif; ?>
				<h1 class="post-title"><?php the_title(); ?></h1>
				<div class="post-meta">
					<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					<span aria-hidden="true">·</span>
					<span><?php the_author_posts_link(); ?></span>
					<?php if ( $post_categories ) : ?>
						<span aria-hidden="true">·</span>
						<span><?php echo wp_kses_post( $post_categories ); ?></span>
					<?php endif; ?>
				</div>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumb"><?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?></div>
				<?php endif; ?>
				<div class="post-content"><?php the_content(); ?></div>
				<footer class="post-footer">
					<?php if ( $post_categories ) : ?>
						<div class="post-taxonomy post-categories"><strong><?php esc_html_e( 'Kategoriler:', 'seo-tema' ); ?></strong> <?php echo wp_kses_post( $post_categories ); ?></div>
					<?php endif; ?>
					<?php if ( $post_tags ) : ?>
						<div class="post-taxonomy post-tags"><strong><?php esc_html_e( 'Etiketler:', 'seo-tema' ); ?></strong> <?php echo wp_kses_post( $post_tags ); ?></div>
					<?php endif; ?>
					<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Yazı Gezinme', 'seo-tema' ); ?>">
						<div class="post-navigation-prev"><?php previous_post_link( '%link', esc_html__( '← Önceki Yazı', 'seo-tema' ) ); ?></div>
						<div class="post-navigation-next"><?php next_post_link( '%link', esc_html__( 'Sonraki Yazı →', 'seo-tema' ) ); ?></div>
					</nav>
				</footer>
			</article>
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<div class="post-comments">
					<?php comments_template(); ?>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
		</div>
		<?php
		if ( $has_sidebar ) {
			get_sidebar();
		}
		?>
	</div>
</main>
<?php
get_footer();
