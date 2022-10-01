
@extends('layouts.main')

{{-- section child sebagai isi container di main page --}}
@section('container')
    <h1>Halaman Home</h1>
    <article class="pt-5">
        <h3><b>Semangat Belajar Laravel BosQ ^_^ !!!</b></h3>
        <img src="img/{{ $image }}" alt="{{ $image }}" width="400" class="img-thumbnail">
    </article>
@endsection
