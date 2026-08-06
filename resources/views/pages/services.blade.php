@extends('layouts.app')

@section('title', __('site.services.title'))

@section('content')
    <section class="bg-gradient-to-r from-brand-950 to-accent-950 py-16 text-white">
        <div class="mx-auto max-w-7xl px-4">
            <h1 class="text-4xl font-extrabold">{{ __('site.services.title') }}</h1>
            <p class="mt-4 max-w-3xl text-brand-100">{{ __('site.services.subtitle') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (__('site.services.items') as $item)
                <div class="group rounded-2xl bg-white p-8 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
                    <h2 class="mt-2 text-lg font-semibold text-slate-900">{{ $item['title'] }}</h2>
                    <p class="mt-3 text-sm leading-relaxed text-slate-500">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
