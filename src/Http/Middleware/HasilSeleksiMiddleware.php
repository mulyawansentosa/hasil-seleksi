<?php namespace Bantenprov\HasilSeleksi\Http\Middleware;

use Closure;

/**
 * The HasilSeleksiMiddleware class.
 *
 * @package Bantenprov\HasilSeleksi
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class HasilSeleksiMiddleware
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
        return $next($request);
    }
}
