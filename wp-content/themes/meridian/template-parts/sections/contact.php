<?php
/**
 * سکشن ۱۳ — تماس (فرم مینیمال با لیبل شناور + اطلاعات تماس + placeholder نقشه).
 *
 * در محیط واقعی: اکشن فرم را به Elementor Forms / WPForms / FluentForms متصل کنید
 * یا سکشن را با فرم‌ساز المنتور بازسازی کنید (کلاس‌های mrd-field را hفظ کنید).
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<section class="mrd-contact mrd-section--pad" id="contact" data-section="contact">
	<div class="mrd-container">

		<div class="mrd-contact__grid">

			<div class="mrd-contact__intro">
				<span class="mrd-eyebrow" data-mrd="fade-up"><?php echo meridian_svg( 'line' ); ?> تماس با ما</span>
				<h2 class="mrd-h2" data-split="lines">گفت‌وگو را آغاز کنیم.</h2>
				<p class="mrd-lead mrd-text-muted" data-mrd="fade-up" data-mrd-delay="0.15">
					[توضیح تماس] — معمولاً در کمتر از ۲۴ ساعت کاری پاسخ می‌دهیم.
				</p>

				<ul class="mrd-contact__info" data-mrd-group>
					<li>
						<span class="mrd-contact__info-label">تلفن</span>
						<a href="tel:+982100000000" class="mrd-link-line">۰۲۱-۰۰۰۰۰۰۰۰</a>
					</li>
					<li>
						<span class="mrd-contact__info-label">ایمیل</span>
						<a href="mailto:info@example.com" class="mrd-link-line">info@example.com</a>
					</li>
					<li>
						<span class="mrd-contact__info-label">دفتر مرکزی</span>
						<address>تهران، خیابان نمونه، پلاک ۱۲، واحد ۴</address>
					</li>
					<li>
						<span class="mrd-contact__info-label">شبکه‌های اجتماعی</span>
						<?php meridian_social_links(); ?>
					</li>
				</ul>

				<div class="mrd-contact__map" data-mrd="fade-up">
					<?php echo meridian_svg( 'map' ); ?>
					<span>[نقشه] — دفتر مرکزی</span>
				</div>
			</div>

			<form class="mrd-form" data-mrd="fade-up" data-mrd-delay="0.2" action="#" method="post" novalidate>
				<div class="mrd-field">
					<input type="text" id="mrd-name" name="name" placeholder=" " required autocomplete="name">
					<label for="mrd-name">نام و نام خانوادگی</label>
				</div>
				<div class="mrd-field">
					<input type="email" id="mrd-email" name="email" placeholder=" " required autocomplete="email" dir="ltr">
					<label for="mrd-email">ایمیل</label>
				</div>
				<div class="mrd-field">
					<input type="text" id="mrd-subject" name="subject" placeholder=" ">
					<label for="mrd-subject">موضوع</label>
				</div>
				<div class="mrd-field mrd-field--area">
					<textarea id="mrd-message" name="message" rows="5" placeholder=" " required></textarea>
					<label for="mrd-message">پیام شما</label>
				</div>
				<button type="submit" class="mrd-btn mrd-btn--solid mrd-form__submit" data-magnetic="0.35">
					<span class="mrd-btn__label">ارسال پیام</span>
					<span class="mrd-btn__arrow"><?php echo meridian_svg( 'arrow-up-l' ); ?></span>
				</button>
				<p class="mrd-form__note">با ارسال این فرم، [شرایط حریم خصوصی] را می‌پذیرید.</p>
			</form>

		</div>

	</div>
</section>
