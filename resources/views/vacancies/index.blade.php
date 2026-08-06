@extends('layouts.app')

@section('title', __('site.nav.vacancies'))

@section('content')
    <main class="min-h-screen bg-slate-50 py-16">
        <div class="mx-auto max-w-4xl px-4">
            <a href="/{{ $locale }}" class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-brand-700 hover:text-brand-900">
                &larr; {{ __('site.common.back_home') }}
            </a>
            <h1 class="text-3xl font-bold text-brand-900 sm:text-4xl">{{ __('site.nav.vacancies') }}</h1>

            @if ($vacancies->isEmpty())
                <p class="mt-8 text-lg text-slate-600">{{ __('site.common.coming_soon') }}</p>
            @endif

            <div class="mt-8 space-y-6">
                @foreach ($vacancies as $vacancy)
                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                        <h2 class="text-xl font-bold text-slate-900">{{ $vacancy->localized('title', $locale) }}</h2>
                        @if ($vacancy->deadline)
                            <div class="mt-2 text-sm text-slate-500">Deadline: {{ $vacancy->deadline }}</div>
                        @endif
                        <div class="mt-4 space-y-3">
                            @foreach ($vacancy->localizedParagraphs('description', $locale) as $para)
                                <p class="leading-relaxed text-slate-600">{{ $para }}</p>
                            @endforeach
                        </div>
                        @php $requirements = $vacancy->localizedParagraphs('requirements', $locale); @endphp
                        @if (count($requirements) > 0)
                            <div class="mt-6">
                                <h3 class="font-semibold text-slate-800">Requirements</h3>
                                <ul class="mt-2 list-disc space-y-1 pl-5 text-slate-600">
                                    @foreach ($requirements as $req)
                                        <li>{{ $req }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
