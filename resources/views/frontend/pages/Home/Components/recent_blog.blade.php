<section class="ftco-section" style="padding-top: 0;">
  <div class="container">
    <div class="row justify-content-center pb-5">
      <div class="col-md-10 heading-section text-center ftco-animate">
        <h2 class="mb-4">Blog Saat Ini</h2>
        
      </div>
    </div>
    <div class="row">
      @if (count($blogs) == 0)
        <div class="col-md-12 text-center" style="font-size: 1.3rem !important;">
            Blog tidak ada
        </div>
      @endif
      <div class="col-md-6">
        @foreach($blogs as $key => $d)
          @if($key < 1)
            <div class="blog-entry align-self-stretch ftco-animate">
              <a href="{{route('frontend_single_blog',['id'=>$d->id])}}" class="block-20 img" style="background-image: url('{{asset($d->sampul_foto)}}');">
              </a>
              <div class="text text-2 bg-light">
                <h3 class="heading mb-2">
                  <a href="{{route('frontend_single_blog',['id'=>$d->id])}}">{{$d->judul}}</a>
                </h3>
                <div class="meta mb-2">
                  <div>
                    <a href="{{route('frontend_single_blog',['id'=>$d->id])}}">
                      {{\Carbon\Carbon::parse($d->created_at)->formatLocalized("%A, %d %B %Y") }}
                    </a>
                  </div>
                  <div>
                    <a href="{{route('frontend_single_blog',['id'=>$d->id])}}">
                        {{$d->users->nama}}
                    </a>
                  </div>
                  {{-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div> --}}
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
      <div class="col-md-6">
        @foreach($blogs as $key => $d)
          @if($key > 0)
            <div class="blog-entry align-self-stretch d-md-flex bg-light p-3 align-items-center d-flex ftco-animate">
              <a href="{{route('frontend_single_blog',['id'=>$d->id])}}" class="block-20 thumb" style="background-image: url('{{asset($d->sampul_foto)}}');">
              </a>
              <div class="text text-thumb d-block pl-2 pl-md-4">
                <h3 class="heading mb-2">
                  <a href="{{route('frontend_single_blog',['id'=>$d->id])}}">{{$d->judul}}</a>
                </h3>
                <div class="meta">
                  <div>
                    <a href="{{route('frontend_single_blog',['id'=>$d->id])}}">
                      {{\Carbon\Carbon::parse($d->created_at)->formatLocalized("%A, %d %B %Y") }}
                    </a>
                  </div>
                  <div>
                    <a href="{{route('frontend_single_blog',['id'=>$d->id])}}">
                      {{$d->users->nama}}
                    </a>
                  </div>
                  {{-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div> --}}
                </div>
              </div>
            </div>
          @endif
        @endforeach
        
        
      </div>
    </div>
    
  </div>
</section>