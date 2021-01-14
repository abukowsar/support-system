@extends("layouts.master")

@section("content")
    <div class="card shadow">
        <div class="card-body">
            <!-- Page Header -->
            <div class="content bg-gray-lighter">
                <div class="row items-push">
                    <div class="col-sm-12">
                        <h1 class="page-heading">

                        </h1>
                    </div>
                </div>
            </div>
            <!-- END Page Header -->

            <!-- Page Content -->
            <div class="content content-boxed">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                            <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-2 {{ $active_tab == 'general-setting' ? 'active':''}}" id="tabs-general_settings" data-toggle="tab"  href="#general_settings" role="tab" aria-controls="general_settings" aria-selected="true"> {{ _t(__('message.general_settings'))}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-2 {{ $active_tab == 'home-setting' ? 'active':''}}" id="tabs-homepage_settings" data-toggle="tab" href="#homepage_settings" role="tab" aria-controls="homepage_settings" aria-selected="false">{{ _t(__('message.home_page_settings'))}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-2 {{ $active_tab == 'contact-setting' ? 'active':''}}" id="tabs-contactus_settings" data-toggle="tab" href="#contactus_settings" role="tab" aria-controls="contactus_settings" aria-selected="false">{{ _t(__('message.contact_settings'))}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-2 {{ $active_tab == 'config-settings' ? 'active' : ''}}" id="tabs-contactus_settings" data-toggle="tab" href="#evanto_settings" role="tab" aria-controls="evanto_settings" aria-selected="false">{{ _t(__('message.config_settings'))}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-2 {{ $active_tab == 'notification-setting' ? 'active' : ''}}" id="tabs-notification_settings" data-toggle="tab" href="#notification_settings" role="tab" aria-controls="evanto_settings" aria-selected="false">{{ _t(__('message.notification_settings'))}}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 {{$active_tab=='other-settings'?'active':''}}" id="tabs-other_Settings" data-toggle="tab" href="#other_settings" role="tab" aria-controls="other_Settings" aria-selected="false">{{ _t(__('message.other_settings'))}}</a>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-10 shadow">
        <div class="card-body">
            <div class="content content-boxed">
                <div class="row">
                    <div class="col-sm-12 col-lg-12 p-0">
                        <div class="block-content tab-content">
                            <div class="col-lg-12 tab-pane {{ $active_tab == 'general-setting'?'active':''}}" id="general_settings">

                                {{ Form::model($settings,array('route' => 'setting.update','class'=>'form-horizontal padding-15','name'=>'account_form','id'=>'account_form','role'=>'form','enctype' => 'multipart/form-data','autocomplete'=>'off')) }}

                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>{{ _t(__('message.site_information'))}}</h3>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="form-control-label">{{ _t(__('message.logo'))}}</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <img src="{{getSingleMedia($settings,'site_logo')}}" width="150" alt="person" class="w-100">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input type="file" name="site_logo" class="filestyle">
                                                                    <br>
                                                                    <small class="text-muted bold">Size 190x23px</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="form-control-label">{{ _t(__('message.white_logo'))}}</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <img src="{{getSingleMedia($settings,'site_footer_logo')}}" width="150" alt="person" class="w-100">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input type="file" name="site_footer_logo" class="filestyle">
                                                                    <br>
                                                                    <small class="text-muted bold">Size 190x23px</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="form-control-label">{{ _t(__('message.favicon'))}}</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <img src="{{getSingleMedia($settings,'site_favicon')}}"  alt="person" class="w-100">
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="file" name="site_favicon" class="filestyle">
                                                                    <br>
                                                                    <small class="text-muted bold">Size 16x16px</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="form-control-label">Site Loader</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <img src="{{getSingleMedia($settings,'site_loader')}}"  alt="person" class="w-100">
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="file" name="site_loader" class="filestyle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="form-control-label"> {{ _t(__('message.site_title'))}}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="form-control-label">{{ _t(__('message.site_email'))}}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="email" name="site_email" value="{{ $settings->site_email }}" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-10">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="form-control-label">{{ _t(__('message.site_description'))}}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <textarea type="text" name="site_description" class="form-control" rows="5" placeholder="A few words about site">{{ $settings->site_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-10">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="form-control-label">{{ _t(__('message.copyright_text'))}}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <textarea type="text" name="site_copyright" class="form-control" rows="5">{{ $settings->site_copyright }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <h3>{{ _t(__('message.urls'))}}</h3>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row mt-10">
                                            <div class="col-md-2">
                                                <label for="" class="form-control-label">{{ _t(__('message.twitter_url'))}}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="twitter_url" value="{{ $settings->twitter_url }}" class="form-control" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="" class="form-control-label"> {{ _t(__('message.google_plus_url'))}}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="gplus_url" value="{{ $settings->gplus_url }}" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row mt-10">
                                            <div class="col-md-2">
                                                <label for="" class="form-control-label"> {{ _t(__('message.linkedIn_url'))}}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="linkedin_url" value="{{ $settings->linkedin_url }}" class="form-control" value="">
                                            </div>
                                           <div class="col-md-2">
                                               <label for="" class="form-control-label">{{ _t(__('message.facebook_url'))}}</label>
                                           </div>
                                           <div class="col-md-4">
                                               <input type="text" name="facebook_url" value="{{ $settings->facebook_url }}" class="form-control" value="">
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-sm-9 ">
                                                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> {{ _t(__('message.save'))}}<i class="md md-lock-open"></i></button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            {{ Form::close() }}
                            </div>
                            <div class="col-lg-12 tab-pane {{ $active_tab == 'home-setting'?'active':''}}" id="homepage_settings">

                               {{ Form::open(array('route' => 'setting.homepage','class'=>'form-horizontal padding-15','name'=>'layout_settings_form','id'=>'layout_settings_form','role'=>'form','enctype' => 'multipart/form-data','autocomplete'=>'off')) }}
                                <h3>Home Sliders</h3>
                               <hr>
                               <div class="row">
                                   <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="form-control-label">{{ _t(__('message.slider_title'))}}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" name="home_slide_title" value="{{ $settings->home_slide_title }}" class="form-control" value="">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="avatar" class="form-control-label mt-20"> {{ _t(__('message.background'))}}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <img src="{{getSingleMedia($settings,'page_bg_image')}}" alt="bg image" width="150">
                                            </div>
                                            <div class="col-md-8">
                                                <input type="file" name="page_bg_image" class="filestyle">
                                                <br>
                                                <small class="text-muted bold">Size 1400x500px</small>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="form-control-label"> {{ _t(__('message.slider_text'))}}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <textarea type="text" name="home_slide_text" class="form-control" rows="7" placeholder="A few words">{{ $settings->home_slide_text }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-sm-9 ">
                                                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> {{ _t(__('message.save'))}}<i class="md md-lock-open"></i></button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            {{ Form::close() }}
                            </div>
                            <div class="col-lg-12 tab-pane {{ $active_tab == 'contact-setting'?'active':''}}" id="contactus_settings">

                                {{ Form::open(array('route' => 'setting.contactus','class'=>'form-horizontal padding-15','name'=>'contactus_settings_form','id'=>'contactus_settings_form','role'=>'form','autocomplete'=>'off')) }}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="" class="form-control-label">{{ _t(__('message.title'))}}</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="text" name="contact_title" value="{{ $settings->contact_title }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="" class="form-control-label"> {{ _t(__('message.contact_email'))}}</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="email" name="contact_email" value="{{ $settings->contact_email }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="" class="form-control-label">{{ _t(__('message.contact_number'))}}</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="text" name="contact_number" value="{{ $settings->contact_number }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row mt-10">
                                                <div class="col-md-12">
                                                    <label for="" class="form-control-label">{{ _t(__('message.contact_map_url'))}}</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="text" name="google_map_api" value="{{ $settings->google_map_api }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row  mt-10">
                                                <div class="col-md-12">
                                                    <label for="" class="form-control-label">{{ _t(__('message.address'))}}</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea type="text" name="contact_address" class="form-control" rows="5">{{ $settings->contact_address }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-9 ">
                                                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> {{ _t(__('message.save'))}} <i class="md md-lock-open"></i></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                {{ Form::close() }}
                            </div>
                            <div class="col-lg-12 tab-pane {{ $active_tab == 'config-settings' ? 'active' : '' }}" id="evanto_settings">
                                {{ Form::open(array('route' => 'env.changes','class'=>'form-horizontal padding-15','name'=>'contactus_settings_form','id'=>'contactus_settings_form','role'=>'form','autocomplete'=>'off')) }}
                                {{ Form::hidden('type','evanto') }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-8 col-md-10">
                                                        <h3>{{ _t(__('message.notification_setting')) }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-20">
                                                <div class="row">
                                                    @foreach(config('constant.NOTIFICATION_SETTING') as $key => $value)
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label text-capitalize">{{ strtolower(str_replace('_',' ',$key)) }}</label>
                                                                <input type="text" value="{{ env('IS_DEMO') ? '' : $value}}" name="ENV[{{$key}}]" class="form-control">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr class="mt-1" />
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-8 col-md-10">
                                                        <h3>{{ _t(__('message.google_login')) }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-20">
                                                <div class="row">
                                                @foreach(config('constant.SOCIAL.google') as $key => $value)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label text-capitalize">{{ strtolower(str_replace('_',' ',$key)) }}</label>
                                                            <input type="text" value="{{ env('IS_DEMO') ? $key=='GOOGLE_REDIRECT'? $value:'': $value}}" name="ENV[{{$key}}]" class="form-control">
                                                        </div>
                                                    </div>
                                                @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr class="mt-1" />
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-8 col-md-10">
                                                        <h3>{{ _t(__('message.mail_setting')) }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-20">
                                                <div class="row">
                                                    @foreach(config('constant.MAIL_SETTING') as $key => $value)
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label text-capitalize">{{ strtolower(str_replace('_',' ',$key)) }}</label>

                                                                <input type="{{$key=='MAIL_PASSWORD'?'password':'text'}}" value="{{ env('IS_DEMO') ? '' : $value}}" name="ENV[{{$key}}]" class="form-control">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> {{ _t(__('message.save'))}}</button>
                                    </div>
                                </div>

                                {{ Form::close() }}
                            </div>
                            <div class="col-lg-12 tab-pane {{ $active_tab == 'notification-setting' ? 'active' : '' }}" id="notification_settings">
                                {{ Form::open(array('route' => 'setting.notification','class'=>'form-horizontal padding-15','name'=>'contactus_settings_form','id'=>'contactus_settings_form','role'=>'form','autocomplete'=>'off')) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-8 col-md-10">
                                                        <h3>{{ _t(__('message.notification_title')) }}</h3>
                                                        <p class="fs-14">{{ _t(__('message.notification_message')) }}</p>
                                                    </div>
                                                    <div class="col-4 col-md-2 text-right">
                                                        <label class="custom-toggle">
                                                            <input type="hidden" name="ENV[NOTIFICATION_SETTINGS]" value="0">
                                                            <input type="checkbox" {{ env('NOTIFICATION_SETTINGS') ? 'checked' : '' }} class="notify-setting" name="ENV[NOTIFICATION_SETTINGS]" value="1">
                                                            <span class="custom-toggle-slider rounded-circle"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <hr class="mt-1" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 notify-config {{!env('NOTIFICATION_SETTINGS') ? 'd-none' : '' }}">
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Template</th>
                                                    @foreach(config('config.notification') as $notification_types)
                                                        <th>{{ $notification_types }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($notificationTemplates as $notification_setting)
                                                <tr>
                                                    <td>{{ $notification_setting->label }}</td>
                                                    <td>
                                                        @if(isset($notification_setting->mailMailable))
                                                        <a href="{{ route('mail.mailable.edit',$notification_setting->mailMailable->id) }}">{{ $notification_setting->mailMailable->defaultMailTemplateMap->subject ?? ''}}</a>
                                                        @else
                                                            <a href="{{ route('mail.mailable.create') }}">
                                                                Create
                                                            </a>
                                                        @endif
                                                    </td>
                                                    @foreach(config('config.notification') as $key => $notification_types)
                                                        <td>
                                                            <input type="hidden" name="notification_setting[{{ $notification_setting->value }}][{{$key}}]" value="0">
                                                            <input type="checkbox" {{ (isset($settings->notification_settings[$notification_setting->value][$key]) && $settings->notification_settings[$notification_setting->value][$key]) ? 'checked' : '' }}
                                                             name="notification_setting[{{ $notification_setting->value }}][{{$key}}]" value="1">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> {{ _t(__('message.save'))}}</button>
                                    </div>
                                </div>

                                {{ Form::close() }}
                            </div>

                            <div class="col-lg-12 tab-pane {{ $active_tab == 'other-settings' ? 'active' : '' }}" id="other_settings">

                                {!! Form::open(array('route' => 'setting.header.footer','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form','autocomplete'=>'off')) !!}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="" class="form-control-label">Header Code</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea type="text" name="site_header_code" class="form-control" rows="8" placeholder="You may want to add some html/css/js code to header. ">{{ $settings->site_header_code }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="" class="form-control-label">Footer Code</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea type="text" name="site_footer_code" class="form-control" rows="8" placeholder="You may want to add some html/css/js code to footer. ">{{ $settings->site_footer_code }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-capitalize">Default Language</label>
                                            <select class="form-control" name="ENV[DEFAULT_LANGUAGE]">
                                                <option value="en" {{config('app.locale')=='en'?'selected':''}}>English</option>
                                                <option value="ar" {{config('app.locale')=='ar'?'selected':''}}>Arebic (عربى) </option>
                                                <option value="it" {{config('app.locale')=='ar'?'selected':''}}>italiana </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-capitalize">{{ __(_t('message.default_color'))}}</label>
                                            <input type="color" value="#{{ENV('MAIN_COLOR')}}" name="ENV[MAIN_COLOR]" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-9 ">
                                                    <button type="submit" class="btn btn-primary">Save Changes <i class="md md-lock-open"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!-- END Block Tabs Alternative Style -->
                    </div>

                </div>
            </div>
            <!-- END Page Content -->
        </div>
    </div>
@endsection
