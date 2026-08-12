/**
 * Module: counters
 * شمارشگرهای [data-counter] با اعداد فارسی.
 *
 *   <span data-counter data-counter-target="120" data-counter-suffix="+" data-counter-duration="2">۰</span>
 *
 *  - اعداد خروجی همیشه فارسی‌اند
 *  - بدون GSAP: مقدار نهایی بلافاصله نوشته می‌شود (Fallback)
 */
MERIDIAN.register('counters', function (M) {
	'use strict';

	M.qsa('[data-counter]').forEach(function (el) {
		if (!M.tag(el, 'counter')) return;

		var target = parseFloat(el.getAttribute('data-counter-target')) || 0;
		var decimals = parseInt(el.getAttribute('data-counter-decimals') || '0', 10);
		var duration = parseFloat(el.getAttribute('data-counter-duration')) || 2;

		function render(v) {
			el.textContent = M.fa(decimals ? v.toFixed(decimals) : Math.round(v));
		}

		// Fallback: بدون GSAP / reduced-motion / ادیتور → مقدار نهایی
		if (!M.hasGSAP || !M.hasST || M.reduced) { render(target); return; }

		var state = { v: 0 };
		ScrollTrigger.create({
			trigger: el,
			start: 'top 88%',
			once: true,
			onEnter: function () {
				gsap.to(state, {
					v: target,
					duration: duration,
					ease: 'power3.out',
					onUpdate: function () { render(state.v); },
					onComplete: function () { render(target); }
				});
			}
		});
	});
});
