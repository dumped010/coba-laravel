<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // menampilkan halaman categories
    public function index()
    {
        // pengkodisian authorization ketika user akan diarahkan ke halaman Categories
        // versi sederhana 1
        // if (auth()->guest() || auth()->user()->username !== 'rezandika') {
            // jika user belum login, dan
            // jika user selain yang memiliki username 'rezandika'
            // tidak boleh akses halaman ini
            // abort(403);
        // }

        // versi sederhana 2
        // if (!auth()->check() || auth()->user()->username !== 'rezandika') {
        //     // method check menghasilkan nilai 'true' jika user SUDAH LOGIN
        //     // maka diberi tanda seru (!) yang berarti NOT
        //     // jadi ketika user sudah login nilai nya menjadi !TRUE (Not True) = FALSE
        //     abort(403);
        // }

        // pengkodisian di atas tidak dipakai karena harus menuliskannya di setiap method yang ada
        // pada controller ini, maka dari itu diganti dengan pembuatan middleware isAdmin
        // **************************************************************************************************** //

        // pengecekan otorisasi menggunakan Gate
        // setelah middleware pada routes yang mengarah ke controller ini dihilangkan
        // $this->authorize('admin');

        // pengkodisian di atas dengan Gate tidak dipakai, karena pada case ini Gate digunakan untuk
        // otorisasi tampilan pada halaman admin
        // otorisasi tetap menggunakan middleware
        // *************************************************************************************************** //

        return view('dashboard.categories.index', [
            // mengambil data semua category dengan method all()
            // dan dikirim ke view index
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
