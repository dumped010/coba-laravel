
@extends('layouts.main')

@section('container')
    <h1>Halaman About</h1>
    {{-- // templating engine laravel <?php //echo $variabel; ?> atau <?= //$variabel; ?> disingkat
        menjadi ==> {{  }} --}}
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="200" class="img-thumbnail rounded-circle">
@endsection
