<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label" for="department_name">{{  _t(__('message.department_name'))}}  <span class="text-red">*</span></label>
            {{ Form::text('department_name',null, ['class' => 'form-control', 'id' => 'department_name','required']) }}
            <small class="help-block with-errors text-danger"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label" for="department_name">{{  _t(__('message.department_leader'))}}<span class="text-red">*</span></label>
            <select class="form-control select2js category" name="leader_ids[]"
	                data-ajax--url="{{ route('ajax-list', ['type' => 'employee']) }}"
	                data-ajax--cache="true" multiple="">
	                @if(isset($department->departmentLeader))
                        @foreach($department->departmentLeader as $leader)
    	                    <option value="{{$leader->leader_id ?? ''}}" selected="">{{$leader->employee->name ?? ''}}</option>
                        @endforeach
	                @endif
	        </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="input-username" class="form-control-label">
                {{  _t(__('message.status'))}} <span class="text-danger">*</span>
            </label>
            <div class="row">
                <div class="col-6">
                    <div class="custom-control custom-radio">
                        {{ Form::radio('status', "1", true, ['class' => 'custom-control-input ', 'id'=> 'GM-R-1']) }}
                        <label class="custom-control-label" for="GM-R-1">
                            <span class="text-muted">{{  _t(__('message.active'))}}</span>
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="custom-control custom-radio">
                        {{ Form::radio('status', "0", null, ['class' => 'custom-control-input ', 'id'=> 'GM-R-0']) }}
                        <label class="custom-control-label" for="GM-R-0">
                            <span class="text-muted">{{  _t(__('message.deactive')) }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
