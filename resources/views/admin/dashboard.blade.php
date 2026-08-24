@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-3xl font-extrabold tracking-tight text-slate-950 mb-8">Dashboard</h1>

    @php
        $cards = [
            ['route' => 'admin.news.index', 'icon' => 'newspaper', 'count' => $counts['news'], 'label' => 'News Articles', 'color' => 'from-blue-500 to-blue-600'],
            ['route' => 'admin.pages.index', 'icon' => 'file-text', 'count' => $counts['pages'], 'label' => 'Pages', 'color' => 'from-emerald-500 to-emerald-600'],
            ['route' => 'admin.announcements.index', 'icon' => 'megaphone', 'count' => $counts['announcements'], 'label' => 'Announcements', 'color' => 'from-amber-500 to-amber-600'],
            ['route' => 'admin.vacancies.index', 'icon' => 'briefcase', 'count' => $counts['vacancies'], 'label' => 'Vacancies', 'color' => 'from-rose-500 to-rose-600'],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-fade-in">
        @foreach ($cards as $card)
            <a href="{{ route($card['route']) }}" class="group relative overflow-hidden rounded-2xl bg-white p-6 shadow-[0_8px_24px_-16px_rgba(15,23,42,0.45)] ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-[0_18px_36px_-18px_rgba(15,23,42,0.35)]">
                <div class="flex items-start justify-between">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br {{ $card['color'] }} text-white shadow-sm">
                        <i data-lucide="{{ $card['icon'] }}" class="h-6 w-6"></i>
                    </div>
                    <span class="text-3xl font-black text-slate-900">{{ $card['count'] }}</span>
                </div>
                <div class="mt-4 text-sm font-semibold text-slate-500 group-hover:text-brand-700 transition-colors">{{ $card['label'] }}</div>
            </a>
        @endforeach
    </div>
@endsection
