@extends('admin.template.all')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('judul_halaman','Daftar Anak Asuh')

@section('breadcrumb')
<li class="breadcrumb-item active">Pages</li>
<li class="breadcrumb-item active">Profil Anak</li>
@endsection

@section('konten')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
  <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Anak Asuh</h3>

          <div class="card-tools">
            {{-- <a class="btn btn-primary btn-sm ml-auto" href="{{route('admin_tampil_halaman_tambah_blog')}}"><i
              class="fas fa-plus"></i> Tambah Postingan</a> --}}
            <button type="button" class="btn btn-add btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#modal-add">
              Tambah Anak Asuh
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <table id="tabel_anak" class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width:15%">
                          Nama
                      </th>
                      <th style="width: 10%">
                          Foto
                      </th>
                      <th style="width:15%">
                        Alamat
                      </th>
                      <th style="width: 10%">
                          Umur
                      </th>
                      <th style="width: 9%" class="text-center">
                          Jenis Kelamin
                      </th>
                      <th style="width: 20%" class="text-center">Sekolah / Kelas</th>
                      <th style="width: 10%">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    <!-- /.card -->
    </div>
  <!-- /.col -->
  </div>
<!-- /.row -->
</div>

{{-- Modal Tambah Anak --}}
<div class="modal fade" id="modal-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Anak</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="form_tambah_anak">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan nama">
          </div>
          <div class="form-group">
            <label for="alamat_asal">Alamat Asal</label>
            <input type="text" name="alamat_asal" class="form-control" id="alamat_asal" placeholder="Masukan Alamat">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Foto</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="foto" class="custom-file-input" id="foto">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Umur</label>
            <input type="number" name="umur" min="1" max="150" class="form-control" id="umur" placeholder="Umur">
          </div>
          
          <div class="form-group">
            <label for="exampleInputPassword1">Jenis Kelamin</label>
            <div class="form-check">
              <input id='radio_check_laki' value="1" class="form-check-input" type="radio" name="jenKel">
              <label for='radio_check_laki' class="form-check-label">Laki - Laki</label>
            </div>
            <div class="form-check">
              <input id='radio_check_perempuan' value="0" class="form-check-input" type="radio" name="jenKel">
              <label for='radio_check_perempuan' class="form-check-label">Perempuan</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword1">Sekolah</label>
                <input type="text" name="sekolah" class="form-control" id="sekolah" placeholder="Sekolah">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword1">Kelas</label>
                <input type="number" min="1" max="12" name="kelas" class="form-control" id="kelas" placeholder="Kelas">
              </div>
            </div>
          </div>
          
        
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" id='reset_modal' data-dismiss="modal">Close</button>
          <button type="submit" id='add_button' class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

{{-- Modal Edit Anak --}}
<div class="modal fade" id="modal-update">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah Data Anak</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="form_update_anak">
          @csrf
          <input type="hidden" name="hidden_id" id="hidden_id" />
          <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama_edit" placeholder="Masukan nama">
          </div>
          <div class="form-group">
            <label for="alamat_asal">Alamat Asal</label>
            <input type="text" name="alamat_asal" class="form-control" id="alamat_asal_edit" placeholder="Masukan Alamat">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Foto</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="foto" class="custom-file-input" id="foto_edit">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Umur</label>
            <input type="number" name="umur" min="1" max="150" class="form-control" id="umur_edit" placeholder="Umur">
          </div>
          
          <div class="form-group">
            <label for="exampleInputPassword1">Jenis Kelamin</label>
            <div class="form-check">
              <input id='radio_check_laki_edit' value="1" class="form-check-input" type="radio" name="jenKel_edit">
              <label for='radio_check_laki_edit' class="form-check-label">Laki - Laki</label>
            </div>
            <div class="form-check">
              <input id='radio_check_perempuan_edit' value="0" class="form-check-input" type="radio" name="jenKel_edit">
              <label for='radio_check_perempuan_edit' class="form-check-label">Perempuan</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword1">Sekolah</label>
                <input type="text" name="sekolah" class="form-control" id="sekolah_edit" placeholder="Sekolah">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword1">Kelas</label>
                <input type="number" min="1" max="12" name="kelas" class="form-control" id="kelas_edit" placeholder="Kelas">
              </div>
            </div>
          </div>
          
        
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" id='reset_modal' data-dismiss="modal">Close</button>
          <button type="submit" id='update_button' class="btn btn-primary">Update</button>
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
<script src="{{asset('admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>


<script type="text/javascript">
$(document).ready(function () {
  $('#tabel_anak').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('admin_profil_anak') }}",
    },
    columns: [
      {
        data: 'id',
        name: 'id'
      },
      {
        data: 'nama',
        name: 'nama'
      },
      {
        data: 'image',
        name: 'image'
      },
      {
        data: 'alamat_asal',
        name: 'alamat_asal'
      },
      {
        data: 'umur',
        name: 'umur'
      },
      {
        data: 'jenis_kelamin',
        name: 'jenis_kelamin',
      },
      {
        data: 'sekolah',
        name: 'sekolah',
      },
      {
        data: 'action',
        name: 'action',
        orderable: false
      }
    ]
  });
  
  bsCustomFileInput.init();

  $("#form_tambah_anak").submit(function(e) {
    e.preventDefault();
  });

  $("#form_update_anak").submit(function(e) {
    e.preventDefault();
  });

  $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
  }, 'File size must be less than {0}');

  var form_tambah_anak = $('#form_tambah_anak');
  form_tambah_anak.validate({
    rules: {
      nama: {
        required: true,
      },
      alamat_asal: {
        required: true
      },
      foto: {
        required: true,
        accept:"image/*",
        filesize: 256000,
      },
      umur: {
        required: true,
      },
      jenKel: {
        required: true
      },
      sekolah: {
        required: true
      },
      kelas: {
        required: true,
        min: 1,
        max: 12
      },
    },
    messages: {
      nama: {
        required: "Mohon Masukan Nama",
      },
      alamat_asal: {
        required: "Mohon masukkan alamat asal",
      },
      foto: {
        required: "Mohon Upload Foto",
        filesize: "Ukuran file tidak boleh lebih 256kb",
        accept: "Mohon masukkan file berupa gambar"
      },
      umur: {
        required: "Mohon Masukan Umur",
      },
      terms: "Mohon Pilih Jenis Kelamin",
      sekolah: "Mohon Masukan Sekolah",
      kelas: {
        required: "Mohon Masukan Kelas",
        min: "Minimal masukan 1",
        max: "Maximal masukan 12"
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

  var form_update_anak = $('#form_update_anak');
  form_update_anak.validate({
    rules: {
      nama: {
        required: true,
      },
      alamat_asal: {
        required: true
      },
      foto: {
        accept:"image/*",
        filesize: 256000,
      },
      umur: {
        required: true,
      },
      jenKel: {
        required: true
      },
      sekolah: {
        required: true
      },
      kelas: {
        required: true,
        min: 1,
        max: 12
      },
    },
    messages: {
      nama: {
        required: "Mohon Masukan Nama",
      },
      alamat_asal: {
        required: "Mohon masukkan alamat asal",
      },
      foto: {
        filesize: "Ukuran file tidak boleh lebih 256kb",
        accept: "Mohon masukkan file berupa gambar"
      },
      umur: {
        required: "Mohon Masukan Umur",
      },
      terms: "Mohon Pilih Jenis Kelamin",
      sekolah: "Mohon Masukan Sekolah",
      kelas: {
        required: "Mohon Masukan Kelas",
        min: "Minimal masukan 1",
        max: "Maximal masukan 12"
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

  $('#add_button').click(function (e) {
    if (form_tambah_anak.valid()) {

      var action_url = 'profil_anak/create';

      var form_data = new FormData($('#form_tambah_anak')[0]);
      // $('#donasiModal').modal('hide');
      // $('#ftco-loader').addClass('show');

      $.ajax({
        url: action_url,
        type: "POST",
        data: form_data,
        contentType: false,
        processData: false,
        success: function (response) {
          $('#tabel_anak').DataTable().ajax.reload();
          $('#modal-add').modal('hide');
          $('#form_tambah_anak')[0].reset();

          Swal.fire(
            'Berhasil!',
            'Jumlah anak asuh bertambah.',
            'success'
          );
        },
        error: function (response) {
          // $('#donasiModal').modal('show');
          // console.log(response.responseJSON.errors)
        }
      });
    }
  });

  $('#update_button').click(function (e) {
    if (form_update_anak.valid()) {

      var action_url = 'profil_anak/update';

      var form_data = new FormData($('#form_update_anak')[0]);
      // $('#donasiModal').modal('hide');
      // $('#ftco-loader').addClass('show');

      $.ajax({
        url: action_url,
        type: "POST",
        data: form_data,
        contentType: false,
        processData: false,
        success: function (response) {
          $('#tabel_anak').DataTable().ajax.reload();
          $('#modal-update').modal('hide');
          $('#form_update_anak')[0].reset();
          
          Swal.fire(
            'Berhasil!',
            'Update data anak selesai.',
            'success'
          );
        },
        error: function (response) {
          // $('#donasiModal').modal('show');
          // console.log(response.responseJSON.errors)
        }
      });
    }
  });

  $(document).on('click', '.btnEdit', function(){
    var id = $(this).data('id');
    $.ajax({
      url :"profil_anak/edit/"+id,
      dataType:"json",
      success:function(data)
      {
        $('#nama_edit').val(data.result.nama);
        $('#alamat_asal_edit').val(data.result.alamat_asal);
        $('#umur_edit').val(data.result.umur);
        $("input[name=jenKel_edit][value=" + data.result.jenis_kelamin + "]").prop('checked', true);
        // $("div.id_100 select").val("val2");
        $('#sekolah_edit').val(data.result.sekolah);
        $('#kelas_edit').val(data.result.kelas);
        $('#hidden_id').val(id);
        // $('.modal-title').text('Ubah Data Anak');
        // $('#action_button').text('Update');
        // $('#action').val('Edit');
        $('#modal-update').modal('show');
      }
    })
  });

  // Delete Anak
  $("body").on('click', '.btnDelete', function(){
      Swal.fire({
          title: 'Yakin menghapus anak ini?',
          text: "Item yang dihapus tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.value) {
              var id = $(this).data('id');
              var url = 'profil_anak/delete/'+id;
              fetch(url)
              .then(() =>{
                $('#tabel_anak').DataTable().ajax.reload();
                  Swal.fire(
                      'Terhapus!',
                      'Data telah terhapus.',
                      'success'
                  );
              })
              .catch(err => {console.log(err);});
          }
      });
  });
});
</script>
@endsection