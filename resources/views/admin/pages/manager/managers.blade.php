@extends('admin.template.all')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('judul_halaman','Pengurus')

@section('breadcrumb')
<li class="breadcrumb-item active">Pages</li>
<li class="breadcrumb-item active">Manager</li>
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" id="card_tabel">
                <div class="card-header d-flex">
                    <h3 class="card-title my-auto">Daftar Pengurus Panti Asuhan</h3>
                    <a class="btn btn-primary btn-sm ml-auto" href="{{route('admin_tampil_halaman_tambah_pengurus')}}"><i
                            class="fas fa-plus"></i> Tambah Pengurus</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel_manager" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto Pengurus</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Deskripsi Posisi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['managers'] as $d)
                            <tr id="manager-{{$d->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td class="text-center"><img src="{{asset($d->image)}}" alt="" width="100">
                                </td>
                                <td>{{$d->name}}</td>
                                <td>{{$d->position}}</td>
                                <td>{{$d->position_desc}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin_tampil_edit_pengurus',['id'=>$d->id])}}"
                                        class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom"
                                        title="Edit"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{$d->id}}"
                                        data-toggle="tooltip" data-placement="bottom" title="Hapus"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Foto Pengurus</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Deskripsi Posisi</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        

    </div>
</div>

@endsection

@section('JsTambahanAfter')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('js/vue.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script>
    let table_manager = $('#tabel_manager').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });

    // Enable tooltips everywhere
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(document).on('click',".btn-hapus",function(){
        Swal.fire({
            title: 'Yakin ingin menghapus data pengurus?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $('#card_tabel').append(`
                <div class="overlay dark" id="loading">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                `);
                let id = $(this).data('id');
                let url = "{{route('admin_hapus_pengurus',':__id')}}";
                url = url.replace(':__id', id);
                fetch(url)
                .then(() =>{
                    Swal.fire(
                        'Terhapus!',
                        'Data pengurus telah terhapus.',
                        'success'
                    );
                    table_manager.destroy();
                    $("#manager-"+id).remove();
                    table_manager = $('#tabel_manager').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": true,
                        "responsive": true,
                    });
                    $('#card_tabel #loading').remove();
                })
                .catch(err => {console.log(err);});
            }
        });
    });
</script>
@if(Session::get('icon'))
<script>
    Swal.fire({
            icon: "{{Session::get('icon')}}",
            title: "{{Session::get('title')}}",
            text: "{{Session::get('text')}}",
        });
</script>
@endif
@endsection
