@extends('dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Post</h1>
    </div>

    <div class="col-lg-9">
        {{-- form tambah data postingan --}}
        <form method="post" action="/dashboard/posts">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul Postingan</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug (Tanda Pengenal Postingan)</label>
                <input type="text" class="form-control" id="slug" name="slug" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Isi Postingan</label>
                {{-- atribut id pada field input HARUS SAMA dengan atribut input pada field trix-editor --}}
                <input id="body" type="hidden" name="body">
                <trix-editor input="body"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Buat Postingan</button>

        </form>
    </div>

    {{-- script untuk fetching data dari field judul postingan
        kemudian di pass ke function untuk membuat slug nya
        lalu di input kan ke field slug menggunakan javascript dan json
        --}}
    <script>
        // mengambil value dari field input dengan id = title
        // untuk diproses ke function pembuatan slug
        const title = document.querySelector('#title');

        // mengambil value dari field input dengan id = slug untuk diisi dengan
        // hasil dari pembuatan slug otomatis yang didapat oleh variable const title
        const slug = document.querySelector('#slug');

        // eventHandler yang menangani ketika ada masukan dari field Judul Postingan
        // untuk kemudian dikirim ke function membuat slug
        // menggunakan on change event
        // on change event digunakan ketika user telah selesai mengisi sebuah field inputan
        // kemudian berpindah ke field inputan lain, maka fungsi baru dijalankan
        title.addEventListener('change', function(){
            // mengambil data dari method pada controller DashboardPostController
            // '..?title' + title.value ==> mengambil apa yang diisikan di field title
            // lalu dikirimkan ke route /dashboard/checkSlug
            // jadi hasil akhir = inputnya title, outputnya slug
            fetch("/dashboard/checkSlug?title=" + title.value)
                // mengambil value dari field Judul Postingan kemudian dikirim menggunakan json
                .then(response => response.json())
                // hasil yang dikembalikan berupa data
                // data ini akan mengubah value dari field slug dengan isi data tersebut
                // yang disimpan di data.property, dalam case ini property diberi nama slug ==> data.slug
                // karena pada json, data yang dikirim berupa object, pasangan antara key dan value
                .then(data => slug.value = data.slug)
        });

        // menonaktifkan fungsi file upload pada trix editor
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endsection
