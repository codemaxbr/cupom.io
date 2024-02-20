<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;

class CheckDomain
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
        // Extract the subdomain from URL.
        list($subdomain) = explode('.', $request->getHost(), 2);

        $account = Account::query()->where(['domain' => $subdomain])->firstOrFail();
        $request->session()->put('account', $account);

        return $next($request);
    }
}
