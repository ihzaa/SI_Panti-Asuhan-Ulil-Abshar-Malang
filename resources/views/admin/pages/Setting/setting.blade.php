@extends('admin.template.all')

@section('judul_halaman','Pengaturan')
@section('CssTambahanBefore')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('breadcrumb')
<li class="breadcrumb-item active">Pengaturan</li>
@endsection

@section('konten')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Rekening Bank</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form id="form_bank">
                    @csrf
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <div class="form-group">
                        <label for="nama_bank">Nama Bank</label>
                        <input type="text" id="nama_bank" name="nama_bank" class="form-control"
                            placeholder="Masukkan Nama Bank">
                    </div>
                    <div class="form-group">
                        <label for="no_rekening">No Rekening</label>
                        <input type="number" min="1" id="no_rekening" name="no_rekening" class="form-control"
                            placeholder="Masukkan No Rekening">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{-- <a href="#" class="btn btn-secondary">Cancel</a> --}}
                            <button type="submit" id='action_button' class="btn btn-primary float-right">Submit</button>
                        </div>
                    </div>
                </form>


                <table id="tabel_bank" class="table table-striped projects" style="margin-top: 1rem">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th>
                                Nama Bank
                            </th>
                            <th>
                                No Rekening
                            </th>
                            <th style="width: 20%">Aksi</th>
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
    <div class="col-md-6">
        <div class="card card-secondary" id="card_no_wa">
            <div class="card-header">
                <h3 class="card-title">Nomer Telfon Admin</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <label for="no_telp">Nomer Telfon Whatsapp <small>Diawali dengan +62</small></label>
                <div class="input-group mb-4">
                    <input type="text" id="telp" class="form-control">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-info" id="btn_telp">Simpan</button>
                    </span>
                </div>
                <label for="key">Api Key <small>api key yang didapat setelah mengirimkan pesan</small></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="key">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-info" id="btn_key">Simpan</button>
                    </span>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="overlay dark" id="wa_load">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        </div>
        <!-- /.card -->
    </div>
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

<script>
    $(document).ready(function () {
        fetch("{{route('admin_setting_get_data')}}", {
                method: 'GET', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                },
                })
                .then(response => response.json())
                .then(data => {
                    $('#telp').val(data.no_telp);
                    $('#key').val(data.key);
                    $('#wa_load').remove();
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

        $('#btn_telp').on('click',function(){
            let val = $('#telp').val();
            if(val != ""){
                const regex = /^\+62\d+/;
                if( !regex.test(val) ){
                    Swal.fire(
                    'Maaf!',
                    'Nomer telfon harus diawali dengan +62 dan harus angka',
                    'error'
                    );
                    return;
                }
                $('#card_no_wa').append(`<div class="overlay dark" id="wa_load">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>`);
                let data = { telp: val };
                fetch("{{route('admin_setting_nomer_wa')}}", {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire(
                    'Berhasil!',
                    'Nomer whatsapp telah berhasil di simpan, kirim pesan "<strong>I allow callmebot to send me messages</strong>" ke nomer <strong>+34644565518</strong> melalui whatsapp. Lalu masukkan API KEY yang didapatkan dikolom API KEY di bawah!',
                    'success'
                    );
                    $('#wa_load').remove();
                })
                .catch((error) => {
                console.error('Error:', error);
                });
            }else{
                Swal.fire(
                'Maaf!',
                'Kolom nomer telfon whatsapp tidak boleh kosong',
                'error'
                );
            }
        });

        $('#btn_key').on('click',function(){
            let val = $('#key').val();
            if(val != ""){
                $('#card_no_wa').append(`<div class="overlay dark" id="wa_load">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>`);
                let data = { key: val };
                fetch("{{route('admin_setting_api_key')}}", {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire(
                    'Berhasil!',
                    'Api key berhasil di atur, <strong>jika api key benar</strong> anda akan mendapat pesan whatsapp dari <strong>+34644565518</strong> !',
                    'success'
                    );
                    $('#wa_load').remove();
                })
                .catch((error) => {
                console.error('Error:', error);
                });
            }else{
                Swal.fire(
                'Maaf!',
                'Kolom Api Key tidak boleh kosong',
                'error'
                );
            }
        });

    $('#tabel_bank').DataTable({
      paging:   false,
      ordering: false,
      info:     false,
      searching: false,
      processing: true,
      serverSide: true,
      ajax: {
        url: "{{ route('admin_setting') }}",
      },
      columns: [
        {
          data: 'id',
          name: 'id'
        },
        {
          data: 'nama_bank',
          name: 'nama_bank'
        },
        {
          data: 'no_rekening',
          name: 'no_rekening'
        },

        {
          data: 'action',
          name: 'action',
          orderable: false
        }
      ]
    });

    bsCustomFileInput.init();

    $("#form_bank").submit(function(e) {
      e.preventDefault();
    });

    $.validator.setDefaults({
      submitHandler: function () {
        var action_url = 'setting/add_bank';

        if($('#action').val() == 'Add')
        {
          action_url = 'setting/add_bank';;
        }

        if($('#action').val() == 'Edit')
        {
          action_url = 'setting/update_bank';;
        }

        var form_data = new FormData($('#form_bank')[0]);

        $.ajax({
          url: action_url,
          type:"POST",
          data: form_data,
          contentType: false,
          processData: false,
          success:function(response)
          {
            $('#tabel_bank').DataTable().ajax.reload();
            // $('#modal-default').modal('hide');
            $('#form_bank')[0].reset();
            if($('#action').val() == 'Add')
            {
              Swal.fire(
              'Berhasil!',
              'Tambah berhasil.',
              'success'
            );
            }

            if($('#action').val() == 'Edit')
            {
              $('#action_button').text('Submit');
              $('#action').val('Add');
              Swal.fire(
              'Berhasil!',
              'Update berhasil.',
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

    var validator = $('#form_bank').validate({
      rules: {
        nama_bank: {
          required: true,
        },
        no_rekening: {
          required: true,
          min: 1
        },
      },
      messages: {
        nama_bank: {
          required: "Mohon Masukan Nama Bank",
        },
        no_rekening: {
          required: "Mohon Masukan No Rekening",
          min: "Mohon masukkan dengan benar",
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



    $(document).on('click', '.btnEdit', function(){
      var id = $(this).data('id');
      $.ajax({
        url :"setting/edit_bank/"+id,
        dataType:"json",
        success:function(data)
        {
          $('#nama_bank').val(data.result.nama_bank);
          $('#no_rekening').val(data.result.no_rekening);
          $('#hidden_id').val(id);
          $('#action_button').text('Update');
          $('#action').val('Edit');
        }
      })
    });

    // Delete Anak
    $("body").on('click', '.btnDelete', function(){
        Swal.fire({
            title: 'Yakin menghapus bank ini?',
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
                var url = 'setting/delete_bank/'+id;
                fetch(url)
                .then(() =>{
                  $('#tabel_bank').DataTable().ajax.reload();
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
