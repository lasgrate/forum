<aside>
    <ul class="list-group">
        @foreach($leftColumnItems as $item => $route)
            <a class="list-group-item list-group-item-action @if($route['active']) {{ 'active' }} @endif"
               href="{{ route($route['name']) }}">
                @lang("partner.left_column.$item")
            </a>
        @endforeach
    </ul>
</aside>