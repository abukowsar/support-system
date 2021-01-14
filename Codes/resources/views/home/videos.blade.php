@if(isset($videos) && count($videos) > 0)
<div class="overview-block-ptb iq-tab6" id='videos'>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="heading-title text-center">
                    <h2 class="title iq-tw-4">{{ _t(__('message.video_tutorials'))}}</h2>
                    <p>{{ _t(__('message.watch_our_video_tutorials'))}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12 iq-mtb-15">
                <div class="tab-content" id="pills-tabContent21">
                    <div class="tab-pane fade show active"  role="tabpanel">
                        <div class="video_paste_here">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 iq-mtb-15">
                <ul class="nav nav-pills tabs-left pb-0" id="tab-1" role="tablist">
                    @foreach($videos->take(4) as $key => $video)
                        <li class="tabslink nav-item ">
                            <a href="javascript:void(0)"
                               data--href="{{route('video.item',['id' => $video->id,'type'=>'public'])}}"
                               data-target=".video_paste_here" class="nav-link {{ $key==0 ? 'active' : '' }} iq-pall-30"
                               data-toggle="tabajax">
                                <h5>{{ _t($video->title) }}</h5>
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                {{ _t($video->category->category_name) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
