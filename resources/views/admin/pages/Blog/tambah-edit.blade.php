@extends('admin.template.all')
@section('judul_halaman',request()->is('*/blog/tambah*') ? 'Tambah Blog' : 'Edit Blog')
@section('breadcrumb')
<li class="breadcrumb-item active">Pages</li>
<li class="breadcrumb-item active"><a href="{{route('admin_pages_blog_index')}}">Blog</a></li>
<li class="breadcrumb-item active">{{request()->is('*/blog/tambah*') ? 'Tambah Blog' : 'Edit Blog'}}</li>
@endsection
@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
@endsection

@section('konten')
<form
    action="{{request()->is('*/blog/tambah*') ? route('admin_tambah_blog'): route('admin_edit_blog',['id'=>$data['blog']->id])}}"
    method="POST" enctype="multipart/form-data" id="form_blog">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Judul dan Foto <span class="text-danger">*</span>
                    </h3>
                </div>
                <div class="card-body" id="card-body-atas">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputWarning" name="judul"
                            placeholder="Judul Postingan Blog"
                            value="{{request()->is('*/blog/tambah*')?old('judul'):$data['blog']->judul}}" required>
                        @error('judul')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <img id="blah" class="img-fluid"
                                src="{{request()->is('*/blog/tambah*')?asset('images/default/picture.svg'):asset($data['blog']->sampul_foto)}}"
                                alt="your image" />
                        </div>
                        <div class="col-md-8 d-flex">
                            <div class="form-group col-md-12 my-auto">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imgInp"
                                        {{request()->is('*/blog/tambah*')?"required":""}} name="foto_sampul">
                                    <label class="custom-file-label"
                                        for="imgInp">{{request()->is('*/blog/tambah*')?"Foto Sampul":"Foto sampul.jpg"}}</label>
                                    <small class="form-text text-muted">- Ukuran max 256KB</small>
                                    <small class="form-text text-muted">- Harus berupa gambar (format: jpg, jpeg, svg,
                                        png , dll)</small>
                                </div>
                                @error('foto_sampul')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="" class="col-sm-2 form-control-label my-auto">Kategori</label>
                        <div class="col-sm-10" id="row_select">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Kategori Baru</span>
                                </div>
                                <input type="text" id="tambah_kategori" class="form-control"
                                    placeholder="Nama Kategori Baru">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="btn_tambah_kategori">Tambah</button>
                                </div>
                            </div>
                            <select class="form-control selectpicker border" id="list_kategori" name="kategori" required
                                data-live-search="true">
                                @foreach ($data['kategori'] as $d)
                                <option value="{{$d->id}}">{{$d->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Konten Blog <span class="text-danger">*</span>
                    </h3>
                    <!-- tools box -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse"
                            data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pad">
                    <div class="mb-3">
                        <textarea class="textarea" name="konten" required placeholder="Place some text here"
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{request()->is('*/blog/tambah*')?old('konten'):$data['blog']->konten}}</textarea>
                    </div>
                    @error('konten')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- ./row -->
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
    $(document).ready(function () {
        $(function () {
        // Summernote
            $('.textarea').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                placeholder : 'Ketikkan kontent disini',
            })
        })
        bsCustomFileInput.init();
        $(function() {
            $('.selectpicker').selectpicker();
        });

        $('#btn_tambah_kategori').on('click',function(){
            if($('#tambah_kategori').val() == ""){
                Swal.fire(
                    'Maaf!',
                    'Isi kolom kategori.',
                    'error'
                );
                    return;
            }
            $('#card-body-atas').parent().append(`
                <div class="overlay dark" id="loading">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                `
            );
            const formData = new FormData();
            formData.append('data', $('#tambah_kategori').val());
            axios.post("{{route('admin_tambah_blog_kategori')}}", {
                data: $('#tambah_kategori').val(),
                headers : {
                    'Cache-Control': 'no-cache',
                    'Pragma': 'no-cache',
                    'Expires': '0',
                }
            })
            .then(function (response) {
                if(response.data.status){
                    $('#btn_tambah_kategori').parent().parent().next().remove();
                    let el_select = document.createElement('select');
                    el_select.classList.add("form-control", "selectpicker", "border");
                    el_select.setAttribute("name","kategori");
                    let arr = response.data.data;
                    for (let i = 0; i < arr.length; i++) {
                        el_select.innerHTML += `<option value="${arr[i].id}">${arr[i].nama}</option>`;
                    };
                    $('#row_select').append(el_select);
                    $('.selectpicker').selectpicker();
                    $('#loading').remove();
                }else{
                    $('#loading').remove();
                    Swal.fire(
                        'Maaf!',
                        'Kategori sudah ada.',
                        'error'
                    );
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        });
    });
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

    $('#form_blog').on('submit',function(){
        let card = $(this).find('.card');
        for(let i = 0; i < card.length;i++){
            card.append(`
                <div class="overlay dark" id="loading">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                `);
        }
    });
</script>
@endsection
