@extends('layouts.main')

@section('container')
    <h1>Halaman Kontak</h1>
    <h3 class="pt-3"><b>Jika ada keperluan dapat menghubungi kontak di bawah ini:</b></h3>
    <article class="pt-2">
        {{-- // templating engine laravel <?php //echo $variabel; ?> atau <?= //$variabel; ?> disingkat
        menjadi ==> {{  }} --}}
        <p>Nomor HP: {{ $phone }}</p>
        <p>Instagram: {{ $ig }}</p>
        <p>Email: {{ $email }}</p>
    </article>
@endsection
