@extends('layouts.app')

@section('title', __('site.nav.documents'))

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => __('site.nav.documents'),
        'title' => __('site.nav.documents'),
        'icon' => 'files',
    ])

    <main class="min-h-screen bg-slate-50 py-14 sm:py-16">
        <div class="mx-auto max-w-5xl px-4">
            @if ($documents->isEmpty())
                <div class="flex flex-col items-center justify-center rounded-[28px] border border-dashed border-slate-300 bg-white/60 py-20 text-slate-500">
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                        <i data-lucide="files" class="h-7 w-7"></i>
                    </span>
                    <p class="mt-4 text-lg font-semibold text-slate-600">{{ __('site.common.coming_soon') }}</p>
                </div>
            @endif

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($documents as $document)
                    <div class="reveal-item group relative flex h-full flex-col rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg hover:ring-brand-200">
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
