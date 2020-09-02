@extends('admin.template.all')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('judul_halaman','pengeluaran')

@section('breadcrumb')

<li class="breadcrumb-item active">pengeluaran</li>
@endsection

@section('konten')
<div class="container-fluid" id="vue_app">
    <div class="row">
        <div class="col-12">
            <div class="card" id="card_pengeluaran">
                <div class="overlay dark" id="loading">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="card-header d-flex">
                    <h3 class="card-title my-auto">Daftar pengeluaran</h3>
                    {{-- <a class="btn btn-primary btn-sm ml-auto"
                        href="{{route('admin_tampil_halaman_tambah_pengeluaran')}}"><i class="fas fa-plus"></i> Tambah
                    Pengeluaran</a> --}}
                    <button class="btn btn-primary btn-sm ml-auto" @click="tambah()"><i class="fas fa-plus"></i> Tambah
                        Pengeluaran</button>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel_pengeluaran" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>pengeluaran</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            <tr v-for="d in data_list">
                                <td>@{{d.nama_keperluan}}</td>
                                <td>Rp. @{{d.nom_tampil}}</td>
                                <td>@{{d.waktu}}</td>
                                <td><button class="btn btn-sm btn-warning"
                                        @click="edit(d.id,d.nama_keperluan,d.nom_tampil,d.waktu)" data-toggle="tooltip"
                                        data-placement="bottom" title="Hapus"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" @click="hapus(d.id)" data-toggle="tooltip"
                                        data-placement="bottom" title="Hapus"><i class="fas fa-trash"></i></button></td>
                            </tr>
                            {{-- @foreach ($data['pengeluaran'] as $d) --}}
                            {{-- <tr id="pengeluaran-{{$d->id}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->nama_keperluan}}</td>
                            <td>Rp. {{number_format($d->nominal, 0, '.', '.')}}</td>
                            <td>{{\Carbon\Carbon::parse($d->created_at)->translatedFormat("l, d F Y")}}</td>
                            <td class="text-center">
                                <a href="{{route('admin_tampil_edit_pengeluaran',['id'=>$d->id])}}"
                                    class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom"
                                    title="Edit"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="{{$d->id}}"
                                    data-toggle="tooltip" data-placement="bottom" title="Hapus"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                            </tr> --}}
                            {{-- @endforeach --}}
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="mb-0">@{{title_modal}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Keterangan Pengeluaran"
                            v-model="pengeluaran">
                        <span id="ket-error" class="error invalid-feedback">Keterangan Pengeluaran Tidak Boleh
                            Kosong</span>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" id="nominal" autocomplete="off" class="form-control" placeholder="Nominal" v-model="nominal">
                        <span id="nominal-error" class="error invalid-feedback">Nominal Tidak Boleh Kosong</span>

                    </div>
                    <div class="input-group date mt-3" data-provide="datepicker">
                        <input type="text" class="form-control datepicker" autocomplete="off" id="tanggal" placeholder="Tanggal">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        <span id="tanggal-error" class="error invalid-feedback">Tanggal Tidak Boleh
                            Kosong</span>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" @click="saveToDb()">Simpan</button>
                </div>
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
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/vue.min.js')}}"></script>
<script>
    $(document).on("keyup","#nominal",nominalK
        );

        function nominalK() {
            // When user select text in the document, also abort.
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
                return;
            }

            // When the arrow keys are pressed, abort.
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                return;
            }


            var $this = $( this );

            // Get the value.
            var input = $this.val();

            var input = input.replace(/[\D\s\._\-]+/g, "");
                    input = input ? parseInt( input, 10 ) : 0;

                    $this.val( function() {
                        return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                    } );
        }
    $(document).ready(function () {
        $.fn.datepicker.defaults.format = 'dd/mm/yyyy';
        $('.datepicker').datepicker();
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
                pengeluaran : "",
                nominal : "",
                tanggal : "",
                table : "",
                title_modal : ""
            },
            methods: {
                tampilData: function(){
                    var myHeaders = new Headers();
                    myHeaders.append('pragma', 'no-cache');
                    myHeaders.append('cache-control', 'no-cache');
                    var myInit = {
                        method: 'GET',
                        headers: myHeaders,
                    };
                    fetch("{{route('admin_get_all_pengeluaran_dong')}}", myInit)
                    .then(response => response.json())
                    .then(data =>
                        {
                            if(this.table != ""){
                                this.table.clear().destroy();
                            }
                            this.data_list = [];
                            return data;
                        }
                    )
                    .then(data =>
                        {
                            this.data_list = data;
                            return data;
                        }
                    )
                    .then( (data)=>{
                            this.table = $('#tabel_pengeluaran').DataTable({
                                "paging": true,
                                "lengthChange": true,
                                "searching": true,
                                "ordering": true,
                                "info": true,
                                "autoWidth": true,
                                "responsive": true,
                                columnDefs: [
                                    { responsivePriority: 1, targets: -1 },
                                ]
                            });
                    })
                    .then( ()=>{
                        $('#loading').hide();
                    })
                    .catch(err => {
                        console.log(err);
                    });
                },
                tambah: function() {
                    $('#ket-error').hide();
                    $('#nominal-error').hide();
                    $('#tanggal-error').hide();
                    this.id = "";
                    this.pengeluaran = "";
                    this.nominal = "";
                    this.tanggal = "";
                    $('#tanggal').val('');
                    this.title_modal = "Tambah Pengeluaran";
                    $('#modal').modal('show');
                },
                saveToDb: function() {
                    this.tanggal = $('#tanggal').val();
                    let err = false;
                    if(this.pengeluaran == ""){
                        $('#ket-error').show();
                        err = true;
                    }else{
                        $('#ket-error').hide();
                    }
                    if(this.nominal == ""){
                        $('#nominal-error').show();
                        err = true;
                    }else{
                        $('#nominal-error').hide();
                    }
                    if(this.tanggal == ""){
                        $('#tanggal-error').show();
                        err = true;
                    }else{
                        $('#tanggal-error').hide();
                    }
                    if(!err){
                        $('#modal').modal('hide');
                        $('#loading').show();

                        if(this.id == ""){
                            const data = { ket: this.pengeluaran,nom: this.nominal,tgl:this.tanggal }
                            fetch("{{route('admin_tambah_pengeluaran_dong')}}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify(data),
                            })
                            .then(response => response.json())
                            .then(data =>{
                                if(data == "ok"){
                                    this.tampilData();
                                    Swal.fire(
                                        'Berhasil!',
                                        'pengeluaran telah berhasil ditambahkan.',
                                        'success'
                                    );
                                }
                            }).catch(err => {
                                console.log(err);
                            });
                        }else{
                            const data = {id:this.id, ket: this.pengeluaran,nom: this.nominal,tgl:this.tanggal }
                            fetch("{{route('admin_edit_pengeluaran_dong')}}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify(data),
                            })
                            .then(response => response.json())
                            .then(data =>{
                                if(data == "ok"){
                                    this.tampilData();
                                }
                            }).catch(err => {
                                console.log(err);
                            });
                        }
                    }
                },edit:function(id,ket,nom,tgl){
                    this.id = id;
                    this.pengeluaran = ket;
                    this.nominal = nom;
                    this.tanggal = tgl;
                    $('#tanggal').val(tgl);
                    this.title_modal = "Edit Pengeluaran";
                    $('#modal').modal('show');
                },
                hapus: function(id){
                    Swal.fire({
                    title: 'Yakin hapus pengeluaran?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        $('#loading').show();
                        let url = "{{route('admin_hapus_pengeluaran_dong',':__id')}}";
                        url = url.replace(':__id', id);
                        fetch(url)
                            .then(() => {
                                Swal.fire(
                                    'Terhapus!',
                                    'pengeluaran telah terhapus.',
                                    'success'
                                );
                                this.tampilData();
                            })
                            .catch(err => {
                                console.log(err);
                            });
                    }
                });
                }
            }
        });
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
{{-- @if(Session::get('icon'))
<script>
    Swal.fire({
        icon: "{{Session::get('icon')}}",
title: "{{Session::get('title')}}",
text: "{{Session::get('text')}}",
});
</script>
@endif --}}
@endsection
