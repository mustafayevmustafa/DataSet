@extends('layout')
@section('title', 'Dataset List')

@section('content')
    <div class="container">
        @include('sections.filter')

        @include('sections.table')
    </div>
@endsection
