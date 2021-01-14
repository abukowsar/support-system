

<div class="row pt-4">
    <div class="col-md-6">
        <div class="form-group has-feedback">
            <label>Label : <span class="text-danger">*</span></label>
            {{ Form::text('label', old('label'), ['class' => 'form-control','required']) }}
        </div>
    </div>
    {{ Form::hidden('language','en') }}

    <div class="col-md-6">
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

    <div class="col-12">
        <div class="form-group">
            <label>Template</label>
            {{ Form::textarea('template_detail',null,['class' => 'form-control textarea en-textarea']) }}
        </div>
        <div class="form-group">
            <label class="float-left">Notification message</label>
            {{ Form::text("notification_message",old('notification_message'),['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label class="float-left">Notification link</label>
            {{ Form::text("notification_link",old('notification_link'),['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-12 text-right pt-2">
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </div>
</div>
