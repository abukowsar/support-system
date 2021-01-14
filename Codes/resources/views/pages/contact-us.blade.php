@extends('layouts.frontend')

@section('banner')
    <section class="green-bg iq-breadcrumb2 text-center iq-font-white">
        <div class="container">
            <div class="row">
                <div class="col-lg justify-content-center">
                    <div class="heading-title iq-mb-0">
                        <h2 class="title white iq-font-white iq-tw-6">
                            {{ _t(__('message.contact_us'))}}
                        </h2>
                        <nav aria-label="breadcrumb" class="iq-mt-30">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home')}}"><i
                                            class="ion-android-home"></i> {{ _t(__('message.home'))}}</a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{ _t(__('message.contact_us'))}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="main-content iq-contact2">
        <div class="iq-map">
            <iframe src="{{ request()->appData->google_map_api ?? '' }}"></iframe>
        </div>
        <section class="iq-our-touch overview-block-pb">
            <div class="container">
                <div class="iq-get-in iq-pall-40 white-bg">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 iq-mtb-15">
                            <h4 class="heading-left iq-tw-6 iq-pb-20 iq-mb-20">Get in Touch</h4>
                            {{ Form::open(['method' => 'POST','route' => ['contact.message'],'data-toggle'=>'validator']) }}

                            <div class="row iq-mt-30">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group iq-mb-15">
                                        {{ Form::text('name', null, array('class' => 'form-control','required','placeholder'=>_t(__('message.name')) )) }}
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group iq-mb-15">
                                        {{ Form::email('email', null, array('class' => 'form-control','required','placeholder'=>_t(__('message.email')) )) }}
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group iq-mb-15">
                                        {{ Form::number('mobile_number', null, array('class' => 'form-control','placeholder'=>_t(__('message.mobile')) )) }}
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group iq-mb-15">
                                        {{ Form::textarea('message', null, array('class' => 'form-control iq-h-200','required','placeholder'=>_t(__('message.message')))) }}
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}" data-callback="onSubmit"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <button type="submit" value="Send"
                                            class="button iq-mt-30">{{ _t(__('message.send_message') )}}</button>
                                </div>
                            </div>

                            {{ Form::close() }}
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 iq-mtb-15">
                            <div class="contact-info iq-pall-60 iq-pt-0">
                                <h3>{{ _t(ucwords(request()->appData->contact_title ?? '')) }}</h3>

                                <div class="iq-contact-box media iq-mt-30">
                                    <div class="iq-icon left">
                                        <i aria-hidden="true" class="ion-ios-location-outline"></i>
                                    </div>
                                    <div class="contact-box right media-body">
                                        <h5 class="iq-tw-6">{{ _t(__('message.address') )}}</h5>
                                        <p>{{ _t(request()->appData->contact_address ?? '') }}</p>
                                    </div>
                                </div>

                                <div class=".iq-contact-box right media iq-mt-40">
                                    <div class="iq-icon left">
                                        <i aria-hidden="true" class="ion-ios-telephone-outline"></i>
                                    </div>
                                    <div class="contact-box right media-body">
                                        <h5 class="iq-tw-6">{{ _t(__('message.phone') )}}</h5>
                                        <span
                                            class="lead iq-tw-5">{{ _t(request()->appData->contact_number ?? '') }}</span>
                                    </div>
                                </div>
                                <div class=".iq-contact-box right media iq-mt-40">
                                    <div class="iq-icon left">
                                        <i aria-hidden="true" class="ion-ios-email-outline"></i>
                                    </div>
                                    <div class="contact-box right media-body">
                                        <h5 class="iq-tw-6">{{ _t(__('message.mail') )}}</h5>
                                        <span class="lead iq-tw-5">{{ _t(request()->appData->contact_email) }}</span>
                                        <div class="iq-mb-0">24 X 7 online support</div>
                                    </div>
                                </div>
                                <ul class="info-share list-inline">
                                    <li class="list-inline-item"><a href="{{request()->appData->facebook_url ?? ''}}" target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item"><a href="{{request()->appData->gplus_url ?? ''}}" target="_blank"><i class="fa fa-google"></i></a>
                                    </li>
                                    <li class="list-inline-item"><a href="{{request()->appData->twitter_url ?? ''}}" target="_blank"><i class="fa fa-twitter"></i></a>
                                    </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('body_bottom')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
