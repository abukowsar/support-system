
@if(count($articles)>0) 
    @foreach($articles as $article)
        <div class="col-lg-{{ isset($col) ? $col :'6'}} col-md-12">
            <div class="iq-blog-entry white-bg">
                <div class="iq-entry-image clearfix">
                    <a href="{{ route('article.details',['slug'=>$article->slug])}}">
                        <img class="img-fluid iq-h-200 image-fit" src="{{ getSingleMedia($article,'article_image')}}" alt="#" />
                    </a>
                </div>
                <div class="iq-blog-detail">
                    <div class="iq-entry-title iq-mb-10"> 
                        <a href="{{ route('article.details',['slug'=>$article->slug])}}">
                            <h5 class="iq-tw-4">{{ _t(ucfirst(stringLong($article->title, $type = 'title')))}}</h5> 
                        </a> 
                    </div>
                    <div class="iq-entry-content">
                        <p>{{ _t(stringLong($article->content, $type = 'desc')) }} </p>
                    </div>
                    <ul class="iq-entry-meta iq-mt-10">
                        <li>
                            <a href="{{ route('article.details',['slug'=>$article->slug])}}">
                                <i class="fa fa-eye" aria-hidden="true"></i> 
                                {{ $article->views}} {{ _t(__('message.views'))}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
@endif


