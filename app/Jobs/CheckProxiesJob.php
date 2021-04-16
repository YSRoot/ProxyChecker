<?php

namespace App\Jobs;

use App\ProxiesManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class CheckProxiesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ?Collection $proxies;

    public function __construct(Collection $proxies = null)
    {
        $this->proxies = $proxies;
    }

    public function handle()
    {
        app(ProxiesManager::class)->check($this->proxies);
    }
}
