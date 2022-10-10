@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Posts</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-9" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-9">
        {{-- tombol menambah postingan --}}
        <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create New Post</a>
        <table class="table table-striped table-sm">
          <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Judul Postingan</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)

                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        {{-- tombol lihat detail --}}
                        <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info" data-bs-toggle="tooltip" data-bs-title="Details"><span data-feather="eye"></span></a>
                        {{-- tombol edit --}}
                        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning" data-bs-toggle="tooltip" data-bs-title="Edit Post"><span data-feather="edit"></span></a>
                        {{-- tombol hapus --}}
                        <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                            {{-- method dari laravel untuk membajak method yang dari html yaitu post --}}
                            {{-- mjd method yang disebutkan dalam method @method('') --}}
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Yakin Menghapus Data?')" data-bs-toggle="tooltip" data-bs-title="Delete Post"><span data-feather="trash-2"></span></button>
                        </form>
                    </td>
                    </tr>

                @endforeach
          </tbody>
        </table>
      </div>

@endsection
