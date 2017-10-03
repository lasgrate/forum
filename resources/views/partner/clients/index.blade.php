@extends('layouts.partner')


@section('title', __('partner.clients.meta_title'))

@section('content')

    @include('partner.includes.header')

    <div id="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-2">

                    @include('partner.includes.left_column')

                </div>
                <div class="col-sm-10">
                    <div id="content">
                        <div class="page-header">
                            <div class="container-fluid">
                                <div class="pull-left">
                                    <h1>@lang('partner.clients.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('partner.dashboard') }}">@lang('common.home')</a></li>
                            <li>@lang('partner.clients.heading_title')</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i
                                            class="fa fa-list"></i>@lang('partner.clients.heading_title')</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <td class="text-center">
                                                    <a href="">@lang('partner.clients.name')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('partner.clients.name')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('partner.clients.created_at')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('partner.clients.login')</a>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($clients as $client)
                                                <tr>
                                                    <td class="text-center">{{ $client->email }}</td>
                                                    <td class="text-center">{{ $client->name }}</td>
                                                    <td class="text-center">{{ $client->created_at }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('partner.clients.login', ['client_id' => $client->id]) }}"
                                                           title="@lang('partner.clients.login')" class="btn btn-info">
                                                            <i class="fa fa-sign-in"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{ $clients->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection