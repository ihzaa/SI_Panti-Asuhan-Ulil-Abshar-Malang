@extends('admin.template.all')
@section('judul_halaman',request()->is('*/produk/tambah*') ? 'Tambah Produk' : 'Edit Produk')
@section('breadcrumb')

<li class="breadcrumb-item active"><a href="{{route('admin_produk')}}">Produk</a></li>
<li class="breadcrumb-item active">{{request()->is('*/produk/tambah*') ? 'Tambah Produk' : 'Edit produk'}}</li>
@endsection
@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
@endsection

@section('konten')
<form action="{{request()->is('*/produk/tambah*') ? route('admin_tambah_produk'): route('admin_edit_produk',['id'=>$data['produk']->id])}}"
    method="POST" enctype="multipart/form-data">
    @csrf
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
                        <div class="col-md-4">
                            <img id="blah" class="img-fluid"
                                src="{{request()->is('*/produk/tambah*')?asset('images/default/picture.svg'):asset($data['produk']->image)}}"
                                alt="your image" />
                        </div>
                        <div class="col-md-8 d-flex">
                            <div class="form-group col-md-12 my-auto">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imgInp"
                                        {{request()->is('*/produk/tambah*')?"required":""}} name="image">
                                    <label class="custom-file-label"
                                        for="imgInp">{{request()->is('*/produk/tambah*')?"Foto Produk":"Foto produk.jpg"}}</label>
                                    <small class="form-text text-muted">- Ukuran max 256KB</small>
                                    <small class="form-text text-muted">- Harus berupa gambar (format: jpg, jpeg, svg,
                                        png , dll)</small>
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <input type="text" class="form-control" id="inputWarning" name="name"
                            placeholder="Nama Produk"
                            value="{{request()->is('*/produk/tambah*')?old('name'):$data['produk']->name}}" required>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <textarea type="text" class="form-control" id="inputWarning" name="desc"
                            placeholder="deskripsi">{{request()->is('*/produk/tambah*')?old('desc'):$data['produk']->desc}}</textarea>
                            
                        @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="inputWarning" name="price"
                            placeholder="Harga"
                            value="{{request()->is('*/produk/tambah*')?old('price'):$data['produk']->price}}" required>
                            <small class="form-text text-muted">contoh: 50000</small>
                        @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    

                   
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-2 mx-auto mb-3">
            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
        </div>
    </div>
</form>
@endsection

@section('JsTambahanAfter')
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

<!-- bs-custom-file-input -->
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
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
