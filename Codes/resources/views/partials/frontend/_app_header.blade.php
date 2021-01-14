
	<header class="header-01 re-none">
		<div class="topbar bg-main">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="topbar-left">
							<ul class="list-inline">
								@if(request()->appData->contact_number != '')
								<li class="list-inline-item"><i class="fa fa-phone text-white"></i>{{request()->appData->contact_number ?? ''}}</li>
								@endif
								@if(request()->appData->contact_email != '')
								<li class="list-inline-item"><i class="fa fa-envelope-o text-white"> </i> {{ request()->appData->contact_email ?? ''}}</li>
								@endif
							</ul>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="topbar-right text-right">
							<ul class="list-inline">
								<li class="mlr-2 list-inline-item">
								  <!-- begin language switcher -->
								    <div class="polyglot-language-switcher" data-open-mode="hover" data-anim-effect="slide" data-grid-columns="1"  data-selected-lang="{{  ((\Session::get('locale') != null) ? \Session::get('locale') : "en") }}">
								      <ul class="language-div">
								          <li><a href="javascript:void(0)" title="English (US)"  data-lang-id="en"><img src="{{ asset('images/flags/us.png')}}" alt="United States"> English (US)</a></li>
								          <li><a href="javascript:void(0)" title="عربى" data-lang-id="ar"><img src="{{asset('images/flags/ar.svg')}}" alt="#" class="ar-img"> عربى</a></li>
								          <li><a href="javascript:void(0)" title="italiana" data-lang-id="it"><img src="{{asset('images/flags/it.png')}}" alt="#" class="it-img">italiana</a></li>
								      </ul>
								    </div>
								  <!-- end language switcher -->
								</li>
								@if(auth()->guard('admin')->check() || auth()->guard('company')->check() || auth()->check())
                                    @if (auth()->guard('admin')->check())
                                        <li class="list-inline-item"><a href="{{ route('admin.dashboard')}}"><i class="fa fa-user text-white"></i> {{ _t(__('message.dashboard'))}}</a></li>
                                    @else
                                        <li class="list-inline-item"><a href="{{ route('user.dashboard')}}"><i class="fa fa-user text-white"></i> {{ _t(__('message.dashboard'))}}</a></li>
                                    @endif
								<li class="list-inline-item">
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span><i class="fa fa-sign-out text-white" aria-hidden="true"></i> {{ _t(__('message.logout'))}}</span></a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
									</form>
								</li>
								@else
									<li class="list-inline-item">
										<ul class="list-inline iq-left">
											<li class="list-inline-item"><a href="{{ route('login') }}" ><i class="fa fa-lock text-white"></i>{{ _t(__('message.login'))}}</a></li>
											<li class="list-inline-item"><a href="{{ route('register') }}" ><i class="fa fa-user text-white"></i> {{ _t(__('message.register'))}}</a></li>
										</ul>
									</li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav id="menu-1" class="mega-menu">
			<div class="menu-list-items">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12">
							<!-- menu logo -->
							<ul class="menu-logo">
								<li>
									<a href="{{ route('home')}}">
										<img src="{{getSingleMedia(request()->appData,'site_logo')}}" alt="#">
									</a>
								</li>
							</ul>
							<!-- menu links -->
							<ul class="menu-links">
								<!-- active class -->
								<li class="{{ setActive('home')?'active': '' }} {{ setActive('/')?'active': '' }}"><a href="{{ route('home')}}">{{ _t(__('message.home'))}}</a>
								<li class=" {{ setActive('support/create')?'active': '' }}">
								    <a href="{{ route('support.create')}}"><span class="ti-ticket"></span> {{ _t(__('message.submit_a_ticket'))}}</a>
								</li>
								<li class="{{ setActive('tickets/*')?'active': '' }}"><a href="{{route('public.ticket',['type'=>'public'])}}"><span class="ti-ticket"></span>  {{ _t(__('message.tickets'))}} </a>
								    <ul class="drop-down-multilevel">
								         @if(\Auth::check())
								             <li><a href="{{route('my.ticket',['type'=>'private'])}}"><span></span>  {{ _t(__('message.my_tickets'))}}</a></li>
								        @endif
								         <li><a href="{{route('public.ticket',['type'=>'public'])}}"><span></span>{{ _t(__('message.public_tickets'))}}</a></li>
								    </ul>
								</li>
								<li class="{{ setActive('articles')?'active': '' }}">
								    <a href="{{ route('article.list')}}"><span class="ti ti-file"></span> {{ _t(__('message.articles'))}}</a>
								</li>
								<li class="{{ setActive('knowledge')?'active': '' }}"><a href="{{ route('knowledge.list')}}">{{ _t(__('message.knowledge_base'))}}</a>
								</li>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<!-- /HEADER END -->
	<!--================================= -->


	@yield('banner')
