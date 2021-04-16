<?php

namespace App;

use App\Models\ProxyList;

class ProxyListManager
{
    private ?ProxyList $proxyList;

    public function __construct(ProxyList $proxyList = null)
    {
        $this->proxyList = $proxyList;
    }

    public function create(string $proxies): ProxyList
    {
        $this->proxyList = ProxyList::create();

        app(ProxiesManager::class)->bulkCreate($proxies, $this->proxyList);

        return $this->proxyList;
    }
}
