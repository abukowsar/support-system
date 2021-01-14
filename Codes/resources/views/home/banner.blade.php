<!--=================================
	Banner -->
	<div id="iq-home" class="iq-banner iq-bg jarallax" style="background-image: url('{{ asset('frontend/images/Sofdesk.jpg') }}'); background-position: center bottom;">
		<div class="container">
			<div class="row iq-m-0">
				<div class="col-lg-6 col-md-6 {{ $rtl=session()->get('locale')=='ar'?'offset-md-6':''}}">
					<div class="banner-text">
						<h1 class="iq-mb-20">{{ _tG(request()->appData->home_slide_title ?? '') }}</h1>
						<p class="fa-lg p-0">{{ _tG(request()->appData->home_slide_text  ?? '')}}</p>
						<div class="iq-mt-50 bd-none">
							<div class="card-body p-0">
								 {{ Form::open(['method' => 'Get','route' => ['supports.search'],'id'=>'universal-form', 'autocomplete' => 'off']) }}
									<div class="row">
										<div class="col-md-3">
											<select name="type" class="form-control select2js">
												<option value="tickets">{{ _t(__('message.tickets')) }}</option>
												<option value="articles">{{ _t(__('message.articles')) }}</option>
											</select>
										</div>
										<div class="col-md-9">

											<div class="input-group mb-3">
											  	<input class="search-by-name form-control" name="string" type="text" placeholder="{{ _t(__('message.search')) }}">
											  	<div class="theme-suggestion">
													<ul class="theme-suggestion-item"></ul>
											  	</div>
											  	<div class="input-group-append">
											  		<button class="button name-search-submit" type="submit"> <i class="fa fa-search"></i>  {{ _t(__('message.search')) }}</button>
											  	</div>
											</div>
										</div>
									</div>
								{{ Form::close() }} 
								<div class="row iq-mt-30">
									<div class="col-md-12">
										<a href="{{ route('article.list')}}" class="button  iq-re-4-mt30 iq-mr-0"><span class="ti ti-file"></span>  {{ _t(__('message.view_articles')) }}</a>
										<a href="{{ route('support.create')}}" class="button  iq-re-4-mt30 iq-mr-0"><span class="ti ti-ticket"></span> {{ _t(__('message.submit_a_ticket')) }}</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

<!--=================================
	  Banner-->