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
                                    <button type="submit" data-toggle="tooltip" title="@lang('common.save')"
                                            onclick="$('form.store').submit()"
                                            class="btn btn-primary"><i class="fa fa-save"></i></button>
                                    <a href="{{ route('partner.tags.index') }}" data-toggle="tooltip"
                                       title="@lang('common.cancel')"
                                       class="btn btn-default"><i class="fa fa-reply"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('partner.tags.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('partner.dashboard') }}">@lang('common.home')</a></li>
                            <li><a href="{{ route('partner.tags.index') }}">@lang('partner.tags.heading_title')</a></li>
                            <li>{{ $tag->name }}</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-pencil"></i>@lang('common.edit')</h3>
                                </div>
                                <div class="panel-body">
                                    {{ BootForm::horizontal(
                                      ['model' => $tag,
                                        'store' => 'partner.tags.store',
                                        'update' => 'partner.tags.update',
                                        'left_column_class' => 'col-sm-2',
                                        'left_column_offset_class' => 'col-md-offset-2',
                                        'right_column_class' => 'col-sm-10',
                                        'class' => 'store form-horizontal',
                                      ])
                                    }}

                                    {!! BootForm::select('forum_id', __('partner.tags.forum'), $forums_list) !!}
                                    {!! BootForm::text('name', __('partner.tags.name')) !!}

                                    {{ BootForm::close() }}

                                    @if($tag->exists)

                                        {!! BootForm::open(['method' => 'delete', 'url' => route('partner.tags.destroy', ['id' => $tag->id]), 'class' => 'destroy']) !!}
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