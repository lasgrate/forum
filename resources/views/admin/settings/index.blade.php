@extends('layouts.admin')


@section('title', __('admin.settings.meta_title'))

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
                                    <a href="{{ route('admin.settings.create') }}" title="" class="btn btn-primary"
                                       data-original-title="@lang('common.create')"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('admin.settings.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('admin.dashboard') }}">@lang('common.home')</a></li>
                            <li>@lang('admin.settings.heading_title')</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i
                                            class="fa fa-list"></i>@lang('admin.settings.heading_title')</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <td class="text-left">
                                                    <a href="">@lang('admin.settings.name')</a>
                                                </td>
                                                <td class="text-left">
                                                    <a href="">@lang('admin.settings.value')</a>
                                                </td>
                                                <td class="text-left">
                                                    <a href="">@lang('common.edit')</a>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($settings as $setting)
                                                <tr>
                                                    <td class="text-center">{{ $setting->name }}</td>
                                                    <td class="text-center">{{ $setting->value }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.settings.edit', ['id' => $setting->id]) }}"
                                                           title="@lang('common.edit')" class="btn btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{ $settings->links() }}
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