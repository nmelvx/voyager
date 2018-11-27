<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->method() === 'GET') {
            $segment = $request->segment(1);

            if (!in_array($segment, config('app.locales')) && (sizeof(config('app.locales')) > 3)) {

                $segments = $request->segments();
                $fallback = session('locale') ?: config('app.fallback_locale');
                $segments = array_prepend($segments, $fallback);

                return redirect()->to(implode('/', $segments), 301);
            }

            session(['locale' => $segment]);
            app()->setLocale($segment);

        }


        /*$locale = session('locale') ?: config('app.locale');
        session(['locale' => $locale]);
        app()->setLocale($locale);*/



        return $next($request);
    }
}

?>