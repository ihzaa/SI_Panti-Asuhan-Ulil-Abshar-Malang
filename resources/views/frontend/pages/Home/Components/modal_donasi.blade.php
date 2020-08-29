<div id="donasiModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="wizard-title">Form Donasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="donasi_form">
        @csrf
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="link-bio nav-link active" data-toggle="tab" href="#biodata" role="tab">Biodata</a>
          <li>
          <li class="nav-item">
            <a class="link-donasi nav-link disabled" data-toggle="tab" href="#info-donasi" role="tab">Donasi</a>
          <li>
        </ul>
        
        <div class="tab-content mt-2">
          <div class="tab-pane fade show active" id="biodata" role="tabpanel">
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

          </div>
          <div class="tab-pane fade" id="info-donasi" role="tabpanel">
            {{-- <h4>Informasi Donasi</h4> --}}

            <input type="text" id="copy-rek" value="" aria-hidden="true">
            <div class="form-group">
              <label for="bank">
                Bank <small class="info-label">Transfer pada no rekening yang tertera <span class="red">*</span> </small>
              </label>
              <div class="input-group">
                <select class="custom-select" name="bank" id="bank" required>
                  <option value="" selected>Choose...</option>
                  @foreach ($bank as $item)
                    <option value='{{ $item }}'>
                      {{$item->nama_bank}} - {{$item->no_rekening}}
                    </option>
                  @endforeach
                </select>
                <div class="input-group-append">
                  <button type="button" value="copy" onclick="copyToClipboard('copy-rek')" class="btn btn-outline-secondary"><span class="icon icon-copy"></span></button>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="donasi" class="col-form-label col-form-label-sm">Jumlah 
                  <small class="info-label"><span class="red">*</span> </small>
              </label>
              {{-- <label for="campaignName">Jumlah Donasi</label> --}}
              {{-- <input type="number" class="form-text" id='campaignName'></input> --}}
              <input id="donasi" type="number" name="donasi" oninput="updateInputTextDonasi(this.value)">
              <input id="rupiah" placeholder="Masukkan Jumlah Donasi" type="text" class="form-control form-control-sm" required>
            </div>
          </div>
        </div>
        <div class="progress mt-5">
          <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Step 1 of 2</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="donasi-continue">Continue</button>
        <button type="submit" class="btn btn-primary" id="submit-donasi">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>