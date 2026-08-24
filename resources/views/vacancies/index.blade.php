@extends('layouts.app')

@section('title', __('site.nav.vacancies'))

@section('content')
    <main class="min-h-screen bg-slate-50 py-16">
        <div class="mx-auto max-w-4xl px-4 animate-fade-in">
            <a href="/{{ $locale }}" class="mb-6 inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-brand-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-brand-50 hover:text-brand-900">
                <i data-lucide="arrow-left" class="h-4 w-4"></i> {{ __('site.common.back_home') }}
            </a>
            <div class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-600 text-white shadow-sm">
                    <i data-lucide="briefcase" class="h-6 w-6"></i>
                </span>
                <h1 class="text-3xl font-extrabold text-brand-900 sm:text-4xl">{{ __('site.nav.vacancies') }}</h1>
            </div>

            @if ($vacancies->isEmpty())
                <p class="mt-8 text-lg text-slate-600">{{ __('site.common.coming_soon') }}</p>
            @endif

            <div class="mt-8 space-y-6">
                @foreach ($vacancies as $vacancy)
                    <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
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
