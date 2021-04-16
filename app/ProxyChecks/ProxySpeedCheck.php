<?php

namespace App\ProxyChecks;

use App\Models\Proxy;
use Closure;

class ProxySpeedCheck
{
    public function handle(Proxy $proxy, Closure $next)
    {
        echo 'i check speed';
        //скачать несколько раз что-то записывая время и посчитать среднюю скрость
        return $next($proxy);
    }
}
