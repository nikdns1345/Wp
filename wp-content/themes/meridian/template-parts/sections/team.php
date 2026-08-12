<?php
/**
 * سکشن ۱۰ — تیم.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$members = array(
	array( 'name' => '[نام عضو تیم]', 'role' => 'مدیرعامل' ),
	array( 'name' => '[نام عضو تیم]', 'role' => 'مدیر فناوری' ),
	array( 'name' => '[نام عضو تیم]', 'role' => 'مدیر طراحی' ),
	array( 'name' => '[نام عضو تیم]', 'role' => 'مدیر پروژه' ),
);
?>
<section class="mrd-team mrd-section--pad" id="team" data-section="team">
	<div class="mrd-container">

		<header class="mrd-section-head" data-mrd="fade-up">
			<span class="mrd-eyebrow"><?php echo meridian_svg( 'line' ); ?> تیم ما</span>
			<h2 class="mrd-h2" data-split="lines">افرادی که اتفاق‌ها را رقم می‌زنند.</h2>
		</header>

		<div class="mrd-team__grid" data-mrd-group>
			<?php foreach ( $members as $m ) : ?>
				<article class="mrd-member">
					<figure class="mrd-member__media u-hover-zoom">
						<img src="<?php echo esc_url( meridian_placeholder_img( 600, 760, '[عکس عضو تیم]' ) ); ?>"
							alt="<?php echo esc_attr( '[عکس] ' . $m['name'] ); ?>" width="600" height="760" loading="lazy" decoding="async">
						<div class="mrd-member__socials">
							<?php meridian_social_links( 'mrd-social mrd-social--card' ); ?>
						</div>
					</figure>
					<h3 class="mrd-member__name"><span class="mrd-member__name-text"><?php echo esc_html( $m['name'] ); ?></span></h3>
					<span class="mrd-member__role"><?php echo esc_html( $m['role'] ); ?></span>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>
