<!-- Tab -->
<div class="overview-block-ptb grey-bg iq-tab-services">
     <div class="container">
         <div class="row">
             <div class="col-sm-12">
                 <div class="heading-title text-center">
                     <h2 class="title iq-tw-4">{{ _t(__('message.public_tickets')) }}</h2>
                     <p>{{ _t(__('message.public_tickets_desc')) }}</p>
                 </div>
             </div>
         </div>
         <div class="row tab-cont ">
             <div class="col-lg-12 col-md-12 col-sm-12 iq-mtb-15 light-tab">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                           @foreach($categories as $key => $category)
                               <li class="tabslink nav-item">
                                   <a href="javascript:void(0)"
                                      data--href="{{route('ticket.list',['category' => $category->id,'type'=>'public'])}}"
                                      data-target=".paste_here" class="nav-link {{ $key==0 ? 'active' : '' }}"
                                      data-toggle="tabajax">
                                       {{ _t($category->category_name.' ('.$category->ticket_category_count.')') }}
                                   </a>
                               </li>
                           @endforeach
                        </ul>
                    </div>
                </div>

             </div>
         </div>
         <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12 iq-mtb-15 faqs">
                 <!-- Tab panes -->
                 <div class="tab-content" id="pills-tabContent2">
                    <div class="tab-pane fade show active"  role="tabpanel">
                     	<div class="paste_here">
                     	</div>
                    </div>

                    <div class="text-center iq-mt-30">
                        <a href="{{ route('public.ticket',['type'=>'public'])}}" class="button black iq-mt-20">{{ _t(__('message.view_more_tickets'))}}</a>
                    </div>

                 </div>
             </div>
             <div class="clearfix"></div>
         </div>
     </div>
 </div>
 <!-- Tab -->
