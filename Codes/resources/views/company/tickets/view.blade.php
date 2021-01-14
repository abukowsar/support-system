@extends('layouts.master')
@section('content')
    <!------------------------------  Support Ticket [END]  ------------------------------>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-10">
                            <h2>
                                {{$pageTitle}} #{{$ticket->id}}
                                <span class="text-gray ml-2">-</span>
                                @switch($ticket->priority)
                                    @case('emergency')
                                        <span class="badge badge-danger text-capitalize">{{ $ticket->priority }}</span>
                                    @break
                                    @case('high')
                                        <span class="badge badge-warning text-capitalize">{{ $ticket->priority }}</span>
                                    @break
                                    @default
                                        <span class="badge badge-info text-capitalize">{{ $ticket->priority }}</span>
                                    @break
                                @endswitch
                                <span class="text-gray ml-2">-</span>
                                @if($ticket->status == 'closed')
                                    <span class="badge badge-success"><i></i>Closed</span>
                                @elseif($ticket->status == 'solved')
                                    <span class="badge badge-info"><i></i>Solved</span>
                                @else
                                    <span class="badge badge-warning"><i></i>Open</span>
                                @endif
                                @if (isset($ticket->departments->department_name))
                                    <span class="text-gray ml-2">-</span>
                                    <span>{{ $ticket->departments->department_name }}</span>
                                @endif
                                
                                @if (in_array($ticket->status,['open']) || !isset($ticket->assigned_id))
                                    @if(auth()->user()->hasAnyRole(['admin', 'leader']))
                                        <span class="text-gray ml-2">-</span>
                                        <a href="" class="table-action ticket-transfer btn btn-primary btn-sm btn btn-primary btn-sm mb-2  mr-0" data-toggle="form"
                                           data--href="{{ route('support.ticket.add.category', $ticket->id) }}">
                                            {{ _t(__('message.change_category',['name' => __('message.category')])) }}
                                        </a>
                                    @endif
                                @endif
                            </h2>
                            <h2 class="text-capitalize">{{$ticket->subject}}</h2>
                            @if (isset($ticket->theme->theme_name))
                                <h4><span class="text-gray">{{ $ticket->theme->theme_name }}</span></h4>
                            @endif

                            @if (isset($ticket->comments))
                                @php
                                $description = $ticket->comments->where('parent_comment',0)->first();
                                $link = [];
                                @endphp
                                @isset($description)
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><?php echo _t($description->comment); ?></p>
                                    </div>
                                </div>

                                @endisset
                            @endif
                            @if (isset($link) && count($link))
                                <span>Attachments <span>
                                    @foreach($link as $cKey => $cValue)
                                        <a href="{{ $cValue->getFullUrl() }}" target="_blank">{{ $cValue->name }}</a> |
                                    @endforeach
                                </span></span><br>
                            @endif
                            <span>Asked</span> <span class="mr-3"><strong>{{ $ticket->created_at->diffForHumans() }}</strong></span>
                            <span>Comments</span> <span class="mr-3"><strong>{{ $ticket->comments->count() }} times</strong></span>

                            <br />
                            @if ($ticket->status != 'closed')
                                <button type="button" value="Post Reply" class="btn btn-outline-primary btn-xm mt-3 btntoggle" >
                                    <i class="fa fa-comment"></i> <span class="iq-ml-5">Post Reply</span>
                                </button>
                                <div class="row collapse mt-3" id="collapseExample">
                                    <div class="col-md-12">

                                        {{ Form::open(['route'=>'comment.save','method' => 'POST','data-toggle'=>'validator','enctype'=>'multipart/form-data','id'=>'commentForm','button-loader'=> 'true']) }}
                                        {{ Form::hidden('ticket_id', $ticket->id) }}

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="input-username" class="form-control-label">
                                                    Comment <label class="text-danger">*</label>
                                                </label>
                                                <div class="form-group">
                                                    {{ Form::textarea('comment',null,['class'=>'form-control','rows'=>4,'id'=>'editor']) }}
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="input-username" class="form-control-label">
                                                        Upload Image
                                                    </label>
                                                    <input type="file" name="comment_attachment[]" class="form-control" accept="image/*" data-max-size="100MB" multiple>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <button id="submit" name="submit" type="submit" value="Post Reply" class="btn btn-primary btn-xm"> Post Reply</button>
                                                <button  type="button" class="btn btn-outline-primary btn-xm btntoggle" >Cancel</button>
                                            </div>
                                        </div>

                                        {{ Form::close() }}

                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-2 text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2  mr-0">
                                <i class="fa fa-angle-double-left"></i>  Back
                            </a><br>
                            @if($ticket->status == 'open')
                                @if(auth()->user()->hasAnyRole(['admin', 'employee']))
                                    <a class="btn btn-success btn-xm mb-2 mr-0"
                                       href="{{ route('support.ticket.action', ['id' => $ticket->id, 'type' => 'solve']) }}"
                                       data--submit="confirm_form"
                                       data--confirmation='true'
                                       data-title='{{_t(__("message.solve_ticket_form_title"))}}'
                                       data-message='{{_t(__("message.solve_ticket_form_message"))}}'>
                                        <i class="fa fa-life-ring"></i> Solve
                                    </a>
                                @elseif($ticket->user_id == auth()->id() || auth()->user()->hasAnyRole(['admin']))
                                    <a class="btn btn-danger btn-xm my-1  mr-0"
                                       href="{{ route('support.ticket.action', ['id' => $ticket->id, 'type' => 'closed']) }}"
                                       data--submit="confirm_form"
                                       data--confirmation='true'
                                       data-title='{{_t(__("message.solve_ticket_form_title"))}}'
                                       data-message='{{_t(__("message.solve_ticket_form_message"))}}'>
                                        <i class="fas fa-exclamation-circle"></i> Close
                                    </a>
                                @endif

                                @if(auth()->user()->hasAnyRole(['admin', 'leader']))
                                    <a href="javascript:void(0)" class="btn btn-warning btn-xm mr-0 mb-2" data-toggle="form"
                                       data--href="{{ route('support.ticket.transfer_form', $ticket->id) }}">
                                       <i class="ni ni-curved-next"></i> {{ _t(__('message.transfer')) }}
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!----------------------------------- Comments [START] ----------------------------------->
        <div class="col-md-12">
            @if(isset($ticket->comments))
                @foreach($ticket->comments as $key => $comment)
                    @if ($comment->type > 0)
                        {{--<div class="card mb-2 shadow">
                            <div class="card-body">
                                <div>
                                    @switch($comment->type)
                                        @case(1)
                                        @case(2)
                                        @case(3)
                                        @case(4)
                                        <span class="text-primary">
                                        <i class="far fa-clock"></i>
                                    </span>
                                        @break
                                        @default
                                    @endswitch

                                   <div class="row">
                                        <div class="col-md-12">
                                            <span class="ml-2"> {!! _t($comment->comment) !!}</span>
                                            <span class="ml-4"><i class="far fa-clock"></i> {{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                    @else
                        <div class="card mb-2 shadow">
                            <div class="card-body p-3">
                                <div class="media media-comment">
                                    <img alt="Image placeholder" class="avatar avatar-lg media-comment-avatar rounded-circle image-fit" src="{{getSingleMedia(userDetails($comment,'comment'))}}">

                                    <div class="media-body ml-3 overflow-hidden">
                                        <div class="media-comment-text">
                                            <h4 class="h4 mt-0 text-capitalize">
                                                @if($comment->user_guard == 'admin')
                                                    {{ _t($comment->admin->name ?? '') }}
                                                @elseif($comment->user_guard == 'company')
                                                    {{ _t($comment->employee->name ?? '') }}
                                                @else
                                                    {{ _t($comment->user->name ?? '') }}
                                                @endif
                                                <span class="text-muted mr-2">
                                                    @if ($comment->parent_comment == 0)
                                                            {{ _t(__('message.started_the_conversation'))}}
                                                        @else
                                                            {{ _t(__('message.replied'))}}
                                                        @endif
                                                </span>
                                                <div class="text-muted mt-1"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $comment->created_at->diffForHumans() }}</div>
                                            </h4>
                                            <p class="text-sm lh-160 m-0">{!!  _t($comment->comment) !!} </p>

                                            @php
                                                $attchments = $comment->getMedia('comment_attachment');
                                            @endphp
                                            @if(count($attchments) > 0)
                                                <div class="pxborder-l iq-plr-10  iq-mb-20 ml-20">
                                                    <p class="fs-12 iq-mlr-0"><b>{{  _t(__('message.attached_files'))}}</b></p>
                                                    <div class="iq-ml-15 gallary file-gallary-{{$comment->id}}" data-gallery=".file-gallary-{{$comment->id}}">
                                                        @foreach($attchments as $attchment )
                                                            <p class="ml-3 m-0 ">
                                                                <a href="{{ $attchment->getFullUrl() }}" download='{{ $attchment->file_name }}' class="list-group-item-action theme-list" target="_blank"><i class="fa fa-file"></i> {{ _t($attchment->file_name) }}</a>
                                                                <a href="#" download='{{ $attchment->file_name }}' target="_blank"><i class="fas fa-download ml-2"></i></a>
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            {{--<div class="icon-actions">
                                                @if(isset($comment->commentLike))
                                                    <span>
                                                        <i class="ni ni-like-2 likes"></i><span class="text-muted">{{ $comment->support_comment_likes_count }} {{_t('likes')}}</span>
                                                    </span>
                                                @else
                                                    <a href="javascript:void(0)" class="like active like_comment" id='{{ $comment->id }}'>
                                                        <i class="ni ni-like-2"></i>
                                                        <number class="text-muted">{{ $comment->support_comment_likes_count }}</number><span class="text-muted"> {{ _t('likes') }}</span>
                                                    </a>
                                                @endif
                                            </div>--}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <!----------------------------------- Comments [END]  ------------------------------------->
    </div>
    <!----------------------------------- Support Ticket [END] ----------------------------------->
@endsection

@section('body_bottom')

<script>

    (function($) {

        "use strict";

        $(document).ready(function(){

            $(".btntoggle").click(function(){
                $("#collapseExample").toggle();
                $(document).find('.btntoggle').show();
                $(this).hide();
            });

            $('.gallary').each(function (index,value) {
                let galleryClass = $(value).attr('data-gallery')
                    $(galleryClass).magnificPopup({
                        delegate: '.theme-list', // child items selector, by clicking on it popup will open
                        type: 'image',
                        gallery: {
                            enabled: true
                        }
                        // other options
                    })
            })
        });

    })(jQuery);
</script>

@endsection
