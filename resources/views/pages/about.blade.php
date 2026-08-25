@extends('layouts.app')

@section('title', __('site.about.title'))

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-950 to-slate-900 py-20 text-white lg:py-28">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_85%_20%,rgba(255,255,255,0.06),transparent_45%)]"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-[radial-gradient(circle_at_100%_0%,rgba(20,184,166,0.08),transparent_50%)]"></div>
        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-1.5 text-sm font-semibold text-brand-100 backdrop-blur-sm">
                        <i data-lucide="landmark" class="h-4 w-4 text-accent-400"></i>
                        {{ __('site.nav.about') }}
                    </div>
                    <h1 class="mt-5 text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                        {{ __('site.about.title') }}
                    </h1>
                    <p class="mt-6 text-balance text-lg leading-relaxed text-brand-100 sm:text-xl">
                        {{ __('site.about.intro') }}
                    </p>
                    <a href="/{{ $locale }}/contact" class="mt-8 inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-brand-950 shadow-lg transition hover:-translate-y-0.5 hover:bg-slate-50">
                        {{ __('site.contact.title') }} <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </a>
                </div>
                <div class="relative mx-auto w-full max-w-sm lg:max-w-md">
                    <div class="absolute -inset-4 rounded-full bg-gradient-to-br from-brand-500/20 to-accent-500/20 blur-2xl"></div>
                    <div class="relative flex aspect-square items-center justify-center overflow-hidden rounded-full border-4 border-white/10 bg-white p-8 shadow-2xl sm:p-10">
                        <img src="/logo.png" alt="{{ __('site.site_name_short') }} emblem" class="h-auto w-full rounded-full object-contain">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-16 lg:grid-cols-2">
                <div>
                    <div class="mb-8 border-b border-slate-100 pb-4">
                        <h2 class="inline-flex items-center gap-3 text-2xl font-bold text-slate-900 sm:text-3xl">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-brand-100 text-brand-700">
                                <i data-lucide="target" class="h-5 w-5"></i>
                            </span>
                            {{ __('site.about.mandate_title') }}
                        </h2>
                    </div>
                    @php
                        $activityIcons = ['users', 'graduation-cap', 'file-warning', 'clipboard-check', 'settings', 'scale', 'chart-line'];
                    @endphp
                    <ul class="grid gap-5">
                        @foreach (__('site.about.mandates') as $mandate)
                            <li class="flex items-start gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-5 transition hover:-translate-y-0.5 hover:bg-white hover:shadow-md">
                                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white shadow-sm">
                                    <i data-lucide="{{ $activityIcons[$loop->index % count($activityIcons)] }}" class="h-4 w-4 text-brand-600"></i>
                                </span>
                                <span class="leading-relaxed text-slate-700">{{ $mandate }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <div class="mb-8 border-b border-slate-100 pb-4">
                        <h2 class="inline-flex items-center gap-3 text-2xl font-bold text-slate-900 sm:text-3xl">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-accent-100 text-accent-700">
                                <i data-lucide="sitemap" class="h-5 w-5"></i>
                            </span>
                            {{ __('site.about.structure_title') }}
                        </h2>
                    </div>
                    <ul class="grid gap-4">
                        @foreach (__('site.about.directorates') as $directorate)
                            <li class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-slate-50 p-4 transition hover:-translate-y-0.5 hover:bg-white hover:shadow-md">
                                <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-brand-500 shadow-sm">
                                    <i data-lucide="building-2" class="h-4 w-4"></i>
                                </span>
                                <span class="text-sm font-medium leading-relaxed text-slate-700">{{ $directorate }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-3xl font-extrabold text-slate-900 sm:text-4xl">
                    {{ __('site.vision.vision_title') }}, {{ __('site.vision.mission_title') }} &amp; {{ __('site.vision.values_title') }}
                </h2>
            </div>
            <div class="mt-14 grid gap-8 lg:grid-cols-3">
                <div class="relative overflow-hidden rounded-[28px] bg-brand-900 p-8 text-white shadow-[0_18px_36px_-20px_rgba(30,64,175,0.45)] transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/5"></div>
                    <i data-lucide="eye" class="h-10 w-10 text-blue-200"></i>
                    <h3 class="mt-6 text-2xl font-bold">{{ __('site.vision.vision_title') }}</h3>
                    <p class="mt-4 text-balance leading-relaxed text-brand-100">{{ __('site.vision.vision_body') }}</p>
                </div>

                <div class="relative overflow-hidden rounded-[28px] bg-accent-800 p-8 text-white shadow-[0_18px_36px_-20px_rgba(6,95,70,0.45)] transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/5"></div>
                    <i data-lucide="compass" class="h-10 w-10 text-emerald-200"></i>
                    <h3 class="mt-6 text-2xl font-bold">{{ __('site.vision.mission_title') }}</h3>
                    <div class="mt-4 space-y-4">
                        @php
                            $missionSentences = preg_split('/\.\s+/', trim(__('site.vision.mission_body')), -1, PREG_SPLIT_NO_EMPTY);
                        @endphp
                        @foreach ($missionSentences as $sentence)
                            <p class="text-balance leading-relaxed text-accent-100">{{ rtrim($sentence, '. ') }}.</p>
                        @endforeach
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-[28px] bg-slate-950 p-8 text-white shadow-[0_18px_36px_-20px_rgba(15,23,42,0.55)] transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/5"></div>
                    <i data-lucide="heart" class="h-10 w-10 text-rose-200"></i>
                    <h3 class="mt-6 text-2xl font-bold">{{ __('site.vision.values_title') }}</h3>
                    @php
                        $valueIcons = ['heart', 'scale', 'award', 'users', 'zap'];
                    @endphp
                    <ul class="mt-6 space-y-4">
                        @foreach (__('site.vision.values') as $value)
                            <li class="flex items-start gap-4 rounded-xl bg-white/5 p-4 transition hover:-translate-y-0.5 hover:bg-white/10">
                                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/10 text-accent-300">
                                    <i data-lucide="{{ $valueIcons[$loop->index % count($valueIcons)] }}" class="h-4 w-4"></i>
                                </span>
                                <span class="font-medium leading-relaxed text-slate-100">{{ $value }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
