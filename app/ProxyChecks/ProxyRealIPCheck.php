<?php

namespace App\ProxyChecks;

use App\Models\Proxy;
use Closure;

class ProxyRealIPCheck
{
    public function handle(Proxy $proxy, Closure $next)
    {
        echo 'i check ip';
        //запрос на http://api.ipify.org/
        return $next($proxy);
    }
}
