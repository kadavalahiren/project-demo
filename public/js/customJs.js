// const { defaultsDeep } = require("lodash");

// const { Tab } = require("bootstrap");

// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

setTimeout(function () {
    $('.alert').fadeOut('fast');
}, 5000);


// function ValidateAlpha(evt) {
//     var keyCode = (evt.which) ? evt.which : evt.keyCode
//     if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

//         return false;
//     return true;
// }

// function ValidateAlphaToUpperCase(evt) {
//     var keyCode = (evt.which) ? evt.which : evt.keyCode
//     if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) {
//         return false;
//     } else {
//         var str = this.val();
//         console.log(str.toUpperCase());
//         this.val(str)
//         return true;
//     }
// }

/*
|-------------------------------------|
| Change Status List Row              |
|-------------------------------------|
*/
function changeStatus(changeStatusUrl) {
    if (changeStatusUrl != "") {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title: 'Are you sure?',
            text: "change this status",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Change it!'
        }).then((result) => {

            if (result.value && result.value == true) {

                $.ajax({
                    url: changeStatusUrl,
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire(
                            data.title,
                            data.message,
                            data.response
                        );
                        table = $('#faqstable').DataTable();
                        table.ajax.reload();

                    },
                    error: function (data) {
                        console.log(data.responseJSON);
                        Swal.fire(

                            data.responseJSON.title,
                            data.responseJSON.message + "<br><small><b>" + data.responseJSON
                                .hint + "</b></small>",
                            data.responseJSON.response
                        )
                    },
                });
            }
        });
    }
}
//fenil


/*
|-------------------------------------|
| delete List Row                     |
|-------------------------------------|
*/
function deleteRow(deleteUrl) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.value && result.value == true) {

            $.ajax({
                url: deleteUrl,
                type: "DELETE",
                dataType: 'json',
                success: function (data) {

                    Swal.fire(
                        data.title,
                        data.message,
                        data.response
                    )

                    $('#faqstable').dataTable().fnDestroy();
                    getListData();
                        location.reload();
                },
                error: function (data) {

                    Swal.fire(
                        data.responseJSON.title,
                        data.responseJSON.message + "<br><small><b>" + data.responseJSON.hint + "</b></small>",
                        data.responseJSON.response
                    )
                },
            });
        }
    });
}


$('#master').on('click', function (e) {
    if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
    } else {
        $(".sub_chk").prop('checked', false);
    }
});

/*
|-------------------------------------|
| Delete multiple rows                |
|-------------------------------------|
*/
function massDelete(massDeleteUrl) {
    var id = [];

    $(".sub_chk:checked").each(function () {
        id.push($(this).attr('data-id'));
    });

    if (id.length <= 0) {
        Swal.fire(
            "Oops!",
            "Please check checkbox to delete",
            'error'
        )
    } else {
        Swal.fire({
            title: "Are you sure",
            text: "You want to delete all selected Option?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes Delete IT"
        }).then((result) => {
            if (result.value && result.value == true) {
                $.ajax({
                    url: massDeleteUrl,
                    method: "post",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        Swal.fire(
                            data.title,
                            data.message,
                            data.response
                        )
                        dataTable.destroy();
                        getListData();
                        $('#master').prop('checked', false);
                    },
                    error: function (data) {
                        console.log(data.responseJSON.title);
                        Swal.fire(
                            data.responseJSON.title,
                            data.responseJSON.message + "<br><small><b>" + data.responseJSON
                                .hint + "</b></small>",
                            data.responseJSON.response
                        )
                    }
                });
            }
        })
    }
}
