@extends("layouts.master")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h1>{{ $pageTitle ?? ''}}</h1>
                        </div>
                        <div class="col-md-8">
                            <a href="{{ $button }}" class="float-right btn btn-sm btn-primary"><i class="fas fa-angle-double-left"></i> {{_t(__('message.back'))}}</a>
                        </div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-md-12">
                       
                        {{ Form::model($page,['method' => 'POST','route' => ['pages.store'],'enctype'=>'multipart/form-data','data-toggle'=>'validator']) }}

                            {{ Form::hidden('id', null, array('class' => 'form-control')) }}

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="form-control-label" for="username"> {{ _t(__('message.title'))}} <span class="text-red">*</span></label>
                                        {{ Form::text('page_title', null, array('class' => 'form-control','required')) }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="form-control-label" for="username"> {{ _t(__('message.content'))}} <span class="text-red">*</span></label>
                                        {{ Form::textarea('page_content',htmlspecialchars($page->page_content), array('class' => 'form-control summernote','required')) }}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary"> {{ _t(__('message.save'))}}</button>
                                </div>

                            </div>
                                
                        {{ Form::close() }} 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection