<table class="table">
    <thead>
    <tr>
        <th scope="col">#ID</th>
        <th scope="col">Check status</th>
        <th scope="col">Ip</th>
        <th scope="col">Port</th>
        <th scope="col">Status</th>
        <th scope="col">Type</th>
        <th scope="col">GEO</th>
        <th scope="col">Speed</th>
        <th scope="col">Real IP</th>
        <th scope="col">Created AT</th>
        <th scope="col">Last update AT</th>
        <th scope="col">Time spent on check</th>
    </tr>
    </thead>
    <tbody>
    @foreach($proxies as $proxy)
        <tr>
            <th scope="row">{{ $proxy->id }}</th>
            <td><i class="bi {{ $proxy->is_checked ? 'bi-check bg-success' : 'bi-x alert-warning' }}"></i></td>
            <td>{{ $proxy->ip }}</td>
            <td>{{ $proxy->port }}</td>
            <td>{{ $proxy->status }}</td>
            <td>{{ $proxy->type }}</td>
            <td>{{ $proxy->geo }}</td>
            <td>{{ $proxy->speed }}</td>
            <td>{{ $proxy->real_ip }}</td>
            <td>{{ $proxy->created_at->toDateTimeString() }}</td>
            <td>{{ $proxy->updated_at->toDateTimeString() }}</td>
            <td>{{ $proxy->check_time_sec }} (sec)</td>
        </tr>
    @endforeach

    </tbody>
</table>
