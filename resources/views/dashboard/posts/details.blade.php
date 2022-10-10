@extends('dashboard.layouts.main')

@section('container')

    <div class="container">
        <div class="row my-5">
            <div class="col-lg-8">
                {{-- {{  }} tidak escaping tag html di dalam paragraf, tag html yang ada dalam paragraf TIDAK TERBACA --}}
                <h2>{{ $data->title }}</h2>

                <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to My Posts</a>
                <a href="/dashboard/posts/{{ $data->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
                {{-- tombol hapus --}}
                <form action="/dashboard/posts/{{ $data->slug }}" method="post" class="d-inline">
                    {{-- method dari laravel untuk membajak method yang dari html yaitu post --}}
                    {{-- mjd method yang disebutkan dalam method @method('') --}}
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Yakin Menghapus Data?')"><span data-feather="trash-2"></span> Delete</button>
                </form>

                <img src="https://source.unsplash.com/1200x400?{{ $data->category->name }}" alt="{{ $data->category->name }}" class="img-fluid mt-3">

                <article class="my-3 fs-5">
                    {{-- {!!  !!} escaping tag html di dalam paragraf, tag html yang ada dalam paragraf TERBACA --}}
                    {!! $data->body !!}
                </article>


                <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to My Posts</a>
            </div>
        </div>
    </div>

@endsection
