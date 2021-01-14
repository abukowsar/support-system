@extends('layouts.frontend')

@section('banner')
    <section class="green-bg iq-breadcrumb2 text-center iq-font-white">
        <div class="container">
            <div class="row">
                <div class="col-lg justify-content-center">
                    <div class="heading-title iq-mb-0">
                        <h2 class="title white iq-font-white iq-tw-4">{{ _t(__('message.tickets'))}}</h2>
                        <nav aria-label="breadcrumb" class="iq-mt-30">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home')}}"><i
                                            class="ion-android-home"></i> {{ _t(__('message.home'))}}</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('public.ticket',['type'=>'public'])}}">{{ _t(__('message.tickets'))}}</a>
                                </li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{  _t(ucfirst(stringLong($ticket->subject,'', 30))) }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="iq-blog overview-block-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12 iq-mtb-15">
                    <div class="iq-blog-entry iq-audio white-bg">
                        <div class="iq-pos-r">
                            <div class="iq-blog-detail">
                                <div class="border-0">
                                    <div class="card-body">
                                        <div class="iq-entry-title iq-mb-10 iq-mt-10">
                                            <h5 class="iq-tw-4">{{ _t($ticket->subject) }}</h5>
                                        </div>
                                        <ul class="iq-entry-meta iq-mt-10 iq-mb-10">
                                            <li>
                                                <i class="fa fa-user"
                                                   aria-hidden="true"></i> {{ _t($ticket->users->name ?? '')}}
                                            </li>
                                            <li>
                                                <i class="fa fa-clock-o"
                                                   aria-hidden="true"></i> {{timeAgoFormate($ticket->created_at)}}
                                            </li>
                                            <li>
                                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $ticket->views }}
                                            </li>
                                            <li>
                                                <i class="fa fa-comment"
                                                   aria-hidden="true"></i> {{ $ticket->comments_count}}
                                            </li>
                                        </ul>
                                        <hr class="iq-mtb-10">

                                            @if(\Auth::check() && \Auth::user()->hasRole('user'))

                                                <?php
                                                    $userVote = isset($ticket->userVote->vote) ? $ticket->userVote->vote : '';
                                                ?>
                                                <div class="iq-mtb-10">
                                                    <a href="{{route('user.vots',['val'=>'yes','item_id'=>$ticket->id,'type'=>'ticket'])}}">
                                                    <span class="tag {{$userVote==1?'':'tag-outline'}}">
                                                        <i class="fa fa-thumbs-o-up"></i> YES
                                                    </span>
                                                    </a>
                                                    <a href="{{route('user.vots',['val'=>'no','item_id'=>$ticket->id,'type'=>'ticket'])}}">
                                                    <span class="date {{$userVote == 0 ?'':'tag-outline'}}">
                                                        <i class="fa fa-thumbs-o-down">
                                                        </i> NO
                                                    </span>
                                                    </a>
                                                </div>
                                            @endif
                                        
                                        <p class="read-more"><?php echo _t($ticket->description); ?></p>

                                        <hr class="iq-mtb-10">

                                        @if($ticket->status =='open')
                                            <div class="row iq-mt-30">
                                                <div class="col-md-12">

                                                    @if(\Auth::check())
                                                        <button type="button" value="Post Reply"
                                                                class="button  btntoggle  pull-left">
                                                            <i class="fa fa-comment"></i> <span
                                                                class="iq-ml-5"> {{ _t(__('message.post_reply'))}}</span>
                                                        </button>
                                                    @else
                                                        <a href="{{route('post.reply')}}">
                                                            <button type="button" class="button pull-left">
                                                                <i class="fa fa-comment"></i> <span
                                                                    class="iq-ml-5">{{ _t(__('message.post_reply'))}}</span>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-lg-12 col-sm-12 iq-mt-20 d-none"
                                                         id="togglecomments">

                                                        {{ Form::open(['route'=>'comment.save','method' => 'POST','data-toggle'=>'validator','files'=>true ,'enctype'=>'multipart/form-data','id'=>'contactform']) }}
                                                        {{ Form::hidden('id',-1) }}
                                                        <div class="row">
                                                            <div class="col-md-12 p-0">
                                                                <div class="form-group">
                                                                    {{ Form::textarea('comment',null,['class'=>'form-control','id'=>'editor']) }}
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="ticket_id"
                                                                   value="{{ $ticket->id }}">
                                                            <div class="form-group col-lg-12 col-sm-12 p-0">
                                                                <input type="file" name="comment_attachment[]"
                                                                       class="form-control" accept="image/*"
                                                                       data-max-size="100MB" multiple="">
                                                            </div>
                                                            <div class="col-md-12 p-0 ">

                                                                <button id="submit" name="submit" type="submit"
                                                                        value="Post Reply"
                                                                        class="button iq-mt-20  submit-btn"> {{ _t(__('message.post_reply'))}}</button>
                                                                <button type="button"
                                                                        class="button btntoggle iq-mt-20">{{ _t(__('message.cancel'))}}</button>
                                                            </div>
                                                        </div>
                                                        {{ Form::close() }}

                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div id="comments" class="iq-mt-30">
                                            <ol class="list-inline iq-comment-list">
                                                @if(isset($ticket->comments))
                                                    @foreach($ticket->comments as $key=> $comment)
                                                        <li class="iq-mt-0">
                                                            <div class="media iq-comments-media ">
                                                                <img class="mr-3"
                                                                     src="{{getSingleMedia($comment->user,'profile_image')}}"
                                                                     alt="Generic placeholder image">
                                                                <div class="media-body overflow-hidden">
                                                                    <h6 class="iq-mt-0 iq-tw-4">

                                                                    @if($comment->user_guard == 'admin')
                                                                        {{ _t($comment->admin->name ?? '') }}
                                                                    @elseif($comment->user_guard == 'company')
                                                                        {{ _t($comment->employee->name ?? '') }}
                                                                    @else
                                                                        {{ _t($comment->user->name ?? '') }}
                                                                    @endif

                                                                    @if($comment->parent_comment == 0)
                                                                        <span
                                                                            class="fs-13 text-grey"> {{ _t(__('message.started_the_conversation'))}}</span>
                                                                    @else
                                                                        <span
                                                                            class="fs-13 text-grey"> {{ _t(__('message.replied'))}}</span>
                                                                    @endif
                                                                    </h6>
                                                                    <div class="iq-comment-metadata">
                                                                        <i class="fa fa-calendar"></i>
                                                                        <span>{{timeAgoFormate($comment->created_at)}}</span>
                                                                        <i class="fa fa-thumbs-up text-main"></i>
                                                                        <span
                                                                            class="all-comment-count{{$comment->id}}">{{ $comment->comment_like_count}}</span>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p><?php echo _t($comment->comment); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    

                                                                    @if(getMediaFileExit($comment, 'comment_attachment'))

                                                                        @php
                                                                            $attchments = $comment->getMedia('comment_attachment');
                                                                        @endphp

                                                                        <div class="pxborder-l iq-plr-10  iq-mb-20 iq-ml-20">
                                                                            <p class="fs-12 iq-mlr-0">
                                                                                <b> {{ _t(__('message.attached_files'))}}</b>
                                                                            </p>
                                                                            <div class="iq-ml-15 gallary file-gallary-{{$comment->id}}" data-gallery=".file-gallary-{{$comment->id}}">
                                                                                @foreach($attchments as $attchment )
                                                                                <p class="iq-mlr-0 ">
                                                                                    <a href="{{ $attchment->getFullUrl() }}" download='{{ $attchment->file_name }}'
                                                                                       class="text-main list-group-item-action theme-list text-main ">{{ $comment->getFirstMedia('comment_attachment')->file_name }}
                                                                                    </a>

                                                                                    <a href="#" download='{{ $attchment->file_name }}' target="_blank"><i class="fa fa-download ml-2 main-color"></i></a>
                                                                                </p>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @if(\Auth::check())
                                                                        <button type="button"
                                                                                class="btn extrasmalls white-bg iq-mb-10 border-grey fs-14 {{isset($comment->commentLikeByMe)?'like-btn':'like_comment'}}"
                                                                                id='{{$comment->id}}'>
                                                                            <i class="fa fa-thumbs-up {{isset($comment->commentLikeByMe)?'':'text-main'}}"></i>
                                                                            {{_t('Like')}}
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 iq-mtb-15">
                    <div class="iq-post-sidebar">
                        <div class="iq-sidebar-widget bg-w2 iq-mt-10">
                            <h5 class="iq-tw-4 small-title iq-font-dark">{{ _t(__('message.categories'))}}</h5>
                            <div class="iq-widget-menu ">
                                <ul class="iq-pl-0">
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{route('public.ticket',['type'=>'public','category'=>$category->slug])}}">
                                                    <span>{{ _t(ucfirst(stringLong($category->category_name,'title', 0))) }} <i class="fa fa-angle-right"></i></span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="iq-sidebar-widget bg-w2 iq-mt-10">
                            <h5 class="iq-tw-4 small-title iq-font-dark">{{ _t(__('message.recent_tickets'))}}</h5>
                            <div class="iq-recent-post media">
                                <div class="media-body">
                                    @if(isset($recentTickets))
                                        @foreach($recentTickets as $recentTicket)
                                            <a href="{{ route('ticket.show',['slug'=>$recentTicket->slug])}}"
                                               class="iq-mt-10">{{ _t(stringLong($recentTicket->subject, $type = 'title'))}}</a>
                                            <span><i class="fa fa-calendar"></i>{{timeAgoFormate($recentTicket->created_at)}}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('body_bottom')
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {

                $(".btntoggle").click(function () {
                    $("#togglecomments").toggleClass('d-none');
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

                $(document).on('click', '.like_comment', function (e) {

                    e.preventDefault();
                    var $this = $(this);
                    var id = $this.attr('id');
                    var vote = 0;

                    $.ajax({
                        type: 'Post',
                        url: '{{route('comment.loved')}}',
                        data: {'id': id, 'vote': vote, '_token': '{{ csrf_token() }}'},
                        success: function (res) {
                            if (res.status == true) {
                                var c = ($(document).find('.all-comment-count' + id).text());
                                c++;
                                $(document).find('.all-comment-count' + id).empty().text(c);
                                $this.removeClass('like_comment').addClass('like-btn');
                                $this.find('i').removeClass('text-main').addClass('text-white');
                            }
                        }
                    });
                })
            });
        })(jQuery);
    </script>
@endsection
