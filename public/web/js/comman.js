$(document).ready(function() {
    $('#submit-form').submit(function() {
        if ($(this).parsley('isValid')) {
            $('#AjaxLoaderDiv').fadeIn('slow');
            $('#submit-form #submit-form-button').attr('disabled', true);
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function(result) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    if (result.status == 1) {
                        $.bootstrapGrowl(result.msg, {
                            type: 'success',
                            delay: 4000
                        });
                        if (typeof result.redirect !== 'undefined') {
                            window.location = result.redirect;
                        }
                        window.location = $('#submit-form').attr('redirect');
                    } else {
                        $.bootstrapGrowl(result.msg, {
                            type: 'danger',
                            delay: 4000
                        });
                    }
                    $('#submit-form #submit-form-button').attr('disabled', false);
                },
                error: function(error) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    $.bootstrapGrowl("Internal server error !", {
                        type: 'danger',
                        delay: 4000
                    });
                    $('#submit-form #submit-form-button').attr('disabled', false);
                }
            });
        }
        return false;
    });
    $('#submit-form-razorpay').submit(function() {
        if ($(this).parsley('isValid')) {
            $('#AjaxLoaderDiv').fadeIn('slow');
            $('#submit-form-razorpay #submit-form-razorpay-button').attr('disabled', true);
            $.bootstrapGrowl("Order Placing...", {type: 'warning',delay: 4000});
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function(result) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    if (result.status == 1) {
                        $.bootstrapGrowl(result.msg, {
                            type: 'success',
                            delay: 4000
                        });
                        rurl=result.redirect;
                        window.location = rurl;
                    } else {
                        $.bootstrapGrowl(result.msg, {
                            type: 'danger',
                            delay: 4000
                        });
                    }
                    $('#submit-form-razorpay #submit-form-razorpay-button').attr('disabled', false);
                },
                error: function(error) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    $.bootstrapGrowl("Internal server error !", {
                        type: 'danger',
                        delay: 4000
                    });
                    $('#submit-form #submit-form-button').attr('disabled', false);
                }
            });
        }
        return false;
    });
    $(document).on('click','.remove-cart-btn',function () {
        var pid = $(this).attr('data-id');
        var prosize = $(this).attr('data-size');
        var isRefresh = $(this).attr('isRefresh');
        var pSize = $(this).attr('data-size');
        $('#AjaxLoaderDiv').fadeIn('slow');
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            type: "GET",
            url: $(this).attr("action"),
            data: { id : pid, size:pSize},
            success: function (result)
            {
                $('#AjaxLoaderDiv').fadeOut('slow');
                if (result.status == 1)
                {
                    $.bootstrapGrowl(result.msg, {type: 'success', delay: 5000});
                    if(isRefresh == 1){
                        location.reload();
                    }else{
                        openCartModal();
                    }
                }
                else
                {
                    $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                }
            },
            error: function (error)
            {
                $('#AjaxLoaderDiv').fadeOut('slow');
                $.bootstrapGrowl("Internal Server Error", {type: 'danger', delay: 4000});
            }
        });
    });
    $(document).on('click','.increase-decrease-cart-btn',function () {
        var pid = $(this).attr('data-id');
        var prosize = $(this).attr('data-size');
        var ctype = $(this).attr('type');
        var psize = $(this).attr('data-size');
        $('#AjaxLoaderDiv').fadeIn('slow');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            url: $(this).attr("action"),
            data: { id : pid, ctype : ctype, size : psize},
            success: function (result)
            {
                $('#AjaxLoaderDiv').fadeOut('slow');
                if (result.status == 1)
                {
                    $.bootstrapGrowl(result.msg, {type: 'success', delay: 5000});
                    location.reload();
                }
                else
                {
                    $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                }
            },
            error: function (error)
            {
                $('#AjaxLoaderDiv').fadeOut('slow');
                $.bootstrapGrowl("Internal Server Error", {type: 'danger', delay: 4000});
            }
        });
    });
    var purl= http_host_js + '/search-product';
    $('.js-example-basic-single').select2({
        allowClear:true,
        placeholder: 'Search for a products...',
        minimumInputLength: 2,
        ajax: {
            url: purl,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.product_name,
                            text: item.product_name,
                            description: item.product_detail,
                            product_img: item.product_img_url
                        }
                    })
                };
            },
            cache: true
        },
        templateResult: formatProduct,
        templateSelection: formatProductSelection
    });

    function formatProduct (product) {
        if (!product.id) {
            return product.text;
        }
        var $product = $(
            '<span><img style="display: inline;" width="40" src="' +http_host_js+'/public/web/assets/img/product/main-product/'+ product.product_img + '" class="img-flag" /> ' + product.text + '</span>'
        );
        return $product;
    }

    function formatProductSelection (product) {
        return product.text;
    }
});
function openQuickModal(pid)
{
    var url = http_host_js + '/open-quick-view';
    $.ajax({
        headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: url,
        data: { id : pid},        
        success: function (result)
        {
            //$('#AjaxLoaderDiv').fadeOut('slow');
            jQuery('#examplemodal').html(result);
            $('#examplemodal').modal('show');
        },
        error: function (error)
        {
            $('#AjaxLoaderDiv').fadeOut('slow');
            $.bootstrapGrowl("Internal Server Error", {type: 'danger', delay: 4000});
        }
    });
}