


{{ Form::open(['route' => ['users.destroy', $id], 'method' => 'delete','data--submit'=>'users'.$id]) }}
<div class='btn-group'>
  
    <a href="{{ route('users.edit',$id) }}" class='table-action'>
	    <span class="badge badge-success mr-2">{{ _t(__('message.edit',['name' =>'' ])) }}</span>
	</a>
	@if(!ENV('IS_DEMO'))
    <a class='table-action' href="javascript:void(0)" data--submit="users{{$id}}"  data--confirmation='true' data-title='Delete' data-message='{{_t(__("message.delete_msg"))}}'><span class="badge badge-danger">{{ _t(__('message.delete'))}}</span>
    </a>
    @endif
</div>
{{ Form::close() }}


