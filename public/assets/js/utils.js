$(document).ready(() => {
    detailFieldScheduleData();
    duePayment();

    setInterval(detailPaymentData, 60000);
    setInterval(duePayment, 60000);
});

function formatRupiah(angka) {
    var numberPart = parseInt(angka.replace(/\D/g, ''), 10);

    if (numberPart === 0 || isNaN(numberPart)) {
        return '';
    }

    var numberString = angka.toString();
    var splitNumber = numberString.split(',');
    var formattedNumber = new Intl.NumberFormat('id-ID').format(numberPart);

    if (splitNumber.length > 1) {
        formattedNumber += ',' + splitNumber[1];
    }

    return 'Rp ' + formattedNumber;
}

$('').on('input', function() {
    var inputValue = $(this).val();
    var formattedValue = formatRupiah(inputValue);

    $(this).val(formattedValue);
});

$(document).on("click", "#button-gor-status", function () {
    let status = $(this).attr("data-status");
    let name = $(this).attr("data-gor");
    let slug = $(this).attr("data-slug");
    let title = status == 'active' ? 'Nonaktifkan' : 'Aktifkan';

    Swal.fire({
        title: 'Apakah Kamu Yakin ?',
        text: name + " akan di-" + title + "!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: title + '!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
            $('#form-gor-status-'+slug).submit();
        }
      })
});

$(document).on("click", "#button-gor-delete", function (event) {
    event.preventDefault();

    let name = $(this).attr("data-gor");
    let slug = $(this).attr("data-slug");

    Swal.fire({
        title: 'Apakah Kamu Yakin ?',
        text: "Semua lapangan dari "+ name + " akan di-hapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
            $('#form-gor-delete-'+slug).submit();
        }
      })
});

$(document).on("click", "#button-field-status", function () {
    let status = $(this).attr("data-status");
    let name = $(this).attr("data-field");
    let slug = $(this).attr("data-slug");
    let title = status == 'active' ? 'Nonaktifkan' : 'Aktifkan';

    Swal.fire({
        title: 'Apakah Kamu Yakin ?',
        text: name + " akan di-" + title + "!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: title + '!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
            $('#form-field-status-'+slug).submit();
        }
      })
});

$(document).on("click", "#button-field-delete", function (event) {
    event.preventDefault();

    let name = $(this).attr("data-field");
    let slug = $(this).attr("data-slug");

    Swal.fire({
        title: 'Apakah Kamu Yakin ?',
        text: "Semua data penjualan, penyewa dan lain lain dari "+ name + " akan di-hapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
            $('#form-field-delete-'+slug).submit();
        }
      })
});

const fieldScheduleData = (url, targetSelector, search) => {
    return $.get(url, { search: search || 'default' })
        .done(data => {
            $(targetSelector).html(data);
        })
        .fail((jqXHR, textStatus, errorThrown) => {
            return;
        });
};

const detailFieldScheduleData = (search) => {
    fieldScheduleData("/ajax/all-field-schedule/"+$('#field-counter').attr('data-slug')+"/read", '#data-field-schedule');
    fieldScheduleData("/ajax/all-temp-date/"+$('#field-counter').attr('data-slug')+"/read", '#data-temp-date');
};

$(document).on('click', '#button-field-schedule', function (){
    let date = $(this).attr('data-date');

    fieldScheduleData("/ajax/all-field-schedule/"+$('#field-counter').attr('data-slug')+"/read", '#data-field-schedule', date);
});

$(document).on('click', '#button-schedule-value-id', function () {
    let schedule_id = $(this).attr('data-id');
    let schedule_date = $(this).attr('data-date');
    let schedule_name = $(this).attr('data-day-name');
    let field = $('#field-counter').attr('data-slug');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.post("/ajax/all-temp-date/"+field+"/store", {
        _method: "get",
        data: {schedule_id, schedule_date, schedule_name}
    })
    .done(response => {
        detailFieldScheduleData();
    })
    .fail(errors => {
        return;
    });
});

$(document).on('click', '#button-delete-temp-date', function () {
    let temp_date_id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.post("/ajax/all-temp-date/"+temp_date_id+"/delete", {
        _method: "get"
    })
    .done(response => {
        detailFieldScheduleData();
    })
    .fail(errors => {
        return;
    });
});


$(document).on('click', '#button-cancel-booking-field', function (e) {
    let field_id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.post("/ajax/all-temp-date/"+field_id+"/delete-all", {
        _method: "get"
    })
    .done(response => {
        detailFieldScheduleData();
    })
    .fail(errors => {
        return;
    });
});

const paymentData = (url, targetSelector) => {
    return $.get(url, {})
        .done(data => {
            $(targetSelector).html(data);
        })
        .fail((jqXHR, textStatus, errorThrown) => {
            return;
        });
};

const detailPaymentData = () => {
    paymentData("/ajax/due-date-payment/"+$('#caption-due-date-payment').attr('data-id')+"/read", '#caption-due-date-payment');
};

function duePayment() {
    let field_id = $('#caption-due-date-payment').attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.post("/ajax/due-date-payment/"+field_id+"/destroy", {
        _method: "get"
    })
    .done(response => {
        if (response) {
            console.log("tempek");

            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Waktu anda telah habis!',
                showConfirmButton: false,
                timer: 2500
            })

            setTimeout(function() {
                window.location.href = "/";
            }, 3000);
        } else {
        }
    })
    .fail(errors => {
        return;
    });
}

$(document).on('click', '#button-form-renter-edit', function () {
    let slug = $(this).attr('data-slug');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.post("/ajax/data-renter-form/"+slug+"/read", {
        _method: "get"
    })
    .done(response => {
        $("#data-form-renter-edit").html(response);
    })
    .fail(errors => {
        return;
    });
});

$(document).on('click', '#button-form-owner-edit', function () {
    let slug = $(this).attr('data-slug');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.post("/ajax/data-owner-form/"+slug+"/read", {
        _method: "get"
    })
    .done(response => {
        $("#data-form-owner-edit").html(response);
    })
    .fail(errors => {
        return;
    });
});