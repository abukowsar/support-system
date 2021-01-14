@extends('layouts.frontend')

@section('banner')
    <section class="green-bg iq-breadcrumb2 text-center iq-font-white iq-bg jarallax">
        <div class="container">
            <div class="row">
                <div class="col-lg justify-content-center">
                    <div class="heading-title iq-mb-0">
                        <h2 class="title white iq-tw-6">{{ _t(__('message.faqs'))}}</h2>
                        <nav aria-label="breadcrumb" class="iq-mt-30">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home')}}"><i
                                            class="ion-android-home"></i> {{ _t(__('message.home'))}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ _t(__('message.faqs'))}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="overview-block-ptb iq-accordion arrow">
        <div class="container">
            <div class="row">
                <div class="col-md-8 iq-mtb-15">
                    <div id="accordion" role="tablist">

                        @if(isset($data))
                            @foreach($data as $key=> $faq)
                                <div class="card">
                                    <div class="card-header" role="tab" id="heading{{$key}}">
                                        <div>
                                            <a class="{{ $key==0 ?'':'collapsed'}}"
                                               data-toggle="{{ $key == 0 ?'collapsed':'collapse'}}"
                                               href="#collapse{{$key}}" aria-expanded="{{$key==0?'true':'false'}}"
                                               aria-controls="collapse{{$key}}">{{ _t($faq->question) }}</a>
                                        </div>
                                    </div>
                                    <div id="collapse{{$key}}" class="collapse {{$key==0?'show':''}}" role="tabpanel"
                                         aria-labelledby="heading{{$key}}" data-parent="#accordion">
                                        <div class="card-body iq-mt-10">
                                            <div class="row">
                                                <div class="col-sm-12"><?php echo _t($faq->answer); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif

                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 iq-mtb-15">
                    <div class="iq-post-sidebar">

                        <div class="iq-sidebar-widget">
                            <h5 class="iq-tw-6 small-title iq-font-dark">{{ _t(__('message.categories'))}}</h5>
                            <div class="iq-widget-menu">
                                <ul class="iq-pl-0">
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{route('article.list',['slug'=>$category->slug])}}">
                                                    <span>{{ _t($category->category_name) }} <i
                                                            class="fa fa-angle-right"></i></span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="iq-sidebar-widget">
                            <h5 class="iq-tw-6 small-title iq-font-dark">{{ _t(__('message.public_tickets'))}}</h5>
                            <div class="iq-recent-post media">
                                <div class="media-body">
                                    @if(isset($tickets))
                                        @foreach($tickets as $category)
                                            <a href="{{ route('ticket.show',['slug'=>$category->slug])}}"
                                               class="iq-mt-10">{{ _t(stringLong($category->subject, $type = 'title'))}}</a>
                                            <span><i class="fa fa-calendar"></i>{{timeAgoFormate($category->created_at)}}</span>
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
