@extends('layouts.app')

@section('title', $item->localized('title', $locale))

@section('content')
    <article class="mx-auto max-w-4xl px-4 py-12 sm:py-14 animate-fade-in">
        <a href="/{{ $locale }}/announcements/{{ $typeSlug }}"
           class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-brand-700 shadow-sm ring-1 ring-slate-200 transition hover:-translate-x-0.5 hover:bg-brand-50 hover:text-brand-900">
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            {{ $typeSlug === 'tenders' ? __('site.nav.tenders') : __('site.nav.other_announcements') }}
        </a>

        <header class="mt-8">
            <div class="flex flex-wrap items-center gap-3 text-sm">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-accent-50 px-3 py-1 text-xs font-bold capitalize text-accent-700 ring-1 ring-accent-200">
                    <i data-lucide="{{ $typeSlug === 'tenders' ? 'file-text' : 'megaphone' }}" class="h-3 w-3"></i>
                    {{ $typeSlug }}
                </span>
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500">
                    <i data-lucide="calendar" class="h-3.5 w-3.5"></i>
                    {{ $item->date }}
                </span>
            </div>
            <h1 class="mt-4 text-balance text-3xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-4xl">
                {{ $item->localized('title', $locale) }}
            </h1>
            <div class="tricolor-rule mt-5" aria-hidden="true"></div>
        </header>

        <div class="mt-8 overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-[0_18px_42px_-30px_rgba(15,23,42,0.35)]">
            @if ($item->image_url)
                <img src="{{ $item->image_url }}"
                     alt="{{ $item->localized('title', $locale) }}"
                     class="max-h-[480px] w-full object-cover"
                     onerror="this.onerror=null; this.remove();">
            @endif
            <div class="space-y-6 p-8 text-[15px] leading-relaxed text-slate-700 sm:p-10">
                @foreach ($item->localizedParagraphs('body', $locale) as $para)
                    <p>{{ $para }}</p>
                @endforeach
            </div>
        </div>
    </article>
@endsection
