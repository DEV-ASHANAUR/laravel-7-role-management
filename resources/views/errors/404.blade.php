@extends('errors.errors_layouts')
@section('error')
    Not Found | 404 
@endsection
@section('error-content')
    <h2>404</h2>
    <p>Sorry !! page Not Found !</p>
    {{-- <p>{{ $exception->getMessage() }}</p> --}}

    @if (Auth::guard('admin')->user())
        <a href="{{ route('admin.dashboard') }}">Back To Dashboard</a>
        @else
        <a href="{{ route('admin.login') }}">Back To login</a>
    @endif

@endsection