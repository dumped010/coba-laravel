<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // menghubungkan tabel Category dengan tabel Post
    public function posts()
    {
        return $this->hasMany(Post::class); // 1 kategori memiliki BANYAK postingan
    }

    // menghubungkan tabel Category dengan tabel User
    public function user()
    {
        return $this->hasMany(User::class); // 1 kategori dimiliki BANYAK user
    }
}
