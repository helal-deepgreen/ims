export const csrf_token = document.querySelector('meta[name="csrf-token"').getAttribute('content');


export const showUploadedFile = (avatar) => {
    const default_image = document.querySelector('input[name="default_image"]').value;
    return `${location.origin}/storage/${avatar !== null ? avatar : default_image || null}`;
}

export const convertAmount = (number, decimals = 2, dec_point = '.', thousands_sep = ',') => {

    var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    toFixedFix = function (n, prec) {
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        var k = Math.pow(10, prec);
        return Math.round(n * k) / k;
    },
    s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }

    const currency_symbol = document.querySelector('input[name="currency_symbol"]').value;

    return `${currency_symbol}${s.join(dec)}`;
}

export const datatableButtons = (items = []) => {
    const icons = {
        edit: 'fas fa-edit',
        show: 'fas fa-eye',
        delete: 'fas fa-trash-alt',
        approved: 'fas fa-check'
    }
    const btnClass = {
        edit: 'btn-info',
        show: 'btn-success',
        delete: 'btn-danger',
        approved: 'btn-info'
    }

    let buttons = '<div class="btn-group">';
    items.forEach(item => {
        if (permissions.includes(item.permission)) {
            const id = item.id ? `id="${item.type}Btn"`:''
            buttons += `<a href="${item.url}" ${id} class="btn btn-sm btn-icon ${btnClass[item.type]}">
                <i class='${icons[item.type]}'></i>
            </a>`
        }
    });
    buttons += '</div>';
    return buttons;
}

export const datatableStatus = (type, text) => {
    return `<span class="badge bg-${type}">${text}</span>`;
}

export const datatableImg = (file) => {
    return `<img src="${showUploadedFile(file)}" alt="Avatar" class="img-fluid" width="70px">`;
}


/* Send delete request in server */
export const deleteData = (btn, url, removeElement = null) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    _method: 'DELETE',
                    _token: csrf_token
                },
                dataType: 'JSON',
                beforeSend: () => $(btn).addClass("disabled"),
                success: function (response) {
                    handleSuccess(response);
                    if(removeElement != null) {
                        $(removeElement).remove();
                    }
                    // swal("Deleted!", "Your file has been deleted.", "success");
                },
                complete: () => $(btn).removeClass("disabled"),
                error: function (e) {
                    handleError(e);
                },
            });
            return true;
        }
        else return false;
    });
};


/* Handle success request response */
export const handleSuccess = (response, redirect = null) => {
    toastr.clear();
    if (typeof response.message !== 'undefined' || typeof response.status !== 'undefined') {
        toastr.success(response.message || response.status, "Success!");
    }
    if (typeof response.redirect !== 'undefined' || redirect !== null) {
        location.replace(redirect || response.redirect);
    }
    else {
        $('.modal').modal('hide');
        if(typeof table !== 'undefined') {
            table.ajax.reload();
        }
    }
}

/* Handle error request response */
export const handleError = (e, redirect = null) => {
    if (e.status === 0) {
        toastr.error(
            "Not connected Please verify your network connection.",
            "Connect Internet"
        );
    }
    else if (e.status === 200 && typeof redirect !== 'undefined') {
        location.replace(redirect);
    }
    else if (e.status === 404) {
        toastr.error("The requested data not found.", "Not Found");
    }
    else if (e.status === 403) {
        toastr.error("You are not allowed this action", "UNAUTHORIZED");
    }
    else if (e.status === 419) {
        toastr.error("CSRF token mismatch", "Something wrong");
    }
    else if (e.status === 500) {
        toastr.error("Internal Server Error.", "Server Error");
    }
    else if (e === "parsererror") {
        toastr.error("Requested JSON parse failed.", "Opps!!");
    }
    else if (e === "timeout") {
        toastr.error("Requested Time out.", "Try Again");
    }
    else if (e === "abort") {
        toastr.error("Request aborted.", "Something Wrong");
    }
    else if (e.status === 422) {
        $.each(e.responseJSON.errors, function (index, error) {
            $("#invalid_" + index).text(error[0]);
            $("#" + index).addClass("is-invalid");
        });
        toastr.error("Please fillup all required fieled", "Opps!!");
    }
    else if ([300, 301, 302, 401].includes(e.status)) {
        toastr.error(e.responseJSON.message, "Opps!!");
    }
    else {
        toastr.error(e.statusText, "Something Wrong");
    }
    return true;
}
