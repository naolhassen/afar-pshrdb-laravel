@extends('layouts.app')

@section('title', __('site.contact.title'))

@section('content')
    <section class="bg-gradient-to-r from-brand-950 to-accent-950 py-16 text-white">
        <div class="mx-auto max-w-7xl px-4">
            <h1 class="text-4xl font-extrabold">{{ __('site.contact.title') }}</h1>
            <p class="mt-4 text-brand-100">{{ __('site.contact.subtitle') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16">
        <div class="grid gap-12 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">&#128205;</span>
                        <span class="pt-2.5 text-sm text-slate-600">{{ __('site.contact.address') }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">&#128222;</span>
                        <span class="pt-2.5 text-sm text-slate-600">{{ __('site.contact.phone') }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">&#9993;</span>
                        <span class="pt-2.5 text-sm text-slate-600">{{ __('site.contact.email') }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">&#128337;</span>
                        <span class="pt-2.5 text-sm text-slate-600">{{ __('site.contact.working_hours_title') }}: {{ __('site.contact.working_hours') }}</span>
                    </li>
                </ul>
                <div class="mt-10 flex h-56 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-100 to-accent-100 text-sm font-medium text-brand-400">
                    Semera, Afar
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-slate-100">
                    <form class="space-y-5" method="POST" action="mailto:{{ __('site.contact.email') }}">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="name" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('site.contact.form_name') }}</label>
                                <input id="name" name="name" required class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                            </div>
                            <div>
                                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('site.contact.form_email') }}</label>
                                <input id="email" name="email" type="email" required class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('site.contact.form_subject') }}</label>
                            <input id="subject" name="subject" required class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                        </div>
                        <div>
                            <label for="message" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('site.contact.form_message') }}</label>
                            <textarea id="message" name="message" rows="5" required class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100"></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-brand-700 px-6 py-3 text-sm font-semibold text-white shadow transition hover:bg-brand-800">
                            {{ __('site.contact.form_submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
