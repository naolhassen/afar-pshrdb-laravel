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
                <li><a href="/{{ $locale }}/" class="text-brand-200 hover:text-white">{{ __('site.nav.home') }}</a></li>
                <li><a href="/{{ $locale }}/about/af-pshrdb" class="text-brand-200 hover:text-white">{{ __('site.nav.about_bureau') }}</a></li>
                <li><a href="/{{ $locale }}/about/staff" class="text-brand-200 hover:text-white">{{ __('site.nav.about_staff') }}</a></li>
                <li><a href="/{{ $locale }}/news" class="text-brand-200 hover:text-white">{{ __('site.nav.news') }}</a></li>
                <li><a href="/{{ $locale }}/announcements/tenders" class="text-brand-200 hover:text-white">{{ __('site.nav.tenders') }}</a></li>
                <li><a href="/{{ $locale }}/announcements/other" class="text-brand-200 hover:text-white">{{ __('site.nav.other_announcements') }}</a></li>
                <li><a href="/{{ $locale }}/services/main" class="text-brand-200 hover:text-white">{{ __('site.nav.main_services') }}</a></li>
                <li><a href="/{{ $locale }}/services/request" class="text-brand-200 hover:text-white">{{ __('site.nav.request_service') }}</a></li>
                <li><a href="/{{ $locale }}/vacancies" class="text-brand-200 hover:text-white">{{ __('site.nav.vacancies') }}</a></li>
                <li><a href="/{{ $locale }}/documents" class="text-brand-200 hover:text-white">{{ __('site.nav.documents') }}</a></li>
                <li><a href="/{{ $locale }}/contact" class="text-brand-200 hover:text-white">{{ __('site.nav.contact') }}</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                {{ __('site.contact.title') }}
            </h3>
            <ul class="mt-4 space-y-3 text-sm">
                <li class="flex items-start gap-2.5">
                    <i data-lucide="map-pin" class="mt-0.5 h-4 w-4 shrink-0 text-accent-400"></i>
                    {{ __('site.contact.address') }}
                </li>
                <li class="flex items-center gap-2.5">
                    <i data-lucide="phone" class="h-4 w-4 shrink-0 text-accent-400"></i>
                    <a href="tel:{{ __('site.contact.phone') }}" class="hover:text-white">{{ __('site.contact.phone') }}</a>
                </li>
                <li class="flex items-center gap-2.5">
                    <i data-lucide="mail" class="h-4 w-4 shrink-0 text-accent-400"></i>
                    <a href="mailto:{{ __('site.contact.email') }}" class="hover:text-white">{{ __('site.contact.email') }}</a>
                </li>
                <li class="flex items-start gap-2.5">
                    <i data-lucide="clock" class="mt-0.5 h-4 w-4 shrink-0 text-accent-400"></i>
                    {{ __('site.contact.working_hours') }}
                </li>
            </ul>
        </div>

        <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                {{ __('site.contact.follow_us') }}
            </h3>
            <div class="mt-4 flex gap-3">
                <a href="{{ __('site.contact.facebook_url') }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 transition hover:bg-accent-600">
                    <i data-lucide="globe" class="h-4 w-4"></i>
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Twitter" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 transition hover:bg-accent-600">
                    <i data-lucide="at-sign" class="h-4 w-4"></i>
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 transition hover:bg-accent-600">
                    <i data-lucide="youtube" class="h-4 w-4"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10 py-6">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 text-xs text-brand-300 sm:flex-row">
            <span>&copy; {{ $year }} {{ __('site.footer.government') }}. {{ __('site.footer.rights') }}</span>
            <span>{{ __('site.site_name_short') }}</span>
        </div>
    </div>
</footer>
