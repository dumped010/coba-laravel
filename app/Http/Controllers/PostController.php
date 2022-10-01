<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public static function index()
    {

        // membuat title mengikuti request()
        $title = '';
        if(request('category')) {
            // mencari category dari request() ke tabel category menggunakan Model Category
            // dengan method firstWhere()
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if(request('author')) {
            // mencari author dari request() ke tabel user menggunakan Model User
            // dengan method firstWhere()
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }

        // dd(request('search'));
        return view('posts', [
            "title" => "All Posts" . $title,
            "active" => "posts",
            // filter() di dapat dari Model Post
            // pada method scopeFilter, kata filter tersebut yang langsung dipanggil tanpa
            // memanggil kata scope, berlaku untuk kata selain filter sesuai kebutuhan
            // request yang dikirim ke method filter berupa array [] untuk memudahkan
            // pencarian yang lebih kompleks seperti mencari author, category, dll
            // method paginate(n) digunakan untuk membatasi items yang ditampilkan
            // dalam 1 halaman, n adalah banyak items yang ingin ditampilkan
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
            // category dalam request di atas merupakan suatu parameter pencarian lainnya
            // banyak dan variasinya dapat disesuaikan dengan kebutuhan, dalam pelajaran ini category
            // merupakan sebuah relation dalam database, lanjut ke model Post
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            "title" => "Single Post",
            "active" => "posts",
            "post" => $post
        ]);
    }

}
