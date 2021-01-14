<div class="row">
    <div class="col-md-12">
        {{ Form::open(['route' => 'permission.save','method' => 'post', 'data-toggle'=> 'validator', 'data-ajax' => "true"]) }}
        <div class="modal-body">
            <input type="hidden" name="id" value="-1" />
            {{ Form::hidden('type',$type) }}
            {{ Form::hidden('id',-1) }}
            <div class="row">
                <div class="col-md-12 form-group">
                    {{ Form::label('name','Name', ['class' => 'form-control-label']) }} <span class="text-red">*</span>
                    {{ Form::text('name', null, ['class' => 'form-control' ,'required']) }}
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::label('name','Guard Name', ['class' => 'form-control-label']) }} <span class="text-red">*</span>
                    {{ Form::select('guard_name', $guards, null, ['class' => 'form-control' ,'required']) }}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="btn_submit" data-form="ajax" class="btn btn-md btn-primary">Save</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
