@extends('layouts.app')

@php
    $images = $article->imageSlides($locale);
    $paragraphs = $article->bodyParagraphs($locale);
@endphp

@section('title', $article->localized('title', $locale))

@section('content')
    <section class="relative overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0">
            @if ($article->image_url)
                <img src="{{ $article->image_url }}" alt="{{ $article->localized('title', $locale) }}" class="h-full w-full object-cover">
            @else
                <div class="absolute inset-0 bg-[linear-gradient(120deg,#142756_0%,#193e8d_45%,#0f6133_100%)]"></div>
            @endif
            <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(5,15,31,0.76)_0%,rgba(5,15,31,0.48)_48%,rgba(5,15,31,0.16)_100%)]"></div>
            <div class="absolute inset-0 bg-[linear-gradient(to_top,rgba(5,15,31,0.78)_0%,rgba(5,15,31,0.08)_68%)]"></div>
        </div>

        <div class="relative z-10 mx-auto flex min-h-[420px] max-w-7xl flex-col justify-end px-4 pb-14 pt-24 sm:px-6 lg:px-8">
            <a href="/{{ $locale }}/news" class="mb-8 inline-flex w-fit items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/20">
                &larr; {{ __('site.news.back_to_news') }}
            </a>

            <div class="max-w-4xl">
                <div class="flex flex-wrap items-center gap-3 text-sm">
                    <span class="rounded bg-brand-600 px-3 py-1.5 text-xs font-bold uppercase tracking-[0.14em] text-white">
                        {{ $article->localized('category', $locale) }}
                    </span>
                    <span class="text-white/80">{{ $article->date }}</span>
                </div>
                <h1 class="mt-5 text-balance text-4xl font-black leading-[1.08] tracking-tight sm:text-5xl">
                    {{ $article->localized('title', $locale) }}
                </h1>
                <p class="mt-6 max-w-3xl text-lg leading-8 text-white/80">
                    {{ $article->localized('excerpt', $locale) }}
                </p>
            </div>
        </div>
    </section>

    <article class="bg-slate-50">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 lg:grid-cols-[minmax(0,1fr)_360px] lg:px-8">
            <div class="min-w-0 rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_18px_50px_-32px_rgba(15,23,42,0.45)] sm:p-8 lg:p-10">
                @if (count($images) > 1)
                    <div class="mb-10 grid gap-4 sm:grid-cols-2">
                        @foreach ($images as $img)
                            <div class="relative h-56 overflow-hidden rounded-[20px] border border-slate-200 bg-slate-100">
                                <img src="{{ $img }}" alt="{{ $article->localized('title', $locale) }}" class="h-full w-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @elseif (count($images) === 1)
                    <div class="relative mb-10 h-[320px] overflow-hidden rounded-[24px] border border-slate-200 bg-slate-100 sm:h-[440px]">
                        <img src="{{ $images[0] }}" alt="{{ $article->localized('title', $locale) }}" class="h-full w-full object-cover">
                    </div>
                @endif

                @if ($article->video_url)
                    <div class="mb-10 overflow-hidden rounded-[24px] border border-slate-200 bg-slate-950 shadow-sm">
                        <video src="{{ $article->video_url }}" controls class="h-full w-full" poster="{{ $article->image_url }}"></video>
                    </div>
                @endif

                <div class="space-y-6 text-[17px] leading-8 text-slate-700">
                    @foreach ($paragraphs as $para)
                        <p>{{ $para }}</p>
                    @endforeach
                </div>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-32 lg:self-start">
                <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_18px_42px_-30px_rgba(15,23,42,0.4)]">
                    <h2 class="text-lg font-bold text-slate-950">{{ __('site.news.title') }}</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">{{ __('site.news.subtitle') }}</p>
                    <a href="/{{ $locale }}/news" class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-brand-700 transition hover:text-brand-900">
                        {{ __('site.news.view_all') }}
                    </a>
                </div>

                <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_18px_42px_-30px_rgba(15,23,42,0.4)]">
                    <h2 class="border-b border-slate-200 pb-4 text-lg font-bold text-slate-950">Latest news</h2>
                    <div class="mt-5 space-y-5">
                        @foreach ($latest as $item)
                            <a href="/{{ $locale }}/news/{{ $item->slug }}" class="grid grid-cols-[84px_1fr] gap-4 group">
                                <span class="relative h-20 overflow-hidden rounded-2xl bg-slate-100">
                                    @if ($item->image_url)
                                        <img src="{{ $item->image_url }}" alt="{{ $item->localized('title', $locale) }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                    @else
                                        <span class="absolute inset-0 bg-[linear-gradient(120deg,#142756_0%,#0f6133_100%)]"></span>
                                    @endif
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
