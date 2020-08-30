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
            <button type="button" class="btn btn-add btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#modal-default">
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
                      <th style="width: 10%">
                          Umur
                      </th>
                      <th style="width: 8%" class="text-center">
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
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Anak</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="form_profil_anak">
          @csrf
          <input type="hidden" name="action" id="action" value="Add" />
          <input type="hidden" name="hidden_id" id="hidden_id" />
          <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan nama">
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

  $("#form_profil_anak").submit(function(e) {
    e.preventDefault();
  });
  
  $.validator.setDefaults({
    submitHandler: function () {
      var action_url = 'profil_anak/create';

      if($('#action').val() == 'Add')
      {
        action_url = 'profil_anak/create';;
      }

      if($('#action').val() == 'Edit')
      {
        action_url = 'profil_anak/update';;
      }
      
      var form_data = new FormData($('#form_profil_anak')[0]);

      $.ajax({
        url: action_url,
        type:"POST",
        data: form_data,
        contentType: false,
        processData: false,
        success:function(response)
        {
          $('#tabel_anak').DataTable().ajax.reload();
          $('#modal-default').modal('hide');
          $('#form_profil_anak')[0].reset();
          if($('#action').val() == 'Add')
          {
            Swal.fire(
            'Berhasil!',
            'Jumlah anak asuh bertambah.',
            'success'
          );
          }

          if($('#action').val() == 'Edit')
          {
            Swal.fire(
            'Berhasil!',
            'Update data anak selesai.',
            'success'
          );
          }
          
        },
        error: function(response) {
          // console.log(response.responseJSON.errors)
        }
      });
    }
  });

  var validator = $('#form_profil_anak').validate({
    rules: {
      nama: {
        required: true,
      },
      foto: {
        required: true,
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
      foto: {
        required: "Mohon Upload Foto",
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

  $('#reset_modal').click(function() {
    validator.resetForm();
    $('#form_profil_anak')[0].reset();
  })
  
  $('.btn-add').click(function(){
    $('.modal-title').text('Tambah Anak');
    $('#action_button').text('Submit');
    $('#action').val('Add');

    validator.resetForm();
    $('#form_profil_anak')[0].reset();
    $('#modal-default').modal('show');
  });

  $(document).on('click', '.btnEdit', function(){
    var id = $(this).data('id');
    $.ajax({
      url :"profil_anak/edit/"+id,
      dataType:"json",
      success:function(data)
      {
        $('#nama').val(data.result.nama);
        $('#umur').val(data.result.umur);
        $("input[name=jenKel][value=" + data.result.jenis_kelamin + "]").prop('checked', true);
        $("div.id_100 select").val("val2");
        $('#sekolah').val(data.result.sekolah);
        $('#kelas').val(data.result.kelas);
        $('#hidden_id').val(id);
        $('.modal-title').text('Ubah Data Anak');
        $('#action_button').text('Update');
        $('#action').val('Edit');
        $('#modal-default').modal('show');
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

  // $('#form_profil_anak').on('submit', function(e) {
  //   e.preventDefault();
  //   console.log(this)
  // });
});
</script>
@endsection