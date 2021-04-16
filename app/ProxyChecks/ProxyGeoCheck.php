<?php

namespace App\ProxyChecks;

use App\Models\Proxy;
use Closure;
use GuzzleHttp\Client;

class ProxyGeoCheck
{
    public function handle(Proxy $proxy, Closure $next)
    {
        echo 'i check geo';
        if ($proxy->real_ip) {
            $client = new Client(['base_uri' => 'http://ip-api.com']);
            $response = $client->get('json/' . $proxy->real_ip . '?lang=en');
            $result = json_decode($response->getBody(), true);
            if (isset($result['status']) && $result['status'] == 'success') {
                $proxy->geo = $result['country'] . '/' . $result['city'];
            }
        }

        return $next($proxy);
    }
}
