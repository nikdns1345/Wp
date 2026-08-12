<?php
/**
 * صفحه‌ی اصلی دمو — ۱۵ سکشن کامل قالب.
 *
 * هر سکشن یک فایل مستقل در template-parts/sections است:
 *  1 header (در header.php)   2 hero      3 about       4 stats
 *  5 services                 6 projects  7 industries  8 process
 *  9 case-studies (افقی)     10 testimonials          11 team
 * 12 partners                13 cta      14 contact    15 footer (در footer.php)
 *
 * جایگزینی با المنتور: یک برگه‌ی جدید بسازید و سکشن‌ها را با
 * Flexbox Container + کلاس‌ها/Attributeهای مستند در docs بازسازی کنید،
 * سپس آن برگه را «صفحه‌ی اصلی» کنید — front-page.php دیگر استفاده نخواهد شد.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$sections = array(
	'hero',
	'about',
	'stats',
	'services',
	'projects',
	'industries',
	'process',
	'case-studies',
	'testimonials',
	'team',
	'partners',
	'cta',
	'contact',
);

foreach ( $sections as $section ) {
	get_template_part( 'template-parts/sections/' . $section );
}

get_footer();
