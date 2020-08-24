@extends('admin.template.all')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('judul_halaman','Tambah gambar')
@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{route('admin_produk')}}">Produk</a></li>
<li class="breadcrumb-item active">tambah gambar</li>
@endsection
@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
@endsection

@section('konten')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Produk<span class="text-danger">*</span>
                    </h3>
                </div>
                <div class="card-body" id="card-body-atas">
                    <div class="row">
                        <div class="col-md-8 d-flex">
                            <div class="form-group col-md-12 my-auto">
                            <form action="{{route('admin_tambah_gambar_produk',['id'=>$data['produk']->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imgInp" name="image"
                                        >
                                    <label class="custom-file-label"
                                        for="imgInp">tambah gambar</label>
                                       
                                    <small class="form-text text-muted">- Ukuran max 256KB</small>
                                    <small class="form-text text-muted">- Harus berupa gambar (format: jpg, jpeg, svg,
                                        png , dll)</small>
                                </div>
                                
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <row>
                            <button class="btn btn-primary btn-block" type="submit" style="height=40px">tambah</button>
                            </row>
                            </form>
                        </div>
              


                        
                    </div>


                    
    



    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" id="card_gambar">
               
                               
     
     <div class="card-body">
                    <table id="tabel_gambar" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>gambar</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['gambar'] as $d)
                            <tr id="gambar{{$d->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td class="text-center"><img src="{{asset($d->image)}}" alt="" width="100">
                                </td>
                                
                                <td class="text-center">
                                    
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{$d->id}}"
                                        data-toggle="tooltip" data-placement="bottom" title="Hapus"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
                
                                    
                </div>
            </div>
        </div>
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
<script src="{{asset('js/vue.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script>
    $('#tabel_gambar').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
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
            title: 'hapus gambar',
            
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $('#card_gambar').append(`
                <div class="overlay dark" id="loading">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                `);
                let id = $(this).data('id');
                let url = "{{route('admin_hapus_gambar',':__id')}}";
                url = url.replace(':__id', id);
                fetch(url)
                .then(() =>{
                    Swal.fire(
                        'Terhapus!',
                        'gambar telah terhapus.',
                        'success'
                    );
                    $("#gambar"+id).remove();
                    $('#card_gambar #loading').remove();
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

<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script>
    bsCustomFileInput.init();
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>
@endsection
