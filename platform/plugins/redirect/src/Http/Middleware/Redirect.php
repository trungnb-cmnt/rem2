<?php

namespace Botble\Redirect\Http\Middleware;

use Closure;
use Botble\Redirect\Models\Redirect as RedirectModel;

class Redirect
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
        $slug = rtrim(ltrim($request->path(), '/'), '/');
        $slug = urldecode($slug);
        $redirect = RedirectModel::where([
            ['is_active', 1],
            ['url', $slug]
        ])->first();
        if ($redirect) {
            return redirect(url($redirect->target), ($redirect->code) ? $redirect->code : 301);
        }
        return $next($request);
    }
}