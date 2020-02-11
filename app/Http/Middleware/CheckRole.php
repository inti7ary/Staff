<?php
namespace App\Http\Middleware;
use Closure;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $request->user()->assignRole('writer');
        if (! $request->user()->hasRole($role)) {
            return redirect('main');
        }

        return $next($request);
    }

}