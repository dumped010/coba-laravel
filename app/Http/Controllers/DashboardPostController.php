<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // method menampilkan data postingan berdasarkan user tertentu
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // method menampilkan halaman untuk menambah postingan
    public function create()
    {
        // menampilkan halaman tambah data
        return view('dashboard.posts.create', [
            // mengambil data semua category dengan method all()
            // dan dikirim ke view create
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // method untuk menjalankan fungsi tambah postingan
    public function store(Request $request)
    {
        // HANYA UNTUK BELAJAR, JADI DIKOMENTAR SAJA WKWKWK //
        // dd($request); // dd() adalah fungsi untuk dump, die semua data yang dikirimkan
        // return $request->file('image')->store('post-images');
        // ------------------------------------------------------ //

        // menerima data yang dikirimkan dari view
        // untuk ditambahkan ke database
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            // validasi untuk image
            // rules nya dapat dicari dengan keyword rules apa saja yang dapat digunakan
            // dalam validasi laravel
            // rules "file" sebelum "max" menandakan bahwa yang diterima merupakan FILE ,
            // BUKAN STRING , untuk FILE ukurannya dalam satuan KILOBYTE (KB)
            'image' => 'image|file|max:1024', // maks ukuran file 1 MB / 1024 KB
            'body' => 'required'
        ]);

        // validasi jika user tidak upload image
        // tidak masalah karena telah ditangani dengan API dari Unsplash
        if ($request->file('image')) {
            // jika image telah berhasil melalui validasi, maka akan disimpan ke folder post-images
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // menambahkan id user ke dalam $validatedData
        $validatedData['user_id'] = auth()->user()->id;

        // menambahkan excerpt ke dalam $validatedData yang dibuat dari inputan body
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        // menjalankan INSERT ke database
        Post::create($validatedData);

        // mengembalikan ke halaman dashboard setelah INSERT data ke database
        // dan mengirimkan pesan success menggunakan method with()
        return redirect('/dashboard/posts')->with('success', 'Postingan baru berhasil ditambahkan!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // method menampilkan detail sebuah postingan
    public function show(Post $post)
    {
        return view('dashboard.posts.details', [
            // 'variabel menyimpan data' => $var_data_yang_dikirim
            // $var_data_yang_dikirim harus sama dengan variabel yang disebutkan pada method show(Post $post)
            'data' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // method untuk menampilkan halaman ubah data postingan
    public function edit(Post $post)
    {
        // menampilkan halaman edit data
        return view('dashboard.posts.edit', [
            // mengirim data postingan ke view edit
            'post' => $post,
            // mengambil data semua category dengan method all()
            // dan dikirim ke view create
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // method untuk menjalankan fungsi ubah data postingan
    public function update(Request $request, Post $post)
    {
        // menerima data yang dikirimkan dari view edit
        // untuk di UPDATE ke database
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024', // maks ukuran file 1 MB / 1024 KB
            'body' => 'required'
        ];


        // pengkodisian slug
        // jika slug yang dikirim tidak sama dengan slug yang ada di database
        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        // validasi data yang dikirimkan dalam variabel $rules
        $validatedData = $request->validate($rules);

        // validasi jika user tidak mengubah image
        // tidak masalah karena telah ditangani dengan API dari Unsplash
        if ($request->file('image')) {
            // kondisi jika postingan memiliki gambar lama, maka dihapus dulu baru upload yang baru
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            // jika image telah berhasil melalui validasi, maka akan disimpan ke folder post-images
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        // menambahkan id user ke dalam $validatedData
        $validatedData['user_id'] = auth()->user()->id;

        // menambahkan excerpt ke dalam $validatedData yang dibuat dari inputan body
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        // menjalankan UPDATE ke database
        Post::where('id', $post->id)
                ->update($validatedData);

        // mengembalikan ke halaman dashboard setelah INSERT data ke database
        // dan mengirimkan pesan success menggunakan method with()
        return redirect('/dashboard/posts')->with('success', 'Postingan berhasil diubah!!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // method untuk menghapus data postingan
    public function destroy(Post $post)
    {
        // kondisi jika postingan memiliki gambar, maka dihapus dulu gambarnya baru hapus postingan nya
        if ($post->image) {
            Storage::delete($post->image);
        }

        // menjalankan DELETE ke database
        Post::destroy($post->id);

        // mengembalikan ke halaman dashboard setelah DELETE data ke database
        // dan mengirimkan pesan success menggunakan method with()
        return redirect('/dashboard/posts')->with('success', 'Postingan berhasil dihapus!!!');
    }

    // method yang menangani ketika ada permintaan slug
    public function checkSlug(Request $request)
    {
        // createSlug() adalah method yang ada di SlugService
        // createSlug(Modelname::class, 'field_yang_diambil', 'data_yang_akan_diubah_menjadi_slug');
        // dalam case ini, 'field yang diambil' adalah slug
        // lalu 'data yang akan diubah' didapat dari $request->title, yaitu
        // data yang dikirim dari route view create ==> /dashboard/posts/checkSlug?title
        // karena data yang dikirimkan melalui url, maka dapat diambil dengan $request->nama_data
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        // mengembalikan hasil dari data yang dikirim dan diubah menjadi slug
        // dalam bentuk json() agar dapat diolah pada method javascript yang
        // telah dibuat di view create.blade.php
        return response()->json(['slug' => $slug]); // json(['key' => 'value/data']);

        // library SlugService sudah melakukan pengecekan otomatis keunikan dari slug
        // ke database, karena slug harus unik
    }


}
