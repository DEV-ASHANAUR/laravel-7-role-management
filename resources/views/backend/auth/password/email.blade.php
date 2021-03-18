@extends('backend.auth.auth_master')
@section('auth-title')
    Forgot Password | Admin Panel
@endsection
@section('style')
    <style>
        .invalid-feedback {
            display: inline;
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545;
        }
    </style>
@endsection
@section('auth-content')
<div class="login-area login-bg">
    <div class="container">
        <div class="login-box ptb--100">
            <form action="{{ route('admin.password.email') }}" method="POST">
                @csrf
                <div class="login-form-head">
                    <h4>Forgot Password</h4>
                    <p>Hey! Forgot Your Password ? Reset Now</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" id="exampleInputEmail1">
                        <i class="ti-lock"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="submit-btn-area mt-5">
                        <button id="form_submit" type="submit">Reset <i class="ti-arrow-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection