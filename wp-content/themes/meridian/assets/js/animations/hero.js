/**
 * Module: hero
 * تایم‌لاین سینمایی ورود Hero — بعد از لودر اجرا می‌شود:
 *  1. پس‌زمینه   2. هدر/لوگو   3. eyebrow   4. تیتر خط‌به‌خط
 *  5. توضیح      6. دکمه‌ها    7. ویژوال    8/9. نشانگر اسکرول
 * سپس: شناورشدن آرام ویژوال + پارالاکس هنگام اسکرول.
 */
MERIDIAN.register('hero', function (M) {
	'use strict';

	var hero = M.qs('[data-hero]');
	if (!hero || !M.hasGSAP || M.isEditor) return;

	var lines = M.qsa('.mrd-hero__line-inner', hero);
	var visual = M.qs('[data-hero-visual]', hero);
	var orb = M.qs('[data-hero-orb]', hero);
	var tag = M.qs('[data-hero-tag]', hero);

	if (M.reduced) { return; } // محتوا بدون JS نیز قابل‌مشاهده است

	function intro() {
		if (!M.tag(hero)) return;

		var tl = gsap.timeline({ defaults: { ease: 'power4.out' } });

		// 1) پس‌زمینه
		tl.fromTo('[data-hero-bg]',
			{ autoAlpha: 0, scale: 1.06 },
			{ autoAlpha: 1, scale: 1, duration: 1.2, ease: 'power2.out' });

		// 2) هدر
		tl.from('[data-header]', { y: -24, autoAlpha: 0, duration: 0.8, clearProps: 'all' }, '-=0.85');

		// 3) Eyebrow
		tl.from('[data-hero-eyebrow]', { y: 26, autoAlpha: 0, duration: 0.7 }, '-=0.55');

		// 4) تیتر — خط‌به‌خط (mask reveal)
		tl.from(lines, { yPercent: 110, duration: 1.1, stagger: 0.14 }, '-=0.45');

		// 5) توضیح
		tl.from('[data-hero-desc]', { y: 28, autoAlpha: 0, duration: 0.8 }, '-=0.65');

		// 6) دکمه‌ها
		tl.from(M.qsa('[data-hero-actions] > *', hero), {
			y: 26, autoAlpha: 0, duration: 0.7, stagger: 0.1
		}, '-=0.55');

		// 7) ویژوال — ریویل با clip + مقیاس
		if (visual) {
			tl.fromTo(visual,
				{ clipPath: 'inset(12% 12% 12% 12% round 12px)', scale: 1.06, autoAlpha: 0 },
				{ clipPath: 'inset(0% 0% 0% 0% round 12px)', scale: 1, autoAlpha: 1, duration: 1.25, ease: 'power3.inOut' },
				'-=1.0');
		}
		if (orb) tl.from(orb, { scale: 0, autoAlpha: 0, duration: 0.9, ease: 'back.out(1.8)' }, '-=0.7');
		if (tag) tl.from(tag, { y: -18, autoAlpha: 0, duration: 0.7 }, '-=0.6');

		// 8/9) نشانگر اسکرول
		tl.from('[data-hero-scroll]', { autoAlpha: 0, y: 14, duration: 0.7 }, '-=0.4');

		// ── حلقه‌های حرکتی آرام (بعد از اینترو) ──
		tl.add(function () {
			if (orb) gsap.to(orb, { y: 22, duration: 3.4, ease: 'sine.inOut', repeat: -1, yoyo: true });
			if (tag) gsap.to(tag, { y: -12, duration: 3, ease: 'sine.inOut', repeat: -1, yoyo: true, delay: 0.4 });
			if (visual) gsap.to(visual, { y: 14, duration: 4.2, ease: 'sine.inOut', repeat: -1, yoyo: true });
		});

		// ── پارالاکس خروج هنگام اسکرول ──
		if (M.hasST) {
			gsap.to('.mrd-hero__content', {
				yPercent: -8, autoAlpha: 0.25, ease: 'none',
				scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: true }
			});
			if (visual) {
				gsap.to(visual, {
					yPercent: 10, ease: 'none',
					scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: true }
				});
			}
		}
	}

	M.onReady(intro);
});
