@extends('layouts.app')

@section('title', __('site.nav.documents'))

@section('content')
    <main class="min-h-screen bg-slate-50 py-16">
        <div class="mx-auto max-w-5xl px-4 animate-fade-in">
            <a href="/" class="mb-6 inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-brand-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-brand-50 hover:text-brand-900">
                <i data-lucide="arrow-left" class="h-4 w-4"></i> {{ __('site.common.back_home') }}
            </a>

            <div class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-sm">
                    <i data-lucide="files" class="h-6 w-6"></i>
                </span>
                <h1 class="text-3xl font-extrabold text-brand-900 sm:text-4xl">{{ __('site.nav.documents') }}</h1>
            </div>

            @if ($documents->isEmpty())
                <p class="mt-8 text-lg text-slate-600">{{ __('site.common.coming_soon') }}</p>
            @endif

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($documents as $document)
                    <div class="group relative rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition group-hover:bg-indigo-100 group-hover:text-indigo-700">
                            <i data-lucide="file-text" class="h-6 w-6"></i>
                        </div>

                        @if ($document->category)
                            <span class="mb-3 inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                <i data-lucide="folder" class="h-3 w-3"></i>
                                {{ $document->category }}
                            </span>
                        @endif

                        <h2 class="text-lg font-bold text-slate-900">{{ $document->localized('title', $locale) }}</h2>

                        <div class="mt-3 space-y-2 text-sm leading-relaxed text-slate-600">
                            @foreach ($document->localizedParagraphs('description', $locale) as $para)
                                <p>{{ $para }}</p>
                            @endforeach
                        </div>

                        @if ($document->file_url)
                            <div class="mt-5 grid grid-cols-2 gap-3">
                                <a href="{{ route('documents.download', ['locale' => $locale, 'document' => $document]) }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-brand-700 hover:shadow-md">
                                    <i data-lucide="download" class="h-4 w-4"></i>
                                    Download
                                </a>
                                <a href="{{ route('documents.read', ['locale' => $locale, 'document' => $document]) }}" target="_blank" rel="noreferrer" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-0.5 hover:bg-slate-200 hover:text-slate-900">
                                    <i data-lucide="book-open" class="h-4 w-4"></i>
                                    Read
                                </a>
                            </div>
                        @else
                            <p class="mt-5 text-sm font-semibold text-rose-600">
                                <i data-lucide="file-x" class="inline h-4 w-4"></i> File unavailable
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
