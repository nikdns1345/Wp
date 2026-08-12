/**
 * Module: cursor
 * کرسر سفارشی: نقطه + حلقه + لیبل متنی.
 *  - نقطه دقیق، حلقه با تاخیر (lerp) — حسی نرم و لوکس
 *  - hover روی لینک/دکمه: بزرگ‌شدن حلقه
 *  - المان‌های [data-cursor="متن"]: حلقه تیره + لیبل فارسی
 * فقط روی pointer دقیق فعال است؛ در موبایل/ادیتور/reduced-motion خاموش.
 */
MERIDIAN.register('cursor', function (M) {
	'use strict';

	if (!M.hasGSAP || M.reduced || M.isTouch || M.isEditor) return;

	var cursor = M.qs('.mrd-cursor');
	if (!cursor || !M.tag(cursor, 'cursor')) return;

	var dot = cursor.querySelector('.mrd-cursor__dot');
	var ring = cursor.querySelector('.mrd-cursor__ring');
	var label = cursor.querySelector('.mrd-cursor__label');

	document.documentElement.classList.add('mrd-cursor-on');

	gsap.set([dot, ring, label], { xPercent: 0, yPercent: 0 });

	var dotX = gsap.quickTo(dot, 'x', { duration: 0.12, ease: 'power2.out' });
	var dotY = gsap.quickTo(dot, 'y', { duration: 0.12, ease: 'power2.out' });
	var ringX = gsap.quickTo(ring, 'x', { duration: 0.45, ease: 'power3.out' });
	var ringY = gsap.quickTo(ring, 'y', { duration: 0.45, ease: 'power3.out' });
	var labelX = gsap.quickTo(label, 'x', { duration: 0.4, ease: 'power3.out' });
	var labelY = gsap.quickTo(label, 'y', { duration: 0.4, ease: 'power3.out' });

	// موقعیت اولیه — وسط صفحه تا ناگهانی ظاهر نشود
	gsap.set([dot, ring, label], { x: window.innerWidth / 2, y: window.innerHeight / 2 });

	window.addEventListener('mousemove', function (e) {
		dotX(e.clientX); dotY(e.clientY);
		ringX(e.clientX); ringY(e.clientY);
		labelX(e.clientX); labelY(e.clientY);
	}, { passive: true });

	// حالت hover روی تعاملی‌ها
	var hoverSel = 'a, button, [role="button"], input, textarea, .mrd-service, .mrd-industry';
	document.addEventListener('mouseover', function (e) {
		if (e.target.closest(hoverSel)) cursor.classList.add('is-hover');
		var holder = e.target.closest('[data-cursor]');
		if (holder) {
			label.textContent = holder.getAttribute('data-cursor');
			cursor.classList.add('has-label');
		}
	}, { passive: true });

	document.addEventListener('mouseout', function (e) {
		if (e.target.closest(hoverSel)) cursor.classList.remove('is-hover');
		if (e.target.closest('[data-cursor]')) cursor.classList.remove('has-label');
	}, { passive: true });
});
