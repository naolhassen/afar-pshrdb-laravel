@php
    $year = date('Y');
@endphp

<footer class="bg-brand-950 text-brand-100">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <img src="/logo.png" alt="{{ __('site.site_name_short') }}" class="h-12 w-12 rounded-full bg-white object-cover">
                    <span class="text-lg font-bold text-white">{{ __('site.site_name_short') }}</span>
                </div>
                <p class="text-sm leading-relaxed text-brand-200">
                    {{ __('site.footer.tagline') }}
                </p>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                    {{ __('site.contact.quick_links') }}
                </h3>
                <ul class="mt-5 grid grid-cols-1 gap-2.5 text-sm sm:grid-cols-2">
                    <li><a href="/{{ $locale }}/" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.home') }}</a></li>
                    <li><a href="/{{ $locale }}/about/af-pshrdb" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.about_bureau') }}</a></li>
                    <li><a href="/{{ $locale }}/about/staff" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.about_staff') }}</a></li>
                    <li><a href="/{{ $locale }}/news" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.news') }}</a></li>
                    <li><a href="/{{ $locale }}/announcements/tenders" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.tenders') }}</a></li>
                    <li><a href="/{{ $locale }}/announcements/other" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.other_announcements') }}</a></li>
                    <li><a href="/{{ $locale }}/services/main" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.main_services') }}</a></li>
                    <li><a href="/{{ $locale }}/services/request" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.request_service') }}</a></li>
                    <li><a href="/{{ $locale }}/vacancies" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.vacancies') }}</a></li>
                    <li><a href="/{{ $locale }}/documents" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.documents') }}</a></li>
                    <li><a href="/{{ $locale }}/contact" class="inline-flex items-center gap-1.5 text-brand-200 transition hover:translate-x-1 hover:text-white group"><i data-lucide="chevron-right" class="h-3 w-3 transition group-hover:text-white"></i> {{ __('site.nav.contact') }}</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                    {{ __('site.contact.title') }}
                </h3>
                <ul class="mt-5 space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <i data-lucide="map-pin" class="mt-0.5 h-4 w-4 shrink-0 text-accent-400"></i>
                        <span>{{ __('site.contact.address') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="phone" class="h-4 w-4 shrink-0 text-accent-400"></i>
                        <a href="tel:{{ __('site.contact.phone') }}" class="transition hover:text-white">{{ __('site.contact.phone') }}</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="mail" class="h-4 w-4 shrink-0 text-accent-400"></i>
                        <a href="mailto:{{ __('site.contact.email') }}" class="transition hover:text-white">{{ __('site.contact.email') }}</a>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="clock" class="mt-0.5 h-4 w-4 shrink-0 text-accent-400"></i>
                        <span>{{ __('site.contact.working_hours') }}</span>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-white">
                    {{ __('site.contact.follow_us') }}
                </h3>
                <div class="mt-5 flex gap-3">
                    <a href="{{ __('site.contact.facebook_url') }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/10 text-white shadow-sm ring-1 ring-white/5 transition hover:scale-110 hover:-translate-y-0.5 hover:bg-blue-600">
                        <i data-lucide="facebook" class="h-4 w-4"></i>
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Twitter" class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/10 text-white shadow-sm ring-1 ring-white/5 transition hover:scale-110 hover:-translate-y-0.5 hover:bg-sky-500">
                        <i data-lucide="twitter" class="h-4 w-4"></i>
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/10 text-white shadow-sm ring-1 ring-white/5 transition hover:scale-110 hover:-translate-y-0.5 hover:bg-red-600">
                        <i data-lucide="youtube" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-6 text-xs text-brand-300 sm:flex-row sm:px-6 lg:px-8">
            <span>&copy; {{ $year }} {{ __('site.footer.government') }}. {{ __('site.footer.rights') }}</span>
            <span>{{ __('site.site_name_short') }}</span>
        </div>
    </div>
</footer>
