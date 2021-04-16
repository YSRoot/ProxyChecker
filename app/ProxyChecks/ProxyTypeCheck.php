<?php

namespace App\ProxyChecks;

use App\Models\Proxy;
use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ProxyTypeCheck
{
    public function handle(Proxy $proxy, Closure $next)
    {
        $client = new Client(['base_uri' => 'https://google.com',]);

        foreach (Proxy::TYPES as $type) {
            echo 'i check proxy type: ' . $type;
            try {
                $client->get('/', [
                    'proxy' => $type . '://' . $proxy->ip . ':' . $proxy->port,
                ]);
                $proxy->type = $type;
                $proxy->status = Proxy::ENABLED_STATUS;
                return $next($proxy);
            } catch (GuzzleException $exception) {
            }
        }

        return $next($proxy);
    }
}
