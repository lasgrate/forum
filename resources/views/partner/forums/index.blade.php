@extends('layouts.partner')


@section('title', __('partner.forums.meta_title'))

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
                                <div class="pull-right">
                                    <a href="{{ route('partner.forums.create') }}" title="@lang('common.create')"
                                       class="btn btn-primary"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('partner.forums.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('partner.dashboard') }}">@lang('common.home')</a></li>
                            <li>@lang('partner.forums.heading_title')</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i
                                            class="fa fa-list"></i>@lang('partner.forums.heading_title')</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <td class="text-center">
                                                    <a href="">@lang('partner.forums.name')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('partner.forums.title')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('common.edit')</a>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($forums as $forum)
                                                <tr>
                                                    <td class="text-center">{{ $forum->name }}</td>
                                                    <td class="text-center">{{ $forum->title }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('partner.forums.edit', ['id' => $forum->id]) }}"
                                                           data-toggle="tooltip"
                                                           title="@lang('common.edit')" class="btn btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{ $forums->links() }}
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