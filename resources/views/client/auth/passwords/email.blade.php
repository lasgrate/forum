@extends('layouts.app')

@section('content')
    @include('client.includes.header')

    <div class="main_content">
        <div class="container" id="login">
            <h2 style="text-align:center">@lang('client.reset_password')</h2>
            <p style="text-align: center">@lang('client.reset_text_1')</p>
            <div id="signup_login_container">

                <form class="form-signin" method="POST" action="{{ route('password.email', $forum->id) }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" placeholder="E-mail" tabindex="0" id="email"
                               name="email" value="">
                        @if (isset($error_email))
                            <span class="help-block">
                                        <strong>{{ $error_email }}</strong>
                                    </span>
                        @endif
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
