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
                                    <a href="{{ route('partner.themes.index') }}" data-toggle="tooltip"
                                       title="@lang('common.cancel')"
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
                                <a href="{{ route('partner.themes.edit', ['id' => $theme->id]) }}">{{ $theme->name }}</a>
                            </li>
                            <li>@lang('partner.messages.heading_title')</li>
                        </ul>
                        <div class="container-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-pencil"></i>@lang('common.edit')</h3>
                                </div>
                                <div class="panel-body">
                                    {{ BootForm::horizontal(
                                      [
                                        'method' => 'post',
                                        'url' => route('partner.messages.store', ['theme_id' => $theme->id]),
                                        'left_column_class' => 'col-sm-2',
                                        'left_column_offset_class' => 'col-md-offset-2',
                                        'right_column_class' => 'col-sm-10',
                                        'class' => 'store form-horizontal',
                                      ])
                                    }}

                                    {!! BootForm::text('fake_name', __('partner.messages.fake_name'), $faker->userName) !!}
                                    {!! BootForm::textarea('text', __('partner.messages.text')) !!}
                                    {!! BootForm::text('created_at', __('partner.messages.created_at'), $carbon::now('Europe/Moscow')) !!}
                                    {!! BootForm::select('is_enable', __('partner.messages.is_enable'), [
                                        '1' => __('common.enable'),
                                        '0' => __('common.disable'),
                                    ]) !!}
                                    {!! BootForm::submit(__('partner.messages.create_fake_message')) !!}
                                    {{ BootForm::close() }}

                                    {{ $messages->links() }}
                                    <div class="messages_list">
                                        @foreach($messages as $message)
                                            <a href="{{ route('partner.messages.edit', ['id' => $message->id]) }}"
                                               class="list-group">
                                                <div class="list-group-item">
                                                    <div class="list-group-item-heading">
                                                        <div class="pull-left">
                                                            <h4 class="name">
                                                                @if(is_null($message->client))
                                                                    {{ $message->fake_name }}
                                                                @else
                                                                    {{ $message->client->name }}
                                                                @endif
                                                            </h4>
                                                            @if(!$message->user_view)
                                                                {!! '<span class="new">' . __('partner.messages.new') . '</span>' !!}
                                                            @endif
                                                            @if(is_null($message->client))
                                                                {!! '<span class="fake">' . __('partner.messages.fake') . '</span>' !!}
                                                            @endif
                                                        </div>
                                                        <div class="pull-right">
                                                            <h5>
                                                                @if($message->is_enable)
                                                                    <span class="enable">@lang('common.enabled')</span>
                                                                @else
                                                                    <span
                                                                        class="disable">@lang('common.disabled')</span>
                                                                @endif
                                                            </h5>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <h5>
                                                        {{ $message->created_at }}
                                                    </h5>
                                                    <p class="list-group-item-text">
                                                        {{ $message->text }}
                                                    </p>
                                                </div>

                                            </a>
                                        @endforeach
                                    </div>
                                    {{ $messages->links() }}
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