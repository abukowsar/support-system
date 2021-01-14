<script>
    (function($) {
        "use strict";

        $('[data-toggle="validator"]').validator();
        $(".select2js").select2({placeholder: "Search"});
        $(".select2js_add").select2({tags: false});
        $(".select2js_add_true").select2({
            tags: true,
        });

        @if(isset($assets) && in_array('simditor', $assets))

        Simditor.locale = 'en-US';

        var toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', 'ol', 'ul', 'blockquote', 'code', 'table', 'link', 'hr', 'indent', 'outdent', 'alignment'];

        var editor = new Simditor({
          textarea: $('#editor'),
          toolbar: toolbar
        });
        @endif

        $(document).ready(function(event){

            $(".notify-badge").each(function() {
                if($(this).text()==0){
                    $(this).css('display','none');
                }
            });

            $(document).on('click', '[data-toggle="tabajax"]', function(e) {
                e.preventDefault();
                var selectDiv = this;
                ajaxMethodCall(selectDiv);
            });

            function ajaxMethodCall(selectDiv) {
                var $this = $(selectDiv),
                    loadurl = $this.attr('data-href'),
                    targ = $this.attr('data-target'),
                    id = selectDiv.id || '';

                $.post(loadurl, function(data) {
                    $(targ).html(data);
                    $('form').append('<input type="hidden" name="active_tab" value="'+id+'" />');
                });

                $this.tab('show');
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '[data-toggle="tabajax"]', function(e) {
                e.preventDefault();
                var selectDiv = this;
                ajaxMethodCall(selectDiv);
            });

            $(document).on('click', '[data-toggle="form"]', function (e) {
                e.preventDefault();

                var url = $(this).attr('data--href');
                $.get(url, function (data) {
                    var html = data.data;

                    if(data.status!=false){
                        $(".main_form").html(html);
                        $("#formTitle").empty().append(data.page_title);
                        $("#formModal").modal("show");

                        $(document).find(".select2js").select2({dropdownParent: $('#formModal') });
                        $(document).find(".select2js_add").select2({
                            tags: true,
                            dropdownParent: $('#formModal')
                        });
                    }
                });
            });


            $(document).on('click','[data--confirmation="true"]',function(e){
                e.preventDefault();

                let form = $(this).attr('data--submit');
                let title = $(this).attr('data-title');
                let message = $(this).attr('data-message');
                let ajaxtype = $(this).attr('data-ajax');

                if(form == 'confirm_form') {
                    $('#confirm_form').attr('action', $(this).attr('href'));
                }

                confirmation(form,title,message,ajaxtype);
            });


            function confirmation(form,title = 'Confirmation',message = 'Are you sure you want to delete ?',ajaxtype=false){
                 $.confirm({
                    content: message,
                    type: '',
                    title: title,
                    buttons: {
                        ok: {
                            action: function () {
                                if (form !== undefined && form){

                                    $(document).find('[data--submit="'+form+'"]').submit();

                                }else{
                                    return true;
                                }
                            }
                        },
                        close: {
                            action: function () {}
                        },
                    },
                    theme: 'material'
                });
                 return false;
            }
        });

        //Text Editor code
        if (typeof(tinyMCE) != "undefined") {
            tinymce.init({
                selector: '.textarea',
                height: 150,
                theme: 'modern',
                content_css: [
                    'http://fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    'http://www.tinymce.com/css/codepen.min.css'
                ],
                image_advtab: true,
                plugins: "textcolor colorpicker image imagetools media charmap link print textcolor code codesample table",
                toolbar: "image undo redo | link image | code table",
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | forecolor backcolor | removeformat | code',
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.onchange = function () {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);

                            cb(blobInfo.blobUri(), {title: file.name});
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                }
            });
        }

        $(document).on('select2:select','.mailable-type',function(e){
            let data = e.params.data;
            let url = '{{ route('mailable-buttons') }}?type='+data.id;
            openModal('','','',url,'mail-button')
        });

        $(document).on('select2:select','#mail_template',function(e){
            let data = e.params.data;
            let mailable_id = $('#mailable_id').val();
            let url = '{{ route('mailable-template') }}?template_id='+data.id+'&mailable_id='+mailable_id;
            $.get(url,response => {
                tinyMCEDisable();
                $('.textarea').val(response.data.template_detail);
                $('.notification_message').val(response.data.notification_message);
                $('.notification_link').val(response.data.notification_link);
                tinyMCEnable();
                $('.texteditor-switch').attr('data-value',1);
            });
        });

        $(document).on('click','.variable_button',function () {
            var textarea = $(document).find('.tab-pane.active');
            var textareaID = textarea.find('textarea').attr('id');
            tinyMCE.activeEditor.selection.setContent($(this).attr('data-value'));
        });

        function openModal(app_title = '',app_size,app_icon = 'assignment',url,render,_this){
            if (_this !== undefined){
                if(_this.attr('data-custom-icon') === 'font_icon'){
                    $('.card-icon').html('<i class="'+_this.attr('data-icon-class')+'"></i>');
                }
            }

            if (app_size === 'small')
            {
                $('.modal-dialog').removeClass('modal-extra-large modal-lg')
            }else{
                $('.modal-dialog').addClass('modal-extra-large modal-lg')
            }

            $.get(url, function (data) {
                var html = data.data;
                if (render !== undefined && render !== '' && render !== null){
                    $('.'+render).html(html);
                } else{
                    $(".main_form").html(html);
                    $("#formTitle").empty().append(app_title);
                    $("#form-icon").html(app_icon);
                    $("#formModal").modal("show");
                }
            });
        }

        function tinyMCEDisable(elementByID = ''){
            if(elementByID !== ''){
                $(document).find(elementByID).tinymce().remove();
            }else{
                tinymce.remove('.textarea');
            }
        }

        function tinyMCEnable(elementByID = ''){

            if(elementByID !== ''){
                tinymce.init({
                    selector: elementByID,
                    theme: 'modern',
                    plugins: "code table",
                    image_advtab: true,
                    image_title: true,
                });
            }else{
                tinymce.init({
                    selector: '.textarea',
                    theme: 'modern',
                    plugins: "code table link",
                    image_advtab: true,
                    image_title: true,
                });
            }
        }

        $(document).on("click",'.ajax-datatable-call', function(event) {

            var url=$(this).attr('data-href-url');
            $.ajax({
                type: 'get',
                url: url,
                data: $(this).attr('data-form') === undefined ? [] : $($(this).attr('data-form')).serialize(),

                success: function(response)
                {
                    var table = $('.dataTable').DataTable();

                    if(response.status==true){
                        table.ajax.reload( null, false );
                        Snackbar.show({text: response.message, pos: 'bottom-center'});
                    }
                }
            });
        });

        $('pre:has(code)').addClass('has-code');

        $(".menu-check").each(function() {

            var cl=$(this).attr('keyVal');
            if($('.nav-item').hasClass(cl)){ 
                $(this).css('display','block');
            }else{
                $(this).css('display','none');
            }
        });


    })(jQuery);
</script>
