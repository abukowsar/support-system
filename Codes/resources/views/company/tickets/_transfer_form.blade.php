<div class="row">
    <div class="col-md-12">
        {{ Form::open(['route' => ['support.ticket.action', $ticket->id], 'data-toggle' => 'validator', 'data-ajax' => "true"]) }}
        <div class="modal-body">
            {{ Form::hidden('type', 'transfer') }}
            <div class="row">
                <div class="col-md-12 form-group">
                    {{ Form::label('name','Select Department', ['class' => 'form-control-label']) }} <span class="text-red">*</span>
                    <br />
                    {{ Form::select('department_id', [$ticket->departments->id => $ticket->departments->department_name], $ticket->departments->id, [
                            'class' => 'select2js form-group departments' ,
                            'required1',
                            'data-ajax--url' => route('ajax-list', ['type' => 'department']),
                            'leader-ajax--url' => route('ajax-list', ['type' => 'employee']),
                            'leader-target' => '#leaders'
                        ]) }}
                </div>
            </div>
            @if (auth()->user()->hasRole(['admin']))

                @if(!(ENV('IS_GOLDENMACE')))
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('name','Select Employee', ['class' => 'form-control-label']) }} <span class="text-red">*</span>
                            <select name="leader_id" class="form-group select2js" id="leaders" required="">
                                <option value="">Select Employee</option>
                                @if (isset($ticket->leader))
                                    <option value="{{ $ticket->leader->id }}" selected>{{ $ticket->leader->name }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">{{ _t(__('message.priority'))}}</label>
                            <span class="text-danger">*</span>
                            <select class="form-control select2js template-list" name="priority"
                                    data-ajax--url="{{ route('ajax-list', ['type' => 'static_data_key','data_type'=>'priority']) }}"
                                    data-ajax--cache="true" required="">
                                    <option value="{{$ticket->priority}}" selected="">{{ucfirst($ticket->priority)}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="btn_submit" data-form="ajax" class="btn btn-md btn-primary">Save</button>
        </div>
        {{ Form::close() }}
    </div>
</div>

<script>
    $(document).ready(function(){

        $('.departments').on('select2:select', function (e) {
            $('#leaders').val(null).trigger('change.select2');
        });

        let id='{{$ticket->department_id}}';
        let url = $('.departments').attr('leader-ajax--url')+'&department_id='+id;
        let target = $('.departments').attr('leader-target');
        $(document).find(target).select2({
            ajax:{
                url:url,
                dataType:'json'
            }
        });
        
    })
</script>
