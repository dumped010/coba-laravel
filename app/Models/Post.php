<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    // fillable berarti field yang disebutkan BOLEH DIISI, sisanya tidak
    // protected $fillable = ['title', 'excerpt', 'body'];

    // guarded berarti field yang disebutkan TIDAK BOLEH DIISI, sisanya boleh
    // guarded berguna untuk melakukan Mass Submission, pengisian beberapa field bersamaan
    protected $guarded = ['id'];
    // properti $with berguna untuk memanggil atribut author dan category sekaligus untuk mengurangi pemanggilan query
    protected $with = ['author','category'];

    // menghubungkan 1 model dengan model yang lain
    // buat fungsi yang namanya adalah model yang akan dihubungkan
    // contoh fungsi di bawah menghubungkan tabel Post dengan tabel Category
    // belongsTo() adalah relasi yang menjelaskan hubungan 1 to 1
    // fungsi category() merupakan suatu relation
    public function category()
    {
        return $this->belongsTo(Category::class); // 1 postingan HANYA memiliki 1 kategori
    }

    // menghubungkan tabel Post dengan tabel User
    // belongsTo() adalah relasi yang menjelaskan hubungan 1 to 1
    // fungsi author() juga merupakan suatu relation
    public function author()
    {
        // user_id adalah alias untuk author / method function
        return $this->belongsTo(User::class, 'user_id'); // 1 postingan HANYA dimiliki oleh 1 user
    }

    // query scopes untuk pencarian postingan dengan nama Filter
    public function scopeFilter($query, array $filters)
    {
        // CARA 1:
        // array $filters digunakan untuk memisahkan pencarian yang lebih kompleks ke database
        // berguna untuk memudahkan dan memperluas pencarian yang melibatkan lebih dari 1 variabel
        // misal variabel judul, body postingan, author, tanggal dibuat, dll
        // if(isset($filters['search']) ? $filters['search'] : false){
            // method di atas dibaca: jika ada filters yang dikirim by request maka ambil filter tersebut
            // lalu masukkan ke query di bawah, tetapi jika tidak ada filter yang dikirim by request
            // maka lewati query di bawah
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%')
        //           ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }


        // CARA 2:
        $query->when($filters['search'] ?? false, function($query, $search){
            // penjelasan
            // hasil dari $filters['search] akan masuk ke variabel $search
            // lalu query yang digunakan akan masuk ke variabel $query
            return $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('body', 'like', '%' . $search . '%');
        });

        // jika ada filter lain selain dari filter 'search', dalam hal ini adalah 'category'
        // di bawah ini menggunakan function CALL BACK dan
        // menggunakan isset($filter['category']) yang disederhanakan khusus PHP ver 7 ke atas
        $query->when($filters['category'] ?? false, function($query, $category){
            // pada bagian ini, harus men-join kan tabel category dengan tabel posts
            // dengan menggunakan method Laravel yaitu whereHas()
            return $query->whereHas('category', function($query) use ($category){
                // method use($var) berguna untuk menghubungkan variabel yang di declare
                // dalam method use() , pada case ini adalah $category
                // untuk dapat dipanggil / digunakan pada nested $query seperti di bawah ini
                $query->where('slug', $category);
            });
        });

        // jika ada filter lain selain dari filter 'search, dalam hal ini adalah 'author'
        // di bawah ini menggunakan ARROW function khusus PHP ver 7 ke atas
        // jika menggunakan ARROW function tidak perlu memanggil method use($var)
        // karena scope nya dari ARROW function akan langsung mencari dari method di atas nya
        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn($query) =>
                // di sini 'username' digunakan sebagai parameter yang unik agar tidak mudah dikenali user lain
                $query->where('username', $author)
            )
        );
    }

    // overriding route untuk mengambil postingan
    // melalui resource controller dengan menggunakan
    // kolom selain "id", dalam hal ini digunakan kolom "slug"
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // method untuk membuat slug secara otomatis menggunakan Eloquent Sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }



}
