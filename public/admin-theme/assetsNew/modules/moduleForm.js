$(document).ready(function() {
    $('#module-frm').submit(function() {
        $('#module-frm #submit_btn').attr("disabled", true);
        if (true) {
            $('#AjaxLoaderDiv').fadeIn('slow');
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
                        Lobibox.notify('success', {
                            title: 'Note!',
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'bi bi-check-circle-fill',
                            msg: result.msg
                        });
                        /*var alertContainer = document.getElementById('successAlert');
                        var successMessage = document.getElementById('successMessage');
                        successMessage.innerHTML  = result.msg;
                        alertContainer.style.display = 'block';
                        $("#successAlert").addClass('show');
                        $("#successAlert").fadeTo(2000, 500).slideUp(500, function(){
                            $("#successAlert").slideUp(500);
                        });*/
                        window.location = $('#module-frm').attr("redirect-url");
                    } else {
                        Lobibox.notify('warning', {
                            title: 'Note!',
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'bi bi-exclamation-triangle-fill',
                            msg: result.msg
                        });
                        /*var alertContainer1 = document.getElementById('errorAlert');
                        var errorMessage = document.getElementById('errorMessage');
                        errorMessage.innerHTML  = result.msg;
                        alertContainer1.style.display = 'block';
                        $("#errorAlert").addClass('show');
                        $("#errorAlert").fadeTo(2000, 500).slideUp(500, function(){
                            $("#errorAlert").slideUp(500);
                        });*/
                        $('#module-frm #submit_btn').attr("disabled", false);
                    }
                },
                error: function(error) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                   console.log(error)
                }
            });
        }
        return false;
    });
    $('#search-module-frm').submit(function() {
        $('#search-module-frm #search_form_btn').attr("disabled", true);
        if (true) {
            $('#AjaxLoaderDiv').fadeIn('slow');
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
                        Lobibox.notify('success', {
                            title: 'Note!',
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'bi bi-check-circle-fill',
                            msg: result.msg,
                            delay: 5000
                        });
                        $('#client-name').text(result.data.name);
                        $('#client-phone').text(result.data.phone);
                        $('#client-city').text(result.data.city);
                        $('#client-state').text(result.data.state);
                        $('#client-pincode').text(result.data.pincode);
                        $('#client-address').text(result.data.address);
                    } else {
                        Lobibox.notify('warning', {
                            title: 'Note!',
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'bi bi-exclamation-triangle-fill',
                            msg: result.msg,
                            delay: 5000
                        });
                    }
                    $('#search-module-frm #search_form_btn').attr("disabled", false);
                },
                error: function(error) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                   console.log(error)
                }
            });
        }
        return false;
    });
});
