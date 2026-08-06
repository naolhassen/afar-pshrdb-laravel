<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * The locales supported by the site, in order of preference.
     * Afar (aa) is the primary/default locale for this bureau.
     *
     * @var list<string>
     */
    public const SUPPORTED_LOCALES = ['aa', 'en', 'am'];

    public const DEFAULT_LOCALE = 'aa';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (! in_array($locale, self::SUPPORTED_LOCALES, true)) {
            abort(404);
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
