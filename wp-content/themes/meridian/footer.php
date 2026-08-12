<?php
/**
 * فوتر قالب: فوتر چندستونه، دکمه‌ی بازگشت به بالا، wp_footer.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
</main><!-- .mrd-main -->

<?php if ( ! ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) ) : ?>

<!-- ====================== FOOTER ====================== -->
<footer class="mrd-footer" data-footer>
	<div class="mrd-container">

		<div class="mrd-footer__top" data-mrd="fade-up">
			<a href="#contact" class="mrd-footer__cta mrd-link-line mrd-link-line--light">
				<span>برای شروع یک گفت‌وگو آماده‌ایم</span>
				<?php echo meridian_svg( 'arrow-up-l' ); ?>
			</a>
		</div>

		<div class="mrd-footer__grid" data-mrd-group>

			<div class="mrd-footer__col mrd-footer__col--brand">
				<?php meridian_logo( 'mrd-logo mrd-logo--light' ); ?>
				<p class="mrd-footer__desc">
					[توضیح کوتاه شرکت] — شریک راهبردی شما در طراحی، مهندسی و توسعه‌ی راه‌حل‌های
					کسب‌وکاری در مقیاس بین‌المللی.
				</p>
				<?php meridian_social_links( 'mrd-social mrd-social--dark' ); ?>
			</div>

			<div class="mrd-footer__col">
				<h4 class="mrd-footer__title">دسترسی سریع</h4>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'mrd-footer__nav-list',
						'depth'          => 1,
					) );
				} else {
					meridian_default_footer_menu();
				}
				?>
			</div>

			<div class="mrd-footer__col">
				<h4 class="mrd-footer__title">خدمات</h4>
				<ul class="mrd-footer__nav-list">
					<li><a class="mrd-link-line" href="#services">[نام خدمت ۱] استراتژی و مشاوره</a></li>
					<li><a class="mrd-link-line" href="#services">[نام خدمت ۲] توسعه‌ی فناوری</a></li>
					<li><a class="mrd-link-line" href="#services">[نام خدمت ۳] مهندسی و اجرا</a></li>
					<li><a class="mrd-link-line" href="#services">[نام خدمت ۴] سرمایه‌گذاری و رشد</a></li>
				</ul>
			</div>

			<div class="mrd-footer__col">
				<h4 class="mrd-footer__title">تماس</h4>
				<ul class="mrd-footer__contact">
					<li><a class="mrd-link-line" href="tel:+982100000000">۰۲۱-۰۰۰۰۰۰۰۰</a></li>
					<li><a class="mrd-link-line" href="mailto:info@example.com">info@example.com</a></li>
					<li class="mrd-footer__address">[آدرس] — تهران، خیابان نمونه، پلاک ۱۲، واحد ۴</li>
				</ul>
			</div>

		</div>

		<div class="mrd-footer__bottom">
			<p class="mrd-footer__copy">
				© <span data-year><?php echo esc_html( date_i18n( 'Y' ) ); ?></span> [نام شرکت] — تمامی حقوق محفوظ است.
			</p>
			<p class="mrd-footer__note">ساخته‌شده با الگوی Meridian</p>
		</div>

	</div>
</footer>

<button class="mrd-to-top" data-to-top aria-label="بازگشت به بالا">
	<?php echo meridian_svg( 'arrow-up' ); ?>
</button>

<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
