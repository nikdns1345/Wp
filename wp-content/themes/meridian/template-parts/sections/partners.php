<?php
/**
 * سکشن ۱۱ — شرکا / مشتریان (دیوار لوگو مینیمال؛ grayscale → رنگی در هاور).
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// نام‌های placeholder — با لوگوی SVG/تصویر واقعی جایگزین شود
$partners = array( 'آریا', 'پارت', 'توس', 'همتا', 'رایان', 'شتاب', 'نگین', 'فراز' );
?>
<section class="mrd-partners" id="partners" data-section="partners">
	<div class="mrd-container">

		<header class="mrd-partners__head" data-mrd="fade-up">
			<span class="mrd-eyebrow"><?php echo meridian_svg( 'line' ); ?> شرکا و مشتریان</span>
		</header>

		<ul class="mrd-partners__wall" data-mrd-group>
			<?php foreach ( $partners as $name ) : ?>
				<li class="mrd-partners__item">
					<span class="mrd-partners__logo" aria-label="<?php echo esc_attr( '[لوگوی شریک] ' . $name ); ?>" role="img">
						<?php echo meridian_svg( 'logo' ); ?>
						<em><?php echo esc_html( $name ); ?></em>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>

	</div>
</section>
