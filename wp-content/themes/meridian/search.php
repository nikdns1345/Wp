<?php
/**
 * نتایج جستجو.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<section class="mrd-section mrd-section--pad mrd-container">
	<header class="mrd-archive-head" data-mrd="fade-up">
		<span class="mrd-eyebrow"><?php echo meridian_svg( 'line' ); ?> نتایج جستجو</span>
		<h1 class="mrd-h2">
			<?php
			/* translators: %s: عبارت جستجو */
			printf( esc_html__( 'نتایج برای: %s', 'meridian' ), '<em>' . esc_html( get_search_query() ) . '</em>' );
			?>
		</h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="mrd-archive-grid" data-mrd-group>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'mrd-card-post' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="mrd-card-post__media u-hover-zoom" href="<?php the_permalink(); ?>">
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
		<p class="mrd-lead mrd-text-muted">موردی مطابق جستجوی شما یافت نشد.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</section>

<?php get_footer(); ?>
