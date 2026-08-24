@extends('layouts.app')

@section('title', __('site.services.title'))

@php
    $serviceIcons = ['user-cog', 'book-open', 'badge-check', 'refresh-cw', 'scale', 'folder-kanban'];
@endphp

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-r from-brand-950 to-accent-950 py-16 text-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_10%,rgba(255,255,255,0.08),transparent_40%)]"></div>
        <div class="relative mx-auto max-w-7xl px-4">
            <div class="flex items-center gap-3">
                <i data-lucide="layers" class="h-10 w-10 text-accent-400"></i>
                <h1 class="text-4xl font-extrabold">{{ __('site.services.title') }}</h1>
            </div>
            <p class="mt-4 max-w-3xl text-brand-100">{{ __('site.services.subtitle') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 animate-fade-in">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (__('site.services.items') as $index => $item)
                <div class="group rounded-[24px] bg-white p-8 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-2 hover:shadow-[0_18px_36px_-18px_rgba(15,23,42,0.35)]">
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-600 text-white shadow-sm transition group-hover:scale-110">
                        <i data-lucide="{{ $serviceIcons[$index] ?? 'circle' }}" class="h-6 w-6"></i>
                    </span>
                    <h2 class="mt-5 text-lg font-semibold text-slate-900 group-hover:text-brand-700 transition-colors">{{ $item['title'] }}</h2>
                    <p class="mt-3 text-sm leading-relaxed text-slate-500">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
