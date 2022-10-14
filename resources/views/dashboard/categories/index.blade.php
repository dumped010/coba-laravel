@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Categories</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-9" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-9">
        {{-- tombol menambah categories --}}
        <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Create New Category</a>
        <table class="table table-striped table-sm">
          <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Kategori</th>
                  <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)

                    <tr>
                    {{-- method untuk membuat perulangan angka, untuk lebih jelasnya lihat dokumentasi laravel tentang LOOP VARIABLES --}}
                    <td>{{ $loop->iteration }}</td>
                    {{-- ******************* --}}

                    <td>{{ $category->name }}</td>
                    <td>
                        {{-- tombol lihat detail --}}
                        <a href="/dashboard/categories/{{ $category->slug }}" class="badge bg-info" data-bs-toggle="tooltip" data-bs-title="Details"><span data-feather="eye"></span></a>
                        {{-- tombol edit --}}
                        <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning" data-bs-toggle="tooltip" data-bs-title="Edit Category"><span data-feather="edit"></span></a>
                        {{-- tombol hapus --}}
                        <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                            {{-- method dari laravel untuk membajak method yang dari html yaitu post --}}
                            {{-- mjd method yang disebutkan dalam method @method('') --}}
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Yakin Menghapus Kategori?')" data-bs-toggle="tooltip" data-bs-title="Delete Category"><span data-feather="trash-2"></span></button>
                        </form>
                    </td>
                    </tr>

                @endforeach
          </tbody>
        </table>
      </div>

@endsection
