<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // $fillable --> kolom pada tabel yang DAPAT diisi banyak data secara bersamaan
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    // $guarded --> kolom pada tabel yang disebutkan TIDAK DAPAT diisi banyak data secara bersamaan
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // menghubungkan tabel User dengan tabel Post
    // hasMany() adalah relasi yang menjelaskan hubungan 1 to Many
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // menghubungkan tabel User dengan tabel Category
    // hasMany() adalah relasi yang menjelaskan hubungan 1 to Many
    public function category()
    {
        return $this->hasMany(Category::class);
    }
}
