@if(count($knowledgeCategory)>0)
    @foreach($knowledgeCategory as $category)
        <div class="col-lg-6 col-sm-12 iq-mb-10 ">
            <div class="bg-w2 iq-pall-20 iq-blog-entry">
                <div class="small-title">
                    <a href="{{ route('knowledgebase.list',['category'=>$category->slug])}}">
                        <h5 class="title">
                            {{ _t(ucfirst(stringLong($category->category_name,'', 30))) }}
                        </h5>
                    </a>
                </div>
                <ul class="iq-mtb-20">
                    @if(isset($category->knowledge))
                        @foreach($category->knowledge->take(6) as $knowledge)
                            <a href="{{ route('knowledge.details',['slug'=>$knowledge->slug])}}">
                                <li class="iq-mb-20 d-flex">
                                    <i class="fa fa-arrow-right iq-mr-20 iq-font-green"></i>
                                    <span>{{ _t(stringLong($knowledge->title,'', 30)) }}</span>
                                </li>
                            </a>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    @endforeach
@endif


