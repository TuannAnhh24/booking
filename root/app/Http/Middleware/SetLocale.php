<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session as FacadesSession;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->route('lang') ?? FacadesSession::get('locale', env('APP_LOCALE', 'en'));
        if (in_array($locale, ['en', 'vi', 'fr'])) {
            App::setLocale($locale);
            FacadesSession::put('locale', $locale);
        } else {
            App::setLocale(env('APP_LOCALE', 'vi'));
        }
        return $next($request);
    }
}