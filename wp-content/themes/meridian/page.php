<?php
/**
 * قالب برگه — حداقلی و سازگار با المنتور.
 * وقتی برگه با المنتور ساخته شود، the_content خروجی المنتور را چاپ می‌کند
 * و API انیمیشن قالب (data-attributes) روی همان خروجی کار می‌کند.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) :
	the_post();

	// اگر برگه با المنتور ساخته شده، بدون wrapper اضافه چاپ شود
	if ( function_exists( 'elementor_load_plugin_textdomain' ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor() ) {
		the_content();
	} else {
		?>
		<article <?php post_class( 'mrd-section mrd-section--pad mrd-container' ); ?>>
			<header data-mrd="fade-up">
				<h1 class="mrd-h1"><?php the_title(); ?></h1>
			</header>
			<div class="mrd-content" data-mrd="fade-up">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	}
endwhile;

get_footer();
