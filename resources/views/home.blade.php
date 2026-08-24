@extends('layouts.app')

@section('title', __('site.site_name'))

@section('content')
    <section
        id="home-hero"
        class="relative w-full overflow-hidden bg-slate-900"
        data-slides="{{ json_encode($heroSlides, JSON_HEX_APOS | JSON_HEX_QUOT) }}"
        data-locale="{{ $locale }}"
        data-fallback-href="/{{ $locale }}/news"
        data-site-name-short="{{ __('site.site_name_short') }}"
    >
        <div id="hero-bg-layer" class="absolute inset-0"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(6,16,32,0.82)_0%,rgba(6,16,32,0.52)_42%,rgba(6,16,32,0.18)_100%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_top,rgba(6,16,32,0.78)_0%,rgba(6,16,32,0)_58%)]"></div>

        <div class="relative z-10 mx-auto flex min-h-[500px] max-w-7xl flex-col justify-between px-4 pb-7 pt-[4.5rem] sm:px-6 sm:pt-24 lg:min-h-[640px] lg:px-8 lg:pb-10 lg:pt-32">
            <div class="max-w-xl">
                <div class="flex flex-wrap items-center gap-3">
                    <span id="hero-category" class="rounded bg-brand-600 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.12em] text-white"></span>
                    <span id="hero-date" class="text-xs font-medium text-white/75"></span>
                </div>
                <h1 class="mt-4 text-lg font-extrabold leading-[1.15] tracking-tight text-white sm:text-xl lg:text-2xl">
                    <a id="hero-title-link" href="#" class="line-clamp-3 transition hover:text-white/85"></a>
                </h1>
                <a id="hero-readmore-link" href="#" class="mt-6 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.16em] text-white">
                    <span>{{ __('site.news.read_more') }}</span>
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div id="hero-thumbs" class="mx-auto mt-12 grid w-full max-w-5xl gap-3 sm:grid-cols-2 lg:grid-cols-3"></div>
        </div>

        <div id="hero-arrows" class="absolute right-4 top-1/2 z-20 hidden -translate-y-1/2 flex-col gap-2 lg:flex">
            <button id="hero-prev" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/25 bg-slate-950/50 text-white transition hover:bg-slate-950/80" aria-label="Previous slide">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M11 19l-7-7 7-7"/></svg>
            </button>
            <button id="hero-next" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/25 bg-slate-950/50 text-white transition hover:bg-slate-950/80" aria-label="Next slide">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
            </button>
        </div>
    </section>

    @php
        $statIcons = ['users', 'user-cog', 'user'];
        $statIconClasses = ['bg-blue-50 text-blue-600', 'bg-emerald-50 text-emerald-600', 'bg-fuchsia-50 text-fuchsia-600'];
    @endphp
    <section class="relative z-20 mx-auto -mt-9 max-w-5xl px-4">
        <div class="rounded-[28px] border border-slate-200 bg-white p-4 shadow-[0_18px_36px_-24px_rgba(15,23,42,0.45)] lg:p-5">
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ($stats as $index => $stat)
                    <div class="flex items-center gap-4 rounded-[18px] border border-slate-200/80 bg-white p-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl {{ $statIconClasses[$index] ?? 'bg-slate-100 text-slate-600' }}">
                            <i data-lucide="{{ $statIcons[$index] ?? 'users' }}" class="h-6 w-6"></i>
                        </span>
                        <div>
                            <div class="text-2xl font-extrabold tracking-tight text-slate-900">{{ $stat['value'] }}</div>
                            <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20">
        <div class="grid items-center gap-8 rounded-[28px] border border-brand-200/70 bg-gradient-to-br from-brand-50/80 via-white to-accent-50/80 p-8 shadow-[0_22px_60px_-28px_rgba(14,41,78,0.35)] backdrop-blur-xl lg:grid-cols-[1.05fr_1.95fr] lg:p-12">
            <div class="flex justify-center lg:justify-start">
                <div class="relative mx-auto flex aspect-square max-w-xs items-center justify-center overflow-hidden border border-white/70 bg-gradient-to-br from-brand-100 to-accent-100 p-2 shadow-[0_22px_40px_-18px_rgba(17,49,115,0.55)]">
                    <div class="absolute inset-2 border border-white/40"></div>
                    @if (!empty($head['image']))
                        <img src="{{ $head['image'] }}" alt="{{ $head['name'] }}" class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center">
                            <i data-lucide="user-round" class="h-32 w-32 text-brand-300"></i>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <i data-lucide="quote" class="h-12 w-12 text-emerald-500"></i>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">{{ __('site.message.title') }}</h2>
                <p class="mt-5 text-lg leading-relaxed text-slate-600">{{ __('site.message.body') }}</p>
                <div class="mt-6">
                    <div class="text-xl font-semibold text-slate-900">{{ $head['name'] ?? __('site.message.name') }}</div>
                    <div class="mt-1 text-sm text-slate-500">{{ $head['role'] ?? __('site.message.role') }}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-20">
        <div class="mx-auto max-w-7xl px-4">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">{{ __('site.news.title') }}</h2>
                    <p class="mt-2 text-slate-500">{{ __('site.news.subtitle') }}</p>
                </div>
                <a href="/{{ $locale }}/news" class="inline-flex items-center gap-2 text-sm font-semibold text-brand-700 hover:text-brand-900">
                    {{ __('site.news.view_all') }} <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>
            </div>

            <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($latestNews as $item)
                    @php
                        $thumb = $item->imageSlides($locale)[0] ?? asset('images/placeholder.svg');
                        $category = $item->localized('category', $locale);
                    @endphp
                    <a href="/{{ $locale }}/news/{{ $item->slug }}" class="group flex h-full flex-col overflow-hidden rounded-[20px] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="relative h-48 w-full overflow-hidden bg-slate-100">
                            <img src="{{ $thumb }}" alt="{{ $item->localized('title', $locale) }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                            @if (!$thumb)
                                <div class="absolute inset-0 flex h-full w-full items-center justify-center bg-gradient-to-br from-brand-800 to-accent-800">
                                    <span class="px-3 py-1 text-xs font-semibold text-white">{{ $category ?: 'News' }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-slate-900">{{ $item->localized('title', $locale) }}</h3>
                            <p class="mt-2 line-clamp-3 text-sm text-slate-500">{{ $item->localized('excerpt', $locale) }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-slate-500">{{ __('site.common.coming_soon') }}</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-20">
        <div class="mx-auto max-w-7xl px-4">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-slate-900">{{ __('site.services.title') }}</h2>
                <p class="mt-2 text-slate-500">{{ __('site.services.subtitle') }}</p>
            </div>
            @php
                $serviceIcons = ['user-cog', 'book-open', 'badge-check', 'refresh-cw', 'scale', 'folder-kanban'];
            @endphp
            <div class="mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach (array_slice(__('site.services.items'), 0, 6) as $item)
                    <div class="group rounded-[24px] border border-slate-200 bg-white p-6 shadow-[0_10px_24px_-18px_rgba(15,23,42,0.35)] transition-all duration-200 hover:-translate-y-1 hover:shadow-[0_18px_36px_-20px_rgba(15,23,42,0.4)]">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-600 text-white shadow-sm">
                            <i data-lucide="{{ $serviceIcons[$loop->index] ?? 'circle' }}" class="h-6 w-6"></i>
                        </span>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="/{{ $locale }}/services" class="inline-flex items-center gap-2 rounded-full border border-brand-200 bg-brand-50 px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-100 hover:text-brand-900">
                    {{ __('site.services.view_all') }}
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20">
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="relative overflow-hidden rounded-[24px] border border-blue-200 bg-gradient-to-br from-blue-100 via-sky-50 to-cyan-100 p-8 text-slate-900 shadow-[0_16px_36px_-22px_rgba(37,99,235,0.45)] transition-all duration-300 before:pointer-events-none before:absolute before:inset-0 before:-translate-x-full before:bg-blue-200/60 before:transition-transform before:duration-500 hover:-translate-y-2 hover:border-blue-300 hover:shadow-[0_24px_48px_-20px_rgba(37,99,235,0.55)] hover:before:translate-x-0">
                <i data-lucide="eye" class="h-8 w-8 text-brand-700"></i>
                <h3 class="mt-4 text-xl font-bold">{{ __('site.vision.vision_title') }}</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ __('site.vision.vision_body') }}</p>
            </div>
            <div class="relative overflow-hidden rounded-[24px] border border-emerald-200 bg-gradient-to-br from-emerald-100 via-green-50 to-lime-100 p-8 text-slate-900 shadow-[0_16px_36px_-22px_rgba(16,185,129,0.45)] transition-all duration-300 before:pointer-events-none before:absolute before:inset-0 before:-translate-x-full before:bg-emerald-200/60 before:transition-transform before:duration-500 hover:-translate-y-2 hover:border-emerald-300 hover:shadow-[0_24px_48px_-20px_rgba(16,185,129,0.55)] hover:before:translate-x-0">
                <i data-lucide="target" class="h-8 w-8 text-accent-700"></i>
                <h3 class="mt-4 text-xl font-bold">{{ __('site.vision.mission_title') }}</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ __('site.vision.mission_body') }}</p>
            </div>
            <div class="relative overflow-hidden rounded-[24px] border border-rose-200 bg-gradient-to-br from-rose-100 via-red-50 to-orange-100 p-8 text-slate-900 shadow-[0_16px_36px_-22px_rgba(244,63,94,0.45)] transition-all duration-300 before:pointer-events-none before:absolute before:inset-0 before:-translate-x-full before:bg-rose-200/60 before:transition-transform before:duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-[0_24px_48px_-20px_rgba(244,63,94,0.55)] hover:before:translate-x-0">
                <i data-lucide="heart" class="h-8 w-8 text-flame-500"></i>
                <h3 class="mt-4 text-xl font-bold">{{ __('site.vision.values_title') }}</h3>
                <ul class="mt-3 grid grid-cols-1 gap-2 text-sm text-slate-600">
                    @foreach (__('site.vision.values') as $value)
                        <li class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-accent-600"></span>
                            {{ $value }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-slate-900">{{ __('site.leadership.title') }}</h2>
            <p class="mt-2 text-slate-500">{{ __('site.leadership.subtitle') }}</p>
        </div>
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($leaders as $leader)
                <div class="rounded-[24px] border border-slate-200 bg-white p-6 text-center shadow-sm transition hover:-translate-y-1">
                    <div class="mx-auto mb-4 h-40 w-40 overflow-hidden rounded-full border border-slate-200 bg-gradient-to-br from-brand-100 to-accent-100 shadow-inner">
                        @if ($leader['image'])
                            <img src="{{ $leader['image'] }}" alt="{{ $leader['name'] }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full w-full items-center justify-center">
                                <i data-lucide="user-round" class="h-16 w-16 text-brand-400"></i>
                            </div>
                        @endif
                    </div>
                    <div class="text-base font-semibold text-slate-900">{{ $leader['name'] }}</div>
                    <div class="mt-1 text-sm text-slate-500">{{ $leader['role'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-[linear-gradient(135deg,#142756_0%,#193e8d_50%,#0f6133_100%)] py-16 text-white">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-4 text-center sm:flex-row sm:text-left">
            <div>
                <h2 class="text-2xl font-bold">{{ __('site.contact.subtitle') }}</h2>
                <p class="mt-2 text-brand-100">{{ __('site.contact.address') }} &middot; {{ __('site.contact.phone') }}</p>
            </div>
            <a href="/{{ $locale }}/contact" class="inline-flex shrink-0 items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-brand-900 shadow-lg transition hover:bg-brand-50">
                {{ __('site.hero.cta_contact') }} <i data-lucide="arrow-right" class="h-4 w-4"></i>
            </a>
        </div>
    </section>
@endsection
