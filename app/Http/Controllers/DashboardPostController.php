<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
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
        // menerima data yang dikirimkan dari view
        // untuk ditambahkan ke database
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'body' => 'required'
        ]);

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
        //
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
        //
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
        //
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
