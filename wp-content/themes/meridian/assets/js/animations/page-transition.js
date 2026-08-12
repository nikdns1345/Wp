/**
 * Module: page-transition
 * ترنزیشن بین صفحات داخلی — پنل‌های عمودی:
 *  - کلیک روی لینک داخلی → ورود پنل‌ها → navigate → در صفحه‌ی جدید لودر/اینترو
 *  - لینک‌های مدیریت/ادیتور/تب‌جدید/دانلود/انکر نادیده گرفته می‌شوند
 *  - bfcache (pageshow) ریست می‌شود تا صفحه گیر نکند
 * سریع و حرفه‌ای: حدود 0.7 ثانیه.
 */
MERIDIAN.register('page-transition', function (M) {
	'use strict';

	var layer = M.qs('.mrd-transition');
	if (!layer || M.isEditor || M.reduced || !M.hasGSAP) return;

	var panels = M.qsa('.mrd-transition__panel', layer);
	var transitioning = false;

	// ریست هنگام بازگشت از bfcache
	window.addEventListener('pageshow', function (e) {
		if (e.persisted) {
			transitioning = false;
			layer.classList.remove('is-active');
			gsap.set(panels, { scaleY: 0, transformOrigin: 'top' });
		}
	});

	function isInternal(url) {
		try {
			var u = new URL(url, window.location.href);
			return u.origin === window.location.origin
				&& u.pathname !== window.location.pathname
				&& !/^\/wp-(admin|login|includes)/.test(u.pathname)
				&& u.search.indexOf('elementor') === -1;
		} catch (err) { return false; }
	}

	document.addEventListener('click', function (e) {
		if (e.defaultPrevented || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || transitioning) return;
		var a = e.target.closest('a[href]');
		if (!a) return;
		var href = a.getAttribute('href');
		if (!href || href.charAt(0) === '#' || a.target === '_blank' || a.hasAttribute('download')) return;
		if (a.href.indexOf('mailto:') === 0 || a.href.indexOf('tel:') === 0) return;
		if (!isInternal(a.href)) return;

		e.preventDefault();
		transitioning = true;
		var dest = a.href;

		layer.classList.add('is-active');
		gsap.set(panels, { transformOrigin: 'bottom' });
		gsap.to(panels, {
			scaleY: 1,
			duration: 0.45,
			stagger: 0.055,
			ease: 'power3.inOut',
			onComplete: function () {
				setTimeout(function () { window.location.href = dest; }, 60);
			}
		});
	});
});
