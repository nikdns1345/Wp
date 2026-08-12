/**
 * Module: parallax
 *  - [data-parallax="0.12"]  → پارالاکس عمودی ملایم (مقدار = شدت)
 *  - ظرف‌های .u-img-parallax : زوم داخلی تصویر هنگام عبور
 * فقط دسکتاپ — در موبایل خاموش تا اسکرول طبیعی و سریع بماند.
 */
MERIDIAN.register('parallax', function (M) {
	'use strict';

	if (!M.hasGSAP || !M.hasST || M.reduced || M.isTouch) return;

	/* پارالاکس عمومی */
	M.qsa('[data-parallax]').forEach(function (el) {
		if (!M.tag(el, 'parallax')) return;
		var amt = parseFloat(el.getAttribute('data-parallax')) || 0.12;
		var target = el.classList.contains('u-img-parallax') ? el.querySelector('img') : el;
		if (!target) return;

		gsap.fromTo(target,
			{ yPercent: -amt * 100 },
			{
				yPercent: amt * 100,
				ease: 'none',
				scrollTrigger: {
					trigger: el,
					start: 'top bottom',
					end: 'bottom top',
					scrub: true,
					invalidateOnRefresh: true
				}
			});
	});

	/* زوم تصویر در ظرف‌های پارالاکس */
	M.qsa('.u-img-parallax').forEach(function (el) {
		if (!M.tag(el, 'pzoom')) return;
		var img = el.querySelector('img');
		if (!img) return;
		gsap.fromTo(img, { scale: 1.22 }, {
			scale: 1.02,
			ease: 'none',
			scrollTrigger: {
				trigger: el,
				start: 'top bottom',
				end: 'bottom top',
				scrub: true,
				invalidateOnRefresh: true
			}
		});
	});
});
