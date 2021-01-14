@extends('layouts.frontend')

@section('content')


@section('banner')
    <section class="green-bg iq-breadcrumb2 text-center iq-font-white iq-bg jarallax">
        <div class="container">
            <div class="row">
                <div class="col-lg justify-content-center">
                    <div class="heading-title iq-mb-0">
                        <h2 class="title white iq-tw-6">{{  _t(ucfirst(stringLong($article->title,'', 30))) }}</h2>
                        <nav aria-label="breadcrumb" class="iq-mt-30">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home')}}"><i class="ion-android-home"></i> {{ _t(__('message.home')) }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('article.list')}}">{{ _t(__('message.articles'))}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{  _t(ucfirst(stringLong($article->title,'', 30))) }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<section class="iq-blog overview-block-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="iq-blog-entry iq-audio ">
                    <div class="iq-pos-r">
                        <div class="iq-blog-detail">
                            <img src="{{getSingleMedia($article,'article_image')}}"  class="w-100 image-container" alt="categary">
                            <div class="iq-entry-content iq-mt-20">
                                <h5 class="heading-left iq-tw-6 iq-mt-10">{{  _t(ucfirst($article->title)) }}</h5>
                                <ul class="iq-entry-meta ">
                                    <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> {{$article->views}}     {{  _t(__('message.views')) }}</a></li>
                                    <li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> {{timeAgoFormate($article->created_at)}}</a></li>

                                </ul>
                                <hr class="iq-mtb-10">
                                <p class="read-more"><?php echo _t($article->content); ?></p>
                                <hr class="iq-mtb-10">
                               
                                <?php $userDetail=userDetails($article,'article'); ?>

                                <div class="media iq-mtb-20  info-block">
                                    <img class="mr-3" src="{{getSingleMedia($userDetail,'profile_image')}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h6 class="mt-0">{{ _t($userDetail->name ?? '') }}</h6> 
                                        <p class="iq-mb-0"> <i class="fa fa-envelope"></i> 
                                            {{ _t($userDetail->email) ?? ''}}
                                        </p>
                                        <p> <i class="fa fa-building-o"></i> {{ _($userDetail->department->department_name ?? $userDetail->name)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('article.side-bar',['category_id' => $article->category_id ])
            
        </div>
    </div>
</section>

@endsection
