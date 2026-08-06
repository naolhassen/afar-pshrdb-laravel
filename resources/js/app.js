import './bootstrap';

function initHomeHero() {
    const root = document.getElementById('home-hero');
    if (!root) return;

    const slides = JSON.parse(root.dataset.slides || '[]');
    const locale = root.dataset.locale;
    const fallbackHref = root.dataset.fallbackHref || '/';
    if (slides.length === 0) return;

    const bgLayer = document.getElementById('hero-bg-layer');
    const categoryEl = document.getElementById('hero-category');
    const dateEl = document.getElementById('hero-date');
    const titleLink = document.getElementById('hero-title-link');
    const excerptEl = document.getElementById('hero-excerpt');
    const readMoreLink = document.getElementById('hero-readmore-link');
    const thumbsEl = document.getElementById('hero-thumbs');
    const arrowsWrap = document.getElementById('hero-arrows');
    const prevBtn = document.getElementById('hero-prev');
    const nextBtn = document.getElementById('hero-next');

    let activeIndex = 0;
    let timer = null;

    const hrefFor = (slide) => (slide.slug ? `/${locale}/news/${slide.slug}` : fallbackHref);

    function renderBackgrounds() {
        bgLayer.innerHTML = '';
        slides.forEach((slide, index) => {
            const layer = document.createElement('div');
            layer.className = `absolute inset-0 transition-opacity duration-1000 ease-out ${index === activeIndex ? 'opacity-100' : 'opacity-0'}`;
            layer.setAttribute('aria-hidden', index !== activeIndex);

            if (slide.imageUrl) {
                const img = document.createElement('img');
                img.src = slide.imageUrl;
                img.alt = slide.title || '';
                img.className = 'h-full w-full object-cover object-center';
                layer.appendChild(img);
            } else {
                const gradient = document.createElement('div');
                gradient.className = 'absolute inset-0 bg-[linear-gradient(120deg,#142756_0%,#193e8d_45%,#0f6133_100%)]';
                layer.appendChild(gradient);
            }

            bgLayer.appendChild(layer);
        });
    }

    function renderHeadline() {
        const slide = slides[activeIndex];
        categoryEl.textContent = slide.category || root.dataset.siteNameShort || '';
        if (slide.date) {
            dateEl.textContent = slide.date;
            dateEl.classList.remove('hidden');
        } else {
            dateEl.textContent = '';
            dateEl.classList.add('hidden');
        }
        titleLink.textContent = slide.title || '';
        titleLink.href = hrefFor(slide);
        excerptEl.textContent = slide.excerpt || '';
        readMoreLink.href = hrefFor(slide);
    }

    function renderThumbnails() {
        thumbsEl.innerHTML = '';

        if (slides.length <= 1) {
            arrowsWrap.classList.add('hidden');
            return;
        }
        arrowsWrap.classList.remove('hidden');

        const sideSlides = slides
            .map((slide, index) => ({ slide, index }))
            .filter(({ index }) => index !== activeIndex)
            .slice(0, 3);

        sideSlides.forEach(({ slide, index }) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'group relative flex min-h-[76px] items-center gap-3 overflow-hidden rounded-lg border border-white/15 bg-slate-950/50 p-3 text-left backdrop-blur-md transition hover:border-white/30 hover:bg-slate-950/65';
            btn.addEventListener('click', () => setActive(index));

            const thumb = document.createElement('span');
            thumb.className = 'relative h-14 w-14 shrink-0 overflow-hidden rounded-md bg-slate-800';

            if (slide.imageUrl) {
                const img = document.createElement('img');
                img.src = slide.imageUrl;
                img.alt = slide.title || '';
                img.className = 'h-full w-full object-cover transition duration-500 group-hover:scale-110';
                thumb.appendChild(img);
            } else {
                const gradient = document.createElement('span');
                gradient.className = 'absolute inset-0 bg-[linear-gradient(120deg,#142756_0%,#0f6133_100%)]';
                thumb.appendChild(gradient);
            }

            const textWrap = document.createElement('span');
            textWrap.className = 'min-w-0';

            const titleSpan = document.createElement('span');
            titleSpan.className = 'block text-[13px] font-semibold leading-snug text-white line-clamp-2';
            titleSpan.textContent = slide.title || '';
            textWrap.appendChild(titleSpan);

            if (slide.date) {
                const dateSpan = document.createElement('span');
                dateSpan.className = 'mt-1 block text-[11px] text-white/60';
                dateSpan.textContent = slide.date;
                textWrap.appendChild(dateSpan);
            }

            btn.appendChild(thumb);
            btn.appendChild(textWrap);
            thumbsEl.appendChild(btn);
        });
    }

    function render() {
        renderBackgrounds();
        renderHeadline();
        renderThumbnails();
    }

    function setActive(index) {
        activeIndex = (index + slides.length) % slides.length;
        render();
        restartTimer();
    }

    function restartTimer() {
        if (timer) clearInterval(timer);
        if (slides.length <= 1) return;
        timer = setInterval(() => setActive(activeIndex + 1), 6500);
    }

    prevBtn.addEventListener('click', () => setActive(activeIndex - 1));
    nextBtn.addEventListener('click', () => setActive(activeIndex + 1));

    render();
    restartTimer();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHomeHero);
} else {
    initHomeHero();
}
