<div class="row">
    <div class="col-md-12">
        {{ Form::open(['route' => ['support.ticket.category.store', $id], 'data-toggle' => 'validator', 'data-ajax' => "true"]) }}
        <div class="modal-body">

            <input type="hidden" name="ticket_id" value="{{$id}}">
            <div class="row">
                <div class="col-md-12 form-group">
                    {{ Form::label('name','Select Category', ['class' => 'form-control-label']) }} <span class="text-red">*</span>
                    <br />
                    <select class="select2js form-group" name="category_id[]"
                        data-ajax--url="{{ route('ajax-list', ['type' => 'category']) }}" data-ajax--cache="true" multiple="" required="">
                        <option value="">-- Select Product--</option>

                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id ?? ''}}" selected="">{{$category->category->category_name ?? ''}}</option>
                            @endforeach
                        @endif
                    </select>
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
