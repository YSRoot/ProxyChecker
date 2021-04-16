<?php

namespace App;

use App\Jobs\CheckProxiesJob;
use App\Models\Proxy;
use App\Models\ProxyList;
use Illuminate\Support\Collection;

class ProxiesManager
{
    public function bulkCreate(string $proxies, ProxyList $proxyList): void
    {
        $proxies = collect(explode(PHP_EOL, $proxies))
            ->transform(function (string $proxy) use ($proxyList) {
                return (new ProxyManager())->firstOrCreate($proxy, $proxyList);
            });

        dispatch(new CheckProxiesJob($proxies));
    }

    public function check(?Collection $proxies = null): void
    {
        if (!isset($proxies)) {
            $proxies = Proxy::notChecked();
        }

        $proxies->chunk(10, fn (Proxy $proxy) => (new ProxyManager($proxy))->check());
    }
}
