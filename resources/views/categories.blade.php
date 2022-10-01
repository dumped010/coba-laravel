
@extends('layouts.main')

@section('container')

    <style>
        .zoom {
            transition: transform .5s; /* Animation */
        }

        .zoom:hover {
            transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
    </style>

    <h2 class="mb-5">{{ $title }}</h2>


    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4">
                    <a href="/posts?category={{ $category->slug }}">
                        <div class="card text-bg-dark zoom">
                            <img src="https://source.unsplash.com/500x400?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title flex-fill text-center text-white p-4 fs-5" style="background-color: rgba(0, 0, 0, 0.7)">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


@endsection
