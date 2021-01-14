@extends('layouts.frontend')

@section('banner')
    <section class="green-bg iq-breadcrumb2 text-center iq-font-white iq-bg jarallax">
        <div class="container">
            <div class="row">
                <div class="col-lg justify-content-center">
                    <div class="heading-title iq-mb-0">
                        <h2 class="title white iq-tw-6">{{ _t($pageData->title) }}</h2>
                        <nav aria-label="breadcrumb" class="iq-mt-30">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home')}}"><i
                                            class="ion-android-home"></i> {{ _t(__('message.home'))}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ _t($pageData->page) }}</li>
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
                <div class="col-lg-12 col-sm-12">
                    <div class="iq-blog-entry iq-audio white-bg">
                        <div class="iq-pos-r">
                            <div class="iq-blog-detail">
                                <div class="iq-entry-content">
                                    <p><?php echo _t($pageData->content); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
