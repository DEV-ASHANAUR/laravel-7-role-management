@extends('backend.auth.auth_master')
@section('auth-title')
    Login | Admin Panel
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
            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="login-form-head">
                    <h4>Reset Password</h4>
                    <p>Hey! Reset Your Password and comeback again</p>
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" value="{{ $email ?? old('email') }}" id="exampleInputEmail1">
                        <i class="ti-lock"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" name="password" id="exampleInputPassword1" required />
                        <i class="ti-lock"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="exampleInputPassword2" required />
                        <i class="ti-lock"></i>
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