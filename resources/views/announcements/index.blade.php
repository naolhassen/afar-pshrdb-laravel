@extends('layouts.app')

@php
    $isTenders = $typeSlug === 'tenders';
    $title = $isTenders ? __('site.nav.tenders') : __('site.nav.other_announcements');
@endphp

@section('title', $title)

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => __('site.nav.announcements'),
        'title' => $title,
        'icon' => $isTenders ? 'file-text' : 'megaphone',
    ])

    <section class="mx-auto max-w-7xl px-4 py-14 sm:py-16">
        @if ($items->isEmpty())
            <div class="flex flex-col items-center justify-center rounded-[28px] border border-dashed border-slate-300 bg-white/60 py-20 text-slate-500">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                    <i data-lucide="{{ $isTenders ? 'file-text' : 'megaphone' }}" class="h-7 w-7"></i>
                </span>
                <p class="mt-4 text-lg font-semibold text-slate-600">{{ __('site.common.coming_soon') }}</p>
            </div>
        @else
            <p class="text-sm font-semibold text-slate-400">{{ $items->count() }} {{ strtolower($title) }}</p>

            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($items as $item)
                    @php
                        try {
                            $dt = \Illuminate\Support\Carbon::parse($item->date);
                        } catch (\Throwable $e) {
                            $dt = null;
                        }
                    @endphp
                    <a href="/{{ $locale }}/announcements/{{ $typeSlug }}/{{ $item->slug }}"
                       class="reveal-item group flex h-full flex-col overflow-hidden rounded-[24px] bg-white shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_44px_-24px_rgba(15,23,42,0.4)] hover:ring-brand-200">
                        @if ($item->image_url)
                            <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url }}"
                                     alt="{{ $item->localized('title', $locale) }}"
                                     class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                     onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                                <span class="absolute left-4 top-4 inline-flex items-center gap-1.5 rounded-full bg-black/45 px-3 py-1 text-xs font-semibold text-white backdrop-blur-sm ring-1 ring-white/10 capitalize">
                                    <i data-lucide="{{ $isTenders ? 'file-text' : 'megaphone' }}" class="h-3 w-3"></i>
                                    {{ $typeSlug }}
                                </span>
                            </div>
                        @endif
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex items-start gap-4">
                                <div class="date-block">
                                    <span class="date-day">{{ $dt ? $dt->format('d') : '—' }}</span>
                                    <span class="date-month">{{ $dt ? $dt->format('M Y') : '' }}</span>
                                </div>
                                <h2 class="flex-1 text-base font-bold leading-snug text-slate-900 transition-colors group-hover:text-brand-700 line-clamp-3">
                                    {{ $item->localized('title', $locale) }}
                                </h2>
                            </div>
                            <p class="mt-4 flex-1 line-clamp-3 text-sm leading-relaxed text-slate-500">
                                {{ \Illuminate\Support\Str::limit(implode(' ', $item->localizedParagraphs('body', $locale)), 160) }}
                            </p>
                            <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-brand-700 transition-colors group-hover:text-brand-900">
                                {{ __('site.news.read_more') }}
                                <i data-lucide="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection
