# تغییرات (Changelog)

## [1.1.0] — ۱۴۰۵/۰۵/۲۲

### افزوده‌ها
- **۱۱ قالب سکشن قابل‌ایمپورت المنتور** + یک صفحه‌ی کامل (`elementor/templates/*.json`) — ساخته‌شده با همان کلاس‌ها/دیتا-اتریبیوت‌های تم؛ CSS و انیمیشن‌های GSAP بدون تغییر روی خروجی المنتور کار می‌کنند.
- **تولیدکننده‌ی قالب‌ها:** `tools/generate-elementor-templates.py` — بعد از هر تغییر در تم، قالب‌های JSON را دوباره بسازید.
- **پیش‌نمایش بدون وردپرس:** `preview/` — رندر واقعی `front-page.php` با استاب WP (`php -S 0.0.0.0:8080 -t . preview/router.php`).
- **قالب‌های تکمیلی وردپرس:** `404.php`، `archive.php`، `search.php`، `searchform.php`، `comments.php`.

### بهبودها
- GSAP / ScrollTrigger / MotionPath / Lenis حالا **محلی** از `assets/js/vendor/` لود می‌شوند (با Fallback خودکار به CDN در صورت نبود فایل).

## [1.0.0] — نسخه‌ی اولیه

- قالب کامل ۱۵ سکشنه فارسی/RTL با فونت وزیرمتن
- سیستم توکن طراحی (`tokens.css`) با یک رنگ اکسنت سراسری
- ۱۴ ماژول انیمیشن GSAP با معماری امن (ضد init تکراری، fallback، reduced-motion)
- یکپارچه‌سازی با المنتور: Locations، کیت رنگ/تایپوگرافی، راهنمای Attribute API
