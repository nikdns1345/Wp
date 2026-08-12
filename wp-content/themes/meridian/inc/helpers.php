<?php
/**
 * ابزارها: SVGهای سیستمی، لوگوی Placeholder، تصاویر Placeholder دیتا-URI.
 *
 * نکته‌ی مهم برای ویرایش: همه‌ی SVGها و تصاویر placeholder همین‌جا تعریف شده‌اند
 * تا بدون دست‌زدن به ساختار HTML قابل جایگزینی باشند.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * SVGهای سیستمی قالب.
 *
 * @param string $name نام آیکن.
 * @return string مارکاپ SVG.
 */
function meridian_svg( $name ) {
	$svgs = array(
		// لوگوی placeholder — مونوگرام هندسی (جایگزین با لوگوی واقعی شرکت)
		'logo' => '<svg viewBox="0 0 44 44" fill="none" aria-hidden="true"><rect x="2" y="2" width="40" height="40" rx="4" stroke="currentColor" stroke-width="2.5"/><path d="M12 32V12l10 12 10-12v20" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',

		'arrow-left'  => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m0 0 6 6m-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'arrow-up'    => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 19V5m0 0-6 6m6-6 6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'arrow-up-l'  => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M17 7 7 17M7 9v8h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'plus'        => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
		'quote'       => '<svg viewBox="0 0 48 48" fill="currentColor" aria-hidden="true"><path d="M14 34c-4 0-7-3-7-8 0-7 5-13 12-15l1.6 3C16 16 13.5 19 13 22c.5-.2 1.2-.3 2-.3 3.3 0 6 2.4 6 6.1 0 3.5-3 6.2-7 6.2Zm20 0c-4 0-7-3-7-8 0-7 5-13 12-15l1.6 3C36 16 33.5 19 33 22c.5-.2 1.2-.3 2-.3 3.3 0 6 2.4 6 6.1 0 3.5-3 6.2-7 6.2Z"/></svg>',

		// خط دکوراتیو کنار Eyebrow
		'line' => '<svg viewBox="0 0 32 2" fill="none" aria-hidden="true"><rect width="32" height="1.5" fill="currentColor"/></svg>',

		// شبکه‌ی placeholder نقشه
		'map' => '<svg viewBox="0 0 120 80" fill="none" aria-hidden="true"><g stroke="currentColor" stroke-opacity=".35"><path d="M0 20h120M0 40h120M0 60h120M20 0v80M45 0v80M72 0v80M98 0v80"/><path d="M0 55 35 30l30 12 28-20 27 16" stroke-opacity=".6"/></g><circle cx="63" cy="41" r="4" fill="currentColor"/></svg>',

		'social-in' => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9h4v12H3V9Zm7 0h3.8v1.7h.1c.5-1 1.8-2 3.7-2 4 0 4.7 2.6 4.7 6V21h-4v-5.5c0-1.3 0-3-1.9-3s-2.2 1.4-2.2 2.9V21h-4V9Z"/></svg>',
		'social-x'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.7 3H21l-7.2 8.2L22.2 21h-6.6l-5.2-6.2L4.5 21H1.2l7.7-8.8L1 3h6.8l4.7 5.7L17.7 3Zm-1.2 16h1.8L7 4.9H5L16.5 19Z"/></svg>',
		'social-ig' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8"/><circle cx="17.2" cy="6.8" r="1.2" fill="currentColor"/></svg>',
	);
	return isset( $svgs[ $name ] ) ? $svgs[ $name ] : '';
}

/**
 * لوگوی برند — اگر لوگوی سفارشی آپلود شده باشد همان، وگرنه Placeholder.
 *
 * @param string $class کلاس wrapper.
 */
function meridian_logo( $class = 'mrd-logo' ) {
	if ( has_custom_logo() ) {
		echo '<div class="' . esc_attr( $class ) . '">' . get_custom_logo() . '</div>';
		return;
	}
	echo '<a class="' . esc_attr( $class ) . '" href="' . esc_url( home_url( '/' ) ) . '" aria-label="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
	echo '<span class="' . esc_attr( $class ) . '__mark">' . meridian_svg( 'logo' ) . '</span>';
	echo '<span class="' . esc_attr( $class ) . '__text">';
	// [نام شرکت] — از تنظیمات ← عمومی ← «عنوان سایت» یا سفارشی‌سازی ← لوگو، ویرایش می‌شود
	echo '<strong>' . esc_html( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : '[نام شرکت]' ) . '</strong>';
	echo '<small>' . esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : '[شعار شرکت]' ) . '</small>';
	echo '</span></a>';
}

/**
 * تصویر Placeholder به‌صورت SVG دیتا-URI — با شبکه‌ی مختصات و برچسب.
 * به‌راحتی با each بلوک <img> در المنتور جایگزین می‌شود (پروپرتی alt حفظ شود).
 *
 * @param int    $w     عرض.
 * @param int    $h     ارتفاع.
 * @param string $label برچسب داخل تصویر.
 * @param bool   $dark  نسخه‌ی تیره؟
 */
function meridian_placeholder_img( $w = 1200, $h = 900, $label = '[تصویر]', $dark = false ) {
	$bg   = $dark ? '#17171B' : '#E9E7E1';
	$fg   = $dark ? '#8B8B93' : '#9C9A94';
	$line = $dark ? 'rgba(255,255,255,.08)' : 'rgba(17,17,20,.08)';
	$svg  = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $w . '" height="' . $h . '" viewBox="0 0 ' . $w . ' ' . $h . '">'
		. '<rect width="100%" height="100%" fill="' . $bg . '"/>'
		. '<g stroke="' . $line . '"><path d="M0 ' . ( $h / 2 ) . 'h' . $w . 'M' . ( $w / 2 ) . ' 0v' . $h . '"/></g>'
		. '<rect x="8" y="8" width="' . ( $w - 16 ) . '" height="' . ( $h - 16 ) . '" fill="none" stroke="' . $line . '"/>'
		. '<text x="50%" y="50%" fill="' . $fg . '" font-family="Tahoma" font-size="' . round( $w / 22 ) . '" text-anchor="middle" dominant-baseline="middle">' . esc_html( $label ) . '</text>'
		. '</svg>';
	return 'data:image/svg+xml;charset=utf-8,' . rawurlencode( $svg );
}

/**
 * لینک شبکه‌های اجتماعی — [آدرس شبکه اجتماعی] را جایگزین کنید.
 *
 * @return array
 */
function meridian_socials() {
	return array(
		array( 'icon' => 'social-in', 'label' => 'لینکدین',  'url' => '#' ),
		array( 'icon' => 'social-x',  'label' => 'ایکس',     'url' => '#' ),
		array( 'icon' => 'social-ig', 'label' => 'اینستاگرام', 'url' => '#' ),
	);
}

/**
 * خروجی آیتم‌های شبکه‌ی اجتماعی.
 *
 * @param string $class کلاس wrapper.
 */
function meridian_social_links( $class = 'mrd-social' ) {
	echo '<ul class="' . esc_attr( $class ) . '">';
	foreach ( meridian_socials() as $s ) {
		echo '<li><a href="' . esc_url( $s['url'] ) . '" aria-label="' . esc_attr( $s['label'] ) . '" target="_blank" rel="noopener">' . meridian_svg( $s['icon'] ) . '</a></li>';
	}
	echo '</ul>';
}
