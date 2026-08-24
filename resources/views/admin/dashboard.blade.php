@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8 animate-fade-in">
        <div class="admin-card p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Welcome back, Administrator</h1>
                <p class="mt-1 text-slate-500">Here is what's happening across the portal today.</p>
            </div>
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                <i data-lucide="sparkles" class="h-6 w-6 text-amber-500"></i>
            </span>
        </div>

        @php
            $cards = [
                ['route' => 'admin.news.index', 'icon' => 'newspaper', 'count' => $counts['news'], 'label' => 'News Articles', 'gradient' => 'from-blue-500 to-blue-700'],
                ['route' => 'admin.pages.index', 'icon' => 'file-text', 'count' => $counts['pages'], 'label' => 'Pages', 'gradient' => 'from-emerald-500 to-emerald-700'],
                ['route' => 'admin.announcements.index', 'icon' => 'megaphone', 'count' => $counts['announcements'], 'label' => 'Announcements', 'gradient' => 'from-amber-500 to-amber-700'],
                ['route' => 'admin.vacancies.index', 'icon' => 'briefcase', 'count' => $counts['vacancies'], 'label' => 'Vacancies', 'gradient' => 'from-rose-500 to-rose-700'],
            ];
            $maxCount = max(array_column($cards, 'count'));
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($cards as $card)
                <a href="{{ route($card['route']) }}" class="stat-card group">
                    <div class="flex items-start justify-between">
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br {{ $card['gradient'] }} text-white shadow-md">
                            <i data-lucide="{{ $card['icon'] }}" class="h-6 w-6"></i>
                        </div>
                        <span class="text-3xl font-black text-slate-900">{{ $card['count'] }}</span>
                    </div>
                    <div class="mt-4 text-sm font-semibold text-slate-500 group-hover:text-brand-700 transition-colors">{{ $card['label'] }}</div>
                </a>
            @endforeach
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="admin-card col-span-1 lg:col-span-2 p-6">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Content Distribution</h3>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Live</span>
                </div>
                <div class="h-48 flex items-end gap-4 border-b border-slate-100 pb-2">
                    @foreach ($cards as $card)
                        @php $height = $maxCount > 0 ? round($card['count'] / $maxCount * 100) : 0; @endphp
                        <div class="flex flex-1 flex-col items-center gap-2 group">
                            <div class="w-full rounded-t-2xl bg-gradient-to-t {{ $card['gradient'] }} opacity-80 transition-all duration-700 group-hover:opacity-100" style="height: {{ $height }}%"></div>
                            <span class="text-xs font-medium text-slate-500">{{ $card['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="admin-card p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.news.create') }}" class="nav-link"><i data-lucide="plus-circle" class="h-4 w-4 text-blue-500"></i> Add News Article</a>
                    <a href="{{ route('admin.announcements.create') }}" class="nav-link"><i data-lucide="plus-circle" class="h-4 w-4 text-amber-500"></i> Add Announcement</a>
                    <a href="{{ route('admin.vacancies.create') }}" class="nav-link"><i data-lucide="plus-circle" class="h-4 w-4 text-rose-500"></i> Add Vacancy</a>
                    <a href="{{ route('admin.pages.create') }}" class="nav-link"><i data-lucide="plus-circle" class="h-4 w-4 text-emerald-500"></i> Add Page</a>
                </div>
            </div>
        </div>
    </div>
@endsection
