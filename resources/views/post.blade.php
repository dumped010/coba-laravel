
@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                {{-- {{  }} tidak escaping tag html di dalam paragraf, tag html yang ada dalam paragraf TIDAK TERBACA --}}
                <h2>{{ $post->title }}</h2>

                <p>by <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>

                @if ($post->image)
                    {{-- pembuatan div ini sedikit memaksa agar ukuran gambar yang ditampilkand ari database --}}
                    {{-- menyerupai ukuran yang dari unsplash --}}
                    <div style="max-height: 350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid">
                @endif

                <article class="my-3 fs-5">
                    {{-- {!!  !!} escaping tag html di dalam paragraf, tag html yang ada dalam paragraf TERBACA --}}
                    {!! $post->body !!}
                </article>


                <a href="/posts" class="d-block mt-3"><< Back to Posts</a>
            </div>
        </div>
    </div>



@endsection


