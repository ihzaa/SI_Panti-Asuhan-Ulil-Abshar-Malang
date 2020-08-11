<div id='load' class="row el-element-overlay">
        
  {{-- <div class="col-lg-3 col-md-6">
      <div class="card">
          <div class="el-card-item">
              <div class="el-card-avatar el-overlay-1"> <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="user">
                  <div class="el-overlay">
                      <ul class="list-style-none el-info">
                          <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link" href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                          <li class="el-item"><a class="btn default btn-outline el-link" href="javascript:void(0);"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                      </ul>
                  </div>
              </div>
              <div class="el-card-content">
                  <h4 class="m-b-0">Harry Addington</h4> <span class="text-muted">Mobile App Developer</span>
              </div>
          </div>
      </div>
  </div> --}}
  @foreach($data_anak as $row)
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1"> 
                  @if ($row->foto_path != '')
                    <div style="width: auto; height: 265px;">
                      <img style="width: auto; height: 100%;" src="{{asset($row->foto_path)}}" alt="user">
                    </div>
                  @else
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user">
                  @endif
                    <div class="el-overlay">
                        <ul class="list-style-none el-info">
                          <div>
                            Alamat Asal
                            Malang
                          </div>
                          <div>
                            Umur
                            {{$row->umur}} Tahun
                          </div>
                          <div>
                            Jenis Kelamin
                            @if ($row->jenis_kelamin == 0)
                                Perempuan
                            @else
                              Laki - Laki
                            @endif
                          </div>
                            {{-- <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link" href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                            <li class="el-item"><a class="btn default btn-outline el-link" href="javascript:void(0);"><i class="fa fa-link" aria-hidden="true"></i></a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="el-card-content">
                <h4 class="m-b-0">{{$row->nama}}</h4> <span class="text-muted">{{$row->sekolah}}</span>
                </div>
            </div>
        </div>
    </div>
  @endforeach
  {{-- {{$data_anak}} --}}
  
</div>
{{ $data_anak->links() }}