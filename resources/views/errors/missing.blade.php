@extends('layouts.app')

@section('content')
    <div id="main_content">
        <div class="container">
            <div class="col-md-12" style="text-align:center;">
                <h1 style="font-size:80px;">404</h1>
                <p style="color:#ccc; font-size:18px;">For shame... This page no longer exists or may have never existed...</p><br>
                <img class="not_found" src="{{url('public/uploads/img/r_404.png')}}">

                <div style="clear:both"></div><br><br>
                <a href="{{ url('forum/' . $forum->id) }}" class="btn btn-danger">Click Here to return Home</a>
                <div style="clear:both"></div>
                <br><br><br>
            </div>
        </div>
    </div>
@endsection
