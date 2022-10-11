@extends('dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Post</h1>
    </div>

    <div class="col-lg-9">
        {{-- form tambah data postingan --}}
        <form method="post" action="/dashboard/posts/{{ $post->slug }}" class="mb-5" enctype="multipart/form-data">
            {{-- method laravel untuk membajak method dari html yaitu post --}}
            {{-- menjadi method="put" untuk menyimpan data ke database --}}
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul Postingan</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required autofocus>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug (Tanda Pengenal Postingan)</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" required>
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        {{-- simbol == mencocokkan HANYA isi data, TANPA tipe data --}}
                        {{-- simbol === mencocokkan ISI dan TIPE data --}}
                        @if(old('category_id', $post->category_id) == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar Postingan</label>
                {{-- input untuk menyimpan path gambar lama, yang digunakan untuk menghapus gambar lama tsb --}}
                {{-- jika user mengupload gambar baru --}}
                <input type="hidden" name="oldImage" value="{{ $post->image }}">
                {{-- kondisi ketika postingan sudah memiliki gambar, maka ditampilkan dulu di preview image --}}
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-preview img-fluid mb-3 col-sm-6 d-block">
                @else
                    {{-- Preview Image dengan Javascript --}}
                    {{-- class img-preview hanya kelas yang dibuat sendiri untuk pemanggilan --}}
                    <img class="img-preview img-fluid mt-3 col-sm-6">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Isi Postingan</label>
                {{-- atribut id pada field input HARUS SAMA dengan atribut input pada field trix-editor --}}
                <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                <trix-editor input="body"></trix-editor>
                @error('body')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Postingan</button>

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

        // function untuk preview image
        function previewImage() {
            // id menggunakan simbol pagar/hashtag (#), sedangkan class menggunakan simbol titik/dot (.)
            const img = document.querySelector('#image'); // variable untuk menangkap inputan gambar
            const imgPreview = document.querySelector('.img-preview'); // var untuk menangkap tag img yang kosong

            // mengubah display image yang semula inline menjadi block
            imgPreview.style.display = 'block';

            // perintah untuk mengambil data gambar yang di input user
            const oFReader = new FileReader();
            oFReader.readAsDataURL(img.files[0]);

            oFReader.onload = function (oFREevent) {
                imgPreview.src = oFREevent.target.result;
            }
        }
    </script>
@endsection
