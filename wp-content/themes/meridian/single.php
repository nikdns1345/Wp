<?php
/**
 * قالب نوشته‌ی تکی.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) : the_post();
	?>
	<article <?php post_class( 'mrd-section mrd-section--pad mrd-container mrd-container--narrow' ); ?>>
		<header data-mrd="fade-up">
			<span class="mrd-eyebrow"><?php echo meridian_svg( 'line' ); ?> <?php echo esc_html( get_the_date() ); ?></span>
			<h1 class="mrd-h1"><?php the_title(); ?></h1>
		</header>
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="mrd-single-media" data-mrd="img-reveal">
				<?php the_post_thumbnail( 'meridian-wide', array( 'decoding' => 'async' ) ); ?>
			</figure>
		<?php endif; ?>
		<div class="mrd-content" data-mrd="fade-up">
			<?php the_content(); ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
