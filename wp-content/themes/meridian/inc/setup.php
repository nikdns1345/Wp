<?php
/**
 * ثبت قابلیت‌های قالب، منوها و سایز تصاویر.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function meridian_setup() {

	// مدیریت تگ title توسط وردپرس
	add_theme_support( 'title-tag' );

	// تصاویر شاخص و لوگوی سفارشی
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 320,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// HTML5 مارکاپ
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
	) );

	// پشتیبانی از استایل‌های بلوک و ویرایشگر
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );

	// سایزهای تصویر واکنش‌گرا (نسبت‌های ادیتوریال)
	add_image_size( 'meridian-hero', 1920, 1280, true );
	add_image_size( 'meridian-card', 900, 680, true );
	add_image_size( 'meridian-wide', 1600, 900, true );

	// منوها
	register_nav_menus( array(
		'primary'  => 'منوی اصلی (هدر)',
		'footer'   => 'منوی فوتر',
		'services' => 'منوی خدمات (فوتر)',
	) );
}
add_action( 'after_setup_theme', 'meridian_setup' );

// ویجت‌ناحیه‌ی فوتر (اختیاری — ستون‌ها در footer.php با Placeholder پر شده‌اند)
function meridian_widgets_init() {
	register_sidebar( array(
		'name'          => 'فوتر — ستون خبرنامه',
		'id'            => 'footer-1',
		'before_widget' => '<div class="mrd-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="mrd-widget__title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'meridian_widgets_init' );

/**
 * منوی پیش‌فرض فارسی وقتی هنوز منویی در پیشخوان ساخته نشده است.
 * لینک‌ها به سکشن‌های صفحه‌ی اصلی اشاره می‌کنند.
 */
function meridian_default_menu() {
	$items = array(
		'#about'     => 'درباره ما',
		'#services'  => 'خدمات',
		'#projects'  => 'پروژه‌ها',
		'#process'   => 'فرآیند',
		'#team'      => 'تیم',
		'#contact'   => 'تماس',
	);
	echo '<ul class="mrd-nav__list">';
	foreach ( $items as $href => $label ) {
		echo '<li class="mrd-nav__item"><a class="mrd-nav__link" href="' . esc_url( $href ) . '"><span class="mrd-nav__text">' . esc_html( $label ) . '</span></a></li>';
	}
	echo '</ul>';
}

function meridian_default_footer_menu() {
	$items = array(
		'#about'    => 'درباره ما',
		'#projects' => 'پروژه‌ها',
		'#process'  => 'فرآیند',
		'#contact'  => 'تماس',
	);
	echo '<ul class="mrd-footer__nav-list">';
	foreach ( $items as $href => $label ) {
		echo '<li><a href="' . esc_url( $href ) . '" class="mrd-link-line">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}
