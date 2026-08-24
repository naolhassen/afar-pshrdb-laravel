<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login &mdash; Afar PSHRDB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-brand-950 to-slate-900">
    <!-- Decorative blobs -->
    <div class="pointer-events-none absolute -left-20 -top-20 h-96 w-96 rounded-full bg-brand-600/25 blur-3xl"></div>
    <div class="pointer-events-none absolute -right-20 -bottom-20 h-96 w-96 rounded-full bg-accent-500/20 blur-3xl"></div>
    <div class="pointer-events-none absolute left-1/3 top-1/4 h-64 w-64 rounded-full bg-amber-400/15 blur-3xl"></div>

    <div class="relative w-full max-w-md px-4 animate-scale-in">
        <div class="admin-glass p-8 sm:p-10">
            <div class="mb-8 text-center">
                <span class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-600 to-brand-800 text-white shadow-lg mb-4">
                    <i data-lucide="shield-check" class="h-8 w-8"></i>
                </span>
                <h1 class="text-2xl font-bold text-slate-900">Welcome back</h1>
                <p class="mt-1 text-sm text-slate-500">Afar PSHRDB Admin Portal</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 flex items-center gap-2 rounded-xl bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700 border border-rose-200 animate-shake">
                    <i data-lucide="alert-circle" class="h-4 w-4"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}" class="space-y-5" data-admin-form>
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i data-lucide="mail" class="h-4 w-4 text-slate-400"></i> Email
                    </label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                           placeholder="admin@example.com"
                           class="form-input form-input-icon {{ $errors->has('email') ? 'input-invalid' : '' }}">
                    <i data-lucide="mail" class="form-icon"></i>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">
                        <i data-lucide="lock" class="h-4 w-4 text-slate-400"></i> Password
                    </label>
                    <input id="password" name="password" type="password" required
                           placeholder="••••••••"
                           class="form-input form-input-icon {{ $errors->has('password') ? 'input-invalid' : '' }}">
                    <i data-lucide="lock" class="form-icon"></i>
                </div>

                <label class="flex items-center gap-2.5 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="form-checkbox">
                    Remember me
                </label>

                <button type="submit" class="btn-primary w-full" data-loading-text="Signing in…">
                    <i data-lucide="log-in" class="h-4 w-4"></i>
                    <span>Sign in</span>
                </button>
            </form>
        </div>
    </div>
</body>
</html>
