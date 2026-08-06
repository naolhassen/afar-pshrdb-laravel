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
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($articles as $item)
                <a href="/{{ $locale }}/news/{{ $item->slug }}" class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
                    @if ($item->image_url)
                        <div class="relative h-40 w-full overflow-hidden">
                            <img src="{{ $item->image_url }}" alt="{{ $item->localized('title', $locale) }}" class="h-full w-full object-cover">
                            <span class="absolute left-4 top-4 rounded-full bg-black/40 px-3 py-1 text-xs font-semibold text-white backdrop-blur-sm">
                                {{ $item->localized('category', $locale) }}
                            </span>
                        </div>
                    @else
                        <div class="flex h-40 items-center justify-center bg-gradient-to-br from-brand-800 to-accent-800">
                            <span class="rounded-full bg-white/15 px-4 py-1 text-xs font-semibold text-white">{{ $item->localized('category', $locale) }}</span>
                        </div>
                    @endif
                    <div class="flex flex-1 flex-col p-6">
                        <div class="text-xs text-slate-400">{{ $item->date }}</div>
                        <h2 class="mt-3 flex-1 text-base font-semibold leading-snug text-slate-900 group-hover:text-brand-700">
                            {{ $item->localized('title', $locale) }}
                        </h2>
                        <p class="mt-2 line-clamp-3 text-sm text-slate-500">{{ $item->localized('excerpt', $locale) }}</p>
                        <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-accent-700">
                            {{ __('site.news.read_more') }}
                        </span>
                    </div>
                </a>
            @empty
                <p class="text-slate-500">{{ __('site.common.coming_soon') }}</p>
            @endforelse
        </div>
    </section>
@endsection
