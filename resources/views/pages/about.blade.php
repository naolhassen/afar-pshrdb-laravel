@extends('layouts.app')

@section('title', __('site.about.title'))

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-r from-brand-950 to-accent-950 py-16 text-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_10%,rgba(255,255,255,0.08),transparent_40%)]"></div>
        <div class="relative mx-auto max-w-7xl px-4">
            <div class="flex items-center gap-3">
                <i data-lucide="landmark" class="h-10 w-10 text-accent-400"></i>
                <h1 class="text-4xl font-extrabold">{{ __('site.about.title') }}</h1>
            </div>
            <p class="mt-4 max-w-3xl leading-relaxed text-brand-100">{{ __('site.about.intro') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 animate-fade-in">
        <div class="grid gap-12 lg:grid-cols-2">
            <div>
                <h2 class="inline-flex items-center gap-2 text-2xl font-bold text-slate-900">
                    <i data-lucide="target" class="h-6 w-6 text-accent-600"></i>
                    {{ __('site.about.mandate_title') }}
                </h2>
                <ul class="mt-6 space-y-4">
                    @foreach (__('site.about.mandates') as $mandate)
                        <li class="flex items-start gap-3">
                            <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-accent-600"></span>
                            <span class="text-slate-600 leading-relaxed">{{ $mandate }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="inline-flex items-center gap-2 text-2xl font-bold text-slate-900">
                    <i data-lucide="sitemap" class="h-6 w-6 text-brand-600"></i>
                    {{ __('site.about.structure_title') }}
                </h2>
                <div class="mt-6 grid gap-3">
                    @foreach (__('site.about.directorates') as $directorate)
                        <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-4 ring-1 ring-slate-100 transition hover:bg-white hover:shadow-md">
                            <i data-lucide="building-2" class="h-4 w-4 text-brand-500"></i>
                            <span class="text-sm font-medium text-slate-700">{{ $directorate }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 lg:grid-cols-3 animate-fade-in">
            <div class="rounded-[24px] bg-brand-900 p-8 text-white shadow-[0_18px_36px_-20px_rgba(30,64,175,0.45)]">
                <i data-lucide="eye" class="h-8 w-8 text-blue-200"></i>
                <h3 class="mt-4 text-xl font-bold">{{ __('site.vision.vision_title') }}</h3>
                <p class="mt-3 leading-relaxed text-brand-100">{{ __('site.vision.vision_body') }}</p>
            </div>
            <div class="rounded-[24px] bg-accent-800 p-8 text-white shadow-[0_18px_36px_-20px_rgba(6,95,70,0.45)]">
                <i data-lucide="compass" class="h-8 w-8 text-emerald-200"></i>
                <h3 class="mt-4 text-xl font-bold">{{ __('site.vision.mission_title') }}</h3>
                <p class="mt-3 leading-relaxed text-accent-100">{{ __('site.vision.mission_body') }}</p>
            </div>
            <div class="rounded-[24px] bg-slate-950 p-8 text-white shadow-[0_18px_36px_-20px_rgba(15,23,42,0.55)]">
                <i data-lucide="heart" class="h-8 w-8 text-rose-200"></i>
                <h3 class="mt-4 text-xl font-bold">{{ __('site.vision.values_title') }}</h3>
                <ul class="mt-4 space-y-3 text-brand-100">
                    @foreach (__('site.vision.values') as $value)
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2.5 w-2.5 rounded-full bg-accent-400"></span>
                            <span>{{ $value }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection
