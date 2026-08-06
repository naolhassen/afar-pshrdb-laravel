@php
    $currentPath = trim(request()->path(), '/');
    $segments = $currentPath === '' ? [] : explode('/', $currentPath);
    $restPath = implode('/', array_slice($segments, 1));

    $navItems = [
        ['href' => "/{$locale}", 'label' => __('site.nav.home')],
        ['href' => "/{$locale}/about", 'label' => __('site.nav.about')],
        ['href' => "/{$locale}/news", 'label' => __('site.nav.news')],
        ['href' => "/{$locale}/services", 'label' => __('site.nav.services')],
        ['href' => "/{$locale}/vacancies", 'label' => __('site.nav.vacancies')],
        ['href' => "/{$locale}/documents", 'label' => __('site.nav.documents')],
        ['href' => "/{$locale}/contact", 'label' => __('site.nav.contact')],
    ];
@endphp

<header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 shadow-[0_10px_30px_-16px_rgba(8,27,59,0.35)] backdrop-blur">
    <div class="bg-[linear-gradient(90deg,#142756_0%,#193e8d_100%)] text-brand-100">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-1.5 text-xs">
            <div class="hidden items-center gap-4 sm:flex">
                <span>{{ __('site.contact.phone') }}</span>
                <span>{{ __('site.contact.email') }}</span>
            </div>
            <span class="truncate text-brand-200">{{ __('site.region') }}</span>
            <div class="flex items-center gap-2">
                <a href="/admin/login" class="rounded-full border border-white/20 bg-white/10 px-3 py-1.5 font-semibold text-white transition hover:bg-white/20">
                    {{ __('site.nav.admin_login') }}
                </a>
                <div class="flex items-center gap-1">
                    @foreach (['aa', 'en', 'am'] as $code)
                        <a href="/{{ $code }}/{{ $restPath }}"
                           class="rounded-full px-2 py-1 text-xs font-semibold uppercase {{ $locale === $code ? 'bg-white text-brand-900' : 'text-white/80 hover:bg-white/10' }}">
                            {{ $code }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="border-b border-slate-200/70 bg-white text-slate-800">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3">
            <a href="/{{ $locale }}" class="flex items-center gap-3">
                <img src="/logo.png" alt="{{ __('site.site_name_short') }}" class="h-11 w-11 shrink-0 rounded-full bg-white object-cover">
                <span class="max-w-md text-sm font-bold leading-snug text-brand-900 sm:text-base">
                    {{ __('site.site_name') }}
                </span>
            </a>

            <nav class="hidden items-center gap-1 lg:flex">
                @foreach ($navItems as $item)
                    <a href="{{ $item['href'] }}"
                       class="rounded-full px-3 py-2 text-sm font-medium transition {{ request()->is(ltrim($item['href'], '/').'*') ? 'bg-brand-50 text-brand-800' : 'text-slate-600 hover:bg-slate-100 hover:text-brand-900' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <label for="mobile-menu-toggle" class="cursor-pointer rounded-full p-2 text-slate-700 hover:bg-slate-100 lg:hidden">
                &#9776;
            </label>
        </div>

        <input type="checkbox" id="mobile-menu-toggle" class="peer hidden">
        <nav class="hidden border-t border-slate-200 px-4 pb-4 peer-checked:block lg:hidden">
            @foreach ($navItems as $item)
                <a href="{{ $item['href'] }}"
                   class="block rounded-md px-3 py-2.5 text-sm font-medium {{ request()->is(ltrim($item['href'], '/').'*') ? 'bg-brand-50 text-brand-900' : 'text-slate-700 hover:bg-slate-100' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
    </div>
</header>
