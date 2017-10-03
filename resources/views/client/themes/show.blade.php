@extends('layouts.app')


@section('content')
    @include('client.includes.header')
    <div id="chatter" class="discussion">

        <div id="chatter_header" style=''>
            <div class="container">
                <a class="back_btn" href="{{ url('forum/' . $forum->id) }}">
                    <i class="glyphicon glyphicon-menu-left"></i>
                </a>
                <h1>{{ $theme->name }}</h1>
                <span class="chatter_head_details">@lang('client.posted_in')
                    @foreach($theme->tags as $tag)
                        <a class="chatter_cat"
                           href="{{ route('tags.show' ,['forum_id' => $forum->id, 'tag' => $tag]) }}"
                           style="background-color:#22A7F0">
                            {{$tag->name}}
                        </a>
                    @endforeach
                </span>
            </div>
        </div>


        <div class="container margin-top">
            <div class="row">
                <div class="col-sm-12">
                    {{-- /////////--}}


                    <div class="conversation">
                        <ul class="discussions no-bg" style="display:block;">
                            <li data-id="1453" data-markdown="1">
              <span class="chatter_posts">
                 <div class="chatter_avatar">
                     @if($theme->client == null)
                         <img class="letterpic" title="{{$theme->fake_name}}">
                     @else
                         <img class="letterpic" title="{{$theme->client->name}}">
                     @endif
                 </div>
                 <div class="chatter_middle">
                   <span class="chatter_middle_details">
                        @if($theme->client == null)
                           <a>{{ucwords($theme->fake_name)}}</a>
                       @else
                           <a>{{ucwords($theme->client->name)}}</a>
                       @endif
                       <span class="ago chatter_middle_details">{{$theme->created_at}}</span>
                   </span>
                     <div class="chatter_body">
                         {!! $theme->description !!}
                     </div>
                 </div>
                 <div class="chatter_clear"></div>
              </span>
                            </li>

                            @foreach ($messages as $message)
                                @if(!$message->is_enable && Auth::guard('clients')->check() &&
                                    Auth::guard('clients')->user()->id == $message->client_id)
                                    <li>
              <span class="chatter_posts">
                 <div class="chatter_avatar">
                     <img class="letterpic" title="{{$message->client->name}}">
                 </div>
                 <div class="chatter_middle">
                   <span class="chatter_middle_details">
                      <a href="/user/redouane-gouab">{{ ucwords($message->client->name) }}</a>
                    <span class="ago chatter_middle_details">{{ $message->created_at }}</span>
                   </span>
                     <div class="chatter_body">
                         {!! $message->text !!}
                     </div>
                 </div>
                 <div class="chatter_clear"></div>
              </span>
                                    </li>
                                @elseif($message->is_enable)
                                    <li>
              <span class="chatter_posts">
                 <div class="chatter_avatar">
                     @if($message->client == null)
                         <img class="letterpic" title="{{$message->fake_name}}">
                 </div>
                 <div class="chatter_middle">
                   <span class="chatter_middle_details">
                      <a>{{ ucwords($message->fake_name) }}</a>
                       @else
                           <img class="letterpic" title="{{$message->client->name}}">
                 </div>
                 <div class="chatter_middle">
                   <span class="chatter_middle_details">
                      <a>{{ ucwords($message->client->name) }}</a>
                       @endif
                       <span class="ago chatter_middle_details">{{ $message->created_at }}</span>
                   </span>
                     <div class="chatter_body">
                         {!! $message->text !!}
                     </div>
                 </div>
                 <div class="chatter_clear"></div>
              </span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div id="pagination">
                        {!! $messages->links() !!}
                    </div>
                    @if(Auth::guard('clients')->check())
                        <div id="new_response">
                            <div class="chatter_avatar">

                                <img src="{{url('public/uploads/avatars/default.png')}}">
                            </div>
                            <div id="new_discussion">

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        {!! Form::open(['route' => ['messages.store', $forum->id]])!!}
                                        {!! Form::text('slug', $theme->slug , ['class' => 'form-control hidden']) !!}
                                        @include('client.message.form')
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else

                        <div class="panel-body" id="panel_body_center">
                            <a href="{{ url('forum/' . $forum->id .'/login') }}"> @lang('client.go')</a>
                            @lang('client.or') <a
                                href="{{ url('forum/' . $forum->id .'/register') }}"> @lang('client.registrate')</a>@lang('client.else')
                        </div>

                    @endif
                </div>
            </div> {{-- end col-12 --}}
        </div>
    </div>
@endsection
<script src="{{ asset('public/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/js/ckeditor/config.js') }}"></script>


