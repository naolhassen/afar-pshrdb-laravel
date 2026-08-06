@extends('layouts.app')

@section('title', __('site.site_name'))

@section('content')
    <section class="relative overflow-hidden bg-[linear-gradient(135deg,#142756_0%,#193e8d_55%,#0f6133_100%)] py-24 text-white">
        <div class="mx-auto max-w-7xl px-4">
            <h1 class="max-w-3xl text-balance text-4xl font-extrabold leading-tight sm:text-5xl">
                {{ __('site.hero.title') }}
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-relaxed text-brand-100">
                {{ __('site.hero.subtitle') }}
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="/{{ $locale }}/services" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-brand-900 shadow-lg transition hover:bg-brand-50">
                    {{ __('site.hero.cta_services') }}
                </a>
                <a href="/{{ $locale }}/contact" class="rounded-full border border-white/40 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                    {{ __('site.hero.cta_contact') }}
                </a>
            </div>
        </div>
    </section>

    <section class="relative z-20 mx-auto -mt-9 max-w-5xl px-4">
        <div class="rounded-[28px] border border-slate-200 bg-white p-4 shadow-[0_18px_36px_-24px_rgba(15,23,42,0.45)] lg:p-5">
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ($stats as $stat)
                    <div class="flex items-center gap-4 rounded-[18px] border border-slate-200/80 bg-white p-4">
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
        <div class="grid items-center gap-8 rounded-[28px] border border-accent-100 bg-accent-50/40 p-8 lg:grid-cols-[1.05fr_1.95fr] lg:p-12">
            <div class="flex justify-center lg:justify-start">
                <div class="relative mx-auto flex aspect-square max-w-xs items-center justify-center overflow-hidden rounded-full border border-white/70 bg-gradient-to-br from-brand-100 to-accent-100 shadow-[0_22px_40px_-18px_rgba(17,49,115,0.55)]">
                    @if ($head)
                        <img src="{{ $head['image'] }}" alt="{{ $head['name'] }}" class="h-full w-full object-cover">
                    @endif
                </div>
            </div>
            <div>
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
                <a href="/{{ $locale }}/news" class="text-sm font-semibold text-brand-700 hover:text-brand-900">
                    {{ __('site.news.view_all') }}
                </a>
            </div>

            <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($latestNews as $item)
                    <a href="/{{ $locale }}/news/{{ $item->slug }}" class="block overflow-hidden rounded-[20px] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        @if ($item->image_url)
                            <div class="relative h-48 w-full overflow-hidden">
                                <img src="{{ $item->image_url }}" alt="{{ $item->localized('title', $locale) }}" class="h-full w-full object-cover">
                            </div>
                        @else
                            <div class="flex h-48 items-center justify-center bg-gradient-to-br from-brand-800 to-accent-800">
                                <span class="px-3 py-1 text-xs font-semibold text-white">{{ $item->localized('category', $locale) }}</span>
                            </div>
                        @endif
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
            <div class="mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach (array_slice(__('site.services.items'), 0, 6) as $item)
                    <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-[0_10px_24px_-18px_rgba(15,23,42,0.35)] transition-all duration-200 hover:-translate-y-1">
                        <h3 class="mt-1 text-lg font-semibold text-slate-900">{{ $item['title'] }}</h3>
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
            <div class="rounded-[24px] border border-blue-200 bg-gradient-to-br from-blue-100 via-sky-50 to-cyan-100 p-8 text-slate-900">
                <h3 class="text-xl font-bold">{{ __('site.vision.vision_title') }}</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ __('site.vision.vision_body') }}</p>
            </div>
            <div class="rounded-[24px] border border-emerald-200 bg-gradient-to-br from-emerald-100 via-green-50 to-lime-100 p-8 text-slate-900">
                <h3 class="text-xl font-bold">{{ __('site.vision.mission_title') }}</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ __('site.vision.mission_body') }}</p>
            </div>
            <div class="rounded-[24px] border border-rose-200 bg-gradient-to-br from-rose-100 via-red-50 to-orange-100 p-8 text-slate-900">
                <h3 class="text-xl font-bold">{{ __('site.vision.values_title') }}</h3>
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
                    <div class="mx-auto mb-4 h-40 w-40 overflow-hidden rounded-full border border-slate-200 bg-gradient-to-br from-brand-100 to-accent-100">
                        <img src="{{ $leader['image'] }}" alt="{{ $leader['name'] }}" class="h-full w-full object-cover">
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
                {{ __('site.hero.cta_contact') }}
            </a>
        </div>
    </section>
@endsection
