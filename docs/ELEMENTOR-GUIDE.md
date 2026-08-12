<div dir="rtl">

# راهنمای المنتور — بازسازی و ویرایش سکشن‌ها بدون کدنویسی

## ۱) تنظیمات سراسری (Site Settings)

1. **المنتور ← تنظیمات سایت ← رنگ‌های سراسری** — چهار رنگ سیستم:
   - Primary `#111114` · Secondary `#6F6F76` · Accent `#2040FF` · Text `#3A3A40`
   - دو رنگ سفارشی: Off-White `#F7F6F3` · Dark `#0E0E11`
   - فایل آماده: `elementor/kit-settings.json` (Import از مسیر Site Settings ← Import/Export Kit یا واردکردن دستی مقادیر بالا)
2. **تایپوگرافی سراسری:** فونت خانواده `Vazirmatn` (در لیست Google Fonts المنتور **Vazirmatn** را جست‌وجو کنید).
   پیش‌فرض المنتور غیرفعال است تا سیستم قالب حاکم بماند.
3. **Layout:** عرض محتوا `1408px` — گپ ستون‌ها `32px`.

## ۲) الگوی ساخت هر سکشن (Flexbox Container)

```
Container (Full width, min-height بسته‌به سکشن)
├─ CSS Class:  mrd-section--pad
└─ Container داخلی (Content width: 1408 / Direction: بسته به چیدمان)
   ├─ HTML/Heading با کلاس‌های تایپوگرافی: mrd-eyebrow / mrd-h2 / mrd-lead
   ├─ Attribute انیمیشن: data-mrd="fade-up"  (Advanced ← Attributes)
   └─ ...
```

### کلاس‌های آماده برای استفاده در المنتور

| کاربرد | کلاس |
|---|---|
| پدینگ سکشن | `mrd-section--pad` |
| کانتینر | `mrd-container` |
| تایپوگرافی | `mrd-display` `mrd-h1` `mrd-h2` `mrd-h3` `mrd-lead` `mrd-text-muted` `mrd-eyebrow` |
| دکمه‌ها | `mrd-btn mrd-btn--solid` · `mrd-btn mrd-btn--ghost` · `mrd-btn mrd-btn--text` |
| لینک با آندرلاین | `mrd-link-line` |
| سکشن تیره | `mrd-dark` + بک‌گراند `#0E0E11` |
| ریویل گروهی | والد: Attribute `data-mrd-group` |

> نکته‌ی دکمه: در المنتور یک HTML widget یا دکمه با کلاس `mrd-btn mrd-btn--solid` بسازید؛
> برای فلش، درون HTML: `<span class="mrd-btn__arrow">SVG</span>` (SVGهای آماده در `inc/helpers.php`).

## ۳) کارت‌های قابل‌تکرار (Loop با قالب‌های قالب)

هر «کامپوننت» فایل PHP مستقل دارد و با الگوی زیر در المنتور بازسازی می‌شود:

| کامپوننت | ساختار در المنتور |
|---|---|
| کارت خدمت | Container بردر زیر + Heading(`mrd-h3`) + Text + ردیف شماره `۰x` + اکنترولر آکاردئونی |
| کارت پروژه | Image(`u-hover-zoom`) + ردیف متا (دسته/سال) + H3 + متن + لینک `data-cursor="مشاهده"` |
| کارت صنعت | آیتم `data-industry` یا کلاس `mrd-industry` + شماره + H3 + فلش |
| کارت تیم | Image(grayscale) + نام + نقش + آیکن‌های شبکه (`mrd-social`) |
| اسلاید نظر | بلاک `blockquote` با `data-slide` داخل `data-slider_container` یا مستقیم RS |
| لوگوی شریک | آیتم `mrd-partners__item` با SVG لوگو (grayscale خودکار) |

## ۴) آمار و شمارنده

ویجت Counter المنتور هم کار می‌کند؛ ولی برای اعداد فارسی حرفه‌ای: HTML widget:

```html
<span data-counter data-counter-target="120" data-counter-suffix="+">۰</span>
```

## ۵) Motion Path فرآیند

اگر سکشن فرآیند را با المنتور می‌سازید، ساختار DOM را حفظ کنید:

```
[data-process-stage]        ← والد سنجش ابعاد
 ├─ svg > [data-process-line], [data-process-progress], [data-process-dot]
 └─ [data-process-step] ×5   ← مراحل به ترتیب
```

## ۶) Revolution Slider (اختیاری)

- **هیرو اسلایدر:** Slide تمام‌صفحه + لایه‌ها: eyebrow → H1 (mask by lines) → متن → دکمه، Ken Burns ملایم روی بک‌گراند (scale 1.1، مدت 8s)، Transition: «Slide Vertical» یا «Fade Mask».
- **شوکیس پروژه:** Carousel با 3 اسلاید فعال، متن پایین-چپ (در RTL: پایین-راست)، Parallax صحنه عمق‌دار.
- **نظرات:** می‌توان `sliders.js` داخلی را نگه داشت (سبک‌تر)؛ با RS: نوار ناوبری دات + fade+drift ملایم.
- قانون: RS نه برای همه‌جا؛ فقط جایی که ارزش بصری واقعی می‌افزاید. `sliders.js` خودش RS را تشخیص داده و کنار می‌رود.

## ۷) Locationهای Theme Builder

قالب `header`/`footer`/`single`/`archive`/`404` را register می‌کند. می‌توانید هدر/فوتر دلخواه با المنتور بسازید و جایگزین شود (`inc/elementor.php`).

## ۸) چک‌لیست ویرایش محتوا

- [ ] لوگو: سفارشی‌سازی ← هویت سایت ← لوگو (SVG ترجیحاً)
- [ ] `[نام شرکت]`/`[شعار شرکت]`: عنوان و توضیح سایت
- [ ] `[تلفن]` `[ایمیل]` `[آدرس]`: در هدر/منو/تماس/فوتر
- [ ] رنگ Accent: tokens.css + Global Colors
- [ ] تصاویر `[تصویر …]`/`[عکس …]`: با رسانه‌ی واقعی + متن alt معنادار
- [ ] آمار/خدمات/پروژه‌ها/تیم/نظرات/شرکا: آرایه‌های ابتدای هر سکشن یا ویجت‌های المنتور

</div>
