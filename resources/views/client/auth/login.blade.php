@extends('layouts.app')

@section('content')
    @include('client.includes.header')

    <div class="main_content">
        <div class="container" id="login">
            <h1 style="text-align:center">@lang('client.login_below')</h1>
            <div id="signup_login_container">
                <img src="{{ asset('public/uploads/img/login-icon.png') }}"
                     style="width:100px; margin:0px auto; margin-bottom:10px; background:rgba(0, 0, 0, 0.05); border-radius:50px; border:1px solid #e5e5e5"
                     class="animated fadeIn">

                <form method="POST" action="{{ route('login', $forum->id) }}" class="form-signin">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" placeholder="E-mail" tabindex="0" id="email"
                               name="email" value="">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" placeholder="@lang('client.password')" id="password"
                               name="password" value="">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <button class="btn btn-lg btn-primary btn-block loaderOnClick"
                            type="submit">@lang('client.sing_in')</button>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('client.remember')
                            &nbsp;/&nbsp;
                            <a class="" href="{{ route('password.reset', $forum->id) }}">
                                @lang('client.forgot')
                            </a>
                        </label>
                    </div>
                    <br>

                </form>
            </div>
        </div>
    </div>
@endsection
