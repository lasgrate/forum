@extends('layouts.admin')


@section('title', 'Dashboard')

@section('content')

    @component('admin.components.header')
    @endcomponent

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">

                    @component('admin.components.left_column')
                    @endcomponent

                </div>
                <div class="col-sm-10">

                </div>
            </div>
        </div>
    </div>

@endsection