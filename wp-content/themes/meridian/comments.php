<?php
/**
 * دیدگاه‌ها — لیست + فرم (سازگار با استایل قالب).
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="mrd-comments mrd-container" style="padding-block:var(--space-7)">

	<?php if ( have_comments() ) : ?>
		<h2 class="mrd-h3">
			<?php
			printf(
				/* translators: %s: تعداد دیدگاه‌ها */
				esc_html( _nx( 'یک دیدگاه', '%s دیدگاه', get_comments_number(), 'comments title', 'meridian' ) ),
				esc_html( number_format_i18n( get_comments_number() ) )
			);
			?>
		</h2>
		<ol class="mrd-comments__list" style="list-style:none;padding:0;margin-block:var(--space-4)">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 56,
			) );
			?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="mrd-text-muted"><?php esc_html_e( 'دیدگاه‌ها بسته شده‌اند.', 'meridian' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply_before' => '<h3 id="reply-title" class="mrd-h3 comment-reply-title">',
		'title_reply_after'  => '</h3>',
		'class_submit'       => 'mrd-btn mrd-btn--solid mrd-btn--sm',
	) );
	?>
</section>
