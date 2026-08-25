@extends('layouts.app')

@section('title', __('site.services.title'))

@php
    $serviceIcons = ['user-cog', 'book-open', 'badge-check', 'refresh-cw', 'scale', 'folder-kanban'];
@endphp

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => __('site.nav.services'),
        'title' => __('site.services.title'),
        'subtitle' => __('site.services.subtitle'),
        'icon' => 'layers',
    ])

    <section class="mx-auto max-w-7xl px-4 py-14 sm:py-16">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (__('site.services.items') as $index => $item)
                <div class="reveal-item group flex h-full flex-col rounded-[24px] bg-white p-8 shadow-sm ring-1 ring-slate-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_18px_36px_-18px_rgba(15,23,42,0.35)] hover:ring-brand-200">
                    <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 text-white shadow-md transition group-hover:scale-110">
                        <i data-lucide="{{ $serviceIcons[$index] ?? 'circle' }}" class="h-6 w-6"></i>
                    </span>
                    <h2 class="mt-6 text-lg font-semibold text-slate-900 group-hover:text-brand-700 transition-colors">{{ $item['title'] }}</h2>
                    <p class="mt-3 flex-1 text-sm leading-relaxed text-slate-500">{{ $item['desc'] }}</p>
                    <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-brand-700 transition group-hover:translate-x-1">
                        {{ __('site.news.read_more') }} <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </span>
                </div>
            @endforeach
        </div>
    </section>
@endsection
