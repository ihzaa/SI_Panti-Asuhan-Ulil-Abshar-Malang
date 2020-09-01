@extends('admin.template.all')
@section('judul_halaman',request()->is('*/pengeluaran/tambah*') ? 'Tambah Pengeluaran' : 'Edit pengeluaran')
@section('breadcrumb')

<li class="breadcrumb-item active"><a href="{{route('admin_pengeluaran')}}">Pengeluaran</a></li>
<li class="breadcrumb-item active">
    {{request()->is('*/pengeluaran/tambah*') ? 'Tambah pengeluaran' : 'Edit pengeluaran'}}</li>
@endsection
@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
@endsection

@section('konten')
<form
    action="{{request()->is('*/pengeluaran/tambah*') ? route('admin_tambah_pengeluaran'): route('admin_edit_pengeluaran',['id'=>$data['pengeluaran']->id])}}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Data pengeluaran<span class="text-danger">*</span>
                    </h3>
                </div>
                <div class="card-body" id="card-body-atas">


                    <div class="form-group mt-4">
                        <textarea type="text" class="form-control" id="inputWarning" name="pengeluaran"
                            placeholder="kegiatan pengeluaran">{{request()->is('*/pengeluaran/tambah*')?old('nominal'):$data['pengeluaran']->nama_keperluan}}</textarea>
                        @error('pengeluaran')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group"> --}}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" class="form-control" id="inputWarning11" name="nominal" placeholder="nominal"
                            value="{{request()->is('*/pengeluaran/tambah*')?old('pengeluaran'):$data['pengeluaran']->nominal}}"
                            required>
                        @error('nominal')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    {{-- </div> --}}

                    <div class="form-group">
                        <input type="date" class="form-control" id="inputWarning" name="date"
                            value="{{request()->is('*/pengeluaran/tambah*')?old('date'):\Carbon\Carbon::parse($data['pengeluaran']->created_at)->format("Y-m-d")}}"
                            required>

                        @error('date')
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

<!-- bs-custom-file-input -->
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script>
    bsCustomFileInput.init();
    $(document).ready(function(){
        var n = parseInt($("#inputWarning11").val().replace(/\D/g,''),10);
        $("#inputWarning11").val(n.toLocaleString());
    })
    $("#inputWarning11").on('keyup', function(){
        var n = parseInt($(this).val().replace(/\D/g,''),10);
        $(this).val(n.toLocaleString());
    });
    // function readURL(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();

    //         reader.onload = function(e) {
    //             $('#blah').attr('src', e.target.result);
    //         }

    //         reader.readAsDataURL(input.files[0]); // convert to base64 string
    //     }
    // }

    // $("#imgInp").change(function() {
    //     readURL(this);
    // });
</script>
@endsection
