@extends('layouts.app')

@section('title', __('site.about.title'))

@section('content')
    <section class="bg-gradient-to-r from-brand-950 to-accent-950 py-16 text-white">
        <div class="mx-auto max-w-7xl px-4">
            <h1 class="text-4xl font-extrabold">{{ __('site.about.title') }}</h1>
            <p class="mt-4 max-w-3xl leading-relaxed text-brand-100">{{ __('site.about.intro') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16">
        <div class="grid gap-12 lg:grid-cols-2">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">{{ __('site.about.mandate_title') }}</h2>
                <ul class="mt-6 space-y-4">
                    @foreach (__('site.about.mandates') as $mandate)
                        <li class="flex items-start gap-3">
                            <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-accent-600"></span>
                            <span class="text-slate-600">{{ $mandate }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-slate-900">{{ __('site.about.structure_title') }}</h2>
                <div class="mt-6 grid gap-3">
                    @foreach (__('site.about.directorates') as $directorate)
                        <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-4 ring-1 ring-slate-100">
                            <span class="text-sm font-medium text-slate-700">{{ $directorate }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 lg:grid-cols-3">
            <div class="rounded-2xl bg-brand-900 p-8 text-white">
                <h3 class="text-xl font-bold">{{ __('site.vision.vision_title') }}</h3>
                <p class="mt-3 leading-relaxed text-brand-100">{{ __('site.vision.vision_body') }}</p>
            </div>
            <div class="rounded-2xl bg-accent-800 p-8 text-white">
                <h3 class="text-xl font-bold">{{ __('site.vision.mission_title') }}</h3>
                <p class="mt-3 leading-relaxed text-accent-100">{{ __('site.vision.mission_body') }}</p>
            </div>
            <div class="rounded-2xl bg-slate-950 p-8 text-white">
                <h3 class="text-xl font-bold">{{ __('site.vision.values_title') }}</h3>
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
