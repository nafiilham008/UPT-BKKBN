<?php

namespace App\Http\Middleware;

use App\Models\Maintenance;
use Closure;
use Illuminate\Http\Request;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $maintenanceStatus = Maintenance::select('is_maintenance')->first();

        if ($maintenanceStatus && $maintenanceStatus->is_maintenance == 1) {
            return response(view('errors.503'), 503);
        }

        return $next($request);
    }
}
