/**
 * Module: interactions
 *  - لیست تعاملی خدمات: فعال‌شدن آیتم (هاور دسکتاپ / کلیک موبایل)
 *    + پیش‌نمایش شناور دنبال‌کننده‌ی کرسر (فقط دسکتاپ)
 *  - فرم تماس: کلاس filled برای سازگاری مرورگرها با لیبل شناور
 */
MERIDIAN.register('interactions', function (M) {
	'use strict';

	/* ── خدمات ─────────────────────────────────────────────── */
	var servicesSection = M.qs('[data-services]');
	if (servicesSection && M.tag(servicesSection, 'services')) {

		var services = M.qsa('[data-service]', servicesSection);
		var preview = M.qs('[data-services-preview]');
		var previewImgs = preview ? M.qsa('[data-services-preview-img]', preview) : [];

		function activate(item) {
			services.forEach(function (s) {
				var on = s === item;
				s.classList.toggle('is-active', on);
				s.setAttribute('aria-expanded', on ? 'true' : 'false');
			});
			var idx = services.indexOf(item);
			previewImgs.forEach(function (img, i) {
				img.classList.toggle('is-active', i === idx);
			});
		}

		services.forEach(function (item) {
			if (M.isTouch) {
				item.addEventListener('click', function () { activate(item); });
			} else {
				item.addEventListener('mouseenter', function () { activate(item); });
				item.addEventListener('focus', function () {
					activate(item);
					if (preview) preview.classList.remove('is-visible');
				});
			}
		});

		// پیش‌نمایش شناور — فقط دسکتاپ
		if (preview && !M.isTouch && M.hasGSAP && !M.reduced) {
			var pxTo = gsap.quickTo(preview, 'x', { duration: 0.55, ease: 'power3.out' });
			var pyTo = gsap.quickTo(preview, 'y', { duration: 0.55, ease: 'power3.out' });

			servicesSection.addEventListener('mousemove', function (e) {
				pxTo(e.clientX + 30);
				pyTo(e.clientY - preview.offsetHeight / 2);
			}, { passive: true });

			servicesSection.addEventListener('mouseenter', function () {
				preview.classList.add('is-visible');
			});
			servicesSection.addEventListener('mouseleave', function () {
				preview.classList.remove('is-visible');
			});
		}
	}

	/* ── فرم — کلاس filled برای مرورگرهای قدیمی ────────────── */
	M.qsa('.mrd-field input, .mrd-field textarea').forEach(function (field) {
		function check() {
			field.closest('.mrd-field').classList.toggle('is-filled', !!field.value);
		}
		field.addEventListener('input', check);
		field.addEventListener('blur', check);
		check();
	});

	/* ── ارسال فرم دمو — جلوگیری از ریلود + پیام فارسی ─────── */
	var form = M.qs('.mrd-form');
	if (form && form.getAttribute('action') === '#') {
		form.addEventListener('submit', function (e) {
			e.preventDefault();
			var btn = form.querySelector('.mrd-form__submit .mrd-btn__label');
			if (btn) {
				var original = btn.textContent;
				btn.textContent = 'پیام شما ارسال شد ✓';
				form.reset();
				setTimeout(function () { btn.textContent = original; }, 3500);
			}
		});
	}
});
