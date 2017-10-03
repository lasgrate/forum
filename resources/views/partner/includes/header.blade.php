<header id="header" class="navbar navbar-static-top">
    <div class="navbar-header">
    </div>

    @if(session()->has('user'))
        <ul class="nav pull-left">
            <li>
                <a href="{{ route('partner.logout') }}">
                    {{ __('partner.header.back_as') . session('user.role') }}
                </a>
            </li>
        </ul>
    @endif
    <ul class="nav pull-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="label label-success pull-left">
          {{ $newMessages }}
        </span>
                <i class="fa fa-bell fa-lg"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-right alerts-dropdown">
                <a href="{{ route('partner.themes.index') }}">
          <span class="label label-success pull-right">
            {{ $newMessages }}
          </span>
                    @lang('partner.header.new_messages')
                </a>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}" class="logout">@lang('partner.header.logout')</a>

        </li>
    </ul>
</header>