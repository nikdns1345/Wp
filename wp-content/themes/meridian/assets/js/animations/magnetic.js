/**
 * Module: magnetic
 * دکمه‌های مغناطیسی: [data-magnetic="0.4"] (مقدار = شدت جذب)
 * فقط روی اشاره‌گر دقیق (ماوس/ترک‌پد) فعال است.
 */
MERIDIAN.register('magnetic', function (M) {
	'use strict';

	if (!M.hasGSAP || M.reduced || M.isTouch) return;

	M.qsa('[data-magnetic]').forEach(function (el) {
		if (!M.tag(el, 'magnetic')) return;
		var strength = parseFloat(el.getAttribute('data-magnetic')) || 0.4;
		var label = el.querySelector('.mrd-btn__label');

		var xTo = gsap.quickTo(el, 'x', { duration: 0.4, ease: 'power3.out' });
		var yTo = gsap.quickTo(el, 'y', { duration: 0.4, ease: 'power3.out' });
		var lxTo = label ? gsap.quickTo(label, 'x', { duration: 0.45, ease: 'power3.out' }) : null;
		var lyTo = label ? gsap.quickTo(label, 'y', { duration: 0.45, ease: 'power3.out' }) : null;

		el.addEventListener('mousemove', function (e) {
			var r = el.getBoundingClientRect();
			var relX = e.clientX - (r.left + r.width / 2);
			var relY = e.clientY - (r.top + r.height / 2);
			xTo(relX * strength);
			yTo(relY * strength);
			if (lxTo) { lxTo(relX * strength * 0.35); lyTo(relY * strength * 0.35); }
		});

		el.addEventListener('mouseleave', function () {
			xTo(0); yTo(0);
			if (lxTo) { lxTo(0); lyTo(0); }
		});
	});
});
