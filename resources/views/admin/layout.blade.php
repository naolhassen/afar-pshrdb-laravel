<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') &mdash; Afar PSHRDB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 flex-shrink-0 bg-gradient-to-b from-brand-950 to-brand-900 text-white shadow-2xl">
            <div class="p-5 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <i data-lucide="shield" class="h-6 w-6 text-accent-400"></i>
                    <span class="text-lg font-bold tracking-tight">Afar PSHRDB</span>
                </div>
                <div class="mt-1 text-xs font-medium text-brand-200">Admin Portal</div>
            </div>
            <nav class="p-3 space-y-1 text-sm">
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
                       class="flex items-center gap-3 rounded-lg px-3 py-2.5 font-medium transition {{ request()->routeIs($link[0]) ? 'bg-white/15 text-white shadow-sm' : 'text-brand-100 hover:bg-white/10 hover:text-white' }}">
                        <i data-lucide="{{ $link[1] }}" class="h-4 w-4"></i>
                        {{ $link[2] }}
                    </a>
                @endforeach
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto p-3 border-t border-white/10">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-medium text-brand-100 transition hover:bg-white/10 hover:text-white">
                    <i data-lucide="log-out" class="h-4 w-4"></i>
                    Log out
                </button>
            </form>
        </aside>
        <main class="flex-1 p-6 lg:p-10">
            <div class="max-w-6xl mx-auto">
                @if (session('status'))
                    <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 animate-fade-in">
                        <i data-lucide="check-circle-2" class="h-4 w-4"></i>
                        {{ session('status') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
