<?php
/**
 * Archive template.
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
		<header class="archive-header">
			<h1><?php the_archive_title(); ?></h1>
			<?php the_archive_description( '<div>', '</div>' ); ?>
		</header>
		<?php if ( have_posts() ) : ?>
			<div class="post-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'post-card' ); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post-meta"><?php echo esc_html( get_the_date() ); ?> · <?php the_author(); ?></div>
						<?php the_excerpt(); ?>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Arşivde içerik yok.', 'seo-tema' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
