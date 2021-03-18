@extends('errors.errors_layouts')
@section('error')
    Unauthorized | 403 
@endsection
@section('error-content')
    <h2>403</h2>
    <p>Access to this resource on the server is denied</p>
    <p>{{ $exception->getMessage() }}</p>

    @if (Auth::guard('admin')->user())
        <a href="{{ route('admin.dashboard') }}">Back To Dashboard</a>
        @else
        <a href="{{ route('admin.login') }}">Back To login</a>
    @endif


       
    
    
@endsection