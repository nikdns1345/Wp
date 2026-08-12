<?php
/**
 * قالب پیش‌فرض — fallback استاندارد وردپرس.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<section class="mrd-section mrd-section--pad mrd-container">
	<?php if ( have_posts() ) : ?>
		<header class="mrd-archive-head" data-mrd="fade-up">
			<span class="mrd-eyebrow"><?php echo meridian_svg( 'line' ); ?> آرشیو</span>
			<h1 class="mrd-h2"><?php the_archive_title(); ?></h1>
		</header>
		<div class="mrd-archive-grid" data-mrd-group>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'mrd-card-post' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="mrd-card-post__media" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'meridian-card', array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
						</a>
					<?php endif; ?>
					<h2 class="mrd-h3"><a href="<?php the_permalink(); ?>" class="mrd-link-line"><?php the_title(); ?></a></h2>
					<p class="mrd-text-muted"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
				</article>
			<?php endwhile; ?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<h1 class="mrd-h2">موردی یافت نشد.</h1>
	<?php endif; ?>
</section>

<?php get_footer(); ?>
