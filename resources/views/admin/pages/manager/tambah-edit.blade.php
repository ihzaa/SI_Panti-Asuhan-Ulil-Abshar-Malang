@extends('admin.template.all')
@section('judul_halaman',request()->is('*/manager/tambah*') ? 'Tambah Pengurus' : 'Edit Pengurus')
@section('breadcrumb')
<li class="breadcrumb-item active">Pages</li>
<li class="breadcrumb-item active"><a href="{{route('admin_manager')}}">Pengurus</a></li>
<li class="breadcrumb-item active">{{request()->is('*/manager/tambah*') ? 'Tambah Pengurus' : 'Edit Pengurus'}}</li>
@endsection
@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
@endsection

@section('konten')
<form action="{{request()->is('*/manager/tambah*') ? route('admin_tambah_pengurus'): route('admin_edit_pengurus',['id'=>$data['manager']->id])}}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Pengurus <span class="text-danger">*</span>
                    </h3>
                </div>
                <div class="card-body" id="card-body-atas">
                    <div class="row">
                        <div class="col-md-4">
                            <img id="blah" class="img-fluid"
                                src="{{request()->is('*/manager/tambah*')?asset('images/default/picture.svg'):asset($data['manager']->image)}}"
                                alt="your image" />
                        </div>
                        <div class="col-md-8 d-flex">
                            <div class="form-group col-md-12 my-auto">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imgInp"
                                        {{request()->is('*/manager/tambah*')?"required":""}} name="image">
                                    <label class="custom-file-label"
                                        for="imgInp">{{request()->is('*/manager/tambah*')?"Foto Pengurus":"Foto sampul.jpg"}}</label>
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
                            placeholder="Nama Pengurus Panti Asuhan"
                            value="{{request()->is('*/manager/tambah*')?old('name'):$data['manager']->name}}" required>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="inputWarning" name="position"
                            placeholder="Posisi/jabatan Pengurus Panti Asuhan"
                            value="{{request()->is('*/manager/tambah*')?old('position'):$data['manager']->position}}" required>
                        @error('position')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <textarea type="text" class="form-control" id="inputWarning" name="position_desc"
                            placeholder="Deskripsi Jabatan secara singkat">{{request()->is('*/manager/tambah*')?old('position_desc'):$data['manager']->position_desc}}</textarea>
                            <small class="form-text text-muted">-  Deskripsi jabatan tidak wajib di isi</small>
                        @error('position_desc')
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
