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
                                    <button type="submit" title="@lang('common.save')"
                                            onclick="$('form.store').submit()"
                                            class="btn btn-primary"><i class="fa fa-save"></i></button>
                                    <a href="{{ route('partner.forums.index') }}" title="@lang('common.cancel')"
                                       class="btn btn-default"><i class="fa fa-reply"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('partner.forums.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('partner.dashboard') }}">@lang('common.home')</a></li>
                            <li><a href="{{ route('partner.forums.index') }}">@lang('partner.forums.heading_title')</a>
                            </li>
                            <li>{{ $forum->name }}</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-pencil"></i>@lang('common.edit')</h3>
                                </div>
                                <div class="panel-body">
                                    {{ BootForm::horizontal(
                                      ['model' => $forum,
                                        'store' => 'partner.forums.store',
                                        'update' => 'partner.forums.update',
                                        'left_column_class' => 'col-sm-2',
                                        'left_column_offset_class' => 'col-md-offset-2',
                                        'right_column_class' => 'col-sm-10',
                                        'class' => 'store form-horizontal',
                                      ])
                                    }}

                                    {!! BootForm::text('name', __('partner.forums.name')) !!}
                                    {!! BootForm::text('title', __('partner.forums.title')) !!}
                                    {!! BootForm::textarea('description', __('partner.forums.description')) !!}
                                    {!! BootForm::select('decor_id', __('partner.forums.decors_title'), $decors_list) !!}
                                    {{ BootForm::close() }}

                                    @if($forum->exists)

                                        {!! BootForm::open(['method' => 'delete', 'url' => route('partner.forums.destroy', ['id' => $forum->id]), 'class' => 'destroy']) !!}
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