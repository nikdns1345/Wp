/**
 * Module: motion-path
 * مسیر حرکتی سکشن فرآیند:
 *  - مسیر SVG سرپانتین به‌صورت داینامیک و واکنش‌گرا رسم می‌شود (از راست به چپ در RTL)
 *  - نقطه‌ی accent با MotionPathPlugin + ScrollTrigger (scrub) روی مسیر حرکت می‌کند
 *  - خط پیشرفت accent همراه اسکرول پر می‌شود (strokeDashoffset)
 *  - مراحل بر اساس progress فعال می‌شوند (.is-active)
 *  - در موبایل (<900px) مسیر حذف و مراحل به‌صورت لیست نمایش داده می‌شوند
 */
MERIDIAN.register('motion-path', function (M) {
	'use strict';

	var stage = M.qs('[data-process-stage]');
	if (!stage || !M.hasGSAP || !M.hasST || !window.MotionPathPlugin) return;

	var svg = M.qs('[data-process-svg]', stage);
	var line = M.qs('[data-process-line]', stage);
	var progressPath = M.qs('[data-process-progress]', stage);
	var dot = M.qs('[data-process-dot]', stage);
	var steps = M.qsa('[data-process-step]', stage);
	if (!svg || !line || !dot || !steps.length) return;

	var instances = null;

	function build() {
		// حذف نمونه‌های قبلی (rebuild واکنش‌گرا)
		destroy();

		if (window.innerWidth < 900 || M.reduced) {
			steps.forEach(function (s) { s.classList.add('is-active'); });
			return;
		}

		var w = stage.offsetWidth;
		var h = stage.offsetHeight;
		if (!w || !h) return;

		svg.setAttribute('viewBox', '0 0 ' + w + ' ' + h);

		// نقاط مسیر: ۵ ایستگاه از راست به چپ (RTL) — بالا/پایین متناوب
		var anchorsX = [0.90, 0.70, 0.50, 0.30, 0.10];
		if (!M.isRTL) anchorsX = anchorsX.map(function (x) { return 1 - x; });

		var pts = anchorsX.map(function (fx, i) {
			return {
				x: fx * w,
				y: (i % 2 === 0 ? 0.24 : 0.70) * h
			};
		});

		// منحنی Catmull-Rom → Bezier نرم از میان نقاط
		var dAttr = 'M ' + pts[0].x + ' ' + pts[0].y;
		for (var i = 0; i < pts.length - 1; i++) {
			var p0 = pts[Math.max(0, i - 1)];
			var p1 = pts[i];
			var p2 = pts[i + 1];
			var p3 = pts[Math.min(pts.length - 1, i + 2)];
			var c1x = p1.x + (p2.x - p0.x) / 6;
			var c1y = p1.y + (p2.y - p0.y) / 6;
			var c2x = p2.x - (p3.x - p1.x) / 6;
			var c2y = p2.y - (p3.y - p1.y) / 6;
			dAttr += ' C ' + c1x + ' ' + c1y + ', ' + c2x + ' ' + c2y + ', ' + p2.x + ' ' + p2.y;
		}

		line.setAttribute('d', dAttr);
		progressPath.setAttribute('d', dAttr);

		var len = line.getTotalLength();
		gsap.set(progressPath, { strokeDasharray: len, strokeDashoffset: len });

		var thresholds = [0.02, 0.24, 0.48, 0.72, 0.94];

		instances = [];
		instances.push(gsap.timeline({
			scrollTrigger: {
				trigger: stage,
				start: 'top 72%',
				end: 'bottom 30%',
				scrub: 1,
				invalidateOnRefresh: true,
				onUpdate: function (self) {
					steps.forEach(function (step, i) {
						step.classList.toggle('is-active', self.progress >= thresholds[i]);
					});
				}
			}
		})
		.to(dot, {
			motionPath: { path: line, align: line, alignOrigin: [0.5, 0.5] },
			ease: 'none',
			duration: 1
		}, 0)
		.to(progressPath, { strokeDashoffset: 0, ease: 'none', duration: 1 }, 0));
	}

	function destroy() {
		if (!instances) return;
		instances.forEach(function (tl) {
			if (tl.scrollTrigger) tl.scrollTrigger.kill();
			tl.kill();
		});
		instances = null;
		gsap.set(dot, { clearProps: 'all' });
	}

	// بازسازی هنگام رفرش ScrollTrigger (resize/فونت/محتوای داینامیک)
	var rebuild;
	ScrollTrigger.addEventListener('refreshInit', function () {
		clearTimeout(rebuild);
		rebuild = setTimeout(function () {
			requestAnimationFrame(build);
		}, 80);
	});

	build();
});
