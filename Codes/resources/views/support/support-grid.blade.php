<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <div class="text-link">
                    <a href="{{ route('ticket.show',['slug'=>$row->slug])}}" class="main-color">
                        <h6 class="iq-tw-4 iq-mtb-10">
                            <i class="fa fa-file-text-o"></i>
                            {{ _t(stringLong(ucfirst($row->subject), '',50)) }}
                            
                        </h6>
                        @if (isset($row->theme->theme_name))
                            <h6 class="text-grey fs-16 mb-2">{{ _t($row->theme->theme_name ?? '') }}</h6>
                        @endif
                    </a>
                    <p class="text-justify"> <?php echo _t(stringLong($row->description, '',250)); ?></p>
                    <p class="iq-mall-0">
                        <span>{{ _t(__('message.created_by'))}}: <b>{{ _t($row->users->name ?? '') }}</b></span>
                        <span class="iq-ml-10"><i class="fa fa-calendar" aria-hidden="true"></i> {{timeAgoFormate($row->created_at)}}  </span>

                        <span class="iq-ml-10">
				    		<i class="fa fa-eye" aria-hidden="true"></i> {{ $row->views }}
				    	</span>

                        <span class="iq-ml-10">
				    		<i class="fa fa-comment" aria-hidden="true"></i> {{ $row->comments_count }}
				    	</span>
                    </p>
                </div>
            </div>
            <div class="col-md-2 text-right">
                <div class="helpful">
                    <span> {{ _t(__('message.helpful'))}}</span>
                    <p>{{ $row->votes_count }} <i class="fa fa-thumbs-o-up"></i></p>
                </div>
            </div>
        </div>
    </div>
</div>


