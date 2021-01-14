<section class="white-bg">
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-lg-3 col-sm-12 cursor bg-sect1">
                <a href="{{ route('knowledge.list')}}">
                    <div class="iq-feature4 text-center iq-font-white iq-ptb-40 iq-pl-30 iq-pr-30 ">
                        <div class="content-blog">
                            <i class="ion-ios-lightbulb-outline iq-font-white"></i>
                            <h4 class="iq-font-green iq-tw-4 iq-mt-20 iq-mb-10 iq-font-white"> {{ _t(__('message.knowledge_base')) }}</h4>
                            <p class="text-gray"> {{ _t(__('message.knowledge_section')) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-12 cursor bg-sect2">
                <a href="{{ route('public.ticket',['type'=>'public'])}}">
                    <div class="iq-feature4 text-center iq-font-white iq-ptb-40 iq-pl-30 iq-pr-30">
                        <div class="content-blog">
                            <i class="ion-ios-copy-outline iq-font-white"></i>
                            <h4 class="iq-font-white iq-tw-4 iq-mt-20 iq-mb-10"> {{ _t(__('message.public_tickets')) }}</h4>
                            <p class="text-gray"> {{ _t(__('message.public_tickets_section')) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-12 cursor bg-sect3">
                <a href="{{ route('article.list')}}">
                    <div class="iq-feature4 text-center iq-font-white iq-ptb-40 iq-pl-30 iq-pr-30">
                        <div class="content-blog">
                            <i class="ion-images iq-font-white"></i>
                            <h4 class="iq-font-white iq-tw-4 iq-mt-20 iq-mb-10"> {{ _t(__('message.articles')) }}</h4>
                            <p class="text-gray">{{ _t(__('message.articles_section')) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-12 cursor bg-sect4">
                <a href="{{ route('page',['type'=>'faqs'])}}">
                    <div class="iq-feature4 text-center iq-font-white iq-ptb-40 iq-pl-30 iq-pr-30">
                        <div class="content-blog">
                            <i class="ion-ios-chatbubble-outline iq-font-white"></i>
                            <h4 class="iq-font-white iq-tw-4 iq-mt-20 iq-mb-10">{{ _t(__('message.faq')) }}</h4>
                            <p class="text-gray">{{ _t(__('message.faq_section')) }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>