@extends('layouts.app')

@section('title', $item->localized('title', $locale))

@section('content')
    <section class="bg-gradient-to-r from-brand-950 to-accent-950 py-16 text-white">
        <div class="mx-auto max-w-4xl px-4">
            <a href="/{{ $locale }}/announcements/{{ $typeSlug }}" class="inline-flex items-center gap-2 text-sm font-medium text-brand-200 transition hover:text-white">
                &larr; Back to announcements
            </a>
            <div class="mt-6 flex flex-wrap items-center gap-3 text-sm">
                <span class="rounded-full bg-accent-600 px-3 py-1 text-xs font-semibold capitalize">{{ $typeSlug }}</span>
                <span class="text-brand-200">{{ $item->date }}</span>
            </div>
            <h1 class="mt-4 text-balance text-3xl font-extrabold leading-tight sm:text-4xl">
                {{ $item->localized('title', $locale) }}
            </h1>
        </div>
    </section>

    <article class="mx-auto max-w-4xl px-4 py-14">
        @if ($item->image_url)
            <div class="mb-8 overflow-hidden rounded-xl shadow-sm">
                <img src="{{ $item->image_url }}" alt="{{ $item->localized('title', $locale) }}" class="h-auto w-full object-cover">
            </div>
        @endif
        @if ($item->video_url)
            <div class="mb-8 overflow-hidden rounded-xl shadow-sm">
                <video src="{{ $item->video_url }}" controls class="h-auto w-full" poster="{{ $item->image_url }}"></video>
            </div>
        @endif
        <div class="space-y-6">
            @foreach ($item->localizedParagraphs('body', $locale) as $para)
                <p class="leading-relaxed text-slate-600">{{ $para }}</p>
            @endforeach
        </div>
    </article>
@endsection
