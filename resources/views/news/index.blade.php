@extends('layouts.app')

@section('title', __('site.news.title'))

@section('content')
    <section class="bg-gradient-to-r from-brand-950 to-accent-950 py-16 text-white">
        <div class="mx-auto max-w-7xl px-4">
            <h1 class="text-4xl font-extrabold">{{ __('site.news.title') }}</h1>
            <p class="mt-4 text-brand-100">{{ __('site.news.subtitle') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 animate-fade-in">
            @forelse ($articles as $item)
                @php
                    $cover = $item->imageSlides($locale)[0] ?? asset('images/placeholder.svg');
                    $category = $item->localized('category', $locale);
                @endphp
                <a href="/{{ $locale }}/news/{{ $item->slug }}" class="group flex flex-col overflow-hidden rounded-[24px] bg-white shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1.5 hover:shadow-xl">
                    <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-100">
                        <img src="{{ $cover }}"
                             alt="{{ $item->localized('title', $locale) }}"
                             class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                        @if ($category)
                            <span class="absolute left-4 top-4 inline-flex items-center gap-1 rounded-full bg-black/45 px-3 py-1 text-xs font-semibold text-white backdrop-blur-sm ring-1 ring-white/10">
                                <i data-lucide="tag" class="h-3 w-3"></i>
                                {{ $category }}
                            </span>
                        @endif
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <div class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-400">
                            <i data-lucide="calendar" class="h-3.5 w-3.5"></i>
                            {{ $item->date }}
                        </div>
                        <h2 class="mt-3 flex-1 text-lg font-bold leading-snug text-slate-900 group-hover:text-brand-700 transition-colors line-clamp-2">
                            {{ $item->localized('title', $locale) }}
                        </h2>
                        <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-slate-500">{{ $item->localized('excerpt', $locale) }}</p>
                        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-accent-700 group-hover:text-brand-700 transition-colors">
                            {{ __('site.news.read_more') }} <i data-lucide="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1"></i>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 text-slate-500">
                    <i data-lucide="inbox" class="h-12 w-12 text-slate-300"></i>
                    <p class="mt-3 text-lg font-medium">{{ __('site.common.coming_soon') }}</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
