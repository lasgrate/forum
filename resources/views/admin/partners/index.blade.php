@extends('layouts.admin')


@section('title', __('admin.partners.meta_title'))

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
                                <div class="pull-right">
                                    <a href="{{ route('admin.partners.create') }}" title="@lang('common.create')"
                                       class="btn btn-primary"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('admin.partners.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('admin.dashboard') }}">@lang('common.home')</a></li>
                            <li>@lang('admin.partners.heading_title')</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i
                                            class="fa fa-list"></i>@lang('admin.partners.heading_title')</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <td class="text-center">
                                                    <a href="">@lang('admin.partners.email')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('admin.partners.name')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('admin.partners.login')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('common.edit')</a>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($partners as $partner)
                                                <tr>
                                                    <td class="text-center">{{ $partner->email }}</td>
                                                    <td class="text-center">{{ $partner->name }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.partner.login', ['id' => $partner->id]) }}"
                                                           title="@lang('admin.partners.login')" class="btn btn-info">
                                                            <i class="fa fa-sign-in"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.partners.edit', ['id' => $partner->id]) }}"
                                                           title="@lang('common.edit')" class="btn btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{ $partners->links() }}
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