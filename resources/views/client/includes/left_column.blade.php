<div class="chatter_sidebar">
    <div class="plus-theme">
        <i class="glyphicon glyphicon-plus-sign"></i>
        <a href="{{ route('theme.create', $forum->id) }}" class="btn btn-default">
            @lang('client.create_theme')
        </a>
    </div>


    <ul class="nav nav-pills nav-stacked">
        <li>
            <a href="{{ url('forum/' . $forum->id) }}">
                <i class="chatter-bubble"></i>
                @if (count($forum->tags) == null)
                    <span> @lang('client.no_tags')  </span></a>
            @else
                <span> @lang('client.all_tags') </span></a>
            @endif
        </li>

        @php $i = 0; @endphp
        @foreach ($forum->tags as $tag)
            <li>
                @php if (!isset($colourSet[$i])) $i = 0; @endphp
                <a href="{{ route('tags.show' ,['forum_id' => $forum->id, 'tag' => $tag]) }}">
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