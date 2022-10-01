@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Posts</h1>
    </div>

    <div class="table-responsive col-lg-9">
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
                        <a href="" class="badge bg-warning" data-bs-toggle="tooltip" data-bs-title="Edit Post"><span data-feather="edit"></span></a>
                        {{-- tombol hapus --}}
                        <a href="" class="badge bg-danger" data-bs-toggle="tooltip" data-bs-title="Delete Post"><span data-feather="trash-2"></span></a>
                    </td>
                    </tr>

                @endforeach
          </tbody>
        </table>
      </div>

@endsection
