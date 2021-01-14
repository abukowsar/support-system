
<script>

    (function($) { 

        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var scrollContent = $(document).find('#scroll-content');

        if(scrollContent.length){

            /* pagination on ajax scroll*/
            $(document).scroll(function(){
                var scrollContent = $(document).find('#scroll-content');
                if(!parseInt(scrollContent.attr('data-processing')) && parseInt(scrollContent.attr('data-content'))) {
                    if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5){
                        scrollContentLoad();
                    }
                }
            });

            $(document).ready(function(){
                
               scrollContentLoad();
            });

            function scrollContentLoad() {
                scrollContent.attr('data-processing', 1);
                let page = parseInt(scrollContent.attr('data-index'));

                $.ajax({
                     type: 'POST',
                     url: scrollContent.attr('data-url')+'?page='+page,
                     data: scrollContent.attr('data-form') === undefined ? [] : $(scrollContent.attr('data-form')).serialize(),
                     success: function(response) {
                        var scrollContent = $(document).find('#scroll-content');

                        if(response.status){

                            if(page==1){
                                scrollContent.empty();
                            }
                            scrollContent.append(response.html);
                            scrollContent.attr('data-processing', 0);
                            scrollContent.attr('data-index', page+1);
                            
                            if(!response.is_more) {
                                scrollContent.attr('data-content', 0);
                            }
                         }
                     }
                 });
            }

            $(document).on('click', '.scroll-load', function (e) {
                scrollContent.attr('data-index', 1);
                scrollContentLoad();
            });
        }

        $('pre:has(code)').addClass('has-code');


        $(document).on('click', function (event) { 
              
            if (!$(event.target).closest('.search-by-name').length) {
                $(".theme-suggestion").fadeOut();
            }
        });

    })(jQuery); 

    
</script>
