<?php
/**
 * سکشن ۲ — ABOUT + Statement با تایپوگرافی بزرگ.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$about = array(
	'eyebrow'   => 'درباره‌ی ما',
	'title'     => 'شریک راهبردی سازمان‌ها در مسیر رشد پایدار.',
	'desc'      => '[توضیح شرکت] — [نام شرکت] با تیمی چندرشته‌ای از متخصصان فناوری، مهندسی و توسعه‌ی کسب‌وکار، پروژه‌های پیچیده را به نتایجی قابل‌اندازه‌گیری تبدیل می‌کند.',
	'cta'       => array( 'label' => 'بیشتر بدانید', 'url' => '#services' ),
	'statement' => array( 'ما چالش‌های پیچیده را', 'به فرصت‌هایی شفاف تبدیل می‌کنیم.' ),
);
?>
<section class="mrd-about mrd-section--pad" id="about" data-section="about">
	<div class="mrd-container">

		<div class="mrd-about__grid">

			<div class="mrd-about__media" data-mrd="img-reveal">
				<figure class="u-img-parallax" data-parallax="0.12">
					<img src="<?php echo esc_url( meridian_placeholder_img( 1000, 1240, '[تصویر درباره‌ی ما]' ) ); ?>"
						alt="[تصویر درباره‌ی ما] — تیم یا دفتر شرکت" width="1000" height="1240" loading="lazy" decoding="async">
				</figure>
			</div>

			<div class="mrd-about__content">
				<span class="mrd-eyebrow" data-mrd="fade-up"><?php echo meridian_svg( 'line' ); ?> <?php echo esc_html( $about['eyebrow'] ); ?></span>
				<h2 class="mrd-h2" data-split="lines"><?php echo esc_html( $about['title'] ); ?></h2>
				<p class="mrd-lead mrd-text-muted" data-mrd="fade-up" data-mrd-delay="0.15"><?php echo esc_html( $about['desc'] ); ?></p>
				<div data-mrd="fade-up" data-mrd-delay="0.25">
					<a href="<?php echo esc_url( $about['cta']['url'] ); ?>" class="mrd-btn mrd-btn--text">
						<span class="mrd-btn__label"><?php echo esc_html( $about['cta']['label'] ); ?></span>
						<span class="mrd-btn__circle"><?php echo meridian_svg( 'arrow-left' ); ?></span>
					</a>
				</div>
			</div>

		</div>

		<!-- Statement — تایپوگرافی بسیار بزرگ، قلب بصری سکشن -->
		<div class="mrd-statement" data-statement>
			<p class="mrd-statement__text">
				<?php foreach ( $about['statement'] as $i => $line ) : ?>
					<span class="mrd-statement__line" data-split-line><span><?php echo esc_html( $line ); ?></span></span>
				<?php endforeach; ?>
			</p>
		</div>

	</div>
</section>
