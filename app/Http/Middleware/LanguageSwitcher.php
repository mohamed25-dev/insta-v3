<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class LanguageSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $lang = request()->session()->get('lang', 'ar');

        if (auth()->user() != null) {
            $lang = auth()->user()->lang;
        } 
        
        App::setlocale($lang);
        
        if ($lang == 'ar') {
            View::share('dir', 'rtl');    
        } else {
            View::share('dir', 'ltr');    
        }

        return $next($request);
    }
}
