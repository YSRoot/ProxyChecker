@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Proxy list') }}</div>

                    <div class="card-body">
                        @include('custom.proxy-table', ['proxies' => $proxies])
                        {{ $proxies->links() }}
                        <div>
                            Total check time: {{ $totalTime }} sec <br>
                            Count enabled proxies: {{ $enabledProxyCount }} <br>
                            Count disabled proxies: {{ $disabledProxyCount }} <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
