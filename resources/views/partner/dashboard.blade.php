@extends('layouts.admin')


@section('title', 'Dashboard')

@section('content')

    @component('partner.components.header')
    @endcomponent

    <div id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">

                    @component('partner.components.left_column')
                    @endcomponent

                </div>
                <div class="col-sm-10">

                </div>
            </div>
        </div>
    </div>

@endsection