@php
    $year = date('Y');
@endphp

<footer class="bg-brand-950 text-brand-100">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:grid-cols-2 lg:grid-cols-4">
        <div>
            <div class="flex items-center gap-2.5">
                <img src="/logo.png" alt="{{ __('site.site_name_short') }}" class="h-10 w-10 rounded-full bg-white object-cover">
                <span class="text-sm font-bold text-white">{{ __('site.site_name_short') }}</span>
            </div>
            <p class="mt-4 text-sm leading-relaxed text-brand-200">
                {{ __('site.footer.tagline') }}
            </p>
        </div>

        <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                {{ __('site.contact.quick_links') }}
            </h3>
            <ul class="mt-4 space-y-2.5 text-sm">
                <li><a href="/{{ $locale }}/about" class="text-brand-200 hover:text-white">{{ __('site.nav.about') }}</a></li>
                <li><a href="/{{ $locale }}/news" class="text-brand-200 hover:text-white">{{ __('site.nav.news') }}</a></li>
                <li><a href="/{{ $locale }}/services" class="text-brand-200 hover:text-white">{{ __('site.nav.services') }}</a></li>
                <li><a href="/{{ $locale }}/vacancies" class="text-brand-200 hover:text-white">{{ __('site.nav.vacancies') }}</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                {{ __('site.nav.announcements') }}
            </h3>
            <ul class="mt-4 space-y-2.5 text-sm">
                <li><a href="/{{ $locale }}/announcements/tenders" class="text-brand-200 hover:text-white">{{ __('site.nav.tenders') }}</a></li>
                <li><a href="/{{ $locale }}/announcements/other" class="text-brand-200 hover:text-white">{{ __('site.nav.other_announcements') }}</a></li>
                <li><a href="/{{ $locale }}/documents" class="text-brand-200 hover:text-white">{{ __('site.nav.documents') }}</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                {{ __('site.contact.title') }}
            </h3>
            <ul class="mt-4 space-y-2.5 text-sm text-brand-200">
                <li>{{ __('site.contact.address') }}</li>
                <li>{{ __('site.contact.phone') }}</li>
                <li>{{ __('site.contact.email') }}</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10 py-6">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 text-xs text-brand-300 sm:flex-row">
            <span>&copy; {{ $year }} {{ __('site.site_name_short') }}. {{ __('site.footer.rights') }}</span>
            <span>{{ __('site.footer.government') }}</span>
        </div>
    </div>
</footer>
