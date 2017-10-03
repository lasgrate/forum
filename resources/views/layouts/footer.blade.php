<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @if(!empty($forum->logo))
                <a href="{{ url('forum/' . $forum->id) }}" class="logo">
                        <img src="{{ url('public/uploads/forums_logo/'.$forum->logo) }}">
                </a><br>
                @else
                    <a href="{{ url('forum/' . $forum->id) }}" class="logo">
                        <p>{!! $forum->name !!} </p><br><br>
                    </a><br>
                @endif
                    <p> {!! $forum->description !!} </p>
                    <div class="clear"></div>
            </div>
            <div class="col-md-3">
                <h4>Category №1</h4>
                <ul>
                    <li><a href="#">Category №1</a></li>
                    <li><a href="#">Category №1</a></li>
                    <li><a href="#">Category №1</a></li>
                    <li><a href="#">Category №1</a></li>

                </ul>
            </div>
            <div class="col-md-3">
                <h4>Category №2</h4>
                <ul>
                    <li><a href="#">Category №2</a></li>
                    <li><a href="#">Category №2</a></li>
                    <li><a href="#">Category №2</a></li>
                    <li><a href="#">Category №2</a></li>
                    </ul>
            </div>
            <div class="col-md-2">
                <h4>Category №3</h4>
                <ul>
                    <li><a href="#">Category №3</a></li>
                    <li><a href="#">Category №3</a></li>
                    <li><a href="#">Category №3</a></li>
                    <li><a href="#">Category №3</a></li>
                </ul>
            </div>
        </div>

        <p class="copyright">Copyright © 2017 {!!$forum->name  !!}</p>
    </div>
</footer>