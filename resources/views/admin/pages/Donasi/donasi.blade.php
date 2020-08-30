@extends('admin.template.all')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

<style>
  [aria-hidden="true"] {
    opacity: 0;
    position: absolute;
    z-index: -9999;
    pointer-events: none;
  }
</style>
@endsection

@section('judul_halaman','Donasi')

@section('breadcrumb')
<li class="breadcrumb-item active">Pages</li>
<li class="breadcrumb-item active">Donasi</li>
@endsection

@section('konten')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      {{-- Tabel Donasi non konfirmasi --}}
      @include('admin.pages.Donasi.Source.tabel_konfirmasi')

      {{-- Tabel Donasi Masuk --}}
      @include('admin.pages.Donasi.Source.tabel_masuk')
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Donasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" id="form_tambah_donasi">
            @csrf
            <div class="form-group">
              <label>Date</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" name="date_create" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control" id="email" placeholder="Masukan email">
            </div>
            <div class="form-group">
              <label for="nama_asli">Nama Asli</label>
              <input type="text" name="nama_asli" class="form-control" id="nama_asli" placeholder="Masukan nama asli">
            </div>
            <div class="form-group">
              <label for="nama_alias">Nama Samaran</label>
              <input type="text" name="nama_alias" class="form-control" id="nama_alias" placeholder="Masukan nama samaran">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukan alamat">
            </div>
            <div class="form-group">
              <label for="donasi">Donasi</label>
              <input aria-hidden="true" type="number" name="rupiah" class="form-control" id="rupiah" placeholder="Masukan jumlah donasi">
              <input type="text" name="donasi" class="form-control" id="donasi" placeholder="Masukan jumlah donasi">
            </div>
            <div class="form-group">
              <label for="bank">Bank</label>
              <select class="custom-select" name="bank" id="bank" required>
                <option value="" selected>Choose...</option>
                @foreach ($bank as $item)
                  <option value='{{ $item->nama_bank }}'>
                    {{$item->nama_bank}}
                  </option>
                @endforeach
              </select>
              {{-- <input type="text" name="bank" class="form-control" id="bank" placeholder="Masukan nama bank"> --}}
            </div>
            
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" id='reset_modal' data-dismiss="modal">Close</button>
            <button type="submit" id='action_button' class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@section('JsTambahanAfter')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

<script src="{{asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script>
$(document).ready(function () {


$('#tabel_donasi').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: "{{ route('admin_pages_donasi_index') }}",
  },
  columns: [
    {
      data: 'created_at',
      name: 'created_at'
    },
    {
      data: 'email',
      name: 'email'
    },
    {
      data: 'nama_donatur',
      name: 'nama_donatur'
    },
    {
      data: 'nama_alias',
      name: 'nama_alias'
    },
    {
      data: 'total_donasi',
      name: 'total_donasi'
    },
    {
      data: 'nama_bank',
      name: 'nama_bank'
    },
    {
      data: 'action',
      name: 'action',
      orderable: false
    }
  ]
});

$('#tabel_donasi_masuk').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: "{{ route('admin_pages_donasi_masuk') }}",
  },
  columns: [
    {
      data: 'created_at',
      name: 'created_at'
    },
    {
      data: 'email',
      name: 'email'
    },
    {
      data: 'nama_donatur',
      name: 'nama_donatur'
    },
    {
      data: 'nama_alias',
      name: 'nama_alias'
    },
    {
      data: 'total_donasi',
      name: 'total_donasi'
    },
    {
      data: 'nama_bank',
      name: 'nama_bank'
    },
    {
      data: 'action',
      name: 'action',
      orderable: false
    }
  ]
});
});

$("#form_tambah_donasi").submit(function(e) {
  e.preventDefault();
});

var validator_donasi_form = $('#form_tambah_donasi');
validator_donasi_form.validate({
  rules: {
    email: {
      required: true,
      email: true,
    },
    nama_asli: {
      required: true,
    },
    nama_alias: {
      required: true
    },
    donasi: {
      required: true,
      // min: 100000,
    },
    alamat: {
      required: true,
    }
  },
  messages: {
    email: {
      required: "Mohon masukkan alamat surel",
      email: "Mohon masukkan alamat surel valid"
    },
    nama_asli: {
      required: "Mohon Masukan Nama",
    },
    nama_alias: "Beri tanda '-' untuk mengosongkan",
    donasi: {
      required: "Mohon Tentukan Donasi",
      // min: "Minimal donasi Rp. 100.000"
    },
    alamat: {
      required: "Mohon Masukan Bank Tujuan",
    },
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

$('#action_button').click(function (e) {
  if (validator_donasi_form.valid()) {

    var action_url = 'donasi/add';

    var form_data = new FormData($('#form_tambah_donasi')[0]);
    $('#modal-default').modal('hide');
    
    $('.card_tabel').append(`
      <div class="overlay dark loading">
          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>`
    );

    $.ajax({
      url: action_url,
      type: "POST",
      data: form_data,
      contentType: false,
      processData: false,
      success: function (response) {
        
        $('#form_tambah_donasi')[0].reset();

        $('.loading').remove();

        $('#tabel_donasi_masuk').DataTable().ajax.reload();

        Swal.fire(
          'Berhasil!',
          'Donasi anda akan kami periksa terlebih dahulu.',
          'success'
        );
        console.log(response);
      },
      error: function (response) {
        $('#modal-default').modal('show');
        // console.log(response.responseJSON.errors)
      }
    });
  }
});

// Konfirmasi Donasi
$('body').on('click', '.confirmDonation', function () {
  Swal.fire({
    title: 'Yakin pengiriman dana sudah masuk?',
    text: "Periksa rekening, data ini akan berpindah ke tabel donasi masuk.",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Konfirmasi',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.value) {
      let id = $(this).data('id');
      let url = "{{route('admin_donasi_konfirmasi',':__id')}}";
      url = url.replace(':__id', id);
      $('.card_tabel').append(`
        <div class="overlay dark loading">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>`
      );
      fetch(url)
        .then(() => {
          $('#tabel_donasi').DataTable().ajax.reload();
          $('#tabel_donasi_masuk').DataTable().ajax.reload();
          $('.loading').remove();
          Swal.fire(
            'Success!',
            'Konfirmasi donasi telah dilakukan.',
            'success'
          );
        })
        .catch(err => { console.log(err); });
    }
  });
});

// Delete Donasi
$("body").on('click', '.deleteDonation', function () {
  Swal.fire({
    title: 'Yakin menghapus donasi ini?',
    text: "Item yang dihapus tidak dapat dikembalikan!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.value) {
      let id = $(this).data('id');
      let url = "{{route('admin_hapus_donasi',':__id')}}";
      url = url.replace(':__id', id);
      fetch(url)
        .then(() => {
          $('#tabel_donasi').DataTable().ajax.reload();
          $('#tabel_donasi_masuk').DataTable().ajax.reload();
          Swal.fire(
            'Terhapus!',
            'Data telah terhapus.',
            'success'
          );
        })
        .catch(err => { console.log(err); });
    }
  });
});

// Cancel Konfirmasi
$("body").on('click', '.cancelConfirm', function () {
  Swal.fire({
    title: 'Yakin ingin membatalkan konfirmasi?',
    text: "Item akan berpindah ke tabel konfirmasi donasi!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Batalkan Konfirmasi',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.value) {
      let id = $(this).data('id');
      let url = "{{route('admin_donasi_konfirmasi_cancel',':__id')}}";
      url = url.replace(':__id', id);
      fetch(url)
        .then(() => {
          $('#tabel_donasi').DataTable().ajax.reload();
          $('#tabel_donasi_masuk').DataTable().ajax.reload();
          Swal.fire(
            'Success!',
            'Pembatalan donasi berhasil.',
            'success'
          );
        })
        .catch(err => { console.log(err); });
    }
  });
});


var rupiah = document.getElementById('donasi');
var rupiahInt = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function (e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  var str = this.value;
  var max = 1000000000;
  var res = str.replace(/\D/g, "");
  // console.log(res);
  if (res >= max) {
    rupiah.value = formatRupiah('1000000000', 'Rp. ');
    rupiahInt.value = 1000000000

    // Update Slider Value From Input Standar
    // $('#donasi').data('ionRangeSlider').update({
    //   from: max
    // });
  } else {
    rupiah.value = formatRupiah(this.value, 'Rp. ');
    rupiahInt.value = res
    // Update Slider Value From Input Standar
    // $('#donasi').data('ionRangeSlider').update({
    //   from: res
    // });
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
</script>
@endsection