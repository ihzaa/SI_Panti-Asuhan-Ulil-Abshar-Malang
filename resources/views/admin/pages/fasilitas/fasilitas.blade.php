@extends('admin.template.all')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('judul_halaman','Fasilitas')

@section('breadcrumb')
<li class="breadcrumb-item active">Pages</li>
<li class="breadcrumb-item active">Facilities</li>
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" id="card_tabel">
                <div class="card-header d-flex">
                    <h3 class="card-title my-auto">Daftar fasilitas Panti Asuhan</h3>
                    <a class="btn btn-primary btn-sm ml-auto" href="{{route('admin_tampil_halaman_tambah_fasilitas')}}"><i
                            class="fas fa-plus"></i> Tambah Fasilitas</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel_fasilitas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Fasilitas</th>
                                <th>Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['sarana'] as $d)
                            <tr id="fasilitas-{{$d->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->name}}</td>
                                <td>{{$d->total}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin_tampil_edit_fasilitas',['id'=>$d->id])}}"
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
                                <th>Nama</th>
                                <th>Jumlah</th>
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
    let table_fasilitas = $('#tabel_fasilitas').DataTable({
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
            title: 'Yakin ingin menghapus data fasilitas?',
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
                let url = "{{route('admin_hapus_fasilitas',':__id')}}";
                url = url.replace(':__id', id);
                fetch(url)
                .then(() =>{
                    Swal.fire(
                        'Terhapus!',
                        'Data fasilitas telah terhapus.',
                        'success'
                    );
                    table_fasilitas.destroy();
                    $("#fasilitas-"+id).remove();
                    table_fasilitas = $('#tabel_fasilitas').DataTable({
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
