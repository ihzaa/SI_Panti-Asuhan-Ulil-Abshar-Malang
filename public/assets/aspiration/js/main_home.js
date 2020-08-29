
// Update Text Input if change slider
function updateInputTextDonasi(val) {
  rupiah.value = formatRupiah(val, 'Rp. ');
}

var rupiah = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function (e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  var str = this.value;
  var max = 1000000000;
  var res = str.replace(/\D/g, "");
  // console.log(res);
  if (res >= max) {
    rupiah.value = formatRupiah('1000000000', 'Rp. ');
    // Update Slider Value From Input Standar
    $('#donasi').data('ionRangeSlider').update({
      from: max
    });
  } else {
    rupiah.value = formatRupiah(this.value, 'Rp. ');
    // Update Slider Value From Input Standar
    $('#donasi').data('ionRangeSlider').update({
      from: res
    });
  }
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}


$(function () {
  bsCustomFileInput.init();
  /* BOOTSTRAP SLIDER */
  $('.slider').bootstrapSlider()

  /* ION SLIDER */
  $('#donasi').ionRangeSlider({
    min: 0,
    max: 1000000000,
    from: 0,
    to: 4000,
    // type: 'double',
    step: 500,
    prefix: 'Rp. ',
    prettify: false,
    hasGrid: true
  })
});

$("select#bank").on("change", function () {    //when selected value changed
  let value = JSON.parse($(this).val())['no_rekening'];
  $("#copy-rek").val(value);
  // $("input[type=text]").val($(this).val());  //change value in textbox
})

function copyToClipboard(id) {
  document.getElementById(id).select();
  document.execCommand('copy');
}

$(function () {
  // $('#donasiToggle').click(function () {
  //   $('#donasiModal').modal({
  //     backdrop: 'static'
  //   });
  // });

  $("#donasi_form").submit(function (e) {
    e.preventDefault();
  });

  var validator_donasi_form = $('#donasi_form');
  validator_donasi_form.validate({
    rules: {
      email: {
        // required: true,
        email: true,
      },
      name: {
        required: true,
      },
      nama_alias: {
        required: true
      },
      donasi: {
        required: true,
        min: 100000,
      },
      bank: {
        required: true,
      }
    },
    messages: {
      email: {
        // required: "Mohon masukkan alamat surel",
        email: "Mohon masukkan alamat surel valid"
      },
      name: {
        required: "Mohon Masukan Nama",
      },
      nama_alias: "Beri tanda '-' untuk mengosongkan",
      donasi: {
        required: "Mohon Tentukan Donasi",
        min: "Minimal donasi Rp. 100.000"
      },
      bank: {
        required: "Mohon Masukan Bank Tujuan",
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('#submit-donasi').hide();
  $('#donasi-continue').click(function (e) {
    if (validator_donasi_form.valid()) {
      // e.preventDefault();
      $('.progress-bar').css('width', '100%');
      $('.progress-bar').html('Step 2 of 2');
      $('.link-donasi').removeClass('disabled');
      $('#donasi-continue').hide();
      $('#submit-donasi').show();
      $('#myTab a[href="#info-donasi"]').tab('show');
    }
  });

  $('.link-bio').click(function (e) {
    $('#donasi-continue').show();
    $('#submit-donasi').hide();
  })

  $('.link-donasi').click(function (e) {
    if (!validator_donasi_form.valid()) {
      $('.link-donasi').addClass('disabled');
      $('#myTab a[href="#biodata"]').tab('show');
    } else {
      $('#donasi-continue').hide();
      $('#submit-donasi').show();
    }
  });

  $('#submit-donasi').click(function (e) {
    if (validator_donasi_form.valid()) {
      console.log('submit');

      var action_url = 'donasi';

      var form_data = new FormData($('#donasi_form')[0]);
      $('#donasiModal').modal('hide');
      $('#ftco-loader').addClass('show');

      $.ajax({
        url: action_url,
        type: "POST",
        data: form_data,
        contentType: false,
        processData: false,
        success: function (response) {
          $('#myTab a[href="#biodata"]').tab('show');
          $('#donasi-continue').show();
          $('#submit-donasi').hide();

          $('#donasi_form')[0].reset();
          $('#donasi').data('ionRangeSlider').reset();

          $('#ftco-loader').removeClass('show');

          Swal.fire(
            'Berhasil!',
            'Donasi anda akan kami periksa terlebih dahulu.',
            'success'
          );
        },
        error: function (response) {
          $('#donasiModal').modal('show');
          // console.log(response.responseJSON.errors)
        }
      });
    }
  });
});