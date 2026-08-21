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
$has_sidebar = is_active_sidebar( 'blog-sidebar' );
?>
<main class="site-main content-page">
	<div class="container blog-layout <?php echo $has_sidebar ? 'has-sidebar' : ''; ?>">
		<div class="blog-main">
		<header class="archive-header">
			<h1><?php the_archive_title(); ?></h1>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
		</header>
		<?php if ( have_posts() ) : ?>
			<div class="post-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php $post_permalink = get_permalink(); ?>
					<article <?php post_class( 'post-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php echo esc_url( $post_permalink ); ?>" class="post-card-thumb"><?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?></a>
						<?php endif; ?>
						<div class="post-card-content">
							<?php
							$card_categories = get_the_category_list( ', ' );
							if ( $card_categories ) :
								?>
								<div class="post-card-categories"><?php echo wp_kses_post( $card_categories ); ?></div>
							<?php endif; ?>
							<h2 class="post-card-title"><a href="<?php echo esc_url( $post_permalink ); ?>"><?php the_title(); ?></a></h2>
							<div class="post-meta">
								<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
							</div>
							<div class="post-excerpt"><?php the_excerpt(); ?></div>
							<a class="post-read-more" href="<?php echo esc_url( $post_permalink ); ?>"><?php esc_html_e( 'Devamını Oku', 'seo-tema' ); ?></a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<div class="blog-pagination"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<p><?php esc_html_e( 'Arşivde içerik yok.', 'seo-tema' ); ?></p>
		<?php endif; ?>
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
