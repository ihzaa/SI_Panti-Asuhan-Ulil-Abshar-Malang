@extends('admin.template.all')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('judul_halaman','Blog')

@section('breadcrumb')
<li class="breadcrumb-item active">Pages</li>
<li class="breadcrumb-item active">Blog</li>
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" id="card_tabel">
                <div class="card-header d-flex">
                    <h3 class="card-title my-auto">Daftar Postingan Blog</h3>
                    <a class="btn btn-primary btn-sm ml-auto" href="{{route('admin_tampil_halaman_tambah_blog')}}"><i
                            class="fas fa-plus"></i> Tambah Postingan</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel_blog" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Foto Sampul</th>
                                <th>Jumlah Dilihat</th>
                                <th>Tgl Dibuat</th>
                                <th>Tgl Diupdate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['blogs'] as $blog)
                            <tr id="blog-{{$blog->id}}">
                                <td>{{$blog->judul}}</td>
                                <td>{{$blog->sampul_foto}}</td>
                                <td>{{$blog->jumlah_dibaca}}</td>
                                <td>{{\Carbon\Carbon::parse($blog->created_at)->formatLocalized("%A, %d %B %Y")}}</td>
                                <td>{{\Carbon\Carbon::parse($blog->updated_at)->formatLocalized("%A, %d %B %Y")}}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip"
                                        data-placement="bottom" title="Edit"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{$blog->id}}"
                                        data-toggle="tooltip" data-placement="bottom" title="Hapus"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Judul</th>
                                <th>Foto Sampul</th>
                                <th>Jumlah Dilihat</th>
                                <th>Tgl Dibuat</th>
                                <th>Tgl Diupdate</th>
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
<script>
    $('#tabel_blog').DataTable({
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

    $(".btn-hapus").on('click',function(){
        Swal.fire({
            title: 'Yakin menghapus postingan blog?',
            text: "Postingan yang dihapus tidak dapat dikembalikan!",
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
                let url = "{{route('admin_hapus_blog',':__id')}}";
                url = url.replace(':__id', id);
                fetch(url)
                .then(() =>{
                    Swal.fire(
                        'Terhapus!',
                        'Postingan blog telah terhapus.',
                        'success'
                    );
                    $("#blog-"+id).remove();
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
