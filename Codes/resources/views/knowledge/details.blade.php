@extends('layouts.frontend')

@section('banner')
    <section class="green-bg iq-breadcrumb2 text-center iq-font-white iq-bg jarallax">
        <div class="container">
            <div class="row">
                <div class="col-lg justify-content-center">
                    <div class="heading-title iq-mb-0">
                        <h2 class="title white iq-tw-6">
                            {{ _t(__('message.knowledge_base'))}}
                        </h2>
                        <nav aria-label="breadcrumb" class="iq-mt-30">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home')}}">
                                        <i class="ion-android-home"></i>
                                        {{ _t(__('message.home'))}}
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('knowledge.list')}}">
                                        {{ _t(__('message.knowledge'))}}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{  _t(ucfirst(stringLong($knowledge->title,'', 30))) }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="iq-blog overview-block-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="iq-blog-entry iq-audio white-bg">
                        <div class="iq-pos-r">
                            <div class="iq-blog-detail">
                                <div class="iq-entry-content">
                                    <h5 class="heading-left iq-tw-4 iq-mt-10">{{ _t(ucfirst($knowledge->title) ) }}</h5>
                                    <ul class="iq-entry-meta ">

                                        <li>
                                            <i class="fa fa-user"
                                               aria-hidden="true"></i> {{ _t($knowledge->employee->name ?? '') }}
                                        </li>
                                        <li>
                                            <i class="fa fa-eye"
                                               aria-hidden="true"></i> {{ _t($knowledge->views) }}  {{ _t(__('message.views'))}}
                                        </li>
                                        <li>
                                            <i class="fa fa-calendar"
                                               aria-hidden="true"></i> {{timeAgoFormate($knowledge->created_at)}}
                                        </li>

                                    </ul>
                                    <hr class="iq-mtb-10">
                                    <p class="read-more"><?php echo _t($knowledge->content); ?></p>

                                    <hr class="iq-mtb-20">
                                    <!--  <a href="#"><span class="tag"><i class="fa fa-thumbs-o-up"></i> YES 50</span></a>
                                     <a href="#"><span class="date"><i class="fa fa-thumbs-o-down"></i> NO 10</span></a> -->
                                    <?php $userDetail = userDetails($knowledge, 'knowledge'); ?>
                                    <div class="media iq-mtb-20  info-block">
                                        <img class="mr-3" src="{{getSingleMedia($userDetail,'profile_image')}}"
                                             alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6 class="mt-0">{{ _t($userDetail->name ?? '')}}</h6>
                                            <p class="iq-mb-0"><i class="fa fa-envelope"></i>
                                                {{ _t($userDetail->email ?? '') }}
                                            </p>

                                            <p>
                                                <i class="fa fa-building-o"></i> {{ _t($userDetail->department->department_name ?? '')}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="iq-post-sidebar">
                        <div class="iq-sidebar-widget">
                            <h5 class="iq-tw-4 small-title iq-font-dark"> {{ _t(__('message.categories'))}}</h5>
                            <div class="iq-widget-menu">
                                <ul class="iq-pl-0">
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ route('knowledgebase.list',['category'=>$category->slug])}}">
                                                <span class="{{ $knowledge->category_id== $category->id ? 'main-color':''}}">
                                                    {{ _t($category->category_name) }} 
                                                    <i class="fa fa-angle-right"></i>
                                                </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="iq-sidebar-widget">
                            <h5 class="iq-tw-4 small-title iq-font-dark">{{ _t(__('message.recent_knowledges'))}}</h5>
                            @if(isset($recentKnowledge))
                                @foreach($recentKnowledge as $recentArt)
                                    <div class="iq-recent-post media">
                                        <div class="media-body">
                                            <a href="{{ route('knowledge.details',['slug'=>$recentArt->slug])}}"
                                               class="iq-mt-10">{{ _t(stringLong($recentArt->title, $type = 'title'))}}</a>
                                            <span><i
                                                    class="fa fa-calendar"></i>{{timeAgoFormate($recentArt->created_at)}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="iq-sidebar-widget">
                            <h5 class="iq-tw-4 small-title iq-font-dark"> {{ _t(__('message.public_tickets')) }}</h5>
                            <div class="iq-recent-post media">
                                <div class="media-body">
                                    @if(isset($tickets))
                                        @foreach($tickets as $ticket)
                                            <a href="{{ route('ticket.show',['slug'=>$ticket->slug])}}"
                                               class="iq-mt-10">{{ _t(stringLong($ticket->subject, $type = 'title')) }}</a>
                                            <span><i
                                                    class="fa fa-calendar"></i>{{timeAgoFormate($ticket->created_at)}}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
