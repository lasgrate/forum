@extends('layouts.admin')


@section('title', __('admin.decors.meta_title'))

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
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="container-fluid">
                                <div class="pull-right">
                                    <button type="submit" title="@lang('common.save')"
                                            onclick="$('form.store').submit()"
                                            class="btn btn-primary"><i class="fa fa-save"></i></button>
                                    <a href="{{ route('admin.decors.index') }}" title="@lang('common.cancel')"
                                       class="btn btn-default"><i class="fa fa-reply"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('admin.decors.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('admin.dashboard') }}">@lang('common.home')</a></li>
                            <li><a href="{{ route('admin.decors.index') }}">@lang('admin.decors.heading_title')</a></li>
                            <li>{{ $decor->name }}</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i
                                            class="fa fa-pencil"></i>@lang('admin.decors.heading_title')</h3>
                                </div>
                                <div class="panel-body">
                                    {{ BootForm::horizontal(
                                      ['model' => $decor,
                                        'store' => 'admin.decors.store',
                                        'update' => 'admin.decors.update',
                                        'left_column_class' => 'col-sm-2',
                                        'left_column_offset_class' => 'col-md-offset-2',
                                        'right_column_class' => 'col-sm-10',
                                        'class' => 'store form-horizontal',
                                         'files'  => true
                                      ])
                                    }}

                                    {!! BootForm::file('style', __('admin.decors.file')) !!}
                                    {!! BootForm::text('name', __('admin.decors.name'), $decor->name) !!}
                                    {!! BootForm::text('colors', __('admin.decors.colors'), $decor->colors) !!}
                                    {{ BootForm::close() }}

                                    @if ($decor->exists)

                                        {!! BootForm::open(['method' => 'delete', 'url' => route('admin.decors.destroy', ['id' => $decor->id]), 'class' => 'destroy']) !!}
                                        {!! BootForm::close() !!}

                                        <a href="#" data-action="destroy"
                                           onclick="confirm('@lang('common.confirm_delete')') ? $(this).siblings('form.destroy').submit() : false; return false;"
                                           class="btn btn-danger pull-right">Delete</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection