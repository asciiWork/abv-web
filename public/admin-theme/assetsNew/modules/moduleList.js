$(document).ready(function() {
    $(document).on('click', '.open-payment-form', function() {
        jQuery('#invoicePayment_invoice_id').val($(this).attr('data-id'));
    });
    $(document).on('click', '.open-payment-view', function() {
       jQuery('#invoicePaymentViewModel #view-payment-details').html($(this).attr('data-detail'));
       jQuery('#invoicePaymentViewModel #view-payment-date').html($(this).attr('data-date'));
       jQuery('#invoicePaymentViewModel #view-payment-type').html($(this).attr('data-type'));
    });
    $(document).on('click', '.module-action .btn-delete-record', function() {
        $text = 'Are you sure ?';
        if ($(this).attr('title') == "delete user") {
            $text = 'Are you sure you want to delete this user ?';
        }
        if (confirm($text)) {
            $url = $(this).attr('href');
            $('#global_delete_form').attr('action', $url);
            $('#global_delete_form #delete_id').val($(this).data('id'));
            $('#global_delete_form').submit();
        }

        return false;
    });

    $("#search-frm").submit(function() {
        oTableCustom.draw();
        return false;
    });

    //$.fn.dataTableExt.sErrMode = 'throw';

    var oTableCustom = $('#server-side-datatables').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        responsive: true,
        pageLength: 25,
        displayStart: 0,
        ajax: {
            url: MODULE_URL,
            data: function(data) {
                data.search_name = $("#search-frm input[name='search_name']").val();
                data.search_company = $("#search-frm input[name='search_company']").val();
                data.search_phone = $("#search-frm input[name='search_phone']").val();
                data.search_address = $("#search-frm input[name='search_address']").val();
                data.search_user = $("#search-frm input[name='search_user']").val();
                data.search_qn_number = $("#search-frm input[name='search_qn_number']").val();
                data.search_client_name = $("#search-frm input[name='search_client_name']").val();
                data.search_date = $("#search-frm input[name='search_date']").val();
                data.search_start_date = $("#search-frm input[name='search_start_date']").val();
                data.search_end_date = $("#search-frm input[name='search_end_date']").val();
                data.search_client_phone = $("#search-frm input[name='search_client_phone']").val();
                data.search_type = $("#search-frm input[name='search_type']").val();
            },
            dataSrc: function(response) {
                $("#total-with-gst").html(response.amount_with_gst);
                $("#total-without-gst").html(response.amount_without_gst);
                $("#total-sgst").html(response.sgst_amount);
                $("#total-cgst").html(response.cgst_amount);
                $("#total-igst").html(response.igst_amount);
                return response.data;
            }
        },
        "order": [
            [0, "desc"]
        ],
        columns: dataColumns,
    });
});