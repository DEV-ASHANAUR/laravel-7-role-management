@extends('errors.errors_layouts')
@section('error')
    Server Error | 500
@endsection
@section('error-content')
    <h2>404</h2>
    <p>Sorry !! Internal Server Error !</p>
    {{-- <p>{{ $exception->getMessage() }}</p> --}}

    @if (Auth::guard('admin')->user())
        <a href="{{ route('admin.dashboard') }}">Back To Dashboard</a>
        @else
        <a href="{{ route('admin.login') }}">Back To login</a>
    @endif

@endsection