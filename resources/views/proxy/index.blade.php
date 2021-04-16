@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Check your proxy') }}</div>

                <div class="card-body">
                    @include('custom.proxy-table', ['proxies' => $proxies])
                    {{ $proxies->links() }}
                </div>
        </div>
    </div>
</div>
@endsection
