<?php
/**
 * پیش‌نمایش زنده‌ی قالب Meridian — بدون نیاز به وردپرس!
 *
 * این فایل با «استاب» کردن توابع وردپرس، خروجی واقعی front-page.php
 * قالب را رندر می‌کند تا طراحی و انیمیشن‌ها را مستقیم ببینید.
 *
 * اجرا (از ریشه‌ی مخزن):
 *   php -S 0.0.0.0:8080 -t . preview/router.php
 * سپس مرورگر: http://localhost:8080
 *
 * @package Meridian
 */

/* ── ثابت‌ها ─────────────────────────────────────────────── */
define( 'ABSPATH', dirname( __DIR__ ) . '/' );
define( 'MERIDIAN_VERSION', '1.1.0' );
define( 'MERIDIAN_DIR', ABSPATH . 'wp-content/themes/meridian' );
define( 'MERIDIAN_URI', '/wp-content/themes/meridian' );

/* ── استاب‌های عمومی وردپرس ──────────────────────────────── */
function add_action() {}    function add_filter() {}
function remove_action() {} function do_action() {}
function register_nav_menus() {} function register_sidebar() {}
function add_theme_support() {}  function add_image_size() {}
function apply_filters( $hook, $value = null ) { return $value; }
function get_option( $k, $d = false ) { return $d; }
function update_option() { return true; }

function esc_html( $t ) { return htmlspecialchars( (string) $t, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $t ) { return htmlspecialchars( (string) $t, ENT_QUOTES, 'UTF-8' ); }
function esc_url( $t )  { return $t; }
function esc_html__( $t ) { return $t; }

function bloginfo( $show = '' ) { echo get_bloginfo( $show ); }
function get_bloginfo( $show = '' ) {
	switch ( $show ) {
		case 'charset':     return 'UTF-8';
		case 'description': return 'شریک راهبردی رشد کسب‌وکار';
		case 'name':
		default:            return 'مِریدین';
	}
}
function language_attributes() { echo 'lang="fa-IR"'; }
function body_class() {}
function wp_body_open() {}
function home_url( $path = '/' ) { return $path; }
function admin_url( $path = '' ) { return $path; }
function is_rtl() { return true; }
function has_nav_menu() { return false; }
function wp_nav_menu() {}
function has_custom_logo() { return false; }
function get_custom_logo() { return ''; }
function date_i18n( $format ) { return 'Y' === $format ? '۱۴۰۵' : date( $format ); }

/* ── استاب قالب ──────────────────────────────────────────── */
function get_header() { require MERIDIAN_DIR . '/header.php'; }
function get_footer() { require MERIDIAN_DIR . '/footer.php'; }
function get_template_part( $slug ) {
	$file = MERIDIAN_DIR . '/' . $slug . '.php';
	if ( file_exists( $file ) ) { require $file; }
}

/* ── خروجی <head> (معادل inc/enqueue.php) ────────────────── */
function wp_head() {
	$v = MERIDIAN_VERSION;
	echo "\t<!-- فونت محلی وزیرمتن -->\n";
	echo "\t<style>@font-face{font-family:'Vazirmatn';src:url('" . MERIDIAN_URI . "/assets/fonts/vazirmatn.woff2?v={$v}') format('woff2');font-weight:100 900;font-style:normal;font-display:swap}</style>\n";
	foreach ( array( 'tokens', 'base', 'components', 'sections' ) as $css ) {
		printf(
			"\t<link rel='stylesheet' href='%s'>\n",
			MERIDIAN_URI . '/assets/css/' . $css . '.css?v=' . filemtime( MERIDIAN_DIR . '/assets/css/' . $css . '.css' )
		);
	}
}

/* ── خروجی <footer> اسکریپت‌ها (معادل inc/enqueue.php) ───── */
function wp_footer() {
	$src = array(
		'/assets/js/vendor/gsap.min.js',
		'/assets/js/vendor/ScrollTrigger.min.js',
		'/assets/js/vendor/MotionPathPlugin.min.js',
		'/assets/js/vendor/lenis.min.js',
		'/assets/js/app.js',
	);
	foreach ( array( 'loader', 'hero', 'scroll', 'text-reveal', 'parallax', 'motion-path', 'counters', 'magnetic', 'cursor', 'sliders', 'menu', 'interactions', 'page-transition' ) as $m ) {
		$src[] = '/assets/js/animations/' . $m . '.js';
	}
	echo "\t<script>var MERIDIAN_DATA={homeUrl:'/',ajaxUrl:'#',isRtl:true,fontLoaded:true};</script>\n";
	foreach ( $src as $s ) {
		$abs = MERIDIAN_DIR . $s;
		printf(
			"\t<script defer src='%s'></script>\n",
			MERIDIAN_URI . $s . ( file_exists( $abs ) ? '?v=' . filemtime( $abs ) : '' )
		);
	}
}

/* ── توابع قالب ──────────────────────────────────────────── */
require MERIDIAN_DIR . '/inc/setup.php';
require MERIDIAN_DIR . '/inc/helpers.php';

/* ── رندر صفحه‌ی اصلی ────────────────────────────────────── */
require MERIDIAN_DIR . '/front-page.php';
