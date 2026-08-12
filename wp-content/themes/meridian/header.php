<?php
/**
 * هدر قالب: <head>، لودر، کرسر سفارشی، هدر چسبان، منوی موبایل تمام‌صفحه.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#F7F6F3">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="mrd-skip-link" href="#main-content">پرش به محتوای اصلی</a>

<?php get_template_part( 'template-parts/preloader' ); ?>

<!-- کرسر سفارشی (فقط دسکتاپ/دسکتاپ دقیق) -->
<div class="mrd-cursor" aria-hidden="true">
	<span class="mrd-cursor__dot"></span>
	<span class="mrd-cursor__ring"></span>
	<span class="mrd-cursor__label"></span>
</div>

<!-- لایه‌ی ترنزیشن بین صفحات -->
<div class="mrd-transition" aria-hidden="true">
	<span class="mrd-transition__panel"></span>
	<span class="mrd-transition__panel"></span>
	<span class="mrd-transition__panel"></span>
	<span class="mrd-transition__panel"></span>
	<span class="mrd-transition__panel"></span>
</div>

<!-- ====================== HEADER ====================== -->
<header class="mrd-header" data-header>
	<div class="mrd-header__inner mrd-container">

		<div class="mrd-header__brand">
			<?php meridian_logo(); ?>
		</div>

		<nav class="mrd-nav" aria-label="ناوبری اصلی">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'mrd-nav__list',
					'depth'          => 1,
					'link_before'    => '<span class="mrd-nav__text">',
					'link_after'     => '</span>',
				) );
			} else {
				meridian_default_menu();
			}
			?>
		</nav>

		<div class="mrd-header__actions">
			<a href="#contact" class="mrd-btn mrd-btn--solid mrd-btn--sm" data-magnetic="0.35">
				<span class="mrd-btn__label">شروع پروژه</span>
				<span class="mrd-btn__arrow"><?php echo meridian_svg( 'arrow-up-l' ); ?></span>
			</a>

			<button class="mrd-burger" data-menu-toggle aria-expanded="false" aria-controls="mrd-menu" aria-label="باز کردن منو">
				<span class="mrd-burger__line"></span>
				<span class="mrd-burger__line"></span>
			</button>
		</div>

	</div>
</header>

<!-- ====================== MOBILE / FULLSCREEN MENU ====================== -->
<div class="mrd-menu" id="mrd-menu" data-menu aria-hidden="true">
	<div class="mrd-menu__bg"></div>
	<div class="mrd-menu__inner mrd-container">

		<nav class="mrd-menu__nav" aria-label="منوی تمام‌صفحه">
			<?php
			$menu_links = array(
				array( 'url' => '#about',    'label' => 'درباره ما' ),
				array( 'url' => '#services', 'label' => 'خدمات' ),
				array( 'url' => '#projects', 'label' => 'پروژه‌ها' ),
				array( 'url' => '#process',  'label' => 'فرآیند' ),
				array( 'url' => '#team',     'label' => 'تیم ما' ),
				array( 'url' => '#contact',  'label' => 'تماس با ما' ),
			);
			echo '<ul class="mrd-menu__list">';
			foreach ( $menu_links as $i => $l ) {
				printf(
					'<li class="mrd-menu__item"><a href="%s" class="mrd-menu__link"><span class="mrd-menu__index">%s</span><span class="mrd-menu__text-clip"><span class="mrd-menu__text">%s</span></span></a></li>',
					esc_url( $l['url'] ),
					esc_html( '۰' . ( $i + 1 ) ),
					esc_html( $l['label'] )
				);
			}
			echo '</ul>';
			?>
		</nav>

		<div class="mrd-menu__meta">
			<div class="mrd-menu__meta-col" data-menu-meta>
				<span class="mrd-eyebrow">تماس</span>
				<a href="tel:+982100000000" class="mrd-link-line">[تلفن] ۰۲۱-۰۰۰۰۰۰۰۰</a>
				<a href="mailto:info@example.com" class="mrd-link-line">[ایمیل] info@example.com</a>
			</div>
			<div class="mrd-menu__meta-col" data-menu-meta>
				<span class="mrd-eyebrow">شبکه‌های اجتماعی</span>
				<?php meridian_social_links( 'mrd-social mrd-social--dark' ); ?>
			</div>
		</div>

	</div>
</div>

<main id="main-content" class="mrd-main">
<?php
if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
	// اگر هدر سفارشی با Theme Builder ساخته شده باشد، هدر پیش‌فرض نادیده گرفته می‌شود.
}
