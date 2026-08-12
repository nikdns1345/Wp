<?php
/**
 * سکشن ۱۲ — CTA نهایی (تایپوگرافی بزرگ + عنصر پس‌زمینه‌ی متحرک).
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<section class="mrd-cta mrd-section--pad" id="cta" data-section="cta">

	<!-- حلقه‌ی چرخان دکوراتیو -->
	<div class="mrd-cta__ring" data-cta-ring aria-hidden="true">
		<svg viewBox="0 0 600 600" fill="none">
			<circle cx="300" cy="300" r="298" stroke="currentColor" stroke-width="1" stroke-dasharray="2 10"/>
			<circle cx="300" cy="300" r="220" stroke="currentColor" stroke-width="1" stroke-opacity=".5" stroke-dasharray="1 8"/>
			<circle cx="300" cy="78" r="5" fill="currentColor" class="mrd-cta__ring-dot"/>
		</svg>
	</div>

	<div class="mrd-container mrd-cta__inner">
		<span class="mrd-eyebrow mrd-eyebrow--accent" data-mrd="fade-up"><?php echo meridian_svg( 'line' ); ?> قدم بعدی</span>
		<h2 class="mrd-cta__title" data-split="lines">بیایید چیزی ماندگار بسازیم.</h2>
		<div class="mrd-cta__actions" data-mrd="fade-up" data-mrd-delay="0.2">
			<a href="#contact" class="mrd-btn mrd-btn--solid mrd-btn--lg" data-magnetic="0.45">
				<span class="mrd-btn__label">شروع پروژه</span>
				<span class="mrd-btn__arrow"><?php echo meridian_svg( 'arrow-up-l' ); ?></span>
			</a>
			<a href="mailto:info@example.com" class="mrd-link-line mrd-link-line--light mrd-cta__mail">[ایمیل] info@example.com</a>
		</div>
	</div>

</section>
