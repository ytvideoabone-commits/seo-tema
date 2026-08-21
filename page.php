<?php
/**
 * Page template.
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
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'single-post' ); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="post-content"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	</div>
</main>
<?php
get_footer();
