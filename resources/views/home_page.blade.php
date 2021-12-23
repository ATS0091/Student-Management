@extends('layouts.authentication')
@section('title', 'Archdiocese / Parish / BCC Panel')
@section('content')

    {{-- <script src="https://www.google.com/recaptcha/api.js?render={{env('GOOGLE_RECAPTCHA_KEY')}}"></script> --}}
    <style>
        .recovers {
            padding-top: 15px;
        }

        p.lead {
            font-weight: bolder;
            text-transform: uppercase;
        }

        .card .header {
            padding: 20px 20px 0px 20px !important;
            text-align: center;
        }

        .submit {
            text-transform: uppercase;
        }

        .submits {
            text-align: center;
        }

    </style>
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle auth-main">
            <div class="auth-box" style="width: 410px;">
                <div class="top">
                    <div class="parish_head" style="width:100%;">Welcome to Student management system</div>
                </div>
                <div class="card">
                    <div class="header">
                        <p class="lead">Login to your account</p>
                    </div>
                    <div class="body">
                        <form class="form-auth-small" method="POST" id="login_form" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="form-group">
                                <label for="signin-email" class="control-label sr-only">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="signin-email" value="{{ old('email') }}" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="signin-password" class="control-label sr-only">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="signin-password" value="" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group clearfix">
                                <label class="fancy-checkbox element-left">
                                    <input type="checkbox" name="remember">
                                    <span>Remember me</span>
                                </label>
                            </div>

                            <div class="form-group clearfix submits">
                                <button type="submit" id="submitDemo"
                                    class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                <div class="bottom forgot_pw">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i>
                                        @if (Route::has('password.request'))
                                            <a class="" href="{{ route('password.request') }}">Forgot password?</a>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script>
    </script>
    <script>
    </script>
@stop
