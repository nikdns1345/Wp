/**
 * Module: menu
 * منوی موبایل تمام‌صفحه:
 *  - بازشدن با clip-path از بالا + آیتم‌های پلکانی (stagger) با mask
 *  - قفل اسکرول (Lenis) + بستن با Escape + کلیک روی لینک → اسکرول نرم
 *  - مدیریت aria-expanded / aria-hidden برای دسترس‌پذیری
 */
MERIDIAN.register('menu', function (M) {
	'use strict';

	var toggle = M.qs('[data-menu-toggle]');
	var menu = M.qs('[data-menu]');
	if (!toggle || !menu || !M.tag(menu, 'menu')) return;

	var items = M.qsa('.mrd-menu__text', menu);
	var metas = M.qsa('[data-menu-meta]', menu);
	var isOpen = false;
	var tl = null;

	function buildTimeline() {
		if (!M.hasGSAP || M.reduced) return null;
		var t = gsap.timeline({ paused: true });
		t.set(menu, { visibility: 'visible' })
			.to(menu.querySelector('.mrd-menu__bg'), {
				clipPath: 'inset(0% 0 0% 0)',
				duration: 0.7,
				ease: 'power4.inOut'
			})
			.from(items, {
				yPercent: 120,
				duration: 0.8,
				stagger: 0.07,
				ease: 'power4.out'
			}, '-=0.25')
			.from(metas, {
				y: 24, autoAlpha: 0, duration: 0.5, stagger: 0.08
			}, '-=0.5');
		t.eventCallback('onReverseComplete', function () {
			gsap.set(menu, { visibility: 'hidden' });
		});
		return t;
	}

	function open() {
		isOpen = true;
		toggle.setAttribute('aria-expanded', 'true');
		toggle.setAttribute('aria-label', 'بستن منو');
		menu.setAttribute('aria-hidden', 'false');
		document.body.classList.add('mrd-menu-open');
		if (M.lenis) M.lenis.stop();
		if (tl) { tl.timeScale(1).play(); }
		else {
			menu.classList.add('is-open');
			menu.querySelector('.mrd-menu__bg').style.clipPath = 'inset(0 0 0 0)';
		}
		var first = menu.querySelector('a');
		if (first) first.focus({ preventScroll: true });
	}

	function close() {
		isOpen = false;
		toggle.setAttribute('aria-expanded', 'false');
		toggle.setAttribute('aria-label', 'باز کردن منو');
		menu.setAttribute('aria-hidden', 'true');
		document.body.classList.remove('mrd-menu-open');
		if (M.lenis) M.lenis.start();
		if (tl) { tl.timeScale(1.4).reverse(); }
		else {
			menu.classList.remove('is-open');
			menu.querySelector('.mrd-menu__bg').style.clipPath = 'inset(0 0 100% 0)';
		}
		toggle.focus({ preventScroll: true });
	}

	toggle.addEventListener('click', function () { isOpen ? close() : open(); });
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && isOpen) close();
	});
	menu.addEventListener('click', function (e) {
		if (e.target.closest('a[href^="#"]')) {
			var href = e.target.closest('a[href^="#"]').getAttribute('href');
			close();
			setTimeout(function () { M.scrollTo(href); }, M.reduced ? 0 : 500);
		}
	});

	tl = buildTimeline();
});
