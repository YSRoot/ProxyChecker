<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProxyCheckRequest;
use App\Models\ProxyList;
use App\ProxyListManager;
use Illuminate\Http\Request;

class ProxyListController extends Controller
{
    public function show(Request $request, ProxyList $proxyList)
    {
        return view('proxy-list.show', [
            'proxies' => $proxyList->proxies()
                ->paginate($request->per_page ?? self::DEFAULT_PER_PAGE)
                ->appends($request->all()),
            'enabledProxyCount' => $proxyList->proxies()->enabled()->count(),
            'disabledProxyCount' => $proxyList->proxies()->disabled()->count(),
            'totalTime' => $proxyList->proxies()->sum('check_time_sec'),
        ]);
    }

    public function create()
    {
        return view('proxy-list.create');
    }

    public function store(ProxyCheckRequest $request)
    {
        $proxyList = (new ProxyListManager())->create($request->body);

        return redirect(route('proxy-lists.show', $proxyList));
    }
}
