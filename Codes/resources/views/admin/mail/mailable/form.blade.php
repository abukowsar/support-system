<div class="row">
    <div class="col-md-4">
        <div class="row pt-4">
           {{ Form::hidden('id',null) }}
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <label>Type : <span class="text-danger">*</span></label>
                    <select name="type" class="form-control select2js mailable-type" id="type"
                            data-ajax--url="{{ route('ajax-list',['type' => 'static_data_key','data_type' => 'mailable']) }}" data-ajax--cache="true" required>
                        @if(isset($mailable->type))
                            <option value="{{ $mailable->type }}" selected>{{ $mailable->staticData->label ?? '' }}</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <label>Template : <span class="text-danger">*</span></label>
                    <select name="template_id" class="form-control select2js" id="mail_template"
                            data-ajax--url="{{ route('ajax-list',['type' => 'mail_template']) }}" data-ajax--cache="true" required>
                        @if(isset($mailable->template_id))
                            <option value="{{ $mailable->template_id }}" selected>{{ $mailable->template_label }}</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Parameters :</label><br>
                    <div class="mail-button">
                        @if(isset($buttonTypes))
                            @include('admin.mail.mailable.button',[
                            'buttonTypes' => $buttonTypes
                            ])
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="input-username" class="form-control-label">
                        {{_t(__('message.status'))}}  <span class="text-danger">*</span>
                    </label>
                    <div class="row">
                        <div class="col-6">
                            <div class="custom-control custom-radio">
                                {{ Form::radio('status', "1", true, ['class' => 'custom-control-input ', 'id'=> 'GM-R-1']) }}
                                <label class="custom-control-label" for="GM-R-1">
                                    <span class="text-muted">{{_t(__('message.active'))}} </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="custom-control custom-radio">
                                {{ Form::radio('status', "0", null, ['class' => 'custom-control-input ', 'id'=> 'GM-R-0']) }}
                                <label class="custom-control-label" for="GM-R-0">
                                    <span class="text-muted">{{_t(__('message.deactive'))}} </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>To :</label><br> 
                    <select  name="to[]" class="form-control select2js_add_true" 
                            data-ajax--url="{{ route('ajax-list',['type' => 'static_data_key','data_type' => 'mailable_to']) }}" data-ajax--cache="true" multiple required="">
                        @if(isset($mailable))
                            @if($mailable->to != null)
                                @foreach(json_decode($mailable->to) as $to)
                                    <option value="{{$to}}" selected="">{{$to}}</option>
                                @endforeach
                            @endif
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>BCC :</label><br>
                    <select class="select2js_add_true"  name="bcc[]"  multiple="">
                        @if(isset($mailable))
                            @if($mailable->bcc != null)
                                @foreach(json_decode($mailable->bcc) as $bcc)
                                    <option value="{{$bcc}}" selected="">{{$bcc}}</option>
                                @endforeach
                            @endif
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>CC :</label><br>
                    <select class="select2js_add_true"  name="cc[]"  multiple="">
                        @if(isset($mailable))
                            @if($mailable->cc != null)
                                @foreach(json_decode($mailable->cc) as $cc)
                                    <option value="{{$cc}}" selected="">{{$cc}}</option>
                                @endforeach
                            @endif
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-nav-tabs card-plain">
            <div class="card-header card-header-info">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        @php
                            $language = config('constant.LANGUAGE');
                            $tab = 0;
                            $pen = 0;
                        @endphp
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            @foreach($language as $key => $value)
                                <li class="nav-item">
                                    <a class="nav-link {{ $tab == 0 ? 'active' : '' }} language-tab" href="#{{ $key }}" data-value="{{ $key }}" data-toggle="tab">{{ $value }}</a>
                                </li>
                                <?php $tab++; ?>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="tab-content text-center">
                    @foreach($language as $key => $value)

                    @php
                        if(isset($mailable->mailTemplateMap)){
                            $temp=$mailable->mailTemplateMap->where('language',$key)->first();
                        }
                    @endphp
                        <div class="tab-pane {{ $pen == 0 ? 'active' : '' }}" id="{{ $key }}">

                            <div class="form-group">
                                <label class="float-left">Subject </label>
                                {{ Form::text("subject[$key]",isset($temp)?$temp->subject:old('subject'),['class' => 'form-control']) }}
                            </div>

                            <div class="text-left">
                                <label>Template</label>
                                {{ Form::hidden("language[$pen]",$key) }}
                            </div>
                            <div class="form-group">
                                {{ Form::textarea("template_detail[$key]",old('template_detail'),['class' => 'form-control textarea','id' => "$key-textarea"]) }}
                            </div>
                            <div class="form-group">
                                <label class="float-left">Notification message</label>
                                {{ Form::text("notification_message[$key]",isset($temp)?$temp->notification_message:old('notification_message'),['class' => 'form-control notification_message','id' => "$key-notification_message"]) }}
                            </div>
                            <div class="form-group">
                                <label class="float-left">Notification link</label>
                                {{ Form::text("notification_link[$key]",isset($temp)?$temp->notification_link:old('notification_link'),['class' => 'form-control notification_link','id' => "$key-notification_link"]) }}
                            </div>
                        </div>
                        <?php $pen++; ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-right pt-2">
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </div>
</div>
