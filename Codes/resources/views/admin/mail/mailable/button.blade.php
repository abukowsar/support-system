@foreach($buttonTypes as $key => $value)
    <button type="button" class="btn btn-primary btn-round btn-sm variable_button" data-value="{{ '[[ '.$value->value.' ]]' }}">{{ $value->label }}</button>
@endforeach
