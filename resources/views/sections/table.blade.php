<div class="container">
    <div class="row mt-3 mb-3">
        <div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="col">
            <a href="{{ route('datasets.import') }}" class="btn btn-primary">Import</a>
            <a href="{{ route('datasets.export', Request::query()) }}" class="btn btn-danger">Export</a>
            <a href="{{ route('datasets.index', Request::query()) }}" class="btn btn-info">Refresh</a>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">Birthday</th>
        </tr>
        </thead>
        <tbody>
        @forelse($datasets as $dataset)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $dataset->category }}</td>
                <td>{{ $dataset->firstname }}</td>
                <td>{{ $dataset->lastname }}</td>
                <td>{{ $dataset->email }}</td>
                <td>{{ $dataset->gender }}</td>
                <td>{{ $dataset->birthDate }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No datasets found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $datasets->appends(request()->except('page'))->links() }}
</div>
