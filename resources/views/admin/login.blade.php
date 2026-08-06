<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login &mdash; Afar PSHRDB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-sm bg-white rounded-lg shadow p-8">
        <h1 class="text-xl font-bold text-brand-900 mb-6 text-center">Afar PSHRDB Admin</h1>

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.attempt') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1" for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded border-gray-300 focus:border-brand-500 focus:ring-brand-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1" for="password">Password</label>
                <input id="password" name="password" type="password" required
                       class="w-full rounded border-gray-300 focus:border-brand-500 focus:ring-brand-500">
            </div>
            <label class="flex items-center text-sm gap-2">
                <input type="checkbox" name="remember">
                Remember me
            </label>
            <button type="submit" class="w-full bg-brand-700 hover:bg-brand-800 text-white rounded py-2 font-medium">
                Log in
            </button>
        </form>
    </div>
</body>
</html>
