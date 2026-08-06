@extends('layouts.app')

@section('title', $title)

@section('content')
    <main class="min-h-screen bg-slate-50 py-16">
        <div class="mx-auto max-w-4xl px-4">
            <a href="/{{ $locale }}" class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-brand-700 hover:text-brand-900">
                &larr; {{ __('site.common.back_home') }}
            </a>
            <h1 class="text-3xl font-bold text-brand-900 sm:text-4xl">{{ $title }}</h1>
            <div class="mt-8 rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
                @if (count($content) > 0)
                    <div class="space-y-6 text-slate-700">
                        @foreach ($content as $paragraph)
                            <p class="leading-relaxed">{{ $paragraph }}</p>
                        @endforeach
                    </div>
                @else
                    <p class="text-lg text-slate-600">{{ __('site.common.coming_soon') }}</p>
                @endif

                @if ($imageUrl)
                    <div class="mt-8 overflow-hidden rounded-xl shadow-sm">
                        <img src="{{ $imageUrl }}" alt="{{ $title }}" class="h-auto w-full object-cover">
                    </div>
                @endif

                @if ($videoUrl)
                    <div class="mt-8 overflow-hidden rounded-xl shadow-sm">
                        <video src="{{ $videoUrl }}" controls class="h-auto w-full" poster="{{ $imageUrl }}"></video>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
