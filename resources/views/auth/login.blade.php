@extends('layouts.with_navbar')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.login') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.login.action') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('auth.email') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('auth.password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('auth.rememberme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>{{ trans('auth.login') }}
                                </button>
                                <a href="{{ route('auth.register') }}" class="btn btn-success">{{ trans('auth.register') }}</a>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{ trans('auth.forgotpassword') }}</a>
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <a href="{{ route('socialite', ['driver' => 'weibo']) }}"><img class="login-3rd" src="{{ asset('images/weibo_login.png') }}"></a>
                            <a href="{{ route('socialite', ['driver' => 'linkedin']) }}"><img class="login-3rd" src="{{ asset('images/linkedin_login.png') }}"></a>
                            <a href="{{ route('socialite', ['driver' => 'github']) }}"><img class="login-3rd" src="{{ asset('images/github_login.png') }}"></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <style>
        .login-3rd {
            height: 24px;
        }
    </style>
@endsection
