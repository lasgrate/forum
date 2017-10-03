@extends('layouts.admin')


@section('title', __('admin.clients.meta_title'))

@section('content')

    @include('admin.includes.header')

    <div id="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-2">

                    @include('admin.includes.left_column')

                </div>
                <div class="col-sm-10">
                    <div id="content">
                        <div class="page-header">
                            <div class="container-fluid">
                                <div class="pull-left">
                                    <h1>@lang('admin.clients.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('admin.dashboard') }}">@lang('common.home')</a></li>
                            <li>@lang('admin.clients.heading_title')</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i
                                            class="fa fa-list"></i>@lang('admin.clients.heading_title')</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <td class="text-center">
                                                    <a href="">@lang('admin.clients.email')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('admin.clients.name')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('admin.clients.created_at')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('admin.clients.login')</a>
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
                                                        <a href="{{ route('admin.clients.login', ['client_id' => $client->id]) }}"
                                                           data-toggle="tooltip"
                                                           title="@lang('admin.clients.login')" class="btn btn-info">
                                                            <i class="fa fa-sign-in">

                                                            </i>
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