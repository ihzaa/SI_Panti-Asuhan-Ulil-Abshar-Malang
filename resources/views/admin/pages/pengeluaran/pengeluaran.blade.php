@extends('admin.template.all')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('judul_halaman','pengeluaran')

@section('breadcrumb')

<li class="breadcrumb-item active">pengeluaran</li>
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" id="card_pengeluaran">
                <div class="card-header d-flex">
                    <h3 class="card-title my-auto">Daftar pengeluaran</h3>
                    <a class="btn btn-primary btn-sm ml-auto" href="{{route('admin_tampil_halaman_tambah_pengeluaran')}}"><i class="fas fa-plus"></i> Tambah Pengeluaran</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel_pengeluaran" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>pengeluaran</th>
                                <th>Nominal</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['pengeluaran'] as $d)
                            <tr id="pengeluaran-{{$d->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->nama_keperluan}}</td>
                                <td>{{$d->nominal}}</td>

                                <td class="text-center">
                                    <a href="{{route('admin_tampil_edit_pengeluaran',['id'=>$d->id])}}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{$d->id}}" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

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
    $('#tabel_pengeluaran').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
    });

    // Enable tooltips everywhere
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(document).on('click', ".btn-hapus", function() {
        Swal.fire({
            title: 'hapus pengeluaran',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $('#card_pengeluaran').append(`
                <div class="overlay dark" id="loading">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                `);
                let id = $(this).data('id');
                let url = "{{route('admin_hapus_pengeluaran',':__id')}}";
                url = url.replace(':__id', id);
                fetch(url)
                    .then(() => {
                        Swal.fire(
                            'Terhapus!',
                            'pengeluaran telah terhapus.',
                            'success'
                        );
                        $("#pengeluaran-" + id).remove();
                        $('#card_pengeluaran #loading').remove();
                    })
                    .catch(err => {
                        console.log(err);
                    });
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