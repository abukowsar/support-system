@if(count($search_data) > 0)
    @foreach($search_data as $row)

    <?php
        $route=route('ticket.show',['slug'=>$row->slug]);

        $userDetail=$row->user;

        if($row->type == 'article'){
            $article=\App\Article::where('slug',$row->slug)->first();
            $userDetail=userDetails($article,'article');
            $route=route('article.details',['slug'=>$row->slug]);
        }
    ?>
        <div class="media border p-2">
            <div class="mr-3 mt-1  suggestion-count text-center rounded  {{$row->type == 'article'?'bg-dark-green': '' }} " style="width:65px;">
                <h6>{{$row->type == 'article'?'A': $row->comments_count }}</h6><small> {{$row->type == 'article'?'Article':'Answer'}}</small>
            </div>
            <div class="media-body">
                <a href="{{ $route }}" class="main-color">
                <h6 class="fs-16">{{  stringLong($row->title,'',60)}} </h6>
                </a>
                <p class="fs-13 m-0">{!!  substr(stringLong($row->description,'','150'),0,140) !!} </p>

                <small class="float-md-right"><i> {{$row->type == 'article'?'added': 'asked' }} {{timeAgoFormate($row->created_at)}} by {{ _t($userDetail->name ?? '') }}

                </i></small>
            </div>
        </div>
    @endforeach
@endif