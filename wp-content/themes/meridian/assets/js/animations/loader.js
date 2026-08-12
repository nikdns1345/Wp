/**
 * Module: loader
 * صفحه‌ی لودینگ — شمارنده‌ی فارسی ۰ تا ۱۰۰ + خروج پنل‌های عمودی.
 * بعد از اتمام، رویداد 'meridian:loaded' پخش می‌شود (نقطه‌ی شروع hero).
 */
MERIDIAN.register('loader', function (M) {
	'use strict';

	var loader = M.qs('[data-loader]');

	function finish() {
		if (loader) loader.remove();
		document.documentElement.classList.add('mrd-loaded');
		window.dispatchEvent(new Event('meridian:loaded'));
	}

	// بدون لودر، ادیتور المنتور، reduced-motion یا نبود GSAP → خروج فوری
	if (!loader || M.isEditor || M.reduced || !M.hasGSAP) {
		if (loader) loader.style.display = 'none';
		finish();
		return;
	}

	if (M.lenis) M.lenis.stop();

	var count = M.qs('[data-loader-count]', loader);
	var bar = M.qs('[data-loader-bar]', loader);
	var progress = { v: 0 };

	gsap.set('[data-hero-bg]', { autoAlpha: 0 });

	var tl = gsap.timeline({ onComplete: done });

	tl.to(progress, {
		v: 100,
		duration: 1.5,
		ease: 'power2.inOut',
		onUpdate: function () {
			if (count) count.textContent = M.fa(Math.round(progress.v));
			if (bar) bar.style.transform = 'scaleX(' + progress.v / 100 + ')';
		}
	})
	.to(loader.querySelector('.mrd-loader__center'), {
		y: -30, autoAlpha: 0, duration: 0.5, ease: 'power2.in'
	}, '+=0.1')
	.to(loader.querySelectorAll('.mrd-loader__panel'), {
		scaleY: 0,
		transformOrigin: 'top',
		duration: 0.85,
		ease: 'power4.inOut',
		stagger: 0.055
	}, '-=0.15');

	function done() {
		loader.style.display = 'none';
		document.documentElement.classList.add('mrd-loaded');
		if (M.lenis) M.lenis.start();
		window.dispatchEvent(new Event('meridian:loaded'));
		tl.kill();
	}
});
