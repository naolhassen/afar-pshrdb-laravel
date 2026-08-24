@extends('layouts.app')

@section('title', $item->localized('title', $locale))

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-r from-brand-950 to-accent-950 py-16 text-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_10%,rgba(255,255,255,0.08),transparent_40%)]"></div>
        <div class="relative mx-auto max-w-4xl px-4">
            <a href="/{{ $locale }}/announcements/{{ $typeSlug }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-brand-100 backdrop-blur-sm transition hover:bg-white/20">
                <i data-lucide="arrow-left" class="h-4 w-4"></i> Back to announcements
            </a>
            <div class="mt-6 flex flex-wrap items-center gap-3 text-sm">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-accent-600 px-3 py-1 text-xs font-semibold capitalize">
                    <i data-lucide="{{ $typeSlug === 'tenders' ? 'file-text' : 'megaphone' }}" class="h-3 w-3"></i>
                    {{ $typeSlug }}
                </span>
                <span class="flex items-center gap-1.5 text-brand-200">
                    <i data-lucide="calendar" class="h-3.5 w-3.5"></i>
                    {{ $item->date }}
                </span>
            </div>
            <h1 class="mt-5 text-balance text-3xl font-extrabold leading-tight sm:text-4xl">
                {{ $item->localized('title', $locale) }}
            </h1>
        </div>
    </section>

    <article class="mx-auto max-w-4xl px-4 py-14 animate-fade-in">
        <div class="rounded-[28px] border border-slate-200 bg-white p-8 shadow-[0_18px_42px_-30px_rgba(15,23,42,0.35)]">
            @if ($item->image_url)
                <div class="mb-8 overflow-hidden rounded-2xl shadow-sm">
                    <img src="{{ $item->image_url }}" alt="{{ $item->localized('title', $locale) }}" class="h-auto w-full object-cover">
                </div>
            @endif
            @if ($item->video_url)
                <div class="mb-8 overflow-hidden rounded-2xl shadow-sm">
                    <video src="{{ $item->video_url }}" controls class="h-auto w-full" poster="{{ $item->image_url }}"></video>
                </div>
            @endif
            <div class="space-y-6 leading-relaxed text-slate-700">
                @foreach ($item->localizedParagraphs('body', $locale) as $para)
                    <p>{{ $para }}</p>
                @endforeach
            </div>
        </div>
    </article>
@endsection
