@extends('frontend.all')

@section('judul_halaman','Blog')

@section('konten')
@section('isiHeader')
<h2 class="mb-3 bread">Blog</h2>
<p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
    <span>Blog <i class="ion-ios-arrow-forward"></i></span></p>
@endsection
@include('frontend.template.header')

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate">
                <div class="row">
                    @if (count($data['blogs']) == 0)
                    <div class="col-md-12 text-center">
                        Blog tidak ada
                    </div>
                    @endif
                    @foreach($data['blogs'] as $d)
                    <div class="col-md-12 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch d-md-flex">
                            <a href="{{route('frontend_single_blog',['id'=>$d->id])}}" class="block-20"
                                style="background-image: url('{{asset($d->sampul_foto)}}');">
                            </a>
                            <div class="text d-block pl-md-4">
                                <div class="meta mb-3">
                                    <div><a
                                            href="{{route('frontend_single_blog',['id'=>$d->id])}}">{{\Carbon\Carbon::parse($d->created_at)->formatLocalized("%A, %d %B %Y") }}</a>
                                    </div>
                                    <div><a href="{{route('frontend_single_blog',['id'=>$d->id])}}">-
                                            {{$d->users->nama}}</a></div>
                                </div>
                                <h3 class="heading"><a
                                        href="{{route('frontend_single_blog',['id'=>$d->id])}}">{{$d->judul}}</a>
                                </h3>
                                <p>{{preg_replace('/<[^>]*>/', '', substr($d->konten,0,150))}}</p>
                                <p><a href="{{route('frontend_single_blog',['id'=>$d->id])}}"
                                        class="btn btn-primary py-2 px-3">Read more</a></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{$data['blogs']->links()}}
                    {{-- {{ request()->is('blog*') ? "":$data['blogs']->links()}} --}}
                </div>
            </div> <!-- .col-md-8 -->
            <div class="col-lg-4 sidebar ftco-animate">
                @include('frontend.pages.Blog.Components.searchBar')
                @include('frontend.pages.Blog.Components.categoris')
                {{-- @include('frontend.pages.Blog.Components.tags') --}}
            </div>
        </div>
    </div>
</section> <!-- .section -->
@endsection

@section('JsTambahanAfter')
<script src="{{asset('js/pages/blog-search.js')}}"></script>
@endsection
