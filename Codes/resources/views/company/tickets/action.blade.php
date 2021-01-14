
@if(in_array(request()->type, ['request']))
    @if(auth()->user()->hasAnyRole(['leader']))
    <a href="{{ route('support.ticket.action', ['id' => $id, 'type' => 'approve']) }}"
       class="table-action ticket-approved"
       data--submit="confirm_form"
       data--confirmation='true' data-title='{{_t(__("message.approve_ticket_form_title"))}}'
       data-message='{{_t(__("message.approve_ticket_form_message"))}}'
       data-datatable="reload">
        <span class="badge badge-success mr-2">
            {{ _t(__('message.approve')) }}
        </span>
    </a>
    @endif
@endif

@if(in_array(request()->type, ['unassigned']))
    @if(auth()->user()->hasRole('leader'))
        <a href="" class="table-action ticket-assign" data-toggle="form"
           data--href="{{ route('support.ticket.assign_employee_form', $id) }}">
            <span class="badge badge-success mr-2">
                {{ _t(__('message.assign_employee')) }}
            </span>
        </a>
    @endif
@endif

@if(in_array(request()->type, ['self']))
    @if(auth()->user()->hasAnyRole(['admin', 'leader', 'employee']))
    <a href="{{ route('support.ticket.action', ['id' => $id, 'type' => 'solve']) }}"
       class="table-action ticket-solved"
       data--submit="confirm_form"
       data--confirmation='true'
       data-title='{{_t(__("message.solve_ticket_form_title"))}}'
       data-message='{{_t(__("message.solve_ticket_form_message"))}}'
       data-datatable="reload">
        <span class="badge badge-success mr-2">
            {{ _t(__('message.solve')) }}
        </span>
    </a>
    @endif
@endif

@if(in_array(request()->type, ['request', 'all', 'unassigned', 'self']))
    @if(auth()->user()->hasAnyRole(['admin', 'leader']))
        <a href="" class="table-action ticket-transfer" data-toggle="form"
           data--href="{{ route('support.ticket.transfer_form', $id) }}">
            <span class="badge badge-warning mr-2">
                {{ _t(__('message.transfer')) }}
            </span>
        </a>
    @endif
@endif


<a href="{{ route('support.ticket.edit', $id) }}" class="table-action">
    <span class="badge badge-info mr-2">
        {{ _t(__('message.view')) }}
    </span>
</a>


@if(!in_array(request()->type, ['trashed']))
    @if(auth()->user()->hasAnyRole(['admin', 'leader']))
        <a href="{{ route('support.ticket.action', ['id' => $id, 'type' => 'delete']) }}"
           class="table-action ticket-deleted"
           data--confirmation='true'
           data--submit="confirm_form"
           data-datatable="reload">
        <span class="badge badge-danger mr-2">
            {{ _t(__('message.delete')) }}
        </span>
        </a>
    @endif
@endif

@if(in_array(request()->type, ['trashed']))
    @if(auth()->user()->hasAnyRole(['admin', 'leader']))
        <a href="{{ route('support.ticket.action', ['id' => $id, 'type' => 'restore']) }}"
           class="table-action ticket-restored"
           data--submit="confirm_form"
           data--confirmation='true' data-title='{{_t(__("message.restore_ticket_form_title"))}}'
           data-message='{{_t(__("message.restore_ticket_form_message"))}}'
           data-datatable="reload">
        <span class="badge badge-success mr-2">
            {{ _t(__('message.restore')) }}
        </span>
        </a>
    @endif
@endif


@if(auth()->user()->hasAnyRole(['admin', 'user']) && $status!='closed')
    <a href="{{ route('support.ticket.action', ['id' => $id, 'type' => 'closed']) }}"
       class="table-action ticket-restored"
       data--submit="confirm_form"
       data--confirmation='true' data-title='{{_t(__("message.close_ticket_form_title"))}}'
       data-message='{{_t(__("message.close_ticket_form_message"))}}'
       data-datatable="reload">
    <span class="badge badge-success mr-2">
        {{ _t(__('message.close')) }}
    </span>
    </a>

@else
  @if(auth()->user()->hasAnyRole(['admin', 'user']) && $status=='closed')
  <a href="{{ route('support.ticket.action', ['id' => $id, 'type' => 'reopen']) }}"
     class="table-action ticket-restored"
     data--submit="confirm_form"
     data--confirmation='true' data-title='{{_t(__("message.reopen_ticket_form_title"))}}'
     data-message='{{_t(__("message.reopen_ticket_form_message"))}}'
     data-datatable="reload">
  <span class="badge badge-success mr-2">
      {{ _t(__('message.reopen')) }}
  </span>
  </a>
  @endif
@endif
