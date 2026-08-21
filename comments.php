<?php
/**
 * Comments template.
 *
 * @package seo-tema
 */

if ( post_password_required() ) {
	return;
}

if ( ! function_exists( 'seo_tema_comment' ) ) {
	/**
	 * Render an individual comment.
	 *
	 * @param WP_Comment $comment Current comment.
	 * @param array      $args    Comment list arguments.
	 * @param int        $depth   Comment depth.
	 */
	function seo_tema_comment( $comment, $args, $depth ) {
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 44 ); ?>
					<div class="comment-author-details">
						<cite class="fn"><?php echo wp_kses_post( get_comment_author_link( $comment ) ); ?></cite>
						<div class="comment-meta">
							<a href="<?php echo esc_url( get_comment_link( $comment ) ); ?>">
								<time datetime="<?php comment_time( DATE_W3C ); ?>"><?php echo esc_html( get_comment_date() . ' ' . get_comment_time() ); ?></time>
							</a>
						</div>
					</div>
				</div>

				<div class="comment-content">
					<?php if ( '0' === $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Yorumunuz onay bekliyor.', 'seo-tema' ); ?></p>
					<?php endif; ?>
					<?php comment_text(); ?>
				</div>

				<div class="reply">
					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'reply_text' => esc_html__( 'Yanıtla', 'seo-tema' ),
							)
						)
					);
					?>
				</div>
			</article>
		<?php
	}
}

if ( ! function_exists( 'seo_tema_comment_end' ) ) {
	/**
	 * Close an individual comment list item.
	 *
	 * @param WP_Comment $comment Current comment.
	 * @param array      $args    Comment list arguments.
	 * @param int        $depth   Comment depth.
	 */
	function seo_tema_comment_end( $comment, $args, $depth ) {
		echo '</li>';
	}
}
?>

<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			printf(
				esc_html( _nx( '%1$s yorum', '%1$s yorum', get_comments_number(), 'comments title', 'seo-tema' ) ),
				esc_html( number_format_i18n( get_comments_number() ) )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 44,
					'callback'    => 'seo_tema_comment',
					'end-callback' => 'seo_tema_comment_end',
					'style'       => 'ol',
					'short_ping'  => true,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Yorumlar kapalıdır.', 'seo-tema' ); ?></p>
	<?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$required  = get_option( 'require_name_email' );
	$required_attribute = $required ? ' required aria-required="true"' : '';

	comment_form(
		array(
			'title_reply'          => esc_html__( 'Bir yanıt yazın', 'seo-tema' ),
			'title_reply_to'       => esc_html__( '%s için yanıt yazın', 'seo-tema' ),
			'cancel_reply_link'    => esc_html__( 'Yanıtı iptal et', 'seo-tema' ),
			'label_submit'         => esc_html__( 'Yorumu gönder', 'seo-tema' ),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => array(
				'author' => '<p class="comment-form-author"><label for="author">' . esc_html__( 'Ad', 'seo-tema' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" autocomplete="name"' . $required_attribute . ' /></p>',
				'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'E-posta', 'seo-tema' ) . '</label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" autocomplete="email"' . $required_attribute . ' /></p>',
				'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Web sitesi', 'seo-tema' ) . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" autocomplete="url" /></p>',
				'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" /> <label for="wp-comment-cookies-consent">' . esc_html__( 'Adım, e-posta adresim ve web sitem bu tarayıcıda kaydedilsin.', 'seo-tema' ) . '</label></p>',
			),
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Yorum', 'seo-tema' ) . '</label><textarea id="comment" name="comment" cols="45" rows="7" maxlength="65525" required aria-required="true"></textarea></p>',
			'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn" value="%4$s" />',
		)
	);
	?>
</section>
