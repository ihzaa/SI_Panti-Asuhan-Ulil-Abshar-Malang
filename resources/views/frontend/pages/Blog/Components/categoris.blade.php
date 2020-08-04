<div class="sidebar-box ftco-animate">
    <h3 class="heading-2">Categories</h3>
    <ul class="categories">
        @foreach ( $data['kategoris'] as $d)
        <li><a href="#">{{$d->nama}}
                @if($d->blog_count != 0)
                <span>({{$d->blog_count}})</span>
                @endif
            </a></li>
        @endforeach
    </ul>
</div>
