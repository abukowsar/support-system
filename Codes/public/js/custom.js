
(function($) {

    "use strict";

    function errorMessage(message) {
        Snackbar.show({
            text: message,
            pos: 'bottom-center',
            backgroundColor: '#dc3545',
            actionTextColor: 'white'
        });
    }

    function showMessage(message) {
        Snackbar.show({
            text: message,
            pos: 'bottom-center'
        });
    }

    $('form[button-loader="true"]').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
        // handle the invalid form...
        } else {
            let formButton = $(this).find('button[type="submit"]');
            let formButtonValue = formButton.html();
            formButton.addClass('disabled');
            formButton.prop('disabled', true);
            formButton.html('<i class="fa fa-spinner fa-spin"></i> Please Wait ..');
        }
    })

    $(document).on('submit', '[data-ajax="true"]', function(e) {

        if (e.isDefaultPrevented()) {
            return true;
        }

        e.preventDefault();

        let current = $(this);
        let form = $(this).closest('form');
        let formdata = new FormData(this);
        let url = form.attr('action');

        let formButton = $(this).closest('form').find('button[type="submit"]');
        let formButtonValue = formButton.html();
        formButton.addClass('disabled');
        formButton.prop('disabled', true);
        formButton.html('<i class="fa fa-spinner fa-spin"></i> Please Wait ..');

        storeData(current, url, form, formButton, formButtonValue, formdata, 0);
    });

    function storeData(current, url, form, formButton, formButtonValue, formdata, reload = 0) {
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            error: function(jqXHR, exception) {
                errorMessage('Something went wrong');
            }
        }).done(function(data) {
            if (data.status) {
                let redirectURL = data.redirect_url || null;
                if (redirectURL) {
                    window.location.href = redirectURL;
                } else {
                    showMessage(data.message);
                    formButton.html(formButtonValue);
                }
                if (reload == 1) {
                    window.location.reload();
                }

                let callbackEvent = form.data('callback') || null;

                if (callbackEvent != null && $.isFunction(window.eval(couponCallback))){
                    window[callbackEvent](data);
                }

                let dataTableReload = data.datatable_reload || null;

                if (dataTableReload) {

                    let dataTableID = data.datatable_id || null;
                    if (dataTableID) {
                        $('#' + data.datatable_id).DataTable().ajax.reload();
                    } else {
                        // $('#dataTableBuilder').DataTable().ajax.reload();
                    }

                }

                $('#formModal').modal('hide');
                formButton.removeClass('disabled');
                formButton.prop('disabled', false);
            }else{
                $.each(data.message, function(index, value) {
                    form.find('[name="' + index + '"]').closest('.form-group').addClass('has-danger');
                    errorMessage(value[0]);
                });

                formButton.html(formButtonValue);
                formButton.removeClass('disabled');
                formButton.prop('disabled', false);
            }

        }).fail(function(data) {
            var ajaxData = data.responseJSON;

            var errors = ajaxData.errors || null;

            if(errors) {
                $.each(ajaxData.errors, function(index, value) {
                    form.find('[name="' + index + '"]').closest('.form-group').addClass('has-danger');
                    errorMessage(value[0]);
                });
            } else {
                errorMessage(ajaxData.message);
            }

            formButton.html(formButtonValue);
            formButton.removeClass('disabled');
            formButton.prop('disabled', false);
        })
    }

    $(document).on('keyup','[data--change="label"]',function(e) {

        var target = $(this).attr('data--target');
        var value = $(this).val();

        if (value === undefined || value === null || value === '') {
            value = '<span class="text-danger">Not available</span>'
        }
        $(target).html(value);
    });


    // Script for the toggle global Image update modal...
    // Required Params..
    // 1. data--toggle="upload_modal"
    // 2. data-target-input=".some_target_element" (Trigger input type file)

    $(document).on('click','[data--toggle="upload_modal"]', function () {

        var taget_input = $(this).attr('data-target-input');

        if (taget_input !== undefined && taget_input !== null)
            $('.model_upload_btn').attr('onClick','$("' + taget_input + '")[0].click();');

        $('.image_upload-modal').modal('show');

    });

    // Script for the display images from the input type file...
    $(document).on('change','[data--toggle="values"]', function (e) {
        readURL(this);
    });

    function readURL(input) {

        var target = $(input).attr('data--target');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(target).attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }

        var modal = $(input).attr('data--modal');

        if (modal !== undefined && modal !== null && modal === 'modal')
            $('.image_upload-modal').modal('hide');

    }

    $(document).on('change','.notify-setting',function (e) {
        
        if($(this).is(":checked")){
            $('.notify-config').removeClass('d-none');
        }else{
            $('.notify-config').addClass('d-none');
        }
    });

    $(document).on('select2:select','.purchased-themes',function (e) {
        let data = e.params.data;
        $('.purchase-code').val(data.purchase_code);
    });

    $(document).on('focusout','.purchase-code',function (e) {

        let code = $(this).val();

        let href = $(this).attr('data-href');

       if($(this).val() !== '' && $(this).val() !== undefined && $(this).val() !== null){
           callToCheckCode(code,href);
       }
    });

    $(document).on('keyup','.purchase-code',function (e) {
        if($(this).val() !== '' && $(this).val() !== undefined && $(this).val() !== null){

        }else{
            $('.purchased-themes-success').addClass('d-none');
            $('.purchased-themes-error').addClass('d-none');
        }
    });

    $(document).on('select2:select','.departments',function (e) {
        let data = e.params.data;
        departmentEmployee($(this),data.id);

    });
    function departmentEmployee(selector,id){
        let url = selector.attr('leader-ajax--url')+'&department_id='+id;
        let target = selector.attr('leader-target');
        selectAjax(target,url)
        return true;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function selectAjax(target,url) {
        $(document).find(target).select2('destroy');
        $(document).find(target).select2({
            ajax:{
                url:url,
                dataType:'json'
            }
        });
    }
    function callToCheckCode(code,href){
        $.ajax({
            type: 'Post',
            url: href,
            data: {'code':code},
            success: function(res)
            {
                if(res.status === true){
                    let newOption = new Option(res.data.name, res.data.id, true, true);
                    $('.purchased-themes').append(newOption).trigger('change');
                    $('.purchased-themes-error').addClass('d-none');
                    $('.purchased-themes-error').closest('.form-group').addClass('has-success');
                    $('.purchased-themes-success').removeClass('d-none').find('.with-success').html('Purchase code is valid')
                }else{
                    $(document).find('.purchased-themes').empty();
                    $('.purchased-themes-success').addClass('d-none');
                    $('.purchased-themes-error').removeClass('d-none');
                    $('.purchased-themes-error').closest('.form-group').addClass('has-danger');
                    if (res.code !== undefined){
                        $('.purchased-themes-error').find('.with-errors').html(res.code[0]);
                    }else{
                        $('.purchased-themes-error').find('.with-errors').html('Purchase code is invalid');
                    }
                }
            }
        }).fail(error => {
            console.log(error)
        });
    }

})(jQuery);



