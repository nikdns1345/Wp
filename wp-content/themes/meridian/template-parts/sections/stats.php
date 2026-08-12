<?php
/**
 * سکشن ۳ — آمار و ارقام (شمارشگر فارسی با GSAP؛ ماژول counters.js).
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// مقادیر — همه از المنتور/این آرایه قابل ویرایش‌اند
$stats = array(
	array( 'value' => 15, 'suffix' => '+', 'label' => 'سال تجربه' ),
	array( 'value' => 120, 'suffix' => '+', 'label' => 'پروژه‌ی موفق' ),
	array( 'value' => 35, 'suffix' => '', 'label' => 'صنعت' ),
	array( 'value' => 98, 'suffix' => '٪', 'label' => 'رضایت مشتری' ),
);
?>
<section class="mrd-stats" id="stats" data-section="stats">
	<div class="mrd-container">

		<div class="mrd-stats__grid" data-mrd-group>
			<?php foreach ( $stats as $s ) : ?>
				<div class="mrd-stat">
					<span class="mrd-stat__number">
						<span data-counter data-counter-target="<?php echo esc_attr( $s['value'] ); ?>" data-counter-duration="2">۰</span><em class="mrd-stat__suffix"><?php echo esc_html( $s['suffix'] ); ?></em>
					</span>
					<span class="mrd-stat__label"><?php echo esc_html( $s['label'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
