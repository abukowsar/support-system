

<!--=================================
Footer -->
    <footer class="iq-footer4">
        <div class="container">
            <div class="row overview-block-ptb2">
                <div class="col-lg-4 col-md-6 col-sm-6 iq-mtb-20">
                    <div class="logo">
                        <img class="img-fluid" src="{{ getSingleMedia(request()->appData,'site_footer_logo') }}" alt="#">
                        <div class="iq-font-white iq-mt-15">{{ _t(request()->appData->site_description ?? '')  }}</div>
                        <ul class="iq-contact">

                            @if(request()->appData->contact_address != '')
                            <li class="iq-mtb-20">
                                <i class="ion-ios-location-outline"></i>
                                <p>{{ _t(request()->appData->contact_address ?? '')  }}</p>
                            </li>
                            @endif
                            @if(request()->appData->contact_number != '')
                            <li>
                                <i class="ion-ios-telephone-outline"></i>
                                <p>{{ _t(request()->appData->contact_number ?? '')  }}</p>
                            </li>
                            @endif
                            @if(request()->appData->contact_email != '')
                            <li>
                                <i class="ion-ios-email-outline"></i>
                                <p>{{ _t(request()->appData->contact_email ?? '')  }}</p>
                            </li>
                            @endif
                            
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 col-sm-6 iq-mtb-20">
                    <h5 class=" iq-tw-6 iq-font-white iq-mb-30">{{ _t(__('message.menu'))}}</h5>
                    <ul class="menu">
                        <li><a href="{{ route('home')}}">{{ _t(__('message.home'))}}</a></li>
                        <li><a href="{{ route('support.create')}}">{{ _t(__('message.submit_a_ticket'))}}</a></li>
                        <li><a href="{{route('public.ticket',['type'=>'public'])}}"><span></span> {{ _t(__('message.tickets'))}}</a></li>
                        <li>
                             <a href="{{ route('article.list')}}">Articles</a>
                        </li>
                        <li> <a href="{{ route('knowledge.list')}}"> {{ _t(__('message.knowledge_base'))}}</a></li>
                       
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6 iq-mtb-20">
                    <h5 class="iq-tw-6 iq-font-white iq-mb-30">{{ _t(__('message.useful_links'))}}</h5>
                    <ul class="menu">
                        <li><a href="{{ route('user.dashboard')}}">{{ _t(__('message.my_profile')) }}</a></li>
                        <li><a href="{{ route('page',['type'=>'faqs'])}}">{{ _t(__('message.faqs')) }}</a></li>

                         <li><a href="{{route('page',['type'=>'contact-us'])}}">{{ _t(__('message.contact_us')) }}</a></li>

                        <?php  $pages=\App\Pages::getAllPageData(); ?>

                        @if(isset($pages))
                            @foreach ($pages as $key => $page)

                            <li><a href="{{ route('page',['type'=>$page->slug])}}">{{ _t($page->page_title) }}</a></li>

                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 iq-mtb-20">
                   
                        {{ Form::open( ['method' => 'POST','route' => ['newsletter.subscribe']]) }}

                        <h5 class="footer-title text-white">
                            <i class="fa fa-envelope"></i>
                            <span>Sign Up For a Newsletter</span>
                        </h5>
                        <p>{{ _t(request()->appData->site_description ?? '')  }}</p>
                        <div class="form-fields mt-4">
                            <input type="hidden" name="subscribed" value="1">
                            <input type="email" name="email" placeholder="Enter your email address" required="">
                            <button type="submit" class="button btn-green disabled"> {{ _t(__('message.subscribe')) }}</button>
                        </div>
                        <input type="hidden" name="active_tab" value="">
                     {{ Form::close() }} 
                </div>
            </div>
            <hr>
            <div class="row overview-block-ptb2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="iq-copyright iq-mt-10 iq-font-white">
                        {{ _t(request()->appData->site_copyright ?? '') }}
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--=================================
Footer -->
 