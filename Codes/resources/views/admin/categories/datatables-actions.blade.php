
{{ Form::open(['route' => ['categories.destroy', $id], 'method' => 'delete','data--submit'=>'category'.$id]) }}
<div class='btn-group'>
  
    <a href="{{ route('categories.create', ['id'=>$id]) }}" class='table-action'>
        <span class="badge badge-success mr-2">{{ _t(__('message.edit',['name' => '']))}}</span>
    </a>

    <a class='table-action' href="javascript:void(0)" data--submit="category{{$id}}"  data--confirmation='true' data-title='Delete' data-message='{{_t(__("message.delete_msg"))}}'><span class="badge badge-danger">{{ _t(__('message.delete'))}}</span>
    </a>
</div>
{{ Form::close() }}
