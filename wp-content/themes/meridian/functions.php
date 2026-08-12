<?php
/**
 * Meridian Corporate — functions.php
 * قالب ماستر شرکتی فارسی/RTL برای وردپرس + المنتور پرو.
 *
 * ساختار:
 *   inc/setup.php     → ثبت قابلیت‌ها، منوها، سایز تصاویر
 *   inc/enqueue.php   → لود فونت محلی، CSS و ماژول‌های JS
 *   inc/helpers.php   → SVGها، تصاویر Placeholder و ابزارها
 *   inc/elementor.php → یکپارچه‌سازی با المنتور (Locations, Kit)
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'MERIDIAN_VERSION', '1.0.0' );
define( 'MERIDIAN_DIR', get_template_directory() );
define( 'MERIDIAN_URI', get_template_directory_uri() );

require_once MERIDIAN_DIR . '/inc/setup.php';
require_once MERIDIAN_DIR . '/inc/enqueue.php';
require_once MERIDIAN_DIR . '/inc/helpers.php';
require_once MERIDIAN_DIR . '/inc/elementor.php';
