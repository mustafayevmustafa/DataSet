@extends('layout')
@section('title', 'Dataset Import')
@section('content')
    <div class="container">
        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif

        <form action="{{ route('datasets.import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="csv_file" class="form-label">CSV File</label>
                <input type="file" class="form-control @error('csv_file') is-invalid @enderror" id="csv_file" name="csv_file">

                @error('csv_file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Import</button>
        </form>

    </div>
@endsection
