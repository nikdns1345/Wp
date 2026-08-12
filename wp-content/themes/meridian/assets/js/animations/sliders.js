/**
 * Module: sliders
 * اسلایدر داخلی نظرات: [data-slider="testimonials"]
 *  - ترنزیشن fade+slide ظریف، دات‌ها، پیکان‌ها، autoplay با توقف هوشمند
 *  - اگر Revolution Slider در صفحه باشد (.rev_slider) این ماژول خودداری می‌کند
 *    تا تعارضی پیش نیاید — RS برای هیرو/شوکیس/نظرات قابل‌استفاده است.
 */
MERIDIAN.register('sliders', function (M) {
	'use strict';

	if (document.querySelector('.rev_slider')) return; // RS اولویت دارد

	M.qsa('[data-slider]').forEach(function (root) {
		if (!M.tag(root, 'slider')) return;

		var slides = M.qsa('[data-slide]', root);
		var prev = M.qs('[data-slider-prev]', root);
		var next = M.qs('[data-slider-next]', root);
		var dotsWrap = M.qs('[data-slider-dots]', root);
		if (slides.length < 2) return;

		var index = 0;
		var timer = null;
		var DELAY = 7000;

		// ساخت دات‌ها
		var dots = slides.map(function (_, i) {
			var b = document.createElement('button');
			b.type = 'button';
			b.setAttribute('role', 'tab');
			b.setAttribute('aria-label', 'نمایش نظر ' + M.fa(i + 1));
			if (i === 0) b.classList.add('is-active');
			b.addEventListener('click', function () { goTo(i, i > index); });
			if (dotsWrap) dotsWrap.appendChild(b);
			return b;
		});

		function goTo(i, forward) {
			if (i === index) return;
			var out = slides[index];
			var into = slides[i];
			var dirX = (forward === false ? -1 : 1) * (M.isRTL ? -40 : 40);
			index = i;

			dots.forEach(function (dt, k) { dt.classList.toggle('is-active', k === index); });

			if (M.hasGSAP && !M.reduced) {
				gsap.to(out, {
					autoAlpha: 0, x: -dirX, duration: 0.45, ease: 'power2.in',
					onComplete: function () { out.hidden = true; gsap.set(out, { clearProps: 'x' }); }
				});
				into.hidden = false;
				into.classList.add('is-active');
				gsap.fromTo(into,
					{ autoAlpha: 0, x: dirX },
					{ autoAlpha: 1, x: 0, duration: 0.7, ease: 'power3.out', delay: 0.15, clearProps: 'x' });
			} else {
				out.hidden = true;
				out.classList.remove('is-active');
				into.hidden = false;
				into.classList.add('is-active');
			}
		}

		function step(delta) { goTo((index + delta + slides.length) % slides.length, delta > 0); }

		if (prev) prev.addEventListener('click', function () { step(M.isRTL ? 1 : -1); restart(); });
		if (next) next.addEventListener('click', function () { step(M.isRTL ? -1 : 1); restart(); });

		function start() {
			if (M.reduced) return;
			stop();
			timer = setInterval(function () { step(1); }, DELAY);
		}
		function stop() { if (timer) clearInterval(timer); timer = null; }
		function restart() { start(); }

		root.addEventListener('mouseenter', stop);
		root.addEventListener('mouseleave', start);
		root.addEventListener('focusin', stop);
		root.addEventListener('focusout', start);

		// توقف وقتی سکشن در ویوپورت نیست (عملکرد)
		if ('IntersectionObserver' in window) {
			new IntersectionObserver(function (entries) {
				entries.forEach(function (en) { en.isIntersecting ? start() : stop(); });
			}, { threshold: 0.25 }).observe(root);
		} else {
			start();
		}
	});
});
