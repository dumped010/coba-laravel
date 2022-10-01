<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // method tampilan halaman register
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    // mengambil data user registration yang dikirim dari tampilan register
    public function store(Request $request)
    {
        // return $request()->all(); // mengambil semua data yang dikirim dengan method post

        // validasi data yang dikirim dari form register
        $validatedData = $request->validate([ // $validatedData adalah variable utk menyimpan hasil validasi
            'name' => 'required|max:255', // untuk menambahkan parameter validasi dapat menggunakan simbol pipe
            'username' => ['required', 'min:5', 'max:255', 'unique:users'], // atau dengan menggunakan array
            // parameter unique:nama_tabel, akan memeriksa apakah data yang dikirimkan sudah ada atau belum
            // di tabel yang disebutkan, laravel akan otomatis mencarinya
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'

        ]);

        // enkripsi password cara 1:
        // $validatedData['password'] = bcrypt($validatedData['password']);

        // enkripsi password cara 2:
        // perlu untuk memanggil facades Hash (lihat di paling atas)
        $validatedData['password'] = Hash::make($validatedData['password']);

        // jika validasi berhasil maka method apapun di bawah akah dijalankan, jika gagal maka tidak akan dijalankan
        // dd('registrasi berhasil'); // dd() method untuk dummy data sementara

        User::create($validatedData);

        // mengirim pesan flash data berhasil registrasi
        // cara 1:
        // session()->flash('success', 'Registration successful! Please login!');

        // setelah data registrasi dikirim ke database, diarahkan ke halaman login
        // cara 2 flash data dengan method with()
        return redirect('/login')->with('success', 'Registration successful! Please login!');
    }
}
