#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
تولیدکننده‌ی قالب‌های قابل‌ایمپورت المنتور برای قالب Meridian.

خروجی: elementor/templates/*.json
  - هر سکشن یک فایل «Saved Template» از نوع section است (Templates > Import)
  - home-page.json یک «صفحه‌ی کامل» از نوع page است

اصل طراحی: قالب‌ها از همان کلاس‌ها/دیتا-اتریبیوت‌های تم (mrd-*) استفاده می‌کنند،
پس CSS حاضر و ماژول‌های انیمیشن GSAP بدون هیچ تغییری روی خروجی المنتور کار می‌کنند.

ویجت‌های «HTML» برای بلوک‌های ساختاری (لیست‌ها، کارت‌ها، شمارنده‌ها) به‌کار رفته‌اند
تا مارکاپ دقیقاً همان چیزی باشد که انیمیشن‌ها انتظار دارند.
تیترها/متن‌های اصلی ویجت نیتیو هستند تا مستقیم در ادیتور ویرایش شوند.

اجرا:  python3 tools/generate-elementor-templates.py
"""

import json
import random
import os

random.seed(1405)  # خروجی پایدار

IDS = set()


def uid():
    while True:
        i = ''.join(random.choice('0123456789abcdef') for _ in range(7))
        if i not in IDS:
            IDS.add(i)
            return i


def container(settings=None, elements=None, inner=False):
    return {
        "id": uid(),
        "elType": "container",
        "isInner": inner,
        "settings": settings or {},
        "defaultEditSettings": {"defaultEditRoute": "content"},
        "elements": elements or [],
        "title": "Container",
        "categories": [],
        "keywords": [],
    }


def widget(wtype, settings):
    return {
        "id": uid(),
        "elType": "widget",
        "isInner": False,
        "widgetType": wtype,
        "settings": settings,
        "defaultEditSettings": {"defaultEditRoute": "content"},
        "elements": [],
        "title": "",
        "categories": ["basic"],
        "keywords": [],
    }


def heading(title, tag="h2", cls="", split=True):
    s = {
        "title": title,
        "header_size": tag,
        "_css_classes": cls,
        "__globals__": {
            "title_color": "globals/colors?id=primary",
            "typography_typography": "globals/typography?id=secondary",
        },
    }
    if split:
        s["attributes"] = "data-split|lines"
    return widget("heading", s)


def text_editor(html, cls=""):
    return widget("text-editor", {"editor": html, "_css_classes": cls})


def html(code, cls=""):
    return widget("html", {"html_code": code.strip(), "_css_classes": cls})


SECTION_PAD = {
    "padding": {
        "unit": "em",
        "top": "7", "right": "0", "bottom": "7", "left": "0",
        "isLinked": False,
    },
}

EYEBROW_LINE = (
    '<svg viewBox="0 0 32 2" fill="none" aria-hidden="true">'
    '<rect width="32" height="1.5" fill="currentColor"/></svg>'
)

ARROW_L = (
    '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true" width="1em" height="1em">'
    '<path d="M19 12H5m0 0 6 6m-6-6 6-6" stroke="currentColor" stroke-width="1.8" '
    'stroke-linecap="round" stroke-linejoin="round"/></svg>'
)

ARROW_UL = (
    '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true" width="1em" height="1em">'
    '<path d="M17 7 7 17M7 9v8h8" stroke="currentColor" stroke-width="1.8" '
    'stroke-linecap="round" stroke-linejoin="round"/></svg>'
)


def btn(label, url="#", style="solid", cls=""):
    """دکمه‌ی نیتیو المنتور با کلاس‌های دکمه‌ی قالب."""
    return widget(
        "button",
        {
            "text": label,
            "link": {"url": url, "is_external": "", "nofollow": ""},
            "selected_icon": {"value": ""},
            "_css_classes": cls or f"mrd-el-btn mrd-btn--{style}",
        },
    )


def inner(cts):
    return container({"_css_classes": "mrd-container"}, cts, inner=True)


# ─────────────────────────────────────────────────────────────
# سکشن ۱ — HERO
# ─────────────────────────────────────────────────────────────
def sec_hero():
    content_html = f"""
<span class="mrd-eyebrow" data-hero-eyebrow>{EYEBROW_LINE} شرکت بین‌المللی فناوری، مهندسی و سرمایه‌گذاری</span>
<h1 class="mrd-hero__title" data-hero-title>
  <span class="mrd-hero__line"><span class="mrd-hero__line-inner">ما چیزی می‌سازیم که</span></span>
  <span class="mrd-hero__line"><span class="mrd-hero__line-inner">کسب‌وکار را به جلو می‌برد.</span></span>
</h1>
<p class="mrd-hero__desc" data-hero-desc>[توضیح کوتاه شرکت] — از ایده تا اجرا، در کنار سازمان‌ها راه‌حل‌هایی دقیق، مقیاس‌پذیر و ماندگار طراحی می‌کنیم.</p>
<div class="mrd-hero__actions" data-hero-actions>
  <a href="#projects" class="mrd-btn mrd-btn--solid" data-magnetic="0.4">
    <span class="mrd-btn__label">مشاهده‌ی پروژه‌ها</span>
    <span class="mrd-btn__arrow">{ARROW_UL}</span>
  </a>
  <a href="#contact" class="mrd-btn mrd-btn--ghost" data-magnetic="0.4">
    <span class="mrd-btn__label">تماس با ما</span>
  </a>
</div>
"""
    visual_html = """
<figure class="mrd-hero__visual-media">
  <img src="/wp-content/uploads/hero.jpg" alt="[تصویر اصلی هیرو]" width="1200" height="900" decoding="async" fetchpriority="high">
</figure>
<span class="mrd-hero__orb" data-hero-orb></span>
<span class="mrd-hero__tag mrd-glass" data-hero-tag><i></i> مقیاس‌پذیر. دقیق. ماندگار.</span>
"""
    gridline = '<span class="mrd-hero__gridline"></span>'
    bg_html = gridline * 4
    scroll_html = """
<a class="mrd-hero__scroll" href="#about" data-hero-scroll aria-label="اسکرول به پایین">
  <span class="mrd-hero__scroll-text">اسکرول</span>
  <span class="mrd-hero__scroll-line"><i></i></span>
</a>
"""
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "min_height": {"unit": "vh", "size": 100, "sizes": []},
            "flex_direction": "column",
            "_css_classes": "mrd-hero",
            "attributes": "data-hero|",
            "_element_id": "hero",
        },
        [
            html(bg_html, "mrd-hero__bg"),
            inner(
                [
                    html(content_html, "mrd-hero__content"),
                    html(visual_html, "mrd-hero__visual"),
                ]
            ),
            html(scroll_html, "mrd-hero__scroll-wrap"),
        ],
    )


# ─────────────────────────────────────────────────────────────
# سکشن ۲ — ABOUT
# ─────────────────────────────────────────────────────────────
def sec_about():
    media_html = """
<figure class="mrd-about__media u-hover-zoom" data-mrd="mask">
  <img src="/wp-content/uploads/about.jpg" alt="[تصویر درباره‌ی ما]" width="1000" height="1250" loading="lazy" decoding="async" data-parallax="0.12">
</figure>
"""
    text_html = f"""
<span class="mrd-eyebrow" data-mrd="fade-up">{EYEBROW_LINE} درباره‌ی ما</span>
"""
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-about mrd-section--pad",
            "_element_id": "about",
        },
        [
            inner(
                [
                    container(
                        {"_css_classes": "mrd-about__grid"},
                        [
                            html(text_html, "mrd-about__eyebrow"),
                            html(media_html, "mrd-about__media-wrap"),
                            container(
                                {"_css_classes": "mrd-about__content"},
                                [
                                    heading("[گزاره‌ی شرکت] چالش‌های پیچیده را به فرصت‌های روشن تبدیل می‌کنیم.", "h2", "mrd-h2"),
                                    text_editor("<p>[متن درباره‌ی ما] — مِریدین مجموعه‌ای از مهندسان، طراحان و تحلیل‌گران است که از سال ۱۳۸۸ در کنار سازمان‌ها، راه‌حل‌هایی دقیق و ماندگار می‌سازد.</p>", "mrd-lead mrd-text-muted"),
                                    btn("بیشتر بدانید", "#about", "ghost"),
                                ],
                                inner=True,
                            ),
                        ],
                        inner=True,
                    )
                ]
            )
        ],
    )


# ─────────────────────────────────────────────────────────────
# سکشن ۳ — آمار / شمارنده‌ها
# ─────────────────────────────────────────────────────────────
def sec_stats():
    items = [
        ("15", "+", "سال تجربه"),
        ("120", "+", "پروژه‌ی موفق"),
        ("35", "", "صنعت"),
        ("98", "٪", "رضایت مشتری"),
    ]
    cells = "".join(
        f"""
<div class="mrd-stat">
  <span class="mrd-stat__number">
    <span data-counter data-counter-target="{v}" data-counter-duration="2">۰</span><em class="mrd-stat__suffix">{s}</em>
  </span>
  <span class="mrd-stat__label">{l}</span>
</div>"""
        for v, s, l in items
    )
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-stats",
            "_element_id": "stats",
        },
        [inner([html(f'<div class="mrd-stats__grid" data-mrd-group>{cells}</div>', "mrd-stats__wrap")])],
    )


# ─────────────────────────────────────────────────────────────
# سکشن ۴ — خدمات (لیست تعاملی)
# ─────────────────────────────────────────────────────────────
def sec_services():
    services = [
        ("استراتژی و مشاوره", "[توضیح خدمت] — تحلیل بازار، طراحی مدل کسب‌وکار و نقشه‌ی راه رشد.", "Strategy"),
        ("توسعه‌ی فناوری", "[توضیح خدمت] — معماری نرم‌افزار، پلتفرم‌های ابری و محصولات دیجیتال مقیاس‌پذیر.", "Technology"),
        ("مهندسی و اجرا", "[توضیح خدمت] — مدیریت پروژه‌های پیچیده‌ی مهندسی از طراحی تا تحویل.", "Engineering"),
        ("تحول دیجیتال", "[توضیح خدمت] — بازطراحی فرآیندها و سیستم‌ها برای سازمان‌های داده‌محور.", "Transformation"),
        ("سرمایه‌گذاری و رشد", "[توضیح خدمت] — ساختاردهی مالی، جذب سرمایه و توسعه‌ی بازارهای جدید.", "Investment"),
    ]
    rows = ""
    fa_nums = ["۰۱", "۰۲", "۰۳", "۰۴", "۰۵"]
    for i, (t, d, tag) in enumerate(services):
        rows += f"""
<li class="mrd-services__item" data-service-item>
  <button class="mrd-services__trigger" type="button" aria-expanded="false">
    <span class="mrd-services__num">{fa_nums[i]}</span>
    <span class="mrd-services__name">{t}</span>
    <span class="mrd-services__tag">{tag}</span>
    <span class="mrd-services__plus"></span>
  </button>
  <div class="mrd-services__body">
    <p class="mrd-services__desc">{d}</p>
    <a class="mrd-btn mrd-btn--text" href="#contact"><span class="mrd-btn__label">دریافت مشاوره</span><span class="mrd-btn__circle">{ARROW_L}</span></a>
  </div>
</li>"""
    head_html = f"""
<span class="mrd-eyebrow" data-mrd="fade-up">{EYEBROW_LINE} خدمات ما</span>
<h2 class="mrd-h2" data-split="lines">راه‌حل‌های یکپارچه، از استراتژی تا اجرا.</h2>
<p class="mrd-lead mrd-text-muted" data-mrd="fade-up" data-mrd-delay="0.15">[توضیح سکشن خدمات] — پنج حوزه‌ی تخصصی، یک تیم واحد.</p>
"""
    listc = f'<ul class="mrd-services__list" data-services-list>{rows}</ul>'
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-services mrd-section--pad",
            "attributes": "data-services|",
            "_element_id": "services",
        },
        [
            inner(
                [
                    container(
                        {"_css_classes": "mrd-services__grid"},
                        [
                            html(head_html, "mrd-services__head"),
                            html(listc, "mrd-services__list-wrap"),
                        ],
                        inner=True,
                    )
                ]
            )
        ],
    )


# ─────────────────────────────────────────────────────────────
# سکشن ۵ — پروژه‌ها
# ─────────────────────────────────────────────────────────────
def sec_projects():
    projects = [
        ("[نام پروژه] پلتفرم یکپارچه‌ی بانکی", "فناوری مالی", "۱۴۰۳", ""),
        ("[نام پروژه] نیروگاه خورشیدی ۴۰ مگاواتی", "انرژی", "۱۴۰۲", " mrd-project--offset"),
        ("[نام پروژه] برج اداری مرکزی", "ساختمان", "۱۴۰۲", ""),
        ("[نام پروژه] شبکه‌ی لجستیک هوشمند", "لجستیک", "۱۴۰۱", " mrd-project--offset"),
    ]
    cards = ""
    for i, (t, c, y, off) in enumerate(projects):
        cards += f"""
<article class="mrd-project{off}" data-mrd="fade-up" data-mrd-delay="{(i % 2) * 0.12}">
  <a href="#" class="mrd-project__link" data-cursor="مشاهده" aria-label="{t}">
    <figure class="mrd-project__media u-hover-zoom">
      <img src="/wp-content/uploads/project-{i+1}.jpg" alt="{t}" width="1100" height="800" loading="lazy" decoding="async">
      <span class="mrd-project__year">{y}</span>
    </figure>
    <div class="mrd-project__meta">
      <span class="mrd-project__cat">{c}</span>
      <span class="mrd-project__index">{fa_nums(i + 1)}</span>
    </div>
    <h3 class="mrd-project__title">{t}</h3>
    <p class="mrd-project__desc mrd-text-muted">[توضیح کوتاه پروژه]</p>
  </a>
</article>"""
    head = f"""
<span class="mrd-eyebrow">{EYEBROW_LINE} پروژه‌های شاخص</span>
"""
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-projects mrd-section--pad",
            "_element_id": "projects",
        },
        [
            inner(
                [
                    container(
                        {"_css_classes": "mrd-section-head", "attributes": "data-mrd|fade-up"},
                        [
                            html(head, "mrd-section-head__eyebrow"),
                            heading("کارهایی که به آن‌ها افتخار می‌کنیم.", "h2", "mrd-h2"),
                            btn("مشاهده‌ی همه‌ی پروژه‌ها", "#case-studies", "text", "mrd-el-btn mrd-btn--text mrd-section-head__cta"),
                        ],
                        inner=True,
                    ),
                    html(f'<div class="mrd-projects__grid">{cards}</div>', "mrd-projects__wrap"),
                ]
            )
        ],
    )


def fa_nums(n):
    return "۰" + str(n) if n < 10 else "۱۰"


# ─────────────────────────────────────────────────────────────
# سکشن ۶ — صنایع / توانمندی‌ها
# ─────────────────────────────────────────────────────────────
def sec_industries():
    industries = [
        ("فناوری", "[توضیح کوتاه صنعت]"),
        ("ساختمان و عمران", "[توضیح کوتاه صنعت]"),
        ("مالی و بانکی", "[توضیح کوتاه صنعت]"),
        ("تولید و صنعت", "[توضیح کوتاه صنعت]"),
        ("انرژی", "[توضیح کوتاه صنعت]"),
        ("املاک و مستغلات", "[توضیح کوتاه صنعت]"),
        ("سلامت", "[توضیح کوتاه صنعت]"),
        ("لجستیک و حمل‌ونقل", "[توضیح کوتاه صنعت]"),
    ]
    cards = ""
    for i, (t, d) in enumerate(industries):
        cards += f"""
<li class="mrd-industry" data-mrd="fade-up" data-mrd-delay="{(i % 4) * 0.08}">
  <a href="#" class="mrd-industry__link">
    <span class="mrd-industry__num">{fa_nums(i + 1)}</span>
    <h3 class="mrd-industry__title">{t}</h3>
    <p class="mrd-industry__desc">{d}</p>
    <span class="mrd-industry__arrow">{ARROW_L}</span>
  </a>
</li>"""
    head = f"""
<span class="mrd-eyebrow">{EYEBROW_LINE} صنایع و توانمندی‌ها</span>
"""
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-industries mrd-section--pad",
            "_element_id": "industries",
        },
        [
            inner(
                [
                    container(
                        {"_css_classes": "mrd-section-head", "attributes": "data-mrd|fade-up"},
                        [
                            html(head, "mrd-section-head__eyebrow"),
                            heading("تجربه در هشت صنعت کلیدی.", "h2", "mrd-h2"),
                        ],
                        inner=True,
                    ),
                    html(f'<ul class="mrd-industries__grid" data-mrd-group>{cards}</ul>', "mrd-industries__wrap"),
                ]
            )
        ],
    )


# ─────────────────────────────────────────────────────────────
# سکشن ۷ — فرآیند + Motion Path
# ─────────────────────────────────────────────────────────────
def sec_process():
    steps = [
        ("کشف", "[توضیح مرحله] — شناخت عمیق چالش، ذی‌نفعان و داده‌ها."),
        ("استراتژی", "[توضیح مرحله] — تعریف مسیر، شاخص‌های موفقیت و نقشه‌ی راه."),
        ("طراحی", "[توضیح مرحله] — طراحی راه‌حل با تمرکز بر دقت و تجربه."),
        ("اجرا", "[توضیح مرحله] — توسعه و پیاده‌سازی با کنترل کیفیت مداوم."),
        ("رشد", "[توضیح مرحله] — اندازه‌گیری، بهینه‌سازی و مقیاس."),
    ]
    lis = ""
    for i, (t, d) in enumerate(steps):
        active = " is-active" if i == 0 else ""
        lis += f"""
<li class="mrd-process__step{active}" data-process-step>
  <span class="mrd-process__step-num">{fa_nums(i + 1)}</span>
  <h3 class="mrd-process__step-title">{t}</h3>
  <p class="mrd-process__step-desc">{d}</p>
</li>"""
    stage = f"""
<svg class="mrd-process__path" data-process-svg aria-hidden="true">
  <path data-process-line fill="none"></path>
  <path data-process-progress fill="none"></path>
  <g data-process-dot>
    <circle class="mrd-process__dot-halo" r="14"></circle>
    <circle class="mrd-process__dot-core" r="6"></circle>
  </g>
</svg>
<ol class="mrd-process__steps">{lis}</ol>
"""
    head = f"""
<span class="mrd-eyebrow mrd-eyebrow--accent">{EYEBROW_LINE} فرآیند ما</span>
"""
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-process mrd-section--pad",
            "attributes": "data-process|",
            "_element_id": "process",
        },
        [
            inner(
                [
                    container(
                        {"_css_classes": "mrd-section-head mrd-section-head--center", "attributes": "data-mrd|fade-up"},
                        [
                            html(head, "mrd-section-head__eyebrow"),
                            heading("پنج مرحله تا نتیجه.", "h2", "mrd-h2"),
                        ],
                        inner=True,
                    ),
                    html(stage, "mrd-process__stage",),
                ]
            )
        ],
    )


# ─────────────────────────────────────────────────────────────
# سکشن ۸ — نظرات مشتریان
# ─────────────────────────────────────────────────────────────
def sec_testimonials():
    quotes = [
        ("[نقل‌قول مشتری] — دقت، شفافیت و کیفیت اجرای این تیم، استاندارد جدیدی برای ما تعریف کرد.", "[نام مشتری]", "مدیرعامل، [نام شرکت مشتری]"),
        ("[نقل‌قول مشتری] — همکاری با مِریدین، پروژه‌ی ما را شش ماه جلو انداخت.", "[نام مشتری]", "مدیر فناوری، [نام شرکت مشتری]"),
        ("[نقل‌قول مشتری] — تیمی که هم استراتژی می‌فهمد، هم اجرا.", "[نام مشتری]", "مدیر محصول، [نام شرکت مشتری]"),
    ]
    slides = ""
    for q, n, r in quotes:
        slides += f"""
<figure class="mrd-quote">
  <blockquote class="mrd-quote__text">{q}</blockquote>
  <figcaption class="mrd-quote__meta">
    <span class="mrd-quote__avatar" aria-hidden="true">{n[1]}</span>
    <span class="mrd-quote__who"><strong>{n}</strong><small>{r}</small></span>
  </figcaption>
</figure>"""
    slider = f"""
<div class="mrd-testimonials__slider" data-slider>
  <div class="mrd-testimonials__track" data-slider-track>{slides}</div>
</div>
<div class="mrd-testimonials__controls">
  <button class="mrd-ctrl" type="button" data-slider-prev aria-label="قبلی">{ARROW_L}</button>
  <span class="mrd-testimonials__count" data-slider-count>۰۱ / ۰۳</span>
  <button class="mrd-ctrl mrd-ctrl--flip" type="button" data-slider-next aria-label="بعدی">{ARROW_L}</button>
</div>
"""
    head = f"""
<span class="mrd-eyebrow">{EYEBROW_LINE} نظرات مشتریان</span>
"""
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-testimonials mrd-section--pad",
            "_element_id": "testimonials",
        },
        [
            inner(
                [
                    container(
                        {"_css_classes": "mrd-section-head", "attributes": "data-mrd|fade-up"},
                        [html(head, "mrd-section-head__eyebrow"), heading("اعتماد، مهم‌ترین خروجی ماست.", "h2", "mrd-h2")],
                        inner=True,
                    ),
                    html(slider, "mrd-testimonials__wrap"),
                ]
            )
        ],
    )


# ─────────────────────────────────────────────────────────────
# سکشن ۹ — تیم
# ─────────────────────────────────────────────────────────────
def sec_team():
    members = [
        ("[نام عضو تیم]", "مدیرعامل"),
        ("[نام عضو تیم]", "مدیر استراتژی"),
        ("[نام عضو تیم]", "مدیر فناوری"),
        ("[نام عضو تیم]", "مدیر طراحی"),
    ]
    cards = ""
    for i, (n, r) in enumerate(members):
        cards += f"""
<li class="mrd-member" data-mrd="fade-up" data-mrd-delay="{i * 0.1}">
  <figure class="mrd-member__media u-hover-zoom">
    <img src="/wp-content/uploads/team-{i+1}.jpg" alt="{n} — {r}" width="600" height="750" loading="lazy" decoding="async">
  </figure>
  <div class="mrd-member__meta">
    <h3 class="mrd-member__name">{n}</h3>
    <span class="mrd-member__role">{r}</span>
  </div>
</li>"""
    head = f"""
<span class="mrd-eyebrow">{EYEBROW_LINE} تیم ما</span>
"""
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-team mrd-section--pad",
            "_element_id": "team",
        },
        [
            inner(
                [
                    container(
                        {"_css_classes": "mrd-section-head", "attributes": "data-mrd|fade-up"},
                        [html(head, "mrd-section-head__eyebrow"), heading("افرادی که تفاوت را می‌سازند.", "h2", "mrd-h2")],
                        inner=True,
                    ),
                    html(f'<ul class="mrd-team__grid" data-mrd-group>{cards}</ul>', "mrd-team__wrap"),
                ]
            )
        ],
    )


# ─────────────────────────────────────────────────────────────
# سکشن ۱۰ — CTA
# ─────────────────────────────────────────────────────────────
def sec_cta():
    body = f"""
<span class="mrd-eyebrow mrd-eyebrow--light" data-mrd="fade-up">{EYEBROW_LINE} شروع همکاری</span>
<h2 class="mrd-cta__title" data-split="lines">بیایید چیزی ماندگار بسازیم.</h2>
<p class="mrd-cta__desc" data-mrd="fade-up" data-mrd-delay="0.15">[توضیح کوتاه CTA] — پاسخ‌گویی در کمتر از ۲۴ ساعت کاری.</p>
<div data-mrd="fade-up" data-mrd-delay="0.25">
  <a href="#contact" class="mrd-btn mrd-btn--light" data-magnetic="0.4">
    <span class="mrd-btn__label">شروع پروژه</span>
    <span class="mrd-btn__arrow">{ARROW_UL}</span>
  </a>
</div>
<p class="mrd-cta__contact" data-mrd="fade-up" data-mrd-delay="0.35">
  <a href="mailto:info@example.com" class="mrd-link-line mrd-link-line--light">[ایمیل] info@example.com</a>
  <a href="tel:+982100000000" class="mrd-link-line mrd-link-line--light">[تلفن] ۰۲۱-۰۰۰۰۰۰۰۰</a>
</p>
"""
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-cta mrd-section--pad",
            "_element_id": "cta",
        },
        [inner([html(body, "mrd-cta__inner")])],
    )


# ─────────────────────────────────────────────────────────────
# سکشن ۱۱ — تماس
# ─────────────────────────────────────────────────────────────
def sec_contact():
    form = """
<form class="mrd-form" action="#" method="post" novalidate>
  <div class="mrd-form__row">
    <label class="mrd-field">
      <input class="mrd-field__input" type="text" name="name" required placeholder=" ">
      <span class="mrd-field__label">نام و نام خانوادگی</span>
    </label>
    <label class="mrd-field">
      <input class="mrd-field__input" type="email" name="email" required placeholder=" ">
      <span class="mrd-field__label">ایمیل</span>
    </label>
  </div>
  <label class="mrd-field">
    <input class="mrd-field__input" type="text" name="subject" placeholder=" ">
    <span class="mrd-field__label">موضوع</span>
  </label>
  <label class="mrd-field">
    <textarea class="mrd-field__input mrd-field__input--area" name="message" rows="5" required placeholder=" "></textarea>
    <span class="mrd-field__label">پیام شما</span>
  </label>
  <button class="mrd-btn mrd-btn--solid" type="submit" data-magnetic="0.35">
    <span class="mrd-btn__label">ارسال پیام</span>
  </button>
</form>
"""
    info = f"""
<div class="mrd-contact__info">
  <div class="mrd-contact__item" data-mrd="fade-up">
    <span class="mrd-contact__label">تلفن</span>
    <a class="mrd-contact__value mrd-link-line" href="tel:+982100000000">[تلفن] ۰۲۱-۰۰۰۰۰۰۰۰</a>
  </div>
  <div class="mrd-contact__item" data-mrd="fade-up" data-mrd-delay="0.1">
    <span class="mrd-contact__label">ایمیل</span>
    <a class="mrd-contact__value mrd-link-line" href="mailto:info@example.com">[ایمیل] info@example.com</a>
  </div>
  <div class="mrd-contact__item" data-mrd="fade-up" data-mrd-delay="0.2">
    <span class="mrd-contact__label">نشانی</span>
    <span class="mrd-contact__value">[آدرس] — تهران، خیابان نمونه، پلاک ۱۲، واحد ۴</span>
  </div>
  <div class="mrd-contact__map" data-mrd="fade-up" data-mrd-delay="0.3">
    <span class="mrd-contact__map-note">[نقشه — امبد Google Maps / نشان این‌جا قرار می‌گیرد]</span>
  </div>
</div>
"""
    head = f"""
<span class="mrd-eyebrow">{EYEBROW_LINE} تماس با ما</span>
"""
    return container(
        {
            "html_tag": "section",
            "content_width": "full",
            "_css_classes": "mrd-contact mrd-section--pad",
            "_element_id": "contact",
        },
        [
            inner(
                [
                    container(
                        {"_css_classes": "mrd-section-head", "attributes": "data-mrd|fade-up"},
                        [html(head, "mrd-section-head__eyebrow"), heading("گفت‌وگو را آغاز کنیم.", "h2", "mrd-h2")],
                        inner=True,
                    ),
                    container(
                        {"_css_classes": "mrd-contact__grid"},
                        [html(form, "mrd-contact__form-wrap"), html(info, "mrd-contact__info-wrap")],
                        inner=True,
                    ),
                ]
            )
        ],
    )


# ─────────────────────────────────────────────────────────────
# بیلد و ذخیره
# ─────────────────────────────────────────────────────────────
SECTIONS = {
    "hero": ("Meridian — Hero (هیرو سینمایی)", sec_hero),
    "about": ("Meridian — About (درباره‌ی ما)", sec_about),
    "stats": ("Meridian — Stats (شمارنده‌ها)", sec_stats),
    "services": ("Meridian — Services (خدمات تعاملی)", sec_services),
    "projects": ("Meridian — Projects (پروژه‌های شاخص)", sec_projects),
    "industries": ("Meridian — Industries (صنایع)", sec_industries),
    "process": ("Meridian — Process (فرآیند + Motion Path)", sec_process),
    "testimonials": ("Meridian — Testimonials (نظرات)", sec_testimonials),
    "team": ("Meridian — Team (تیم)", sec_team),
    "cta": ("Meridian — CTA (فراخوان نهایی)", sec_cta),
    "contact": ("Meridian — Contact (تماس)", sec_contact),
}


def build():
    out_dir = os.path.join(os.path.dirname(__file__), "..", "elementor", "templates")
    out_dir = os.path.abspath(out_dir)
    os.makedirs(out_dir, exist_ok=True)

    all_containers = []
    for slug, (title, fn) in SECTIONS.items():
        el = fn()
        all_containers.append(el)
        data = {
            "version": "0.4",
            "title": title,
            "type": "section",
            "content": [el],
            "page_settings": [],
        }
        path = os.path.join(out_dir, f"{slug}.json")
        with open(path, "w", encoding="utf-8") as f:
            json.dump(data, f, ensure_ascii=False, indent=1)
        print(f"✓ {slug}.json ({os.path.getsize(path)} bytes)")

    # صفحه‌ی کامل
    home = {
        "version": "0.4",
        "title": "Meridian — صفحه‌ی اصلی (کامل)",
        "type": "page",
        "content": all_containers,
        "page_settings": {"hide_title": "yes"},
    }
    path = os.path.join(out_dir, "home-page.json")
    with open(path, "w", encoding="utf-8") as f:
        json.dump(home, f, ensure_ascii=False, indent=1)
    print(f"✓ home-page.json ({os.path.getsize(path)} bytes)")


if __name__ == "__main__":
    build()
