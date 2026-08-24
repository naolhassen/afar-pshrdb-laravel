@extends('layouts.app')

@php
    $images = $article->imageSlides($locale);
    $paragraphs = $article->bodyParagraphs($locale);
    $firstImage = $images[0] ?? null;
@endphp

@section('title', $article->localized('title', $locale))

@section('content')
    <section class="bg-white pt-12 pb-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <a href="/{{ $locale }}/news" class="inline-flex w-fit items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900">
                <i data-lucide="arrow-left" class="h-4 w-4"></i> {{ __('site.news.back_to_news') }}
            </a>
        </div>
    </section>

    <article class="bg-slate-50 pb-20">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[minmax(0,1fr)_360px] lg:px-8">
            <div class="min-w-0 rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_18px_50px_-32px_rgba(15,23,42,0.45)] sm:p-8 lg:p-10">
                @if (count($images) > 1)
                    <div class="relative mb-10 overflow-hidden rounded-[24px] border border-slate-200 bg-slate-100 shadow-sm" data-news-slider data-images='{{ json_encode($images) }}' data-title="{{ $article->localized('title', $locale) }}" data-placeholder="{{ asset('images/placeholder.svg') }}">
                        <img class="news-slider-img h-[320px] w-full object-cover transition duration-500 sm:h-[440px]" src="{{ $images[0] }}" alt="{{ $article->localized('title', $locale) }}" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                        <button type="button" class="news-slider-prev absolute left-3 top-1/2 z-10 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white/90 text-slate-700 shadow-sm backdrop-blur transition hover:bg-white" aria-label="Previous">
                            <i data-lucide="chevron-left" class="h-5 w-5"></i>
                        </button>
                        <button type="button" class="news-slider-next absolute right-3 top-1/2 z-10 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white/90 text-slate-700 shadow-sm backdrop-blur transition hover:bg-white" aria-label="Next">
                            <i data-lucide="chevron-right" class="h-5 w-5"></i>
                        </button>
                        <div class="news-slider-dots absolute bottom-4 left-1/2 z-10 -translate-x-1/2 flex gap-2"></div>
                    </div>
                @elseif (count($images) === 1)
                    <div class="relative mb-10 h-[320px] overflow-hidden rounded-[24px] border border-slate-200 bg-slate-100 sm:h-[440px]">
                        <img src="{{ $images[0] }}" alt="{{ $article->localized('title', $locale) }}" class="h-full w-full object-cover" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                    </div>
                @endif

                <div class="mb-10">
                    <div class="flex flex-wrap items-center gap-3 text-sm">
                        @if ($article->localized('category', $locale))
                            <span class="inline-flex items-center gap-1 rounded-full bg-brand-100 px-3 py-1 text-xs font-bold text-brand-700 ring-1 ring-brand-200">
                                <i data-lucide="tag" class="h-3 w-3"></i>
                                {{ $article->localized('category', $locale) }}
                            </span>
                        @endif
                        <span class="inline-flex items-center gap-1 text-slate-500">
                            <i data-lucide="calendar" class="h-3.5 w-3.5"></i>
                            {{ $article->date }}
                        </span>
                    </div>
                    <h1 class="mt-5 text-balance text-3xl font-black leading-tight tracking-tight text-slate-900 sm:text-4xl">
                        {{ $article->localized('title', $locale) }}
                    </h1>
                    @if ($article->localized('excerpt', $locale))
                        <p class="mt-4 max-w-3xl text-lg leading-relaxed text-slate-600">
                            {{ $article->localized('excerpt', $locale) }}
                        </p>
                    @endif
                </div>

                @if ($article->video_url && trim($article->video_url) !== '')
                    <div class="mb-10 overflow-hidden rounded-[24px] border border-slate-200 bg-slate-950 shadow-sm aspect-video w-full">
                        <video src="{{ $article->video_url }}" controls playsinline class="h-full w-full object-cover" poster="{{ $article->image_url ?: $firstImage ?: asset('images/placeholder.svg') }}"></video>
                    </div>
                @endif

                <div class="prose prose-slate max-w-none space-y-6 text-[17px] leading-8 text-slate-700">
                    @foreach ($paragraphs as $para)
                        <p>{{ $para }}</p>
                    @endforeach
                </div>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-32 lg:self-start">
                <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_18px_42px_-30px_rgba(15,23,42,0.4)]">
                    <h2 class="text-lg font-bold text-slate-950">{{ __('site.news.title') }}</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">{{ __('site.news.subtitle') }}</p>
                    <a href="/{{ $locale }}/news" class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-brand-700 transition hover:text-brand-900 group">
                        {{ __('site.news.view_all') }} <i data-lucide="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_18px_42px_-30px_rgba(15,23,42,0.4)]">
                    <h2 class="border-b border-slate-200 pb-4 text-lg font-bold text-slate-950">Latest news</h2>
                    <div class="mt-5 space-y-5">
                        @foreach ($latest as $item)
                            <a href="/{{ $locale }}/news/{{ $item->slug }}" class="grid grid-cols-[84px_1fr] gap-4 group">
                                @php
                                    $thumb = $item->imageSlides($locale)[0] ?? asset('images/placeholder.svg');
                                @endphp
                                <span class="relative h-20 overflow-hidden rounded-2xl bg-slate-100">
                                    <img src="{{ $thumb }}" alt="{{ $item->localized('title', $locale) }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                                </span>
                                <span class="min-w-0">
                                    <span class="block text-sm font-bold leading-snug text-slate-900 line-clamp-2 group-hover:text-brand-700">
                                        {{ $item->localized('title', $locale) }}
                                    </span>
                                    <span class="mt-2 block text-xs text-slate-500">{{ $item->date }}</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

                @if ($related->isNotEmpty())
                    <div class="rounded-[28px] border border-slate-200 bg-brand-950 p-6 text-white shadow-[0_18px_42px_-30px_rgba(15,23,42,0.4)]">
                        <h2 class="text-lg font-bold">Related coverage</h2>
                        <div class="mt-5 space-y-4">
                            @foreach ($related as $item)
                                <a href="/{{ $locale }}/news/{{ $item->slug }}" class="block rounded-2xl border border-white/10 bg-white/5 p-4 transition hover:bg-white/10">
                                    <span class="block text-sm font-semibold leading-snug text-white line-clamp-2">
                                        {{ $item->localized('title', $locale) }}
                                    </span>
                                    <span class="mt-2 block text-xs text-white/60">{{ $item->date }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </article>
@endsection
