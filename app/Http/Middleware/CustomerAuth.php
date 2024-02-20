<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerAuth
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
        $customer = Auth::guard('front')->check();

        dd($customer);

        if($customer->status == 0)
        {
            return redirect()->route('cliente.login');
        }
        return $next($request);
    }
}
