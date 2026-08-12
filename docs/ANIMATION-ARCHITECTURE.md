<div dir="rtl">

# معماری انیمیشن Meridian

## چرخه‌ی حیات

```
app.js (Core)
  ├─ تشخیص: GSAP؟ ScrollTrigger؟ reduced-motion؟ ادیتور؟ RTL؟ تاچ؟
  ├─ registerPlugin + gsap.defaults
  ├─ Lenis smooth-scroll + اتصال به ScrollTrigger
  └─ اجرای یک‌باره‌ی همه‌ی ماژول‌های register شده
       ├─ loader ← رویداد 'meridian:loaded' ← آغاز hero
       ├─ hero, scroll, text-reveal, parallax, motion-path, counters
       ├─ magnetic, cursor, sliders, menu, interactions, page-transition
       └─ refresh بعد از load + fonts.ready
```

## قواعد ایمنی

1. **اجرای یک‌باره:** `M.tag(el, key)` روی هر المان پِرچم `data-*` می‌گذارد.
2. **Fallback بدون GSAP:** کلاس `mrd-no-gsap` روی `<html>`؛ حالت اولیه‌ی انیمیشن‌ها در CSS تعریف نشده، بلکه با `gsap.from` اعمال می‌شود → بدون JS همه‌چیز دیده می‌شود.
3. **`prefers-reduced-motion`:** ماژول‌ها زود `return` می‌کنند؛ CSS transitions هم با media query خنثی شده‌اند.
4. **ادیتور المنتور:** لودر، ترنزیشن، کرسر، پین و اسپلیت غیرفعال می‌شوند تا ویرایش سالم بماند.
5. **ریسایز:** `invalidateOnRefresh` + بازسازی مسیر در `refreshInit` (motion-path).

## API با Attribute (برای المنتور: Advanced ← Attributes)

| Attribute | مقادیر | توضیح |
|---|---|---|
| `data-mrd` | `fade-up / fade-down / fade-left / fade-right / fade / scale / clip-up / img-reveal` | ریویل اسکرولی |
| `data-mrd-delay` | `0.2` | تاخیر (ثانیه) |
| `data-mrd-duration` | `1.2` | مدت |
| `data-mrd-group` | — + `data-mrd-stagger="0.12"` | ریویل پلکانی فرزندان مستقیم |
| `data-split="lines"` | — + `data-split-delay` / `data-split-stagger` | ریویل خط‌به‌خط (LINE-SPLIT واقعی) |
| `data-counter` | `data-counter-target="120"` `data-counter-suffix="+"` `data-counter-decimals` `data-counter-duration` | شمارنده‌ی فارسی |
| `data-parallax` | `0.12` | شدت پارالاکس |
| `data-magnetic` | `0.4` | دکمه‌ی مغناطیسی |
| `data-cursor` | هر متن فارسی | لیبل کرسر سفارشی |
| `data-horizontal` | — (روی سکشن) | اسکرول افقی پین‌شده (دسکتاپ) |
| `data-slider` | — | اسلایدر داخلی (در RS غایب فعال می‌شود) |

## رویدادهای سفارشی

- `meridian:loaded` — بعد از پایان لودر (نقطه‌ی شروع انیمیشن‌های ورود)

## افزودن ماژول جدید

```js
MERIDIAN.register('my-module', function (M) {
  if (!M.hasGSAP) { /* fallback */ return; }
  if (M.reduced) return;
  // ...
});
```
و enqueue در `inc/enqueue.php` (آرایه‌ی `$modules`).

## عملکرد

- اسکرول: scrub فقط روی سکشن‌های هدفمند (هیرو، پارالاکس، فرآیند، کیس)
- `once: true` برای ریویلها → بدون هزینه‌ی دائمی
- پاک‌سازی در matchMedia cleanup‌ها و `ScrollTrigger.kill()` هنگام rebuild
- تصاویر: `loading="lazy" decoding="async"` ، هیرو `fetchpriority="high"`

## Revolution Slider

اگر `.rev_slider` در DOM باشد، `sliders.js` نادیده گرفته می‌شود.
پیشنهاد لایه‌چینی RS برای هیرو/شوکیس/نظرات در `ELEMENTOR-GUIDE.md`.

</div>
