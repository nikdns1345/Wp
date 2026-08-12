/**
 * Module: text-reveal
 * اسپلیت خط‌به‌خط برای [data-split="lines"] و [data-split-line].
 *  - متن به کلمات شکسته و با سنجش offsetTop به خطوط واقعی گروه‌بندی می‌شود
 *    (سازگار با RTL و فونت فارسی)
 *  - هر خط داخل mask با overflow:hidden قرار می‌گیرد و با ScrollTrigger
 *    به‌صورت cascade بالا می‌آید
 *  - در ادیتور المنتور اجرا نمی‌شود تا متن قابل‌ویرایش بماند
 */
MERIDIAN.register('text-reveal', function (M) {
	'use strict';

	if (!M.hasGSAP || !M.hasST || M.isEditor || M.reduced) return;

	function splitToLines(el) {
		var original = el.textContent.trim();
		if (!original) return [];

		el.setAttribute('aria-label', original); // دسترس‌پذیری
		el.textContent = '';

		var words = original.split(/\s+/);
		var spans = words.map(function (w) {
			var s = document.createElement('span');
			s.textContent = w;
			s.className = 'mrd-w';
			s.setAttribute('aria-hidden', 'true');
			s.style.display = 'inline-block';
			return s;
		});

		spans.forEach(function (s, i) {
			el.appendChild(s);
			if (i < spans.length - 1) el.appendChild(document.createTextNode(' '));
		});

		// گروه‌بندی کلمات بر اساس موقعیت عمودی واقعی
		var lines = [];
		var current = [];
		var lastTop = null;
		spans.forEach(function (s) {
			var t = s.offsetTop;
			if (lastTop === null || Math.abs(t - lastTop) < 3) {
				current.push(s);
			} else {
				lines.push(current); current = [s];
			}
			lastTop = t;
		});
		if (current.length) lines.push(current);

		// بازسازی DOM: هر خط داخل mask
		el.textContent = '';
		var lineInners = lines.map(function (lineWords) {
			var mask = document.createElement('span');
			mask.className = 'mrd-line-mask';
			mask.setAttribute('aria-hidden', 'true');
			var inner = document.createElement('span');
			inner.className = 'mrd-line-inner';
			inner.textContent = lineWords.map(function (s) { return s.textContent; }).join(' ');
			mask.appendChild(inner);
			el.appendChild(mask);
			return inner;
		});

		return lineInners;
	}

	function init() {
		M.qsa('[data-split="lines"]').forEach(function (el) {
			if (!M.tag(el, 'split')) return;
			var inners = splitToLines(el);
			if (!inners.length) return;

			gsap.from(inners, {
				yPercent: 112,
				duration: 1.05,
				stagger: parseFloat(el.getAttribute('data-split-stagger')) || 0.1,
				delay: parseFloat(el.getAttribute('data-split-delay')) || 0,
				ease: 'power4.out',
				scrollTrigger: { trigger: el, start: 'top 88%', once: true },
				onComplete: function () {
					// پس‌از ریویل، متن به حالت طبیعی برگردد تا سلکت/هایلایت درست کار کند
					gsap.set(inners, { clearProps: 'transform' });
				}
			});
		});

		// خطوط آماده (مارک باز) مثل statement
		var prepared = M.qsa('[data-split-line] > span');
		if (prepared.length) {
			var first = prepared[0].closest('[data-statement]') || prepared[0].parentElement;
			if (M.tag(first, 'splitline')) {
				gsap.from(prepared, {
					yPercent: 112,
					duration: 1.15,
					stagger: 0.12,
					ease: 'power4.out',
					scrollTrigger: { trigger: first, start: 'top 82%', once: true }
				});
			}
		}
	}

	// بعد از آماده‌شدن فونت اجرا شود تا شکست خط درست محاسبه شود
	if (document.fonts && document.fonts.ready) {
		document.fonts.ready.then(function () { setTimeout(init, 50); });
	} else {
		init();
	}
});
