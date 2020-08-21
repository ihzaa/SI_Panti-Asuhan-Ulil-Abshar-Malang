@extends('admin.template.all')

@section('judul_halaman','Pengaturan')

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
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
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
                <input type="text" id="nama_bank" name="nama_bank" class="form-control" placeholder="Masukkan Nama Bank">
              </div>
              <div class="form-group">
                <label for="no_rekening">No Rekening</label>
                <input type="number" min="1" id="no_rekening" name="no_rekening" class="form-control" placeholder="Masukkan No Rekening">
              </div>
              <div class="row">
                <div class="col-12">
                  <a href="#" class="btn btn-secondary">Cancel</a>
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
      {{-- <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Informasi Panti</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputEstimatedBudget">Estimated budget</label>
              <input type="number" id="inputEstimatedBudget" class="form-control" value="2300" step="1">
            </div>
            <div class="form-group">
              <label for="inputSpentBudget">Total amount spent</label>
              <input type="number" id="inputSpentBudget" class="form-control" value="2000" step="1">
            </div>
            <div class="form-group">
              <label for="inputEstimatedDuration">Estimated project duration</label>
              <input type="number" id="inputEstimatedDuration" class="form-control" value="20" step="0.1">
            </div>
            <div class="row">
              <div class="col-12">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Save Changes" class="btn btn-success float-right">
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div> --}}
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