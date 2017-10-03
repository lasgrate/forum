<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('forum/' . $forum->id) }}">
                    @if(!empty($forum->logo))
                        <img src="{{ url('public/uploads/forums_logo/'.$forum->logo) }}">
                    @else
                        <p>{{$forum->name}}</p>
                    @endif
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (!Auth::guard('clients')->check())
                        <li><a href="{{ route('login', $forum->id) }}">@lang('client.login')</a></li>
                        <li><a href="{{ route('register', $forum->id) }}">@lang('client.register')</a></li>
                    @else


                        <li class="dropdown">
                            <a href="#_" class="user-link-desktop dropdown-toggle" data-toggle="dropdown"><img
                                    src="{{ url('public/uploads/avatars/default.png') }}" class="img-circle">
                                <i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-animated dropdown-menu-user" role="menu">

                                <li>

                                    <a href="{{ route('answer.index', ['forum_id' => $forum->id,'user'=> Auth::guard('clients')->user()])}}">
                                        @lang('client.answer')
                                        <i class="fa fa-bell fa-lg"></i>
                                        <span class="label label-danger">{{$countAnswer}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('client.logout')
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout', $forum->id) }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif