/**
 * Module: scroll
 *  - ریویلهای عمومی با Attribute:  data-mrd / data-mrd-group
 *  - وضعیت هدر هنگام اسکرول + مخفی/نمایش هوشمند
 *  - اسکرول افقی سکشن کیس‌استادی (فقط دسکتاپ، RTL-aware)
 *  - نمایش دکمه‌ی بازگشت به بالا
 *
 * مقادیر data-mrd:
 *  fade-up | fade-down | fade-left | fade-right | fade | scale | clip-up | img-reveal
 * آپشن‌ها: data-mrd-delay="0.2" data-mrd-duration="1" data-mrd-start="top 85%"
 */
MERIDIAN.register('scroll', function (M) {
	'use strict';

	if (!M.hasGSAP || !M.hasST) return;

	var dir = M.isRTL ? -1 : 1;

	/* ── نقشه‌ی انیمیشن‌ها ─────────────────────────────────── */
	var variants = {
		'fade-up':    { from: { y: 46, autoAlpha: 0 } },
		'fade-down':  { from: { y: -46, autoAlpha: 0 } },
		'fade-left':  { from: { x: 56 * dir, autoAlpha: 0 } },
		'fade-right': { from: { x: -56 * dir, autoAlpha: 0 } },
		'fade':       { from: { autoAlpha: 0 } },
		'scale':      { from: { scale: 0.86, autoAlpha: 0 } },
		'clip-up':    { from: { clipPath: 'inset(100% 0 0 0)', y: 24 } },
		'img-reveal': { from: { clipPath: 'inset(0 0 100% 0)', scale: 1.04 } }
	};

	/* ── ریویل تکی ─────────────────────────────────────────── */
	M.qsa('[data-mrd]').forEach(function (el) {
		if (!M.tag(el, 'mrd')) return;
		var type = el.getAttribute('data-mrd') || 'fade-up';
		var conf = variants[type] || variants['fade-up'];

		if (M.reduced) { return; } // المان همین‌حالا در حالت نهایی دیده می‌شود

		var vars = {
			duration: parseFloat(el.getAttribute('data-mrd-duration')) || 0.95,
			delay: parseFloat(el.getAttribute('data-mrd-delay')) || 0,
			ease: 'power3.out',
			clearProps: 'transform,opacity,visibility,clipPath',
			scrollTrigger: {
				trigger: el,
				start: el.getAttribute('data-mrd-start') || 'top 86%',
				once: true
			}
		};
		gsap.fromTo(el, conf.from, vars);
	});

	/* ── ریویل گروهی (ستagger) ─────────────────────────────── */
	M.qsa('[data-mrd-group]').forEach(function (group) {
		if (!M.tag(group, 'mrdgroup')) return;
		var children = Array.prototype.filter.call(group.children, function (c) { return c.nodeType === 1; });
		if (!children.length || M.reduced) return;

		gsap.fromTo(children,
			{ y: 44, autoAlpha: 0 },
			{
				y: 0, autoAlpha: 1,
				duration: 0.9,
				stagger: parseFloat(group.getAttribute('data-mrd-stagger')) || 0.09,
				ease: 'power3.out',
				clearProps: 'transform,opacity,visibility',
				scrollTrigger: { trigger: group, start: 'top 84%', once: true }
			});
	});

	/* ── هدر: تغییر پس‌زمینه + مخفی هوشمند ────────────────── */
	var header = M.qs('[data-header]');
	if (header && M.tag(header, 'header')) {
		var lastY = 0;
		ScrollTrigger.create({
			start: 30,
			onUpdate: function (self) {
				var y = self.scroll();
				header.classList.toggle('is-scrolled', y > 40);
				// مخفی‌شدن به سمت پایین + بازگشت به سمت بالا (فقط دسکتاپ)
				if (!M.isTouch) {
					var goingDown = y > lastY && y > 400;
					header.classList.toggle('is-hidden', goingDown && !document.body.classList.contains('mrd-menu-open'));
					lastY = y;
				}
			}
		});
	}

	/* ── اسکرول افقی کیس‌استادی ────────────────────────────── */
	var horizontal = M.qs('[data-horizontal]');
	if (horizontal && !M.reduced) {
		var track = M.qs('[data-horizontal-track]', horizontal);
		var progress = M.qs('[data-horizontal-progress]', horizontal);

		var mm = gsap.matchMedia();
		mm.add('(min-width: 900px)', function () {
			var getAmount = function () {
				return Math.max(0, track.scrollWidth - horizontal.clientWidth);
			};
			var tween = gsap.to(track, {
				x: function () { return getAmount() * dir; },
				ease: 'none',
				scrollTrigger: {
					trigger: horizontal,
					start: 'top top',
					end: function () { return '+=' + getAmount(); },
					pin: true,
					scrub: 1,
					anticipatePin: 1,
					invalidateOnRefresh: true,
					onUpdate: function (self) {
						if (progress) progress.style.transform = 'scaleX(' + self.progress + ')';
					}
				}
			});
			return function () { // cleanup هنگام تغییر breakpoint
				if (tween.scrollTrigger) tween.scrollTrigger.kill();
				tween.kill();
				gsap.set(track, { clearProps: 'all' });
			};
		});
	}

	/* ── دکمه‌ی بازگشت به بالا ─────────────────────────────── */
	var toTop = M.qs('[data-to-top]');
	if (toTop && M.tag(toTop, 'totop')) {
		ScrollTrigger.create({
			start: 600,
			onEnter: function () { toTop.classList.add('is-visible'); },
			onLeaveBack: function () { toTop.classList.remove('is-visible'); }
		});
		toTop.addEventListener('click', function () {
			if (M.lenis) M.lenis.scrollTo(0, { duration: 1.4 });
			else window.scrollTo({ top: 0, behavior: M.reduced ? 'auto' : 'smooth' });
		});
	}
});
