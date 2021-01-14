<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{getSingleMedia(request()->appData,'site_logo')}}" class="navbar-brand-img" alt="{{ route('home') }}">
        </a>

        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{ getSingleMedia(auth()->user())}}">
              </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0"> {{ _t(__('message.welcome'))}}</h6>
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
                </div>
            </li>
        </ul>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{getSingleMedia(request()->appData,'site_logo')}}" class="navbar-brand-img" alt="{{ route('home') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main"
                                aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            @php

                \Menu::make('MenuDashboard', function ($menu) {

                    //Admin Dashboard
                    $menu->add(_t(__('message.dashboard')), array('route' => 'admin.dashboard', 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-tv-2 text-primary"></i>')
                        ->data('role', 'admin')
                        ->link->attr(['class' => 'nav-link']);

                    //Company Section
                    $menu->add(_t(__('message.dashboard')), array('route' => 'employee.dashboard', 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-tv-2 text-primary"></i>')
                        ->data('role', 'employee')
                        ->link->attr(['class' => 'nav-link']);
                    //User
                    $menu->add(_t(__('message.dashboard')), array('route' => 'user.dashboard', 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-tv-2 text-primary"></i>')
                        ->data('role', 'user')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.profile')), array('route' => 'admin.profile', 'class' => 'nav-item'))
                        ->prepend('<i class="fas fa-user-shield text-primary"></i>')
                        ->data('role', 'admin')
                        ->link->attr(array('class' => 'nav-link'));

                    $menu->add(_t(__('message.my_profile')), array('route' => ['employee.profile',auth()->user()->id], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-single-02 text-primary"></i>')
                        ->data('role', 'employee')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.my_profile')), array('route' => ['user.profile',auth()->user()->id], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-single-02 text-primary"></i>')
                        ->data('role', 'user')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.change_password')), array('route' => 'user.change.password', 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-settings-gear-65 text-primary"></i>')
                        ->data('role', 'user')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.change_password')), array('route' => 'employee.change.password', 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-settings-gear-65 text-primary"></i>')
                        ->data('role', 'employee')
                        ->link->attr(['class' => 'nav-link']);

                })->filter(function ($item) {
                    return checkMenuRoleAndPermission($item);
                });


                \Menu::make('Configuration', function ($menu) {

                //Settings


                $menu->add(_t(__('message.settings')), array('route' => 'settings', 'class' => 'nav-item config-menu'))
                    ->prepend('<i class="ni ni-ui-04 text-primary"></i>')
                    ->data('permission', 'setting')
                    ->link->attr(['class' => 'nav-link']);
                

                //Permission Section

                $menu->add(_t(__('message.permissions.title')), array('route' => 'permission.index', 'class' => 'nav-item config-menu'))
                    ->prepend('<i class="ni ni-key-25 text-primary"></i>')
                    ->data('permission', 'permission')
                    ->link->attr(['class' => 'nav-link']);
                

                $menu->add(_t(__('message.mail_template')), array('route' => 'mail.template.index', 'class' => 'nav-item config-menu'))
                    ->prepend('<i class="fa fa-envelope text-primary"></i>')
                    ->data('role', 'admin')
                    ->link->attr(array('class' => 'nav-link'));

                $menu->add(_t(__('message.mailable')), array('route' => 'mail.mailable.index', 'class' => 'nav-item config-menu'))
                    ->prepend('<i class="fa fa-envelope text-primary"></i>')
                    ->data('role', 'admin')
                    ->link->attr(array('class' => 'nav-link'));
                    
                $menu->add(_t(__('message.translations')), array('url' => 'admin/translations', 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-key-25 text-primary"></i>')
                        ->data('role', 'admin')
                        ->link->attr(['class' => 'nav-link']);


                })->filter(function ($item) {
                    return checkMenuRoleAndPermission($item);
                });


                \Menu::make('PageList', function ($menu) {

                //Articles, Videos And Knowledge Base Section

                $menu->add(_t(__('message.categories')), array('route' => 'categories.index', 'class' => 'nav-item page-menu'))
                    ->prepend('<i class="ni ni-tag text-primary"></i>')
                     ->data('permission', 'category')
                    ->link->attr(['class' => 'nav-link']);

                $menu->add(_t(__('message.articles')), array('route' => 'articles.index', 'class' => 'nav-item page-menu'))
                    ->prepend('<i class="ni ni-books text-primary"></i>')
                    ->data('permission', 'article')
                    ->link->attr(['class' => 'nav-link']);

                $menu->add(_t(__('message.videos')), array('route' => 'videos.index', 'class' => 'nav-item page-menu'))
                    ->prepend('<i class="ni ni-collection text-primary"></i>')
                    ->data('permission', 'video')
                    ->link->attr(['class' => 'nav-link']);

                $menu->add(_t(__('message.knowledges')), array('route' => 'knowledges.index', 'class' => 'nav-item page-menu'))
                    ->prepend('<i class="ni ni-books text-primary"></i>')
                    ->data('permission', 'knowledge base')
                    ->link->attr(['class' => 'nav-link']);

                //Pages Section
                $menu->add(_t(__('message.faqs')), array('route' => 'faq.index', 'class' => 'nav-item page-menu'))
                    ->prepend('<i class="ni ni-notification-70 text-primary"></i>')
                    ->data('permission', 'faqs')
                    ->link->attr(['class' => 'nav-link']);

                $menu->add(_t(__('message.pages')), array('route' => 'pages.index'
                        , 'class' => 'nav-item page-menu'))
                    ->data('permission', 'page')
                    ->prepend('<i class="ni ni-book-bookmark text-primary"></i>')
                    ->link->attr(['class' => 'nav-link']);

                })->filter(function ($item) {
                    return checkMenuRoleAndPermission($item);
                });


                \Menu::make('TicketMenuList', function ($menu) {

                    $ticketsList = new \App\Ticket;
                    $requestList = $ticketsList->requestTickets()->with('activity');
                    $requestCount = $requestList->count();

                    $newTicket = newTicket($ticketsList);
                    $request = newTicket($requestList->get(),'request');

                    if(auth()->user()->hasRole('user')) {
                        $openCount = $ticketsList->myTickets()->where('status', 'open')->count();
                    }else{
                        $openCount = $ticketsList->myTickets()->where('status', 'open')->whereNotNull('assigned_id')->count();
                    }

                    $menu->add(_t(__('message.request'))  , array('route' => ['support.ticket.list', 'request'], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-fat-add text-primary"></i>')
                        ->append(($request['request'] ? '<label class="badge badge-dark bg-dark text-white mb-0 ml-auto"><b>New</b></label>' : '<label class="ml-auto"></label>').'<label class="badge  notify-badge  mb-0  ml-1 fs-14">'.$requestCount.'</label>')
                        ->data('role', 'admin,leader')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.open')), array('route' => ['support.ticket.list', 'all'], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-single-copy-04 text-primary"></i>')
                        ->append(($newTicket['open'] ? '<label class="badge badge-dark bg-dark text-white mb-0  ml-auto"><b>New</b></label>' : '<label class="ml-auto"></label>').'<label class="badge  notify-badge  mb-0 ml-1 fs-14">'.$openCount.'</label>')
                        ->data('permission', 'ticket')
                        ->link->attr(['class' => 'nav-link']);


                    $menu->add(_t(__('message.unassigned_tickets')), array('route' => ['support.ticket.list', 'unassigned'], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-vector text-primary"></i>')
                        //->append('<label class="badge  badge-success float-right mb-0 ml-1">8</label>')
                        ->data('role', 'admin,leader')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.my_tickets')), array('route' => ['support.ticket.list', 'self'], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-folder-17 text-primary"></i>')
                        ->data('role', 'admin,leader,employee')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.recently_updated')), array('route' => ['support.ticket.list', 'updated'], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-notification-70 text-primary"></i>')
                        //->append('<label class="badge  badge-success float-right mb-0 ml-1">8</label>')
                        ->data('permission', 'ticket')
                        ->link->attr(['class' => 'nav-link']);
                    


                    $menu->add(_t(__('message.solved')), array('route' => ['support.ticket.list', 'solved'], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-check-bold text-primary"></i>')
                        ->data('permission', 'ticket')
                        ->append(($newTicket['solved'] ? '<label class="badge badge-dark bg-dark text-white mb-0  ml-auto"><b>New</b></label>' : '<label class="ml-auto"></label>'))
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.closed')), array('route' => ['support.ticket.list', 'closed'], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-lock-circle-open text-primary"></i>')
                        ->data('permission', 'ticket')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.trashed_tickets')), array('route' => ['support.ticket.list', 'trashed'], 'class' => 'nav-item'))
                        ->prepend('<i class="ni ni-archive-2 text-primary"></i>')
                        ->data('role', 'admin,leader')
                        ->link->attr(['class' => 'nav-link']);

                })->filter(function ($item) {
                    return checkMenuRoleAndPermission($item);
                });

                \Menu::make('MenuList', function ($menu) {


                    $menu->add(_t(__('message.departments')), array('route' => 'departments.index', 'class' => 'nav-item company-menu'))
                        ->prepend('<i class="ni ni-building text-primary"></i>')
                         ->data('permission', 'department')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add(_t(__('message.employees')), array('route' => 'employees.index', 'class' => 'nav-item company-menu'))
                        ->prepend('<i class="ni ni-badge text-primary"></i>')
                         ->data('permission', 'employee')
                        ->link->attr(['class' => 'nav-link']);

                    //User section
                    $menu->add(_t(__('message.users')), array('route' => 'users.index', 'class' => 'nav-item company-menu'))
                        ->prepend('<i class="ni ni-single-02 text-primary"></i>')
                        ->data('permission', 'user')
                        ->link->attr(['class' => 'nav-link']);

                })->filter(function ($item) {
                    return checkMenuRoleAndPermission($item);
                });


            @endphp

            <?php echo \Menu::get('MenuDashboard')->asUl(['class' => 'navbar-nav']); ?>

            @if(auth()->user()->can('ticket') || auth()->user()->hasRole('admin'))
                <hr class="my-3"/>
                <h6 class="navbar-heading text-muted">{{ _t(__('message.tickets')) }}</h6>
            @endif

            <?php echo \Menu::get('TicketMenuList')->asUl(['class' => 'navbar-nav']);?>
            <div class="menu-check" keyVal='company-menu'>
                <hr class="my-3"/>
                <h6 class="navbar-heading text-muted">{{ _t(__('message.company')) }}</h6>
            </div>

            <?php echo \Menu::get('MenuList')->asUl(['class' => 'navbar-nav']); ?>

            <div class="menu-check" keyVal='config-menu'>
                <hr class="my-3"/>
                <h6 class="navbar-heading text-muted">{{ _t(__('message.configuration')) }}</h6>
            </div>

            <?php echo \Menu::get('Configuration')->asUl(['class' => 'navbar-nav']); ?>
            <div class="menu-check" keyVal='page-menu'>
                <hr class="my-3"/>
                <h6 class="navbar-heading text-muted">{{ _t(__('message.pages')) }}</h6>
            </div>

            <?php echo \Menu::get('PageList')->asUl(['class' => 'navbar-nav']); ?>

        </div>
    </div>
</nav>

