 <section class="iq-blog overview-block-ptb bg-w2">
     <div class="container">
         <div class="row">
             <div class="col-lg-12 col-md-12">
                 <div class="heading-title text-center">
                     <h2 class="title iq-tw-4">{{ _t(__('message.recent_articles'))}}</h2>
                     <p>{{ _t(__('message.look_article'))}}</p>
                 </div>
             </div>
         </div>
         <div class="row">
             @include('article.list',['articles'=>$articles,'col'=>'4']) 
             <div class="col-md-12">
                <div class="text-center iq-mt-30">
                    <a href="{{ route('article.list')}}" class="button black iq-mt-20">{{ _t(__('message.view_more_article'))}}</a>
                </div>
            </div>
         </div>
     </div>
 </section>