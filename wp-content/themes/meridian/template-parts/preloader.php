<?php
/**
 * صفحه‌ی لودینگ — لوگو + شمارنده‌ی پیشرفت + خروج با پنل‌های عمودی.
 * انیمیشن در assets/js/animations/loader.js مدیریت می‌شود.
 * در ادیتور المنتور و حالت prefers-reduced-motion فوراً حذف می‌شود.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class="mrd-loader" data-loader aria-hidden="true">
	<div class="mrd-loader__center">
		<div class="mrd-loader__logo">
			<?php echo meridian_svg( 'logo' ); ?>
			<span class="mrd-loader__name"><?php echo esc_html( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : '[نام شرکت]' ); ?></span>
		</div>
		<div class="mrd-loader__track"><span class="mrd-loader__bar" data-loader-bar></span></div>
		<span class="mrd-loader__count" data-loader-count>۰</span>
	</div>
	<span class="mrd-loader__panel"></span>
	<span class="mrd-loader__panel"></span>
	<span class="mrd-loader__panel"></span>
	<span class="mrd-loader__panel"></span>
	<span class="mrd-loader__panel"></span>
</div>
