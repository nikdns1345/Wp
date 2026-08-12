<?php
/**
 * سکشن ۱ — HERO
 * تایم‌لاین ورود در animations/hero.js طبق ترتیب: پس‌زمینه ← هدر ← eyebrow ←
 * تیتر خط‌به‌خط ← توضیح ← دکمه‌ها ← ویژوال ← نشانگر اسکرول.
 *
 * ویژوال Hero از نوع تصویر است؛ برای جایگزینی با ویدیو/Lottie کافی است
 * داخل .mrd-hero__visual-media را عوض کنید (یا سکشن را در المنتور بازسازی کنید).
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// ── محتوای قابل‌ویرایش (در المنتور: بازسازی با همین کلاس‌ها) ─────────────
$hero = array(
	'eyebrow'   => 'شرکت بین‌المللی فناوری، مهندسی و سرمایه‌گذاری',
	'lines'     => array( 'ما چیزی می‌سازیم که', 'کسب‌وکار را به جلو می‌برد.' ),
	'desc'      => '[توضیح کوتاه شرکت] — از ایده تا اجرا، در کنار سازمان‌ها راه‌حل‌هایی دقیق، مقیاس‌پذیر و ماندگار طراحی می‌کنیم.',
	'primary'   => array( 'label' => 'مشاهده‌ی پروژه‌ها', 'url' => '#projects' ),
	'secondary' => array( 'label' => 'تماس با ما', 'url' => '#contact' ),
);
?>
<section class="mrd-hero" id="hero" data-hero>

	<div class="mrd-hero__bg" data-hero-bg>
		<span class="mrd-hero__gridline"></span>
		<span class="mrd-hero__gridline"></span>
		<span class="mrd-hero__gridline"></span>
		<span class="mrd-hero__gridline"></span>
	</div>

	<div class="mrd-container mrd-hero__inner">

		<div class="mrd-hero__content">
			<span class="mrd-eyebrow mrd-hero__eyebrow" data-hero-eyebrow>
				<?php echo meridian_svg( 'line' ); ?>
				<?php echo esc_html( $hero['eyebrow'] ); ?>
			</span>

			<h1 class="mrd-hero__title" data-hero-title>
				<?php foreach ( $hero['lines'] as $line ) : ?>
					<span class="mrd-hero__line"><span class="mrd-hero__line-inner"><?php echo esc_html( $line ); ?></span></span>
				<?php endforeach; ?>
			</h1>

			<p class="mrd-hero__desc" data-hero-desc><?php echo esc_html( $hero['desc'] ); ?></p>

			<div class="mrd-hero__actions" data-hero-actions>
				<a href="<?php echo esc_url( $hero['primary']['url'] ); ?>" class="mrd-btn mrd-btn--solid" data-magnetic="0.4">
					<span class="mrd-btn__label"><?php echo esc_html( $hero['primary']['label'] ); ?></span>
					<span class="mrd-btn__arrow"><?php echo meridian_svg( 'arrow-up-l' ); ?></span>
				</a>
				<a href="<?php echo esc_url( $hero['secondary']['url'] ); ?>" class="mrd-btn mrd-btn--ghost" data-magnetic="0.4">
					<span class="mrd-btn__label"><?php echo esc_html( $hero['secondary']['label'] ); ?></span>
				</a>
			</div>
		</div>

		<div class="mrd-hero__visual" data-hero-visual>
			<figure class="mrd-hero__visual-media">
				<img src="<?php echo esc_url( MERIDIAN_URI . '/assets/img/hero-abstract.jpg' ); ?>"
					alt="[تصویر اصلی هیرو] — مجسمه‌ی انتزاعی سازمانی"
					width="1200" height="900" decoding="async" fetchpriority="high">
			</figure>
			<span class="mrd-hero__orb" data-hero-orb></span>
			<span class="mrd-hero__tag mrd-glass" data-hero-tag><i></i> مقیاس‌پذیر. دقیق. ماندگار.</span>
		</div>

	</div>

	<a class="mrd-hero__scroll" href="#about" data-hero-scroll aria-label="اسکرول به پایین">
		<span class="mrd-hero__scroll-text">اسکرول</span>
		<span class="mrd-hero__scroll-line"><i></i></span>
	</a>

</section>
