<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') &mdash; Afar PSHRDB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 flex-shrink-0 overflow-y-auto border-r border-slate-200 bg-white shadow-[0_0_40px_-12px_rgba(15,23,42,0.15)]">
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('logo.png') }}" alt="Afar PSHRDB Bureau Logo" class="h-12 w-12 rounded-xl bg-white object-contain p-1.5 shadow-sm ring-1 ring-slate-100">
                    <div>
                        <div class="text-base font-bold tracking-tight text-slate-900">Afar PSHRDB</div>
                        <div class="text-xs font-semibold text-slate-400">Admin Portal</div>
                    </div>
                </div>
            </div>
            <nav class="space-y-1 px-4 pb-4">
                @php
                    $links = [
                        ['dashboard', 'layout-dashboard', 'Dashboard'],
                        ['admin.news.*', 'newspaper', 'News'],
                        ['admin.pages.*', 'file-text', 'Pages'],
                        ['admin.announcements.*', 'megaphone', 'Announcements'],
                        ['admin.vacancies.*', 'briefcase', 'Vacancies'],
                    ];
                @endphp
                @foreach ($links as $link)
                    <a href="{{ route($link[0] === 'dashboard' ? 'admin.dashboard' : 'admin.' . explode('.', $link[0])[1] . '.index') }}"
                       class="nav-link {{ request()->routeIs($link[0]) ? 'nav-link-active' : '' }}">
                        <i data-lucide="{{ $link[1] }}" class="h-4.5 w-4.5"></i>
                        {{ $link[2] }}
                    </a>
                @endforeach
            </nav>
            <div class="mt-auto p-4 border-t border-slate-100">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link w-full text-left text-rose-600 hover:bg-rose-50 hover:text-rose-700">
                        <i data-lucide="log-out" class="h-4.5 w-4.5"></i>
                        Log out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main -->
        <main class="flex-1 overflow-y-auto">
            <div class="sticky top-0 z-10 border-b border-slate-200 bg-white/80 px-6 py-4 backdrop-blur-md">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-900">@yield('title', 'Admin')</h2>
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                            <i data-lucide="bell" class="h-4 w-4"></i>
                        </span>
                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-brand-600 to-brand-800 text-white text-sm font-bold">
                            A
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-6 lg:p-10">
                <div class="max-w-7xl mx-auto">
                    @if (session('status'))
                        <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3.5 text-sm font-semibold text-emerald-800 animate-fade-in">
                            <i data-lucide="check-circle-2" class="h-4 w-4"></i>
                            {{ session('status') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
