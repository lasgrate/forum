<div class="panel">
    @if (count($themes) != null)
        <ul class="discussions">
            @php $i = 0; @endphp
            @foreach($themes as $theme)
                @php if (!isset($colourSet[$i])) $i = 0; @endphp
                <li>
                    <a class="discussion_list"
                       href="{{ route('theme.show', ['id' => $forum->id, 'slug' => $theme->slug]) }}">
                        <div class="chatter_avatar">
                            @if($theme->client == null)
                                <img class="letterpic" title="{{$theme->fake_name}}">
                            @else
                                <img class="letterpic" title="{{$theme->client->name}}">
                            @endif
                        </div>
                        <div class="chatter_middle">
                            <h3 class="chatter_middle_title">{{ $theme->name }}
                                @foreach($theme->tags as $tag)

                                    <div class="chatter_cat" style="background-color:{{$colourSet[$i]}}">
                                        {{$tag->name}}
                                    </div>
                                @endforeach

                            </h3>

                            <span class="chatter_middle_details">@lang('client.posted_by'):
                                @if($theme->client == null)
                                    <span>{{$theme->fake_name}}</span>
                                @else
                                    <span>{{$theme->client->name}}</span>
                                @endif
                                {{$theme->created_at}}
                                    </span>
                            <p>{!!$theme->description!!}</p>
                        </div>
                        @if(Auth::check() && Auth::user()->id == $theme->client_id && in_array($theme->id , $data))
                            <i class="fa fa-bell fa-lg" style="float: right"></i>
                        @endif
                        <div class="chatter_right">
                            @php $count = 0; @endphp
                            @foreach($theme->messages as $message)
                                @if(!$message->is_enable && Auth::guard('clients')->check() &&
                         Auth::guard('clients')->user()->id == $message->client_id)
                                    @php $count ++; @endphp
                                @elseif($message->is_enable)
                                    @php $count ++; @endphp
                                @endif
                            @endforeach
                            <div class="chatter_count">
                                <i class="chatter-bubble"></i>
                                {{ $count }}
                            </div>
                        </div>
                        <div class="chatter_clear"></div>
                    </a>
                </li>
                @php $i++ @endphp
            @endforeach
        </ul>
    @else
        <div class="img_wrapper">
            <img class="not_found" src="{{url('public/uploads/img/r_404.png')}}">
        </div>
    @endif

</div>
<div id="pagination">
    {{ $themes->links() }}
</div>