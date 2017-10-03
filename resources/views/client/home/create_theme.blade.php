@extends('layouts.app')

@section('style')

@endsection

@section('content')
    @include('client.includes.header')
    <div id="chatter">
        <div id="chatter_header" style=''>
            <div class="container">
                <a class="back_btn" href="{{ url('forum/' . $forum->id) }}"><i
                        class="glyphicon glyphicon-menu-left"></i></a>
                <h1> @lang('client.create_theme') </h1>
            </div>
        </div>

        <div class="container margin-top">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">

                        <div class="panel-body">

                            {!! Form::open(['route' => ['theme.store', $forum->id]])!!}
                            <div class="form-group">
                                <label class="control-label" for="input-tags">@lang('client.tag')</label>
                                <input type="text" name="tags"
                                       value="" id="input-tags"
                                       class="form-control"/>
                                <div id="tag-select" class="well well-sm" style="height: 150px; overflow: auto;">

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', __('client.title')) !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                {!! Form::label('body', __('client.body')) !!}
                                {!! Form::textarea('body', null, ['class' => 'form-control ckeditor']) !!}
                                <small class="text-danger">{{ $errors->first('body') }}</small>
                            </div>

                            {!! Form::submit(__('client.create'), ['class'=>'btn btn-primary btn-block']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $('#input-tags').autocomplete({

            'source': function (request, response) {

                console.log(request);

                var forum_id = $('#forum_id').val();

                $.ajax({

                    url: '{{ route('client.tags.autocomplete', $forum->id) }}',
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

<script src="{{ asset('public/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/js/ckeditor/config.js') }}"></script>

