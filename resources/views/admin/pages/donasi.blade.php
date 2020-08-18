@extends('admin.template.all')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
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
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Konfirmasi Donasi</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tabel_donasi" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Tgl Dibuat</th>
                <th>Email</th>
                <th>Nama Donatur</th>
                <th>Nama Alias</th>
                <th>Donasi</th>
                <th>Bank</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <tr>
                <th>Tgl Dibuat</th>
                <th>Email</th>
                <th>Nama Donatur</th>
                <th>Nama Alias</th>
                <th>Donasi</th>
                <th>Bank</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

      {{-- Tabel Donasi Masuk --}}
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Donasi Masuk</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabel_donasi_masuk" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Tgl Konfirmasi</th>
                  <th>Email</th>
                  <th>Nama Donatur</th>
                  <th>Nama Alias</th>
                  <th>Donasi</th>
                  <th>Bank</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
              <tfoot>
                <tr>
                  <th>Tgl Konfirmasi</th>
                  <th>Email</th>
                  <th>Nama Donatur</th>
                  <th>Nama Alias</th>
                  <th>Donasi</th>
                  <th>Bank</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
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
@endsection

@section('JsTambahanAfter')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

<!-- page script -->
<script>
  $(document).ready(function(){
    

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
                fetch(url)
                .then(() =>{
                  $('#tabel_donasi').DataTable().ajax.reload();
                  $('#tabel_donasi_masuk').DataTable().ajax.reload();
                  Swal.fire(
                      'Success!',
                      'Konfirmasi donasi telah dilakukan.',
                      'success'
                  );
                })
                .catch(err => {console.log(err);});
            }
        });
   
 });

  // Delete Donasi
  $("body").on('click', '.deleteDonation', function(){
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
              .then(() =>{
                $('#tabel_donasi').DataTable().ajax.reload();
                  $('#tabel_donasi_masuk').DataTable().ajax.reload();
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
  
  // Cancel Konfirmasi
  $("body").on('click', '.cancelConfirm', function() {
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
            .then(() =>{
              $('#tabel_donasi').DataTable().ajax.reload();
                  $('#tabel_donasi_masuk').DataTable().ajax.reload();
                Swal.fire(
                    'Success!',
                    'Pembatalan donasi berhasil.',
                    'success'
                );
            })
            .catch(err => {console.log(err);});
        }
    });
  });
</script>
@endsection