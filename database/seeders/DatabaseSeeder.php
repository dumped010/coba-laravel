<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // membuat method membuat dummy data
        // Namamodel::create([ 'nama_kolom' => 'data', 'nama_kolom2' => 'data2']);

        /**
         *
         * Membuat Dummy Data User
         *
         */
        // User::create([
        //     'name' => 'Reza Andika',
        //     'email' => 'dika00@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // User::create([
        //     'name' => 'Dikare Zandi',
        //     'email' => 'zanre11@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        /**
         *
         * Membuat Dummy Data Category
         *
         */

        // memanggil factory untuk membuat data dummy otomatis
        // method ada di file database/factories
        // USER hanya dibuat 3 untuk menyesuaikan pada PostFactory
        // ketentuan ini dibuat untuk BELAJAR SEMENTARA
        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();

        /**
         *
         * Membuat Dummy Data Post
         *
         */
        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda amet ',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda amet tenetur ut praesentium. Odio molestias aspernatur esse ab iusto tempore enim corporis saepe porro necessitatibus,</p><p>reprehenderit illo placeat iure consequatur itaque dolor. Possimus corporis modi dolore incidunt dignissimos at ipsam? Eius saepe quod cupiditate provident dolore voluptate aspernatur aut dolorem possimus culpa.</p><p>Quibusdam aperiam ullam dolor nam, sunt, non, fugiat tempora impedit nisi repellendus asperiores cum quidem velit harum accusantium ut ad! Officia atque explicabo consectetur repellat, id corrupti nobis corporis hic necessitatibus ipsa tenetur odit ad unde in quo quam nulla accusamus ratione quibusdam doloribus dolorem voluptates. Porro, officiis.</p>',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke 2',
        //     'slug' => 'judul-ke-2',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit ... ',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda amet tenetur ut praesentium. Odio molestias aspernatur esse ab iusto tempore enim corporis saepe porro necessitatibus,</p><p>reprehenderit illo placeat iure consequatur itaque dolor. Possimus corporis modi dolore incidunt dignissimos at ipsam? Eius saepe quod cupiditate provident dolore voluptate aspernatur aut dolorem possimus culpa.</p><p>Quibusdam aperiam ullam dolor nam, sunt, non, fugiat tempora impedit nisi repellendus asperiores cum quidem velit harum accusantium ut ad! Officia atque explicabo consectetur repellat, id corrupti nobis corporis hic necessitatibus ipsa tenetur odit ad unde in quo quam nulla accusamus ratione quibusdam doloribus dolorem voluptates. Porro, officiis.</p><p>Quibusdam aperiam ullam dolor nam, sunt, non, fugiat tempora impedit nisi repellendus asperiores cum quidem velit harum accusantium ut ad! Officia atque explicabo consectetur repellat, id corrupti nobis corporis hic necessitatibus ipsa tenetur odit ad unde in quo quam nulla accusamus ratione quibusdam doloribus dolorem voluptates. Porro, officiis.</p>',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke 3',
        //     'slug' => 'judul-ke-3',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit Odio molestias aspernatur ... ',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda amet tenetur ut praesentium. Odio molestias aspernatur esse ab iusto tempore enim corporis saepe porro necessitatibus,</p><p>reprehenderit illo placeat iure consequatur itaque dolor. Possimus corporis modi dolore incidunt dignissimos at ipsam? Eius saepe quod cupiditate provident dolore voluptate aspernatur aut dolorem possimus culpa.</p><p>Quibusdam aperiam ullam dolor nam, sunt, non, fugiat tempora impedit nisi repellendus asperiores cum quidem velit harum accusantium ut ad! Officia atque explicabo consectetur repellat, id corrupti nobis corporis hic necessitatibus ipsa tenetur odit ad unde in quo quam nulla accusamus ratione quibusdam doloribus dolorem voluptates. Porro, officiis.</p><p>Quibusdam aperiam ullam dolor nam, sunt, non, fugiat tempora impedit nisi repellendus asperiores cum quidem velit harum accusantium ut ad! Officia atque explicabo consectetur repellat, id corrupti nobis corporis hic necessitatibus ipsa tenetur odit ad unde in quo quam nulla accusamus ratione quibusdam doloribus dolorem voluptates. Porro, officiis.</p><p>Quibusdam aperiam ullam dolor nam, sunt, non, fugiat tempora impedit nisi repellendus asperiores cum quidem velit harum accusantium ut ad! Officia atque explicabo consectetur repellat, id corrupti nobis corporis hic necessitatibus ipsa tenetur odit ad unde in quo quam nulla accusamus ratione quibusdam doloribus dolorem voluptates. Porro, officiis.</p>',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke 4',
        //     'slug' => 'judul-ke-4',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit Odio molestias ... ',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda amet tenetur ut praesentium. Odio molestias aspernatur esse ab iusto tempore enim corporis saepe porro necessitatibus,</p><p>reprehenderit illo placeat iure consequatur itaque dolor. Possimus corporis modi dolore incidunt dignissimos at ipsam? Eius saepe quod cupiditate provident dolore voluptate aspernatur aut dolorem possimus culpa.</p><p>Quibusdam aperiam ullam dolor nam, sunt, non, fugiat tempora impedit nisi repellendus asperiores cum quidem velit harum accusantium ut ad! Officia atque explicabo consectetur repellat, id corrupti nobis corporis hic necessitatibus ipsa tenetur odit ad unde in quo quam nulla accusamus ratione quibusdam doloribus dolorem voluptates. Porro, officiis.</p>',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}
