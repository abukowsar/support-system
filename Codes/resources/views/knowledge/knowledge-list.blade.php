@if(count($knowledgebase)>0)
    @foreach($knowledgebase as  $k=> $knowledge)
        <div class="card">
            <div class=" card-body">
                <div class="view-list white-bg">
                    <div class="">
                        <div class="iq-entry-title">
                            <a href="{{ route('knowledge.details',['slug'=>$knowledge->slug])}}">
                                <h5 class="iq-tw-4">{{ _t(ucfirst(stringLong($knowledge->title,'', 100))) }} </h5>
                            </a>
                        </div>
                        <?php $userDetail = userDetails($knowledge, 'knowledge'); ?>
                        <ul class="iq-entry-meta iq-mt-10">
                            <li>
                                <i class="fa fa-user" aria-hidden="true"></i> {{ _t($userDetail->name ?? '') }}
                            </li>
                            <li>
                                <i class="fa fa-eye"
                                   aria-hidden="true"></i> {{ _t($knowledge->views) }}  {{ _t(__('message.views'))}}
                            </li>
                            <li><i class="fa fa-clock-o" aria-hidden="true"></i>
                                {{timeAgoFormate($knowledge->created_at)}}
                            </li>
                        </ul>
                        <hr class="iq-mtb-10">
                        <div class="iq-entry-content">
                            <p class="text-justify">{{ _t(stringLong($knowledge->content,'', 250)) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
