<?php

namespace App\Console\Commands;

use App\Jobs\CheckProxiesJob;
use Illuminate\Console\Command;

class CheckProxiesCommand extends Command
{
    protected $signature = 'proxies:check';

    protected $description = 'Check all not checked proxies )';

    public function handle()
    {
        dispatch(new CheckProxiesJob());
    }
}
