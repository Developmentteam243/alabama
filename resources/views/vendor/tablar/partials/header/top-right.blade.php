@auth
    <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
           aria-label="Open user menu">
            <span class="avatar">{{ strtoupper(substr(Auth()->user()->name, 0, 2)) }}</span>
            <div class="d-none d-xl-block ps-2">
                <div>{{Auth()->user()->name}}</div>
                <div class="mt-1 small text-muted">Administrator</div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

            @php( $logout_url = View::getSection('logout_url') ?? config('tablar.logout_url', 'logout') )

            @if (config('tablar.use_route_url', true))
                @php( $logout_url = $logout_url ? route($logout_url) : '' )
            @else
                @php( $logout_url = $logout_url ? url($logout_url) : '' )
            @endif

            <a class="dropdown-item"
               href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off text-red"></i>
                {{ __('tablar::tablar.log_out') }}
            </a>

            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                @if(config('tablar.logout_method'))
                    {{ method_field(config('tablar.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>

        </div>
    </div>
@endif
