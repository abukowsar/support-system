<!-- Bootstrap and Jquery plugins -->
<script src='{{ asset("frontend/js/jquery-1.11.3.min.js") }}'></script>
<!-- Bootstrap Validator -->

<script src="  {{ asset('frontend/js/popper.min.js') }}"></script>
<script src=" {{ asset('frontend/js/bootstrap.min.js') }}"></script>

<!-- Mega Menu -->
<script src="{{ asset('frontend/js/mega-menu/mega_menu.js ') }}"></script>
<!-- Main -->
<script src=" {{ asset('frontend/js/main.js') }}"></script>
<!-- Custom -->
<script src="{{ asset('assets/vendor/validation/js/validator.min.js') }}"></script>
<script src=" {{ asset('js/custom.js') }}"></script>
<script src=" {{ asset('frontend/js/custom.js') }}"></script>

<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/vendor/snackbar/js/snackbar.js') }}"></script>

<script src="{{ asset('assets/vendor/confirmJs/confirm.min.js')}}"></script>
<script src="{{ asset('assets/vendor/polyglotLanguage/js/jquery-polyglot.language.switcher.min.js')}}"></script>

<!-- plyr js -->
<script src="{{ asset('assets/vendor/plyr/plyr.js') }}"></script>

@if(isset($assets) && in_array('simditor', $assets))
<script type="text/javascript" src=" {{ asset('assets/vendor/simditor/js/module.js')}}"></script>
<script type="text/javascript" src=" {{ asset('assets/vendor/simditor/js/hotkeys.js')}}"></script>
<script type="text/javascript" src=" {{ asset('assets/vendor/simditor/js/simditor.js')}}"></script>
@endif

@if(isset($assets) && in_array('readmore', $assets))
<script type="text/javascript" src=" {{ asset('assets/vendor/readmore/readmore.min.js')}}"></script>
@endif

<script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

@include('helper.app_mesage')


<?php echo request()->appData->site_footer_code; ?>

<script>

    (function($) {

        "use strict";

        $('.polyglot-language-switcher').polyglotLanguageSwitcher({
            openMode: 'hover',
            hoverTimeout: 200,
            animSpeed: 200,
            animEffect: 'fade',
            gridColumns: 1,
            selectedLang: function () {
                return $('html').attr('lang');
            }
        });

        @if(isset($assets) && in_array('readmore', $assets))

        $('.read-more').readmore({
            speed: 75,
            collapsedHeight:312,
            moreLink: '<a href="#">Read more</a>',
            lessLink: '<a href="#">Read less</a>'
        });
        @endif


        @if(isset($assets) && in_array('simditor', $assets))

        Simditor.locale = 'en-US';

        var toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', 'ol', 'ul', 'blockquote', 'code', 'table', 'link', 'hr', 'indent', 'outdent', 'alignment'];

        var editor = new Simditor({
          textarea: $('#editor'),
          toolbar: toolbar
        });
        
        @endif

        $(document).on('click', '.polyglot-language-switcher li', function(){
            var language = $(this).find('a').attr('data-lang-id') || null;

            window.location.href = '{{ URL("lang") }}/'+language;
        });

        const players = Array.from(document.querySelectorAll('.player')).map(p => new Plyr(p));

        $(".select2js").select2({placeholder: "Search",});
        $(".select2js_add").select2({
            tags: true,
        });

        $(document).ready(function(event){

            $(document).on('click', '[data-toggle="tabajax"]', function(e) {
                e.preventDefault();
                var selectDiv = this;
                ajaxMethodCall(selectDiv);
            });

            function ajaxMethodCall(selectDiv) {

                var current=$(document).find('.list-type').attr('id');
                var $this = $(selectDiv),
                    loadurl = $this.attr('data--href'),
                    targ = $this.attr('data-target'),
                    id = selectDiv.id || '';

                if(current !==undefined){
                    loadurl=loadurl+'&list_type=grid&page_limit=6';
                }

                $.get(loadurl, function(data) {
                    data = data.html || data;
                    $(targ).html(data);
                    $('form').append('<input type="hidden" name="active_tab" value="'+id+'" />');
                });

                $this.tab('show');
                return false;
            }

             $(document).on('click', '[data-toggle="form"]', function (e) {
                var app_title = $(this).attr('data-app-title');
                var url = $(this).attr('data--href');
                $.get(url, function (data) {
                    var html = data.data;

                    if(data.status!=false){

                        $(".main_form").html(html);
                        $("#formTitle").empty().append(app_title);
                        $("#formModal").modal("show");
                    }
                });
            });

            $(document).ready(function () {
                 $(document).on('click','[data--confirmation="true"]',function(e){
                    e.preventDefault();
                    var form = $(this).attr('data--submit');

                    var title = $(this).attr('data-title');

                    var message = $(this).attr('data-message');

                    var ajaxtype = $(this).attr('data-ajax');

                    confirmation(form,title,message,ajaxtype);
                 });
            });

            function confirmation(form,title = 'Confirmation',message = "{{ _t(__('message.delete_msg')) }}",ajaxtype=false){
                 $.confirm({
                    content: message,
                    type: '',
                    title: title,
                    buttons: {
                        ok: {
                            action: function () {
                                if (form !== undefined && form){
                                    if(ajaxtype){

                                        var table = $('.dataTable').DataTable();

                                        $.ajax({
                                            type: 'Post',
                                            url: $("[data--submit='"+form+"']").attr('action'),
                                            data: $("[data--submit='"+form+"']").serialize(),
                                            success: function(response) {

                                                if(response.status===true){
                                                    table.ajax.reload( null, false );
                                                }

                                                Snackbar.show({text: response.message, pos: 'top-right'});
                                            }
                                        });

                                    }else{
                                        $(document).find('[data--submit="'+form+'"]').submit();
                                    }

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

        $(document).on('click', function (event) { 
            if (!$(event.target).closest('.search-by-name').length) {
                $(".theme-suggestion").fadeOut();
            }
        });

    })(jQuery);

</script>
