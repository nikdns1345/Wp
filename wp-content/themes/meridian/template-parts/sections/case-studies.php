<?php
/**
 * سکشن ۸ — کیس‌استادی‌ها (اسکرول افقی پین‌شده با ScrollTrigger).
 * در موبایل به‌صورت خودکار به حالت عمودی تغییر می‌کند (scroll.js).
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$cases = array(
	array(
		'title' => '[نام کیس‌استادی] تحول دیجیتال هلدینگ صنعتی',
		'cat'   => 'تحول دیجیتال',
		'year'  => '۱۴۰۳',
		'stat'  => '۴۰٪',
		'statL' => 'افزایش بهره‌وری',
	),
	array(
		'title' => '[نام کیس‌استادی] سکوی پرداخت نسل جدید',
		'cat'   => 'فناوری مالی',
		'year'  => '۱۴۰۲',
		'stat'  => '۲×',
		'statL' => 'رشد تراکنش',
	),
	array(
		'title' => '[نام کیس‌استادی] مجتمع مسکونی سبز',
		'cat'   => 'ساختمان',
		'year'  => '۱۴۰۱',
		'stat'  => 'LEED',
		'statL' => 'گواهی طلایی',
	),
);
?>
<section class="mrd-cases" id="case-studies" data-section="cases" data-horizontal>
	<div class="mrd-cases__pin">

		<header class="mrd-cases__head mrd-container">
			<span class="mrd-eyebrow mrd-eyebrow--accent"><?php echo meridian_svg( 'line' ); ?> کیس‌استادی</span>
			<h2 class="mrd-h2">نتایج قابل‌اندازه‌گیری.</h2>
		</header>

		<div class="mrd-cases__track" data-horizontal-track>
			<?php foreach ( $cases as $i => $c ) : ?>
				<article class="mrd-case" data-horizontal-item>
					<figure class="mrd-case__media u-hover-zoom">
						<img src="<?php echo esc_url( meridian_placeholder_img( 1200, 860, '[تصویر کیس‌استادی]', 0 !== $i % 2 ) ); ?>"
							alt="<?php echo esc_attr( $c['title'] ); ?>" width="1200" height="860" loading="lazy" decoding="async">
					</figure>
					<div class="mrd-case__body">
						<span class="mrd-case__index"><?php echo esc_html( ( ( $i + 1 ) < 10 ? '۰' : '' ) . ( $i + 1 ) ); ?></span>
						<div class="mrd-case__info">
							<span class="mrd-case__cat"><?php echo esc_html( $c['cat'] ); ?> · <?php echo esc_html( $c['year'] ); ?></span>
							<h3 class="mrd-case__title"><?php echo esc_html( $c['title'] ); ?></h3>
						</div>
						<div class="mrd-case__stat">
							<strong><?php echo esc_html( $c['stat'] ); ?></strong>
							<span><?php echo esc_html( $c['statL'] ); ?></span>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="mrd-cases__progress" aria-hidden="true"><span data-horizontal-progress></span></div>

	</div>
</section>
