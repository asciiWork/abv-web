$(document).ready(function() {
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
                data.search_user = $("#search-frm input[name='user_id']").val();
                data.search_number = $("#search-frm input[name='number']").val();
                data.search_client_name = $("#search-frm input[name='client_name']").val();
                data.search_date = $("#search-frm input[name='date']").val();
            }
        },
        "order": [
            [0, "desc"]
        ],
        columns: dataColumns,
    });
});