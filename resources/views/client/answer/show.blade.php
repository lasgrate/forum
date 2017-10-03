@extends('layouts.app')

@section('content')
    @include('client.includes.header')
    <div id="chatter">
        <div id="chatter_hero">
            <div id="chatter_hero_dimmer"></div>
            <h1>@lang('client.welcome',['name' => $forum->name])</h1>
            <p>{!! $forum->description !!}</p>
        </div>
        <div class="container margin-top">
            <div class="row">

                <div class="col-md-3 left-column">

                    <div class="chatter_sidebar">
                        <div class="plus-theme">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            <a href="{{ route('theme.create', $forum->id) }}" class="btn btn-default">
                                @lang('client.create_theme')
                            </a>
                        </div>


                        <ul class="nav nav-pills nav-stacked">


                            @php $i = 0; @endphp
                            @foreach ($tags as $tag)
                                <li>
                                    @php if (!isset($colourSet[$i])) $i = 0; @endphp
                                    <a href="{{ route('answer.show' ,['forum_id' => $forum->id, 'tag' => $tag]) }}">
                                        <span class="tagIcon button-icon" style="color:{{$colourSet[$i]}}"></span>
                                        <span
                                            @if(isset($tag_id) && $tag->id == $tag_id) style="color:{{$colourSet[$i]}} @endif">
                               {{ $tag->name }}
                              </span>
                                    </a>
                                </li>
                                @php $i++ @endphp
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-9 right-column">
                    @include('client.includes.form_themes')
                </div>

            </div>
        </div>
    </div>
@endsection



