<?php

namespace App\Http\Middleware;

use App\Models\CATALOGOS\CATEventos;
use Closure;
use Illuminate\Http\Request;

class EnsureEventIsEnable
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
        $date = date('Y-m-d');

        $eventos = CATEventos::whereDate('eve_fecha_final','=',$date)->delete();
        return $next($request);
    }
}
