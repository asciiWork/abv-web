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
                            window.location = '/';
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
    });