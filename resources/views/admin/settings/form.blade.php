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
                                    <button type="submit" title="@lang('common.save')"
                                            onclick="$('form.store').submit()"
                                            class="btn btn-primary"><i class="fa fa-save"></i></button>
                                    <a href="{{ route('admin.settings.index') }}" title="@lang('common.cancel')"
                                       class="btn btn-default"><i class="fa fa-reply"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('admin.settings.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('admin.dashboard') }}">@lang('common.home')</a></li>
                            <li><a href="{{ route('admin.settings.index') }}">@lang('admin.settings.heading_title')</a>
                            </li>
                            <li>{{ $setting->name }}</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i
                                            class="fa fa-pencil"></i>@lang('admin.settings.heading_title')</h3>
                                </div>
                                <div class="panel-body">
                                    {{ BootForm::horizontal(
                                      ['model' => $setting,
                                        'store' => 'admin.settings.store',
                                        'update' => 'admin.settings.update',
                                        'left_column_class' => 'col-sm-2',
                                        'left_column_offset_class' => 'col-md-offset-2',
                                        'right_column_class' => 'col-sm-10',
                                        'class' => 'store form-horizontal',

                                      ])
                                    }}

                                    {!! BootForm::text('name', __('admin.settings.name'), $setting->name) !!}
                                    {!! BootForm::text('value', __('admin.settings.value'), $setting->value) !!}
                                    {{ BootForm::close() }}

                                    @if($setting->exists)

                                        {!! BootForm::open(['method' => 'delete', 'url' => route('admin.settings.destroy', ['id' => $setting->id]), 'class' => 'destroy']) !!}
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