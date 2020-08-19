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
                                <td class="text-center"><img src="{{asset($blog->sampul_foto)}}" alt="" width="150">
                                </td>
                                <td>{{$blog->jumlah_dibaca}}</td>
                                <td>{{\Carbon\Carbon::parse($blog->created_at)->toDayDateTimeString()}}</td>
                                <td>{{\Carbon\Carbon::parse($blog->updated_at)->toDayDateTimeString()}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin_edit_blog_index',['id'=>$blog->id])}}"
                                        class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom"
                                        title="Edit"><i class="fas fa-edit"></i></a>
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
        {{-- <div > --}}
        <div class="col-md-6" id="vue_app">
            <div class="card" id="card_kategori">
                <div class="card-header d-flex">
                    <h3 class="card-title my-auto">Daftar Ketagori</h3>
                    {{-- <div class="col-sm-5 input-group">
                        <input type="text" class="form-control" placeholder="Cari" v-model="cari">
                        <div class="input-group-append d-none d-md-flex">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div> --}}
                    <button class="btn btn-primary btn-sm ml-auto" @click="tambah()"><i class="fas fa-plus"></i> Tambah
                        Kategori</button>

                </div>
                <!-- /.card-header style="max-height: 600px;overflow-y: scroll;" -->
                <div class="card-body">
                    <table id="tabel_kategori" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah Postingan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="i in data_list">
                                <td>@{{i.nama}}</td>
                                <td>@{{i.blog_count}}</td>
                                <td class="text-center">
                                    <button href="#" class="btn btn-sm btn-warning" data-toggle="tooltip"
                                        data-placement="bottom" title="Edit" @click="edit(i.id,i.nama)"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom"
                                        title="Hapus" @click="hapus(i.id)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            {{-- <tr id="data-kosong" class="odd" v-if="data_list.length == 0">
                                <td valign="top" colspan="100%" class="dataTables_empty text-center">
                                    Data Kosong
                                </td>
                            </tr> --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Judul</th>
                                <th>Foto Sampul</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <div id="modal-kategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-kategori-title"></h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Nama Kategori" v-model="nama">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-primary" @click="tambahKeDb">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}

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
    $(document).ready(function () {
        let vue = new Vue({
            el : "#vue_app",
            mounted() {
                // method yg pertama di panggil
                this.tampilData();

            },
            data : {
                // variabel
                data_list :[],
                id : "",
                nama : "",
                cari : "",
                tabel : "",
            },
            methods: {
                // method disini
                tambah: function(){
                    $('#modal-kategori-title').html('Tambah Kategori');
                    this.nama = "";
                    this.id = "";
                    $('#modal-kategori').modal('show');
                },
                tambahKeDb: function() {
                    $('#modal-kategori').modal('hide');
                    if(this.id == ""){
                        this.openLoading();
                        axios.post("{{route('admin_tambah_blog_kategori')}}", {
                            data: this.nama,
                        }).then(resp => {
                            if(!resp.data.status){
                                Swal.fire(
                                    'Maaf!',
                                    'Kategori sudah ada.',
                                    'error'
                                );
                                this.remLoading();
                                return;
                            }
                            this.data_list = resp.data.data;
                            this.remLoading();
                            this.tampilData();
                        }).catch(err => {
                            console.log(err);
                        });
                    }else{
                        this.openLoading();
                        let url = "{{route('admin_edit_blog_kategori',':__id')}}";
                        url = url.replace(':__id', this.id);
                        axios.post(url, {
                            data: this.nama,
                        }).then(resp => {
                            this.data_list = resp.data;
                            this.remLoading();
                            this.tampilData();
                        }).catch(err => {
                            console.log(err);
                        });
                    }
                },
                openLoading: function(){
                    $('#card_kategori').append(`
                    <div class="overlay dark" id="loading">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>`
                    );
                },
                remLoading: function(){
                    $('#loading').remove();
                },
                tampilData: function(){
                    this.openLoading();
                    this.data_list = [];
                    axios.get("{{route('admin_get_all_kategori')}}")
                    .then(resp =>{
                        if(this.tabel != ""){
                            this.tabel.clear().destroy();
                        }
                        // this.data_list = "";
                        this.data_list = resp.data;
                        // if(this.data_list.length == 0){
                        //     $('#tabel_kategori tbody').append(`<tr id="data-kosong" class="odd" v-if="data_list.length == 0">
                        //         <td valign="top" colspan="100%" class="dataTables_empty text-center">
                        //             Data Kosong
                        //         </td>
                        //     </tr>`);
                        // }
                    }).then(()=>{
                            this.tabel = $('#tabel_kategori').DataTable({
                                "columnDefs": [
                                { orderable: false, targets: [-1] }
                                ]
                            });
                            this.remLoading();
                    })
                    .catch(err =>{
                        console.log('eror =' + err);
                    }).finally(()=>{

                    });
                    // yg selalu dilakukan itu then akhir
                    // .then(function(){
                    //     $('#tbl-loader').hide();
                    // });
                },
                hapus: function(id){
                    this.id = id;
                    Swal.fire({
                        title: 'Yakin menghapus kategori?',
                        text: "Kategori yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.value) {
                            this.openLoading();
                            let url = "{{route('admin_hapus_blog_kategori',':__id')}}";
                            url = url.replace(':__id', this.id);
                            axios.get(url)
                            .then(data => {
                                this.data_list = data.data;
                                Swal.fire(
                                    'Terhapus!',
                                    'Kategori blog telah terhapus.',
                                    'success'
                                );
                                this.remLoading();
                                this.tampilData();
                            })
                            .catch(err => {console.log(err);});
                        }
                    });
                },
                edit: function(id,nama){
                    this.id = id;
                    this.nama = nama;
                    $('#modal-kategori-title').html('Edit Kategori');
                    $('#modal-kategori').modal('show');
                }
            },computed: {
                // filterdata() {
                //     return this.cari ?
                //     this.data_list.filter(item =>
                //         item.nama.toLowerCase().includes(this.cari)
                //     ): this.data_list
                // }
            }
        });
    });

    let table_blog = $('#tabel_blog').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "columnDefs": [
        { orderable: false, targets: [1,-1] }
        ]
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
                    table_blog.destroy();
                    $("#blog-"+id).remove();
                    table_blog = $('#tabel_blog').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": true,
                        "responsive": true,
                        "columnDefs": [
                        { orderable: false, targets: [1,-1] }
                        ]
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
