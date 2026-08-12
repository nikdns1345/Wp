<?php
/**
 * سکشن ۵ — پروژه‌های شاخص (لایه‌بندی ادیتوریال).
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$projects = array(
	array(
		'title'    => '[نام پروژه] پلتفرم یکپارچه‌ی بانکی',
		'category' => 'فناوری مالی',
		'year'     => '۱۴۰۳',
		'desc'     => '[توضیح کوتاه پروژه]',
		'img'      => MERIDIAN_URI . '/assets/img/project-a.jpg',
	),
	array(
		'title'    => '[نام پروژه] نیروگاه خورشیدی ۴۰ مگاواتی',
		'category' => 'انرژی',
		'year'     => '۱۴۰۲',
		'desc'     => '[توضیح کوتاه پروژه]',
		'img'      => MERIDIAN_URI . '/assets/img/project-b.jpg',
	),
	array(
		'title'    => '[نام پروژه] برج اداری مرکزی',
		'category' => 'ساختمان',
		'year'     => '۱۴۰۲',
		'desc'     => '[توضیح کوتاه پروژه]',
		'img'      => 'ph', // placeholder svg
	),
	array(
		'title'    => '[نام پروژه] شبکه‌ی لجستیک هوشمند',
		'category' => 'لجستیک',
		'year'     => '۱۴۰۱',
		'desc'     => '[توضیح کوتاه پروژه]',
		'img'      => 'ph-dark',
	),
);
?>
<section class="mrd-projects mrd-section--pad" id="projects" data-section="projects">
	<div class="mrd-container">

		<header class="mrd-section-head" data-mrd="fade-up">
			<span class="mrd-eyebrow"><?php echo meridian_svg( 'line' ); ?> پروژه‌های شاخص</span>
			<h2 class="mrd-h2" data-split="lines">کارهایی که به آن‌ها افتخار می‌کنیم.</h2>
			<a href="#case-studies" class="mrd-btn mrd-btn--text mrd-section-head__cta">
				<span class="mrd-btn__label">مشاهده‌ی همه‌ی پروژه‌ها</span>
				<span class="mrd-btn__circle"><?php echo meridian_svg( 'arrow-left' ); ?></span>
			</a>
		</header>

		<div class="mrd-projects__grid">
			<?php foreach ( $projects as $i => $p ) :
				$img = 'ph' === $p['img']
					? meridian_placeholder_img( 1100, 800, '[تصویر پروژه]' )
					: ( 'ph-dark' === $p['img']
						? meridian_placeholder_img( 1100, 800, '[تصویر پروژه]', true )
						: $p['img'] );
				?>
				<article class="mrd-project<?php echo 1 === $i % 2 ? ' mrd-project--offset' : ''; ?>" data-mrd="fade-up" data-mrd-delay="<?php echo esc_attr( ( $i % 2 ) * 0.12 ); ?>">
					<a href="#case-studies" class="mrd-project__link" data-cursor="مشاهده" aria-label="<?php echo esc_attr( $p['title'] ); ?>">
						<figure class="mrd-project__media u-hover-zoom">
							<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?>"
								width="1100" height="800" loading="lazy" decoding="async">
							<span class="mrd-project__year"><?php echo esc_html( $p['year'] ); ?></span>
						</figure>
						<div class="mrd-project__meta">
							<span class="mrd-project__cat"><?php echo esc_html( $p['category'] ); ?></span>
							<span class="mrd-project__index"><?php echo esc_html( '۰' . ( $i + 1 ) ); ?></span>
						</div>
						<h3 class="mrd-project__title"><?php echo esc_html( $p['title'] ); ?></h3>
						<p class="mrd-project__desc mrd-text-muted"><?php echo esc_html( $p['desc'] ); ?></p>
					</a>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>
