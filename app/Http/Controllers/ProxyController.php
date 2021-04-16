<?php

namespace App\Http\Controllers;

use App\Models\Proxy;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    public function index(Request $request)
    {
        $proxies = Proxy::orderBy('id', 'DESC')
            ->paginate($request->per_page ?? self::DEFAULT_PER_PAGE)
            ->appends($request->all());

        return view('proxy.index', [
            'proxies' => $proxies,
        ]);
    }

    public function show(Proxy $proxy)
    {
        return view('proxy.show', compact('proxy'));
    }
}
