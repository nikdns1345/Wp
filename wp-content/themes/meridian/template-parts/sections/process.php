<?php
/**
 * سکشن ۷ — فرآیند / روش‌شناسی + Motion Path.
 * مسیر SVG به‌صورت واکنش‌گرا در animations/motion-path.js ساخته می‌شود
 * و جسم متحرک با اسکرول (ScrollTrigger scrub) روی آن حرکت می‌کند.
 * مراحل با کلاس .is-active فعال می‌شوند.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$steps = array(
	array( 'title' => 'کشف',      'desc' => '[توضیح مرحله] — شناخت عمیق چالش، ذی‌نفعان و داده‌ها.' ),
	array( 'title' => 'استراتژی', 'desc' => '[توضیح مرحله] — تعریف مسیر، شاخص‌های موفقیت و نقشه‌ی راه.' ),
	array( 'title' => 'طراحی',    'desc' => '[توضیح مرحله] — طراحی راه‌حل با تمرکز بر دقت و تجربه.' ),
	array( 'title' => 'اجرا',     'desc' => '[توضیح مرحله] — توسعه و پیاده‌سازی با کنترل کیفیت مداوم.' ),
	array( 'title' => 'رشد',      'desc' => '[توضیح مرحله] — اندازه‌گیری، بهینه‌سازی و مقیاس.' ),
);
?>
<section class="mrd-process mrd-section--pad" id="process" data-section="process" data-process>
	<div class="mrd-container">

		<header class="mrd-section-head mrd-section-head--center" data-mrd="fade-up">
			<span class="mrd-eyebrow mrd-eyebrow--accent"><?php echo meridian_svg( 'line' ); ?> فرآیند ما</span>
			<h2 class="mrd-h2" data-split="lines">پنج مرحله تا نتیجه.</h2>
		</header>

		<div class="mrd-process__stage" data-process-stage>

			<!-- بوم مسیر حرکتی — SVG و path به‌صورت داینامیک رسم می‌شود -->
			<svg class="mrd-process__path" data-process-svg aria-hidden="true">
				<path data-process-line fill="none"></path>
				<path data-process-progress fill="none"></path>
				<g data-process-dot>
					<circle class="mrd-process__dot-halo" r="14"></circle>
					<circle class="mrd-process__dot-core" r="6"></circle>
				</g>
			</svg>

			<ol class="mrd-process__steps">
				<?php foreach ( $steps as $i => $step ) : ?>
					<li class="mrd-process__step<?php echo 0 === $i ? ' is-active' : ''; ?>" data-process-step>
						<span class="mrd-process__step-num"><?php echo esc_html( '۰' . ( $i + 1 ) ); ?></span>
						<h3 class="mrd-process__step-title"><?php echo esc_html( $step['title'] ); ?></h3>
						<p class="mrd-process__step-desc"><?php echo esc_html( $step['desc'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>

		</div>

	</div>
</section>
