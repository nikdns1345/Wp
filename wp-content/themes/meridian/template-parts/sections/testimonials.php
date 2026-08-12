<?php
/**
 * سکشن ۹ — نظرات مشتریان (اسلایدر داخلی GSAP — sliders.js).
 * اگر Revolution Slider در صفحه باشد، می‌توان این مارکاپ را با شورت‌کد RS جایگزین کرد؛
 * ماژول داخلی به‌طور خودکار غیرفعال می‌شود. لایه‌چینی پیشنهادی RS در docs آمده است.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$testimonials = array(
	array(
		'quote'  => '[نقل‌قول مشتری] — همکاری با [نام شرکت] مسیر رشد ما را متحول کرد؛ دقت در جزئیات و تعهد به نتیجه، فوق‌العاده بود.',
		'name'   => '[نام مشتری]',
		'role'   => 'مدیرعامل، [شرکت مشتری]',
	),
	array(
		'quote'  => '[نقل‌قول مشتری] — تیمی حرفه‌ای که پیچیده‌ترین چالش‌ها را به فرآیندهایی شفاف تبدیل می‌کند.',
		'name'   => '[نام مشتری]',
		'role'   => 'مدیر فناوری، [شرکت مشتری]',
	),
	array(
		'quote'  => '[نقل‌قول مشتری] — از ارائه‌ی استراتژی تا تحویل نهایی، همه‌چیز دقیق و برنامه‌ریزی‌شده پیش رفت.',
		'name'   => '[نام مشتری]',
		'role'   => 'مدیر پروژه، [شرکت مشتری]',
	),
);
?>
<section class="mrd-testimonials mrd-section--pad" id="testimonials" data-section="testimonials">
	<div class="mrd-container">

		<div class="mrd-testimonials__wrap" data-slider="testimonials">

			<span class="mrd-testimonials__quote-icon" data-mrd="scale"><?php echo meridian_svg( 'quote' ); ?></span>

			<div class="mrd-testimonials__viewport">
				<?php foreach ( $testimonials as $i => $t ) : ?>
					<blockquote class="mrd-testimonial<?php echo 0 === $i ? ' is-active' : ''; ?>" data-slide <?php echo 0 === $i ? '' : 'hidden'; ?>>
						<p class="mrd-testimonial__text" data-split="lines"><?php echo esc_html( $t['quote'] ); ?></p>
						<footer class="mrd-testimonial__meta">
							<img class="mrd-testimonial__avatar"
								src="<?php echo esc_url( meridian_placeholder_img( 160, 160, '[عکس]' ) ); ?>"
								alt="<?php echo esc_attr( '[عکس مشتری] ' . $t['name'] ); ?>" width="56" height="56" loading="lazy">
							<div>
								<cite class="mrd-testimonial__name"><?php echo esc_html( $t['name'] ); ?></cite>
								<span class="mrd-testimonial__role"><?php echo esc_html( $t['role'] ); ?></span>
							</div>
						</footer>
					</blockquote>
				<?php endforeach; ?>
			</div>

			<div class="mrd-testimonials__controls">
				<button class="mrd-ctrl" data-slider-prev aria-label="نظر قبلی"><?php echo meridian_svg( 'arrow-up-l' ); ?></button>
				<div class="mrd-testimonials__dots" data-slider-dots role="tablist" aria-label="انتخاب نظر"></div>
				<button class="mrd-ctrl" data-slider-next aria-label="نظر بعدی"><?php echo meridian_svg( 'arrow-up-l' ); ?></button>
			</div>

		</div>

	</div>
</section>
