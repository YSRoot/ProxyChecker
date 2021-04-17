<?php

namespace App;

use App\Jobs\CheckProxyJob;
use App\Models\Proxy;
use App\Models\ProxyList;
use Illuminate\Database\Eloquent\Collection;

class ProxiesManager
{
    public function bulkCreate(string $proxies, ProxyList $proxyList): void
    {
        collect(explode(PHP_EOL, $proxies))
            ->each(function (string $proxy) use ($proxyList) {
                $proxy = (new ProxyManager())->firstOrCreate($proxy, $proxyList);
                dispatch(new CheckProxyJob($proxy));
            });
    }

    public function check(): void
    {
        Proxy::notChecked()
            ->chunk(50, function (Collection $proxies) {
                $proxies->each(fn (Proxy $proxy) => dispatch(new CheckProxyJob($proxy)));
            });
    }
}
