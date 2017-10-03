@extends('layouts.partner')


@section('title', __('partner.themes.meta_title'))

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
                  <a href="{{ route('partner.themes.create') }}" title="@lang('common.create')" class="btn btn-primary"><i
                      class="fa fa-plus"></i></a>
                </div>
                <div class="pull-left">
                  <h1>@lang('partner.themes.heading_title')</h1>
                </div>
              </div>
            </div>
            <ul class="breadcrumb">
              <li><a href="{{ route('partner.dashboard') }}">@lang('common.home')</a></li>
              <li>@lang('partner.themes.heading_title')</li>
            </ul>
            <div class="container-fluid">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-list"></i>@lang('partner.themes.heading_title')</h3>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <td class="text-center">
                          <a href="">@lang('partner.themes.name')</a>
                        </td>
                        <td class="text-center">
                          <a href="">@lang('partner.forums.heading_title')</a>
                        </td>
                        <td class="text-center">
                          <a href="">@lang('partner.themes.is_enable')</a>
                        </td>
                        <td class="text-center">
                          <a href="">@lang('partner.themes.created_at')</a>
                        </td>
                        <td class="text-center">
                          <a href="">@lang('partner.themes.new_messages')</a>
                        </td>
                        <td class="text-center">
                          <a href="">@lang('partner.themes.messages')</a>
                        </td>
                        <td class="text-center">
                          <a href="">@lang('common.edit')</a>
                        </td>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($themes as $theme)
                        <tr>
                          <td class="text-center">{{ $theme->name }}</td>
                          <td class="text-center">
                            <a href="{{ route('partner.forums.edit', ['id' => $theme->forum->id]) }}">
                              {{ $theme->forum->name }}
                            </a>
                          </td>
                          <td class="text-center">
                            @if($theme->is_enable)
                              @lang('common.enabled')
                            @else
                              @lang('common.disabled')
                            @endif
                          </td>
                          <td class="text-center">{{ $theme->created_at }}</td>
                          <td class="text-center">{{ $theme->viewed_messages }}</td>
                          <td class="text-center">
                            <a href="{{ route('partner.messages.index', ['theme_id' => $theme->id]) }}"
                               title="@lang('partner.themes.messages')" class="btn btn-primary">
                              <i class="fa fa-eye"></i>
                            </a>
                          </td>
                          <td class="text-center">
                            <a href="{{ route('partner.themes.edit', ['id' => $theme->id]) }}"
                               title="@lang('common.edit')" class="btn btn-primary">
                              <i class="fa fa-pencil"></i>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    {{ $themes->links() }}
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