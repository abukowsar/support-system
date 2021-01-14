<div class="row">
    <div class="col-md-12">
        {{ Form::open(['route' => ['support.ticket.action', $ticket->id], 'data-toggle' => 'validator', 'data-ajax' => "true"]) }}
        <div class="modal-body">
            {{ Form::hidden('type', 'assign_employee') }}
            <div class="row">
                <div class="col-md-12 form-group">
                    {{ Form::label('name','Select Employees', ['class' => 'form-control-label']) }} <span class="text-red">*</span>
                    <br />
                    @php
                        $assigned_employees = $ticket->assigned->mapWithKeys(function ($item) {
                            return [$item->assigned_to => $item->name];
                        });
                    @endphp
                    {{ Form::select('assign_employees[]', $assigned_employees, $ticket->assigned->pluck('id'), [
                            'class' => 'select2js' ,
                            'required',
                            'multiple',
                            'data-ajax--url' => route('ajax-list', ['type' => 'employee', 'department_id' => $ticket->department_id])
                        ]) }}
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
