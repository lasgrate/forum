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
                  <button type="submit" title="@lang('common.save')"
                          onclick="$('form.store').submit()"
                          class="btn btn-primary"><i class="fa fa-save"></i></button>
                  <a href="{{ route('partner.themes.index') }}" title="@lang('common.cancel')"
                     class="btn btn-default"><i class="fa fa-reply"></i></a>
                </div>
                <div class="pull-left">
                  <h1>
                    @lang('partner.themes.heading_title')
                  </h1>
                </div>
              </div>
            </div>
            <ul class="breadcrumb">
              <li><a href="{{ route('partner.dashboard') }}">@lang('common.home')</a></li>
              <li><a href="{{ route('partner.themes.index') }}">@lang('partner.themes.heading_title')</a></li>
              <li>{{ $theme->name }}</li>
            </ul>
            <div class="container-fluid">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-pencil"></i>@lang('common.edit')</h3>
                </div>
                <div class="panel-body">
                  {{ BootForm::horizontal(
                    ['model' => $theme,
                      'store' => 'partner.themes.store',
                      'update' => 'partner.themes.update',
                      'left_column_class' => 'col-sm-2',
                      'left_column_offset_class' => 'col-md-offset-2',
                      'right_column_class' => 'col-sm-10',
                      'class' => 'store form-horizontal',
                    ])
                  }}

                  {!! BootForm::select('forum_id', __('partner.forums.heading_title'), $forums_list) !!}
                  {!! BootForm::text('name', __('partner.themes.name')) !!}
                  {!! BootForm::text('fake_name', __('partner.themes.fake_name'), is_null($theme->fake_name) ? $faker->userName : $theme->fake_name) !!}
                  {!! BootForm::textarea('description', __('partner.themes.description')) !!}
                  {!! BootForm::text('created_at', __('partner.themes.created_at')) !!}
                  {!! BootForm::select('is_enable', __('partner.themes.is_enable'), [
                      '1' => __('common.enable'),
                      '0' => __('common.disable'),
                  ]) !!}

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-tags">@lang('partner.tags.heading_title')</label>
                    <div class="col-sm-10">
                      <input type="text" name="tags"
                             value="" id="input-tags"
                             class="form-control"/>

                      <div id="tag-select" class="well well-sm" style="height: 150px; overflow: auto;">
                        @foreach($tags as $tag)
                          <div id="tag_{{ $tag->id }}">
                            <i class="fa fa-minus-circle"></i>
                            <a href="{{ route('partner.tags.edit', ['id' => $tag->id]) }}">{{ $tag->name }}</a>
                            <input type="hidden" name="tags[]" value="{{ $tag->id }}"/>
                          </div>
                        @endforeach
                      </div>

                    </div>
                  </div>

                  {{ BootForm::close() }}

                  @if($theme->exists)

                    {!! BootForm::open(['method' => 'delete', 'url' => route('partner.themes.destroy', ['id' => $theme->id]), 'class' => 'destroy']) !!}
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
  <script>
    $('#created_at').datetimepicker({
      locale: 'ru',
      format: 'YYYY-MM-DD HH:mm:ss'
    });

    $('#input-tags').autocomplete({

      'source': function (request, response) {

        var forum_id = $('#forum_id').val();

        $.ajax({

          url: '{{ route('partner.tags.autocomplete') }}',
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'post',
          data: {
            name: request,
            forum_id: forum_id,
          },

          error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
          },

          success: function (json) {

            response($.map(json, function (item) {
              return {
                label: item['name'],
                value: item['id']
              }
            }));
          }
        });

      },
      'select': function (item) {

        $('#input-tag').val('');

        var html = '' +
          '<div id="tag_' + item['value'] + '">' +
          '<i class="fa fa-minus-circle"></i> ' + item['label'] + '' +
          '<input type="hidden" name="tags[]" value="' + item['value'] + '" />' +
          '</div>';

        $('#tag-select').append(html);
      }
    });

    $('#tag-select').delegate('.fa-minus-circle', 'click', function () {
      $(this).parent().remove();
    });

  </script>

@endsection