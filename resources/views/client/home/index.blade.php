@extends('layouts.app')
@section('content')
    @include('client.includes.header')
    <div id="chatter">
        <div id="chatter_hero">
            <div id="chatter_hero_dimmer">
                <h1>@lang('client.welcome',['name' => $forum->name])</h1>
                <p>{!! $forum->description !!}</p>
            </div>
        </div>
        <div class="container margin-top">
            <div class="row">

                <div class="col-md-3 left-column">

                    @include('client.includes.left_column')

                </div>

                <div class="col-md-9 right-column">
                    @include('client.includes.form_themes')
                </div>

            </div>
        </div>
    </div>
@endsection



