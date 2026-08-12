<?php
/**
 * سکشن ۴ — خدمات (لیست تعاملی + پیش‌نمایش شناور دنبال‌کننده‌ی کرسر).
 * منطق تعامل در animations/interactions.js.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// ۴ تا ۸ خدمت — هر آیتم یک کامپوننت قابل‌تکرار در المنتور است
$services = array(
	array(
		'title' => 'استراتژی و مشاوره',
		'desc'  => '[توضیح خدمت] — تحلیل بازار، طراحی مدل کسب‌وکار و نقشه‌ی راه رشد.',
		'tag'   => 'Strategy',
	),
	array(
		'title' => 'توسعه‌ی فناوری',
		'desc'  => '[توضیح خدمت] — معماری نرم‌افزار، پلتفرم‌های ابری و محصولات دیجیتال مقیاس‌پذیر.',
		'tag'   => 'Technology',
	),
	array(
		'title' => 'مهندسی و اجرا',
		'desc'  => '[توضیح خدمت] — مدیریت پروژه‌های پیچیده‌ی مهندسی از طراحی تا تحویل.',
		'tag'   => 'Engineering',
	),
	array(
		'title' => 'تحول دیجیتال',
		'desc'  => '[توضیح خدمت] — بازطراحی فرآیندها و سیستم‌ها برای سازمان‌های داده‌محور.',
		'tag'   => 'Transformation',
	),
	array(
		'title' => 'سرمایه‌گذاری و رشد',
		'desc'  => '[توضیح خدمت] — ساختاردهی مالی، جذب سرمایه و توسعه‌ی بازارهای جدید.',
		'tag'   => 'Investment',
	),
);
?>
<section class="mrd-services mrd-section--pad" id="services" data-section="services" data-services>
	<div class="mrd-container">

		<div class="mrd-services__grid">

			<header class="mrd-services__head">
				<span class="mrd-eyebrow" data-mrd="fade-up"><?php echo meridian_svg( 'line' ); ?> خدمات ما</span>
				<h2 class="mrd-h2" data-split="lines">راه‌حل‌های یکپارچه، از استراتژی تا اجرا.</h2>
				<p class="mrd-lead mrd-text-muted" data-mrd="fade-up" data-mrd-delay="0.15">
					[توضیح سکشن خدمات] — پنج حوزه‌ی تخصصی، یک تیم واحد.
				</p>
				<a href="#contact" class="mrd-btn mrd-btn--ghost" data-mrd="fade-up" data-mrd-delay="0.25">
					<span class="mrd-btn__label">دریافت مشاوره</span>
					<span class="mrd-btn__arrow"><?php echo meridian_svg( 'arrow-up-l' ); ?></span>
				</a>
			</header>

			<div class="mrd-services__list" data-services-list>
				<?php foreach ( $services as $i => $s ) :
					$num = '۰' . ( $i + 1 );
					?>
					<article class="mrd-service<?php echo 0 === $i ? ' is-active' : ''; ?>" data-service data-mrd="fade-up" tabindex="0" aria-expanded="<?php echo 0 === $i ? 'true' : 'false'; ?>">
						<div class="mrd-service__row">
							<span class="mrd-service__num"><?php echo esc_html( $num ); ?></span>
							<h3 class="mrd-service__title"><?php echo esc_html( $s['title'] ); ?></h3>
							<span class="mrd-service__plus"><?php echo meridian_svg( 'plus' ); ?></span>
						</div>
						<div class="mrd-service__body">
							<div class="mrd-service__body-in">
								<p class="mrd-service__desc"><?php echo esc_html( $s['desc'] ); ?></p>
								<span class="mrd-service__tag"><?php echo esc_html( $s['tag'] ); ?></span>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

		</div>
	</div>

	<!-- پیش‌نمایش شناور — دنبال‌کننده‌ی کرسر (فقط دسکتاپ) -->
	<div class="mrd-services__preview" data-services-preview aria-hidden="true">
		<?php foreach ( $services as $i => $s ) : ?>
			<figure class="mrd-services__preview-img<?php echo 0 === $i ? ' is-active' : ''; ?>" data-services-preview-img>
				<img src="<?php echo esc_url( meridian_placeholder_img( 520, 640, '[تصویر ' . $s['title'] . ']', true ) ); ?>"
					alt="" width="520" height="640" loading="lazy" decoding="async">
			</figure>
		<?php endforeach; ?>
	</div>

</section>
