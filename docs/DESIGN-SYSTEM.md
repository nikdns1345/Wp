<div dir="rtl">

# سیستم دیزاین Meridian

منبع حقیقت: `wp-content/themes/meridian/assets/css/tokens.css`

## ۱) رنگ‌ها

| توکن | مقدار پیش‌فرض | کاربرد |
|---|---|---|
| `--c-bg` | `#F7F6F3` | پس‌زمینه‌ی اصلی (سفید گرم) |
| `--c-surface` | `#FFFFFF` | سطح کارت‌ها/سکشن‌های متناوب |
| `--c-ink` | `#111114` | متن اصلی (نزدیک به مشکی) |
| `--c-muted` | `#6F6F76` | متن ثانویه |
| `--c-line` / `--c-line-strong` | rgba | خطوط Hairline |
| **`--c-accent`** | `#2040FF` | **تنها رنگ سازمانی — از همین‌جا عوض شود** |
| `--c-dark-bg` | `#0E0E11` | سکشن‌های تیره (آمار، فرآیند، CTA، فوتر) |

### تغییر رنگ سازمانی (۳ نقطه‌ی هماهنگ)
1. `tokens.css` → `--c-accent` (+ نسخه‌های `-hover` / `-soft`)
2. المنتور ← Site Settings ← Global Colors ← Accent (مقدار یکسان)
3. (اختیاری) فیلتر PHP: `add_filter('meridian_accent_color', fn() => '#0FA47A');`  
   — این فیلتر به‌صورت خودکار CSS var را override می‌کند.

## ۲) تایپوگرافی (وزیرمتن)

| کلاس | سایز سیال | وزن | کاربرد |
|---|---|---|---|
| `.mrd-display` | `clamp(2.5rem, 8vw, 7.75rem)` | 800 | Statement / اعداد بزرگ |
| `.mrd-h1` | `clamp(2.25rem, 5.6vw, 5.25rem)` | 800 | تیتر صفحه/هیرو |
| `.mrd-h2` | `clamp(1.85rem, 3.8vw, 3.4rem)` | 700 | تیتر سکشن |
| `.mrd-h3` | `clamp(1.25rem, 1.8vw, 1.7rem)` | 700 | تیتر کارت |
| `.mrd-lead` | `clamp(1.05rem, 1.3vw, 1.25rem)` | 400 | لید |
| بدنه | `1.0625rem` / line-height `2` | 400 | متن |
| `.mrd-eyebrow` | `.8rem` + letter-spacing | 500 | برچسب بالای تیترها (با خط accent) |
| `.mrd-caption` | `.8125rem` | 400 | کپشن |

فونت **Vazirmatn** به‌صورت متغیر (100–900) و **محلی** لود می‌شود: `assets/fonts/vazirmatn.woff2` (~۱۱۱ کیلوبایت). اگر فایل حذف شود، خودکار از Google Fonts لود می‌شود.

## ۳) فواصل و چیدمان

- اسپیسینگ: `--space-1 … --space-9` (۰.۵rem تا ۱۲rem)
- پدینگ سکشن: `--section-pad: clamp(5rem, 10vw, 9.5rem)`
- کانتینر: `--container: 88rem` ، گاتر سیال: `--gutter: clamp(1.25rem, 4vw, 4rem)`
- شعاع: `--radius: 6px` / `--radius-lg: 12px` / pill برای دکمه‌ها

## ۴) ریتم بصری سکشن‌ها

روشن ← تیره متناوب برای حس «سینمایی»:

```
Hero(روشن) → About(روشن) → Stats(تیره) → Services(سفید) → Projects(روشن)
→ Industries(روشن) → Process(تیره) → Cases(تیره-سطح) → Testimonials(سفید)
→ Team(روشن) → Partners(روشن) → CTA(تیره) → Contact(روشن) → Footer(تیره)
```

## ۵) اصول

- انیمیشن فقط با `transform` + `opacity` (GPU)؛ بدون تغییر layout properties
- `will-change` فقط روی عناصر «در حال» حرکت
- سایه‌ها لطیف، خطوط ۱ پیکسلی، بدون گرادیان نمایشی روی متن
- سطح تزئینات: hairline grid هیرو، orb اکcent، حلقه‌ی چرخان CTA — همین‌قدر.

</div>
