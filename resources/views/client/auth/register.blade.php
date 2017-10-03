@extends('layouts.app')

@section('content')
    @include('client.includes.header')

    <div class="main_content">
        <div class="container">
            <h1 style="text-align:center; margin-top:40px;"> @lang('client.register_below')</h1>
            <div id="signup_login_container">
                <img src="{{ asset('public/uploads/img/signup-icon.png') }}"
                     style="width:100px; margin:0px auto; margin-bottom:10px; background:rgba(0, 0, 0, 0.05); border-radius:50px; border:1px solid #e5e5e5"
                     class="animated fadeIn">
                <form method="POST" action="{{ route('register', $forum->id) }}" class="form-signin">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" placeholder="@lang('client.name')" tabindex="0"
                               id="first_name" name="name" value="">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>

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
                        <input id="password" type="password" placeholder="@lang('client.password')" class="form-control"
                               name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" placeholder="@lang('client.confirm')" type="password"
                               class="form-control" name="password_confirmation" required>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block loaderOnClick"
                            type="submit">@lang('client.sing_up')</button>
                    <br>
                </form>

            </div>
        </div>
    </div>


@endsection
