<?php

namespace App\ProxyChecks;

use App\Models\Proxy;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\File;
use Illuminate\Support\Carbon;

class ProxySpeedCheck
{
    public function handle(Proxy $proxy, Closure $next)
    {
        $client = new Client();
        $downloadTimeRow = [];
        $tmpfile = tempnam(sys_get_temp_dir(),'dl');
        foreach (range(0, 5) as $it) {
            $startTime = Carbon::now();
            $client->request('GET', 'https://stluciadance.com/prospectus_file/sample.pdf', [
                'sink' => $tmpfile,
            ]);
            $diffRow[] = Carbon::now()->diffInSeconds($startTime);
        }
        $size = (new File($tmpfile))->getSize() / 1024; //convert to KB
        $avgDownloadTime = array_sum($downloadTimeRow) / count($downloadTimeRow);

        $proxy->speed = $size / $avgDownloadTime;

        return $next($proxy);
    }
}
