<div class="modal fade" id="donasiModal" tabindex="-1" role="dialog" aria-labelledby="donasiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="donasiModalLabel">Form Donasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="donasi_form">
          @csrf
          <div class="form-group">
            <label for="name" class="col-form-label col-form-label-sm">Nama Pengirim 
                <small class="info-label"><span class="red">*</span> </small>
            </label>
            <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Sesuaikan dengan nama rekening pengirim" required>
          </div>
          <div class="form-group">
            <label for="nama_alias" class="col-form-label col-form-label-sm">Nama Samaran</label>
            <input type="text" class="form-control form-control-sm" name="nama_alias" id="nama_alias" placeholder="Opsional Nama yang ditampilkan ke publik" required>
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label col-form-label-sm">Email</label>
            <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Opsional Mendapatkan Konfirmasi Donasi Masuk">
          </div>
          <div class="form-group">
            <label for="donasi" class="col-form-label col-form-label-sm">Jumlah 
                <small class="info-label"><span class="red">*</span> </small>
            </label>
            {{-- <input type="number" class="form-control form-control-sm" name="donasi" id="donasi" required> --}}
            <input id="donasi" type="number" name="donasi" oninput="updateInputTextDonasi(this.value)" >
            <input id="rupiah" placeholder="Masukkan Jumlah Donasi" type="text" class="form-control form-control-sm">
          </div>

          <div class="form-group">
            
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">
              Bank <small class="info-label">Transfer pada no rekening yang tertera <span class="red">*</span> </small>
            </label>
            <select class="custom-select my-1 mr-sm-2" name="bank" id="bank" required>
              <option value="" selected>Choose...</option>
              @foreach ($bank as $item)
                <option value="{{$item->nama_bank}}">{{$item->nama_bank}} - {{$item->no_rekening}}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Example invalid custom select feedback</div>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" >Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>