/**
 * MERIDIAN Core — Orchestrator
 * ------------------------------------------------------------
 * نقطه‌ی ورود معماری انیمیشن. تمام ماژول‌ها با MERIDIAN.register
 * ثبت می‌شوند و این فایل آن‌ها را امن و یک‌بار اجرا می‌کند.
 *
 * قواعد:
 *  - بدون GSAP: کلاس mrd-no-gsap روی <html> و محتوای کامل قابل‌مشاهده
 *  - prefers-reduced-motion: همه‌ی انیمیشن‌ها رد می‌شوند
 *  - ادیتور المنتور: ماژول‌های سنگین (لودر/ترنزیشن/کرسر/پین) غیرفعال
 *  - جلوگیری از init تکراری با پِرچم روی المان‌ها
 */
(function () {
	'use strict';

	var d = document;
	var w = window;

	var Core = {
		modules: {},
		lenis: null,
		booted: false,

		isRTL: (d.documentElement.dir || 'rtl') === 'rtl',
		reduced: w.matchMedia('(prefers-reduced-motion: reduce)').matches,
		isTouch: w.matchMedia('(hover: none), (pointer: coarse)').matches,
		isEditor: !!(w.elementorFrontend && w.elementorFrontend.isEditMode && w.elementorFrontend.isEditMode())
			|| d.body.classList.contains('elementor-editor-active')
			|| d.body.classList.contains('mrd-in-editor'),
		hasGSAP: !!w.gsap,
		hasST: !!w.ScrollTrigger,

		/** ثبت ماژول */
		register: function (name, init) { this.modules[name] = init; },

		/** تبدیل ارقام لاتین به فارسی */
		fa: function (n) { return String(n).replace(/\d/g, function (c) { return '۰۱۲۳۴۵۶۷۸۹'[c]; }); },

		/** init یک‌باره روی یک المان */
		tag: function (el, key) {
			if (!el) return false;
			var k = 'mrd' + (key || 'init');
			if (el.dataset[k]) return false;
			el.dataset[k] = '1';
			return true;
		},

		qs: function (s, c) { return (c || d).querySelector(s); },
		qsa: function (s, c) { return Array.prototype.slice.call((c || d).querySelectorAll(s)); },

		/** افزودن کلاس‌های وضعیت */
		boot: function () {
			if (this.booted) return;
			this.booted = true;

			if (this.hasGSAP) {
				gsap.registerPlugin.apply(gsap, [w.ScrollTrigger, w.MotionPathPlugin].filter(Boolean));
				gsap.defaults({ ease: 'power3.out', duration: 0.9 });
			} else {
				d.documentElement.classList.add('mrd-no-gsap');
			}
			if (this.reduced) d.documentElement.classList.add('mrd-reduced');

			this.initLenis();
			this.bindAnchors();

			var self = this;
			Object.keys(this.modules).forEach(function (name) {
				try { self.modules[name](Core); }
				catch (err) { if (w.console) console.error('[Meridian] ماژول «' + name + '» با خطا متوقف شد:', err); }
			});

			// رفرش ScrollTrigger بعد از لود کامل و آماده‌شدن فونت‌ها
			w.addEventListener('load', function () { setTimeout(function () { self.refresh(); }, 400); });
			if (d.fonts && d.fonts.ready) d.fonts.ready.then(function () { self.refresh(); });
		},

		refresh: function () { if (this.hasST) ScrollTrigger.refresh(); },

		/** Lenis smooth scroll + اتصال به ScrollTrigger */
		initLenis: function () {
			if (this.reduced || this.isEditor || !w.Lenis) return;
			this.lenis = new Lenis({ duration: 1.15, smoothWheel: true });
			d.documentElement.classList.add('has-lenis');
			if (this.hasGSAP) {
				var lenis = this.lenis;
				if (this.hasST) lenis.on('scroll', ScrollTrigger.update);
				gsap.ticker.add(function (time) { lenis.raf(time * 1000); });
				gsap.ticker.lagSmoothing(0);
			}
		},

		/** اسکرول نرم به انکرها (#section) */
		scrollTo: function (target, offset) {
			var el = typeof target === 'string' ? this.qs(target) : target;
			if (!el) return;
			if (this.lenis) {
				this.lenis.scrollTo(el, { offset: -(offset || 72), duration: 1.4 });
			} else {
				el.scrollIntoView({ behavior: this.reduced ? 'auto' : 'smooth' });
			}
		},

		bindAnchors: function () {
			var self = this;
			d.addEventListener('click', function (e) {
				var a = e.target.closest('a[href^="#"]');
				if (!a) return;
				var id = a.getAttribute('href');
				if (id.length < 2 || !self.qs(id)) return;
				e.preventDefault();
				self.scrollTo(id);
			});
		},

		/** اجرای callback وقتی لودر تمام شد (یا فوراً اگر لودری نیست) */
		onReady: function (cb) {
			if (d.documentElement.classList.contains('mrd-loaded') || !this.qs('[data-loader]') || this.isEditor) {
				cb(); return;
			}
			w.addEventListener('meridian:loaded', cb, { once: true });
		}
	};

	w.MERIDIAN = Core;

	if (d.readyState !== 'loading') { Core.boot(); }
	else { d.addEventListener('DOMContentLoaded', function () { Core.boot(); }); }

	/* المنتور: بعد از init فرانت‌اند، اگر صفحه با AJAX/پاپ‌آپ تغییر کرد،
	ScrollTrigger رفرش شود. هیچ ماژولی دوباره ثبت نمی‌شود. */
	if (w.jQuery) {
		jQuery(w).on('elementor/frontend/init', function () {
			setTimeout(function () { Core.refresh(); }, 600);
		});
	}
})();
