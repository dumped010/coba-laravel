<?php


use App\Http\Controllers\PostController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// halaman beranda/home
Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => "home",
        "image" => "laugh.jpg"
    ]);
});

// halaman tentang/about
Route::get('/about', function () {
    return view('about', [
        // variabel => isi
        "title" => "About",
        "active" => "about",
        "name" => "Reza Andika",
        "email" => "rezaandika0@gmail.com",
        "image" => "dika.jpg"
    ]);
});

// halaman kontak
Route::get('/contact', function () {
    return view('contact', [
        "title" => "Contact",
        "active" => "contact",
        "phone" => "08213777xxxx",
        "ig" => "@7rdk7",
        "email" => "rezaandika0@gmail.com"
    ]);
});


// ambil data postingan
// Route::get('/nama_halaman di folder views', [NamaController::class, 'nama method nya di dalam Controller']);
Route::get('/posts', [PostController::class, 'index']);

// halaman single post
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

//menampilkan semua kategori postingan
Route::get('/categories', function(){
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

// Routes Login
// method middleware('guest') menjelaskan bahwa route ini hanya diakses
// oleh user yang belum login dan belum ter-autentikasi
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

// Routes mengirim data dari tampilan login dengan method post
Route::post('/login', [LoginController::class, 'authenticate']);

// Routes untuk mengatur aksi logout
Route::post('/logout', [LoginController::class, 'logout']);

// Routes Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');

// Routes mengirim data dari tampilan register dengan method post
Route::post('/register', [RegisterController::class, 'store']);

// Routes menampilkan tampilan dashboard
// method middleware('auth) menjelaskan bahwa route ini hanya diakses
// oleh user yang sudah login dan ter-autentikasi
Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');

// route untuk menggunakan resource controller
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// route untuk menangani pembuatan slug otomatis
// yang menggunakan library EloquentSluggable
Route::get('/dashboard/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');








//                 METHOD DI BAWAH SUDAH TIDAK DIPAKAI KARENA SUDAH DITANGANI PADA MODEL POST


// menampilkan postingan berdasarkan kategorinya
// Route::get('/nama_halaman/{selector}', function(Model $model){return view();});
// jika selector berubah, maka $user pada Model juga harus sama
// Route::get('/categories/{category:slug}', function(Category $category){
//     return view('posts', [
//         'title' => "Post By Category : $category->name",
//         'active' => 'posts',
//         'posts' => $category->posts->load(['author','category'])
//     ]);
// });

//menampilkan postingan berdasarkan penulisnya / author
// Route::get('/authors/{author:username}', function(User $author){
//     return view('posts', [
//         'title' => "Post By Author : $author->name",
//         'active' => 'posts',
//         'posts' => $author->posts->load(['category','author'])
//     ]);
// });
