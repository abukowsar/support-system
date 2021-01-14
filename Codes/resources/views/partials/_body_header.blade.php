<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">{{ $pageTitle ?? ''}}</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            @if(\Auth::check() && \Auth::user()->hasRole('user'))
            <li>
                <a href="{{route('support.create')}}" class="text-white float-md-right mr-1"> {{__('message.submit_a_ticket')}}</a>
            </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="#" src="{{ getSingleMedia(auth()->user())}}">
                            </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ _t(auth()->user()->name) }}</span><br>
                            @if (isset(auth()->user()->department->department_name))
                                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->department->department_name }}</span>
                            @endif
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ _t(__('message.welcome'))}}</h6>
                    </div>
                    @if(auth()->user()->hasRole('employee'))
                        <a href="{{ route('employee.profile', auth()->user()->id) }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span> {{ _t(__('message.my_profile'))}}</span>
                        </a>
                    @elseif (auth()->user()->hasRole('user'))
                        <a href="{{ route('user.profile', auth()->user()->id) }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span> {{ _t(__('message.my_profile'))}}</span>
                        </a>
                    @endif
                    @if(auth()->guard('admin')->check())
                        <a href="{{ route('settings')}}" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span> {{ _t(__('message.settings'))}}</span>
                        </a>
                    @endif

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ _t(__('message.logout'))}}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
