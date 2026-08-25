@extends('layouts.app')

@section('title', __('site.nav.vacancies'))

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => __('site.nav.vacancies'),
        'title' => __('site.nav.vacancies'),
        'icon' => 'briefcase',
    ])

    <main class="min-h-screen bg-slate-50 py-14 sm:py-16">
        <div class="mx-auto max-w-4xl px-4">
            @if ($vacancies->isEmpty())
                <div class="flex flex-col items-center justify-center rounded-[28px] border border-dashed border-slate-300 bg-white/60 py-20 text-slate-500">
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                        <i data-lucide="briefcase" class="h-7 w-7"></i>
                    </span>
                    <p class="mt-4 text-lg font-semibold text-slate-600">{{ __('site.common.coming_soon') }}</p>
                </div>
            @endif

            <div class="space-y-6">
                @foreach ($vacancies as $vacancy)
                    <div class="reveal-item rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg hover:ring-brand-200">
                        @if ($vacancy->image_url)
                            <div class="relative -mx-6 -mt-6 mb-6 aspect-[16/9] w-[calc(100%+3rem)] overflow-hidden rounded-t-[24px] bg-slate-100">
                                <img src="{{ $vacancy->image_url }}" alt="{{ $vacancy->localized('title', $locale) }}" class="h-full w-full object-cover" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                            </div>
                        @endif
                        <div class="flex flex-wrap items-start justify-between gap-4">
                            <h2 class="text-xl font-bold text-slate-900">{{ $vacancy->localized('title', $locale) }}</h2>
                            @if ($vacancy->deadline)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-bold text-rose-700 ring-1 ring-rose-100">
                                    <i data-lucide="calendar-clock" class="h-3.5 w-3.5"></i>
                                    {{ $vacancy->deadline }}
                                </span>
                            @endif
                        </div>
                        <div class="mt-4 space-y-3 leading-relaxed text-slate-600">
                            @foreach ($vacancy->localizedParagraphs('description', $locale) as $para)
                                <p>{{ $para }}</p>
                            @endforeach
                        </div>
                        @php $requirements = $vacancy->localizedParagraphs('requirements', $locale); @endphp
                        @if (count($requirements) > 0)
                            <div class="mt-6">
                                <h3 class="inline-flex items-center gap-2 font-semibold text-slate-800">
                                    <i data-lucide="clipboard-list" class="h-4 w-4 text-accent-600"></i>
                                    Requirements
                                </h3>
                                <ul class="mt-2 space-y-1.5 text-slate-600">
                                    @foreach ($requirements as $req)
                                        <li class="flex items-start gap-2">
                                            <i data-lucide="check" class="mt-1 h-3.5 w-3.5 shrink-0 text-emerald-500"></i>
                                            <span>{{ $req }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mt-6">
                            <a href="{{ route('vacancies.show', ['locale' => $locale, 'slug' => $vacancy->slug]) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-brand-700 transition hover:text-brand-900">
                                View Details <i data-lucide="arrow-right" class="h-4 w-4"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
