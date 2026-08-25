@php
    $eyebrow = $eyebrow ?? null;
    $title = $title ?? '';
    $subtitle = $subtitle ?? null;
    $icon = $icon ?? null;
@endphp

<section class="page-hero relative overflow-hidden bg-brand-950 text-white">
    <div class="page-hero-weave absolute inset-0" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-4 py-14 sm:py-16">
        @if ($eyebrow)
            <div class="flex items-center gap-2.5 text-[11px] font-bold uppercase tracking-[0.28em] text-brand-200">
                @if ($icon)
                    <i data-lucide="{{ $icon }}" class="h-4 w-4 text-accent-400"></i>
                @endif
                {{ $eyebrow }}
            </div>
        @endif
        <h1 class="mt-3 max-w-3xl text-balance text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl">
            {{ $title }}
        </h1>
        <div class="tricolor-rule mt-5" aria-hidden="true"></div>
        @if ($subtitle)
            <p class="mt-5 max-w-2xl text-sm leading-relaxed text-brand-100/90 sm:text-base">{{ $subtitle }}</p>
        @endif
    </div>
</section>
