<?php

namespace App\ProxyChecks;

use App\Models\Proxy;
use Closure;
use GuzzleHttp\Client;

class ProxyRealIPCheck
{
    public function handle(Proxy $proxy, Closure $next)
    {
        $proxy->real_ip = (string) (new Client())->get('http://api.ipify.org', [
            'proxy' => $proxy->type . '://' . $proxy->ip . ':' . $proxy->port,
        ])
            ->getBody();

        return $next($proxy);
    }
}
