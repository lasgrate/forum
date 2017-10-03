@extends('layouts.app')

@section('content')
    @include('client.includes.header')
    <div class="main_content">
        <div class="container" id="login">
            <h2 style="text-align:center">@lang('client.reset_password')</h2>
            <p style="text-align: center">@lang('client.reset_text_2')</p>
            <div id="signup_login_container">
                <form class="form-signin" method="POST" action="{{ route('password.request',['forum_id' => $forum->id,
                'token' => $token]) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" placeholder="E-mail" class="form-control" name="email"
                               value="{{ $email or old('email') }}" required autofocus>
                        @if (isset($error_email))
                            <span class="help-block">
                                        <strong>{{  $error_email }}</strong>
                                    </span>
                        @endif
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" placeholder="@lang('client.password')" type="password" class="form-control"
                               name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input id="password-confirm" placeholder="@lang('client.confirm')" type="password"
                               class="form-control" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <button class="btn btn-lg btn-primary btn-block loaderOnClick"
                            type="submit">@lang('client.reset_button')</button>

                </form>
            </div>
        </div>
    </div>

@endsection
