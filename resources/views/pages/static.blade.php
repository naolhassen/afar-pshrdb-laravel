@extends('layouts.app')

@section('title', $title)

@section('content')
    <main class="min-h-screen bg-slate-50 py-16">
        <div class="mx-auto max-w-4xl px-4 animate-fade-in">
            <a href="/{{ $locale }}" class="mb-6 inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-brand-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-brand-50 hover:text-brand-900">
                <i data-lucide="arrow-left" class="h-4 w-4"></i> {{ __('site.common.back_home') }}
            </a>
            <div class="flex items-center gap-3">
                <i data-lucide="file-text" class="h-8 w-8 text-brand-700"></i>
                <h1 class="text-3xl font-extrabold text-brand-900 sm:text-4xl">{{ $title }}</h1>
            </div>
            <div class="mt-8 rounded-[24px] border border-slate-200 bg-white p-8 shadow-[0_18px_42px_-30px_rgba(15,23,42,0.35)]">
                @if (count($content) > 0)
                    <div class="space-y-6 leading-relaxed text-slate-700">
                        @foreach ($content as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                @else
                    <p class="text-lg text-slate-600">{{ __('site.common.coming_soon') }}</p>
                @endif

                @if ($imageUrl)
                    <div class="mt-8 overflow-hidden rounded-2xl shadow-sm">
                        <img src="{{ $imageUrl }}" alt="{{ $title }}" class="h-auto w-full object-cover">
                    </div>
                @endif

                @if ($videoUrl)
                    <div class="mt-8 overflow-hidden rounded-2xl shadow-sm">
                        <video src="{{ $videoUrl }}" controls class="h-auto w-full" poster="{{ $imageUrl }}"></video>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
