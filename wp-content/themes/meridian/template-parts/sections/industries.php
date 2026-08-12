<?php
/**
 * سکشن ۶ — صنایع / توانمندی‌ها (گرید تعاملی).
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// نام، توضیح کوتاه — تصویر اختیاری با افزودن کلید 'img'
$industries = array(
	array( 'title' => 'فناوری',      'desc' => '[توضیح کوتاه]' ),
	array( 'title' => 'ساختمان',     'desc' => '[توضیح کوتاه]' ),
	array( 'title' => 'مالی',        'desc' => '[توضیح کوتاه]' ),
	array( 'title' => 'تولید',       'desc' => '[توضیح کوتاه]' ),
	array( 'title' => 'انرژی',       'desc' => '[توضیح کوتاه]' ),
	array( 'title' => 'املاک',       'desc' => '[توضیح کوتاه]' ),
	array( 'title' => 'سلامت',       'desc' => '[توضیح کوتاه]' ),
	array( 'title' => 'لجستیک',      'desc' => '[توضیح کوتاه]' ),
);
?>
<section class="mrd-industries mrd-section--pad" id="industries" data-section="industries">
	<div class="mrd-container">

		<header class="mrd-section-head" data-mrd="fade-up">
			<span class="mrd-eyebrow"><?php echo meridian_svg( 'line' ); ?> صنایع و توانمندی‌ها</span>
			<h2 class="mrd-h2" data-split="lines">تجربه‌ی عمیق در صنایع کلیدی.</h2>
		</header>

		<div class="mrd-industries__grid" data-mrd-group>
			<?php foreach ( $industries as $i => $ind ) : ?>
				<a href="#contact" class="mrd-industry" data-industry>
					<span class="mrd-industry__num"><?php echo esc_html( '۰' . ( $i + 1 ) ); ?></span>
					<h3 class="mrd-industry__title"><?php echo esc_html( $ind['title'] ); ?></h3>
					<p class="mrd-industry__desc"><?php echo esc_html( $ind['desc'] ); ?></p>
					<span class="mrd-industry__arrow"><?php echo meridian_svg( 'arrow-up-l' ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>

	</div>
</section>
