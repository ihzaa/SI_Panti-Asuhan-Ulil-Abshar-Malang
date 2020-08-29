@extends('admin.template.all')
@section('judul_halaman',request()->is('*/fasilitas/tambah*') ? 'Tambah Fasilitas' : 'Edit Fasilitas')
@section('breadcrumb')
<li class="breadcrumb-item active">Pages</li>
<li class="breadcrumb-item active"><a href="{{route('admin_fasilitas')}}">Fasilitas</a></li>
<li class="breadcrumb-item active">{{request()->is('*/fasilitas/tambah*') ? 'Tambah Fasilitas' : 'Edit Fasilitas'}}</li>
@endsection
@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('css/quantity.css')}}">
@endsection

@section('konten')
<form action="{{request()->is('*/fasilitas/tambah*') ? route('admin_tambah_fasilitas'): route('admin_edit_fasilitas',['id'=>$data['sarana']->id])}}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Fasilitas <span class="text-danger">*</span>
                    </h3>
                </div>
                <div class="card-body" id="card-body-atas">
                    <div class="row">
                        <div class="col-md-4">
                            <img id="blah" class="img-fluid"
                                src="{{request()->is('*/fasilitas/tambah*')?asset('images/default/picture.svg'):asset($data['sarana']->image)}}"
                                alt="your image" />
                        </div>
                        <div class="col-md-8 d-flex">
                            <div class="form-group col-md-12 my-auto">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imgInp" name="image">
                                    <label class="custom-file-label"
                                        for="imgInp">{{request()->is('*/fasilitas/tambah*')?"Foto Fasilitas":"Foto sampul.jpg"}}</label>
                                    <small class="form-text text-muted">- Ukuran max 500KB</small>
                                    <small class="form-text text-muted">- Harus berupa gambar (format: jpg, jpeg, svg, png , dll)</small>
                                    <small class="form-text text-muted">- Lebar foto minimal 560</small>
                                    <small class="form-text text-muted">- Tidak wajib diisi</small>
                                        
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                      <label for="jumlah">Nama Fasilitas</label>
                        <input type="text" class="form-control" id="inputWarning" name="name"
                            placeholder="Nama Fasilitas Panti Asuhan"
                            value="{{request()->is('*/fasilitas/tambah*')?old('name'):$data['sarana']->name}}" required>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label for="jumlah">Jumlah</label>
                    <div class="range-slider" id="jumlah">
                      <input class="range-slider__range" name="jumlah" type="range" value="{{request()->is('*/fasilitas/tambah*')?1:$data['sarana']->total}}" min="1" max="50">
                      <span class="range-slider__value">0</span>
                      @error('jumlah')
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

    var rangeSlider = function(){
  var slider = $('.range-slider'),
      range = $('.range-slider__range'),
      value = $('.range-slider__value');
    
  slider.each(function(){

    value.each(function(){
      var value = $(this).prev().attr('value');
      $(this).html(value);
    });

    range.on('input', function(){
      $(this).next(value).html(this.value);
    });
  });
};

rangeSlider();
</script>
@endsection
