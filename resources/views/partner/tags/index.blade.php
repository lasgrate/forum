@extends('layouts.partner')


@section('title', __('partner.tags.meta_title'))

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
                                    <a href="{{ route('partner.tags.create') }}" title="" class="btn btn-primary"
                                       data-original-title="@lang('common.create')"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('partner.tags.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('partner.dashboard') }}">@lang('common.home')</a></li>
                            <li>@lang('partner.tags.heading_title')</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i
                                            class="fa fa-list"></i>@lang('partner.tags.heading_title')</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <td class="text-center">
                                                    <a href="">@lang('partner.tags.name')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('partner.tags.forum')</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="">@lang('common.edit')</a>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($tags as $tag)
                                                <tr>
                                                    <td class="text-center">{{ $tag->name }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('partner.forums.edit', ['id' => $tag->forum->id]) }}">
                                                            {{ $tag->forum->name }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('partner.tags.edit', ['id' => $tag->id]) }}"
                                                           data-toggle="tooltip"
                                                           title="@lang('common.edit')" class="btn btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{ $tags->links() }}
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