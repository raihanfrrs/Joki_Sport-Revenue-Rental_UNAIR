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