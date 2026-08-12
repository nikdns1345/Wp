<?php
/**
 * روتر پیش‌نمایش — فایل‌های استاتیک (CSS/JS/تصاویر) مستقیم سرو می‌شوند
 * و بقیه‌ی مسیرها به رندر صفحه‌ی اصلی می‌رسند.
 *
 * usage: php -S 0.0.0.0:8080 -t . preview/router.php
 *
 * @package Meridian
 */

$path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$path = '/' . ltrim( (string) $path, '/' );

// فایل استاتیک واقعی → سرو مستقیم توسط وب‌سرور داخلی PHP
if ( '/' !== $path ) {
	$file = dirname( __DIR__ ) . $path;
	if ( is_file( $file ) ) {
		return false;
	}
}

require __DIR__ . '/index.php';
