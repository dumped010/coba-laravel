<?php

namespace App\Models;


class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul Post 1",
            "slug" => "judul-post-1",
            "author" => "Sandhika Galih",
            "isi" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, soluta. Maxime corporis non aspernatur culpa aperiam odio exercitationem repellat? Natus ea reiciendis eum esse. Quasi voluptas asperiores mollitia, repellendus beatae eos dolorem nisi non alias amet eveniet eum minima, totam nesciunt id recusandae saepe quia quos obcaecati tempora est perferendis optio. Qui illo cupiditate assumenda temporibus eius laudantium sit mollitia deserunt omnis dolor aspernatur tenetur quo magnam dignissimos culpa, consequuntur at perferendis autem nostrum nam. Dolor porro suscipit molestias voluptas!"
        ],
        [
            "title" => "Judul Post Dika",
            "slug" => "judul-post-2",
            "author" => "Reza Andika",
            "isi" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, soluta. Maxime corporis non aspernatur culpa aperiam odio exercitationem repellat? Natus ea reiciendis eum esse. Quasi voluptas asperiores mollitia, repellendus beatae eos dolorem nisi non alias amet eveniet eum minima, totam nesciunt id recusandae saepe quia quos obcaecati tempora est perferendis optio. Qui illo cupiditate assumenda temporibus eius laudantium sit mollitia deserunt omnis dolor aspernatur tenetur quo magnam dignissimos culpa, consequuntur at perferendis autem nostrum nam. Dolor porro suscipit molestias voluptas!Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, soluta. Maxime corporis non aspernatur culpa aperiam odio exercitationem repellat? Natus ea reiciendis eum esse. Quasi voluptas asperiores mollitia, repellendus beatae eos dolorem nisi non alias amet eveniet eum minima, totam nesciunt id recusandae saepe quia quos obcaecati tempora est perferendis optio. Qui illo cupiditate assumenda temporibus eius laudantium sit mollitia deserunt omnis dolor aspernatur tenetur quo magnam dignissimos culpa, consequuntur at perferendis autem nostrum nam. Dolor porro suscipit molestias voluptas!"
        ]
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
