@extends('layouts.app')

@section('title', $vacancy->localized('title', $locale))

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-r from-brand-950 to-accent-950 py-16 text-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_10%,rgba(255,255,255,0.08),transparent_40%)]"></div>
        <div class="relative mx-auto max-w-4xl px-4">
            <a href="{{ route('vacancies', ['locale' => $locale]) }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-brand-100 backdrop-blur-sm transition hover:bg-white/20">
                <i data-lucide="arrow-left" class="h-4 w-4"></i> Back to vacancies
            </a>

            <div class="mt-6 flex flex-wrap items-center gap-3 text-sm">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-600 px-3 py-1 text-xs font-semibold">
                    <i data-lucide="briefcase" class="h-3 w-3"></i> {{ __('site.nav.vacancies') }}
                </span>
                @if ($vacancy->deadline)
                    <span class="flex items-center gap-1.5 text-brand-200">
                        <i data-lucide="calendar-clock" class="h-3.5 w-3.5"></i>
                        {{ $vacancy->deadline }}
                    </span>
                @endif
            </div>

            <h1 class="mt-5 text-balance text-3xl font-extrabold leading-tight sm:text-4xl">
                {{ $vacancy->localized('title', $locale) }}
            </h1>
        </div>
    </section>

    <article class="mx-auto max-w-4xl px-4 py-14 animate-fade-in">
        <div class="rounded-[28px] border border-slate-200 bg-white p-8 shadow-[0_18px_42px_-30px_rgba(15,23,42,0.35)]">
            @if ($vacancy->image_url)
                <div class="relative -mx-8 -mt-8 mb-8 aspect-[16/9] w-[calc(100%+4rem)] overflow-hidden rounded-t-[28px] bg-slate-100">
                    <img src="{{ $vacancy->image_url }}" alt="{{ $vacancy->localized('title', $locale) }}" class="h-full w-full object-cover" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.svg') }}';">
                </div>
            @endif

            <div class="space-y-6 leading-relaxed text-slate-700">
                @foreach ($vacancy->localizedParagraphs('description', $locale) as $para)
                    <p>{{ $para }}</p>
                @endforeach
            </div>

            @php $requirements = $vacancy->localizedParagraphs('requirements', $locale); @endphp
            @if (count($requirements) > 0)
                <div class="mt-10 rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <h2 class="mb-4 inline-flex items-center gap-2 text-lg font-bold text-slate-900">
                        <i data-lucide="clipboard-list" class="h-5 w-5 text-accent-600"></i>
                        Requirements
                    </h2>
                    <ul class="space-y-3 text-slate-700">
                        @foreach ($requirements as $req)
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="mt-0.5 h-4 w-4 shrink-0 text-emerald-500"></i>
                                <span>{{ $req }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between rounded-2xl bg-gradient-to-r from-brand-50 to-slate-50 p-6 ring-1 ring-brand-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Interested in this position?</h3>
                    <p class="text-sm text-slate-600">Reach out through the contact page to apply or request more details.</p>
                </div>
                <a href="{{ route('contact', ['locale' => $locale]) }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-brand-700 px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-brand-800 hover:shadow-lg">
                    <i data-lucide="send" class="h-4 w-4"></i>
                    Contact to Apply
                </a>
            </div>
        </div>
    </article>
@endsection
