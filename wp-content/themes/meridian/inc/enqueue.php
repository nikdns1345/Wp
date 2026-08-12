<?php
/**
 * لود فونت وزیرمتن (محلی)، استایل‌ها و ماژول‌های JS.
 *
 * ترتیب لود CSS مهم است: tokens ← base ← components ← sections
 * ماژول‌های JS همگی به app.js وابسته‌اند و در فوتر و با defer لود می‌شوند.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function meridian_assets() {

	/* ---------------------------------------------------------------
	 * ۱) فونت وزیرمتن — متغیر (wght 100..900)
	 * اگر فایل محلی موجود باشد @font-face محلی؛ در غیر این صورت Google Fonts.
	 * ------------------------------------------------------------- */
	$font_path = MERIDIAN_DIR . '/assets/fonts/vazirmatn.woff2';
	if ( file_exists( $font_path ) ) {
		$font_face = '@font-face{
			font-family:"Vazirmatn";
			src:url("' . esc_url( MERIDIAN_URI . '/assets/fonts/vazirmatn.woff2' ) . '") format("woff2");
			font-weight:100 900;font-style:normal;font-display:swap;
			unicode-range:U+0000-00FF,U+0600-06FF,U+0750-077F,U+08A0-08FF,U+FB50-FDFF,U+FE70-FEFF,U+200C-200E,U+2010-2027,U+2030-205E,U+20AC;
		}';
		wp_register_style( 'meridian-font', false, array(), MERIDIAN_VERSION );
		wp_enqueue_style( 'meridian-font' );
		wp_add_inline_style( 'meridian-font', $font_face );
	} else {
		wp_enqueue_style(
			'meridian-font',
			'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap',
			array(),
			null
		);
		add_filter( 'style_loader_tag', function ( $tag, $handle ) {
			if ( 'meridian-font' === $handle ) {
				$tag = str_replace( "rel='stylesheet'", "rel='stylesheet' crossorigin", $tag );
			}
			return $tag;
		}, 10, 2 );
		wp_enqueue_style( 'meridian-preconnect', false );
	}

	/* ---------------------------------------------------------------
	 * ۲) استایل‌های قالب — به ترتیب وابستگی
	 * ------------------------------------------------------------- */
	$css_files = array(
		'meridian-tokens'     => '/assets/css/tokens.css',
		'meridian-base'       => '/assets/css/base.css',
		'meridian-components' => '/assets/css/components.css',
		'meridian-sections'   => '/assets/css/sections.css',
	);
	foreach ( $css_files as $handle => $rel ) {
		$abs = MERIDIAN_DIR . $rel;
		wp_enqueue_style(
			$handle,
			MERIDIAN_URI . $rel,
			array( 'meridian-font' ),
			file_exists( $abs ) ? (string) filemtime( $abs ) : MERIDIAN_VERSION
		);
	}

	/* ---------------------------------------------------------------
	 * ۳) کتابخانه‌های انیمیشن — محلی (با Fallback خودکار به CDN)
	 * فایل‌ها در assets/js/vendor هستند؛ اگر حذف شوند CDN جایگزین می‌شود.
	 * (با Fallback نرم در JS — اگر لود نشوند سایت بدون انیمیشن سالم می‌ماند)
	 * ------------------------------------------------------------- */
	$in_footer  = array( 'strategy' => 'defer', 'in_footer' => true );
	$vendor_uri = MERIDIAN_URI . '/assets/js/vendor';
	$vendor_dir = MERIDIAN_DIR . '/assets/js/vendor';

	$meridian_lib = function ( $file, $cdn, $version ) use ( $vendor_uri, $vendor_dir ) {
		return file_exists( $vendor_dir . '/' . $file )
			? array( $vendor_uri . '/' . $file, (string) filemtime( $vendor_dir . '/' . $file ) )
			: array( $cdn, $version );
	};

	list( $gsap_src, $gsap_ver )    = $meridian_lib( 'gsap.min.js', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', '3.12.5' );
	list( $st_src, $st_ver )        = $meridian_lib( 'ScrollTrigger.min.js', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', '3.12.5' );
	list( $mp_src, $mp_ver )        = $meridian_lib( 'MotionPathPlugin.min.js', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/MotionPathPlugin.min.js', '3.12.5' );
	list( $lenis_src, $lenis_ver )  = $meridian_lib( 'lenis.min.js', 'https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js', '1.1.18' );

	wp_enqueue_script( 'gsap', $gsap_src, array(), $gsap_ver, $in_footer );
	wp_enqueue_script( 'gsap-scrolltrigger', $st_src, array( 'gsap' ), $st_ver, $in_footer );
	wp_enqueue_script( 'gsap-motionpath', $mp_src, array( 'gsap' ), $mp_ver, $in_footer );
	wp_enqueue_script( 'lenis', $lenis_src, array(), $lenis_ver, $in_footer );

	/* ---------------------------------------------------------------
	 * ۴) هسته + ماژول‌های انیمیشن قالب
	 * ------------------------------------------------------------- */
	$deps_core = array( 'gsap', 'gsap-scrolltrigger', 'gsap-motionpath', 'lenis' );

	wp_enqueue_script(
		'meridian-app',
		MERIDIAN_URI . '/assets/js/app.js',
		$deps_core,
		(string) @filemtime( MERIDIAN_DIR . '/assets/js/app.js' ),
		$in_footer
	);

	$modules = array(
		'loader',          // صفحه‌ی لودینگ
		'hero',            // تایم‌لاین سینمایی Hero
		'scroll',          // ریویلها، هدر، اسکرول افقی
		'text-reveal',     // اسپلیت خط‌به‌خط تیترها
		'parallax',        // پارالاکس تصاویر و سکشن‌ها
		'motion-path',     // مسیر حرکتی سکشن فرآیند
		'counters',        // شمارشگرها با اعداد فارسی
		'magnetic',        // دکمه‌های مغناطیسی
		'cursor',          // کرسر سفارشی
		'sliders',         // اسلایدر نظرات (RS در صورت وجود اولویت دارد)
		'menu',            // منوی موبایل تمام‌صفحه
		'interactions',    // تعامل‌های خدمات/صنایع/فرم
		'page-transition', // ترنزیشن بین صفحات
	);
	foreach ( $modules as $mod ) {
		$file = "/assets/js/animations/{$mod}.js";
		if ( file_exists( MERIDIAN_DIR . $file ) ) {
			wp_enqueue_script(
				"meridian-{$mod}",
				MERIDIAN_URI . $file,
				array( 'meridian-app' ),
				(string) filemtime( MERIDIAN_DIR . $file ),
				$in_footer
			);
		}
	}

	// داده‌های مشترک برای JS
	wp_localize_script( 'meridian-app', 'MERIDIAN_DATA', array(
		'homeUrl'    => esc_url( home_url( '/' ) ),
		'ajaxUrl'    => esc_url( admin_url( 'admin-ajax.php' ) ),
		'isRtl'      => is_rtl(),
		'fontLoaded' => file_exists( $font_path ),
	) );
}
add_action( 'wp_enqueue_scripts', 'meridian_assets' );

// حذف emoji bloat پیش‌فرض وردپرس (Performance)
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
