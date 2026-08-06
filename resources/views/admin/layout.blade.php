<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') &mdash; Afar PSHRDB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-brand-900 text-white flex-shrink-0">
            <div class="p-4 text-lg font-bold border-b border-white/10">Afar PSHRDB Admin</div>
            <nav class="p-4 space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : '' }}">Dashboard</a>
                <a href="{{ route('admin.news.index') }}" class="block px-3 py-2 rounded hover:bg-white/10 {{ request()->routeIs('admin.news.*') ? 'bg-white/10' : '' }}">News</a>
                <a href="{{ route('admin.pages.index') }}" class="block px-3 py-2 rounded hover:bg-white/10 {{ request()->routeIs('admin.pages.*') ? 'bg-white/10' : '' }}">Pages</a>
                <a href="{{ route('admin.announcements.index') }}" class="block px-3 py-2 rounded hover:bg-white/10 {{ request()->routeIs('admin.announcements.*') ? 'bg-white/10' : '' }}">Announcements</a>
                <a href="{{ route('admin.vacancies.index') }}" class="block px-3 py-2 rounded hover:bg-white/10 {{ request()->routeIs('admin.vacancies.*') ? 'bg-white/10' : '' }}">Vacancies</a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}" class="p-4 border-t border-white/10">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded hover:bg-white/10 text-sm">Log out</button>
            </form>
        </aside>
        <main class="flex-1 p-6">
            <div class="max-w-5xl mx-auto">
                @if (session('status'))
                    <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-3 text-sm">{{ session('status') }}</div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
