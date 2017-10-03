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
                                    <button type="submit" data-toggle="tooltip" title="@lang('common.save')"
                                            onclick="$('form.store').submit()"
                                            class="btn btn-primary"><i class="fa fa-save"></i></button>
                                    <a href="{{ route('admin.partners.index') }}" data-toggle="tooltip"
                                       title="@lang('common.cancel')"
                                       class="btn btn-default"><i class="fa fa-reply"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('admin.partners.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('admin.dashboard') }}">@lang('common.home')</a></li>
                            <li><a href="{{ route('admin.partners.index') }}">@lang('admin.partners.heading_title')</a>
                            </li>
                            <li>{{ $partner->name }}</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-pencil"></i>@lang('common.edit')</h3>
                                </div>
                                <div class="panel-body">
                                    {{ BootForm::horizontal(
                                      ['model' => $partner,
                                        'store' => 'admin.partners.store',
                                        'update' => 'admin.partners.update',
                                        'left_column_class' => 'col-sm-2',
                                        'left_column_offset_class' => 'col-md-offset-2',
                                        'right_column_class' => 'col-sm-10',
                                         'class' => 'store form-horizontal',
                                      ])
                                    }}

                                    {!! BootForm::email('email', __('admin.partners.email'), $partner->email) !!}
                                    {!! BootForm::text('name', __('admin.partners.name'), $partner->name) !!}
                                    {!! BootForm::password('password', __('admin.partners.password')) !!}
                                    {!! BootForm::password('password_confirmation', __('admin.partners.confirm')) !!}
                                    {{ BootForm::close() }}

                                    @if ($partner->exists)

                                        {!! BootForm::open(['method' => 'delete', 'url' => route('admin.partners.destroy', ['id' => $partner->id]), 'class' => 'destroy']) !!}
                                        {!! BootForm::close() !!}

                                        <a href="#" data-action="destroy"
                                           onclick="confirm('@lang('common.confirm_delete')') ? $(this).siblings('form.destroy').submit() : false; return false;"
                                           class="btn btn-danger pull-right">@lang('common.delete')</a>
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