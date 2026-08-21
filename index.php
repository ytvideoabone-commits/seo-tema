<?php
/**
 * Main index template.
 *
 * @package seo-tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="site-main content-page">
	<div class="container">
		<header class="archive-header"><h1><?php esc_html_e( 'Blog', 'seo-tema' ); ?></h1></header>
		<?php if ( have_posts() ) : ?>
			<div class="post-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'post-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="post-thumb"><?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?></a>
						<?php endif; ?>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post-meta"><?php echo esc_html( get_the_date() ); ?> · <?php the_author(); ?></div>
						<div><?php the_excerpt(); ?></div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'İçerik bulunamadı.', 'seo-tema' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
