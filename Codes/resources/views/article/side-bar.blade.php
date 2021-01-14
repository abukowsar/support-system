<div class="col-lg-4 col-md-12 col-sm-12 iq-mtb-15">
    <div class="iq-post-sidebar">
        @if(isset($search))
        {{ Form::open(['id'=>'search_form']) }}
        <div class="iq-sidebar-widget">
            <h5 class="iq-tw-4 small-title iq-font-dark">{{ _t(__('message.search_here'))}}</h5>
            <div class="iq-widget-search"> <i class="fa fa-search"></i>
                <input type="search" name="keywords" placeholder="Search...." class="form-control placeholder filter-change" value="{{$keywords}}">
            </div>
        </div>
        <input type="hidden" name="category" value="{{$category_id}}">
        <a href="javascript:void(0)" class="scroll-load d-none"></a>
        {{ Form::close() }}
        @endif
        <div class="iq-sidebar-widget">
            <h5 class="iq-tw-4 small-title iq-font-dark">{{ _t(__('message.categories'))}} </h5>
            <div class="iq-widget-menu">
                <ul class="iq-pl-0">
                    @if(isset($articleCategory))
                        @foreach($articleCategory as $category)
                        <li>
                            <a href="{{route('article.list',['slug'=>$category->slug])}}">
                                <span class="{{ $category_id== $category->id ? 'main-color':''}}">{{ _t($category->category_name) }} <i class="fa fa-angle-right"></i></span>
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="iq-sidebar-widget">
            <h5 class="iq-tw-4 small-title iq-font-dark">{{ _t(__('message.public_tickets'))}}</h5>
            <div class="iq-recent-post media">
                <div class="media-body"> 
                    @if(isset($tickets))
                        @foreach($tickets as $ticket)
                        <a href="{{ route('ticket.show',['slug'=>$ticket->slug])}}" class="iq-mt-10">{{ _t(stringLong($ticket->subject, $type = 'title')) }}</a>
                        <span><i class="fa fa-calendar"></i>{{timeAgoFormate($ticket->created_at)}}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>