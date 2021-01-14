<div class="bg-gradient-primary pb-5 pt-md-8">

</div>
<!-- Page content -->
<div class="container-fluid mt--7">
    @yield('content')
    <div class="modal fade image_upload-modal" id="profileModal" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 20px;">
                <div class="modal-body">
                    <h2 class="text-center"> {{ _t(__('message.change_profile_photo'))}}</h2>
                </div>
                <span
                    class="text-primary cursor-pointer text-center pt-2 pb-2 border-top model_upload_btn font-weight-bold"> {{ _t(__('message.upload_photo'))}}</span>
                <a href="{{ route('remove.current.photo')}}"
                   class="text-danger text-center pt-2 pb-2  border-top font-weight-bold">{{ _t(__('message.remove_current_photo'))}}</a>
                <a href="#" class="text-center text-dark pt-2 pb-2 border-top"
                   data-dismiss="modal">{{ _t(__('message.close'))}}</a>
            </div>
        </div>
    </div>

    @include('partials._body_footer')
</div>
