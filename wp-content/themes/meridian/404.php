<?php
/**
 * صفحه‌ی ۴۰۴ — مینیمال با تایپوگرافی بزرگ.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<section class="mrd-section mrd-section--pad mrd-container mrd-404" style="min-height:70vh;display:flex;flex-direction:column;justify-content:center">
	<span class="mrd-eyebrow" data-mrd="fade-up"><?php echo meridian_svg( 'line' ); ?> خطای ۴۰۴</span>
	<h1 class="mrd-display" data-split="lines" style="margin-block:var(--space-4)">صفحه پیدا نشد.</h1>
	<p class="mrd-lead mrd-text-muted" data-mrd="fade-up" data-mrd-delay="0.15" style="max-width:52ch">
		نشانی‌ای که به دنبال آن بودید جابه‌جا شده یا دیگر وجود ندارد.
	</p>
	<div data-mrd="fade-up" data-mrd-delay="0.25" style="margin-top:var(--space-5)">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mrd-btn mrd-btn--solid" data-magnetic="0.35">
			<span class="mrd-btn__label">بازگشت به صفحه‌ی اصلی</span>
			<span class="mrd-btn__arrow"><?php echo meridian_svg( 'arrow-up-l' ); ?></span>
		</a>
	</div>
</section>

<?php get_footer(); ?>
