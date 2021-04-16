<?php

namespace App;

use App\Models\Proxy;
use App\Models\ProxyList;
use App\ProxyChecks\ProxyGeoCheck;
use App\ProxyChecks\ProxyRealIPCheck;
use App\ProxyChecks\ProxySpeedCheck;
use App\ProxyChecks\ProxyTypeCheck;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;

class ProxyManager
{
    private ?Proxy $proxy;

    public function __construct(Proxy $proxy = null)
    {
        $this->proxy = $proxy;
    }

    public function firstOrCreate(string $proxy, ProxyList $proxyList): Proxy
    {
        [$ip, $port] = explode(':', $proxy);

        $this->proxy = Proxy::query()
            ->where('ip', $ip)
            ->where('port', $port)
            ->firstOr(function () use ($ip, $port) {
                return Proxy::create(['ip' => $ip, 'port' => $port]);
            });

        $proxyList->proxies()->attach($this->proxy);

        return $this->proxy;
    }

    public function check(): void
    {
        $startTime = Carbon::now();
        $this->proxy =  app(Pipeline::class)->send($this->proxy)
            ->through([
                ProxyTypeCheck::class,
                ProxyRealIPCheck::class,
                ProxyGeoCheck::class,
                ProxySpeedCheck::class,
            ])
            ->thenReturn();
        $this->proxy->is_checked = true;
        $this->proxy->check_time_sec = Carbon::now()->diffInSeconds($startTime);
        $this->proxy->save();
    }
}
