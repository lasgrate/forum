@extends('layouts.partner')


@section('title', __('partner.messages.meta_title'))

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
                                    <a href="{{ route('partner.messages.index', ['theme_id' => $message->theme->id]) }}"
                                       data-toggle="tooltip" title="@lang('common.cancel')"
                                       class="btn btn-default"><i class="fa fa-reply"></i></a>
                                </div>
                                <div class="pull-left">
                                    <h1>@lang('partner.messages.heading_title')</h1>
                                </div>
                            </div>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('partner.dashboard') }}">@lang('common.home')</a></li>
                            <li><a href="{{ route('partner.themes.index') }}">@lang('partner.themes.heading_title')</a>
                            </li>
                            <li>
                                <a href="{{ route('partner.themes.edit', ['id' => $message->theme->id]) }}">{{ $message->theme->name }}</a>
                            </li>
                            <li>
                                <a href="{{ route('partner.messages.index', ['theme_id' => $message->theme->id]) }}">@lang('partner.messages.heading_title')</a>
                            </li>
                            <li>{{ $message->id }}</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-pencil"></i>@lang('common.edit')</h3>
                                </div>
                                <div class="panel-body">
                                    {{ BootForm::horizontal(
                                      [
                                        'method' => 'put',
                                        'model' => $message,
                                        'url' => route('partner.messages.update', ['id' => $message->id]),
                                        'left_column_class' => 'col-sm-2',
                                        'left_column_offset_class' => 'col-md-offset-2',
                                        'right_column_class' => 'col-sm-10',
                                        'class' => 'store form-horizontal',
                                      ])
                                    }}

                                    @if($isClient)
                                        {!! BootForm::text('name', __('partner.messages.client_name'), $message->client->name, ['disabled']) !!}
                                    @else
                                        {!! BootForm::text('fake_name', __('partner.messages.fake_name')) !!}
                                    @endif
                                    {!! BootForm::textarea('text', __('partner.messages.text')) !!}
                                    {!! BootForm::text('created_at', __('partner.messages.created_at')) !!}
                                    {!! BootForm::select('is_enable', __('partner.messages.is_enable'), [
                                        '1' => __('common.enable'),
                                        '0' => __('common.disable'),
                                    ]) !!}
                                    {{ BootForm::close() }}

                                    {!! BootForm::open(['method' => 'delete', 'url' => route('partner.messages.destroy', ['id' => $message->id, 'theme_id' => $message->theme->id]), 'class' => 'destroy']) !!}
                                    {!! BootForm::close() !!}

                                    <a href="#" data-action="destroy"
                                       onclick="confirm('@lang('common.confirm_delete')') ? $(this).siblings('form.destroy').submit() : false; return false;"
                                       class="btn btn-danger pull-right">
                                        @lang('common.delete')
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      $('#created_at').datetimepicker({
        locale: 'ru',
        format: 'YYYY-MM-DD HH:mm:ss'
      });
    </script>

@endsection