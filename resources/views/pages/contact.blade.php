@extends('layouts.app')

@section('title', __('site.contact.title'))

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => __('site.nav.contact'),
        'title' => __('site.contact.title'),
        'subtitle' => __('site.contact.subtitle'),
        'icon' => 'message-circle',
    ])

    <section class="mx-auto max-w-7xl px-4 py-14 sm:py-16 animate-fade-in">
        <div class="grid gap-12 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <div class="space-y-5">
                    <div class="flex items-start gap-4 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-md">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                            <i data-lucide="map-pin" class="h-5 w-5"></i>
                        </span>
                        <div>
                            <div class="text-xs font-semibold uppercase tracking-wider text-slate-400">Address</div>
                            <div class="mt-0.5 text-sm text-slate-700">{{ __('site.contact.address') }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-md">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                            <i data-lucide="phone" class="h-5 w-5"></i>
                        </span>
                        <div>
                            <div class="text-xs font-semibold uppercase tracking-wider text-slate-400">Phone</div>
                            <div class="mt-0.5 text-sm text-slate-700">{{ __('site.contact.phone') }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-md">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                            <i data-lucide="mail" class="h-5 w-5"></i>
                        </span>
                        <div>
                            <div class="text-xs font-semibold uppercase tracking-wider text-slate-400">Email</div>
                            <div class="mt-0.5 text-sm text-slate-700">{{ __('site.contact.email') }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-md">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                            <i data-lucide="clock" class="h-5 w-5"></i>
                        </span>
                        <div>
                            <div class="text-xs font-semibold uppercase tracking-wider text-slate-400">Working Hours</div>
                            <div class="mt-0.5 text-sm text-slate-700">{{ __('site.contact.working_hours') }}</div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex h-56 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-100 to-accent-100 text-sm font-medium text-brand-600 shadow-inner">
                    <span class="flex items-center gap-2">
                        <i data-lucide="map" class="h-5 w-5"></i>
                        Semera, Afar
                    </span>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="rounded-[24px] bg-white p-8 shadow-[0_18px_42px_-30px_rgba(15,23,42,0.35)] ring-1 ring-slate-100">
                    <form class="space-y-5" method="POST" action="mailto:{{ __('site.contact.email') }}">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="name" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('site.contact.form_name') }}</label>
                                <input id="name" name="name" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                            </div>
                            <div>
                                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('site.contact.form_email') }}</label>
                                <input id="email" name="email" type="email" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('site.contact.form_subject') }}</label>
                            <input id="subject" name="subject" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                        </div>
                        <div>
                            <label for="message" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('site.contact.form_message') }}</label>
                            <textarea id="message" name="message" rows="5" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100"></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-brand-700 px-6 py-3 text-sm font-semibold text-white shadow transition hover:bg-brand-800 hover:-translate-y-0.5">
                            {{ __('site.contact.form_submit') }} <i data-lucide="send" class="h-4 w-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
