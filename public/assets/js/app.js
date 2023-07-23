// import './datatables'
// import { csrf_token, deleteData, handleSuccess, handleError } from './helper';

$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': csrf_token }
    });

alert('ddd')
    const selectAll = document.getElementById('selectAll')
    if (selectAll) {
        selectAll.addEventListener('click', (e) => {
            const checkboxes = document.querySelectorAll('input.permission-checkbox');
            checkboxes.forEach(element => element.checked = e.target.checked ? true: false);
        })
    }


    // Add/Edit/Show modal show
    $(document).on('click', '#addBtn, #editBtn, #showBtn', function(e) {
        e.preventDefault();
        sendGetRequest($(this).attr('href'), $(this))
    });

    /* Send a GET request in the server */
    function sendGetRequest(url, btn) {
        $('#modal').remove();
        $.ajax({
            type: "GET",
            url: url,
            dataType: "HTML",
            beforeSend: function () {
                $(btn).addClass("disabled");
            },
            success: function (response) {
                $('body').append(response);
                $("#modal").modal("show");
            },
            complete: function () {
                $(btn).removeClass("disabled");
            },
            error: function (e) {
                handleError(e)
            }
        });
    }

    /* Submit post request in server without file upload */
    $(document).on('submit', 'form#submit', function (e) {
        e.preventDefault();
        const url      = $(this).attr('action');
        const file     = $(this).attr('enctype');
        const redirect = $(this).data('redirect');
        const btn      = $(this).find('button[type="submit"]')[0];
        const spinner  = $(this).find('span#submit-spinner')[0];
        const btnText  = $(this).find('span#btn--text')[0];

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        const options = {
            type: 'POST',
            url: url,
            dataType: 'JSON'
        }

        if (typeof file === 'undefined') {
            options.data = $(this).serialize();
        }
        else {
            options.data = new FormData($(this)[0]);
            options.contentType = false;
            options.enctype = file;
            options.processData = false;
        }

        $.ajax({
            ...options,
            beforeSend: () => {
                $(spinner).removeClass('d-none')
                $(btn).addClass('disabled')
                $(btnText).text('Please wait...')
            },
            success: (response) => handleSuccess(response, redirect),
            complete: () => {
                $(spinner).addClass('d-none')
                $(btn).removeClass('disabled')
                $(btnText).text($(btn).data('text'))
            },
            error: (e) => handleError(e, redirect)
        });

    });

    // Delete Data
    $(document).on('click', '#deleteBtn', function (e) {
        e.preventDefault();
        deleteData($(this), $(this).attr('href'));
    });

});




// $(document).ready(function(){

//     jQuery('#submit').submit(function(e){
//         e.preventDefault();
//         const url = $(this).attr('action');
//         jQuery.ajax({
//             url: url,
//             data:jQuery('#submit').serialize(),
//             type:'post',
//             success:function(result){
//                 Command: toastr["success"]("Customer added successfull!")

//                 toastr.options = {
//                   "closeButton": true,
//                   "debug": false,
//                   "newestOnTop": false,
//                   "progressBar": true,
//                   "positionClass": "toast-top-right",
//                   "preventDuplicates": false,
//                   "onclick": null,
//                   "showDuration": "300",
//                   "hideDuration": "1000",
//                   "timeOut": "5000",
//                   "extendedTimeOut": "1000",
//                   "showEasing": "swing",
//                   "hideEasing": "linear",
//                   "showMethod": "fadeIn",
//                   "hideMethod": "fadeOut"
//                 }
//                 location.reload()
//                 // toastr.success("User added");
//             },error:function(err){
//                 Command: toastr["success"]("Customer added failled!")

//                 toastr.options = {
//                   "closeButton": true,
//                   "debug": false,
//                   "newestOnTop": false,
//                   "progressBar": true,
//                   "positionClass": "toast-top-right",
//                   "preventDuplicates": false,
//                   "onclick": null,
//                   "showDuration": "300",
//                   "hideDuration": "1000",
//                   "timeOut": "5000",
//                   "extendedTimeOut": "1000",
//                   "showEasing": "swing",
//                   "hideEasing": "linear",
//                   "showMethod": "fadeIn",
//                   "hideMethod": "fadeOut"
//                 }
//             }

//         });

//     });

//     });

