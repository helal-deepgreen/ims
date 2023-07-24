
// import { csrf_token, deleteData, handleSuccess, handleError } from './helper';


$(document).ready(function(){

    jQuery('#submit').submit(function(e){
        e.preventDefault();
       const x = jQuery('#submit').serialize()
        console.log(x)
        const url = $(this).attr('action');
        jQuery.ajax({
            url: url,
            data:jQuery('#submit').serialize(),
            type:'post',
            success:function(result){
                Command: toastr["success"]("Customer added success")

                toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": true,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                $('#modal').modal('hide');
                // $('#submit')[0].reset();
                // $('.table').load(location.href+' .table');
                // toastr.success("User added");
            },error:function(err){
                Command: toastr["error"]("Customer added fail, Error 422")

                toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": true,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
            }

        });

    });

    });

