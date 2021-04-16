@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Check your proxy') }}</div>

                    <div class="card-body">
                        @include('custom.validate-errors')
                        <form method="POST" action="{{ route('proxy-lists.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="body">Proxy</label>
                                <textarea class="form-control" name="body" id="body" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="btn btn-secondary">
                                    Or Browse <input type="file" name="file" id="file" hidden>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Check proxy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
