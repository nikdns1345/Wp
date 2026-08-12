<?php
/**
 * یکپارچه‌سازی با Elementor / Elementor Pro.
 *
 * ۱) ثبت Locationهای Theme Builder (در صورت وجود پرو)
 * ۲) همگام‌سازی رنگ Accent المنتور با توکن قالب
 * ۳) غیرفعال‌کردن رنگ/فونت پیش‌فرض المنتور تا دیزاین‌سیستم قالب حاکم باشد
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// ۱) Locationهای Theme Builder (هدر/فوتر/سینگل/آرشیو/۴۰۴) — نیازمند Elementor Pro
function meridian_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'meridian_register_elementor_locations' );

/**
 * ۲) رنگ Accent قالب — تنها نقطه‌ی تعریف رنگ سازمانی.
 * مقدار همین تابع را با --c-accent در tokens.css یکی نگه دارید.
 * (Site Settings المنتور نیز از elementor/kit-settings.json قابل ایمپورت است)
 */
function meridian_accent_color() {
	return apply_filters( 'meridian_accent_color', '#2040FF' );
}

// ۳) دیزاین‌سیستم قالب حاکم باشد — اسکیم‌های پیش‌فرض المنتور خنثی شوند
add_action( 'admin_init', function () {
	if ( ! get_option( 'meridian_elementor_synced' ) ) {
		update_option( 'elementor_disable_color_schemes', 'yes' );
		update_option( 'elementor_disable_typography_schemes', 'yes' );
		update_option( 'meridian_elementor_synced', 1 );
	}
} );

/**
 * ۴) تزریق رنگ Accent به‌صورت inline CSS var در صفحات المنتور
 * تا رنگ سراسری با قالب یکی بماند حتی اگر کاربر از فیلتر meridian_accent_color استفاده کند.
 */
function meridian_elementor_accent_sync() {
	if ( meridian_accent_color() !== '#2040FF' ) {
		printf(
			'<style id="meridian-accent-override">:root{--c-accent:%s;--c-accent-soft:%s1A}</style>',
			esc_attr( meridian_accent_color() ),
			esc_attr( meridian_accent_color() )
		);
	}
}
add_action( 'wp_head', 'meridian_elementor_accent_sync', 20 );

/**
 * ۵) راهنمای زنده در ادیتور: کلاس روی body هنگام حالت ویرایش
 * تا JS ماژول‌های سنگین (لودر/ترنزیشن/کرسر/پین) را در ادیتور غیرفعال کند.
 */
add_filter( 'body_class', function ( $classes ) {
	if ( defined( 'ELEMENTOR_VERSION' ) && isset( $_GET['elementor-preview'] ) ) { // phpcs:ignore
		$classes[] = 'mrd-in-editor';
	}
	return $classes;
} );
