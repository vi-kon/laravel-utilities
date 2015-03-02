<?php

namespace ViKon\Utilities\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class IsAjax
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\Utilities\Middleware
 */
class IsAjax implements Middleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next) {
        if (!$request->ajax()) {
            throw new NotFoundHttpException('Not ajax request');
        }

        return $next($request);
    }
}