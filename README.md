<div dir="rtl">

# مِریدین (Meridian) — قالب پرمیوم شرکتی وردپرس + المنتور

قالب شرکتی **ماستر/قابل‌استفاده‌مجدد** برای وردپرس و المنتور پرو؛ فارسی، راست‌به‌چپ، با فونت **وزیرمتن**،
سیستم دیزاین مینیمال، انیمیشن‌های سینمایی GSAP و معماری ماژولار.

> هدف: خروجی‌ای در سطح سایت‌های Awwwards / CSSDA — نه یک «قالب آماده‌ی وردپرسی» معمولی.

---

## ✨ ویژگی‌ها

- **فارسی و RTL کامل** — فونت وزیرمتن (فایل محلی، بدون وابستگی به CDN) + اعداد فارسی در شمارشگرها
- **سیستم دیزاین توکن‌محور** — تغییر رنگ سازمانی (Accent)، تایپوگرافی، فواصل و شعاع‌ها فقط از یک فایل: `tokens.css`
- **۱۵ سکشن کامل شرکتی** — Header، Hero، About، آمار، خدمات، پروژه‌ها، صنایع، فرآیند (Motion Path)، کیس‌استادی افقی، نظرات، تیم، شرکا، CTA، تماس، Footer
- **۱۲ ماژول انیمیشن مستقل** در `assets/js/animations/` — با gaurd در برابر اجرای تکراری، Fallback بدون GSAP، و پشتیبانی `prefers-reduced-motion`
- **سازگار با المنتور** — API انیمیشن با Attribute (`data-mrd`، `data-counter`، `data-parallax`…) روی هر ویجت/کانتینر المنتور کار می‌کند؛ Locationهای Theme Builder ثبت شده‌اند
- **عملکرد** — Lenis smooth scroll، انیمیشن‌های GPU-محور (transform/opacity)، lazy-load، cleanup، غیرفعال‌شدن افکت‌های سنگین در موبایل/ادیتور
- **دسترس‌پذیری و سئو** — HTML سمانتیک، skip-link، focus-visible، aria-label، سلسله‌مراتب صحیح هدینگ‌ها

## 📁 ساختار مخزن

```
Wp/
├── docs/                          # مستندات (دیزاین‌سیستم، انیمیشن، راهنمای المنتور)
│   ├── DESIGN-SYSTEM.md
│   ├── ANIMATION-ARCHITECTURE.md
│   └── ELEMENTOR-GUIDE.md
├── elementor/
│   └── kit-settings.json          # رنگ‌ها/تایپوگرافی سراسری برای ایمپورت در Site Settings
└── wp-content/themes/meridian/    # ← قالب اصلی
    ├── style.css                  # هدر قالب وردپرس
    ├── functions.php
    ├── front-page.php             # صفحه‌ی اصلی دمو (۱۵ سکشن)
    ├── header.php / footer.php / index.php / page.php / single.php
    ├── inc/                       # setup – enqueue – elementor – helpers
    ├── template-parts/
    │   ├── preloader.php
    │   └── sections/              # هر سکشن = یک فایل مستقل قابل‌ویرایش
    └── assets/
        ├── css/  (tokens, base, components, sections)
        ├── js/   (app.js + animations/*)
        ├── fonts/ (Vazirmatn variable woff2)
        └── img/
```

## 🚀 نصب

1. پوشه‌ی `wp-content/themes/meridian` را در همین مسیر روی هاست کپی و قالب را فعال کنید.
2. **Elementor + Elementor Pro** را نصب/فعال کنید (برای Theme Builder و فرم‌ها).
3. **بیلد دمو:** یک برگه بسازید، قالب «صفحه‌ی اصلی (دمو)» یا همان `front-page.php` را از مسیر  
   تنظیمات ← خواندن ← «صفحه‌ی اصلی» انتخاب کنید.
4. رنگ Accent را فقط در یک نقطه عوض کنید:  
   `assets/css/tokens.css` ← متغیر `--c-accent` (+ همان مقدار در Site Settings المنتور — راهنما در `docs/ELEMENTOR-GUIDE.md`).

## 🧩 ویرایش محتوا بدون کدنویسی

تمام محتوای دمو با Placeholderهای مشخص مثل `[نام شرکت]`، `[شعار شرکت]`، `[تلفن]`، `[ایمیل]` پر شده است.
دو مسیر برای ویرایش:

1. **سریع:** فایل `template-parts/sections/*.php` — آرایه‌ی محتوای ابتدای هر فایل، با کامنت راهنما.
2. **کاملاً بصری (پیشنهادی):** سکشن‌ها را در المنتور با Flexbox Container بازسازی/کپی کنید و از **API انیمیشن با Attribute** استفاده کنید (Advanced ← Attributes):

| Attribute | نمونه | نتیجه |
|---|---|---|
| `data-mrd="fade-up"` | `data-mrd-delay="0.2"` | ورود نرم از پایین هنگام اسکرول |
| `data-mrd="clip-up"` | — | ریویل با ماسک |
| `data-split="lines"` | — | ریویل خط‌به‌خط تیتر |
| `data-counter` | `data-counter-target="120" data-counter-suffix="+"` | شمارشگر فارسی |
| `data-parallax="0.15"` | — | پارالاکس تصویر |
| `data-magnetic="0.4"` | — | دکمه‌ی مغناطیسی |
| `data-cursor="مشاهده"` | — | لیبل کرسر سفارشی |

جزئیات کامل: [`docs/ANIMATION-ARCHITECTURE.md`](docs/ANIMATION-ARCHITECTURE.md)  
راهنمای ساخت سکشن‌ها در المنتور: [`docs/ELEMENTOR-GUIDE.md`](docs/ELEMENTOR-GUIDE.md)

## 🛠 پیش‌نیازها

- WordPress 6.0+ و PHP 8.0+
- Elementor + Elementor Pro (اختیاری ولی توصیه‌شده برای Locations/Forms)
- GSAP/ScrollTrigger/MotionPath/Lenis به‌صورت **محلی** از `assets/js/vendor/` لود می‌شوند (اگر فایل‌ها حذف شوند، خودکار به CDN سوئیچ می‌شود).
- بدون کتابخانه‌ها هم سایت **کامل و تمیز** نمایش داده می‌شود (Graceful Fallback).
- **Revolution Slider** اختیاری است؛ اگر اسلایدر RS در صفحه باشد ماژول اسلایدر داخلی به‌صورت خودکار کنار می‌رود.

---

## 🧱 قالب‌های آماده‌ی المنتور (`elementor/templates/`)

نسخه‌ی 1.1 به بعد، علاوه‌بر قالب PHP، **قالب‌های قابل‌ایمپورت المنتور** هم دارد —
که دقیقاً با همان کلاس‌ها/دیتا-اتریبیوت‌های تم ساخته شده‌اند تا CSS و انیمیشن‌های GSAP بدون هیچ تغییری کار کنند:

| فایل | نوع | توضیح |
|---|---|---|
| `home-page.json` | صفحه‌ی کامل | هر ۱۱ سکشن پشت‌سرهم — یک‌باره ایمپورت کنید |
| `hero.json` … `contact.json` | سکشن‌های مستقل | ۱۱ سکشن جداگانه برای استفاده‌ی مجدد در هر صفحه |

**نحوه‌ی ایمپورت:**
1. پیشخوان ← المنتور ← قالب‌های من ← **Import Templates** ← `home-page.json` (یا سکشن‌های مستقل)
2. یک برگه‌ی جدید بسازید ← ویرایش با المنتور ← از کتابخانه، قالب را وارد کنید ← قالب برگه را «Canvas» یا «Full Width» کنید
3. رنگ‌ها/تایپوگرافی سراسری: Site Settings ← مقادیر `elementor/kit-settings.json`
4. متن‌ها داخل ویجت‌های Heading/Text به‌صورت نیتیو و ساختارها داخل ویجت HTML قابل‌ویرایش‌اند

تولید مجدد قالب‌ها بعد از تغییرات:
```bash
python3 tools/generate-elementor-templates.py
```

## 👁 پیش‌نمایش بدون وردپرس (`preview/`)

برای دیدن خروجی واقعی قالب + انیمیشن‌ها بدون نصب وردپرس:
```bash
php -S 0.0.0.0:8080 -t . preview/router.php
# → http://localhost:8080
```
این پیش‌نمایش با «استاب» کردن توابع وردپرس، دقیقاً همان `front-page.php` قالب را رندر می‌کند.

## 📄 قالب‌های تکمیلی وردپرس

`404.php`، `archive.php`، `search.php`، `searchform.php` و `comments.php` با همان دیزاین‌سیستم — برای کامل‌بودن قالب به‌عنوان ماستر تم.

---

**English summary:** Meridian is a reusable, RTL-first Persian corporate master template for WordPress + Elementor Pro — token-based design system (Vazirmatn font, one global accent color), 15 premium sections, modular GSAP animation layer with safe init/fallbacks/reduced-motion, and an attribute-driven animation API that works on any Elementor widget. See `docs/` for the design system, animation architecture and Elementor guide.

</div>
